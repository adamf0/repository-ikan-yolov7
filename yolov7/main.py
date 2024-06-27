import torch
from fastapi import FastAPI
# from app.routers import inference
from fastapi.middleware.cors import CORSMiddleware
from contextlib import asynccontextmanager
import cv2 as cv

import base64
# import cv2 as cv
import numpy as np
# from fastapi import APIRouter, Request
from fastapi import Request
# from app.routers._inference import draw_annotations
from schemas import InferenceRequest, ResponseModel, SchemaResult, ScrappingRequest, ResponseScrappingModel

import requests
from bs4 import BeautifulSoup


@asynccontextmanager
async def lifespan(app: FastAPI):
    app.state.ml_models = {}
    models = torch.hub.load("WongKinYiu/yolov7", "custom", "./model/model_ikan_best.pt", "cpu")
    app.state.ml_models["yolo"] = models
    yield
    app.state.ml_models.clear()


app = FastAPI(lifespan=lifespan)
origins = [
    "http://localhost:8000",  # Allow requests from this origin
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

def draw_annotations(image, results):
    for _, detection in enumerate(results.pandas().xyxy[0].to_dict("records")):
        x_min, y_min, x_max, y_max = (
            int(detection['xmin']), int(detection['ymin']),
            int(detection['xmax']), int(detection['ymax'])
        )
        confidence = detection['confidence']
        label = detection['name']
        cv.rectangle(image, (x_min, y_min), (x_max, y_max), (0, 255, 0), 2)
        label_text = f'{label}: {confidence:.2f}'
        cv.putText(image, label_text, (x_min, y_min - 10), cv.FONT_HERSHEY_SIMPLEX, 1.1, (0, 255, 0), 3)
    return image

# @app.get("/")
# def root():
#     return {"status_code": 200, "message": "wellcome to YOLO fish detection API service, please direct to /docs to preview API documentation"}

@app.post("/classfication")
def yolo_inference(request: Request, body: InferenceRequest):
    resp = ResponseModel()
    try:
        image_bytes = base64.b64decode(body.image)
        file_bytes = np.fromstring(image_bytes, np.uint8)
        image = cv.imdecode(file_bytes, cv.IMREAD_COLOR)
        image = cv.resize(image, (416, 416)) #after resize 416x416

        results = request.app.state.ml_models["yolo"](image)
        annotated_image = draw_annotations(image, results)
        _, buffer = cv.imencode('.jpg', annotated_image)
        annotated_image_str = base64.b64encode(buffer).decode('utf-8')
        result = results.pandas().xyxy[0].to_dict("records")
        resp.body = SchemaResult(annotation=result, img_result=annotated_image_str)
       
    except Exception as E:
        resp.message = str(E)
        resp.status_code = 501
    return resp

# https://medium.com/@darshankhandelwal12/scrape-google-with-python-2023-86cda73ffb16
@app.post("/scrapping_google")
def yolo_inference(request: Request, body: ScrappingRequest):
    resp = ResponseScrappingModel()
    try:
        headers = {
            "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4703.0 Safari/537.36"
        }
        query = body.url
        print(f"https://www.google.com/search?q={query}")
        response = requests.get(f"https://www.google.com/search?q={query}", headers=headers)
        soup = BeautifulSoup(response.content, "html.parser")
        organic_results = []

        for el in soup.select(".g"):
            title_el = el.select_one("h3")
            link_el = el.select_one("a")
            desc_el = el.select_one(".VwiC3b")

            if link_el is not None and query in link_el["href"]:
                organic_results.append({
                    "title": title_el.text if title_el is not None else "",
                    "link": link_el["href"],
                    "description": desc_el.text if desc_el is not None else "",
                })

            print(f"Organic Results: {organic_results}")
            
        resp.body = organic_results

    except Exception as E:
        resp.message = str(E)
        resp.status_code = 501
    
    return resp
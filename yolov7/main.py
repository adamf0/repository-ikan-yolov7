import torch
from fastapi import FastAPI
# from app.routers import inference
from fastapi.middleware.cors import CORSMiddleware
from contextlib import asynccontextmanager
import cv2 as cv
import random
import base64
# import cv2 as cv
import numpy as np
# from fastapi import APIRouter, Request
from fastapi import Request
# from app.routers._inference import draw_annotations
from schemas import InferenceRequest, ResponseModel, SchemaResult, ScrappingRequest, ResponseScrappingModel
import requests
from bs4 import BeautifulSoup

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options

@asynccontextmanager
async def lifespan(app: FastAPI):
    app.state.ml_models = {}
    models = torch.hub.load("WongKinYiu/yolov7", "custom", "./model/model_ikan_best.pt", "cpu")
    app.state.ml_models["yolo"] = models
    yield
    app.state.ml_models.clear()


app = FastAPI(lifespan=lifespan)
origins = [
    "*",  # Allow requests from this origin
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

chrome_options = Options()
chrome_options.add_argument("--headless")
chrome_options.add_argument("--no-sandbox")
chrome_options.add_argument("--disable-dev-shm-usage")

DRIVER_PATH = '/usr/local/bin/chromedriver'
# driver = webdriver.Chrome(executable_path=DRIVER_PATH, options=chrome_options)
driver = webdriver.Chrome(options=chrome_options)

@app.get("/test")
def test(request: Request):
    resp = ResponseScrappingModel()
    try: 
        search_query = "cafe in new york"
        base_url = "https://www.google.com/search?q="
        search_url = base_url + search_query.replace(" ", "+")

        driver.get(search_url)

        results = []
        result_divs = driver.find_elements(By.CSS_SELECTOR, "div.g")

        for result_div in result_divs:
            anchor = result_div.find_elements(By.CSS_SELECTOR, "a")
            if anchor:
                link = anchor[0].get_attribute("href")
                title = result_div.find_element(By.CSS_SELECTOR, "h3").text
                description_element = result_div.find_element(By.XPATH, "//div[@data-sncf='2']")
                description = description_element.text if description_element else "-"
                results.append({
                    "title": title,
                    "link": link,
                    "description": description,
                })
                results.append(f"{title};{link};{description}")

        driver.quit()
        resp.body = results

    except Exception as E:
        resp.message = str(E)
        resp.status_code = 501
    
    return resp

user_agents = [
    # Windows
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0",
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:87.0) Gecko/20100101 Firefox/87.0",
    
    # Mac
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4703.0 Safari/537.36",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Safari/605.1.15",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:85.0) Gecko/20100101 Firefox/85.0",

    # Linux
    "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0",
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36",
    "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:88.0) Gecko/20100101 Firefox/88.0",
    "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36",

    # Mobile
    "Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1",
    "Mozilla/5.0 (Linux; Android 11; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.120 Mobile Safari/537.36",
    "Mozilla/5.0 (iPhone; CPU iPhone OS 14_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1",
    "Mozilla/5.0 (Linux; Android 10; SM-G973F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.105 Mobile Safari/537.36",
    "Mozilla/5.0 (iPhone; CPU iPhone OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Mobile/15E148 Safari/604.1",

    # Tablets
    "Mozilla/5.0 (iPad; CPU OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1",
    "Mozilla/5.0 (Linux; Android 10; SM-T510) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36",
    "Mozilla/5.0 (iPad; CPU OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Mobile/15E148 Safari/604.1",
    "Mozilla/5.0 (Linux; Android 9; SM-T830) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.181 Safari/537.36"
]
# https://medium.com/@darshankhandelwal12/scrape-google-with-python-2023-86cda73ffb16
@app.post("/scrapping_google")
def scrapping_google(request: Request, body: ScrappingRequest):
    resp = ResponseScrappingModel()
    try:
        headers = {
            "User-Agent": random.choice(user_agents)
        }
        query = body.url
        print(f"https://www.google.com/search?q={query}")
        response = requests.get(f"https://www.google.com/search?q={query}", headers=headers)

        soup = BeautifulSoup(response.content, "html.parser")
        print(f"response: {soup}")
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
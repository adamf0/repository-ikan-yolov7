from typing import List, Dict
from pydantic import BaseModel


class InferenceRequest(BaseModel):
    image: str

class SchemaResult(BaseModel):
    img_result: str
    annotation: List

class ResponseModel(BaseModel):
    status_code: int = 200
    message: str = "success"
    body: Dict = SchemaResult
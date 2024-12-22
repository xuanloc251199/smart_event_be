# verify_face.py
import sys
import face_recognition
import json
from numpy import linalg as LA

def get_face_embedding(image_path):
    image = face_recognition.load_image_file(image_path)
    face_locations = face_recognition.face_locations(image)
    if len(face_locations) == 0:
        return None
    face_encodings = face_recognition.face_encodings(image, face_locations)
    if len(face_encodings) == 0:
        return None
    return face_encodings[0]

def compare_embeddings(embedding1, embedding2, threshold=0.6):
    distance = LA.norm(embedding1 - embedding2)
    return distance < threshold

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print(json.dumps({"status": False, "message": "Invalid arguments"}))
        sys.exit(1)
    image_path1 = sys.argv[1]
    image_path2 = sys.argv[2]
    embedding1 = get_face_embedding(image_path1)
    embedding2 = get_face_embedding(image_path2)
    if embedding1 is None or embedding2 is None:
        print(json.dumps({"status": False, "message": "Face not detected in one or both images"}))
        sys.exit(1)
    matched = compare_embeddings(embedding1, embedding2)
    if matched:
        print(json.dumps({"status": True, "message": "Faces matched"}))
    else:
        print(json.dumps({"status": False, "message": "Faces did not match"}))

# generate_embedding.py
import sys
import face_recognition
import json

def get_face_embedding(image_path):
    image = face_recognition.load_image_file(image_path)
    face_locations = face_recognition.face_locations(image)
    if len(face_locations) == 0:
        return {"status": False, "message": "No face detected"}
    face_encodings = face_recognition.face_encodings(image, face_locations)
    if len(face_encodings) == 0:
        return {"status": False, "message": "No face encoding found"}
    # Giả sử chỉ có một khuôn mặt
    embedding = face_encodings[0].tolist()
    return {"status": True, "embedding": embedding}

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print(json.dumps({"status": False, "message": "Invalid arguments"}))
        sys.exit(1)
    image_path = sys.argv[1]
    result = get_face_embedding(image_path)
    print(json.dumps(result))

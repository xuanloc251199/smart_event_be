import pandas as pd
from surprise import SVD
from surprise import Dataset, Reader
from surprise.model_selection import train_test_split
from surprise import accuracy

# Load User-Event Interaction Matrix
df = pd.read_csv('user_event_matrix.csv')

# Chuẩn bị dữ liệu
reader = Reader(rating_scale=(0, 2))
data = Dataset.load_from_df(df[['user_id', 'event_id', 'interaction_score']], reader)

# Chia dữ liệu huấn luyện và kiểm thử
trainset, testset = train_test_split(data, test_size=0.2)

# Huấn luyện mô hình SVD
model = SVD()
model.fit(trainset)

# Dự đoán và đánh giá
predictions = model.test(testset)
accuracy.rmse(predictions)

# Lưu mô hình
import pickle
with open('recommendation_model.pkl', 'wb') as f:
    pickle.dump(model, f)

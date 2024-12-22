import pandas as pd
from sklearn.neighbors import NearestNeighbors

# Đọc dữ liệu từ CSV
df = pd.read_csv('storage/app/public/datasets/user_event_matrix.csv')

# Tạo ma trận tương tác
user_event_matrix = df.pivot(index='user_id', columns='event_id', values='interaction_score').fillna(0)

# Huấn luyện mô hình KNN
model_knn = NearestNeighbors(metric='cosine', algorithm='brute')
model_knn.fit(user_event_matrix)

# Gợi ý sự kiện cho từng user
recommendations = []

for user_id in user_event_matrix.index:
    distances, indices = model_knn.kneighbors(user_event_matrix.loc[user_id].values.reshape(1, -1), n_neighbors=5)
    recommended_events = user_event_matrix.columns[indices.flatten()].tolist()

    recommendations.append({'user_id': user_id, 'recommended_events': recommended_events})

# Lưu kết quả gợi ý vào file CSV
recommendations_df = pd.DataFrame(recommendations)
recommendations_df.to_csv('storage/app/public/datasets/recommendations.csv', index=False)

print("Model training completed and recommendations saved!")

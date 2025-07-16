import os
import pandas as pd
import joblib
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.pipeline import Pipeline
from datetime import datetime

# Path
DATASET_FILE = 'C:/xampp/htdocs/startup-flow/assets/dataset/activity_log.csv'
MODEL_FILE = 'C:/xampp/htdocs/startup-flow/assets/dataset/activity_classifier.pkl'
LOG_FILE = 'C:/xampp/htdocs/startup-flow/assets/report/train_model.log'

def log_message(message):
    """Simple logging with timestamp."""
    timestamp = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    print(f"{timestamp}: {message}")
    with open(LOG_FILE, "a", encoding="utf-8") as log:
        log.write(f"{timestamp}: {message}\n")

def train_model():
    """Train the AI classifier from dataset."""
    try:
        if not os.path.exists(DATASET_FILE):
            log_message("❌ Dataset not found. Cannot train model.")
            return

        log_message("🔄 Training AI classifier from dataset...")
        data = pd.read_csv(DATASET_FILE, delimiter="|", encoding="utf-8")

        if "title_keyword" not in data.columns or "status" not in data.columns:
            raise ValueError("Dataset must contain 'title_keyword' and 'status' columns")

        # Train model
        pipeline = Pipeline([
            ('tfidf', TfidfVectorizer()),
            ('clf', MultinomialNB())
        ])
        pipeline.fit(data['title_keyword'], data['status'])
        joblib.dump(pipeline, MODEL_FILE)
        log_message("✅ AI classifier trained and saved successfully.")

    except Exception as e:
        log_message(f"❌ Error during model training: {e}")

if __name__ == "__main__":
    train_model()

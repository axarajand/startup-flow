import csv
import os
import time
from datetime import datetime
import pygetwindow as gw
import pyautogui
import numpy as np
import cv2
from threading import Thread
import sys
import subprocess

# Constants
FLAG_FILE = 'C:/xampp/htdocs/startup-flow/assets/report/status/monitoring.flag'
DATASET_FILE = 'C:/xampp/htdocs/startup-flow/assets/dataset/activity_log.csv'
YOLO_MODEL_PATH = "yolov8n.pt"
LOG_FILE = "C:/xampp/htdocs/startup-flow/assets/report/monitoring.log"

# Load dataset mapping title_keyword -> status
title_to_status = {}

def log_message(message):
    """Log messages for debugging with UTF-8 safe fallback."""
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    safe_message = message.encode('utf-8', errors='ignore').decode('utf-8')  # drop unsupported chars
    print(f"{timestamp}: {safe_message}")  # Tetap tampil di terminal
    with open(LOG_FILE, "a", encoding="utf-8") as log:
        log.write(f"{timestamp}: {safe_message}\n")


def load_dataset():
    """Load dataset from CSV file to map title_keyword to status."""
    if os.path.exists(DATASET_FILE):
        with open(DATASET_FILE, 'r', newline='', encoding='utf-8') as file:
            reader = csv.DictReader(file, delimiter='|')
            for row in reader:
                title_to_status[row['title_keyword'].lower()] = row['status']
        log_message("Dataset loaded successfully.")
    else:
        log_message(f"Dataset file not found at {DATASET_FILE}. Please check the file path.")

def classify_window(window_title):
    """Classify window title based on dataset keywords."""
    window_title_lower = window_title.lower()
    for keyword, status in title_to_status.items():
        if keyword in window_title_lower:
            return status
    return "non-effective"  # Default jika tidak cocok

def monitor_activity(task_id, user_id):
    """Logs user activity to a CSV file."""
    file_name = os.path.join(CSV_DIR, f"activity_{task_id}_{user_id}.csv")
    last_logged_minute = None

    with open(file_name, 'w', newline='') as csvfile:
        fieldnames = ['task_id', 'user_id', 'times', 'activity', 'status']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames, delimiter='|')
        writer.writeheader()

        while os.path.exists(FLAG_FILE):
            try:
                active_window = gw.getActiveWindow()
                window_title = active_window.title if active_window else "Unknown"
                status = classify_window(window_title)
                activity = f"{window_title}"

                current_time = datetime.now()
                current_minute = current_time.strftime('%Y-%m-%d %H:%M')

                if last_logged_minute != current_minute:
                    writer.writerow({
                        'task_id': task_id,
                        'user_id': user_id,
                        'times': current_time.strftime('%Y-%m-%d %H:%M:%S'),
                        'activity': activity,
                        'status': status
                    })
                    csvfile.flush()
                    last_logged_minute = current_minute

                time.sleep(1)
            except Exception as e:
                log_message(f"Error in monitor_activity: {e}")

def record_screen(task_id, user_id):
    """Records the user screen directly to MP4 using FFmpeg."""
    final_file_name = os.path.join(VIDEO_DIR, f"screen_{task_id}_{user_id}.mp4")
    screen_size = pyautogui.size()
    FFMPEG_PATH = "C:/ffmpeg/bin/ffmpeg.exe"

    # Jalankan FFmpeg sebagai proses
    cmd = [
        FFMPEG_PATH,
        '-y',
        '-f', 'rawvideo',
        '-vcodec', 'rawvideo',
        '-pix_fmt', 'bgr24',
        '-s', f"{screen_size.width}x{screen_size.height}",
        '-r', '20',  # 20 FPS
        '-i', '-',  # Input dari stdin
        '-c:v', 'libx264',
        '-pix_fmt', 'yuv420p',
        '-crf', '23',
        '-preset', 'fast',
        final_file_name
    ]

    try:
        log_message(f"Recording screen for task {task_id}, user {user_id} directly to {final_file_name}")

        # Start FFmpeg process
        process = subprocess.Popen(cmd, stdin=subprocess.PIPE)

        while os.path.exists(FLAG_FILE):  # Periksa FLAG_FILE
            img = pyautogui.screenshot()
            frame = cv2.cvtColor(np.array(img), cv2.COLOR_RGB2BGR)
            process.stdin.write(frame.tobytes())
            time.sleep(0.05)  # 20 FPS

        # Close stdin to signal FFmpeg we're done
        process.stdin.close()
        process.wait()

        if process.returncode == 0:
            log_message(f"Video saved directly to MP4: {final_file_name}")
        else:
            log_message(f"FFmpeg failed with return code {process.returncode}")

    except Exception as e:
        log_message(f"Error in record_screen: {e}")
    finally:
        try:
            if process.stdin:
                process.stdin.close()
            process.wait()
        except Exception:
            pass


def start_monitoring(task_id, user_id):
    """Starts monitoring and recording."""
    with open(FLAG_FILE, 'w') as flag_file:
        flag_file.write('running')

    monitor_thread = Thread(target=monitor_activity, args=(task_id, user_id), daemon=True)
    record_thread = Thread(target=record_screen, args=(task_id, user_id), daemon=True)
    monitor_thread.start()
    record_thread.start()
    monitor_thread.join()
    record_thread.join()

def stop_monitoring(task_id, user_id):
    """Stops monitoring and recording."""
    if os.path.exists(FLAG_FILE):
        os.remove(FLAG_FILE)
    log_message("Monitoring stopped.")

if __name__ == "__main__":
    if len(sys.argv) < 6:
        print("Usage: python3 monitoring.py <command> <task_id> <user_id> <leader_id> <project_id>")
        sys.exit(1)

    command = sys.argv[1]
    task_id = sys.argv[2]
    user_id = sys.argv[3]
    leader_id = sys.argv[4]
    project_id = sys.argv[5]

    # ⛳ Pindahkan definisi folder SETELAH variabel leader_id & project_id tersedia
    FOLDER_NAME = f"{leader_id}_{project_id}"
    CSV_DIR = os.path.join("C:/xampp/htdocs/startup-flow/assets/report/csv", FOLDER_NAME)
    VIDEO_DIR = os.path.join("C:/xampp/htdocs/startup-flow/assets/report/video", FOLDER_NAME)

    # Buat folder jika belum ada
    os.makedirs(CSV_DIR, exist_ok=True)
    os.makedirs(VIDEO_DIR, exist_ok=True)

    load_dataset()

    if command == "start":
        log_message("Starting monitoring...")
        start_monitoring(task_id, user_id)
    elif command == "stop":
        log_message("Stopping monitoring...")
        stop_monitoring(task_id, user_id)
    else:
        print("Invalid command. Use 'start' or 'stop'.")

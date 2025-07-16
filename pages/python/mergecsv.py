import os
import sys
import pandas as pd
from sqlalchemy import create_engine
import csv
import json

def merge_csv_files(input_dir, output_file):
    """Menggabungkan semua file CSV dari direktori input."""
    try:
        if not os.path.exists(input_dir):
            return
        csv_files = [f for f in os.listdir(input_dir) if f.endswith('.csv')]
        if not csv_files:
            return
        
        merged_data = pd.DataFrame()
        for csv_file in csv_files:
            file_path = os.path.join(input_dir, csv_file)
            data = pd.read_csv(file_path)
            merged_data = pd.concat([merged_data, data], ignore_index=True)
            
        os.makedirs(os.path.dirname(output_file), exist_ok=True)
        merged_data.to_csv(output_file, index=False, quoting=csv.QUOTE_NONE, escapechar='\\')
    except Exception as e:
        log_error(f"Error di merge_csv_files: {e}")

def export_tb_user_to_csv(project_id, output_file):
    """Mengekspor data user terkait proyek dari database ke CSV."""
    # PENTING: Gunakan user 'webapp' yang baru Anda buat, BUKAN 'root'.
    db_user = "root"
    db_pass = "" # Ganti dengan password yang Anda buat di phpMyAdmin
    db_host = "localhost"
    db_name = "startup-flow"
    
    try:
        engine = create_engine(f"mysql+pymysql://{db_user}:{db_pass}@{db_host}/{db_name}")
        query_get_users = f"SELECT project_users_id FROM tb_project WHERE project_id = {project_id};"
        df_users = pd.read_sql(query_get_users, engine)
        
        if df_users.empty: return
            
        user_list_str = df_users.iloc[0]['project_users_id']
        if not user_list_str: return

        user_ids = json.loads(user_list_str)
        if not user_ids: return
            
        user_ids_str = ','.join(map(str, user_ids))
        query_users = f"SELECT user_id, user_name, user_sph, job_name FROM tb_user LEFT JOIN tb_job ON user_job_id = job_id WHERE user_id IN ({user_ids_str});"
        df = pd.read_sql(query_users, engine)
        
        os.makedirs(os.path.dirname(output_file), exist_ok=True)
        df.to_csv(output_file, index=False, sep='|')
    except Exception as e:
        log_error(f"Error di export_tb_user_to_csv: {e}")

def export_tb_task_to_csv(leader_id, project_id, output_file):
    """Mengekspor data task terkait proyek dari database ke CSV."""
    # PENTING: Gunakan user 'webapp' yang baru Anda buat, BUKAN 'root'.
    db_user = "root"
    db_pass = "" # Ganti dengan password yang Anda buat di phpMyAdmin
    db_host = "localhost"
    db_name = "startup-flow"

    try:
        engine = create_engine(f"mysql+pymysql://{db_user}:{db_pass}@{db_host}/{db_name}")
        query = f"SELECT task_id, task_name, task_description, user_name, task_deadline_start, task_deadline_end, task_record FROM tb_task LEFT JOIN tb_user ON task_user_id = user_id WHERE user_leader_id = {leader_id} AND task_project_id = {project_id};"
        df = pd.read_sql(query, engine)
        
        os.makedirs(os.path.dirname(output_file), exist_ok=True)
        df.to_csv(output_file, index=False, sep='|')
    except Exception as e:
        log_error(f"Error di export_tb_task_to_csv: {e}")

def log_error(message):
    """Fungsi untuk menulis error ke file log dan keluar."""
    with open("C:/xampp/htdocs/startup-flow/python/py_error_log.txt", "a") as f:
        f.write(f"{message}\n")
    sys.exit(1)

# --- SCRIPT UTAMA ---
if __name__ == "__main__":
    if len(sys.argv) < 3:
        log_error("Error: Argumen leader_id dan project_id tidak diterima.")

    leader_id = sys.argv[1]
    project_id = sys.argv[2]

    # Hapus file log lama untuk sesi baru
    log_path = "C:/xampp/htdocs/startup-flow/assets/report/py_error_log.txt"
    if os.path.exists(log_path):
        os.remove(log_path)

    # Definisikan path file
    input_dir = os.path.join(r"C:\xampp\htdocs\startup-flow\assets\report\csv", f"{leader_id}_{project_id}")
    output_dir = os.path.join(r"C:\xampp\htdocs\startup-flow\assets\report\csv\merge", f"{leader_id}_{project_id}")
    merge_output_file = os.path.join(output_dir, f"mergecsv_{leader_id}_{project_id}.csv")
    user_output_file = os.path.join(output_dir, f"tb_user_{leader_id}_{project_id}.csv")
    task_output_file = os.path.join(output_dir, f"tb_task_{leader_id}_{project_id}.csv")
    
    # Panggil semua fungsi
    merge_csv_files(input_dir, merge_output_file)
    export_tb_user_to_csv(project_id, user_output_file)
    export_tb_task_to_csv(leader_id, project_id, task_output_file)
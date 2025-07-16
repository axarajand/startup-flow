import pandas as pd
import sys
import os

# Ambil leader_id dan project_id dari argumen
if len(sys.argv) < 3:
    print("Error: Parameter tidak lengkap (leader_id & project_id).")
    sys.exit(1)

leader_id = sys.argv[1]
project_id = sys.argv[2]

# Path ke folder sumber dan tujuan
source_folder = os.path.join(
    r"C:\xampp\htdocs\startup-flow\assets\report\csv\merge",
    f"{leader_id}_{project_id}"
)
destination_folder = os.path.join(
    r"C:\xampp\htdocs\startup-flow\assets\report\csv\report_users",
    f"{leader_id}_{project_id}"
)

# Buat folder tujuan jika belum ada
os.makedirs(destination_folder, exist_ok=True)

# Baca data dari file CSV
data = pd.read_csv(os.path.join(source_folder, f'mergecsv_{leader_id}_{project_id}.csv'), sep='|')
tb_user = pd.read_csv(os.path.join(source_folder, f'tb_user_{leader_id}_{project_id}.csv'), sep='|')
tb_task = pd.read_csv(os.path.join(source_folder, f'tb_task_{leader_id}_{project_id}.csv'), sep='|')

# Parsing kolom 'times' menjadi datetime (format ISO bawaan MySQL)
data['times'] = pd.to_datetime(data['times'], format='%Y-%m-%d %H:%M:%S')

# Urutkan data berdasarkan user_id, task_id, dan times
data = data.sort_values(by=['user_id', 'task_id', 'times'])

# Pastikan nilai status lowercase jika perlu
data['status'] = data['status'].astype(str).str.lower()

# Tandai baris efektif
data['is_effective'] = data['status'] == 'effective'

# Hitung durasi antar aktivitas per user_id + task_id
data['duration'] = data.groupby(['user_id', 'task_id'])['times'].diff().dt.total_seconds() / 3600
data['duration'] = data['duration'].fillna(0)
data['duration'] = data['duration'].apply(lambda x: max(x, 0))  # Tidak boleh negatif

# Gabungkan data aktivitas dengan task (untuk user_name & deadline)
tb_task['task_deadline_end'] = pd.to_datetime(tb_task['task_deadline_end'])
data = pd.merge(data, tb_task[['task_id', 'user_name', 'task_deadline_end']],
                on='task_id', how='left')

# Hitung apakah aktivitas terjadi setelah deadline
data['is_late'] = data['times'] > data['task_deadline_end']

# Grupkan data berdasarkan user_id untuk perhitungan total jam
summary = data.groupby('user_id').agg(
    total_effective_hours=('duration', lambda x: x[data.loc[x.index, 'is_effective']].sum()),
    total_non_effective_hours=('duration', lambda x: x[~data.loc[x.index, 'is_effective']].sum()),
    total_late_hours=('duration', lambda x: x[data.loc[x.index, 'is_late']].sum())
).reset_index()

# Gabungkan dengan tb_user untuk info user
summary = pd.merge(summary, tb_user[['user_id', 'user_name', 'user_sph']], on='user_id', how='left')

# Tambahkan informasi jumlah tugas
completed_tasks = tb_task[tb_task['task_record'] == 'done'].groupby('user_name').size().reset_index(name='completed_tasks')
pending_tasks = tb_task[tb_task['task_record'] != 'done'].groupby('user_name').size().reset_index(name='pending_tasks')

summary = pd.merge(summary, completed_tasks, on='user_name', how='left').fillna(0)
summary = pd.merge(summary, pending_tasks, on='user_name', how='left').fillna(0)

# Hitung total_tasks
summary['total_tasks'] = summary['completed_tasks'] + summary['pending_tasks']

# Atur urutan dan tipe kolom
summary = summary[[
    'user_id', 'user_name', 'user_sph',
    'total_effective_hours', 'total_non_effective_hours', 'total_late_hours',
    'total_tasks', 'completed_tasks', 'pending_tasks'
]]

# Bulatkan jam ke angka bulat
summary['total_effective_hours'] = summary['total_effective_hours'].round().astype(int)
summary['total_non_effective_hours'] = summary['total_non_effective_hours'].round().astype(int)
summary['total_late_hours'] = summary['total_late_hours'].round().astype(int)

# Simpan ke file CSV
output_file = os.path.join(destination_folder, f'report_users_{leader_id}_{project_id}.csv')
summary.to_csv(output_file, sep='|', index=False)

# Tampilkan hasil akhir
print(summary)
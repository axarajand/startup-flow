import pygetwindow as gw
import time
import csv
from datetime import datetime
import os


def log_active_window_titles(csv_file):
    """
    Mencatat semua aktivitas jendela aktif ke dalam file CSV dengan format:
    title_keyword|null
    """
    print(f"Memantau jendela aktif... (Data akan disimpan di {csv_file})")
    print("Tekan Ctrl+C untuk berhenti.\n")

    # Header untuk file CSV
    fieldnames = ['title_keyword', 'status']

    # Membaca file CSV yang sudah ada (jika ada)
    existing_titles = set()
    if os.path.exists(csv_file):
        with open(csv_file, mode='r', newline='', encoding='utf-8') as file:
            reader = csv.DictReader(file, delimiter='|')
            for row in reader:
                existing_titles.add(row['title_keyword'])

    try:
        # Buka file CSV untuk menulis (append mode)
        with open(csv_file, mode='a', newline='', encoding='utf-8') as file:
            writer = csv.DictWriter(file, fieldnames=fieldnames, delimiter='|')

            # Jika file kosong, tulis header
            if file.tell() == 0:
                writer.writeheader()

            while True:
                # Ambil jendela aktif
                active_window = gw.getActiveWindow()
                if active_window:
                    title_keyword = active_window.title

                    # Cek jika jendela sudah ada di file CSV (cek di existing_titles)
                    if title_keyword not in existing_titles:
                        # Tulis data baru ke CSV dengan status "null"
                        writer.writerow({
                            'title_keyword': title_keyword,
                            'status': 'null'
                        })

                        # Tambahkan ke set agar tidak ditulis lagi di sesi berikutnya
                        existing_titles.add(title_keyword)

                        # Tampilkan informasi ke terminal
                        print(f"{datetime.now()}: {title_keyword} | null")
                    else:
                        print(f"{datetime.now()}: {title_keyword} sudah tercatat.")
                else:
                    print(f"{datetime.now()}: Tidak ada jendela aktif.")

                time.sleep(1)  # Perbarui setiap detik
    except KeyboardInterrupt:
        print("\nBerhenti memantau jendela aktif.")
    except Exception as e:
        print(f"Terjadi kesalahan: {e}")


if __name__ == "__main__":
    # Direktori tempat file CSV akan disimpan
    output_dir = r"C:\xampp\htdocs\startup-flow\assets\dataset"
    os.makedirs(output_dir, exist_ok=True)  # Buat direktori jika belum ada

    # Nama file CSV
    csv_file_path = os.path.join(output_dir, "activity_log.csv")
    log_active_window_titles(csv_file_path)
# Sistem Penjadwalan Pelajaran Adaptif (Laravel 12)

Starter project untuk **Hybrid Constraint Optimization**, optimasi multi-kriteria, deteksi konflik, dan dynamic rescheduling. Project ini berisi source aplikasi; folder `vendor` tidak disertakan sehingga Composer perlu dijalankan terlebih dahulu.

## Fitur
- Login admin dan guru (role-based access).
- Dashboard statistik dasar.
- Data contoh guru, kelas, mata pelajaran, ruangan, jam, dan penugasan.
- Generator jadwal greedy berbasis kendala keras dan skor berbobot.
- Deteksi konflik guru/kelas/ruangan, jam istirahat, kapasitas, dan jenis ruangan.
- Pengaturan bobot multi-kriteria dengan total 100%.
- Kalender mingguan FullCalendar.
- Kunci jadwal dan dynamic rescheduling dengan log alasan serta skor lama/baru.

> Catatan: ini adalah starter implementasi yang dapat dikembangkan. CRUD lengkap seluruh master data, notifikasi real-time, constraint hari libur/tanggal khusus, dan algoritma pencarian lanjutan seperti simulated annealing belum disertakan sebagai modul siap produksi.

## Kebutuhan
- PHP 8.2 atau lebih baru
- Composer 2
- MySQL/MariaDB
- Node.js hanya diperlukan bila Anda menambahkan asset frontend sendiri; tampilan starter menggunakan CDN.

## Instalasi Windows
1. Ekstrak ZIP ke folder, misalnya `C:\laragon\www\adaptive-scheduler`.
2. Buka terminal pada folder proyek.
3. Pastikan PHP 8.2+ dan Composer tersedia, lalu jalankan `composer install`.
4. Salin `.env.example` menjadi `.env`.
5. Buat database MySQL bernama `adaptive_scheduler`.
6. Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env`.
7. Jalankan `php artisan key:generate`.
8. Jalankan `php artisan migrate --seed`.
9. Jalankan `php artisan serve`.
10. Buka `http://127.0.0.1:8000`.

## Akun demo
- Admin: `admin@school.test` / `password`
- Guru: `guru@school.test` / `password`

Ganti password demo sebelum aplikasi dipakai sungguhan.

## Cara menggunakan
1. Login sebagai admin.
2. Buka **Bobot Optimasi** dan pastikan total bobot = 100.
3. Buka **Jadwal** lalu klik **Generate Jadwal**.
4. Periksa **Konflik** dan tampilan **Kalender**.
5. Gunakan tombol **Kunci** untuk menjaga jadwal tertentu tetap.
6. Gunakan **Reschedule** untuk mencari slot lain yang memenuhi kendala. Alasan perubahan tersimpan pada tabel `rescheduling_logs`.

## Konsep algoritma
1. Jadwal yang tidak terkunci dihapus sebelum proses generator dimulai.
2. Penugasan diurutkan dengan prioritas pada kebutuhan ruang khusus dan jumlah jam.
3. Kandidat slot yang melanggar hard constraints dibuang.
4. Kandidat yang tersisa diberi skor berbobot: preferensi guru, distribusi, kecocokan jam, utilisasi ruang, dan stabilitas.
5. Kandidat dengan skor tertinggi dipilih. Jika tidak ada kandidat, sesi dicatat sebagai belum terjadwal.
6. Dynamic rescheduling menerapkan pemeriksaan kendala yang sama dan mencatat perubahan.

## Batasan yang perlu diketahui
- Penjadwalan ini adalah heuristik greedy, bukan solver matematis global; hasilnya layak tetapi belum tentu optimum global.
- `teacher_preference` menggunakan daftar ID periode (`preferred_periods`) bila diisi.
- Login guru sudah tersedia, tetapi halaman saat ini masih menampilkan jadwal umum; filter khusus jadwal guru dapat ditambahkan berikutnya.
- Untuk produksi, tambahkan CRUD master data, audit trail, otorisasi lebih rinci, backup, pengujian, dan konfigurasi email/notifikasi.

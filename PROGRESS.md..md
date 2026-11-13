# LAPORAN KEMAJUAN PROYEK APLIKASI WEB

> **Ketentuan:** File ini berada di folder utama (*root*) repository dan diperbarui setiap Jumat. Tuliskan laporan minggu terbaru paling atas. **Jangan menghapus laporan minggu-minggu sebelumnya.** Jika fitur belum selesai atau masih error, tetap laporkan secara jujur dan sertakan bukti teknis yang aman untuk dibagikan.

## Identitas Proyek

| Keterangan | Proses Pengembangan |
|---|---|
| Nama mahasiswa / tim | [Yusril Hamdi Lubis] |
| Nama aplikasi | Pengembangan dan Evaluasi Algoritma Hybrid CP-SAT–Genetic Algorithm untuk Penjadwalan Pelajaran Multiobjektif dan Penjadwalan Ulang Adaptif di Sekolah. |
| Repository GitHub | [https://github.com/yusrilhamdi2026-gif/Adaptive-Scheduler.git] |
| Branch yang direview | [main] |
| Status umum proyek | Dalam proses |
| Terakhir diperbarui | 2026-11-13 |

## Ringkasan Kemajuan Saat Ini

- Fitur utama yang menjadi fokus pengembangan adalah pengelolaan data penjadwalan, validasi input, penerapan constraint, dan penyempurnaan algoritma greedy.
- Fitur yang masih dikerjakan meliputi penyelesaian CRUD untuk seluruh data yang dibutuhkan sistem, validasi data pada setiap proses penyimpanan/perubahan, penerapan constraint agar jadwal tidak bentrok, serta perbaikan algoritma greedy untuk menghasilkan jadwal yang lebih sesuai dengan kriteria.
- Kendala utama saat ini adalah memastikan seluruh proses CRUD terhubung dengan database secara konsisten dan algoritma greedy dapat menghasilkan jadwal tanpa melanggar constraint.
- Tautan PR aktif: Belum ada / [tempel URL PR jika tersedia].

---

## Riwayat Laporan Mingguan (terbaru di atas)

### Minggu ke-[2] — 2026-11-09 s.d. 2026-11-13

**Tanggal pembaruan:** 2026-11-13  
**Branch:** `[main]`  
**Commit terakhir:** `[https://github.com/yusrilhamdi2026-gif/Adaptive-Scheduler/commits?author=yusrilhamdi2026-gif]`  
**Pull Request:** Belum ada

#### 1. Target minggu ini

- [ ] Melengkapi fungsi CRUD (Create, Read, Update, Delete) pada seluruh modul data yang digunakan dalam sistem penjadwalan.
- [ ] Menambahkan dan menyempurnakan validasi data untuk mencegah input kosong, format yang tidak sesuai, serta data duplikat atau tidak konsisten.
- [ ] Menerapkan constraint penjadwalan, termasuk pemeriksaan bentrok guru, kelas, mata pelajaran, dan slot waktu.
- [ ] Memperbaiki algoritma greedy agar proses pembentukan jadwal mempertimbangkan constraint dan prioritas/kriteria yang telah ditentukan.

#### 2. Pekerjaan yang sudah selesai

- [x] Menentukan fokus pengembangan minggu ini, yaitu penyelesaian CRUD, validasi data, constraint, dan perbaikan algoritma greedy.
- [ ] Melengkapi CRUD pada modul data guru, mata pelajaran, kelas, ruang, dan data penugasan mengajar.
- [ ] Menambahkan validasi pada proses tambah dan ubah data serta penanganan ketika data tidak memenuhi aturan.
- [ ] Menambahkan pemeriksaan constraint untuk mencegah bentrok jadwal.
- [ ] Menyempurnakan algoritma greedy dan melakukan pengujian terhadap hasil jadwal.

> Catatan: Centang pekerjaan sebagai selesai hanya setelah implementasi benar-benar dilakukan dan hasilnya sudah diverifikasi.

#### 3. Pekerjaan yang belum selesai / masih error

| Fitur / pekerjaan | Kondisi saat ini | Kendala atau pesan error ringkas | Upaya yang sudah dicoba | Bantuan yang dibutuhkan |
|---|---|---|---|---|
| CRUD seluruh data | Dalam proses / perlu diverifikasi | Belum ada bukti pengujian untuk seluruh operasi tambah, tampil, ubah, dan hapus | Memeriksa route, controller, model, migration, dan tampilan form | Review keterhubungan setiap modul CRUD dengan database |
| Validasi data | Dalam proses | Aturan validasi tiap field dan penanganan pesan kesalahan perlu dipastikan | Menyusun aturan validasi sesuai tipe dan kebutuhan data | Review aturan validasi dan kasus input tidak valid |
| Constraint penjadwalan | Dalam proses | Seluruh kondisi bentrok perlu diperiksa sebelum jadwal disimpan | Mengidentifikasi constraint guru, kelas, mata pelajaran, dan slot waktu | Review aturan constraint wajib dan aturan preferensi |
| Algoritma greedy | Dalam proses | Perlu dipastikan pemilihan slot tidak menghasilkan konflik dan hasilnya memenuhi kebutuhan jadwal | Meninjau urutan pemilihan data/slot dan pemeriksaan constraint | Masukan mengenai strategi pemilihan prioritas dan penanganan ketika tidak ada slot yang sesuai |

#### 4. Hasil pengujian

| Pengujian | Hasil | Bukti / catatan |
|---|---|---|
| Pengujian CRUD (tambah, tampil, ubah, hapus) | BELUM DIUJI / perlu dilengkapi | Catat hasil pengujian setiap modul setelah dijalankan |
| Pengujian validasi input kosong dan format tidak sesuai | BELUM DIUJI | Siapkan contoh input valid dan tidak valid |
| Pengujian constraint bentrok guru, kelas, dan slot waktu | BELUM DIUJI | Pastikan sistem menolak jadwal yang melanggar constraint |
| Pengujian algoritma greedy | BELUM DIUJI | Periksa apakah jadwal yang dihasilkan bebas konflik dan memenuhi kebutuhan jam |
| `php artisan test` | BELUM DIUJI | Jalankan pengujian otomatis dan lampirkan ringkasan hasil |

#### 5. Tindak lanjut review dosen sebelumnya

- [ ] Menindaklanjuti masukan terkait kelengkapan CRUD dan memastikan setiap modul memiliki fungsi tambah, tampil, ubah, dan hapus.
- [ ] Memastikan validasi dilakukan di sisi server, bukan hanya melalui tampilan form.
- [ ] Memastikan constraint diterapkan sebelum jadwal disimpan agar data jadwal yang bentrok tidak masuk ke database.
- [ ] Memperbaiki algoritma greedy berdasarkan hasil pengujian dan masukan dosen.
- [ ] Mencatat tautan commit, Pull Request, atau GitHub Issue sebagai bukti tindak lanjut.

#### 6. Rencana lima hari kerja berikutnya

| Prioritas | Tugas | Kriteria selesai |
|---|---|---|
| P0 | Menyelesaikan dan memeriksa CRUD seluruh modul data | Setiap modul dapat melakukan tambah, tampil, ubah, dan hapus; perubahan tersimpan di database |
| P0 | Melengkapi validasi data | Input tidak valid ditolak dan pesan kesalahan ditampilkan dengan jelas |
| P0 | Menerapkan constraint penjadwalan | Sistem dapat mendeteksi dan menolak bentrok guru, kelas, serta slot waktu |
| P1 | Memperbaiki algoritma greedy | Algoritma memilih slot berdasarkan prioritas dan tidak menghasilkan jadwal yang melanggar constraint wajib |
| P1 | Melakukan pengujian terpadu | Skenario CRUD, validasi, constraint, dan greedy dijalankan serta hasilnya dicatat |
| P2 | Merapikan dokumentasi dan bukti progres | README, tangkapan layar pengujian, commit, dan PR diperbarui |

#### 7. Pertanyaan untuk dosen

- Apakah constraint bentrok guru, kelas, dan slot waktu sudah cukup sebagai constraint wajib, atau terdapat constraint lain yang harus diterapkan?
- Apakah algoritma greedy sebaiknya memprioritaskan constraint wajib terlebih dahulu, kemudian mengoptimalkan kriteria preferensi?
- Apakah hasil pengujian perlu menyertakan perbandingan jadwal sebelum dan sesudah perbaikan algoritma?

---

<!-- Tambahkan laporan minggu berikutnya DI ATAS laporan minggu sebelumnya. Pertahankan catatan lama sebagai riwayat. Umpan balik dosen dicatat melalui komentar PR atau GitHub Issue. -->

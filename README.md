# Aplikasi Sederhanan Manajemen Arsip Data Siswa

Aplikasi ini terdiri dari 2 bagian ARDIS dan ARDOS.

## ARDIS
Arsip Digital Siswa (ARDIS) adalah aplikasi sederhana untuk mengelola data administrasi siswa secara digital. Dilengkapi dengan beberapa fitur, antara lain:

- Import data siswa (format *.CSV)
- Upload data administrasi siswa berupa:
    - Kartu Keluarga
    - KTP Ayah
    - KTP Ibu
    - KIP / KPS
    - SKTM (Surat Keterangan Tidak Mampu)
    - Ijazah
    - SKHUN
- Rekap kelengkapan data siswa berdasarkan kelas, jurusan dan status kelengkapan data
- Arsip siswa berdasarkan status siswa yang tidak aktif
- Cetak detail siswa
- Multiuser
- Ajax search pada homepage
- Fitur search, filter, pagging dan show perpage pada halaman list data
- Notifikasi error input berbahsa Indonesia
- Reset password oleh admin (password default setelah reset: mberu3)
- Ubah nama dan password
- Responsif

## ARDOS
Arsip Dokumen Siswa (ARDOS) adalah aplikasi sederhana untuk mengelola arsip / penempatan lokasi dokumen data siswa. Dilengkapi dengan beberapa fitur, antara lain:

- Menggunakan database yang sama dengan ARDIS
- Cek list kelengkapan data:
    - Kartu Keluarga
    - KTP Ayah
    - KTP Ibu
    - KIP / KPS
    - SKTM (Surat Keterangan Tidak Mampu)
    - Ijazah
    - SKHUN
- Lokasi dokumen berdasarkan lemari, bendel, map serta kode map
- Otomatis mengubah status siswa menjadi tidak serta mengarsipkan data siswa jika dokumen siswa diambil karena lulus/keluar
- Pinjam dan kembalikan ijazah
- Rekap jumlah data pinjman (ijazah dan skhun)
- Multiuser
- Ajax search pada homepage
- Fitur search, filter, pagging dan show perpage pada halaman list data
- Notifikasi error input berbahsa Indonesia
- Responsif

Kedua Aplikasi ini dibuat menggunakan CodeIgniter versi 3.1.5, bootstrap, jquery datatables serta menggunakan environtment php 7.

### Konfigurasi
Untuk menggunakan kedua aplikasi ini, silakan setting databasenya terlebih dahulu.
Silakan buka folder **application** -> **config** lalu ubah file **database.php** dan sesuaikan nama hostname, username, password serta database dengan yang Anda gunakan.

---

Ini adalah source code dari artikel https://masrud.com/aplikasi-arsip-digital-codeigniter/

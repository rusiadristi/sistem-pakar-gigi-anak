# Sistem Pakar Gigi Anak

Sistem Pakar Diagnosa Penyakit Gigi Pada Anak berbasis PHP dan MySQL dengan Metode Forward Chaining (Studi Kasus: Praktek Mandiri Drg. Rusi Adristi, Padang).

## Requirement

Pastikan sudah terinstall:

* Git
* Web Server (Apache / XAMPP)
* PHP (v7.4 atau v8.x)
* MySQL / MariaDB
* Web Browser modern (Google Chrome, Microsoft Edge, Mozilla Firefox)

Cek Git:

```bash
git --version
```

Cek PHP:

```bash
php -v
```

## Instalasi

Clone repository:

```bash
git clone https://github.com/rusiadristi/sistem-pakar-gigi-anak.git
cd sistem-pakar-gigi-anak
```

Pindahkan atau clone folder project ke dalam direktori web server (`htdocs`):

```bash
# Contoh direktori pada XAMPP Windows:
C:\xampp\htdocs\pakar
```

## Konfigurasi Database

1. Buka XAMPP Control Panel dan aktifkan modul **Apache** dan **MySQL**.
2. Akses phpMyAdmin melalui browser:

```text
http://localhost/phpmyadmin
```

3. Buat database baru dengan nama:

```text
pakar
```

4. Import file database `pakar.sql` yang tersedia di dalam repository ini ke database `pakar`.
5. Pastikan konfigurasi koneksi pada file `koneksi.php` sudah sesuai:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "pakar";
$koneksi = mysqli_connect($host, $username, $password, $database);
```

## Menjalankan Aplikasi

Pastikan service Apache dan MySQL pada XAMPP sudah berjalan, kemudian buka URL berikut di browser:

```text
http://localhost/pakar/
```

## Akun Pengujian (Default)

Untuk keperluan pengujian sistem:

* **Administrator (Akses Penuh):**
  * Username: `admin`
  * Password: `admin`
  * Level: Administrator

* **Pasien / Member:**
  * Username: `riza`
  * Password: `1234`
  * Level: Pasien
  * *Atau gunakan menu **Registrasi** untuk mendaftarkan akun pasien baru.*

## Fitur Utama Sistem

* **Konsultasi Mandiri Diagnosa Gigi Anak:** Kuesioner pertanyaan gejala klinis interaktif dengan perhitungan inferensi Forward Chaining.
* **Hasil Diagnosa & Solusi:** Deteksi penyakit gigi, ringkasan gejala yang dialami, dan saran tindakan medis/perawatan.
* **Cetak Hasil Diagnosa (PDF):** Cetak surat rekomendasi resmi dengan Kop Surat Praktek Mandiri Drg. Rusi Adristi dan kolom tanda tangan dokter.
* **Informasi & Edukasi Kesehatan:** Penjelasan penyakit gigi pada anak (karies, pulpitis, gigi sensitif) serta panduan perawatan untuk orang tua.
* **Galeri Klinis:** Galeri edukatif visual anatomi gigi dan kesehatan mulut.
* **Panel Administrator:**
  * Kelola Data Penyakit & Gejala
  * Kelola Basis Aturan (Rule)
  * Kelola Data Member / Pasien
  * Kelola Kritik & Saran Masukan
  * Rekapitulasi & Cetak Laporan Konsultasi Pasien

> Pastikan database `pakar.sql` telah di-import sebelum menjalankan konsultasi.


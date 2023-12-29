# Pemesanan Taxi Online - README

Ini adalah aplikasi sederhana untuk pemesanan taksi online yang dibangun menggunakan bahasa pemrograman PHP dan HTML. Aplikasi ini memungkinkan pengguna untuk memesan taksi online dengan mengisi formulir pemesanan yang mencakup data pelanggan, jenis kendaraan yang dipilih, dan jarak tempuh.

## Struktur Source Code

1. `index.php`: Ini adalah file utama yang berisi kode HTML dan PHP untuk membuat tampilan halaman pemesanan taksi online. Berikut adalah beberapa poin penting dalam file ini:
   - Mendefinisikan variabel `$kendaraan` yang berisi jenis-jenis kendaraan yang tersedia.
   - Menggunakan fungsi `sort()` untuk mengurutkan array `$kendaraan` secara ascending.
   - Membuat fungsi `hitung_sewa()` untuk menghitung biaya sewa taksi berdasarkan biaya platform, jarak tempuh, dan biaya per kilometer.

2. `bootstrap.css`: File CSS yang digunakan untuk mengatur tampilan antarmuka aplikasi dengan menggunakan framework Bootstrap.

3. `logo.jpg`: Gambar logo taksi online yang ditampilkan di halaman pemesanan.

4. `data.json`: File JSON yang digunakan untuk menyimpan data pemesanan yang telah dilakukan oleh pengguna.

## Penggunaan

1. Buka halaman `index.php` menggunakan server web yang mendukung PHP (seperti XAMPP atau WAMP).

2. Di halaman utama, pengguna diminta untuk mengisi formulir pemesanan yang mencakup nama pelanggan, nomor HP, jenis kendaraan, dan jarak tempuh.

3. Setelah mengisi formulir, pengguna dapat menekan tombol "Pesan" untuk mengirimkan data pemesanan.

4. Aplikasi akan menghitung biaya sewa berdasarkan jenis kendaraan, jarak tempuh, dan biaya per kilometer. Data pemesanan dan total biaya akan ditampilkan di bawah formulir.

5. Data pemesanan juga akan disimpan dalam file `data.json` dalam format JSON untuk catatan dan manajemen pemesanan.

## Catatan

- Pastikan Anda memiliki server web yang mendukung PHP untuk menjalankan aplikasi ini.
- Anda dapat mengganti tampilan antarmuka dengan mengubah file `bootstrap.css`.
- Aplikasi ini hanya bersifat demonstratif dan dapat ditingkatkan lebih lanjut dengan fitur-fitur tambahan seperti validasi input, manajemen pemesanan lebih lanjut, dan lain-lain.


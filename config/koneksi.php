<?php

// Mendefinisikan variabel untuk menyimpan informasi koneksi ke database
$host = 'localhost'; // Alamat server database, 'localhost' berarti database berada di komputer yang sama
$username = 'root'; // Nama pengguna untuk mengakses database
$password = ''; // Kata sandi untuk pengguna database (kosong berarti tidak ada kata sandi)
$database = 'peliharaan'; // Nama database yang akan diakses

// Menghubungkan ke database menggunakan fungsi mysqli_connect
$db = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi ke database berhasil
if (!$db) {
  // Jika koneksi gagal, tampilkan pesan kesalahan dan hentikan eksekusi program
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Kode di atas berhasil menghubungkan ke database jika tidak ada kesalahan
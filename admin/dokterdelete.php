<?php


session_start(); // Memulai sesi untuk menyimpan informasi pengguna

// Fungsi untuk mengalihkan halaman dengan pesan alert
function redirectWithAlert($message, $location)
{
    // Mengamankan pesan dari karakter khusus untuk mencegah XSS
    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    // Menggunakan JavaScript untuk menampilkan alert dan mengalihkan pengguna
    echo "<script>
    alert('$safeMessage');
    document.location.href = '$location';
    </script>";
    exit; // Menghentikan eksekusi skrip setelah pengalihan
}

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    redirectWithAlert('Silahkan login terlebih dahulu!', '../login/login.php'); // Jika belum login, alihkan ke halaman login
}

// Memeriksa apakah level pengguna adalah 'Admin', 'Operator', atau 'Guru'
if (!in_array($_SESSION["role"], ['admin'])) {
    redirectWithAlert('Anda harus login sebagai Admin atau Dokter!', '../admin/dashboard.php'); // Jika tidak, alihkan ke dashboard
}

include '../config/controller.php';

$id = (int)$_GET['id'];

if (delete_dokter($id) > 0) {
    echo "<script>
    alert ('Data Dokter berhasil dihapus');
    document.location.href = 'dokter.php'
    </script>";
} else { "<script>
    alert ('Data Dokter gagal dihapus');
    document.location.href = 'dokter.php'
    </script>";
}


<?php
session_start(); // Memulai sesi untuk menyimpan data pengguna
include "../config/controller.php"; // Mengimpor file konfigurasi yang berisi koneksi ke database

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Memeriksa apakah form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password']; // Password asli yang dimasukkan pengguna

    if (empty($username) || empty($password)) {
        $error = "Username dan password tidak boleh kosong.";
    } else {
        $stmt = $db->prepare("SELECT * FROM users WHERE BINARY username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 1) {
                    // Login berhasil
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: ../admin/dashboard.php");
                    exit;
                } else {
                    $error = "Akun Anda tidak aktif. Silakan hubungi administrator.";
                }
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
        $stmt->close();
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8"> <!-- Menentukan karakter set untuk halaman -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mengatur viewport untuk responsivitas -->
  <title>Login</title> <!-- Judul halaman -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Memasukkan CSS Bootstrap untuk styling -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Memasukkan ikon Font Awesome -->
  <link href="assets/css/signin.css" rel="stylesheet"> <!-- Memasukkan CSS kustom -->
</head>

<body class="text-center"> <!-- Mengatur teks agar berada di tengah -->
  <main class="form-signin"> <!-- Bagian utama untuk form login -->
    <form action="" method="POST"> <!-- Form untuk login dengan metode POST -->
      <img class="mb-4" src="../login/assets/img/logoo.png" alt="" width="70" height="70"> <!-- Logo aplikasi -->
      <h1 class="h3 mb-3 fw-normal">Login User</h1> <!-- Judul form -->
<div class="bg"></div>
      <?php if ($error) : ?> <!-- Menampilkan pesan error jika ada -->
        <div class="alert alert-danger " role="alert">
          <b><?php echo htmlspecialchars($error); ?></b> <!-- Menampilkan pesan error dengan aman -->
        </div>
      <?php endif; ?>

      <div class="form-group mb-3 form-floating"> <!-- Grup input untuk username -->
        <input type="text" class="form-control" id="username" placeholder="username" name="username" required> <!-- Input untuk username -->
        <label for="username">Username</label> <!-- Label untuk input username -->
      </div>

      <div class="form-group mb-3 form-floating position-relative"> <!-- Grup input untuk password -->
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required> <!-- Input untuk password -->
        <label for="password">Password</label> <!-- Label untuk input password -->
        <span id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #007bff;"> <!-- Tombol untuk menampilkan/menyembunyikan password -->
          <i class="fa fa-eye" id="toggleIcon"></i> <!-- Ikon mata untuk toggle password -->
        </span>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button> <!-- Tombol untuk submit form -->
      <p class="mt-5 mb -3 text-muted">&copy; Peliharaan 2024 </p> <!-- Copyright -->
    </form>
  </main>
</body>

<script>
  const togglePassword = document.getElementById('togglePassword'); // Mengambil elemen untuk toggle password
  const passwordInput = document.getElementById('password'); // Mengambil elemen input password
  const toggleIcon = document.getElementById('toggleIcon'); // Mengambil elemen ikon toggle

  togglePassword.addEventListener('click', function() { // Menambahkan event listener untuk klik pada toggle password
    // Mengganti atribut type
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'; // Mengubah tipe input antara 'password' dan 'text'
    passwordInput.setAttribute('type', type); // Mengatur tipe input sesuai dengan toggle

    // Mengganti ikon mata
    toggleIcon.classList.toggle('fa-eye'); // Mengganti ikon mata terbuka
    toggleIcon.classList.toggle('fa-eye-slash'); // Mengganti ikon mata tertutup
  });
</script>

</html>






<!-- CATATAN TAMBAHAN -->

<!--  CATATAN START

Penjelasan Umum:
Sesi dan Koneksi Database: Kode ini memulai sesi untuk menyimpan data pengguna dan mengimpor file konfigurasi yang berisi koneksi ke database.

Validasi dan Autentikasi: Kode memeriksa apakah form login telah disubmit, kemudian memvalidasi input pengguna dan memeriksa keberadaan pengguna di database. Jika pengguna ada, kode memverifikasi password dan status akun.

Pengaturan Sesi: Jika login berhasil, kode mengatur variabel sesi dan mengarahkan pengguna ke dashboard admin.

Form HTML: Form login terdiri dari input untuk username dan password, serta tombol untuk login. Ada juga fitur untuk menampilkan atau menyembunyikan password.

JavaScript: Kode JavaScript digunakan untuk mengubah tampilan password dari tersembunyi menjadi terlihat dan sebaliknya saat ikon diklik.

Dengan penjelasan ini, diharapkan pemula dapat memahami fungsi dan struktur dari kode yang diberikan.

CATATAN END -->
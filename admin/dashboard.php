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
if (!in_array($_SESSION["role"], ['admin', 'dokter', 'owner'])) {
    redirectWithAlert('Anda harus login sebagai Admin atau Operator!', '../admin/dashboard.php'); // Jika tidak, alihkan ke dashboard
}

include '../config/controller.php'; // Menyertakan file controller untuk koneksi database

// Query untuk menghitung jumlah siswa
$querySiswa = "SELECT COUNT(*) AS JumlahPeliharaan FROM pets"; // SQL untuk menghitung total siswa
$resultSiswa = mysqli_query($db, $querySiswa); // Menjalankan query
$jumlahSiswa = ($resultSiswa->num_rows > 0) ? $resultSiswa->fetch_assoc()['JumlahPeliharaan'] : 0; // Mengambil hasil query atau 0 jika tidak ada

$queryKelas = "SELECT COUNT(*) AS JumlahPemilik FROM owners"; // SQL untuk menghitung total kelas
$resultKelas = mysqli_query($db, $queryKelas); // Menjalankan query
$jumlahKelas = ($resultKelas->num_rows > 0) ? $resultKelas->fetch_assoc()['JumlahPemilik'] : 0; // Mengambil hasil query atau 0 jika tidak ada

$queryLakiLaki = "SELECT COUNT(*) AS JumlahDokter FROM vets"; // SQL untuk menghitung jumlah siswa laki-laki
$resultLakiLaki = mysqli_query($db, $queryLakiLaki); // Menjalankan query
$jumlahLakiLaki = ($resultLakiLaki->num_rows > 0) ? $resultLakiLaki->fetch_assoc()['JumlahDokter'] : 0; // Me

$queryPerempuan = "SELECT COUNT(*) AS JumlahCatatan FROM health_records "; // SQL untuk menghitung jumlah siswa perempuan
$resultPerempuan = mysqli_query($db, $queryPerempuan); // Menjalankan query
$jumlahPerempuan = ($resultPerempuan->num_rows > 0) ? $resultPerempuan->fetch_assoc()['JumlahCatatan'] : 0; // Mengambil hasil query atau 0 jika tidak ada


?>





<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Peliharaan - Pengelola Data Peliharaan</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/logo.png" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="../assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="../assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="../assets/css/responsive.css">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
      
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
        <?php include '../admin/template_admin/sidebar.php'; ?>
         <!-- TOP Nav Bar -->
         <?php include '../admin/template_admin/navbar.php'; ?>
         <!-- TOP Nav Bar END -->
          
         <!-- Page Content  -->

   <div id="content-page" class="content-page">
            
            <div class="container-fluid">
               <div class="row content-body">

<!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> <!-- Judul halaman dashboard -->
                  </div>

<!-- Content Row -->
<div class="row">

    <!-- Jumlah Siswa -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2"> <!-- Kartu untuk menampilkan jumlah siswa -->
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Hewan Peliharaan</div> <!-- Label untuk jumlah siswa --> <br>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $jumlahSiswa ?> <!-- Menampilkan jumlah siswa -->
                        </div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-users fa-2x text-gray-300"></i> Ikon untuk jumlah siswa -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Rombel -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2"> <!-- Kartu untuk menampilkan jumlah rombel -->
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Pemilik Hewan</div> <!-- Label untuk jumlah rombel -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <br><br>
                        <?php echo $jumlahKelas ?> <!-- Menampilkan jumlah rombel -->
                        </div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-building fa-2x text-gray-300"></i> Ikon untuk jumlah rombel -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Siswa Laki-Laki -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2"> <!-- Kartu untuk menampilkan jumlah siswa laki-laki -->
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Dokter Hewan</div> <!-- Label untuk jumlah siswa laki-laki -->
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <br><br>
                        <?php echo $jumlahLakiLaki ?> <!-- Menampilkan jumlah siswa laki-laki -->
                        </div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-male fa-2x text-gray-300"></i> Ikon untuk jumlah siswa laki-laki -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Siswa Perempuan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2"> <!-- Kartu untuk menampilkan jumlah siswa perempuan -->
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Catatan Kesehatan</div> <!-- Label untuk jumlah siswa perempuan --> <br>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $jumlahPerempuan ?> <!-- Menampilkan jumlah siswa perempuan -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-female fa-2x text-gray-300"></i> Ikon untuk jumlah siswa perempuan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-1">
            <!-- Prakata -->
            <div class="row">
                <div class="col-lg-6 mb-1">
                    <div class="card card bg-success text-white"> <!-- Kartu untuk menyambut pengguna -->
                        <div class="card-body">
                            Selamat Datang di Aplikasi Pengelolaan Data Hewan Peliharaan <!-- Pesan sambutan -->
                            <div class="dropdown-divider"></div> <!-- Pembatas -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-1">
                    <div class="card bg-light text-dark"> <!-- Kartu untuk menjelaskan aplikasi -->
                        <div class="card-body small">
                            Aplikasi ini digunakan untuk mengelola data: <!-- Penjelasan tentang aplikasi -->
                            <ol>
                                <li>Peliharaan</li> <!-- Item daftar jurusan -->
                                <li>Pemilik Hewan Peliharaan</li> <!-- Item daftar kelas -->
                                <li>Catatan Kesehatan Hewan peliharaan</li> <!-- Item daftar siswa -->
                                <li>Dokter Hewan Peliharaan</li> <!-- Item daftar siswa -->
                            </ol>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
                  
                 
               
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
     
    <?php include '../admin/template_admin/footer.php';?>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan !</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih tombol "Logout" Untuk keluar dari aplikasi.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../login/login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

      <!-- Footer END -->

      <!-- color-customizer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/popper.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="../assets/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="../assets/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="../assets/js/waypoints.min.js"></script>
      <script src="../assets/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="../assets/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="../assets/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="../assets/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="../assets/assets/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="../assets/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="../assets/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="../assets/js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="../assets/js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="../assets/js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="../assets/js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="../assets/js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="../assets/js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="../assets/js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="../assets/js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="../assets/js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="../assets/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="../assets/js/custom.js"></script>
   </body>
</html>
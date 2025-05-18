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
    redirectWithAlert('Anda harus login sebagai Admin atau Owner!', '../admin/dashboard.php'); // Jika tidak, alihkan ke dashboard
}

include '../config/controller.php';


$query = "SELECT * FROM owners";
$result = mysqli_query($db, $query);

//kondisi ketika tombol tambah diklik
if (isset($_GET['id'])) {
$id  = (int)$_GET['id'];
  // Ambil data siswa berdasarkan id_kelas
$dokter = select("SELECT * FROM owners WHERE id=$id")[0];


if (isset($_POST['edit'])) {
    
    if (update_owner($_POST) > 0) {
      echo "<script>
              alert ('Data Pemilik berhasil diubah');
              document.location.href = 'owner.php';
              </script>";
    } else {
      echo "<script>
              alert ('Data Pemilik gagal diubah');
              document.location.href = 'owner.php';
              </script>";
    }
  }
}
?>


<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit | Pemilik</title>
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

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
    include('template_admin/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
        include('template_admin/navbar.php');
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Form Tambah -->
          <div id="content-page" class="content-page">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Dokter</h1>

                </div>  
                <form action="" method="POST">

                <input type="hidden" class="form-control" id="id" name="id" value="<?= $dokter['id']; ?>" >
                    

                  <div class="mb-3">
                  <label for="Dokter" class="form-label">Nama Pemilik Hewan</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $dokter['nama']; ?>">
                  </div>

                  <div class="mb-3">
                  <label for="alamat" class="form-label">alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dokter['alamat']; ?>">
                  </div>

                  <div class="mb-3">
                  <label for="kontak" class="form-label">Kontak</label>
                  <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $dokter['kontak']; ?>">
                  </div>

                <div class="mb-3">
                  <label for="alamat" class="form-label">email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $dokter['email']; ?>">
                      </div>
                <br>      
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                <a href="owner.php" type="button" class="btn btn-secondary">Batal</a>
              </form>
            </div>
          
            </div>
          </div>
          <!-- Form Tambah END-->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
      include('template_admin/footer.php');
      ?>

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
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <!-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> -->

  <!-- Logout Modal-->
  <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
  </div> -->

  <!-- Bootstrap core JavaScript-->
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
<?php

session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>
    alert('Silahkan login terlebih dahulu');
    document.location.href = '../login/login.php';
    </script>";
  exit;
}

//kosongkan session
$_SESSION = [];
session_unset();
session_destroy();
header('Location:../login/login.php');

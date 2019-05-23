<?php session_start();?>
<?php if (isset($_SESSION["session_karyawan"])): ?>
<?php isset($_SESSION["session_sewa"]) ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <title>Selamat Datang Di Web kami</title>
  </head>
  <body style="background:#baf5f3;">
    <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background-color: #2d7573;">
      <!--
    Navbar-expand-md -> menu akan dihiden ketika tampilan device berukuran medium -->
    <a href="#" class="text-white">
    <h2>Suzuki</h2>
    </a>
  <img src="icon.png" width="50px">

    <!-- panggilan icon menu saat menubar disembunyikan -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
    <span class="navbar navbar-toggler-icon"></span>
    </button>

    <!-- daftar menu pada navbar -->
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav">
        <li class="nav-item"><a href="page_karyawan.php?page=list_mobil" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="page_karyawan.php?page=pelanggan" class="nav-link">Pelanggan</a></li>
        <li class="nav-item"><a href="page_karyawan.php?page=mobil" class="nav-link">Mobil</a></li>
        <li class="nav-item"><a href="page_karyawan.php?page=karyawan" class="nav-link">Karyawan</a></li>
        <li class="nav-item"><a href="page_karyawan.php?page=laporan" class="nav-link">Laporan Penyewaan</a></li>
        <li class="nav-item"><a href="proseslogin.php" class="nav-link">Logout</a></li>

      </ul>
        <h2 style="color:pink; font-size:19px; align:right;">    Hallo : <?php echo $_SESSION["session_karyawan"]["nama_karyawan"] ?> </h4>
    </div>
    <a href="page_karyawan.php?page=list_sewa">
    <b class="text-white">Cek Sewa:<?php echo count($_SESSION["session_sewa"]);?> </b>
    </a>
    </nav>
    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $_GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
  <?php echo "Anda belum Login"; ?>
  <br>
  <a href="login.php">
    Silahkan Login Disini
  </a>
<?php endif; ?>

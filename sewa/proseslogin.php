<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

//koneksi SQLiteDatabase
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
$sql = "select * from karyawan where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0){
  //jika jumlah datanya = 0 berarti username atau password salah
  header("location:login.php");
} else {
  //buat variabel session
  $_SESSION["session_karyawan"] = mysqli_fetch_array($result);
  $_SESSION["session_pelanggan"] = mysqli_fetch_array($result);
  $_SESSION["session_sewa"] = array();
  header("location:page_karyawan.php");
}

if (isset($_GET["logout"])){
  //hapus sessionnya
  session_destroy();
  header("location: login.php");
}
?>
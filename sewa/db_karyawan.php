<?php
$koneksi = mysqli_connect("localhost" ,"root","","rent_car");

if (isset($_POST["action"])) {

// tampung data
$id_karyawan= $_POST["id_karyawan"];
$nama_karyawan = $_POST["nama_karyawan"];
$alamat_karyawan= $_POST["alamat_karyawan"];
$kontak = $_POST["kontak"];
$username = $_POST["username"];
$password = md5($_POST["password"]);
$action = $_POST["action"];

  if ($_POST["action"] == "insert") {
    $sql="insert into karyawan ('$id_karyawan','$nama_karyawan', '$alamat_karyawan', '$kontak', '$username', '$password', '$filename')";

    if(mysqli_query($koneksi,$sql)){
      // jika eksekusi berhasil
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }else {
      // jika eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=karyawan");
  }elseif ($action == "update") {
    $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);

  $sql = "update karyawan set nama_karyawan='$nama_karyawan', alamat_karyawan='$alamat_karyawan', kontak='$kontak', username='$username', password='$password' where nisn='$nisn'";
  if(mysqli_query($koneksi,$sql)){
    // jika eksekusi berhasil
    $_SESSION["message"] = array(
      "type" => "success",
      "message" => "Insert data has been success"
    );
  }

  else {
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
    }
  }
  header("location:template.php?page=karyawan");
}
if (isset($_GET["hapus"])) {
  $id_admin = $_GET["id_karyawan"];
  $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);
  $sql = "delete from karyawan where id_karyawan = '$id_karyawan'";
  if (mysqli_query($koneksi, $sql)) {
    // jika query sukses
    $_SESSION["message"] = array(
    "type" => "success",
    "message" => "Remove data has been success"
  );
  }else {
    // jika query gagal
    $_SESSION["message"] = array(
      "type" => "danger",
      "message" => mysqli_error($koneksi)
    );
  }
  header("location:page_karyawan.php?page=karyawan");
}
?>

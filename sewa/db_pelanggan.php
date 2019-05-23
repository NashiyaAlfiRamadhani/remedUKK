<?php

//membuat koneksi databse

$koneksi = mysqli_connect("localhost", "root", "","sewa_mobil");
//localhost =host name
//root = username untuk database
//""= password
//crud=nama database-nya
if(mysqli_connect_errno()){
    //untuk mengecek kalau terjadi kesalahan saat koneksi
    echo mysqli_connect_error();
    //menampilkan pesan errornya
}

//aksi untuk insert data
if(isset($_POST["action"])){
    //untuk mengecek apakah data yang dikirim
    //mengandung inputan yg bernama action?

    //data-nya kita tampung dulu yaa...
    $id_pelanggan = $_POST["id_pelanggan"];
  $nama_pelanggan = $_POST["nama_pelanggan"];
  $alamat_pelanggan= $_POST["alamat_pelanggan"];
  $kontak = $_POST["kontak"];
  $action = $_POST["action"];


    //jika aksinya "insert"
    if($_POST["action"]=="insert"){
            if(isset($_FILES["image"])){
                $path = pathinfo($_FILES["image"]["name"]);
                $extensi =$path["extension"];
                $filename=$id_pelanggan."-".rand(1,1000).".".$extensi;
                move_uploaded_file($_FILES["image"]["tmp_name"],"image_pelnggan/".$filename);
            }
        $sql="insert into pelanggan values('$id_pelanggan','$namapelanggan', '$alamat_pelanggan','$kontak','$filename')";
    }elseif($_POST["action"]=="update"){
        $sql="select * from pelanggan where id_pelanggan='$id_pelanggan'";
        $result=mysqli_query($koneksi, $sql);
        $hasil=mysqli_fetch_array($result);
        if(!empty($_FILES["image"]["name"])){
            if(file_exists("image_pelanggan/".$hasil["image"])){
                unlink("image_pelanggan/".$hasil["image"]);
            }

        $path = pathinfo($_FILES["image"]["name"]);
        $extensi =$path["extension"];
        $filename=$id_pelanggan."-".rand(1,1000).".".$extensi;
        move_uploaded_file($_FILES["image"]["tmp_name"],"image_pelanggan/".$filename);

        //jika actionnya "update"
        $sql="update pelanggan set nama_pelanggan='$nama_pelanggan',alamat_pelanggan='$alamat_pelanggan',kontak='$kontak', image='$filename' where id_pelanggan='$id_pelanggan'";
    }else{
			$sql="update pelanggan set nama_pelanggan='$nama_pelanggan',alamat_pelanggan='$alamat_pelanggan',kontak='$kontak' where id_pelanggan='$id_pelanggan'";

        }
    }
    mysqli_query($koneksi, $sql); //eksekusi sintak sql
  header("location:page_karyawan.php?page=pelanggan");
    //direct kehalaman siswa.php
}
if(isset($_GET["hapus"])){
    //tampung dulu variabel GET yang berisi nilai nisn
    $id_pelanggan=$_GET["id_pelanggan"];
    $sql="select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $result=mysqli_query($koneksi, $sql);
    $hasil=mysqli_fetch_array($result);
    if(file_exists("image_pelanggan/".$hasil["image"])){
        // mengecek keberadaan file
        unlink("image_pelanggan/".$hasil["image"]);
        // menghapus file
    }
    $sql ="delete from pelanggan where id_pelanggan='$id_pelanggan'";
    mysqli_query($koneksi, $sql);
    header("location: page_karyawan.php?page=pelanggan");

}
?>

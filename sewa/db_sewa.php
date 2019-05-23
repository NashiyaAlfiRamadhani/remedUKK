<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
	if (isset($_GET["sewa"])) {
	$id_mobil = $_GET["id_mobil"];
	$sql = "select * from mobil where id_mobil = '$id_mobil'";
	$result = mysqli_query($koneksi,$sql);
	$hasil = mysqli_fetch_array($result);

	if(!in_array($hasil,$_SESSION["session_sewa"])){
	array_push($_SESSION["session_sewa"],$hasil);
}
	header("location:page_karyawan.php?page=list_mobil");
}

if (isset($_GET["checkout"])) {
	$id_sewa = rand(1,10000).date("dmY");
	$id_pelanggan= $_POST['id_pelanggan'];
	$tgl_sewa = date("Y-m-d");
	// insert data ke tabel transaksi
	$sql = "insert into sewa values('$id_sewa','$id_pelanggan','$tgl_sewa')";
	if (mysqli_query($koneksi,$sql)) {
		// insert data ke tabel detail_transaksi
		foreach ($_SESSION["session_sewa"] as $hasil) {
			$id_mobil = $hasil["id_mobil"];
			$jumlah = $_POST["jumlah".$hasil["id_mobil"]];
			$lama_sewa = $_POST["lama_sewa".$hasil["id_mobil"]];
			$sql = "insert into detail_sewa
			values('$id_sewa','$id_mobil','$jumlah','$lama_sewa','$status')";
			mysqli_query($koneksi,$sql);
			$sql_update = "update mobil set stok=stok-1 where id_mobil ='".$hasil["id_mobil"]."'";
	    mysqli_query($koneksi,$sql_update);
		}
		$_SESSION["session_sewa"] = array();
		header("location:page_karyawan.php?page=nota&id_sewa=$id_sewa");
	}
}

if (isset($_GET["hapus"])) {
	$id_mobil = $_GET["id_mobil"];
	$index = array_search($id_mobil,array_column($_SESSION["session_sewa"],"id_mobil"));
	array_splice($_SESSION["session_sewa"],$index,1);
	header("location:page_karyawan.php?page=list_sewa");
}
?>

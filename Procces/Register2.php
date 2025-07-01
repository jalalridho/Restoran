<?php 
	include '../Connection/Connection.php';

	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];

	$query = mysqli_query($koneksi, "INSERT INTO user SET Namauser = '$nama', username = '$username', password = '$password', level = '$level'");
		
	if($query){
		header("location:../index.php");
	}else{
		echo("gagal menambah data!");
	}
?>
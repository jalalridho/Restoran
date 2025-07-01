<?php 
	$koneksi = mysqli_connect('localhost','root','','restoran');
	if (mysqli_connect_errno()) {
		echo "Connection Error : " . mysqli_connect_errno();
	}
 ?>
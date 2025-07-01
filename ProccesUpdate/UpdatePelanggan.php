<?php
    include '../Connection/Connection.php';

    $id = $_POST["id"];
    $namapelanggan = $_POST["namapelanggan"];
    $jenkel = $_POST["jenkel"];
    $nohp = $_POST["nohp"];
    $alamat = $_POST["alamat"];
    $meja = $_POST["meja"];

    $sql = mysqli_query($koneksi, "CALL updatePelanggan('".$id."', '".$namapelanggan."', '".$jenkel."', '".$nohp."', '".$alamat."', '".$meja."')");

    if($sql)
    {
        header("location:../Page/Admin.php?pesanpelanggan=ubahsukses&#pelanggan");
    }else{
        echo "gagal tambah data";
    }
?>

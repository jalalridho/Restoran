<?php
    include '../Connection/Connection.php';

    $id = $_POST['id'];
    $namapelanggan = $_POST['namapelanggan'];
    $jenkel = $_POST['jenkel'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $meja = $_POST['meja'];
    $waktudatang = date('H:i:s', strtotime($_POST['waktudatang']));
    //$waktudatang = date('H:i:s');
    //echo $waktudatang;

    $sql = mysqli_query($koneksi, "CALL addPelanggan('".$id."', '".$namapelanggan."', '".$jenkel."', '".$nohp."', '".$alamat."', '".$meja."', '".$waktudatang."')");

    if($sql)
    {
        header("location:../Page/Admin.php?pesanpelanggan=sukses&#pelanggan");
    }else{
        echo "gagal";
    }
?>

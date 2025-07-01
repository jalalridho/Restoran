<?php
    include '../Connection/Connection.php';

    $id = $_GET["id"];

    $sql = mysqli_query($koneksi, "CALL deletePelanggan('".$id."')");

    if($sql)
    {
        header("location:../Page/Admin.php?pesanpelanggan=deletesakses&#pelanggan");
    }else{
        echo "Gagal";
    }
?>

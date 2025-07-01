<?php
    include '../Connection/Connection.php';

    $id = $_POST["idpesanan"];
    $id_menu = $_POST["idmenu"];
    $id_pelanggan = $_POST["idpelanggan"];
    $jumlah = $_POST["jumlahpesanan"];

    $query = mysqli_query($koneksi, "CALL updatePesanan('".$id."', '".$id_menu."', '".$id_pelanggan."', '".$jumlah."')");

    if($query)
    {
        header("location:../Page/Waiter.php?pesanor=ubahsukses&#order");
    }
    else{
        echo "gagal";
    }
?>

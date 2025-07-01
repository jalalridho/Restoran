<?php
    include '../Connection/Connection.php';

    $id = $_GET["id"];

    $sql = mysqli_query($koneksi, "CALL deletePesanan('".$id."')");

    if($sql)
    {
        header("location:../Page/Waiter.php?pesanor=deletesakses&#order");
    }else{
        echo "gagal";
    }
?>

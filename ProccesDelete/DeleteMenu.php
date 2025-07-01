<?php
    include '../Connection/Connection.php';

    $id = $_GET["id"];

    $sql = mysqli_query($koneksi, "CALL deleteMenu('".$id."')");

    if($sql)
    {
        header("location:../Page/Admin.php?pesanmenu=deletesakses&#menu");
    }else{
        echo "gagal";
    }
?>

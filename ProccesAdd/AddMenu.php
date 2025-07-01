<?php
    include '../Connection/Connection.php';

    if(isset($_POST['register']))
    {
        $id = $_POST["id"];
        $namaMenu = $_POST["namamenu"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];

        $sql = mysqli_query($koneksi,"CALL addMenu('".$id."', '".$namaMenu."', '".$harga."', '".$stok."')");

        if($sql)
        {
            header("location:../Page/Admin.php?pesanmenu=sukses&#menu");
        }
        else{
            echo "gagal";
        }
    }
?>

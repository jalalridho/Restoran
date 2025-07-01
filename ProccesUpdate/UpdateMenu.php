<?php
    include '../Connection/Connection.php';

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $namaMenu = $_POST['namamenu'];
        $harga = $_POST['harga'];
        $stok = $_POST['Stok'];

        $sql = mysqli_query($koneksi, "CALL updateMenu('".$id."', '".$namaMenu."', '".$harga."', '".$stok."')");

        if($sql)
        {
            header("location:../Page/Admin.php?pesanmenu=ubahsuksesmn&#menu");
        }
        else {
            echo "gagal";
        }
    }


?>

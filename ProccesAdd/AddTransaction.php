<?php
    include '../Connection/Connection.php';

    $id = $_POST["idtransaksi"];
    $idpesanan = mysqli_real_escape_string($koneksi, $_POST["idpesanan"]);
    $bayar = $_POST["bayar"];

    $query =  mysqli_query($koneksi, "SELECT pesanan.Jumlah * menu.Harga AS total FROM pesanan, menu WHERE pesanan.idmenu = menu.idmenu AND pesanan.idpesanan = '$idpesanan'");
    $cek = mysqli_num_rows($query);
    if ($cek>0) {
        $data = mysqli_fetch_assoc($query);
        $total = "$data[total]";
    }else{
        echo "Kesalahan mencari data total";
    }

    $query = mysqli_query($koneksi, "CALL addTransaksi('".$id."', '".$idpesanan."', '".$total."', '".$bayar."')");
    if($query)
    {
        header("location:../Page/Kasir.php?pesantrans=sukses&#transaksi");
    }else{
        echo "gagal";
    }
?>

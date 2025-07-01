<?php
    include '../Connection/Connection.php';

      $idpesanan = $_POST["idpesanan"];
      $id_menu = $_POST["idmenu"];
      $id_pelanggan = $_POST["idpelanggan"];
      $jumlah = $_POST["jumlahpesanan"];


      $sql = mysqli_query($koneksi, "CALL addPesanan('".$idpesanan."','".$id_menu."', '".$id_pelanggan."', '".$jumlah."', '1')");
      if($sql)
      {
          header("location:../Page/Waiter.php?pesanor=sukses&#order");
      }
      else{
          echo "gagal";
      }
?>
  
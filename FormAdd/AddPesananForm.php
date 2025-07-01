<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Restaurant | Add Pesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      *{font-family: verdana;}
      form{border-radius: 40px 40px; background-color: #F2F3F4; padding: 30px;}
    </style>
</head>
<body>
    <?php
        include '../Connection/Connection.php';
        $sql = mysqli_query($koneksi, "SELECT MAX(idpesanan) FROM pesanan");
        $data = mysqli_fetch_array($sql);
        $MaxID = $data[0];
        $idmenu = (int)substr($MaxID,3, 2);
        $idmenu++;
        $NewID = "PS".sprintf("%03s", $idmenu);
    ?>

    <div class="container-fluid" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Add Pesanan</h2>
      </div>

      <form action="../ProccesAdd/AddPesanan.php" method="POST">

        <fieldset>
          <div class="form-group">
            <label>ID Pesanan :</label>
            <input type="id" class="form-control" name="idpesanan" value="<?php echo $NewID; ?>" required/>
          </div>
          <div class="form-group">
            <label>Nama menu :</label>
            <select class="form-control" name="idmenu" required>
            <?php
              include '../Connection/Connection.php';
              $menu = mysqli_query($koneksi,"CALL selectMenu()");
              while($nama_menu = mysqli_fetch_array($menu)){
                echo '<option value="'.$nama_menu['idmenu'].'">'.$nama_menu['idmenu'].' - '.$nama_menu['NamaMenu'].' - '.$nama_menu['Harga'].'</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama pelanggan :</label>
            <select class="form-control" name="idpelanggan" required>
            <?php
              include '../Connection/Connection.php';
              $pelanggan = mysqli_query($koneksi,"CALL getPelanggan()");
              while($nama_pelanggan = mysqli_fetch_array($pelanggan)){
                echo '<option value="'.$nama_pelanggan['idpelanggan'].'">'.$nama_pelanggan['idpelanggan'].' - '.$nama_pelanggan['Namapelanggan'].'</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Pesanan :</label>
            <input type="text" class="form-control" name="jumlahpesanan" required/>
          </div>
          <input class="btn btn-primary btn-block" name="submit" type="submit" value="ADD"/>
        </fieldset>
      </form>
    </div>
  </body>
</html>

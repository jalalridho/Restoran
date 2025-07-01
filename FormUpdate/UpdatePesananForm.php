<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Resataurant | Update Pesanan</title>
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
        $id = $_GET["id"];

        $sql = mysqli_query($koneksi, "CALL selectOrder('".$id."')");
        $data = mysqli_fetch_assoc($sql);
        $menu_old = $data['idmenu'];
        $pelanggan_old = $data['idpelanggan'];
        $jumlah_old = $data['Jumlah'];
    ?>
    <div class="container-fluid" style="padding: 50px 100px 50px 100px;">
      <div class="row">
        <h2>Update Pesanan</h2>
      </div>

      <form action="../ProccesUpdate/UpdatePesanan.php" method="POST">
        <div class="form-group">
          <input type="hidden" name="idpesanan" value="<?php echo $id ?>">
        </div>
        <div class="form-group">
          <label>Nama menu</label>
          <select class="form-control" name="idmenu">
          <?php
            include '../Connection/Connection.php';
            $menu = mysqli_query($koneksi,"CALL selectMenu()");
            while($nama_menu = mysqli_fetch_array($menu)){ ?>
            <option value="<?php echo $nama_menu['idmenu']; ?>" <?php if($menu_old == $nama_menu['idmenu']) echo 'selected'?> ><?php echo $nama_menu['idmenu'] .' - '. $nama_menu['NamaMenu']; ?></option>
          <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Nama pelanggan</label>
          <select class="form-control" name="idpelanggan">
          <?php
            include '../Connection/Connection.php';
            $pelanggan = mysqli_query($koneksi,"CALL getPelanggan()");
            while($nama_pelanggan = mysqli_fetch_array($pelanggan)){ ?>
              <option value="<?php echo $nama_pelanggan['idpelanggan']; ?>" <?php if($pelanggan_old == $nama_pelanggan['idpelanggan']) echo 'selected'?> ><?php echo $nama_pelanggan['idpelanggan'] .' - '. $nama_pelanggan['Namapelanggan']; ?></option>
            <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Pesanan</label>
            <input type="text" class="form-control" name="jumlahpesanan" value="<?php echo $jumlah_old; ?>"/>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="submit" value="Update"/>
      </form>
    </div>
  </body>
</html>

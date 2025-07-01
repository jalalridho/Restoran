<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Restaurant | Add Pelanggan</title>
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
        $sql = mysqli_query($koneksi, "SELECT MAX(idpelanggan) FROM pelanggan");
        $data = mysqli_fetch_array($sql);
        $MaxID = $data[0];
        $idpelanggan = (int)substr($MaxID,3, 2);
        $idpelanggan++;
        $NewID = "P".sprintf("%03s", $idpelanggan);
    ?>
    <div class="container" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Register Pelanggan</h2>
      </div>

      <form action="../ProccesAdd/AddPelanggan.php" method="post">

      <fieldset>
        <div class="form-group">
          <input class="form-control" type="text" value="<?php echo $NewID; ?>" name="id" hidden>
        </div>
        <div class="form-group">
          <label>Nama Pelanggan :</label>
          <input class="form-control" type="text" name="namapelanggan" required>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin :</label>
          <label><input class="option" type="radio" name="jenkel" value="Laki-Laki" required> Laki-Laki</label>
          <label><input class="option" type="radio" name="jenkel" value="Perempuan" required> Perempuan</label>
        </div>
        <div class="form-group">
          <label>No Telp :</label>
          <input type="text" class="form-control" name="nohp" required>
        </div>
        <div class="form-group">
          <label>Alamat :</label>
          <textarea class="form-control" name="alamat" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label>Meja :</label>
          <input type="text" class="form-control" name="meja" required>
        </div>
        <div class="form-group">
          <label>Waktu Datang :</label>
          <input type="time" name="waktudatang" class="form-control" step="1" required>
        </div>

        <input class="btn btn-primary btn-block" name="register" type="submit" value="ADD">

      </fieldset>
      </form>
    </div>
  </body>
</html>

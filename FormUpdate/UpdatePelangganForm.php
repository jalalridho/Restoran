<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Resaturant | Update Pelanggan</title>
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

        $sql = mysqli_query($koneksi, "CALL selectPelanggan('".$id."')");
        $data = mysqli_fetch_assoc($sql);
          $nama_old = $data['Namapelanggan'];
          $jk_old = $data['Jeniskelamin'];
          $nohp_old = $data['Nohp'];
          $alamat_old = $data['Alamat'];
          $meja_old = $data['meja'];
          $waktu_old = $data['waktudatang'];
    ?>
    <div class="container-fluid" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Update Pelanggan</h2>
      </div>
            <form action="../ProccesUpdate/UpdatePelanggan.php" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" value="<?php echo $id; ?>" name="id" hidden>
                </div>
                <div class="form-group">
                    <label>Nama Pelanggan :</label>
                    <input class="form-control" type="text" name="namapelanggan" value="<?= $nama_old ?>">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin :</label><br>
                    <label><input class="option" type="radio" name="jenkel" value="Laki-Laki" <?php echo ($jk_old=='Laki-Laki')?"checked":""  ?> > Laki-Laki</label>
                    <label><input class="option" type="radio" name="jenkel" value="Perempuan" <?php echo ($jk_old=='Perempuan')?"checked":""  ?> > Perempuan</label>
                </div>
                <div class="form-group">
                    <label>No Telp :</label>
                    <input type="text" class="form-control" name="nohp" value="<?= $nohp_old ?>">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <textarea class="form-control" name="alamat" rows="3"><?= $alamat_old ?></textarea>
                </div>
                <div class="form-group">
                    <label for="meja">Meja :</label>
                    <input type="text" class="form-control" name="meja" value="<?= $meja_old ?>">
                </div>
                <input class="btn btn-primary btn-block" name="update" type="submit" value="EDIT">
            </form>
    </div>
</body>
</html>

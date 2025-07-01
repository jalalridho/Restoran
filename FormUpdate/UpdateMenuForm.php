<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Restaurant | Update Menu</title>
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
        $id = $_GET['id'];

        $sql = mysqli_query($koneksi, "SELECT * FROM menu WHERE idmenu = '$id'");
        $data = mysqli_fetch_assoc($sql);
        $namamenu_old = $data['NamaMenu'];
        $harga_old = $data['Harga'];
        $stok_old = $data['stok'];
    ?>
    <div class="container-fluid" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Update Menu</h2>
      </div>

      <form action="../ProccesUpdate/UpdateMenu.php" method="post">
        <div class="form-group">
          <input class="form-control" type="text" value="<?php echo $id; ?>" name="id" hidden >
        </div>
        <div class="form-group">
          <label for="namaMenu">Nama Menu :</label>
          <input class="form-control" type="text" name="namamenu" value="<?php echo $namamenu_old; ?>">
        </div>
        <div class="form-group">
          <label for="harga">Harga :</label>
          <input type="text" class="form-control" name="harga" value="<?php echo $harga_old; ?>">
        </div>
        <div class="form-group">
          <label for="harga">Stok :</label>
          <input type="text" class="form-control" name="Stok" value="<?php echo $stok_old; ?>">
        </div>
        <input class="btn btn-primary btn-block" name="update" type="submit" value="Update">
      </form>
    </div>
  </body>
</html>

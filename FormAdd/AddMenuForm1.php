<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Restaurant | Add Menu</title>
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
        $sql = mysqli_query($koneksi, "SELECT MAX(idmenu) FROM menu");
        $data = mysqli_fetch_array($sql);
        $MaxID = $data[0];
        $idmenu = (int)substr($MaxID,3, 2);
        $idmenu++;
        $NewID = "M".sprintf("%03s", $idmenu);
    ?>
    <div class="container-fluid" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Add Menu</h2>
      </div>

      <form action="../ProccesAdd/AddMenu1.php" method="post">

        <fieldset>
          <div class="form-group">
            <input class="form-control" type="text" value="<?php echo $NewID; ?>" name="id" hidden>
          </div>
          <div class="form-group">
            <label for="namaMenu">Nama Menu :</label>
            <input class="form-control" type="text" name="namamenu" required>
          </div>
          <div class="form-group">
            <label for="harga">Harga :</label>
            <input type="text" class="form-control" name="harga" required>
          </div>
          <div class="form-group">
            <label for="harga">Stok :</label>
            <input type="text" class="form-control" name="stok" required>
          </div>
          <input class="btn btn-primary btn-block" name="register" type="submit" value="ADD">
        </fieldset>
      </form>
    </div>
  </body>
</html>

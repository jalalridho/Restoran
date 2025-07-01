<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8-8">
    <title>Restaurant | Add Transaksi</title>
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
        $sql = mysqli_query($koneksi, "SELECT MAX(idtransaksi) FROM transaksi");
        $data = mysqli_fetch_array($sql);
        $MaxID = $data[0];
        $idmenu = (int)substr($MaxID,3, 2);
        $idmenu++;
        $NewID = "TR".sprintf("%03s", $idmenu);
    ?>
    <div class="container-fluid" style="padding: 50px 50px 50px 50px;">
      <div class="row">
        <h2>Data Transaksi</h2>
      </div><br>

      <form action="../ProccesAdd/AddTransaction.php" method="post">
        <fieldset>
          <div class="form-group">
            <label>ID Transaksi :</label>
            <input type="id" class="form-control" name="idtransaksi" value="<?php echo"$NewID" ?>" required/>
          </div>
          <div class="form-group">
              <label for="namaPelanggan">Pesanan</label>
                <select class="form-control" name="idpesanan" required>
                  <?php
                  $data_pesanan =  mysqli_query($koneksi, "CALL selectTransaksi()");
                  while($dp = mysqli_fetch_array($data_pesanan)){
                    echo '<option value="'.$dp['idpesanan'].'">'.$dp['idpesanan'].' - '.$dp['Namapelanggan'].' - Total : '.$dp['Total'].'</option>';
                  }
                  ?>
                </select>
          </div>
          <div class="form-group">
            <label for="bayar">Bayar</label>
            <input type="text" class="form-control" name="bayar"  required>
          </div>

          <input class="btn btn-primary btn-block" name="register" type="submit" value="ADD">

        </fieldset>
      </form>
    </div>
  </body>
</html>

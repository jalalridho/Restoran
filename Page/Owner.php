<?php
    include '../Connection/Connection.php';
    session_start();
    $nama = $_SESSION['nama'];
    if(!($_SESSION['login']))
    {
        header("location:../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Form Owner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
    *{font-family: verdana;}
    .jumbotron {margin-top:0px; background-color: #28B463; color: #ffff;}
    th{background-color: #239B56; color: #ffff;}
    td{background-color: #F2F3F4;}
		footer{margin-top: 70px;}
		span{font-size: 1em;}
		.navbar-inverse{background-color:#239B56; border:none; border-radius: 0px;}
    .navbar-inverse .navbar-brand{ color: #ffff;}
    .navbar-inverse .navbar-brand:hover, .navbar-inverse .navbar-brand:focus{color:#28B463;}
    .navbar-inverse .navbar-nav>li>a{ color: #ffff;}
    .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus{color: #28B463;}
    .navbar-inverse .navbar-nav>.active>a{color: #035397; background-color: #ffff;}
    .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus{ background-color: #ffff; color: #035397;}
		</style>
</head>
<body>
  <nav class="navbar navbar-inverse" style="margin-bottom: 0;">
    <div class="container-fluid">
      <div class="navbar-header" id="navbar"><a class="navbar-brand" href="#">Restoran</a></div>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-iten"><a href="#laporan">Laporan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" >
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nama; ?></a></li>
        <li><a href="../Procces/Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="jumbotron">
      <h1 style="padding-left: 50px;">Owner Page</h1>
      <p class="lead" style="padding-left: 50px">OWNER Name : <?php echo $nama ?></p>
    </div>

    <div class="row" style="padding-left:50px; padding-right: 50px;">
      <?php
        echo "<br/><br/>";
        echo "<pre><b>Hello ".$nama." </b>";
      ?>
    </div>

    <div id="laporan" class="container-fluid" style="padding: 100px 100px 100px 100px">
      <center>
        <h2>Laporan Restoran Sedap Malam</h2>
        <a target="_blank" href="../ExportReport.php">EXPORT KE EXCEL</a>
      </center><br/><br/>

      <table class="table">
        <thead class="thead">
          <tr>
            <th style="text-align: center">Nomor</th>
            <th style="text-align: center">ID Transaksi</th>
            <th style="text-align: center">Nama Pelanggan</th>
            <th style="text-align: center">Pembayaran</th>
            <th style="text-align: center">Tanggal Pembayaran</th>
          </tr>
        </thead>
        <?php
        $nomor1=1;
        include '../Connection/Connection.php';
        $datacari2 = mysqli_query($koneksi,"CALL getReport()");
        ?>
        <?php
          while ($dc = mysqli_fetch_array($datacari2)) { ?>
            <tr>
              <td style="text-align: center;"><?php echo $nomor1++; ?></td>
              <td style="text-align: center"><?php echo $dc['idtransaksi'] ?></td>
              <td style="text-align: center"><?php echo $dc['Namapelanggan'] ?></td>
              <td style="text-align: center"><?php echo $dc['Bayar'] ?></td>
              <td style="text-align: center"><?php echo $dc['tgl_bayar'] ?></td>
            </tr><?php
          }
        ?>
      </table>
    </div>

        <footer class="container-fluid text-center">
            <a href="#navbar" title="To Top">
              <span class="glyphicon  glyphicon-chevron-up"></span>
            </a><br>
        </footer>

</body>
</html>

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
    <title>Restaurant | Waiter</title>
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
        <li class="nav-item"><a href="#menu">Menu</a></li>
        <li class="nav-item"><a href="#order">Order</a></li>
        <li class="nav-item"><a href="#laporan">Laporan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" >
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nama; ?></a></li>
        <li><a href="../Procces/Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="jumbotron">
      <h1 style="padding-left:50px">Halaman WAITER</h1>
      <p class="lead" style='padding-left:50px;'>Waiter Name : <?php echo $nama ?></p>
  </div>

  <div class="row" style="padding-left:50px; padding-right: 50px;">
     <?php
       echo "<br/><br/>";
       echo "<pre><b>Nama</b>  : ".$nama."</pre>";
     ?>
  </div>

    <div id="menu" class="container-fluid" style="padding: 100px 100px 100px 100px">
      <?php
     if (isset($_GET['pesan'])) {
       if ($_GET['pesan']=="sukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil ditambahkan</h3></div>";
       }
       else if ($_GET['pesan']=="deletesakses") {
         echo "<div class='alert alert-warning alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil dihapus</h3></div>";;
       }
       else if ($_GET['pesan']=="ubahsukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil diedit</h3></div>";
       }
     }
      ?>
      <h2 align="center">Daftar Menu</h2><br>

      <div>
        <a href="../FormAdd/AddMenuForm1.php"><i class="fas fa-plus"></i>(+) Tambah Data</a>
      </div></br>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th style="text-align:center">Nomor</th>
                    <th style="text-align:center">Nama Menu</th>
                    <th style="text-align:center">Harga</th>
                    <th style="text-align:center">Stok</th>
                    <th style="text-align:center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include '../Connection/Connection.php';

                $batas = 3;
                $halaman = isset($_GET['halamanmenu'])?(int)$_GET['halamanmenu'] : 1;
                $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($koneksi, "SELECT * FROM menu");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                $data_menu = mysqli_query($koneksi, "SELECT * FROM menu limit $halaman_awal, $batas");
                $nomor = $halaman_awal + 1;
                while($d = mysqli_fetch_array($data_menu)){
                  ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $nomor++; ?></td>
                    <td style="text-align: center;"><?php echo $d['NamaMenu']; ?></td>
                    <td style="text-align: center;"><?php echo $d['Harga']; ?></td>
                    <td style="text-align: center;"><?php echo $d['stok']; ?></td>
                    <td style="text-align: center;"><a href="<?php echo "../FormUpdate/UpdateMenuForm1.php?id=".$d['idmenu'] ?> ">Edit</a> | <a onclick="return confirm('Really ?')" href="<?php echo "../ProccesDelete/DeleteMenu1.php?id=".$d['idmenu'] ?> ">Delete</a></td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
              <nav>
                <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halamanmenu=".$previous."&#menu'"; } ?>>Previous</a>
                </li>
                <?php
                    for ($x =1; $x <= $total_halaman; $x++){
                    ?>
                    <li class="page-item"><a class="page-link" href="?halamanmenu=<?php echo $x ?>&#menu"><?php echo $x; ?></a></li>
                    <?php
                    }
                ?>
                <li class="page-item  active">
                    <a class="page-link" <?php if($halaman < $total_halaman){ echo "href='?halamanmenu=".$next."&#menu'"; } ?>>Next</a>
                </li>
                </ul>
            </nav>
        </div>
    </div>

    <div id="order" class="container-fluid" style="padding: 100px 100px 100px 100px">
      <?php
     if (isset($_GET['pesanor'])) {
       if ($_GET['pesanor']=="sukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil ditambahkan</h3></div>";
       }
       else if ($_GET['pesanor']=="deletesakses") {
         echo "<div class='alert alert-warning alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil dihapus</h3></div>";;
       }
       else if ($_GET['pesanor']=="ubahsukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil diedit</h3></div>";
       }
     }
      ?>
      <h2 align="center">Order Pesanan</h2>
            <br>
            <div>
                <a href="../FormAdd/AddPesananForm.php"><i class="fas fa-plus"></i>(+) Tambah Data</a>
            </div></br>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="text-align: center">Nomor</th>
                    <th style="text-align: center">ID Pesanan</th>
                    <th style="text-align: center">Nama Menu</th>
                    <th style="text-align: center">Nama Pelanggan</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Jumlah Pesanan</th>
                    <th style="text-align: center">Nama Waiter</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Connection/Connection.php';

                    $batas = 3; 
                    $halaman = isset($_GET['halamanpesanan'])?(int)$_GET['halamanpesanan'] : 1;
                    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $data = mysqli_query($koneksi, "SELECT * FROM pesanan");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    $data_menu = mysqli_query($koneksi, "SELECT ps.idpesanan, m.NamaMenu, p.Namapelanggan, m.Harga, ps.Jumlah, u.Namauser
                                                            FROM pesanan ps, menu m, pelanggan p, user u
                                                            WHERE ps.idmenu = m.idmenu
                                                            AND ps.idpelanggan = p.idpelanggan
                                                            AND ps.iduser = u.iduser ORDER BY ps.idpesanan ASC LIMIT $halaman_awal, $batas");
                    $nomor = $halaman_awal + 1;
                    while($d = mysqli_fetch_array($data_menu)){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $nomor++; ?></td>
                        <td style="text-align: center"><?php echo $d['idpesanan']; ?></td>
                        <td style="text-align: center"><?php echo $d['NamaMenu']; ?></td>
                        <td style="text-align: center"><?php echo $d['Namapelanggan']; ?></td>
                        <td style="text-align: center"><?php echo $d['Harga']; ?></td>
                        <td style="text-align: center"><?php echo $d['Jumlah']; ?></td>
                        <td style="text-align: center"><?php echo $d['Namauser']; ?></td>
                        <td style="text-align: center"><a href="<?php echo "../FormUpdate/UpdatePesananForm.php?id=".$d['idpesanan'] ?> ">Edit</a> | <a onclick="return confirm('Are you sure you want to Delete ?')" href="<?php echo "../ProccesDelete/DeletePesanan.php?id=".$d['idpesanan'] ?> ">Delete</a></td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halamanpesanan=".$previous."&#order'"; } ?>>Previous</a>
                </li>
                <?php
                    for ($x =1; $x <= $total_halaman; $x++){
                    ?>
                    <li class="page-item"><a class="page-link" href="?halamanpesanan=<?php echo $x ?>&#order"><?php echo $x; ?></a></li>
                    <?php
                    }
                ?>
                <li class="page-item active">
                    <a class="page-link" <?php if($halaman < $total_halaman){ echo "href='?halamanpesanan=".$next."&#order'"; } ?>>Next</a>
                </li>
                </ul>
            </nav>
        </div>
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

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
    <meta charset="UTF-8">
    <title>Restaurant | Admin</title>
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
          <li class="nav-iten"><a href="#pelanggan">Pelanggan</a></li>
          <li class="nav-item"><a href="#menu">Menu</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right" >
          <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nama; ?></a></li>
          <li><a href="../Procces/Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        </ul>
      </div>
    </nav>

    <div class="jumbotron">
      <h1 style="padding-left: 50px;">Admin Page</h1>
      <p class="lead" style="padding-left: 50px">ADMIN Name : <?php echo $nama ?></p>
    </div>

    <div class="row" style="padding-left:50px; padding-right: 50px;">
      <?php
        echo "<br/><br/>";
        echo "<pre><b>Hello ".$nama." </b>";
      ?>
    </div>

    <div id="pelanggan" class="container-fluid" style="padding-top: 100px; padding-bottom: 100px;">
      <?php
     if (isset($_GET['pesanpelanggan'])) {
       if ($_GET['pesanpelanggan']=="sukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil ditambahkan</h3></div>";
       }
       else if ($_GET['pesanpelanggan']=="deletesakses") {
         echo "<div class='alert alert-warning alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil dihapus</h3></div>";;
       }
       else if ($_GET['pesanpelanggan']=="ubahsukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil diedit</h3></div>";
       }
     }
      ?>
      <h2 align="center">List Data Meja Dan Pelanggan</h2><br>

      <div>
        <a href="../FormAdd/AddPelangganForm.php"><i class="fas fa-plus"></i>(+) Tambah Data</a>
      </div></br>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th style="text-align: center">Nomor</th>
            <th style="text-align: center">Meja</th>
            <th style="text-align: center">Nama Pelanggan</th>
            <th style="text-align: center">Jenis Kelamin</th>
            <th style="text-align: center">No Telp</th>
            <th style="text-align: center">Alamat</th>
            
            <th style="text-align: center">Waktu Datang</th>
            <th style="text-align: center">Action</th>
          </tr>
        </thead>
      <tbody>
        <?php
        include '../Connection/Connection.php';

        $batas = 3;
        $halaman = isset($_GET['halamanp'])?(int)$_GET['halamanp'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;

        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);

        $data_menu = mysqli_query($koneksi, "SELECT * FROM pelanggan limit $halaman_awal, $batas");
        $nomor = $halaman_awal + 1;
        while($d = mysqli_fetch_array($data_menu)){
        ?>
        <tr>
          <td style="text-align: center;"><?php echo $nomor++; ?></td>
          <td style="text-align: center;"><?php echo $d['meja']; ?></td>
          <td style="text-align: center;"><?php echo $d['Namapelanggan']; ?></td>
          <td style="text-align: center;"><?php echo $d['Jeniskelamin']; ?></td>
          <td style="text-align: center;"><?php echo $d['Nohp']; ?></td>
          <td style="text-align: center;"><?php echo $d['Alamat']; ?></td>

          <td style="text-align: center;"><?php echo $d['waktudatang']; ?></td>
          <td style="text-align: center;"><a title="edit" href="<?php echo "../FormUpdate/UpdatePelangganForm.php?id=".$d['idpelanggan'] ?> ">Edit</a> | <a title="delete" onclick="return confirm('Really ?')" href="<?php echo "../ProccesDelete/DeletePelanggan.php?id=".$d['idpelanggan'] ?> ">Delete</a></td>
        </tr>
        <?php
          }
        ?>
        </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" <?php if($halaman > 1){ echo "href='?halamanp=".$previous."&#pelanggan'"; } ?>>Previous</a>
              </li>
              <?php
              for ($x =1; $x <= $total_halaman; $x++){
              ?>
              <li class="page-item"><a class="page-link" href="?halamanp=<?php echo $x ?>&#pelanggan"><?php echo $x; ?></a></li>
              <?php
                }
              ?>
              <li class="page-item active">
                <a class="page-link" <?php if($halaman < $total_halaman){ echo "href='?halamanp=".$next."&#pelanggan'"; } ?>>Next</a>
              </li>
            </ul>
          </nav>
    </div>

    <div id="menu" class="container-fluid" style="padding-top: 100px; padding-bottom: 100px;">
      <?php
     if (isset($_GET['pesanmenu'])) {
       if ($_GET['pesanmenu']=="sukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil ditambahkan</h3></div>";
       }
       else if ($_GET['pesanmenu']=="deletesakses") {
         echo "<div class='alert alert-warning alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil dihapus</h3></div>";;
       }
       else if ($_GET['pesanmenu']=="ubahsuksesmn") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil diedit</h3></div>";
       }
     }
      ?>
      <h2 align="center">Daftar Menu</h2><br>

      <div>
        <a href="../FormAdd/AddMenuForm.php"><i class="fas fa-plus"></i>(+) Tambah Data</a>
      </div></br>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th style="text-align: center">Nomor</th>
            <th style="text-align: center">Nama Menu</th>
            <th style="text-align: center">Harga</th>
            <th style="text-align: center">Stok</th>
            <th style="text-align: center">Action</th>
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

          $data_menu = mysqli_query($koneksi, "select * from menu limit $halaman_awal, $batas");
          $nomor = $halaman_awal + 1;
          while($d = mysqli_fetch_array($data_menu)){
            ?>
            <tr>
              <td style="text-align: center;"><?php echo $nomor++; ?></td>
              <td style="text-align: center;"><?php echo $d['NamaMenu']; ?></td>
              <td style="text-align: center;"><?php echo $d['Harga']; ?></td>
              <td style="text-align: center;"><?php echo $d['stok']; ?></td>
              <td style="text-align: center;"><a href="<?php echo "../FormUpdate/UpdateMenuForm.php?id=".$d['idmenu'] ?> ">Edit</a> | <a title="delete" onclick="return confirm('Really ?')" href="<?php echo "../ProccesDelete/DeleteMenu.php?id=".$d['idmenu'] ?> ">Delete</a></td>
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
                <li class="page-item active">
                  <a class="page-link" <?php if($halaman < $total_halaman){ echo "href='?halamanmenu=".$next."&#menu'"; } ?>>Next</a>
                </li>
                </ul>
            </nav>
        </div>

        <footer class="container-fluid text-center">
            <a href="#navbar" title="To Top">
              <span class="glyphicon  glyphicon-chevron-up"></span>
            </a><br>
        </footer>
</body>
</html>

<?php
    include '../Connection/Connection.php';
    session_start();
    $nama = $_SESSION['nama'];
    if(!($_SESSION['login']))
    {
        header("location:../index.php");
    }

    function generatedId(){
      $hari = date('l');
      $tanggal = date('d');
      $bulan = date('M');
      $blnangka = date('m');
      $tahun = date('y');
      $jam = date('h');
      $minute = date('i');
      $detik = date('s');
      $haricut = substr($hari,0,1);
      $bulancut = substr($bulan, 0,1);
      $kodejoin = "{$haricut}{$bulancut}{$tanggal}{$blnangka}{$tahun}{$jam}{$minute}{$detik}";
      return $kodejoin;
    }

    function rupiah($angka){
      $hasil_rupiah = "Rp.".number_format($angka,2,',',',');
      return $hasil_rupiah;
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Form Kasir</title>
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
        <li class="nav-iten"><a href="#transaksi">Transaksi</a></li>
        <li class="nav-item"><a href="#laporan">Laporan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" >
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nama; ?></a></li>
        <li><a href="../Procces/Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="jumbotron">
    <h1 style="padding-left: 50px;">Halaman KASIR</h1>
    <p class="lead" style="padding-left: 50px">KASIR Name : <?php echo $nama ?></p>
  </div>

  <div class="row" style="padding-left:50px; padding-right: 50px;">
     <?php
       echo "<br/><br/>";
       echo "<pre><b>Nama</b>  : ".$nama;
     ?>
  </div>

    <div id="transaksi" class="container-fluid" style="padding: 100px 100px 100px 100px">
      <?php
     if (isset($_GET['pesantrans'])) {
       if ($_GET['pesantrans']=="sukses") {
         echo "<div class='alert alert-success alert-dismissible' style='text-align:center'><button type='button' class='close' data-dismiss='alert'>&times;</button><h3>Data berhasil ditambahkan</h3></div>";
       }
     }
      ?>
      <h2 align="center">Data Transaksi</h2>

      <div>
        <a href="../FormAdd/AddTransactionForm.php"><i class="fas fa-plus"></i>(+) Tambah Data</a>
      </div></br>
      <form method="post">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th style="text-align:center">Nomor</th>
            <th style="text-align:center">Pilih</th>
            <th style="text-align:center">Nomor Meja</th>
            <th style="text-align:center">Nama Pelanggan</th>
            <th style="text-align:center">Menu</th>
            <th style="text-align:center">Total Harga</th>
            <th style="text-align:center">Status</th>
          </tr>
        </thead>
      <tbody>
        <?php
        include '../Connection/Connection.php';

        $data_menu = mysqli_query($koneksi, "CALL getTransaksi()");
        $nomor = 1;
        while($d = mysqli_fetch_array($data_menu)){
        ?>
        <tr>
          <td style="text-align: center;"><?php echo $nomor++; ?></td>
          <td style="text-align: center;"><input type="checkbox" name="pilihan[]" value="<?php echo $d['idpesanan']; ?>"<?php echo ($d['status'] == "paid") ? "disabled" : "" ?>></td>
          <td style="text-align: center;"><?php echo $d['meja']; ?></td>
          <td style="text-align: center;"><?php echo $d['namapelanggan']; ?></td>
          <td style="text-align: center;"><?php echo $d['namamenu']; ?></td>
          <td style="text-align: center;"><?php echo $d['totalHarga']; ?></td>
          <td style="text-align: center;"><?php echo $d['status']; ?></td>
        </tr>
        <?php
          }
        ?>
        </tbody>
        </table>
        <input class="btn btn-primary" type="submit" value="bayar" name="laporan">
        </form><br><br>

        <div id="bayar"><br><br>
            <?php
            if(isset($_POST['bayar'])){
                $pilih = $_POST['pilihan'];
                $totaltagihan = $_POST['totaltagihan'];
                $timestamp = date('Y-m-d H:i:s');
                for($k=0; $k < count($pilih); $k++)
                {
                include '../Connection/Connection.php';
                $ubah = "UPDATE pesanan, pelanggan SET meja='0', status ='paid', tgl_bayar='$timestamp' WHERE pesanan.idpelanggan = pelanggan.idpelanggan and idpesanan='$pilih[$k]'";
                $query = mysqli_query($koneksi,$ubah);
                echo "<div class='alert alert-warning' style='text-align:center;'>
                        <h3>Status Pembayaran Berhasil</h3>
                        </div>";
                }

            }
            else if(isset($_POST['pilihan'])){
                $totaltarif=0;
            ?>

            <center>
            <h1>Pembayaran</h1>
            </center>

            <div>
            <h3>Restoran Sedap Malam</h3>
            <p>Jl. Cibubur Indah II, Ciracas Jakarta Timur<br>
            Telpon: 081913781294</p>
            </div>
            <div>
            Tanggal Invoice:
            <?php echo date('Y-m-d H:i:s') ?>
            </div><br>

            <form action="kasir.php?#bayar" method="post">
                <fieldset>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                        <?php
                            if(isset($_POST['pilihan']))
                            {
                                $pilih = $_POST['pilihan'];
                                for ($i=0; $i < count($pilih); $i++)
                                {
                                    $chosen[$i] = $pilih[$i];
                                    echo $chosen[$i];
                                    echo "</br>";

                                }
                            }

                        ?>
                        </td>
                        <td>
                        <?php
                            if(isset($_POST['pilihan']))
                            {
                                $pilih = $_POST['pilihan'];
                                for($i= 0; $i < count($pilih); $i++)
                                {
                                    $chosen[$i] = $pilih[$i];
                                    include '../Connection/Connection.php';
                                    $data_pl = mysqli_query($koneksi, "SELECT p.Namapelanggan,p.meja, p.waktudatang, m.namamenu, m.harga, ps.status, m.Harga * ps.Jumlah as totalHarga
                                                                        FROM pelanggan p, user u, menu m, pesanan ps, transaksi t
                                                                        WHERE t.idpesanan = ps.idpesanan
                                                                        and ps.idmenu = m.idmenu
                                                                        and ps.idpelanggan = p.idpelanggan
                                                                        and ps.iduser = u.iduser
                                                                        and ps.idpesanan='$chosen[$i]'");
                                    while($dpl = mysqli_fetch_array($data_pl))
                                    {?>
                                    <div>
                                        <?php
                                        $namapelanggan[$i] = $dpl['Namapelanggan'];
                                        echo $namapelanggan[$i];
                                        ?>
                                    </div><?php
                                    } echo "</br>";
                                }
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            if(isset($_POST['pilihan']))
                            {
                                $pilih = $_POST['pilihan'];
                                for($i= 0; $i < count($pilih); $i++)
                                {
                                    $chosen[$i] = $pilih[$i];
                                    include '../Connection/Connection.php';
                                    $data_menu = mysqli_query($koneksi, "SELECT p.Namapelanggan,p.meja, p.waktudatang, m.namamenu, m.harga, ps.status, m.Harga * ps.Jumlah as totalHarga
                                                                        FROM pelanggan p, user u, menu m, pesanan ps, transaksi t
                                                                        WHERE t.idpesanan = ps.idpesanan
                                                                        and ps.idmenu = m.idmenu
                                                                        and ps.idpelanggan = p.idpelanggan
                                                                        and ps.iduser = u.iduser
                                                                        and ps.idpesanan='$chosen[$i]'");
                                    while($dmenu = mysqli_fetch_array($data_menu))
                                    {?>
                                    <div>
                                        <?php
                                        $namamenu[$i] = $dmenu['namamenu'];
                                        echo $namamenu[$i];
                                        ?>
                                    </div><?php
                                    } echo "</br>";
                                }
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            if(isset($_POST['pilihan']))
                            {
                                $pilih = $_POST['pilihan'];
                                for($i= 0; $i < count($pilih); $i++)
                                {
                                    $chosen[$i] = $pilih[$i];
                                    include '../Connection/Connection.php';
                                    $data_harga = mysqli_query($koneksi, "SELECT p.Namapelanggan,p.meja, p.waktudatang, m.namamenu, m.harga, ps.status, m.Harga * ps.Jumlah as totalHarga
                                                                        FROM pelanggan p, user u, menu m, pesanan ps, transaksi t
                                                                        WHERE t.idpesanan = ps.idpesanan
                                                                        and ps.idmenu = m.idmenu
                                                                        and ps.idpelanggan = p.idpelanggan
                                                                        and ps.iduser = u.iduser
                                                                        and ps.idpesanan='$chosen[$i]'");
                                    while($dharga = mysqli_fetch_array($data_harga))
                                    {?>
                                    <div>
                                        <?php
                                        $harga[$i] = $dharga['harga'];
                                        echo $harga[$i];
                                        ?>
                                    </div><?php
                                    } echo "</br>";
                                }
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            if(isset($_POST['pilihan']))
                            {
                                $pilih = $_POST['pilihan'];
                                for($i= 0; $i < count($pilih); $i++)
                                {
                                    $chosen[$i] = $pilih[$i];
                                    include '../Connection/Connection.php';
                                    $data_harga = mysqli_query($koneksi, "SELECT p.Namapelanggan,p.meja, p.waktudatang, m.namamenu, m.harga, ps.status, m.Harga * ps.Jumlah as totalHarga
                                                                        FROM pelanggan p, user u, menu m, pesanan ps, transaksi t
                                                                        WHERE t.idpesanan = ps.idpesanan
                                                                        and ps.idmenu = m.idmenu
                                                                        and ps.idpelanggan = p.idpelanggan
                                                                        and ps.iduser = u.iduser
                                                                        and ps.idpesanan='$chosen[$i]'");
                                    while($dharga = mysqli_fetch_array($data_harga))
                                    {?>
                                    <div>
                                        <?php
                                        $total[$i] = $dharga['totalHarga'];
                                        echo $total[$i];
                                        ?>
                                    </div><?php
                                    } echo "</br>";
                                }
                                $totaltarif = array_sum($total);
                            }
                        ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div style="text-align:right;  background:lightgrey; color: white; padding: 3px;">
                    <?php
                        if(isset($_POST['pilihan']))
                        {
                        $pilih = $_POST['pilihan'];
                        echo "<h1>Total Tagihan: ".$totaltarif."</h1>";

                        echo "Kasir: ".$nama;?></br>
                        <!--- :form action="halaman_kasir.php?<?php echo $datalogin; ?>&#bayar" method="post" --->
                        <form action="halaman_kasir.php?#bayar" method="post">
                            <?php
                            for($i= 0; $i < count($pilih); $i++)
                            {
                                $chosen[$i] = $pilih[$i];
                                ?>
                                <input type="text" name="pilihan[]" value="<?php echo $pilih[$i]; ?>" hidden>
                            <?php
                            }
                             include '../Connection/Connection.php';

                            ?>
                            <input type="text" name="totaltagihan" value="<?php echo $totaltarif; ?>" hidden>
                            <div>
                            </br>
                            <input type="submit" name="bayar" class="btn btn-primary btn-block" style="padding:11px;">
                            </div>
                            </br><?php
                        }
                        else
                        {
                        echo "<h1> ELSE detected </h1>";
                        }
                    ?>
                </div>

                </fieldset>
            </form>
            <?php } ?>
        </div>
        </br>

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
                <th style="text-align: center">Total</th>
                <th style="text-align: center">Pembayaran</th>
                <th style="text-align: center">Kembali</th>
                <th style="text-align: center">Waktu Pembayaran</th>
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
                  <td style="text-align: center"><?php echo $dc['total'] ?></td>
                  <td style="text-align: center"><?php echo $dc['Bayar'] ?></td>
                  <td style="text-align: center"><?php echo $dc['kembali'] ?></td>
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

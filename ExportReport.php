<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Restaurant | Export To Excel</title>
  </head>
  <body>
    <style type="text/css">
	body{font-family: verdana;}
	table{margin: 20px auto; border-collapse: collapse;}
	table th,table td{border: 1px solid #3c3c3c; padding: 3px 8px;}
	a{background: blue; color: #fff; padding: 8px 10px; text-decoration: none; border-radius: 2px;}
	</style>

  <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Report.xls");
  ?>

  <table class="table">
    <thead class="thead">
        <tr>
            <th>Nomor</th>
            <th>Id Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Total</th>
            <th>Pembayaran</th>
            <th>Kembali</th>
            <th>Waktu Pembayaran</th>
        </tr>
    </thead>
        <?php
            $nomor1=1;
            //include '../Connection/Connection.php';
            $koneksi = mysqli_connect('localhost','root','','restoran');
            if (mysqli_connect_errno()) {
                echo "Connection Error : " . mysqli_connect_errno();
            }
            $datacari2 = mysqli_query($koneksi, "CALL getReport()");
        ?>
        <?php
            while($dc = mysqli_fetch_array($datacari2))
        { ?>
            <tr>
                <td style="text-align: center;"><?php echo $nomor1++; ?></td>
                <td><?php echo $dc['idtransaksi']; ?></td>
                <td><?php echo $dc['Namapelanggan']; ?></td>
                <td><?php echo $dc['total']; ?></td>
                <td><?php echo $dc['Bayar']; ?></td>
                <td><?php echo $dc['kembali'] ?></td>
                <td><?php echo $dc['tgl_bayar']; ?></td>
            </tr> <?php
        }?>
    </table>
  </body>
</html>

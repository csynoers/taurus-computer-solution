<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";
$mulai=$_POST[dari];
$selesai=$_POST[sampai];
$tanggal = date("Y-m-d");
$tanggal3=tgl_indo($tanggal);

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Laporan Penjualan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css" media="print">
body{
	font-size: 12px;
}
@page
{
	size: landscape;
	margin: 2cm;
	font-size: 10px;
}
</style>
</head>

<body onload="print()">

<!-- Part 1: Wrap all page content here -->
<div id="wrap">

<header class="container jumbotron subhead" id="overview">
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
      <center>
        <h3>Taurus Computer Solution </h3>
        Jalan Dr. Sardjito, Blimbingsari, GK V No. 10  Yogyakarta
    <br/>
     Telp. 085215948508
    </center>
      </div>
    </div>
  </div>
</header>
<!-- Begin page content -->
<div class="container bg">
  <div class="row-fluid">
    <div class="span12">
      <div>
<center><h5>Laporan Penjualan Dari Tanggal <?php echo"$mulai Sampai Tanggal $selesai";?></h5></center>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
		<th>Tanggal</th>
		<th>Nama Produk</th>
		<th>Qty</th>
		<th>Harga</th>
		<th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$no=1;
   // Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("SELECT orders.id_orders as faktur,orders.tanggal as tanggal,
                    nama_produk,jumlah,harga 
                    FROM orders, orders_detail, produk  
                    WHERE (orders_detail.id_produk=produk.id_produk) 
                    AND (orders_detail.id_orders=orders.id_orders) 
                    AND (orders.tanggal BETWEEN '$mulai' AND '$selesai')");
while($r = mysql_fetch_array($sql)){
  $quantityharga=format_rupiah($r[jumlah]*$r[harga]);
  $hargarp=format_rupiah($r[harga]); 
   $tanggal4=tgl_indo($r[tanggal]); 
     echo "<tr>
	          <td>$no</td>
			  <td>$tanggal4</td>
			  <td>$r[nama_produk]</td>			  
			  <td>$r[jumlah]</td>
			  <td>Rp. $hargarp</td>
			  <td>Rp. $quantityharga</td>
		  </tr>";
	$total = $total+($r[jumlah]*$r[harga]);
	$totqu = $totqu + $r[jumlah];
		  $no++;
    }
	$tot=format_rupiah($total);
echo "<tr><td colspan=5 align=right>Total Keseluruhan : </td><td align=right>Rp. $tot</td></tr>
      <tr><td colspan=3 align=right>Total Produk Terjual : </td><td align=right>$totqu Item</td></tr>
     ";
    ?>
    </tbody>
  </table>
  <div style="clear:both"></div>
  <table width="100%">
  <tbody>
	<tr>
		<td colspan="8" style="height:20px"></td>
	</tr>
	<tr>
		<td width="70%"></td>
		<td align="center">
		Yogyakarta, <?php echo" $tanggal3";?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">
		Mengetahui
		</td>
	</tr>
	<tr>
		<td colspan=2 style="height:65px"></td>
	</tr>
	<tr>
		<td></td>
		<th>
		(<?php echo"$_SESSION[namalengkap]";?> )
		</th>
	</tr>
	</tbody>
  </table>
      </div>
    </div>
  </div>
  <div id="push"></div>
</div>
</body>
</html>

<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";
include "../../../config/fungsi_rupiah.php";
$tanggal = date("Y-m-d");
$tanggal3=tgl_indo($tanggal);
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cetak Struk Servis</title>
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
<center><h5>Struk Servis</h5></center>
<?php
$edit=mysql_query("SELECT * FROM servis,member WHERE servis.id_member=member.id_member AND servis.id_servis='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$tanggal=tgl_indo($r[tanggal]);
echo"<div class='table-responsive'>
		  <table class='table'>
          <tr>
											<td>Kode servis</td>
											<td>$r[id_servis]</td>
										</tr>
										<tr>
											<td>Nama member</td>
											<td>$r[nama]</td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>$r[alamat_member]</td>
										</tr>			
										<tr>
											<td>No. Telp</td>
											<td>$r[no_telp]</td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td>$r[keterangan]</td>
										</tr>
										<tr>
											<td>Tanggal</td>
											<td>$tanggal </td>
										</tr>
										</table>
		  <div>";	
?>
  <table class="table" border="1">
    <thead>
      <tr bgcolor=#D3DCE3>
        <th>No</th>
		<th>Nama sparepart</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Sub total</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$no=1;
    $tampil = mysql_query("SELECT * FROM detail_servis
													LEFT JOIN servis
													ON detail_servis.id_servis=servis.id_servis
													LEFT JOIN sparepart
													ON detail_servis.id_sparepart=sparepart.id_sparepart
													WHERE servis.id_servis='$_GET[id]'
													ORDER BY servis.id_servis DESC");
							while ($r=mysql_fetch_array($tampil)){
							$jml=$r[jumlah];
							$harga=$r[harga];
							$subtotal=$jml*$harga;
							$total       = $total + $subtotal;
							$total_rp    = format_rupiah($total);
							$subtotal_rp = format_rupiah($subtotal);
							$harga_rp       = format_rupiah($harga);
							echo"<tr>
									<td>$no</td>                         
									<td>$r[nama_sparepart]</a></td>
									<td>Rp. $harga_rp</td>		         
									<td>$r[jumlah]</td>
									<td>Rp. $subtotal_rp</td>
		  </tr>";
		  $no++;
    }
echo "<tr><td colspan=4>Total :  </td>
									<td ><b>Rp. $total_rp</b></td></tr>
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
		<td></td>
		<td align="center">
		
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

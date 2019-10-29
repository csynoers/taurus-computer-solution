<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");
if ($module=='servis' AND $act=='input'){
	$edit=mysql_query("SELECT * FROM servis WHERE id_servis='$_POST[id_servis]'");
    $r=mysql_fetch_array($edit);
	$kode=$_POST[id_servis];
	$jumlah=$_POST[jumlah];
	mysql_query("INSERT INTO detail_servis(id_servis,
								id_sparepart,
								jumlah) 
	                       VALUES('$_POST[id_servis]',
								'$_POST[sparepart]',
								'$_POST[jumlah]')");
$id_sparepart=$_POST[sparepart];
$kode_supplier=$_POST[kode_supplier];							
$cek=mysql_query("SELECT * FROM sparepart WHERE id_sparepart='$id_sparepart'");
$p    = mysql_fetch_array($cek);
$stok=$p[stok];
$harga1=$p[harga];
$tot1=$stok*$harga1;
$tot2=$jumlah*$harga_beli;
$stok2=$jumlah+$stok;
$hasil=($tot1+$tot2)/$stok2;
															
	mysql_query("UPDATE sparepart SET stok   = stok-'$_POST[jumlah]'
                       WHERE  id_sparepart = '$_POST[sparepart]'");

  header('location:../../media.php?module=servis&act=transaksiservis&kode='.$kode);							
							
}
elseif ($module=='servis' AND $act=='tambah'){
$kode=$_POST[id_servis];
	mysql_query("INSERT INTO servis(id_servis,					 
									id_member,
									tanggal,
									keterangan) 
	                       VALUES('$_POST[id_servis]',
                                '$_POST[member]',
								'$_POST[tgl_servis]',
								'$_POST[keterangan]')");
	
								
	header('location:../../media.php?module=servis&act=transaksiservis&kode='.$kode);							
}
// Hapus sparepart
elseif ($module=='servis' AND $act=='delete'){
$edit=mysql_query("SELECT * FROM detail_servis WHERE id_detail='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[kode_servis];
	$jumlah=$r[jumlah];
	$id_sparepart=$r[id_sparepart];
  mysql_query("DELETE FROM detail_servis WHERE id_detail='$_GET[kode]'");
  mysql_query("UPDATE sparepart SET stok   = stok-'$jumlah'                                   
                           WHERE  id_sparepart     = '$id_sparepart'");
  header('location:../../media.php?module=servis&act=transaksiservis&kode='.$kodes);
}
?>

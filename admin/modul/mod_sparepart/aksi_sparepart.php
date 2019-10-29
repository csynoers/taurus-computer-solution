<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
// Hapus sparepart
if ($module=='sparepart' AND $act=='hapus'){
  mysql_query("DELETE FROM sparepart WHERE id_sparepart='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input sparepart
elseif ($module=='sparepart' AND $act=='input'){
  mysql_query("INSERT INTO sparepart(nama_sparepart,stok,harga) VALUES('$_POST[nama_sparepart]','$_POST[stok]','$_POST[harga]')");
  header('location:../../media.php?module='.$module);
}

// Update sparepart
elseif ($module=='sparepart' AND $act=='update'){
  mysql_query("UPDATE sparepart SET nama_sparepart='$_POST[nama_sparepart]',
									harga='$_POST[harga]',
									stok='$_POST[stok]'
               WHERE id_sparepart = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>

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
// Hapus merk
if ($module=='merk' AND $act=='hapus'){
  mysql_query("DELETE FROM merk WHERE id_merk='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input merk
elseif ($module=='merk' AND $act=='input'){
  mysql_query("INSERT INTO merk(nama_merk) VALUES('$_POST[nama_merk]')");
  header('location:../../media.php?module='.$module);
}

// Update merk
elseif ($module=='merk' AND $act=='update'){
  mysql_query("UPDATE merk SET nama_merk='$_POST[nama_merk]' 
               WHERE id_merk = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>

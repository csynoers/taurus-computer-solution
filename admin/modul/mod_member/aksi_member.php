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
$tgl= date("Y-m-d");
// Hapus member
if ($module=='member' AND $act=='hapus'){
  mysql_query("DELETE FROM member WHERE id_member='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

if ($module=='member' AND $act=='update'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE member SET nama   = '$_POST[nama]',
                                  email          = '$_POST[email]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_member     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE member SET password        = '$pass',
                                 nama    = '$_POST[nama]',
                                 email           = '$_POST[email]',
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE id_member      = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=member')</script>";
}
// Input user
elseif ($module=='member' AND $act=='input'){
  $pass=md5($_POST[password]);
  $sql = mysql_query("SELECT * FROM user WHERE no_telp='$_POST[no_telp]' OR email='$_POST[email]'");
$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! No telp atau Email yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysql_query("INSERT INTO member(alamat_member,
                                 password,
                                 nama,
                                 email, 
                                 no_telp,
								 tgl_daftar) 
	                       VALUES('$_POST[alamat_member]',
                                '$pass',
                                '$_POST[nama]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'$tgl')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=member')</script>";
		}
}
}
?>

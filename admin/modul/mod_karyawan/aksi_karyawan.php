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
if ($module=='karyawan' AND $act=='hapus'){
  mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='karyawan' AND $act=='input'){
  $pass=md5($_POST[password]);
  $sql = mysql_query("SELECT * FROM user WHERE username='$_POST[username]' OR email='$_POST[email]'");
$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! Username atau Email yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysql_query("INSERT INTO user(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
								 level) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'karyawan')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=karyawan')</script>";
		}
}

// Update user
elseif ($module=='karyawan' AND $act=='update'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE user SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  username       = '$_POST[username]',
								  email          = '$_POST[email]',  
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_user     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE user SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 username       = '$_POST[username]',
								 email           = '$_POST[email]',  
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE id_user      = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=karyawan')</script>";
}
}
?>

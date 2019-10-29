<?php
session_start();

include "config/koneksi.php";

if (empty($_POST[password])) {
    mysql_query("UPDATE member SET nama   = '$_POST[nama]',
                                  email          = '$_POST[email]',
								  alamat_member    = '$_POST[alamat]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_member     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE member SET password        = '$pass',
                                 nama    = '$_POST[nama]',
								 alamat_member    = '$_POST[alamat]',
                                 email           = '$_POST[email]',  
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE id_member      = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('edit-member.html')</script>";
?>

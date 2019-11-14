<?php
  session_start();
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

    include "../../../config/koneksi.php";
    include "../../../config/helper_file.php";

    $module=$_GET['module'];
    $act=$_GET['act'];

    // Input warna
    elseif ($module=='warna' AND $act=='input'){
        
        header('location:../../media.php?module='.$module);
    }

    // Update warna
    elseif ($module=='merk' AND $act=='update'){
        $json = '../../../json/warna.json';
        $rows= read_file($json);
        $id= $_GET['id'];
        
        $rows[$id] = $_POST['warna'];
        overwrite_file($json,$rows);

        echo "<script>window.alert('warna berhasil diubah');
        window.location=('../../media.php?module={$module}')</script>";
    }
}
?>

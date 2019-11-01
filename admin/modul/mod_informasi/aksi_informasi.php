<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}

else{

    $module=$_GET['module'];
    $act=$_GET['act'];
    include "../../../config/helper_file.php";
    

    if ($module=='informasi' AND $act=='update')
    {
        $json = '../../../json/informasi.json';
        $rows= read_file($json);
        $id= $_GET['id'];
        
        $rows->$id = $_POST['deskripsi'];
        overwrite_file($json,$rows);

        echo "<script>window.alert('informasi berhasil diubah');
        window.location=('../../media.php?module={$module}')</script>";
    }
}
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
    include "../../../config/helper_upload.php";
    
    if ($module=='slideshow' AND $act=='insert')
    {
        $json = '../../../json/slideshow.json';
        $rows= read_file($json);

        $filename = img_resize($_FILES['fupload'],1024,'../../../src/slideshow/'); 
        
        $rows[] = $filename;
        overwrite_file($json,$rows);

        echo "<script>window.alert('slideshow berhasil diubah');
        window.location=('../../media.php?module={$module}')</script>";
    }

    if ($module=='slideshow' AND $act=='update')
    {
        $json = '../../../json/slideshow.json';
        $rows= read_file($json);
        $id= $_GET['id'];

        $filename = img_resize($_FILES['fupload'],1024,'../../../src/slideshow/'); 
        
        if ( $filename != 'error' ) {
            if( ($rows[$id] != '') && file_exists("../../../src/slideshow/{$rows[$id]}") ){
                unlink("../../../src/slideshow/{$rows[$id]}");
            }
            $rows[$id] = $filename;
            overwrite_file($json,$rows);
        }

        echo "<script>window.alert('slideshow berhasil diubah');
        window.location=('../../media.php?module={$module}')</script>";
    }
}
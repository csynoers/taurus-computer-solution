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
    
    if ($module=='logo' AND $act=='update')
    {
        $json = '../../../json/logo.json';
        $row= read_file($json);
        $filename = img_resize($_FILES['fupload'],193,'../../../src/logo/'); 
        
        if ( $filename != 'error' ) {
            if( ($row->filename != '') && file_exists("../../../src/logo/{$row->filename}") ){
                unlink("../../../src/logo/{$row->filename}");
            }
            overwrite_file($json,['filename'=>$filename]);
        }

        echo "<script>window.alert('Logo berhasil diubah');
        window.location=('../../media.php?module={$module}')</script>";
    }
}
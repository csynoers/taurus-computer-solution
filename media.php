<?php
    //start session
    session_start();

    function read_file()
    {
        return json_decode( file_get_contents("json/logo.json") );
    }
    function overwrite_file($rows)
    {
        return file_put_contents("json/logo.json", json_encode($rows) );
    }
    overwrite_file([1,2,3,4,5]);

    /* load config required */
    include_once "config/koneksi.php";
	include_once "config/fungsi_thumb.php";
	include_once "config/fungsi_indotgl.php";
	include_once "config/class_paging.php";
	include_once "config/fungsi_combobox.php";
	include_once "config/library.php";
	include_once "config/fungsi_rupiah.php";
	$succesUrl = $serverUrlAndPath."success.php";
	$failUrl = $serverUrlAndPath."fail.php";
    $statusUrl = $serverUrlAndPath."status.php";

    echo '<pre>';
	print_r(read_file());
	echo '</pre>';
    
    /* load template */
    include_once('template.php');
    ob_end_flush();
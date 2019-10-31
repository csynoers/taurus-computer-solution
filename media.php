<?php
    //start session
    session_start();

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
	print_r($_SESSION);
	echo '</pre>';
    
    /* load template */
    include_once('template.php');
    ob_end_flush();
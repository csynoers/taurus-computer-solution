<?php
    date_default_timezone_set("Asia/Jakarta");
    // error_reporting(0);
    $server   = "localhost";
    $username = "smpnseda_5c3";
    $password = "3.s.0.c.9.m.7";
    $database = "smpnseda_tauruskomputer";

    // Koneksi dan memilih database di server
    mysql_connect($server,$username,$password) or die("Koneksi gagal");
    mysql_select_db($database) or die("Database tidak bisa dibuka");
?>

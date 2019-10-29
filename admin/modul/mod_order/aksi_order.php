<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='order' AND $act=='update'){
   
     mysql_query("UPDATE orders SET status='$_POST[status]' where id_orders='$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
}


?>

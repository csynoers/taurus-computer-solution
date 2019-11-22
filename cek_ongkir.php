<?php
error_reporting(0);
require_once 'vendor/autoload.php';
  $o = $_GET['o'];
  $q = $_GET['q'];
  $p = $_GET['p'];
  $w = $_GET['w'];
  $biaya = RajaOngkir\RajaOngkir::Cost([
  'origin'    => $o, // id kota asal 
  'destination'   => $p, // id kota tujuan
  'weight'    => $w, // berat satuan gram
  'courier'     => $q , // kode kurir pengantar ( jne / tiki / pos )
  ])->get();
   
  foreach ($biaya as $key => $value) 
  {
    $costs = $value['costs'];
    foreach ($costs as $key2 => $value2) 
    {
      $cost = $value2['cost'];
       $cos = $cost[0]['value'];
       echo '<option value="'.$cos.' '.$value2['service'].'" >'.$value2['service'].' : '.$cos.'</option>';
    }
  }
  
  
?>

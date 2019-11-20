<?php
require_once 'vendor/autoload.php';


$name ='';
$provinsi_id = $_GET['q'];
$data = RajaOngkir\RajaOngkir::Kota()->byProvinsi($provinsi_id)->search('city_name', $name)->get();
print_r(RajaOngkir\RajaOngkir::Kota()->byProvinsi($provinsi_id)->get());
foreach ($data as $key => $value) {
  echo'<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>';
}
?>
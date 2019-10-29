<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='keranjang' AND $act=='tambah'){

	$sid = session_id();

	$sql2 = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$r=mysql_fetch_array($sql2);
	$stok=$r[stok];
    $harga=$r[harga];
  if ($stok == 0){
      echo "<script>window.alert('Maaf Stok Habis');
        window.location=('index.php')</script>";
  }
  else{
	// check if the product is already
	// in keranjang table for this session
	$sql = mysql_query("SELECT id_produk FROM keranjang
			WHERE id_produk='$_GET[id]' AND id_session='$sid'");
	$ketemu=mysql_num_rows($sql);
	if ($ketemu==0){
		// put the product in keranjang table
		mysql_query("INSERT INTO keranjang (id_produk, price,jumlah, id_session, tgl, jam, stok_temp)
				VALUES ('$_GET[id]','$harga', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
	} else {
		// update product quantity in keranjang table
		mysql_query("UPDATE keranjang 
		        SET jumlah = jumlah + 1
				WHERE id_session ='$sid' AND id_produk='$_GET[id]'");		
	}	
	deleteAbandonedkeranjang();
	header('Location:keranjang-belanja.html');
  }				
}

elseif ($module=='keranjang' AND $act=='hapus'){
	mysql_query("DELETE FROM keranjang WHERE id_keranjang='$_GET[id]'");
	header('Location:keranjang-belanja.html');				
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT stok_temp FROM keranjang WHERE id_keranjang='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
    if ($jumlah[$i] > $r[stok_temp]){
        echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
        window.location=('keranjang-belanja.html')</script>";
    }
    else{
      mysql_query("UPDATE keranjang SET jumlah = '".$jumlah[$i]."'
                                      WHERE id_keranjang = '".$id[$i]."'");
      header('Location:keranjang-belanja.html');
    }
  }
  }
}


/*
	Delete all keranjang entries older than one day
*/
function deleteAbandonedkeranjang(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM keranjang 
	        WHERE tgl < '$kemarin'");
}
?>

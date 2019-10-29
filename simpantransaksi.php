<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";
function acak($panjang)
{
    $karakter= '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
$hasil= acak(6);
function ngacak($panj)
{
    $karakter= '123456789';
    $string = '';
    for ($i = 0; $i < $panj; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
//cara memanggilnya
$paket=$_POST[paket];
$pecah = explode(" ", $paket);
 //mencari element array 0
 $ha = $pecah[0];
 $ha1 = $pecah[1];
$kode= ngacak(3);
if (empty($_SESSION['namalengkap']) AND empty($_SESSION['passuser'])){

echo "<script>window.alert('Anda belum Login, Silahkan Login Terlebih dahulu');
        window.location=('media2.php?module=login')</script>";
}
else {
//$sql = "SELECT * FROM	kustomer WHERE email='$email' AND password='$password'";
$sql = "SELECT * FROM member WHERE id_member='$_SESSION[member_id]'";
$cek = mysql_query($sql);
$r = mysql_fetch_array($cek);


$tgl_skrg = date("Y-m-d");
$jam_skrg = date("H:i:s");


  
// mendapatkan nomor orders
$id_orders=$hasil;

$sid = session_id();
$data = mysql_query("SELECT * FROM keranjang,produk WHERE keranjang.id_produk=produk.id_produk AND keranjang.id_session='$sid'");
    while($p=mysql_fetch_array($data)){
// simpan data detail pemesanan  
    $id=$p[id_produk];
	$jumlah=$p[jumlah];
	$price=$p[price];
	$subtotalberat = $p[berat] * $p[jumlah]; // total berat per item produk
	$subtotal=$jumlah*$price;
	$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
	$total   = $total + $subtotal;
	$grandtotal=$total+$kode;
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$hasil',$id, $jumlah)");

	mysql_query("UPDATE produk 
		        SET stok = stok - $jumlah
				WHERE id_produk='$id'");		   
	}
$ongkoskirim1=$ha;
$ongkoskirim = $ongkoskirim1;

$grandtotal1    = $grandtotal + $ongkoskirim; 
$jumlah_order = mysql_fetch_array(mysql_query("select count(*) as total from orders WHERE tgl_order='" . date("Y-m-d") . "'"));
 $allitem = mysql_fetch_array(mysql_query("SELECT * FROM orders_temp,produk "
            . "WHERE orders_temp.id_produk=produk.id_produk "
            . "AND id_session='$sesid'"));
            $rekap = "Pembelian di Toko Taurus Computer Solution ";
$rekaps = array();
            $totalquantity = 0;
            foreach ($allitem as $_it) {
                $rekaps[] = $_it["nama_produk"] . " (" . $_it[jumlah] . ")";
                $totalquantity = $totalquantity + $_it[jumlah];
            }
            $rekap .= implode(", ", $rekaps);
// simpan data pemesanan 
mysql_query("INSERT INTO orders(id_orders,id_member, tanggal, jam,total,kode,ongkir,grandtotal,alamat_pengiriman,kurir,paket) 
             VALUES('$hasil','$_SESSION[member_id]','$tgl_skrg','$jam_skrg','$total','$kode','$ha','$grandtotal1','$_POST[alamat]','$_POST[Kurir]','$ha1')");
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)

  mysql_query("DELETE FROM keranjang
	  	         WHERE id_session='$sid'");

header('location:media2.php?module=konfirmasipembayaran&id='.$hasil);						
}
?>

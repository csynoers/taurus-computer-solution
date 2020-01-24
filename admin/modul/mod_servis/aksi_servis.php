<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");
if ($module=='servis' AND $act=='input'){
	$data = [];
	$data['insertDetailServis'] = "INSERT INTO `detail_servis`(`id_servis`, `id_sparepart`, `jumlah`) VALUES ('{$_POST['id_servis']}','{$_POST['sparepart']}','{$_POST['jumlah']}')";

	$data['updateSparepart'] = "UPDATE `sparepart` SET `stok`=(`stok`-{$_POST['jumlah']}) WHERE `id_sparepart`='{$_POST['sparepart']}' ";
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
	// die();
	mysql_query($data['insertDetailServis']);
	mysql_query($data['updateSparepart']);
	header("location:../../media.php?module=servis&act=transaksiservis&kode={$_POST['id_servis']}");											
}
elseif ($module=='servis' AND $act=='tambah'){
	$kode = $_POST['id_servis'];
	mysql_query("
		INSERT INTO servis(
			id_servis,
			id_member,
			tanggal,keterangan
		) 
		VALUES(
			'$_POST[id_servis]',
			'$_POST[member]',
			'$_POST[tgl_servis]',
			'$_POST[keterangan]'
		)
	");

	header('location:../../media.php?module=servis&act=transaksiservis&kode='.$kode);							
}
// Hapus sparepart
elseif ($module=='servis' AND $act=='delete'){
	$data = [];
	$data['deleteDetailServis'] = "DELETE FROM detail_servis WHERE id_detail='{$_GET['id_detail']}' ";
	$data['updateSparepart'] = "UPDATE `sparepart` SET `stok`=(`stok`+{$_GET['jumlah']}) WHERE `id_sparepart`='{$_GET['id_sparepart']}' ";
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
	// die();
	mysql_query($data['deleteDetailServis']);
	mysql_query($data['updateSparepart']);
	header('location:../../media.php?module=servis&act=transaksiservis&kode='.$_GET['id_servis']);
}
elseif ($module=='servis' AND $act=='biaya'){
	$data = [];
	$data['updateServis'] = "UPDATE `servis` SET biaya_servis='{$_POST['biaya_servis']}' WHERE id_servis='{id_servis}' ";
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
	// die();
	mysql_query($data['updateServis']);
	header('location:../../media.php?module=servis&act=detailservis&id='.$_POST['id_servis']);
}
?>

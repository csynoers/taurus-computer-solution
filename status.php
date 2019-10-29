<?php
/*//////////////////////////////////////////////////////////////////////

Description:	FasaPay Sample Store
Release Date:     Feb, 2011
File : Fasapay SCI Status Page

Designed and Developed by FasaPay development team.
Copyright (c) 2011 FasaPay.
Website: http://www.fasapay.com
Contact email: support@fasapay.com

//////////////////////////////////////////////////////////////////////*/

require_once("include/config.php");

//Anda bisa menggunakan variable ini untuk
//mendapatkan variable yg anda taruh di request_form
// $_REQUEST['orderid']
// $_REQUEST['fp_paidto']
// ...

///Building String to calculate hash
$msg = '';
$msg .= $_REQUEST['fp_paidto'].':';
$msg .= $_REQUEST['fp_paidby'].':';
$msg .= $_REQUEST['fp_store'].':';
$msg .= $_REQUEST['fp_amnt'].':';
$msg .= $_REQUEST['fp_batchnumber'].':';
$msg .= $_REQUEST['fp_currency'].':';
$msg .= $merchantSecurityWord;

//calculate hash				
$hash = hash('sha256', $msg);

//Cek apakah variable ada dan 
//sama dengan yang ada di konfigurasi kita
if( isset($_REQUEST['fp_paidto']) &&
	strtoupper($_REQUEST['fp_paidto']) == $merchantAccountNumber &&
	isset($_REQUEST['fp_store']) &&
	strtoupper($_REQUEST['fp_store']) == $merchantStoreName &&
	isset($_REQUEST['fp_hash']) &&
	strtoupper($_REQUEST['fp_hash']) == $hash){
		
	// Pembayaran tervalidasi, anda bisa menggunakan informasi 
	// validasi ini untuk menyelesaikan transaksi anda
	// masukan kode, perintah atau logic apapun disini
	
	// pada script ini nanti kita mengirmkan email ke merchant
	// tulis pesan untuk merchant
	$msgBody = "Pembayaran tervalidasi dan sukses";
		
	
} else {
	// Validasi pembayaran gagal
	// masukan kode, perintah atau logic apapun disini
	
	// pada script ini nanti kita mengirmkan email ke merchant
	// tulis pesan untuk merchant
	$msgBody = "Respon salah, data tidak benar";	
}

// menambahkan data yg diterima dari SCI kedalam email
$msgBody .= 'Data yg diterima :\n';
$reqKeys = array_keys ($_REQUEST);
foreach($reqKeys as &$key) {
	$msgBody .= $key." = ".$_REQUEST[$key].(ereg("^fp_[a-z_]*$", $key) ? " (FP)" : "")."\n";
}


// Kirim email ke merchan
$merchantEmail = "merchant@mystore.com";
mail($conf_merchantEmail, "FP SCI Status", $msgBody);

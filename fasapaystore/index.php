<?
/*//////////////////////////////////////////////////////////////////////

Description:	FasaPay Sample Store
Release Date:     Feb, 2011
File : Fasapay SCI Request Form

Designed and Developed by FasaPay development team.
Copyright (c) 2011 FasaPay.
Website: http://www.fasapay.com
Contact email: tech@fasapay.com

//////////////////////////////////////////////////////////////////////*/
require_once("include/config.php");

$serverUrlAndPath = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["REQUEST_URI"]);

$succesUrl = $serverUrlAndPath."success.php";
$failUrl = $serverUrlAndPath."fail.php";
$statusUrl = $serverUrlAndPath."status.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fasapay Store Sample</title>
<style type="text/css">
.catatan {
	font-size: x-small;
}
body {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>

<table width="750" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td width="200" align="center" valign="top">#FOTO 1</td>
    <td width="250" valign="top"><h1>BARANG 1</h1>
    <p>Rp. 10.000,-</p></td>
    <td width="280">Dengan Cara ini Maka success url, fail url, dan status url akan di ambil dari Toko yang anda buat di FasaPay</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><!-- FORM SCI FasaPay -->
<form id="form1" name="form1" method="post" action="https://sci.fasapay.com/">
	<input type="hidden" name="fp_acc" value="FP498022">
    <input type="hidden" name="fp_acc_from" value="" />
    <input type="hidden" name="fp_store" value="Sinar Batik">
    <input type="hidden" name="fp_item" value="Pembelian Produk Sinar Abdai">
    <input type="hidden" name="fp_amnt" value="10000">
    <input type="hidden" name="fp_currency" value="IDR">
    <input type="hidden" name="fp_comments" value="Pembayaran menggunakan store variable">
    <input type="hidden" name="fp_merchant_ref" value="BL000001" />
    <!-- baggage fields -->
    <input type="hidden" name="track_id" value="558421222">
    <input type="hidden" name="order_id" value="BJ2993800">
  <input name="" type="submit" value="Check Out" />
</form>
<!-- END FORM SCI --></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">#FOTO 2</td>
    <td valign="top"><h1>BARANG 2</h1>
    <p>Rp. 20.000,-</p></td>
    <td><p>Dengan Cara ini Anda tidak perlu membuat Toko di FasaPay cukup menjadi member dengan status Store.</p>
    <p>nama toko, success url, fail url, dan status url akan di ambil dari form ini.</p>
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td><label for="akun number">Nama Toko</label></td>
        <td><input type="text" name="store name" id="store name" /></td>
      </tr>
      <tr>
        <td><label for="Sukses Url">Success Url</label></td>
        <td><input type="text" name="Sukses Url" id="Sukses Url" /></td>
      </tr>
      <tr>
        <td><label for="fail_url">Fail Url</label></td>
        <td><input type="text" name="fail_url" id="fail_url" /></td>
      </tr>
      <tr>
        <td><label for="status_url">Status Url</label></td>
        <td><input type="text" name="status_url" id="status_url" /></td>
      </tr>
    </table>
    <div class="catatan">
      <p>Catatan : Jika anda sudah memili toko di Fasapay maka sebaiknya menggunakan cara pertama karena data success url, fail url, status url akan tetap diambil dari toko yg ada di FasaPay</p>
</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><!-- FORM SCI FasaPay -->
      <form id="form2" name="form1" method="post" action="https://sandbox.fasapay.com/sci/">
    <input type="hidden" name="fp_acc" value="<?php echo $merchantAccountNumber ?>">
        <input type="hidden" name="fp_acc_from" value="" />
        <input type="hidden" name="fp_store" value="<?php echo $merchantStoreName ?>">
        <input type="hidden" name="fp_item" value="Barang nomor 1">
        <input type="hidden" name="fp_amnt" value="10000">
        <input type="hidden" name="fp_currency" value="IDR">
        <input type="hidden" name="fp_comments" value="Pembayaran menggunakan store variable">
        <input type="hidden" name="fp_merchant_ref" value="BL000001" />
        <input type="hidden" name="fp_succes_url" value="<?php echo $succesUrl ?>" />
        <input type="hidden" name="fp_succes_method" value="POST" />
        <input type="hidden" name="fp_fail_url" value="<?php echo $failUrl ?>" />
        <input type="hidden" name="fp_fail_method" value="POST" />
        <input type="hidden" name="fp_status_url" value="<?php echo $statusUrl ?>" />
        <!-- baggage fields -->
        <input type="hidden" name="track_id" value="trak123456" />
        <input type="hidden" name="order_id" value="order00111" />
        <input name="input" type="submit" value="Check Out" />
      </form>
      <!-- END FORM SCI --></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>
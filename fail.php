<?php
/*//////////////////////////////////////////////////////////////////////

Description:	FasaPay Sample Store
Release Date:     Feb, 2011
File : Fasapay SCI Success Page

Designed and Developed by FasaPay development team.
Copyright (c) 2011 FasaPay.
Website: http://www.fasapay.com
Contact email: support@fasapay.com

//////////////////////////////////////////////////////////////////////*/

require_once("include/config.php");

?>
<h1> Pembelian berikut batal</h1>
<table border="1" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="row">Nomor Order</th>
    <td>&nbsp;<?php echo $_REQUEST['order_id'] ?></td>
  </tr>
  <tr>
    <th scope="row">Nama</th>
    <td>&nbsp;<?php echo $_REQUEST['nama_item'] ?></td>
  </tr>
  <tr>
    <th scope="row">Harga</th>
    <td> Rp. <?php echo $_REQUEST['fp_amnt'] ?></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>


<h2> Data dari FasaPay</h2>

<table>
  <thead>
    <tr>
      <th style="text-align: left">
        Name
      </th>
      <th style="text-align: left">
        Value
      </th>
    </tr>
  </thead>
  <tbody>
    
<?
$reqKeys = array_keys ($_REQUEST);
foreach($reqKeys as &$key) {
?>
    <tr>
      <td><?php echo $key ?></td>
      <td><?php echo $_REQUEST[$key] ?></td>
    </tr>
<?
}
?>
  </tbody>
</table>



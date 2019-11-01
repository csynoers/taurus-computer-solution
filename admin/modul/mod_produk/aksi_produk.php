<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus produk
if ($module=='produk' AND $act=='hapus'){
$data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
     unlink("../../../foto_produk/$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='produk' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];

  $produk_seo      = seo_title($_POST['nama_produk']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    $filename = img_resize($_FILES['fupload'],1024,'../../../foto_produk/'); 

    mysql_query("INSERT INTO produk(nama_produk,
                                    id_merk,
									berat,
                                    harga,
                                    stok,
                                    deskripsi,
                                    gambar) 
                            VALUES('$_POST[nama_produk]',
                                   '$_POST[merk]',
								   '$_POST[berat]',
                                   '$_POST[harga]',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]',
                                   '{$filename}')");
								   
  }
  else{
    mysql_query("INSERT INTO produk(nama_produk,
                                    id_merk,
									berat,
                                    harga,
                                    stok,
                                    deskripsi) 
                            VALUES('$_POST[nama_produk]',
                                    '$_POST[merk]',
									'$_POST[berat]',                               
                                   '$_POST[harga]',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]')");
		
  }
  header('location:../../media.php?module='.$module);
}

// Update produk
elseif ($module=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                  berat       = '$_POST[berat]',
                                   id_merk = '$_POST[merk]',
								   harga       = '$_POST[harga]',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_produk   = '$_POST[id]'");
							 
  }
  else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   berat       = '$_POST[berat]',
                                   id_merk = '$_POST[merk]',
								   harga       = '$_POST[harga]',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
						 
  }
  header('location:../../media.php?module='.$module);
}
?>

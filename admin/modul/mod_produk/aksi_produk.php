<?php
    session_start();
    include "../../../config/koneksi.php";
    include "../../../config/library.php";
    include "../../../config/fungsi_thumb.php";
    // include "../../../config/fungsi_seo.php";

    $module=$_GET['module'];
    $act=$_GET['act'];

    // Hapus produk
    if ($module=='produk' AND $act=='hapus'){
        $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
        if ($data['gambar']!=''){
            unlink("../../../foto_produk/{$data['gambar']}");
            unlink("../../../foto_produk/big_{$data['gambar']}");
            unlink("../../../foto_produk/medium_{$data['gambar']}");
            unlink("../../../foto_produk/small_{$data['gambar']}");   
            mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
        }
        else{
            mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
        }
        header('location:../../media.php?module='.$module);
    }

    // Input produk
    elseif ($module=='produk' AND $act=='input'){
        $lokasi_file    = $_FILES['fupload']['tmp_name'];
        $tipe_file      = $_FILES['fupload']['type'];
        $nama_file      = $_FILES['fupload']['name'];
        $acak           = rand(1,99);
        $nama_file_unik = $acak.$nama_file; 

        //   $produk_seo      = seo_title($_POST[nama_produk]);

        // Apabila ada gambar yang diupload
        if (!empty($lokasi_file)){
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            UploadImage($nama_file_unik);

            mysql_query("INSERT
                        INTO produk(
                                nama_produk,
                                id_merk,
                                berat,
                                harga,
                                stok,
                                deskripsi,
                                kondisi,
                                warna,
                                ukuran,
                                gambar
                            ) 
                        VALUES (
                                '{$_POST[nama_produk]}',
                                '{$_POST[merk]}',
                                '{$_POST[berat]}',
                                '{$_POST[harga]}',
                                '{$_POST[stok]}',
                                '{$_POST[deskripsi]}',
                                '".(!empty($_POST["kondisi"]) ? $_POST["kondisi"] : NULL )."',
                                '".(!empty($_POST["warna"]) ? $_POST["warna"] : NULL )."',
                                '".(!empty($_POST["ukuran"]) ? $_POST["ukuran"] : NULL )."',
                                '{$nama_file_unik}'
                            )
            ");
                                    
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

        //   $produk_seo      = seo_title($_POST['nama_produk']);

        // Apabila gambar tidak diganti
        if (empty($lokasi_file)){
            mysql_query("UPDATE produk
                            SET
                                nama_produk = '{$_POST["nama_produk"]}',
                                berat       = '{$_POST["berat"]}',
                                id_merk     = '{$_POST["merk"]}',
                                harga       = '{$_POST["harga"]}',
                                stok        = '{$_POST["stok"]}',
                                deskripsi   = '{$_POST["deskripsi"]}',
                                kondisi     = '".(!empty($_POST["kondisi"]) ? $_POST["kondisi"] : NULL )."',
                                warna       = '".(!empty($_POST["warna"]) ? $_POST["warna"] : NULL )."',
                                ukuran      = '".(!empty($_POST["ukuran"]) ? $_POST["ukuran"] : NULL )."'
                            WHERE
                                id_produk   = '{$_POST["id"]}'
            ");
                                
        }

        else{
            /* start unlink image  */
            $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='{$_POST["id"]}"));
            unlink("../../../foto_produk/{$data['gambar']}");
            unlink("../../../foto_produk/big_{$data['gambar']}");
            unlink("../../../foto_produk/medium_{$data['gambar']}");
            unlink("../../../foto_produk/small_{$data['gambar']}");
            /* end unlink image  */

            UploadImage($nama_file_unik);
            mysql_query("UPDATE produk
                            SET
                                nama_produk = '{$_POST["nama_produk"]}',
                                berat       = '{$_POST["berat"]}',
                                id_merk     = '{$_POST["merk"]}',
                                harga       = '{$_POST["harga"]}',
                                stok        = '{$_POST["stok"]}',
                                deskripsi   = '{$_POST["deskripsi"]}',
                                kondisi     = '".(!empty($_POST["kondisi"]) ? $_POST["kondisi"] : NULL )."',
                                warna       = '".(!empty($_POST["warna"]) ? $_POST["warna"] : NULL )."',
                                ukuran      = '".(!empty($_POST["ukuran"]) ? $_POST["ukuran"] : NULL )."',
                                gambar      = '{$nama_file_unik}'   
                            WHERE id_produk   = '{$_POST["id"]}'
            ");
                            
        }
        header('location:../../media.php?module='.$module);
    }
?>

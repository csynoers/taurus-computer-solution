<?php
    session_start();
    error_reporting(1);
    include_once "config/koneksi.php";
    include_once "config/library.php";
    
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
    
    $data = [];

    //mencari element array 0
    $data['kode']= ngacak(3);

    if (empty($_SESSION['namalengkap']) AND empty($_SESSION['passuser'])){
        echo "<script>
            window.alert('Anda belum Login, Silahkan Login Terlebih dahulu');
            window.location=('media.php?module=login')
        </script>";
    }

    else {
        /*get data post*/
        $data['post'] = $_POST;
        
        $cek    = mysql_query("SELECT * FROM member WHERE id_member='{$_SESSION['member_id']}'");
        $r      = mysql_fetch_assoc($cek);

        $data['tgl_skrg'] = date("Y-m-d");
        $data['jam_skrg'] = date("H:i:s");
        
        # mendapatkan nomor orders
        $data['id_orders'] = acak(6);
        
        # mendapatkan session_id();
        $data['sid'] = session_id();
        $data['total_berat'] = 0;
        $data['total_harga'] = 0;
        $query = mysql_query("SELECT * FROM keranjang,produk WHERE keranjang.id_produk=produk.id_produk AND keranjang.id_session='{$data['sid']}'");
        while($p=mysql_fetch_assoc($query)){
            $data['rows_keranjang'][] = strip_tags(json_encode($p));
            $data['total_berat'] += $p['berat'];
            $data['total_harga'] += $p['harga'];
            
            $data['insert_orders_detail'][] = ("INSERT INTO orders_detail(id_orders, id_produk, jumlah) VALUES('{$data['id_orders']}','{$p['id_produk']}', '{$p['jumlah']}')");

            $data['update_produk'][] = ("UPDATE produk SET stok = stok - {$p['jumlah']} WHERE id_produk='{$p['id_produk']}'");		   
        }
        
        $data['ongkoskirim'] = $_POST['paket'];
        $data['total_grand'] = $data['total_harga']+$data['ongkoskirim']+$data['kode'];
        $data['total_grand_json'] = json_encode([$data['total_harga'],$data['ongkoskirim'],$data['kode']]);
        // $data['jumlah_order'] = mysql_fetch_array(mysql_query("select count(*) as total from orders WHERE tgl_order='" . date("Y-m-d") . "'"));
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
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

        header('location:media.php?module=konfirmasipembayaran&id='.$hasil);						
    }
?>

<?php
    error_reporting(0);
    /* load config required */
    include_once "config/koneksi.php";

    $data                           = [];
    $data['post']                   = $_POST;
    $data['sql_get_keranjang']      = ("SELECT * FROM keranjang LEFT JOIN produk ON keranjang.id_produk=produk.id_produk LEFT JOIN merk ON produk.id_merk=merk.id_merk WHERE keranjang.id_session='{$_POST['id_session']}' ");
    $data['query_get_keranjang']    = mysql_query($data['sql_get_keranjang']);
    
    while ($value= mysql_fetch_assoc($data['query_get_keranjang'])) {
        $data['sql_insert_orders_detail'][] = ("INSERT INTO `orders_detail`(`id_orders`, `id_produk`, `nama_produk`, `deskripsi`, `nama_merk`, `harga`, `berat`, `kondisi`, `warna`, `ukuran`, `jumlah`) VALUES ('{$_POST['id_orders']}','{$value['id_produk']}','{$value['nama_produk']}','{$value['deskripsi']}','{$value['nama_merk']}','{$value['harga']}','{$value['berat']}','{$value['kondisi']}','{$value['warna']}','{$value['ukuran']}','{$value['jumlah']}')");
        $data['sql_update_produk'][]        = ("UPDATE `produk` SET `stok`= (`stok`-{$value['jumlah']}) WHERE `id_produk`='{$value['id_produk']}' ");
    }
    $data['sql_insert_orders'][]    = ("INSERT INTO `orders`(`id_orders`, `id_member`, `kode`, `total`, `grandtotal`, `ongkir`, `alamat_pengiriman`, `status`, `tanggal`, `jam`, `kurir`) VALUES ('{$_POST['id_orders']}','{$_POST['id_member']}','{$_POST['kode_unik']}','{$_POST['total']}','{$_POST['grandtotal']}','{$_POST['ongkir']}','{$_POST['alamat_lengkap']}','Paid','{$_POST['tanggal']}','{$_POST['jam']}','{$_POST['kurir']}')");
    $data['sql_delete_keranjang'][] = ("DELETE FROM `keranjang` WHERE id_session='{$_POST['id_session']}' ");

    /* insert in table orders */
    foreach ($data['sql_insert_orders'] as $key => $value) {
        mysql_query($value);
    }

    /* insert in table orders_detail */
    foreach ($data['sql_insert_orders_detail'] as $key => $value) {
        mysql_query($value);
    }

    /* update in table produk */
    foreach ($data['sql_update_produk'] as $key => $value) {
        mysql_query($value);
    }

    /* delete in table keranjang */
    foreach ($data['sql_delete_keranjang'] as $key => $value) {
        mysql_query($value);
    }

    echo json_encode([
        "status" => TRUE
    ]);
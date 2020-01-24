<?php
    session_start();
    include "../../../config/koneksi.php";

    $module=$_GET['module'];
    $act=$_GET['act'];

    if ($module=='order' AND $act=='update'){
        mysql_query("UPDATE orders SET status='{$_POST['status']}' where id_orders='{$_POST['id']}'");
        header('location:../../media.php?module='.$module);
    }

    if ($module=='order' AND $act=='inputresi'){
        $update = mysql_query("UPDATE orders SET status_order='dikirim',no_resi='{$_POST['no_resi']}' where id_orders='{$_POST['id_orders']}'");
        if ( $update ) {
            $alert = "<script>window.alert('No Resi berhasil disimpan');window.location=('../../media.php?module={$module}')</script>";
        } else {
            $alert = "<script>window.alert('No Resi gagal disimpan, pastikan id order sudah benar');window.location=('../../media.php?module={$module}')</script>";
        }
        echo $alert;
    }

    if ($module=='order' AND $act=='konfirmasi'){
        $data 								= [];
		$data['id_orders'] 					= $_GET['id'];
        $data['query_update_tabel_orders'] 	= "UPDATE `orders` SET `status_order`='selesai' WHERE id_orders='{$data['id_orders']}' ";
		$data['exec_update_tabel_orders'] 	= mysql_query($data['query_update_tabel_orders']);

		if ( $data['exec_update_tabel_orders'] ) { # update berhasil
			$alert = "<script>window.alert('pesanan berhasil diselesaikan');window.location=('../../media.php?module={$module}')</script>";
		} else { # update gagal
			$alert = "<script>window.alert('pesanan gagal diselesaikan ');window.location=('../../media.php?module={$module}')</script>";
        }
        echo $alert;
    }


?>

<?php
	include "config/koneksi.php";
	function anti_injection($data){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}

	$email 	= $_POST['email'];
	$pass  	= md5($_POST['password']);

	$query = "";
	if( $_GET['q'] ) { #verifikasi from email
		$query 	= ("SELECT * FROM member WHERE session='{$_GET['q']}' ");
		
	} else {
		$query 	= ("SELECT * FROM member WHERE email='$email' AND password='$pass'");
		
	}

	$login 	= mysql_query($query);
	$ketemu	= mysql_num_rows($login);
	$r 		= mysql_fetch_assoc($login);

if ($ketemu > 0){ #jika user ditemukan

	if ( $_GET['q'] ) { #not empty $_GET[q]
		mysql_query("UPDATE `member` SET `status`='aktif' WHERE session='{$_GET['q']}' ");
		session_start();
		$_SESSION['member_id']    	= $r['id_member'];
		$_SESSION['namalengkap']  	= $r['nama'];
		$_SESSION['passuser']     	= $r['password'];
		$_SESSION['email']			= $r['email'];
		$_SESSION['no_telp']		= $r['no_telp'];
		$_SESSION['alamat_member']	= $r['alamat_member'];
		$_SESSION['session']		= $_GET['q'];
		$_SESSION['provinsi']		= $r['provinsi'];
		$_SESSION['kota']			= $r['kota'];
		$_SESSION['kode_pos']		= $r['kode_pos'];
		
		header('location:home');

	} else {
		if ( $r['status']=='aktif' ) {
			session_start();
			$_SESSION['member_id']    	= $r['id_member'];
			$_SESSION['namalengkap']  	= $r['nama'];
			$_SESSION['passuser']     	= $r['password'];
			$_SESSION['email']			= $r['email'];
			$_SESSION['no_telp']		= $r['no_telp'];
			$_SESSION['alamat_member']	= $r['alamat_member'];
			$_SESSION['provinsi']		= $r['provinsi'];
			$_SESSION['kota']			= $r['kota'];
			$_SESSION['kode_pos']		= $r['kode_pos'];
		
			header('location:home');

		} else {
			echo "<script>alert('Maaf akun anda belum melakukan verifikasi email, silahkan buka email anda terlebih dahulu'); window.location = 'index.php'</script>";
		
		}
	}
	
}


else{
	echo "<script>alert('Login Gagal, username atau password anda salah'); window.location = 'index.php'</script>";
}

?>

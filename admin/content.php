<?php
	include "../config/koneksi.php";
   include "../config/library.php";
   include "../config/fungsi_indotgl.php";
   include "../config/fungsi_combobox.php";
   include "../config/class_paging.php";
   include "../config/fungsi_rupiah.php";
   include "../config/helper_file.php";
// Bagian Home
if ($_GET['module']=='home'){
  
 $cek=mysql_query("SELECT * FROM orders");
$ketemu=mysql_num_rows($cek);
$cek2=mysql_query("SELECT * FROM produk WHERE stok='0'");
$ketemu2=mysql_num_rows($cek2);
  echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Selamat Datang</h3>
			  <br>
			  <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di Halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		  
		  <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
            echo"</div>
            <!-- /.box-header -->
            <div class='box-body'>
            
<div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>$ketemu2</h3>

              <p>Data Stok Produk Habis</p>
            </div>
            <div class='icon'>
              <i class='ion ion-bag'></i>
            </div>
            <a href='media.php?module=produk' class='small-box-footer'>Detail <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <!-- ./col -->
		
        <div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-green'>
            <div class='inner'>
              <h3>$ketemu</h3>

              <p>Data Orders</p>
            </div>
            <div class='icon'>
              <i class='ion ion-stats-bars'></i>
            </div>
            <a href='media.php?module=order' class='small-box-footer'>Detail <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <!-- ./col -->

			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";


          
  
  }

// Bagian produk
elseif ($_GET['module']=='produk'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_produk/produk.php";
  }
}
// Bagian sparepart
elseif ($_GET['module']=='sparepart'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_sparepart/sparepart.php";
  }
}
// Bagian merk
elseif ($_GET['module']=='merk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_merk/merk.php";
  }
}

// Bagian User
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }
}
// Bagian User
elseif ($_GET['module']=='karyawan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_karyawan/karyawan.php";
  }
}

// Bagian member
elseif ($_GET['module']=='member'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_member/member.php";
  }
}


// Bagian laporan
elseif ($_GET['module']=='laporan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='pemilik'){
    include "modul/mod_laporan/laporan.php";
  }
}


// Bagian order
elseif ($_GET['module']=='order'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_order/order.php";
  }
}

// Bagian servis
elseif ($_GET['module']=='servis'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='karyawan'){
    include "modul/mod_servis/servis.php";
  }
}

/* ==================== START MENU SUPPORT ==================== */
elseif ($_GET['module']=='logo'){
	if ($_SESSION['leveluser']=='admin'){
		include "modul/mod_logo/logo.php";
	}
}
elseif ($_GET['module']=='slideshow'){
	if ($_SESSION['leveluser']=='admin'){
		include "modul/mod_slideshow/slideshow.php";
	}
}
/* ==================== END MENU SUPPORT ==================== */

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>

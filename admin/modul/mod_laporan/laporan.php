<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
		  
		  echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>LAPORAN PENJUALAN</h3>
            </div>
			
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'> 
			<form method=POST action='modul/mod_laporan/cetaklaporan.php' target='_blank'>
          <tr><td>Dari Tanggal</td><td> <input type='date' name='dari' class='form-control' id='exampleInputPassword1' required></td></tr>
          <tr><td>s/d Tanggal</td><td> <input type='date' name='sampai' class='form-control' id='exampleInputPassword1' required></td></tr>
          <tr><td colspan=2><button type='submit' class='btn btn-primary'>Proses</button>
											<button onclick=self.history.back() class='btn btn-danger'>Batal</button></td></tr>
          </form></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->";
  



?>

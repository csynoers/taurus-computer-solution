<?php
$aksi="modul/mod_sparepart/aksi_sparepart.php";
switch($_GET[act]){
  // Tampil sparepart
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>SPAREPART</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin'){
			echo"
			<button type=button class='btn btn-primary' onclick=\"window.location.href='?module=sparepart&act=tambahsparepart';\"><i class='fa fa-plus'> Tambah</i></button>
							<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body'>
			<div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama Sparepart</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM sparepart ORDER BY id_sparepart DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$harga=format_rupiah($r[harga]);
       echo "<tr><td>$no</td>
             <td>$r[nama_sparepart]</td>
			 <td>Rp. $harga</td>
             <td>$r[stok]</td>
             <td>";
			 if ($_SESSION['leveluser']=='admin'){
			 echo"
			 <a href=?module=sparepart&act=editsparepart&id=$r[id_sparepart] class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
	               <a href=$aksi?module=sparepart&act=hapus&id=$r[id_sparepart] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
             ";
			 }
			 echo"</td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
	       </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  // Form Tambah sparepart
  case "tambahsparepart":
    
	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH SPAREPART</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=sparepart&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Sparepart</label>
                  <input type='text' class='form-control' name='nama_sparepart' id='exampleInputEmail1' placeholder='Masukkan Nama sparepart' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Harga</label>
                  <input type='number' class='form-control' name='harga' id='exampleInputEmail1' placeholder='Masukkan Harga Sparepart' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Stok</label>
                  <input type='number' class='form-control' name='stok' id='exampleInputEmail1' placeholder='Masukkan Stok' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
     break;
  
  // Form Edit sparepart  
  case "editsparepart":
    $edit=mysql_query("SELECT * FROM sparepart WHERE id_sparepart='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT SPAREPART</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=sparepart&act=update>
            <input type=hidden name=id value='$r[id_sparepart]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Sparepart</label>
                  <input type='text' class='form-control' name='nama_sparepart' id='exampleInputEmail1' placeholder='Masukkan Nama sparepart' value='$r[nama_sparepart]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Harga</label>
                  <input type='number' class='form-control' name='harga' id='exampleInputEmail1' placeholder='Masukkan Harga Sparepart' value='$r[harga]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Stok</label>
                  <input type='number' class='form-control' name='stok' id='exampleInputEmail1' placeholder='Masukkan Stok' value='$r[stok]' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
    
    break;  
}
?>

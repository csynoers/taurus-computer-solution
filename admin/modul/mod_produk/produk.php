<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>PRODUK</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin'){
			echo"
			<button type=button class='btn btn-primary' onclick=\"window.location.href='?module=produk&act=tambahproduk';\"><i class='fa fa-plus'> Tambah</i></button>
							<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body'>
			<div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama Produk</th><th>Merk</th><th>Harga</th><th>Stok</th><th>Gambar</th><th>Aksi</th></tr>
		  <tbody>";

    $tampil = mysql_query("SELECT * FROM produk LEFT JOIN merk ON produk.id_merk=merk.id_merk ORDER BY id_produk DESC ");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td>$r[nama_produk]</td>
				<td>$r[nama_merk]</td>
                <td>Rp. $harga</td>
                <td align=center>$r[stok]</td>
                <td><img src='../foto_produk/small_$r[gambar]'></td>
		        <td>";
				if ($_SESSION['leveluser']=='admin'){
				echo"
				<a href=?module=produk&act=editproduk&id=$r[id_produk] class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a> 
		            <a href=$aksi?module=produk&act=hapus&id=$r[id_produk]&namafile=$r[gambar] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
					}
					echo"</td>
		        </tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";

    
 
    break;
  
  case "tambahproduk":
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>FORM TAMBAH PRODUK</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
			
			<form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
			<div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Nama Produk</label>
                  <input type='text' name='nama_produk' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Merk</label>
                  <select class='form-control' name='merk' required>
							<option value='' selected>- Pilih merk -</option>";
								$tampil=mysql_query("SELECT * FROM merk ORDER BY nama_merk");
								while($r=mysql_fetch_array($tampil)){
								echo "<option value=$r[id_merk]>$r[nama_merk]</option>";
								}
						echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Berat</label>
                  <input type='number' step='0.1' name='berat' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Berat Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Harga</label>
                  <input type='number' name='harga' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Harga Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Stok</label>
                  <input type='number' name='stok' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Stok Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Deskripsi</label>
                  <textarea class='textarea' name='deskripsi' rows='20' cols='150'>
                                            Isikan Deskripsi Produk Disini.
                    </textarea>
                </div>
				<div class='form-group'>
                  <label for='exampleInputFile'>Gambar</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
			</form>
			
			
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
     break;
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

	echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>FORM EDIT PRODUK</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
			
			<form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
            <input type=hidden name=id value=$r[id_produk]>
			<div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Nama Produk</label>
                  <input type='text' name='nama_produk' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Produk' value='$r[nama_produk]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Merk</label>
                  <select class='form-control' name='merk' required>";
							$tampil=mysql_query("SELECT * FROM merk ORDER BY nama_merk");
								if ($r[id_merk]==0){
								echo "<option value=0 selected>- Pilih merk -</option>";
								}   

							while($w=mysql_fetch_array($tampil)){
								if ($r['id_merk']==$w['id_merk']){
								echo "<option value=$w[id_merk] selected>$w[nama_merk]</option>";
								}
								else{
								echo "<option value=$w[id_merk]>$w[nama_merk]</option>";
								}
								}
							echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Berat</label>
                  <input type='number' name='berat' class='form-control' id='exampleInputPassword1' value=$r[berat] placeholder='Masukkan Berat Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Harga</label>
                  <input type='number' name='harga' class='form-control' id='exampleInputPassword1' value=$r[harga] placeholder='Masukkan Harga Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Stok</label>
                  <input type='number' name='stok' class='form-control' id='exampleInputPassword1' value=$r[stok] placeholder='Masukkan Stok Produk' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Deskripsi</label>
                  <textarea class='textarea' name='deskripsi' rows='20' cols='80'>
                                            $r[deskripsi]
                    </textarea>
                </div>
				<div class='form-group'>
                  <label for='exampleInputFile'>Gambar</label>
                  <p class='help-block'><img src='../foto_produk/$r[gambar]'></p>
                </div>
				<div class='form-group'>
                  <label for='exampleInputFile'>Ganti Gambar</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
			</form>
			
			
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    
    break;  
}
}
?>

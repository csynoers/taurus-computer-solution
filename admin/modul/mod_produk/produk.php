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
		$option = [];

		$tampil=mysql_query("SELECT * FROM merk ORDER BY nama_merk");
		while($value=mysql_fetch_array($tampil)){
			$option['merk'] .="<option value='{$value['id_merk']}'>{$value['nama_merk']}</option>";
		}

		foreach ( read_file('../json/warna.json') as $key => $value) {
			$option['warna'] .= "<option value='{$value}'>{$value}</option>";
		}

		foreach ( read_file('../json/ukuran.json') as $key => $value) {
			$option['ukuran'] .= "<option value='{$value}'>{$value}</option>";
		}

		echo "
			<div class='col-xs-12'>
				<div class='box'>
					<div class='box-header'>
					<h3 class='box-title'>FORM TAMBAH PRODUK</h3>
					</div>
					<!-- /.box-header -->

					<form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
						<div class='box-body'>
							<div class='form-group'>
								<label for='exampleInputPassword1'>Nama Produk</label>
								<input type='text' name='nama_produk' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Produk' required>
							</div>
							<div class='row'>
								<div class='form-group col-sm-6'>
									<label for='exampleInputPassword1'>Merk <a href='media.php?module=merk' class='btn-link text-green' role='button'> +Tambah Merk Baru</a> </label>
									<select class='form-control' name='merk' required>
										<option value='' selected>- Pilih merk -</option>
										{$option["merk"]}
									</select>
								</div>
								<div class='form-group col-sm-6'>
									<label>Berat (Gram)</label>
									<input type='number' step='0.1' name='berat' class='form-control' placeholder='Masukkan berat produk tipe angka' required>
								</div>
								<div class='form-group col-sm-6'>
									<label>Harga</label>
									<input type='number' name='harga' class='form-control' placeholder='Masukkan harga produk tipe angka' required>
								</div>
								<div class='form-group col-sm-6'>
									<label>Stok</label>
									<input type='number' name='stok' class='form-control' placeholder='Masukkan jumlah stok produk tipe angka' required>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formKondisi'>Kondisi</label>
									<select name='kondisi' required='' class='form-control'>
										<option value='Baru' selected>Baru</option>
										<option value='Pernah Dipakai'>Pernah Dipakai</option>
									</select>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formWarna'>Warna <small class='text-info'>(Optional)</small> <a href='media.php?module=warna' class='btn-link text-green' role='button'> +Tambah Warna Baru</a> </label>
									<select name='warna' class='form-control'>
										<option value='' selected disabled> -- Pilih Warna -- </option>
										{$option["warna"]}
									</select>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formUkuran'>Ukuran <small class='text-info'>(Optional)</small> <a href='media.php?module=ukuran' class='btn-link text-green' role='button'> +Tambah Ukuran Baru</a> </label>
									<select name='ukuran' class='form-control'>
										<option value='' selected disabled> -- Pilih Ukuran -- </option>
										{$option["ukuran"]}
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for='exampleInputPassword1'>Deskripsi</label>
								<textarea class='textarea form-control' name='deskripsi' placeholder='Isikan Deskripsi Produk Disini.' required></textarea>
							</div>
							<div class='form-group'>
								<label for='exampleInputFile'>Gambar</label>
								<input type='file' name='fupload' id='exampleInputFile' required>
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
				<!-- /.box -->
			</div>
		";
		break;
	
	case "editproduk":
		$edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
		$r    = mysql_fetch_array($edit);

		$option = [];

		$tampil=mysql_query("SELECT * FROM merk ORDER BY nama_merk");
		while($value=mysql_fetch_array($tampil)){
			$selected = ($value['id_merk']==$r['id_merk']) ? 'selected' : NULL ;
			$option['merk'] .="<option value='{$value['id_merk']}' {$selected}>{$value['nama_merk']}</option>";
		}

		foreach ( read_file('../json/kondisi.json') as $key => $value) {
			$selected = ($value==$r['kondisi']) ? 'selected' : NULL ;
			$option['kondisi'] .= "<option value='{$value}' {$selected}>{$value}</option>";
		}

		foreach ( read_file('../json/warna.json') as $key => $value) {
			$selected = ($value==$r['warna']) ? 'selected' : NULL ;
			$option['warna'] .= "<option value='{$value}' {$selected}>{$value}</option>";
		}

		foreach ( read_file('../json/ukuran.json') as $key => $value) {
			$selected = ($value==$r['ukuran']) ? 'selected' : NULL ;
			$option['ukuran'] .= "<option value='{$value}' {$selected}>{$value}</option>";
		}

		echo "
			<div class='col-xs-12'>
				<div class='box'>
					<div class='box-header'>
						<h3 class='box-title'>FORM EDIT PRODUK</h3>
					</div>
					<!-- /.box-header -->

					<form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
						<div class='box-body'>
							<input type='hidden' name='id' value='{$r["id_produk"]}'>
							<div class='form-group'>
								<label for='exampleInputPassword1'>Nama Produk</label>
								<input value='{$r['nama_produk']}' type='text' name='nama_produk' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Produk' required>
							</div>
							<div class='row'>
								<div class='form-group col-sm-6'>
									<label for='exampleInputPassword1'>Merk <a href='media.php?module=merk' class='btn-link text-green' role='button'> +Tambah Merk Baru</a> </label>
									<select class='form-control' name='merk' required>
										<option value='' disabled>- Pilih merk -</option>
										{$option["merk"]}
									</select>
								</div>
								<div class='form-group col-sm-6'>
									<label>Berat (Gram)</label>
									<input value='{$r['berat']}' type='number' step='0.1' name='berat' class='form-control' placeholder='Masukkan berat produk tipe angka' required>
								</div>
								<div class='form-group col-sm-6'>
									<label>Harga</label>
									<input value='{$r['harga']}' type='number' name='harga' class='form-control' placeholder='Masukkan harga produk tipe angka' required>
								</div>
								<div class='form-group col-sm-6'>
									<label>Stok</label>
									<input value='{$r['stok']}' type='number' name='stok' class='form-control' placeholder='Masukkan jumlah stok produk tipe angka' required>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formKondisi'>Kondisi</label>
									<select name='kondisi' required='' class='form-control'>
										{$option["kondisi"]}
									</select>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formWarna'>Warna <small class='text-info'>(Optional)</small> <a href='media.php?module=warna' class='btn-link text-green' role='button'> +Tambah Warna Baru</a> </label>
									<select name='warna' class='form-control'>
										<option value=''> -- Pilih Warna -- </option>
										{$option["warna"]}
									</select>
								</div>
								<div class='form-group col-sm-4'>
									<label for='formUkuran'>Ukuran <small class='text-info'>(Optional)</small> <a href='media.php?module=ukuran' class='btn-link text-green' role='button'> +Tambah Ukuran Baru</a> </label>
									<select name='ukuran' class='form-control'>
										<option value=''> -- Pilih Ukuran -- </option>
										{$option["ukuran"]}
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for='exampleInputPassword1'>Deskripsi</label>
								<textarea class='textarea form-control' name='deskripsi' placeholder='Isikan Deskripsi Produk Disini.' required>{$r["deskripsi"]}</textarea>
							</div>
							<div class='form-group'>
								<label for='exampleInputFile'>Gambar</label>
								<p class='help-block'><img src='../foto_produk/{$r['gambar']}'></p>
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
					<!-- /form -->
				</div>
				<!-- /.box -->
			</div>
		";
	
	break;  
}
}
?>

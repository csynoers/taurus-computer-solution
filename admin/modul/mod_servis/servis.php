<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_servis/aksi_servis.php";
switch($_GET['act']){
	// Tampil servis
	default:
		$data 				= [];
		$data['sqlRows'] 	= "SELECT * FROM servis,member WHERE servis.id_member=member.id_member ORDER BY id_servis DESC";
		$data['queryRows'] 	= mysql_query($data['sqlRows']);
		while ($value=mysql_fetch_assoc($data['queryRows'])) {
			$value['tanggal'] 	= tgl_indo($value['tanggal']);
			$data['rows'][]		= "
				<tr>
					<td>{$value['id_servis']}</td>
					<td>{$value['nama']}</td>
					<td>{$value['tanggal']}</td>
					<td>
						<!--<a href='?module=servis&act=transaksiservis&kode={$value['id_servis']}' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>-->
						<a href='?module=servis&act=detailservis&id={$value['id_servis']}' class='btn btn-info btn-xs' title='Detail'><i class='fa fa-folder'> Detail</i></a>
						<a href='modul/mod_servis/cetak.php?kode={$value['id_servis']}' target='_blank' class='btn btn-warning btn-xs' title='Cetak'><i class='fa fa-print'> Cetak</i></a>
					</td>
				</tr>
			";
		}
		$data['rows'] = implode('',$data['rows']);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';

		echo "
			<div class='col-xs-12'>
				<div class='box'>
					<div class='box-header'>
					<h3 class='box-title'>SERVIS</h3>
					</div>
					<button type=button class='btn btn-success' onclick=\"window.location.href='?module=servis&act=tambahservis';\"><i class='fa fa-plus'> Tambah</i></button>
									<p>
					<!-- /.box-header -->
					<div class='box-body'>
						<div class='box-body table-responsive no-padding'>
							<table id='example1' class='table table-bordered table-striped'> 
							<thead>
								<tr>
									<th>ID Servis</th>
									<th>Pelanggan</th>
									<th>Tgl. servis</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								{$data['rows']}
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		";
    
		break;

	case "tambahservis":
		$sql=mysql_query("select * from servis order by id_servis DESC LIMIT 0,1");
		$data=mysql_fetch_assoc($sql);
		$kodeawal=substr($data['id_servis'],3,3)+1;
		if($kodeawal<10){
			$kode='SRV00'.$kodeawal;
		}elseif($kodeawal > 9 && $kodeawal <=99){
			$kode='SRV0'.$kodeawal;
		}else{
			$kode='SRV'.$kodeawal;
		}

		echo"
			<div class='col-md-6'>  
				<div class='box box-primary'>
					<div class='box-header with-border'>
					<h3 class='box-title'>FORM TAMBAH SERVIS</h3>
					</div>
					<!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=servis&act=tambah' enctype='multipart/form-data'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Kode servis</label>
				  <input type=hidden name='id_servis' value='$kode'>
                  <input type='text' class='form-control' name='sparepartname' id='exampleInputEmail1' value='$kode' readonly>
                </div>
				<div class='form-group'>
					<label>Nama Pelanggan</label>
					<select class='form-control select2' name='member' required>
						<option value=''>- Pilih Pelanggan -</option>";
							$tampil=mysql_query("SELECT * FROM member ORDER BY nama ASC");
							while($r=mysql_fetch_assoc($tampil)){
							echo"<option value=$r[id_member]>$r[nama]</option>";
							}
							echo"</select>
				</div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tanggal</label>
                  <input type='date' name='tgl_servis' class='form-control' id='exampleInputPassword1' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Keterangan</label>
                  <input type='text' name='keterangan' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Keterangan' required>
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
    
	case "detailservis":
		$edit=mysql_query("SELECT * FROM servis,member WHERE servis.id_member=member.id_member AND servis.id_servis='$_GET[id]'");
    
		$r=mysql_fetch_assoc($edit);
		$tanggal=tgl_indo($r[tanggal]);
	
		echo "
			<div class='col-xs-12'>
			<div class='box'>
			<div class='box-header'>
			<h3 class='box-title'>DETAIL SERVIS</h3>
			</div>
			<!-- /.box-header -->
			<div class='box-body'>
			<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
			<form method=POST action='$aksi?page=servis&act=input'> 
			<tr>
			<td>Kode servis</td>
			<td>$r[id_servis]</td>
			</tr>
			<tr>
			<td>Nama member</td>
			<td>$r[nama]</td>
			</tr>
			<tr>
			<td>Alamat</td>
			<td>$r[alamat_member]</td>
			</tr>			
			<tr>
			<td>No. Telp</td>
			<td>$r[no_telp]</td>
			</tr>
			<tr>
			<td>Keterangan</td>
			<td>$r[keterangan]</td>
			</tr>
			<tr>
			<td>Tanggal</td>
			<td>$tanggal </td>
			</tr>
			</form>
			</table>
			<br>
			<table id='dynamic-table' class='table table-striped table-bordered table-hover'>
			<thead>
			<tr>
			<th>No</th>
			<th>Nama sparepart</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Sub total</th>
			</tr>
			</thead>
			<tbody>"; 
			$no=1;
			$tampil = mysql_query("SELECT * FROM detail_servis
			LEFT JOIN servis
			ON detail_servis.id_servis=servis.id_servis
			LEFT JOIN sparepart
			ON detail_servis.id_sparepart=sparepart.id_sparepart
			WHERE servis.id_servis='$_GET[id]'
			ORDER BY servis.id_servis DESC");
			while ($r=mysql_fetch_assoc($tampil)){
			$jml=$r[jumlah];
			$harga=$r[harga];
			$subtotal=$jml*$harga;
			$total       = $total + $subtotal;
			$total_rp    = format_rupiah($total);
			$subtotal_rp = format_rupiah($subtotal);
			$harga_rp       = format_rupiah($harga);
			echo"<tr>
			<td>$no</td>                         
			<td>$r[nama_sparepart]</a></td>
			<td>Rp. $harga_rp</td>		         
			<td>$r[jumlah]</td>
			<td>Rp. $subtotal_rp</td>
			</tr>";
			$no++;
			}
			echo"<tr>
			<td colspan=4>Total :  </td>
			<td ><b>Rp. $total_rp</b></td>
			</tr>
			</tbody>
			</table>";

			// tampilkan data kustomer
			echo "
			<div class='box round first fullpage'>
			<div class='block '>


			</div>

			<a href=modul/mod_servis/cetak.php?id=$_GET[id] target='_blank' class='btn btn-warning'>Cetak</a> <button onclick=self.history.back() class='btn btn-danger'>Kembali</button>
			<!-- /.box-body -->
			</div>
			<!-- /.box -->
			</div>
		";

		break;  
	
	case "transaksiservis":
		$member=mysql_query("SELECT * FROM member,servis WHERE member.id_member=servis.id_member AND servis.id_servis='$_GET[kode]'");
    
		$p=mysql_fetch_assoc($member);
		$tanggal=tgl_indo($r['tgl_servis']);
		echo"
			<div class='col-md-6'>  
			<div class='box box-primary'>
			<div class='box-header with-border'>
			<h3 class='box-title'>FORM SERVIS</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form method=POST action='$aksi?module=servis&act=input'>
			<input type=hidden name='id_member' value='$r[id_member]'>
			<input type=hidden name='id_servis' value='$_GET[kode]'>
			<div class='box-body'>
			<div class='form-group'>
			<label for='exampleInputPassword1'>Cari Sparepart</label>
			<select class='form-control' name='sparepart' required>
			<option value='' selected>- Pilih Sparepart -</option>";
			$tampil=mysql_query("SELECT * FROM sparepart ORDER BY id_sparepart ASC");
			while($r=mysql_fetch_assoc($tampil)){
			echo "<option value=$r[id_sparepart]>$r[id_sparepart]: $r[nama_sparepart]</option>";
			}
			echo "</select>
			</div>
			<div class='form-group'>
			<label for='exampleInputPassword1'>Jumlah</label>
			<input type='number' name='jumlah' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Jumlah Sparepart' required>
			</div>
			</div>
			<!-- /.box-body -->

			<div class='box-footer'>
			<button type='submit' class='btn btn-primary'>Simpan</button>
			</div>
			</form>
			</div>
			</div>";
			echo"
			<div class='col-md-6'>  
			<div class='box box-primary'>
			<div class='box-header with-border'>
			<h3 class='box-title'>DATA MEMBER</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<div class='box-body'>
			<div class='form-group'>
			<label for='exampleInputPassword1'>Kode member</label>
			<input type='text' value='$p[id_member]' class='form-control' id='exampleInputPassword1' readonly>
			</div>
			<div class='form-group'>
			<label for='exampleInputPassword1'>Nama</label>
			<input type='text' value='$p[nama]' class='form-control' id='exampleInputPassword1' readonly>
			</div>
			<div class='form-group'>
			<label for='exampleInputPassword1'>No. Telp</label>
			<input type='text' value='$p[no_telp]' class='form-control' id='exampleInputPassword1' readonly>
			</div>

			</div>
			<!-- /.box-body -->



			</div>
			</div>";

			echo "
			<div class='col-xs-12'>
			<div class='box'>
			<div class='box-header'>
			<h3 class='box-title'>DATA SPAREPART</h3>
			</div>
			<!-- /.box-header -->
			<div class='box-body'>
			<table id='dynamic-table' class='table table-striped table-bordered table-hover'>
			<thead>
			<tr>
			<th>No</th>
			<th>Nama Sparepart</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Sub total</th>
			<th>Aksi</th>
			</tr>
			</thead>
			<tbody>"; 
			$no=1;
			$tampil = mysql_query("SELECT * FROM detail_servis,sparepart WHERE detail_servis.id_sparepart=sparepart.id_sparepart
				AND detail_servis.id_servis='$_GET[kode]'");
			while ($r=mysql_fetch_assoc($tampil)){
			$jml=$r[jumlah];
			$harga=$r[harga];
			$subtotal=$jml*$harga;
			$total       = $total + $subtotal;
			$total_rp    = format_rupiah($total);
			$subtotal_rp = format_rupiah($subtotal);
			$harga_rp       = format_rupiah($harga);
			echo"<tr>
			<td>$no</td>                         
			<td>$r[nama_sparepart]</a></td>
			<td>Rp. $harga_rp</td>		         
			<td>$r[jumlah]</td>
			<td>Rp. $subtotal_rp</td>
			<td><a href=$aksi?module=servis&act=delete&kode=$r[id_detail] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
			</tr>";
			$no++;
			}
			echo"<tr>
			<td colspan=4 align=right>Total :  </td>
			<td align=left><b>Rp. $total_rp</b></td>
			</tr>
			</tbody>
			</table>

				<div class='box round first fullpage'>
					<form method='POST' action='$aksi?module=servis&act=tambah'>
						<input type=hidden name='id_member' value='$_GET[id]'>
						<input type=hidden name='kode_servis' value='$_GET[kode]'>
						<div class='input-group'>
							<span class='input-group-addon' id='basic-addon3'>Biaya Servis</span>
							<input placeholder='masukan biaya servis disini*' min='1' type='number' class='form-control' id='basic-url' aria-describedby='basic-addon3' required>
							<div class='input-group-btn'>
								<button class='btn' type='submit'>Simpan</button>
								<!-- Buttons -->
							</div>
						</div>
					</form>
				</div>
				<!-- /.box -->
			</div>
		";

    break;  
}
}
?>

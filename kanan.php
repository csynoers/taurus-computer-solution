<?php
if ($_GET['module']=='home'){
echo"
<h4>Produk Terbaru </h4>
			  <ul class='thumbnails'>";
			  // Tampilkan 4 produk terbaru
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");  
  $kolom = 3;
  $i=0;
  while ($r=mysql_fetch_array($sql)){
    $harga1 = $r[harga];
    $harga     = number_format($harga1,0,",",".");
	echo"
				<li class='span3'>
				  <div class='thumbnail'>
					<a  href='media.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/medium_$r[gambar]' alt=''/></a>
					<div class='caption'>
					  <h5>$r[nama_produk]</h5>
					  <p> 
						<strong> Rp. $harga</strong> 
					  </p>
					 
					  <h4 style='text-align:center'><a class='btn' href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Add to <i class='icon-shopping-cart'></i></a></h4>
					</div>
				  </div>
				</li>";
			}
			echo"
				
			  </ul>";
}
elseif ($_GET['module']=='semuaproduk'){
echo"
<h4>Semua Produk </h4>
			  <ul class='thumbnails'>";
			  // Tampilkan 4 produk terbaru
  // Tampilkan semua produk
  $p      = new Paging2;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  while($r=mysql_fetch_array($sql)){
    $harga1 = $r[harga];
    $harga     = number_format($harga1,0,",",".");
    if ($r[gambar]!=''){
		}
    // Tampilkan hanya sebagian isi berita
    $isi_produk = nl2br($r[deskripsi]); // membuat paragraf pada isi berita
    $isi = substr($isi_produk,0,300); // ambil sebanyak 300 karakter
    $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
	echo"
				<li class='span3'>
				  <div class='thumbnail'>
					<a  href='media.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/medium_$r[gambar]' alt=''/></a>
					<div class='caption'>
					  <h5>$r[nama_produk]</h5>
					  <p> 
						<strong> Rp. $harga</strong> 
					  </p>
					 
					  <h4 style='text-align:center'><a class='btn' href=''>Add to <i class='icon-shopping-cart'></i></a></h4>
					</div>
				  </div>
				</li>";
			}
			echo"
				
			  </ul>";
			  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);
  echo "<br><div class='center_title_bar'>Hal: $linkHalaman</div>";
}
elseif ($_GET['module']=='detailmerk'){
$sq = mysql_query("SELECT nama_merk from merk where id_merk='$_GET[id]'");
  $n = mysql_fetch_array($sq);
echo"
<h4>Merk $n[nama_merk] </h4>
			  <ul class='thumbnails'>";
			  // Tampilkan 4 produk terbaru
 $p      = new Paging3;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);  
  // Tampilkan daftar produk yang sesuai dengan merk yang dipilih
 	$sql   = "SELECT * FROM produk WHERE id_merk='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $posisi,$batas";		 
	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	// Apabila ditemukan produk dalam merk
	if ($jumlah > 0){
    $kolom = 2;
    $i=0;
   while($r=mysql_fetch_array($hasil)){
    $harga1 = $r[harga];
    $harga     = number_format($harga1,0,",",".");
    // Tampilkan hanya sebagian isi berita
    $isi_produk = nl2br($r[deskripsi]); // membuat paragraf pada isi berita
    $isi = substr($isi_produk,0,120); // ambil sebanyak 120 karakter
    $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    if ($i >= $kolom){
      $i=0;
    }
    $i++;
	echo"
				<li class='span3'>
				  <div class='thumbnail'>
					<a  href='media.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/medium_$r[gambar]' alt=''/></a>
					<div class='caption'>
					  <h5>$r[nama_produk]</h5>
					  <p> 
						<strong> Rp. $harga</strong> 
					  </p>
					 
					  <h4 style='text-align:center'><a class='btn' href='aksi.php?module=keranjang&act=tambah&id={$r['id_produk']}'>Add to <i class='icon-shopping-cart'></i></a></h4>
					</div>
				  </div>
				</li>";
			}
			echo"
				
			  </ul>";
			  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_merk='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halmerk], $jmlhalaman);
  echo "<div class='center_title_bar'>Hal: $linkHalaman</div>";
   }
  else{
    echo "<p align=center>Belum ada produk pada merk ini.</p>";
  }
}



/* ==================== START MENU INFORMASI ==================== */
elseif ($_GET['module']=='hubungikami'){
	$row = read_file('json/informasi.json');
	echo "							
		<div class='span9'>
			<h2>Hubungi Kami</h2>
			{$row->hubungi_kami}
		</div>
	";
}

elseif ($_GET['module']=='profilkami'){
	$row = read_file('json/informasi.json');
	echo "							
		<div class='span9'>
			<h2>Profil Kami</h2>
			{$row->profil}
		</div>
	";
}

elseif ($_GET['module']=='carabeli'){
	$row = read_file('json/informasi.json');
	echo"							
	<div class='span9'>
		<h2>Cara Pembelian Produk</h2>
		{$row->cara_pembelian}
	</div>";
	
}
/* ==================== END MENU INFORMASI ==================== */

elseif ($_GET['module']=='detailproduk'){
	$detail 	= mysql_query("SELECT * FROM produk,merk WHERE produk.id_merk=merk.id_merk AND id_produk='$_GET[id]'");
	$d   		= mysql_fetch_assoc($detail);
	$harga     	= number_format($d[harga],0,",",".");
	$merk		=$d['id_merk'];
	$harga1		=$d['harga'];

	$produk_attr = [];
	if ( $d['kondisi'] ) {
		$produk_attr[]= "<span class='label label-info'>Kondisi : {$d['kondisi']}</span>";
	}
	if ( $d['warna'] ) {
		$produk_attr[]= "<span class='label label-info'>Warna : {$d['warna']}</span>";
	}
	if ( $d['ukuran'] ) {
		$produk_attr[]= "<span class='label label-info'>Ukuran : {$d['ukuran']}</span>";
	}

	$produk_attr = implode('&nbsp',$produk_attr);

	echo "
		<div class='row'>	  
			<div id='gallery' class='span3'>
				<a href='foto_produk/{$d['gambar']}' title='{$d['nama_produk']}'>
					<img src='foto_produk/medium_{$d['gambar']}' style='width:100%' alt='{$d['nama_produk']}'/>
				</a>
			</div>

			<div class='span6'>
				<h3>{$d['nama_produk']}</h3>
				<hr class='soft'/>
				<form class='form-horizontal qtyFrm'>
					<div class='control-group'>
						<label class='control-label'><span>Rp. {$harga}</span></label>
						<div class='controls'>
							<a href='aksi.php?module=keranjang&act=tambah&id={$d['id_produk']}' class='btn btn-large btn-primary pull-left'>Beli<i class=' icon-shopping-cart'></i></a>
						</div>
					</div>
					{$produk_attr}
				</form>
				<hr class='soft'/><br>

				<h4>{$d['stok']} Items In Stock</h4>
				<br class='clr'/>

				<a href='#' name='detail'></a>
				<hr class='soft'/>
			</div>
			
			<div class='span9'>
				<ul id='productDetail' class='nav nav-tabs'>
					<li class='active'><a href='#home' data-toggle='tab'>Detail Produk</a></li>
				</ul>
				<div id='myTabContent' class='tab-content'>
					<div class='tab-pane fade active in' id='home'>
						<h4>Keterangan Produk</h4>
						<p>{$d['deskripsi']}</p>
					</div>
				</div>
			</div>
			<!-- /.span9 -->

		</div>
	";
}
elseif ($_GET['module']=='daftarmember'){

echo"
	<div class='span9'>
		<h4> Form Daftar Member</h4>
		<form id='form1' action=daftar-aksi.html method=POST class='form-horizontal'>
			<table class='table table-bordered'>
				<tr>
					<th> Detail Data Pribadi Anda  </th>
				</tr>
				<tr> 
					<td>
						<div class='control-group'>
							<label class='control-label' for='inputFname'>Nama Lengkap <sup>*</sup></label>
							<div class='controls'>
								<input type='text' name='nama' id='inputFname' placeholder='Masukkan Nama Lengkap' required>
							</div>
						</div>
				
						<div class='control-group'>
							<label class='control-label' for='inputEmail'>Email <sup>*</sup></label>
							<div class='controls'>
								<input type='email' name='email' placeholder='email@gmail.com' required>
							</div>
						</div>	  

						<div class='control-group'>
							<label class='control-label'>Password <sup>*</sup></label>
							<div class='controls'>
								<input type='password' name='password' placeholder='**********' required>
							</div>
						</div>

						<div class='control-group'>
							<label class='control-label' for='inputFname'>Nomor Telepon <sup>*</sup></label>
							<div class='controls'>
								<input type='telp' min='0' name='no_telp'  placeholder='08123456789' required>
							</div>
						</div>

						<div class='control-group'>
							<label class='control-label' for='inputFname'>Alamat Lengkap <sup>*</sup></label>
							<div class='controls'>
								<textarea style='width:100%' name='alamat' placeholder='Isi nama jalan, nomor rumah, nama gedung, dsb' required></textarea>
							</div>
						</div>
						<div class='control-group'>
							<div class='controls'>
								<input type='submit' name='submitAccount' value='Register' class='exclusive shopBtn'>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
";

}
elseif ($_GET['module']=='daftaraksi'){

	
$sql = mysql_query("SELECT * FROM member WHERE email='$_POST[email]'
								OR no_telp ='$_POST[no_telp]'");

$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"							
<div class='span9'>
<h3> Form Daftar Member</h3>	
	<hr class='soft'/>
<p align=center>Maaf! Email atau nomor telepon yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
							</div>";
	}
	else {
$pass=md5($_POST[password]);
  mysql_query("INSERT INTO member(nama,
                                   email,
                                   password,
                                   no_telp,
                                   alamat_member,
								   tgl_daftar) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
							   '$pass',
                               '$_POST[no_telp]',
                               '$_POST[alamat]',
							   '$tgl_sekarang')");
echo"							
<div class='span9'>
<h3> Form Daftar Member</h3>	
	<hr class='soft'/>
<p align=center><b>Terimakasih telah mendaftar Sebagai Member. <br /> Silahkan Login Terlebih Dahulu. Klik <a href='media.php?module=loginmember'> Disini </a>
							</div>";
		}
		

}
elseif ($_GET['module']=='loginmember'){
echo"							
<div class='span9'>
<h3> Form Login Member</h3>	
	<form action='cek_login.php' method=POST class='form-horizontal'>
		<table class='table table-bordered'>
		<tr><th> Silahkan Isi Form Di Bawah Ini</th></tr>
		 <tr> 
		 <td>
	
		<div class='control-group'>
		<label class='control-label' for='inputEmail'>Email <sup>*</sup></label>
		<div class='controls'>
		  <input type='email' name='email' placeholder='Masukkan Email Anda' required>
		</div>
	  </div>	  
		<div class='control-group'>
		<label class='control-label'>Password <sup>*</sup></label>
		<div class='controls'>
		  <input type='password' name='password' placeholder='Password' required>
		</div>
	  </div>
		
	<div class='control-group'>
		<div class='controls'>
		 <input type='submit' name='submitAccount' value='Login' class='exclusive shopBtn'>
		 <p>*Jika Anda belum punya akun member silahkan daftar <a href='daftar-member.html'> Disini </a> </p>
		</div>
	</div>
	</form>
	</td>
		  </tr>
	</table>
							</div>";

}
elseif ($_GET['module']=='editmember'){
$edit=mysql_query("SELECT * FROM member WHERE id_member='$_SESSION[member_id]'");
    $r=mysql_fetch_array($edit);
echo"
<div class='span9'>
<h4> Form Edit Member</h4>
	<form id='form2' action=edit_profil.php method=POST class='form-horizontal'>
	<table class='table table-bordered'>
	<input type=hidden name=id value='$r[id_member]'>
		<tr><th> Detail Data Pribadi Anda  </th></tr>
		 <tr> 
		 <td>
		
		<div class='control-group'>
			<label class='control-label' for='inputFname'>Nama Lengkap <sup>*</sup></label>
			<div class='controls'>
			  <input type='text' name='nama' value='$r[nama]' id='inputFname' placeholder='Masukkan Nama Lengkap Anda' required>
			</div>
		 </div>
		<div class='control-group'>
		<label class='control-label' for='inputEmail'>Email <sup>*</sup></label>
		<div class='controls'>
		  <input type='email' name='email' value='$r[email]' placeholder='Masukkan Email Anda' required>
		</div>
	  </div>	  
		<div class='control-group'>
		<label class='control-label'>Password <sup>*</sup></label>
		<div class='controls'>
		  <input type='password' name='password' placeholder='Password'>
		</div>
	  </div>
		<div class='control-group'>
			<label class='control-label' for='inputFname'>Nomot Telepon <sup>*</sup></label>
			<div class='controls'>
			  <input type='text' name='no_telp' value='$r[no_telp]' placeholder='Masukkan Nomor Telepon Anda' required>
			</div>
		 </div>
		 <div class='control-group'>
			<label class='control-label' for='inputFname'>Alamat <sup>*</sup></label>
			<div class='controls'>
			  <input type='text' value='$r[alamat_member]' name='alamat' placeholder='Masukkan Alamat Anda' required>
			</div>
		 </div>
	<div class='control-group'>
		<div class='controls'>
		 <input type='submit' name='submitAccount' value='Update' class='exclusive shopBtn'>
		</div>
	</div>
	</td>
		  </tr>
	</table>
	</form>
							</div>";
}

/*==================== Start Halaman Keranjang Belanja ====================*/
elseif ($_GET['module']=='keranjangbelanja'){
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM keranjang, produk WHERE id_session='$sid' AND keranjang.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);

	if($ketemu < 1){ # jika keranjang masih kosong
		echo "<script>window.alert('Keranjang Belanjan Anda Masih Kosong');window.location=('index.php')</script>";
	}
	
	else{ # jika keranjang tidak kosong
		$htmls= [];
		$no=1;
		while($r=mysql_fetch_array($sql)){
			$subtotalberat 	= $r['berat'] * $r['jumlah']; // total berat per item produk 
			$totalberat  	= $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
			$harga1 		= $r['harga'];
			$subtotal    	= $harga1 * $r['jumlah'];
			$total       	= $total + $subtotal;  
			$subtotal_rp 	= format_rupiah($subtotal);
			$total_rp    	= format_rupiah($total);
			$harga       	= format_rupiah($harga1);

			$produk_attr = [];
			if ( $r['kondisi'] ) {
				$produk_attr[]= "<span class='label label-info'>Kondisi : {$r['kondisi']}</span>";
			}
			if ( $r['warna'] ) {
				$produk_attr[]= "<span class='label label-info'>Warna : {$r['warna']}</span>";
			}
			if ( $r['ukuran'] ) {
				$produk_attr[]= "<span class='label label-info'>Ukuran : {$r['ukuran']}</span>";
			}

			$produk_attr = implode('&nbsp',$produk_attr);

			$htmls['rows_barang'] .= "
				<tr>
					<td>
						<input type='hidden' name='id[$no]' value='{$r['id_keranjang']}'>
						<img src='foto_produk/small_{$r['gambar']}' alt='Image 01' />
					</td>
					<td>
						{$r['nama_produk']}
						<div style='display: inline-flex;width:100%;'>{$produk_attr}</div>
					</td>
					<td>
						<input style='width:5rem;' type=number name='jml[$no]' value='{$r['jumlah']}' size=1 min='1' onChange='this.form.submit()'>
					</td>
					<td>Rp.&nbsp;{$harga}</td>
					<td>Rp.&nbsp;{$subtotal_rp}</td>
					<td><a href='aksi.php?module=keranjang&act=hapus&id={$r['id_keranjang']}'>Hapus</a> </td>
				</tr>
			";
			$no++; 
		}

		$berat_gram	= $totalberat;


		echo"
			<div class='span9'>
				<h4> Keranjang Belanja</h4>
				<form method=post action=aksi.php?module=keranjang&act=update>
					<table class='table table-bordered'>
						<thead>
							<tr>
								<th>Gambar</th>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Sub Total</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tbody>
							{$htmls['rows_barang']}
							<tr>
								<td colspan='4' class='alignR'>Total:	</td>
								<td colspan='2' class='labelX label-primaryX'> Rp. {$total_rp}</td>
							</tr>
						</tbody>
					</table>
					<br/>
		
					<a href='semua-produk.html' class='shopBtn btn-large'><span class='icon-arrow-left'></span> Lanjutkan Belanja </a>
					<a href='selesai-belanja.html' class='shopBtn btn-large pull-right'>Checkout <span class='icon-arrow-right'></span></a>
				</form>
			</div>
		";
	}
}
/*==================== End Halaman Keranjang Belanja ====================*/

elseif ($_GET['module']=='selesaibelanja'){
	$edit	=mysql_query("SELECT * FROM member WHERE id_member='$_SESSION[member_id]'");
    $e		=mysql_fetch_array($edit);
	$sid 	= session_id();

	if (empty($_SESSION['namalengkap']) AND empty($_SESSION['passuser'])){
		echo "<script>window.alert('Anda belum Login, Silahkan Login Terlebih dahulu');
        window.location=('media.php?module=loginmember')</script>";
	}
	else {
		$sid 		= session_id();
		$sql 		= mysql_query("SELECT * FROM keranjang,produk WHERE keranjang.id_produk=produk.id_produk AND keranjang.id_session='$sid'");
		$ketemu		= mysql_num_rows($sql);

		while($r=mysql_fetch_array($sql)){
			$subtotalberat 	= $r['berat'] * $r['jumlah']; // total berat per item produk 
			$totalberat  	= $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
		}
		$berat_gram = $totalberat;

		echo"							
			<div class='span9'>
				<h3> Form Checkout</h3>	
				<form action=simpantransaksi.php method=POST class='form-horizontal'>
					<table class='table table-bordered'>
						<tr>
							<th> Silahkan Isi Form Di Bawah Ini  </th>
						</tr>
						<tr> 
							<td>
	
		";

		require_once 'vendor/autoload.php';

		echo "
		<input type='hidden' id='provinsi' value='5' name ='provinsi' >
		<input type='hidden' id='des' name='kota' value='501'>
		<div class='control-group'>
			<label class='control-label'>Provinsi <sup>*</sup></label>
			<div class='controls'>
				<select id='provinsi2' name ='provinsi' required>";

				$data2 = RajaOngkir\RajaOngkir::Provinsi()->all();
				foreach ($data2 as $key => $value2) {
					echo '<option value="'.$value2['province_id'].'">'.$value2['province'].'</option>';
				}

				echo "</select>
			</div>
		</div>

		<div class='control-group'>
			<label class='control-label'>Kota Tujuan <sup>*</sup></label>
			<div class='controls'>
				<select id='des2' name='kota2' required></select>
			</div>
		</div>

		<input type=hidden value='$berat_gram' id='berat' class='form-control' name='berat'>
		<div class='control-group'>
			<label class='control-label' for='inputLname'>Kurir<sup>*</sup></label>
			<div class='controls'>
				<input type='radio' name='Kurir' value='jne' id='jne' >
				JNE <br>
				<input type='radio' name='Kurir' value='pos' id='pos' >
				POS <br>
				<input type='radio' name='Kurir' value='tiki' id='tiki' >
				TIKI
			</div>
		</div>

		<div class='control-group'>
			<label class='control-label' for='inputLname'>Ongkos Kirim<sup>*</sup></label>
			<div class='controls'>
				<select id='biaya' name='paket' required></select>
			</div>
		</div>

		<div class='control-group'>
			<label class='control-label' for='inputLname'>Alamat Pengiriman<sup>*</sup></label>
			<div class='controls'>
				<textarea style='width:100%' name='alamat' placeholder='Isi nama jalan, nomor rumah, nama gedung, dsb' required>$e[alamat_member]</textarea>
			</div>
		</div>

		<div class='control-group'>
			<div class='controls'>
				<input type='submit' name='submitAccount' value='Proses' class='exclusive shopBtn'>
			</div>
		</div>
	</form>
	</td>
		  </tr>
	</table>
							</div>";
	}
}
elseif ($_GET['module']=='datatransaksi'){
session_start();

echo"							
<div class='span9'>
<h3> Riwayat Data Order Anda</h3>	
	<hr class='soft'/>
	<div class='well'>
	<form action=edit_profil.php method=POST class='form-horizontal'>
	<input type=hidden name=id value='$r[id_member]'>
		
		<table class='table table-bordered table-condensed'>
                
	<thead>
          <tr bgcolor=#D3DCE3><th>No.order</th><th>Tgl. order</th><th>Jam</th><th>Status</th><th>Aksi</th></tr>
		  <tbody>";
    $tampil = mysql_query("SELECT * FROM orders,member WHERE orders.id_member=member.id_member AND orders.id_member='$_SESSION[member_id]' ORDER BY id_orders DESC ");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tanggal]);
	  $status=$r[status];
      echo "<tr><td align=center>$r[id_orders]</td>
                <td>$tanggal</td>
                <td>$r[jam]</td>
                <td>";
				if ($status=='Baru') {
		  echo"<font color='red'>$r[status]</font>";
		  } else {
		  echo"<font color='green'>$r[status]</font>";
		  }
				echo"</td>
		            <td><a href=media.php?module=detailtransaksi&id=$r[id_orders]>Detail</a></td></tr>";
      $no++;
    }
    echo "</tbody></table>
		
</div>
							</div>";

}
elseif ($_GET['module']=='detailtransaksi'){
session_start();
$edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	$status=$r[status];
    $tanggal=tgl_indo($r[tanggal]);
	$customer=mysql_query("select * from member where id_member='$r[id_member]'");
  $c=mysql_fetch_array($customer);
  
echo"							
<div class='span9'>
<h3> Riwayat Data Order Anda</h3>	
	<hr class='soft'/>
	<div class='well'>
	
	<table id='example1' class='table table-bordered table-striped'>
          <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam]</td></tr>
          <tr><td>Status Order      </td><td>: $r[status]</td></tr>
		 <tr><td>Alamat Pengiriman</td>        <td> : $r[alamat_pengiriman]</td></tr>
          </table>";
		
		// tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$_GET[id]'");
  
  echo "<table class='table table-bordered table-condensed'>
	
        <tr><td>Nama Produk</td><td>Berat(kg)</td><td>Jumlah</td><td>Harga Satuan</td><td>Sub Total</td></tr>";
  
  while($s=mysql_fetch_array($sql2)){
  $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    $harga1 = $s[harga];
	
   
   $subtotal    = $harga1 * $s[jumlah];
   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($harga1);

    echo "<tr><td>$s[nama_produk]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td><td>Rp. $harga</td><td>Rp. $subtotal_rp</td></tr>";
  }

$ongkoskirim = $r[ongkir];
$kode=$r[kode];
$grandtotal    = $total + $ongkoskirim; 
$grandtotal1    = $grandtotal + $kode;
$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal); 
$grandtotal1_rp  = format_rupiah($grandtotal1); 
    

echo "<tr><td colspan=4 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>     
      <tr><td colspan=4 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>      
      <tr><td colspan=4 align=right>Total Ongkos Kirim Rp. : </td><td align=right><b>$ongkoskirim_rp</b></td></tr>
      <tr><td colspan=4 align=right>Kode Unik : </td><td align=right><b>$kode</b></td></tr>      
      <tr><td colspan=4 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal1_rp</b></td></tr>
      </table>";
echo"	
</div>
							</div>";

}
elseif ($_GET['module']=='konfirmasipembayaran'){
	$htmls = [];
	$edit 		= mysql_query("SELECT * FROM orders WHERE id_orders='{$_GET[id]}'");
    $r    		= mysql_fetch_assoc($edit);
	$member 	= $r['id_member'];
    $tanggal	= tgl_indo($r['tanggal']);
	$customer	= mysql_query("select * from member where id_member='{$r['id_member']}'");
	$c			= mysql_fetch_assoc($customer);

	echo "							
		<div class='span9'>
			<div class='well well-small'>
				<h1>Data Order Anda <small class='pull-right'>  </small></h1>
				<hr class='soften'/>

				<table>
					<tr>
						<td>Nama Lengkap</td>
						<td> : <b>{$c['nama']} $member</b></td>
					</tr>
					<tr>
						<td>Alamat Pengiriman</td>
						<td> : {$r['alamat_pengiriman']}</td>
					</tr>
					<tr>
						<td>Telpon</td>
						<td> : {$c['no_telp']}</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td> : {$c['email']}</td>
					</tr>
					<tr>
						<td>Bank Pembayaran</td>
						<td> : {$v['nama_bank']}</td>
					</tr>
				</table>
				<!-- /table data pemesan -->

				<hr/>
				<div>
					<span> Nomor Order : <b>{$_GET['id']}</b></span>
				</div>
				<hr>";

				$daftarproduk=mysql_query("SELECT * FROM orders_detail,produk WHERE orders_detail.id_produk=produk.id_produk AND id_orders='$_GET[id]'");
	  
				echo "  
	
				<table class='table table-bordered table-condensed'>
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							<th>Berat&nbsp(Gram)</th>
							<th>Harga</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>";

					// $pesan ="Terimakasih telah melakukan pemesanan online di gskonveksi.besaba.com <br /><br />  

					// Nama: $r[nama] <br />
					// Alamat: $r[alamat] <br/>
					// Telpon: $r[no_telp] <br /><hr />
					
					// Nomor Order: $id_orders <br />
					// Data order Anda adalah sebagai berikut: <br /><br />";

					$no=1;
					$total 				= 0;
					$total_berat 		= 0;
					$total_ongkos_kirim = $r['ongkir'];

					while ($d=mysql_fetch_assoc($daftarproduk)){
						// $subtotalberat 	= $d['berat'] * $d['jumlah']; // total berat per item produk 
						// $totalberat  	= $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

						$berat 			= $d['berat'];
						$harga 			= $d['harga'];
						$subtotal    	= $harga * $d['jumlah'];

						$total       	+= $subtotal;
						$total_berat 	+= $berat;
						
						$rp = [
							'harga' 	=> format_rupiah($harga),
							'sub_total' => format_rupiah($subtotal)
						];    

						$produk_attr = [];
						if ( $d['kondisi'] ) {
							$produk_attr[]= "<span class='label label-info'>Kondisi : {$d['kondisi']}</span>";
						}
						if ( $d['warna'] ) {
							$produk_attr[]= "<span class='label label-info'>Warna : {$d['warna']}</span>";
						}
						if ( $d['ukuran'] ) {
							$produk_attr[]= "<span class='label label-info'>Ukuran : {$d['ukuran']}</span>";
						}
						$produk_attr = implode('&nbsp',$produk_attr);

						echo "
							<tr>
								<td>{$no}</td>
								<td>
									{$d['nama_produk']}
									<div style='display: inline-flex;width:100%;'>{$produk_attr}</div>
								</td>
								<td>{$d['jumlah']}</td>
								<td>{$berat}</td>
								<td>Rp.&nbsp;{$rp['harga']}</td>
								<td>Rp.&nbsp;{$rp['sub_total']}</td>
							</tr>
						";
									
						// $pesan .="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
						$no++; 
					}

					$kode_unik 		= $r['kode'];
					$grand_total    = $total + $total_ongkos_kirim + $kode_unik;
					$result 		= [
						'total' => format_rupiah($total),
						'total_berat' => $total_berat,
						'total_ongkos_kirim' => format_rupiah($total_ongkos_kirim),
						'kode_unik' => $kode_unik,
						'grand_total' => format_rupiah($grand_total),
					];

				echo"				
					<tr>
						<td colspan='5' class='alignR'>Total:	</td>
						<td>Rp.&nbsp;{$result['total']}</td>
					</tr>
					
					<tr>
						<td colspan='5' class='alignR'>Total Berat:	</td>
						<td >{$result['total_berat']} (Gram)</td>
					</tr>
					<tr>
						<td colspan='5' class='alignR'>Total Ongkos Kirim:	</td>
						<td >Rp.&nbsp;{$result['total_ongkos_kirim']}</td>
					</tr>
					<tr>
						<td colspan='5' class='alignR'>Kode Unik:	</td>
						<td >{$result['kode_unik']}</td>
					</tr>
					<tr>
						<td colspan='5' class='alignR'>Grand Total:	</td>
						<td class='label label-primary'>Rp.&nbsp;{$result['grand_total']}</td>
					</tr>
					</tbody>
				</table><br/>
				
				<p>Silahkan lanjutkan proses pembayaran melalui Akun Fasapay Anda dengan mengklik tombol di bawah ini<br />
				<form id='form1' name='form1' target='_blank' method='post' action='https://sci.fasapay.com/'>
					<input type='hidden' name='fp_acc' value='FP498022'>
					<input type='hidden' name='fp_acc_from' value='' />
					<input type='hidden' name='fp_store' value='Taurus Computer Solution'>
					<input type='hidden' name='fp_item' value='Pembelian Produk Taurus Computer Solution'>
					<input type='hidden' name='fp_amnt' value='{$grand_total}'>
					<input type='hidden' name='fp_currency' value='IDR'>
					<input type='hidden' name='fp_comments' value='Pembayaran menggunakan store variable'>
					<input type='hidden' name='fp_merchant_ref' value='BL000001' />
					<!-- baggage fields -->
					<input type='hidden' name='track_id' value='558421222'>
					<input type='hidden' name='order_id' value='BJ2993800'>
					<input name='' type='submit' value='Bayar Dengan Fasapay' />
				</form>
			</div>
		</div>";
	

}
elseif ($_GET['module']=='hasilcari'){
echo"
<h4>Produk Terbaru </h4>
			  <ul class='thumbnails'>";
			  // Tampilkan 4 produk terbaru
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM produk WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%' OR harga LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_produk DESC LIMIT 4";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p align=center>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>"; 
    while($r=mysql_fetch_array($hasil)){
	$harga1 = $r[harga];
    $harga     = number_format($harga1,0,",",".");
//		echo "<table><tr><td><span class=judul><a href=produk-$t[id_produk]-$t[produk_seo].html>$t[nama_produk]</a></span><br />";
      // Tampilkan hanya sebagian isi produk
      $isi_produk = htmlentities(strip_tags($r['deskripsi'])); // mengabaikan tag html
      $isi = substr($isi_produk,0,235); // ambil sebanyak 250 karakter
      $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
	echo"
				<li class='span3'>
				  <div class='thumbnail'>
					<a  href='media.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/medium_$r[gambar]' alt=''/></a>
					<div class='caption'>
					  <h5>$r[nama_produk]</h5>
					  <p> 
						<strong> Rp. $harga</strong> 
					  </p>
					 
					  <h4 style='text-align:center'><a class='btn' href='aksi.php?module=keranjang&act=tambah&id=$r[id_produk]'>Add to <i class='icon-shopping-cart'></i></a></h4>
					</div>
				  </div>
				</li>";
			}
			echo"
				
			  </ul>
			  ";
			  }
		  else{
    echo "<p align=center>Tidak ditemukan produk dengan kata <b>$kata</b></p>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Taurus Computer Solution</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Taurus Computer Solution">
		<meta name="keywords" content="Taurus Computer Solution">
		<meta name="author" content="csynoers">
		
		<!-- Bootstrap style --> 
		<link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
		<link href="themes/css/base.css?v=0.1" rel="stylesheet" media="screen"/>
		<!-- Bootstrap style responsive -->	
		<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
		<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
		<!-- Google-code-prettify -->	
		<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
		<!-- fav and touch icons -->
		<link rel="shortcut icon" href="themes/images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
		<style type="text/css" id="enject"></style>
	</head>
<body>
<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> User</strong></div>
			<div class="span6">
				<div class="pull-right">
					<?php
						if ( empty($_SESSION['namalengkap']) AND empty($_SESSION['passuser']) ){
							?>
								<a href="media.php?module=daftarmember"><span class="btn btn-mini btn-primary">Register</span></a>
							<?php
						}
						
					?>
					<a href="media.php?module=keranjangbelanja"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> Keranjang Belanja </span> </a> 
				</div>
			</div>
		</div>
		
		<!-- Navbar ================================================== -->
		<div id="logoArea" class="navbar">
			<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-inner">
				<?php
					$row = read_file('json/logo.json');
					echo "<a class='brand' href='index.php'><img src='src/logo/{$row->filename}' alt='Logo Taurus Computer'/></a>";
				?>
				<form class="form-inline navbar-search" action="hasil-pencarian.html" method="POST" >
					<input id="srchFld" class="srchTxt" type="text" name="kata"/>
					<button type="submit" id="submitButton" class="btn btn-primary">Cari</button>
				</form>
				<ul id="topMenu" class="nav pull-right">
				<?php
					if (empty($_SESSION['namalengkap']) AND empty($_SESSION['passuser'])){
						?>
							<li class=""><a href="index.php">Home</a></li>
							<li class=""><a href="semua-produk.html">Produk</a></li>
							<li class=""><a href="profil-kami.html">Profil</a></li>
							<li class="">
							<a hrefX="#login" href="media.php?module=loginmember" role="button" data-toggleX="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
							<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3>Form Login</h3>
								</div>
								<div class="modal-body">
									<form action="cek_login.php" method="POST" class="form-horizontal loginFrm">
									<div class="control-group">								
										<input class="input-block-level" type="email" name="email" id="inputEmail" placeholder="Masukan email disini" required>
									</div>
									<div class="control-group">
										<input class="input-block-level" type="password" name="password" id="inputPassword" placeholder="Masukan password disini" required>
									</div>
									<div class="control-group">
										<label class="checkbox">
										</label>
									</div>
									<button type="submit" class="btn btn-success">Sign in</button>
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									</form>		
									
								</div>
							</div>
							</li>
						<?php
					}
					if (!empty($_SESSION['namalengkap']) AND !empty($_SESSION['passuser'])){
						?>
							<li class=""><a href="index.php">Home</a></li>
							<li class=""><a href="semua-produk.html">Produk</a></li>
							<li class=""><a href="profil-kami.html">Profil</a></li>
							<li class=""><a href="logout.php">Logout</a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Header End====================================================================== -->

<?php
	if ($_GET['module']=='home'){
		?>
			<div id="carouselBlk">
				<div id="myCarousel" class="carousel slide">
					<div class="container">
						<div class="carousel-inner">
							<?php
								foreach ( read_file('json/slideshow.json') as $key => $value) {
									echo '
										<div class="item">
											<img style="width:100%" src="src/slideshow/'.$value.'" alt=""/>
											<div class="carousel-caption">
												<h4>title</h4>
												<p>ddescription</p>
											</div>
										</div>
									';
								}  
							?>
						</div>
					</div>

					<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div> 
			</div>
		<?php
	}
?>
<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
			<div id="sidebar" class="span3">
		
				<ul id="sideManu" class="nav nav-tabs nav-stacked">
					<li class="subMenu open"><a> Merk Laptop</a>
						<ul>
							<?php
								$sql=mysql_query("SELECT * FROM merk ORDER BY id_merk DESC");
								while($r=mysql_fetch_array($sql)){
									echo "
										<li><a href='media.php?module=detailmerk&id=$r[id_merk]'><i class='icon-chevron-right'></i>$r[nama_merk]</a></li>
									";
								}
							?>
						
						</ul>
					</li>
				</ul>
				<br/>
				<?php
					$sql=mysql_query("SELECT * FROM produk ORDER BY rand () LIMIT 2");
					while ($r=mysql_fetch_array($sql)){
						$harga1 = $r['harga'];
						$harga     = number_format($harga1,0,",",".");
						echo"
							<div class='thumbnail'>
								<img src='foto_produk/medium_$r[gambar]' alt='$r[nama_produk]'/>
								<div class='caption'>
								<h5>$r[nama_produk]</h5>
									<h4 style='text-align:center'><a class='btn' href='media.php?module=detailproduk&id=$r[id_produk]'> <i class='icon-zoom-in'></i></a> </h4>
								</div>
							</div><br/>
						";
					}
				?>
		  
				<div class="thumbnail">
					<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
					<div class="caption">
						<h5>Payment Methods</h5>
					</div>
				</div>
			</div>
			<!-- Sidebar end=============================================== -->

			<div class="span9">		
				
				<?php include"kanan.php" ?>	

			</div>
		</div>
	</div>
</div>

<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
		<?php
		  
		  if (!empty($_SESSION['namalengkap']) AND !empty($_SESSION['passuser'])){
		  ?>
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="media.php?module=editmember">AKUN ANDA</a>
				<a href="media.php?module=datatransaksi">RIWAYAT ORDER</a>
			 </div>
			<?php
			}
			?>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="media.php?module=hubungikami">HUBUNGI KAMI</a>  
				<a href="media.php?module=profilkami">PROFIL</a>  
				<a href="media.php?module=carabeli">CARA PEMBELIAN</a> 
			 </div>
			
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Taurus Computer Solution 2019</p>
	</div>
	<!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	
<script>
	$(document).ready(function(){
		$(document).on("change","select[name=provinsi]",function(){
			let id = $(this).val();
			$.get(`cek_kabupaten.php?q=${id}`,function( d ){
				$("select[name=kota]").html( d );
			});
		});

		$(document).on("change","select[name=kota]",function(){
			let id = $(this).val();
			$.get(`get_json.php?q=get-kota-by-city-id&id=${id}`,function( d ){
				$("input[name=kode_pos]").val( d.postal_code );
			},'json');
		});

		inputNumberOnly();
		function inputNumberOnly() {
			$(".input-number-only").keypress(function(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			});
		}

		if ( $("select[name=paket]").length > 0 ) {
			$("input[name=kurir]").val( $("select[name=paket]").find(":selected").text() );
			$("select[name=paket]").on('change',function(){
				$('#ongkosKirim').attr('data-value',$(this).val());
				$("input[name=kurir]").val( $(this).find(":selected").text() );
				getGrandTotal();
			});
		}

		$("#formFasapay").on('click','button',function(){
			let dateNow = new Date();
			let data = {
				"id_session"		: $("#idSession").val(),
				"id_orders"			: $("#idOrders").val(),
				"id_member"			: $("#idMember").val(),
				"ongkir" 			: $('#biaya').val(),
				"kurir" 			: $('#biaya').find(':selected').text(),
				"kode_unik" 		: $('#kodeUnik').text(),
				"tanggal"			: formatTanggal(dateNow),
				"jam"				: formatJam(dateNow),
				"alamat_lengkap" 	: $('table').find('tbody').find('tr').find('td#alamatPengiriman').html(),
			};
			console.log(data); 
		});

		$("table").find("tr").find("th").find(".send-to-other-address").on("click",function(){
			$('td#optionKurir, td#paymentMethod').css({"display":"none"});/* hide pilih pengiriman dan methode pembayaran saat user memilih kirim ke alamat lain */
			let htmls = {};
			htmls['option_provinsi'] = [];
			let _provinsi= getProvinsi();
			$.each(_provinsi,function(a,q){
				htmls.option_provinsi.push(`<option value='${q.province_id}'>${q.province}</option>`);
			});
			htmls['option_kota'] = [];
			let _kota= getKota(_provinsi[0].province_id);
			$.each(_kota,function(a,q){
				htmls.option_kota.push(`<option value='${q.city_id}'>${q.city_name}</option>`);
			});
			$('table').find('tbody').find('tr').find('td#alamatPengiriman').html(function(){
				return `
			<form id='formOtherAddress' method="post">
				<table class='table table-bordered'>
					<tr>
						<td><label class='control-label' for='inputFname'>Nama Lengkap <sup>*</sup></label></td>
						<td><input type='text' class='input-block-level mod-width-fit-content' name='nama' id='inputFname' placeholder='Masukkan Nama Lengkap' required></td>
					</tr>
					<tr>
						<td><label class='control-label' for='inputFname'>Nomor Telepon <sup>*</sup></label></td>
						<td><input type='text' class='input-block-level mod-width-fit-content input-number-only' min='0' name='no_telp'  placeholder='08123456789' required></td>
					</tr>	  
					<tr>
						<td><label class='control-label' for='inputEmail'>Email <sup>*</sup></label></td>
						<td><input type='email' class='input-block-level mod-width-fit-content' name='email' placeholder='email@gmail.com' required></td>
					</tr>
					<tr>
						<td><label class='control-label'>Provinsi <sup>*</sup></label></td>
						<td>
							<select class='input-block-level mod-width-fit-content' name='provinsi' required>
								${htmls.option_provinsi.join('')}
							</select>
						</td>
					</tr>
					<tr>
						<td><label class='control-label'>Kota/Kabupaten <sup>*</sup></label></td>
						<td>
							<select class='input-block-level mod-width-fit-content' name='kota' required>
								${htmls.option_kota.join('')}
							</select>
						</td>
					</tr>
					<tr>
						<td><label class='control-label' for='inputFname'>Kode Pos <sup>*</sup></label></td>
						<td><input type='text' class='input-block-level mod-width-fit-content input-number-only'  name='kode_pos'  placeholder='Kode Pos' required></td>
					</tr>
					<tr>
						<td><label class='control-label' for='inputFname'>Alamat Lengkap <sup>*</sup></label></td>
						<td><textarea class='input-block-level' id='alamat' name='alamat' placeholder='Isi nama jalan, nomor rumah, nama gedung, dsb' required></textarea></td>
					</tr>
					<tr>
						<td colspan='2'><button type="submit" class='btn btn-block btn-info'>Set Alamat Penerima</button></td>
					</tr>
				</table>
			</form>
				`;
			});
			inputNumberOnly();
			$('form#formOtherAddress').on("submit",function(e){
				e.preventDefault();
				let kota = getKotaByKotaId( $(this).find('select[name=kota]').find(":selected").val() );
				let newAlamat = `
					<b>${$(this).find('input[name=nama]').val()}</b><br>
					${$(this).find('input[name=no_telp]').val()} (${$(this).find('input[name=email]').val()})<br>
					${$(this).find('textarea[name=alamat]').val()}, ${kota.type} ${kota.city_name}, ${kota.province} ${$(this).find('input[name=kode_pos]').val()}
				`;
				$('td#alamatPengiriman').html(newAlamat);/* set alamat baru */
				$.get("get_ongkir_api.php",{"data":'option-kurir-html',"d":kota.city_id,"w":$('td#totalBerat').attr('data-value')},function(html){
					$('td#optionKurir').find('#biaya').html(html);
				});
				$('td#optionKurir, td#paymentMethod').css({"display":"block"});/* hide pilih pengiriman dan methode pembayaran saat user memilih kirim ke alamat lain */
				
			});
		});

		function getProvinsi() {
			return JSON.parse( $.ajax({type: "GET", url: "get_ongkir_api.php", async: false, data: {"data" : "provinsi"} }).responseText );
		}
		function getKota(id) {
			return JSON.parse(
				$.ajax({
					type: "GET",
					url: "get_ongkir_api.php",
					async: false,
					data: {"data" : "kota-by-provinsi","id":id}
				}).responseText
			);
		}
		function getKotaByKotaId(id) {
			return JSON.parse(
				$.ajax({
					type: "GET",
					url: "get_ongkir_api.php",
					async: false,
					data: {"data" : "kota-by-kota-id","id":id}
				}).responseText
			);
		}

		function numberToCurrency( bilangan ) {
			let	number_string = bilangan.toString(),
				sisa 	= number_string.length % 3,
				rupiah 	= number_string.substr(0, sisa),
				ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
					
			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			// Cetak hasil
			return rupiah; // Hasil: 23.456.789
		}

		function getGrandTotal() {
			let data = {
				"total_harga" : $('table tr td #totalHarga').attr('data-value'),
				"ongkos_kirim" : $('table tr td #ongkosKirim').attr('data-value'),
				"kode_unik" : $('table tr td #kodeUnik').attr('data-value')
			};
			let total = (data.total_harga*1)+(data.ongkos_kirim*1)+(data.kode_unik*1);
			
			/*target change*/
			$('table tr td #ongkosKirim').html( `Rp.&nbsp;${numberToCurrency(data.ongkos_kirim)}`);
			$('table tr td #grandTotal').attr( 'data-value',total);
			$('table tr td #grandTotal').html( `Rp.&nbsp;${numberToCurrency(total)}`);
		}

		function formatTanggal(date) {
			let d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();

			if (month.length < 2) 
				month = '0' + month;
			if (day.length < 2) 
				day = '0' + day;

			return [year, month, day].join('-');
		}

		function formatJam(date) {
			return `${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
		}

		$('body').append("</bo"+"dy>");

	});

		// function  load_ajax(url, callback){
		  
		// 	var xhr = new XMLHttpRequest();
		// 	xhr.onreadystatechange = cekstatus;

		// 	function cekstatus(){
		// 		if(xhr.readyState === 4 && xhr.status === 200 ){
		// 		callback(xhr.responseText);
		// 		}
		// 	}
		// 	xhr.open('GET',url,true);
		// 	xhr.send();

		// }

		// Asal
		// document.getElementById('provinsi').onclick = function(){
		// 	text = document.getElementById('provinsi').value;
		// 	load_ajax('cek_kabupaten.php?q='+ text, function(data){
		// 		console.log(data);
		// 		document.getElementById('des').innerHTML = data ;
		// 	});
		// };


		// Tujuan
		// document.getElementById('provinsi2').onclick = function(){
		// 	text = document.getElementById('provinsi2').value;
		// 	load_ajax('cek_kabupaten.php?q='+ text, function(data){
		// 		console.log(data);
		// 		document.getElementById('des2').innerHTML = data ;
		// 	});
		// };

		// Kurir Pos
		// document.getElementById('pos').onclick = function(){
		// 	text = pos.value;
		// 	des = document.getElementById('des').value;
		// 	des2 = document.getElementById('des2').value;
		// 	berat = document.getElementById('berat').value;
		// 	load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		// 		console.log(data);
		// 		biaya.innerHTML = data ;
		// 	});
		// };

		// Kurir tiki
		// document.getElementById('tiki').onclick = function(){
		// 	text = tiki.value;
		// 	des = document.getElementById('des').value;
		// 	des2 = document.getElementById('des2').value;
		// 	berat = document.getElementById('berat').value;
		// 	load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		// 		console.log(data);
		// 		biaya.innerHTML = data ;
		// 	});
		// };

		// Kurir jne
		// document.getElementById('jne').onclick = function(){
		// 	text = jne.value;
		// 	des = document.getElementById('des').value;
		// 	des2 = document.getElementById('des2').value;
		// 	berat = document.getElementById('berat').value;
		// 	load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		// 		console.log(data);
		// 		biaya.innerHTML = data ;
		// 	});
		// };

	</script>
</html>
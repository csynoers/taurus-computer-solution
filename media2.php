<?php
	ob_start();
	session_start();	
	// error_reporting(0);
	include "config/koneksi.php";
	include "config/fungsi_thumb.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
	include "config/fungsi_rupiah.php";
	$succesUrl = $serverUrlAndPath."success.php";
	$failUrl = $serverUrlAndPath."fail.php";
	$statusUrl = $serverUrlAndPath."status.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Taurus Computer Solution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
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
				<a href="media2.php?module=daftarmember"><span class="btn btn-mini btn-primary">Register</span></a>
			<?php
		}
		  
	?>
		<a href="media2.php?module=keranjangbelanja"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> Keranjang Belanja </span> </a> 
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
    <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="Bootsshop"/></a>
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
	 <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Login</span></a>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Form Login</h3>
		  </div>
		  <div class="modal-body">
			<form action="cek_login.php" method="POST" class="form-horizontal loginFrm">
			  <div class="control-group">								
				<input type="email" name="email" id="inputEmail" placeholder="Email" required>
			  </div>
			  <div class="control-group">
				<input type="password" name="password" id="inputPassword" placeholder="Password" required>
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
<?php
	if ($_GET[module]=='home'){
	?>
<!-- Header End====================================================================== -->
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  
		  <div class="item">
		  <div class="container">
			<a href="register.html"><img style="width:100%" src="themes/images/carousel/1.png" alt=""/></a>
				<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<img src="themes/images/carousel/2.png" alt=""/>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
			
		  </div>
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
									echo"
				<li><a href='media2.php?module=detailmerk&id=$r[id_merk]'><i class='icon-chevron-right'></i>$r[nama_merk]</a></li>";
				}
				?>
				
				</ul>
			</li>
			
		</ul>
		<br/>
		<?php
				$sql=mysql_query("SELECT * FROM produk ORDER BY rand () LIMIT 2");
									while ($r=mysql_fetch_array($sql)){
    $harga1 = $r[harga];
    $harga     = number_format($harga1,0,",",".");
									echo"
		  <div class='thumbnail'>
			<img src='foto_produk/medium_$r[gambar]' alt='$r[nama_produk]'/>
			<div class='caption'>
			  <h5>$r[nama_produk]</h5>
				<h4 style='text-align:center'><a class='btn' href='media2.php?module=detailproduk&id=$r[id_produk]'> <i class='icon-zoom-in'></i></a> </h4>
			</div>
		  </div><br/>";
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
				<a href="media2.php?module=editmember">AKUN ANDA</a>
				<a href="media2.php?module=datatransaksi">RIWAYAT ORDER</a>
			 </div>
			<?php
			}
			?>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="media2.php?module=hubungikami">HUBUNGI KAMI</a>  
				<a href="media2.php?module=profilkami">PROFIL</a>  
				<a href="media2.php?module=carabeli">CARA PEMBELIAN</a> 
			 </div>
			
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Taurus Computer Solution 2019</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	
<script>

		function  load_ajax(url, callback){
		  
		  var xhr = new XMLHttpRequest();
		  xhr.onreadystatechange = cekstatus;

		  function cekstatus(){
		    if(xhr.readyState === 4 && xhr.status === 200 ){
		      callback(xhr.responseText);
		    }
		  }
		  xhr.open('GET',url,true);
		  xhr.send();

		}

		// Asal
		document.getElementById('provinsi').onclick = function(){
		  text = document.getElementById('provinsi').value;
		  load_ajax('cek_kabupaten.php?q='+ text, function(data){
		    console.log(data);
		    document.getElementById('des').innerHTML = data ;
		  });
		};


		// Tujuan
		document.getElementById('provinsi2').onclick = function(){
		  text = document.getElementById('provinsi2').value;
		  load_ajax('cek_kabupaten.php?q='+ text, function(data){
		    console.log(data);
		    document.getElementById('des2').innerHTML = data ;
		  });
		};

		// Kurir Pos
		document.getElementById('pos').onclick = function(){
		  text = pos.value;
		  des = document.getElementById('des').value;
		  des2 = document.getElementById('des2').value;
		  berat = document.getElementById('berat').value;
		  load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		    console.log(data);
		    biaya.innerHTML = data ;
		  });
		};

		// Kurir tiki
		document.getElementById('tiki').onclick = function(){
		  text = tiki.value;
		  des = document.getElementById('des').value;
		  des2 = document.getElementById('des2').value;
		  berat = document.getElementById('berat').value;
		  load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		    console.log(data);
		    biaya.innerHTML = data ;
		  });
		};

		// Kurir jne
		// document.getElementById('tiki').onclick = function(){
		//   text = tiki.value;
		//   des = document.getElementById('des').value;
		//   des2 = document.getElementById('des2').value;
		//   berat = document.getElementById('berat').value;
		//   load_ajax('cek_ongkir.php?q='+ text + '&o=' + des + '&p=' + des2 + '&w=' + berat, function(data){
		//     console.log(data);
		//     biaya.innerHTML = data ;
		//   });
		// };

	</script>
</body>
</html>
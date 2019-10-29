<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_karyawan/aksi_karyawan.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>KARYAWAN</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin'){
			echo"
			<button type=button class='btn btn-primary' onclick=\"window.location.href='?module=karyawan&act=tambahkaryawan';\"><i class='fa fa-plus'> Tambah</i></button>
							<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body'>
			<div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr><th>No</th><th>Username</th><th>Nama Lengkap</th><th>Email</th><th>No.Telp</th><th>Aksi</th></tr></thead>
	<thead>
	<tbody>";
	if ($_SESSION['leveluser']=='admin'){	
	$tampil = mysql_query("SELECT * FROM user WHERE level='karyawan' ORDER BY id_user DESC");
	}
	else {
	$tampil = mysql_query("SELECT * FROM user WHERE level='karyawan' AND id_user='$_SESSION[id_user]' ORDER BY id_user DESC");
	}
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
		         <td>$r[email]</td>
		         <td>$r[no_telp]</td>
             <td><a href=?module=karyawan&act=editkaryawan&id=$r[id_user] class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>";
			 if ($_SESSION['leveluser']=='admin'){
			 echo"
			     <a href=$aksi?module=karyawan&act=hapus&id=$r[id_user] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
			}
			echo"
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  case "tambahkaryawan":
    
   echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH KARYAWAN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=karyawan&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Username</label>
                  <input type='text' class='form-control' name='username' id='exampleInputEmail1' placeholder='Masukkan Username' required>
                </div>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Password' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama_lengkap' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' required>
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
    
  case "editkaryawan":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT KARYAWAN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=karyawan&act=update>
          <input type=hidden name=id value='$r[id_user]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Username </label>
                  <input type='text' class='form-control' name='username' id='exampleInputEmail1' placeholder='Masukkan Username' value='$r[username]' required>
                </div>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password **)</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Ganti Password'>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama_lengkap' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' value='$r[nama_lengkap]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' value='$r[no_telp]' required>
                </div>
				<div class='form-group'>
                  <p class='help-block'>*) Username Tidak Bisa Diganti.</p>
				  <p class='help-block'>**) Apabila password tidak diubah, dikosongkan saja.</p>
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
}
?>

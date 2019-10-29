<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_member/aksi_member.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>MEMBER</h3>
            </div>
			<button type=button class='btn btn-primary' onclick=\"window.location.href='?module=member&act=tambahmember';\"><i class='fa fa-plus'> Tambah</i></button>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr><th>No</th><th>Nama Lengkap</th><th>Email</th><th>No.Telp/HP</th><th>Aksi</th></tr></thead>
	<thead>
	<tbody>"; 
	$tampil = mysql_query("SELECT * FROM member ORDER BY id_member");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
		     <td>$r[email]</td>
		     <td>$r[no_telp]</td>
             <td><a href=?module=member&act=editmember&id=$r[id_member] class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
			     <a href=$aksi?module=member&act=hapus&id=$r[id_member] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
    
  case "tambahmember":

    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Tambah Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=member&act=input>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Ganti Password'>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' value='$r[nama]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' value='$r[no_telp]' required>
                </div				
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
case "editmember":
    $edit=mysql_query("SELECT * FROM member WHERE id_member='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Edit Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=member&act=update>
            <input type=hidden name=id value='$r[id_member]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password **)</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Ganti Password'>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' value='$r[nama]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' value='$r[no_telp]' required>
                </div				
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

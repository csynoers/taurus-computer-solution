<?php
    $aksi="modul/mod_merk/aksi_merk.php";
    switch($_GET['act']){
        default:
            $htmls = [];
            $no = 1;
            foreach ( read_file('../json/warna.json') as $key => $value) {
                $htmls['tablerows'] .= "
                    <tr>
                        <td>{$no}</td>
                        <td>{$value}</td>
                        <td>
                            <a href=?module=merk&act=edit&id= class='btn btn-warning btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
                            <a href=$aksi?module=merk&act=hapus&id= class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
                        </td>
                    </tr>
                ";
                $no++;
            }

            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Warna Produk</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class='box-body'>
                            <div class='box-body table-responsive no-padding'>
                                <table id='example1' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Warna</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>{$htmls["tablerows"]}</tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            ";
            
            break;
  
  // Form Tambah merk
  case "tambahmerk":
    
	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH MERK</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=merk&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Merk</label>
                  <input type='text' class='form-control' name='nama_merk' id='exampleInputEmail1' placeholder='Masukkan Nama merk' required>
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
  
  // Form Edit merk  
  case "editmerk":
    $edit=mysql_query("SELECT * FROM merk WHERE id_merk='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT MERK</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=merk&act=update>
            <input type=hidden name=id value='$r[id_merk]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Merk</label>
                  <input type='text' class='form-control' name='nama_merk' id='exampleInputEmail1' placeholder='Masukkan Nama merk' value='$r[nama_merk]' required>
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

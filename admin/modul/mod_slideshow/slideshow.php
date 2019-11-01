<?php
    session_start();
    if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
        echo "<link href='style.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
        echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    }
    else{

    $aksi="modul/mod_logo/aksi_logo.php";
    switch($_GET['act']){
        // Tampil User
        default:
            $rows_html = '';
            foreach ( read_file('../json/slideshow.json') as $key => $value) {
                $rows_html .= "
                    <div class='col-xs-12 col-sm-6'>
                        <img class='img-responsive' src='../src/slideshow/{$value}' alt='{$value}'>
                        <hr>
                        <form method=POST enctype='multipart/form-data' action='{$aksi}?module=logo&act=update'>
                            <input type='file' name='fupload' required>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
                        <button type='submit' class='btn btn-danger'>Delete</button>
                    </div>
                ";
            }
            $rows_html = "<div class='row'>{$rows_html}</div>";    

            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Slideshow</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class='box-body'>
                            <form method=POST enctype='multipart/form-data' action='{$aksi}?module=logo&act=insert'>
                                <div class='form-group'>
                                    <label>Tambah Slide Baru</label>
                                    <input type='file' name='fupload' required>
                                </div>
                                <button type='submit' class='btn btn-primary'>Simpan</button>
                            </form>
                            <hr>
                            {$rows_html}
                            <hr>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box -->
                </div>
            ";
        break;
    }
}

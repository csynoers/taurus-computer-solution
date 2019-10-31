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
            $row = read_file('../json/logo.json');
            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Logo Website</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class='box-body'>
                            <img class='img-responsive' src='../src/logo/{$row->filename}' alt='Logo Taurus Computer'>
                            <hr>
                            <form method=POST action='{$aksi}?module=logo&act=update'>
                                <div class='form-group'>
                                    <label>Ganti Logo</label>
                                    <input type='file' name='fupload' required>
                                </div>
                                <button type='submit' class='btn btn-primary'>Update</button>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box -->
                </div>
            ";
        break;
    }
}

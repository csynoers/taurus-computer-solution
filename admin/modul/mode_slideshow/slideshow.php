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
            print_r(read_file('../json/logo.json'));
            die();
            $rows_html = '';
            foreach ( read_file('../json/slideshow.json') as $key => $value) {
                $rows_html .= "
                    <div class='col-xs-12 col-sm-6'>
                        <img class='img-responsive' src='../src/slideshow/{$value}' alt='{$value}'>
                    </div>
                ";
            }
            $rows_html .= "<div class='row'>{$rows_html}</div>";    

            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Slideshow</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class='box-body'>
                            {$rows_html}
                            <hr>
                            <form method=POST enctype='multipart/form-data' action='{$aksi}?module=logo&act=update'>
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

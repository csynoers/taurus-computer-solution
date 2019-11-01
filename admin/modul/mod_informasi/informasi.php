<?php
    session_start();
    if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
        echo "<link href='style.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
        echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    }
    else{

    $aksi="modul/mod_informasi/aksi_informasi.php";
    switch($_GET['act']){
        // Tampil User
        default:
            $rows_html = '';
            foreach ( read_file('../json/informasi.json') as $key => $value) {
                $rows_html .= "
                    <div class='col-xs-12 col-sm-6'>
                        <img class='img-responsive' src='../src/informasi/{$value}' alt='{$value}'>
                        <hr>
                        <form method=POST enctype='multipart/form-data' action='{$aksi}?module=informasi&act=update&id={$key}'>
                            <textarea class='textarea form-control' name='deskripsi' rowsX='20' colsX='80' required=''>{$value}</textarea>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
                        <button type='button' onclick=\"window.location.href='{$aksi}?module=informasi&act=delete&id={$key}';\" class='btn btn-danger'>Delete</button>
                    </div>
                ";
            }
            $rows_html = "<div class='row'>{$rows_html}</div>";    

            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Informasi</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class='box-body'>
                            {$rows_html}
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box -->
                </div>
            ";
        break;
    }
}

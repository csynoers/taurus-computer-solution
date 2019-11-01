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
            $title= [
                'hubungi_kami' => 'Hubungi Kami',
                'profil' => 'Profil',
                'cara_pembelian' => 'Cara Pembelian',
            ];
            foreach ( read_file('../json/informasi.json') as $key => $value) {
                $rows_html .= "
                    <div class='col-xs-12 col-sm-12'>
                        <hr>
                        <form method=POST enctype='multipart/form-data' action='{$aksi}?module=informasi&act=update&id={$key}'>
                            <div class='form-group'>
                                <label>{$title[$key]}</label>
                                <textarea class='textarea form-control' name='deskripsi' rowsX='20' colsX='80' required=''>{$value}</textarea>
                            </div>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
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

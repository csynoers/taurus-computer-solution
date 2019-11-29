<?php
    session_start();
    include_once "config/koneksi.php";
    $data = [];
    $data['post'] = $_POST;

    if ( empty($data['post']['password']) ) {
        $data['sql_update_member'] = ("
            UPDATE member
                SET
                    nama            = '{$data['post']['nama']}',
                    email           = '{$data['post']['email']}',
                    alamat_member   = '{$data['post']['alamat']}',
                    no_telp         = '{$data['post']['no_telp']}',  
                    provinsi        = '{$data['post']['provinsi']}',  
                    kota            = '{$data['post']['kota']}',  
                    kode_pos        = '{$data['post']['kode_pos']}'  
                WHERE
                    id_member       = '{$data['post']['id']}'
        ");
    }
    // Apabila password diubah
    else{
        $data['post']['password'] = md5($data['post']['password']);
        $data['sql_update_member'] = ("
            UPDATE member
                SET
                    password        = '{$data['post']['password'] }',
                    nama            = '{$data['post']['nama'] }',
                    alamat_member   = '{$data['post']['alamat']}',
                    email           = '{$data['post']['email']}',  
                    no_telp         = '{$data['post']['no_telp']}',  
                    provinsi        = '{$data['post']['provinsi']}',  
                    kota            = '{$data['post']['kota']}',  
                    kode_pos        = '{$data['post']['kode_pos']}'  
                WHERE
                    id_member      = '$_POST[id]'");
    }

    if ( mysql_query($data['sql_update_member']) ) { # TRUE
        echo "<script>window.alert('Data berhasil diubah');window.location=('edit-member.html')</script>";

    } else { # FALSE
        echo "<script>window.alert('Data gagal diubah');window.location=('edit-member.html')</script>";

    }
    

?>

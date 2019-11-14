<?php
    $aksi="modul/mod_ukuran/aksi_ukuran.php";
    switch($_GET['act']){
        default:
            $htmls = [];
            $no = 1;
            foreach ( read_file('../json/ukuran.json') as $key => $value) {
                $htmls['tablerows'] .= "
                    <tr>
                        <td>{$no}</td>
                        <td>{$value}</td>
                        <td>
                            <a data-id='{$key}' data-value='{$value}' data-action='{$aksi}' href='javascript:void(0)' class='btn btn-warning btn-xs btn-edit' title='Edit'><i class='fa fa-edit'></i> Edit</a>
                            <!--<a href=$aksi?module=merk&act=hapus&id= class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>-->
                        </td>
                    </tr>
                ";
                $no++;
            }

            echo "
                <div class='col-xs-12'>
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>Ukuran Produk</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class='box-body'>
                            <div class='panel panel-default' id='formInput'>
                                <div class='panel-heading'> + Tambah Ukuran Baru</div>
                                <div class='panel-body'>
                                    <form method=POST action='{$aksi}?module=ukuran&act=input'>
                                        <div class='form-group'>
                                            <label>Nama Ukuran : </label>
                                            <input value='' type='text' class='form-control' name='ukuran' placeholder='Masukkan ukuran baru ...' required>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Simpan</button>
                                    </form>
                                    <!-- /form -->
                                </div>
                            </div>

                            <hr>
                            <div class='box-body table-responsive no-padding'>
                                <table id='example1' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Ukuran</th>
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
            ?>
            <script>
                $(document).ready(function(){
                    $(document).on('click','.btn-edit',function(){
                        let data= {
                            "id" : $(this).data('id'),
                            "value" : $(this).data('value'),
                            "action" : $(this).data('action'),
                        };

                        $('#formInput').find('.panel-heading').text('Edit Ukuran: '+data.value);
                        $('form').attr({ "action" : `${data.action}?module=ukuran&act=update&id=${data.id}` });
                        $('form').find('input[name=ukuran]').val(data.value);
                        $('form').find('button[type=submit]').text('Update');

                        // alert(JSON.stringify(data)); #for debuging
                    });
                });
            </script>
            <?php

            break;
    }
?>

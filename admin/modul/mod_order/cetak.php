<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Taurus Computer Solution | Invoice</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bootstrap.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="AdminLTE.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body onload="window.print();">
        <?php
            include "../../../config/koneksi.php";
            include "../../../config/fungsi_rupiah.php";
            include "../../../config/fungsi_indotgl.php";
            $edit       = mysql_query("SELECT * FROM orders WHERE id_orders='{$_GET['id']}' ");
            $r          = mysql_fetch_assoc($edit);
            $tanggal    = tgl_indo($r['tanggal']);
            $customer   = mysql_query("select * from member where id_member='{$r['id_member']}' ");
            $c          = mysql_fetch_assoc($customer);

            // tampilkan rincian produk yang di order
            $data                           = [];
            $data['rows_order_detail_html'] = [];
            $sql    = mysql_query("SELECT * FROM orders_detail,produk WHERE orders_detail.id_produk=produk.id_produk AND id_orders='$_GET[id]'");
            while( $s= mysql_fetch_array($sql) ){
                $produk_attr = [];
                if ( $s['kondisi'] ) {
                    $produk_attr[]= "Kondisi : {$s['kondisi']}";
                }
                if ( $s['warna'] ) {
                    $produk_attr[]= "Warna : {$s['warna']}";
                }
                if ( $s['ukuran'] ) {
                    $produk_attr[]= "Ukuran : {$s['ukuran']}";
                }
                $produk_attr = implode(',',$produk_attr);
                $produk_attr = "<small>({$produk_attr})</small>";

                $data['rows_order_detail_html'][] = "
                    <tr>
                        <td>{$s['nama_produk']} {$produk_attr}</td>
                        <td>{$s['berat']}</td>
                        <td>{$s['jumlah']}</td>
                        <td>Rp. ".format_rupiah($s['harga'])."</td>
                        <td>Rp. ".format_rupiah($s['harga']*$s['jumlah'])."</td>
                    </tr>
                ";
            }

            $data['rows_order_detail_html'][] = "
                <tr>
                    <th colspan='3' rowspan='4'></th>
                    <th>Total:</th>
                    <td>Rp. ".format_rupiah($r['total'])."</td>
                </tr>
                <tr>
                    <th>Ongkos Kirim:</th>
                    <td>Rp. ".format_rupiah($r['ongkir'])."</td>
                </tr>
                <tr>
                    <th>Kode Unik:</th>
                    <td>{$r['kode']}</td>
                </tr>
                <tr>
                    <th>Grand Total:</th>
                    <td>Rp. ".format_rupiah($r['grandtotal'])."</td>
                </tr>
            ";
            
            $data['rows_order_detail_html'] = implode('',$data['rows_order_detail_html']);

            echo "
                <div class='wrapper'>
                    <!-- Main content -->
                    <section class='invoice'>
                        <!-- title row -->
                        <div class='row'>
                            <div class='col-xs-12'>
                                <h2 class='page-header'>
                                    <i class='fa fa-globe'></i> Taurus Computer Solution.
                                    <small class='pull-right'>Date: {$tanggal}</small>
                                </h2>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class='row'>
                            <div class='col-xs-12 table-responsive'>
                                <table class='table'>
                                    <tr>
                                        <td>
                                            Dari :
                                            <address>
                                                <strong>Taurus Computer Solution.</strong><br>
                                                Jalan Dr. Sardjito, Blimbingsari, GK V No. 10 <br>
                                                Sleman,Yogyakarta<br>
                                                Email: tauruscomputer@gmail.com
                                            </address>
                                        </td>
                                        <td>
                                            Kepada :
                                            <address>
                                                {$r['alamat_pengiriman']}
                                            </address>
                                        </td>
                                        <td>
                                            <b>Invoice</b><br>
                                            <br>
                                            <b>Order ID : </b> {$r['id_orders']}<br>
                                            <b>Tgl. Transaksi : </b> {$tanggal}<br>
                                            <b>Kurir : </b> {$r['kurir']}<br>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class='row'>
                            <div class='col-xs-12 table-responsive'>
                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Berat(Gram)</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>{$data['rows_order_detail_html']}</tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row --> 
                    </div>
                    <!-- /.box -->
                </div>
            ";
        ?>
    </body>
</html>

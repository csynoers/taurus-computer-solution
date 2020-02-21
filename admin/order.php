<?php
    session_start();
    if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){ # jika username dan password kosong makan akan di lempar pada halaman login
        echo "
            <link href='style.css' rel='stylesheet' type='text/css'>
            <center>
                Untuk mengakses modul, Anda harus login <br>
                <a href=../../index.php><b>LOGIN</b></a>
            </center>
        ";
    }
    else{ # jika username dan password tidak kosong
        $aksi="modul/mod_order/aksi_order.php";
        
        switch($_GET['act']){
            default:
                $data                       = [];

                /* start generate data belum bayar */
                $data['queryBelumBayar']    = mysql_query("SELECT orders.id_orders,member.nama,orders.tanggal,orders.jam,orders.grandtotal FROM orders LEFT JOIN member ON member.id_member=orders.id_member WHERE 1");
                while ($value = mysql_fetch_assoc($data['queryBelumBayar'])) {
                    $value['tanggal']    = tgl_indo($value['tanggal']);
                    $value['grandtotal'] = tgl_indo($value['grandtotal']);
                    
                    $data['belumBayar'][]  = "
                        <tr>
                            <td>{$value['id_orders']}</td>
                            <td>{$value['nama']}</td>
                            <td>{$value['tanggal']}</td>
                            <td>{$value['jam']}</td>
                            <td>{$value['grandtotal']}</td>
                        </tr>
                    ";
                }
                $data['belumBayar']         = implode('',$data['belumBayar']);
                $data['belumBayar']         = empty($data['belumBayar']) ? '<tr><td colspan="4" style="padding: 20px 20px 0px 20px;text-align: center;"><div class="alert alert-success">Tidak ada transaksi</div></td></tr>' : $data['belumBayar'] ;
                /* end generate data belum bayar */

                // $data['kemarin'] = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
                // $data['order_expired'] = mysql_num_rows(mysql_query("SELECT * FROM `orders` WHERE 1 AND orders.status='Unpaid' AND orders.tanggal < '2019-12-01'"));
                // $data['update_produk'] = ("
                //     UPDATE
                //         produk,
                //         orders_detail,
                //         orders
                //     SET
                //         produk.stok=produk.stok+orders_detail.jumlah 
                //     WHERE produk.id_produk=orders_detail.id_produk 
                //         AND orders.id_orders=orders_detail.id_orders
                //         AND orders.tanggal < '{$data['kemarin']}' 
                //         AND orders.status='Unpaid'
                // ");
                // $data['delete_order'] = ("
                //     DELETE
                //         orders,
                //         orders_detail
                //     FROM orders 
                //         INNER JOIN orders_detail
                //     WHERE orders.id_orders=orders_detail.id_orders
                //         AND orders.status='Unpaid'
                //         AND orders.tanggal < '{$data['kemarin']}'
                // ");
                // if ( $data['order_expired'] > 0 ) { # jika terdapat order yang sudah lebih dari sehari hapus data order
                //     mysql_query($data['update_produk']); # kembalikan jumlah produk yang ada di detail order ke tabel produk jumlah stok
                //     mysql_query($data['delete_order']); # delete order kadaluarsa/expired
                // }
                
                // $data['rows_order_html'] = [];
                // $tampil = mysql_query("SELECT *,orders.status AS status_mod FROM orders,member WHERE orders.id_member=member.id_member ORDER BY orders.tanggal DESC ");					
                // while( $r=mysql_fetch_assoc($tampil) ){
                //     $tanggal        = tgl_indo($r['tanggal']);
                //     $status         = $r['status_mod'];
                //     $grandtotal_rp  = format_rupiah($r['grandtotal']);
                    
                //     if ($status=='Unpaid') {
                //         $status_mod = "<font color='red'>{$r['status_mod']}</font>";
                //     } else {
                //         $status_mod = "<font color='green'>{$r['status_mod']}</font>";
                //     }

                //     $data['rows_order_html'][] = "
                //         <tr>
                //             <td align=center>{$r['id_orders']}</td>
                //             <td>{$r['nama']}</td>
                //             <td>{$tanggal}</td>
                //             <td>{$r['jam']}</td>
                //             <td>{$status_mod}</td>
                //             <td>Rp. {$grandtotal_rp}</td>
                //             <td>
                //                 <a href=?module=order&act=detailorder&id={$r['id_orders']} class='btn btn-success btn-sm' title='Detail'><i class='fa fa-folder'></i></a>
                //             </td>
                //         </tr>
                //     ";
                //     // $no++;
                // }
                // $data['rows_order_html'] = implode('', $data['rows_order_html']);

                $htmls = "
                    <div class='col-xs-12'>
                        <div class='box'>
                            <div class='box-header'>
                                <h3 class='box-title'>Orders</h3>
                            </div>
                            <!-- /.box-header -->
            
                            <div class='box-body'>
                                <ul class='nav nav-tabs'>
                                    <li class='active'><a data-toggle='tab' href='#tab1'>Belum Bayar</a></li>
                                    <li><a data-toggle='tab' href='#tab2'>Sudah Bayar</a></li>
                                    <li><a data-toggle='tab' href='#tab3'>Sedang Dikirim</a></li>
                                    <li><a data-toggle='tab' href='#tab4'>Selesai</a></li>
                                    <li><a data-toggle='tab' href='#tab5'>Dibatalkan</a></li>
                                </ul>

                                <div class='tab-content'>
                                    <div id='tab1' class='tab-pane fade in active'>
                                        <div class='panel panel-default' style='margin-top:20px'>
                                            <div class='panel-body'>
                                                Informasi pesanan belum dibayar.
                                            </div>
                                        </div>
                                        <table class='table table-bordered table-striped datatable-class'> 
                                            <thead>
                                                <tr>
                                                    <th>No.order</th>
                                                    <th>Nama Member</th>
                                                    <th>Tgl. order</th>
                                                    <th>Jam</th>
                                                    <th>Status</th>
                                                    <th>Grand Total</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>{$data['belumBayar']}</tbody>
                                        </table>
                                    </div>
                                    <div id='tab2' class='tab-pane fade'>
                                        <div class='panel panel-default' style='margin-top:20px'>
                                            <div class='panel-body'>
                                                # Informasi pesanan sudah dibayar, harap melakukan pengemasan dan pengiriman paket kepada jasa pengiriman yang sudah dipilih pembeli untuk mendapatkan <b>NO RESI</b>.<br>
                                                # setelah mendapatkan <b>No RESI</b> harap melakukan <b>INPUT RESI</b> dengan cara memilih menu Input Resi pada kolom aksi.
                                            </div>
                                        </div>
                                        <p>Some content in menu 1.</p>
                                    </div>
                                    <div id='tab3' class='tab-pane fade'>
                                        <div class='panel panel-default' style='margin-top:20px'>
                                            <div class='panel-body'>
                                                Untuk melacak pesanan silahkan lakukan seperti langkah berikut ini:<br>
                                                1. copy nomor resi pada kolom No Resi dibawah ini.<br>
                                                2. klik jasa pengiriman sesuai dengan kolom Kurir.<br>
                                                <a href='https://www.posindonesia.co.id/id/tracking' class='badge btn btn-sm' target='_blank'>Lacak POS</a>
                                                <a href='https://www.tiki.id/id/tracking' class='badge btn btn-sm' target='_blank'>Lacak TIKI</a>
                                                <a href='https://cekresi.com/' class='badge btn btn-sm' target='_blank'>Lacak JNE</a><br>
                                                3. jika pesanan sudah sampai mohon untuk konfirmasi dengan cara memilih menu Konfirmasi pada kolom aksi di bawah ini.
                                            </div>
                                        </div>
                                        <p>Some content in menu 2.</p>
                                    </div>
                                    <div id='tab4' class='tab-pane fade'>
                                        <div class='panel panel-default' style='margin-top:20px'>
                                            <div class='panel-body'>
                                                Informasi transaksi <b>SUKSES</b>.
                                            </div>
                                        </div>
                                        <p>Some content in menu 2.</p>
                                    </div>
                                    <div id='tab5' class='tab-pane fade'>
                                        <div class='panel panel-default' style='margin-top:20px'>
                                            <div class='panel-body'>
                                                Transaksi dibatalkan karena tidak melakukan pembayaran dalam waktu 1 jam.
                                            </div>
                                        </div>
                                        <p>Some content in menu 2.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
                echo $htmls;
                // echo "
                //     <div class='col-xs-12'>
                //         <div class='box'>
                //             <div class='box-header'>
                //                 <h3 class='box-title'>Orders</h3>
                //             </div>
                //             <!-- /.box-header -->
			
                //             <div class='box-body'>
                //                 <table id='example1' class='table table-bordered table-striped'> 
                //                     <thead>
                //                         <tr>
                //                             <th>No.order</th>
                //                             <th>Nama Member</th>
                //                             <th>Tgl. order</th>
                //                             <th>Jam</th>
                //                             <th>Status</th>
                //                             <th>Grand Total</th>
                //                             <th>Aksi</th>
                //                         </tr>
                //                     </thead>
                //                     <tbody>{$data['rows_order_html']}</tbody>
                //                 </table>
                //             </div>
                //             <!-- /.box-body -->
                //         </div>
                //         <!-- /.box -->
                //     </div>
                // ";
                break;

            case "detailorder":
                $data       = [];
                $edit       = mysql_query("SELECT * FROM orders WHERE id_orders='{$_GET['id']}' ");
                $r          = mysql_fetch_assoc($edit);
                $tanggal    = tgl_indo($r['tanggal']);
                
                $trMod= "";
                if ( $r['status']== 'PAID' ) {
                  include_once("../libs/XenditPHPClient.php");
              
                //   $options['secret_api_key'] = 'xnd_development_2l1SxCJvrhJAHbXdL1Rixrxia7Qd0ls6lUyZMnkm5FWgVD7aqYREGfbsrmFTgru1';
                  $options['secret_api_key'] = 'xnd_production_sPdNCsqzXjCK9RIbjimBZyoMBHtB8hu95USuMkCEsIV6Djc5DUJpDWF3DPmCo';
                
                  $xenditPHPClient = new XenditClient\XenditPHPClient($options);
                
                  $invoice_id = $r['external_id'];
                
                  $response = $xenditPHPClient->getInvoice($invoice_id);
                //   echo '<pre>';
                //   print_r($response);
                //   echo '</pre>';
                  $newDate = date("d F Y & H:i:s", strtotime($response['paid_at']));
                  $trMod .= "
                    <b>Metode Pembayaran : </b> {$response['payment_method']}<br>
                    <b>Kode Bank : </b> {$response['bank_code']}<br>
                    <b>Tanggal Pembayaran : </b> {$newDate}<br>
                  ";
                }

                $customer       =mysql_query("select * from member where id_member='$r[id_member]'");
                $c              =mysql_fetch_assoc($customer);
                $pilihan_status = array('Unpaid', 'Paid');

                $pilihan_order  = '';
                foreach ($pilihan_status as $status) {
                    $pilihan_order .= "<option value='{$status}'";
                    if ( $status == $r['status'] ) {
                        $pilihan_order .= " selected";
                    }
                    $pilihan_order .= ">$status</option>\r\n";
                }
                
                // tampilkan rincian produk yang di order
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
                    <div class='box'>
                        <div class='box-header'>
                            <h3 class='box-title'>DETAIL ORDERS</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class='box-body'>
                            <!-- info row -->
                            <div class='row invoice-info'>
                                <div class='col-sm-4 invoice-col'>
                                    Kepada :
                                    <address>
                                        {$r['alamat_pengiriman']}
                                    </address>
                                </div>
                                <!-- /.col -->

                                <form method=POST action=$aksi?module=order&act=update>
                                    <input type=hidden name=id value=$r[id_orders]>
                                    <div class='col-sm-4 invoice-col'>
                                        <b>Invoice</b><br><br>
                                        <b>Order ID : </b> {$r['id_orders']}<br>
                                        <b>Tgl. orders : </b> {$tanggal}<br>
                                        <b>Kurir : </b> {$r['kurir']}<br>
                                        {$trMod}
                                        <!--<b>Status : </b>  <select name='status'>{$pilihan_order}</select> 
                                        <input type=submit value='Ubah Status'>-->
                                    </div>
                                    <!-- /.col -->
                                </form>
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

                            <!-- this row will not appear when printing -->
                            <div class='row no-print'>
                                <div class='col-xs-12'>
                                    <a href=modul/mod_order/cetak.php?id={$r['id_orders']} target='_blank' class='btn btn-primary pull-right'><i class='fa fa-print'></i> Print</a><br>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                ";
                break;  
        }
    }
?>

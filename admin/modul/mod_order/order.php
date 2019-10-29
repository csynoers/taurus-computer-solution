<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_order/aksi_order.php";
switch($_GET[act]){
  // Tampil Order
  default:
  $kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
      mysql_query("UPDATE produk,orders_detail,orders SET produk.stok=produk.stok+orders_detail.jumlah 
												WHERE produk.id_produk=orders_detail.id_produk 
												AND orders.id_orders=orders_detail.id_orders
												AND orders.tanggal < '$kemarin' 
												AND orders.status='Unpaid'
												");
	mysql_query("DELETE FROM orders 
	        WHERE status='Unpaid'
			AND tanggal < '$kemarin'");
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Orders</h3>
            </div>
			
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'> 
	<thead>
          <tr><th>No.order</th><th>Nama Member</th><th>Tgl. order</th><th>Jam</th><th>Status</th><th>Grand Total</th><th>Aksi</th></tr>
		  <tbody>";

   $tampil = mysql_query("SELECT * FROM orders,member WHERE orders.id_member=member.id_member ORDER BY orders.tanggal DESC ");					
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tanggal]);
	  $status=$r[status];
	  $grandtotal_rp  = format_rupiah($r[grandtotal]);
      echo "<tr><td align=center>$r[id_orders]</td>
                <td>$r[nama]</td>
                <td>$tanggal</td>
                <td>$r[jam]</td>
                <td>";
				if ($status=='Unpaid') {
		  echo"<font color='red'>$r[status]</font>";
		  } else {
		  echo"<font color='green'>$r[status]</font>";
		  }
				echo"</td>
				 <td>Rp. $grandtotal_rp</td>
		            <td><a href=?module=order&act=detailorder&id=$r[id_orders] class='btn btn-success btn-sm' title='Detail'><i class='fa fa-folder'></i></a></td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";

    
    break;
  
    
  case "detailorder":
    
$edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tanggal]);
	$customer=mysql_query("select * from member where id_member='$r[id_member]'");
  $c=mysql_fetch_array($customer);
    $pilihan_status = array('Unpaid', 'Paid');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }		
echo"

        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DETAIL ORDERS</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
      <!-- info row -->
      <div class='row invoice-info'>
        
        <div class='col-sm-4 invoice-col'>
          Kepada
          <address>
            <strong>$c[nama]</strong><br>
            $r[alamat_pengiriman]<br>
            Phone: $c[no_telp]<br>
            Email: $c[email]
          </address>
        </div>
        <!-- /.col -->
		<form method=POST action=$aksi?module=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>
        <div class='col-sm-4 invoice-col'>
          <b>Invoice</b><br>
          <br>
          <b>Order ID:</b> $r[id_orders]<br>
          <b>Tgl. orders:</b> $tanggal<br>
		  <b>Kurir:</b> $r[kurir]<br>
		  <b>Status:</b>  <select name=status>$pilihan_order</select> 
          <input type=submit value='Ubah Status'>
        </div>
		</form>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class='row'>
        <div class='col-xs-12 table-responsive'>
          <table class='table table-striped'>
            <thead>
            <tr>
              <th>Produk</th>
              <th>Berat(Kg)</th>
              <th>Jumlah</th>
              <th>Harga</th>
			  <th>Subtotal</th>
            </tr>
            </thead>";
			// tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail,produk WHERE orders_detail.id_produk=produk.id_produk AND id_orders='$_GET[id]'");
		 while($s=mysql_fetch_array($sql2)){
  $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
    $harga1 = $s[harga];
   $subtotal    = $harga1 * $s[jumlah];
   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($harga1);
		echo"
            <tbody>
            <tr>
              <td>$s[nama_produk]</td>
              <td>$s[berat]</td>
              <td>$s[jumlah]</td>
              <td>Rp. $harga</td>
			  <td>Rp. $subtotal_rp</td>
            </tr>
			</tbody>";
			}
  
  $ongkoskirim=$r[ongkir];
  $kode=$r[kode];
  $grandtotal    = $total + $ongkoskirim; 
  $grandtotal1    = $grandtotal + $kode;
  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);
  $grandtotal1_rp  = format_rupiah($grandtotal1);  
			echo"
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class='row'>
        <!-- accepted payments column -->
        <div class='col-xs-6'>
          
        </div>
        <!-- /.col -->
        <div class='col-xs-6'>
          

          <div class='table-responsive'>
            <table class='table'>
              <tr>
                <th style='width:60%'>Total:</th>
                <td>Rp. $total_rp</td>
              </tr>
              <tr>
                <th>Ongkos Kirim:</th>
                <td>Rp. $ongkoskirim_rp</td>
              </tr>
              
			  <tr>
                <th>Total:</th>
                <td>Rp. $grandtotal_rp</td>
              </tr>
			  <tr>
                <th>Kode Unik:</th>
                <td>$kode</td>
              </tr>
			  <tr>
                <th>Grand Total:</th>
                <td>Rp. $grandtotal1_rp</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class='row no-print'>
        <div class='col-xs-12'>
		  <a href=modul/mod_order/cetak.php?id=$r[id_orders] target='_blank' class='btn btn-primary pull-right'><i class='fa fa-print'></i> Print</a><br>
        </div>
      </div>
	  
	  
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;  
}
}
?>

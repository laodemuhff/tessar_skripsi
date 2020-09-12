<html>
        <head>
            <title>Nota Pemesanan</title>
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/bootstrap.css">
        </head>
        <body onLoad="window.print()">
            <div id="container">
            <!--menu -->
            <div class="container">
<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_rupiah.php";
echo "<center><legend>Nota Pemesanan<br>
Kathering Ngudi Rejeki</legend></center>";
    $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_order]);
	$tgl_kirim=tgl_indo($r[tgl_kirim]);
  echo "<table class='table table-hover'>
        <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>
		  <tr><td>Tanggal Kirim    </td><td> : $tgl_kirim</td></tr>
		  <tr><td>Status Kirim   </td><td> : $r[status]</td></tr>
		  </table>";
      
      // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");						
                         echo "<table id='example1' class='table table-bordered table-striped'>
     <tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
 while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total	
    $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk
	$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli 		
    $subtotal    = $s[harga] * $s[jumlah];
    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);
    echo "<tr><td>$s[nama_produk]</td><td>$s[jumlah]</td><td>Rp. $harga</td><td>Rp. $subtotal_rp</td></tr>";
  }
  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,orders WHERE orders.id_kota=kota.id_kota AND id_orders='$_GET[id]'"));
  if ($ongkos[status]=='Diambil') {
  $ongkoskirim1=0;
  }
  elseif ($ongkos[status]=='Dikirim'){
  $ongkoskirim1=$ongkos[ongkos_kirim];
  }
  $ongkoskirim = $ongkoskirim1 * $totalberat;
  $grandtotal    = $total + $ongkoskirim1; 
  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $grandtotal_rp  = format_rupiah($grandtotal); 
  $ongkoskirim1_rp   = format_rupiah($ongkoskirim1);    
echo "<tr><td colspan=3 align=right>Total : </td><td>Rp. <b>$total_rp</b></td></tr>
      <tr><td colspan=3 align=right>Ongkos Kirim Tujuan Kota :</td><td>Rp. <b>$ongkoskirim1_rp</b></td></tr>
           
      <tr><td colspan=3 align=right>Grand Total : </td><td>Rp. <b>$grandtotal_rp</b></td></tr>
      </table>";
	  // tampilkan data kustomer
  echo "<table class='table table-hover'>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama Pembeli</td><td> : $r[nama_kustomer]</td></tr>
        <tr><td>Alamat Pengiriman</td><td> : $r[alamat]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";	
?>
 </div>
            </body>
    </html>
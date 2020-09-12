<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
$mulai=$_POST[dari];
$selesai=$_POST[sampai];
$tanggal = date("Y-m-d");
$tanggal3=tgl_indo($tanggal);
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Laporan Penjualan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css" media="print">
body{
	font-size: 12px;
}
@page
{
	size: landscape;
	margin: 2cm;
	font-size: 10px;
}
</style>
</head>

<body onload="print()">

<!-- Part 1: Wrap all page content here -->
<div id="wrap">

<header class="container jumbotron subhead" id="overview">
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
      <center>
       <h3>PT. Dwi Heksa Eka  </h3>
        Jalan Sorowajan Baru No.111 Bogor
    
    </center>
      </div>
    </div>
  </div>
</header>
<!-- Begin page content -->
<div class="container bg">
  <div class="row-fluid">
    <div class="span12">
      <div>
<center><h5>Laporan Penjualan Dari Tanggal <?php echo"$mulai Sampai Tanggal $selesai";?></h5></center>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
		<th>Ukuran</th>
		<th>Qty</th>
		<th>Harga</th>
		<th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$no=1;
    // tampilkan rincian produk yang di order
   $tampil = mysql_query("SELECT * FROM detail_penjualan
					LEFT JOIN penjualan
                    ON detail_penjualan.kode_penjualan=penjualan.kode_penjualan
					LEFT JOIN gas
					ON detail_penjualan.id_gas=gas.id_gas			
					WHERE (penjualan.tgl_penjualan BETWEEN '$mulai' AND '$selesai')");
	 while($r=mysql_fetch_array($tampil)){
    $quantityharga=format_rupiah($r[jumlah]*$r[harga]);
    $hargarp=format_rupiah($r[harga]);
    $jml=$r[jumlah];
	$harga=$r[harga];
	$subtotal=$jml*$harga;
	$subtotal_rp = format_rupiah($subtotal);
    $total       = $total + $subtotal;
	$total_rp    = format_rupiah($total);
     echo "<tr>
	          <td>$no</td>
			  <td >$r[ukuran]</td>
			  <td >$r[jumlah]</td>
			  <td >Rp. $hargarp</td>
			  <td >Rp. $subtotal_rp</td>
		  </tr>";
		  $no++;
    }
echo "<tr><td colspan=4 align=right><b>Grand Total</b> : </td><td align=right>Rp. $total_rp</td></tr>
     ";
    ?>
    </tbody>
  </table>
  <div style="clear:both"></div>
  <table width="100%">
  <tbody>
	<tr>
		<td colspan="8" style="height:20px"></td>
	</tr>
	<tr>
		<td width="70%"></td>
		<td align="center">
		Yogyakarta, <?php echo" $tanggal3";?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">
		Mengetahui
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">
		
		</td>
	</tr>
	<tr>
		<td colspan=2 style="height:65px"></td>
	</tr>
	<tr>
		<td></td>
		<th>
		(<?php echo"$_SESSION[namalengkap]";?> )
		</th>
	</tr>
	</tbody>
  </table>
      </div>
    </div>
  </div>
  <div id="push"></div>
</div>
</body>
</html>

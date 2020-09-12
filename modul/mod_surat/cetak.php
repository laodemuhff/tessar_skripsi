<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
$tanggal = date("Y-m-d");
$tanggal3=tgl_indo($tanggal);
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cetak Surat Jalan</title>
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
        <h3>PT. DWI HEKSA EKA BOGOR </h3>
        
    
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
<center><h5>Surat Jalan</h5></center>
<?php
$edit=mysql_query("SELECT * FROM surat_jalan JOIN supir ON surat_jalan.id_supir=supir.id_supir
													 JOIN user ON surat_jalan.id_user=user.id_user 
													 WHERE surat_jalan.id_surat='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$tanggal=tgl_indo($r[tanggal]);
	$biayarp    = format_rupiah($r[biaya]);
echo"<div class='table-responsive'>
		  <table class='table'>
          <tr><td>ID Surat</td>  <td> : $r[id_surat]</td></tr>
		  <tr><td>Tanggal</td>   <td> : $tanggal</td></tr>
		  <tr><td>Biaya</td>   <td> : $biayarp </td></tr>
          <tr><td>Nama Supir</td>   <td> : $r[id_supir]: $r[nama]</td></tr>
          
		  </table>
		  <div>";	
?>
  <table width="100%" border="1">
    <thead>
      <tr>
        <th>No</th>
		<th>Agen</th>
		<th>Ukuran</th>
		<th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$no=1;
    // tampilkan rincian gas yang di order
   $tampil = mysql_query("SELECT * FROM detail_surat,gas,agen WHERE detail_surat.id_gas=gas.id_gas
																AND detail_surat.id_agen=agen.id_agen
																AND detail_surat.id_surat='$_GET[id]'");
	 while($r=mysql_fetch_array($tampil)){
     echo "<tr>
	          <td>$no</td>
			  <td>$r[nama_agen]</a></td>
			  <td>$r[ukuran]</a></td>	         
			  <td>$r[jumlah]</td>
		  </tr>";
		  $no++;
    }
    ?>
    </tbody>
  </table>
  <br>
  <table width="100%" border="1">
    <thead>
      <tr>
        <th>No</th>
		<th>Agen</th>
		<th>Alamat</th>
		<th>Tanda Tangan</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$no=1;
    // tampilkan rincian gas yang di order
   $tampil = mysql_query("SELECT * FROM detail_surat,gas,agen WHERE detail_surat.id_gas=gas.id_gas
																AND detail_surat.id_agen=agen.id_agen
																AND detail_surat.id_surat='$_GET[id]'
																GROUP BY agen.id_agen");
	 while($r=mysql_fetch_array($tampil)){
     echo "<tr>
	          <td>$no</td>
			  <td>$r[nama_agen]</a></td>
			  <td>$r[alamat]</a></td>	         
			  <td><br></td>
		  </tr>";
		  $no++;
    }
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
		Bogor, <?php echo" $tanggal3";?>
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

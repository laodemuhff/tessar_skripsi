<?php
session_start();
include "../../config/koneksi.php";
include "../../config/library.php";
$module=$_GET[module];
$act=$_GET[act];
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");
if ($module=='penjualan' AND $act=='input'){
	$edit=mysql_query("SELECT * FROM penjualan WHERE kode_penjualan='$_POST[kode_penjualan]'");
    $r=mysql_fetch_array($edit);
	$kode=$_POST[kode_penjualan];
	$datagas=mysql_query("SELECT * FROM gas WHERE id_gas='$_POST[gas]'");
    $g=mysql_fetch_array($datagas);
	$harga=$g[harga];
	$jumlah=$_POST[jumlah];
	mysql_query("INSERT INTO detail_penjualan(kode_penjualan,
								id_gas,
								harga_jual,
								jumlah) 
	                       VALUES('$_POST[kode_penjualan]',
								'$_POST[gas]',
								'$harga',
								'$_POST[jumlah]')");
$id_gas=$_POST[gas];
$id_agen=$_POST[id_agen];							
$cek=mysql_query("SELECT * FROM gas WHERE id_gas='$id_gas'");
$p    = mysql_fetch_array($cek);
$stok=$p[stok];
$harga1=$p[harga];
$tot1=$stok*$harga1;
$tot2=$jumlah*$harga_beli;
$stok2=$jumlah+$stok;
$hasil=($tot1+$tot2)/$stok2;
															
	mysql_query("UPDATE gas SET stok   = stok-'$_POST[jumlah]'
                       WHERE  id_gas = '$_POST[gas]'");

  header('location:../../media.php?module=penjualan&act=transaksipenjualan&kode='.$kode);							
							
}
elseif ($module=='penjualan' AND $act=='tambah'){
$kode=$_POST[kode_penjualan];
	mysql_query("INSERT INTO penjualan(kode_penjualan,					 
									id_agen,
									tgl_penjualan,
									id_user) 
	                       VALUES('$_POST[kode_penjualan]',
                                '$_POST[id_agen]',
								'$_POST[tgl_penjualan]',
								'$_SESSION[userid]')");
	
								
	header('location:../../media.php?module=penjualan&act=transaksipenjualan&kode='.$kode);							
}
// Hapus gas
elseif ($module=='penjualan' AND $act=='delete'){
$edit=mysql_query("SELECT * FROM detail_penjualan WHERE id='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[kode_penjualan];
	$jumlah=$r[jumlah];
	$id_gas=$r[id_gas];
  mysql_query("DELETE FROM detail_penjualan WHERE id='$_GET[kode]'");
  mysql_query("UPDATE gas SET stok   = stok+'$jumlah'                                   
                           WHERE  id_gas     = '$id_gas'");
  header('location:../../media.php?module=penjualan&act=transaksipenjualan&kode='.$kodes);
}
elseif ($module=='penjualan' AND $act=='delete2'){
$edit=mysql_query("SELECT * FROM detail_penjualan WHERE id='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[kode_penjualan];
	$jumlah=$r[jumlah];
	$id_gas=$r[id_gas];
  mysql_query("DELETE FROM detail_penjualan WHERE id='$_GET[kode]'");
  mysql_query("UPDATE gas SET stok   = stok+'$jumlah'                                   
                           WHERE  id_gas     = '$id_gas'");
	mysql_query("INSERT INTO log_penjualan(tanggal,
								jam,
								id_user,
								kode_penjualan) 
	                       VALUES('$tgl_sekarang',
								'$jam_sekarang',
								'$_SESSION[userid]',
								'$kodes')");					   
  header('location:../../media.php?module=penjualan&act=edittransaksipenjualan&kode='.$kodes);
}
elseif ($module=='penjualan' AND $act=='ubah'){
	$edit=mysql_query("SELECT * FROM penjualan WHERE kode_penjualan='$_POST[kode_penjualan]'");
    $r=mysql_fetch_array($edit);
	$kode=$_POST[kode_penjualan];
	$datagas=mysql_query("SELECT * FROM gas WHERE id_gas='$_POST[gas]'");
    $g=mysql_fetch_array($datagas);
	$harga=$g[harga];
	$jumlah=$_POST[jumlah];
	mysql_query("INSERT INTO detail_penjualan(kode_penjualan,
								id_gas,
								harga_jual,
								jumlah) 
	                       VALUES('$_POST[kode_penjualan]',
								'$_POST[gas]',
								'$harga',
								'$_POST[jumlah]')");
$id_gas=$_POST[gas];
$id_agen=$_POST[id_agen];							
$cek=mysql_query("SELECT * FROM gas WHERE id_gas='$id_gas'");
$p    = mysql_fetch_array($cek);
$stok=$p[stok];
$harga1=$p[harga];
$tot1=$stok*$harga1;
$tot2=$jumlah*$harga_beli;
$stok2=$jumlah+$stok;
$hasil=($tot1+$tot2)/$stok2;
															
	mysql_query("UPDATE gas SET stok   = stok-'$_POST[jumlah]'
                       WHERE  id_gas = '$_POST[gas]'");
	mysql_query("INSERT INTO log_penjualan(tanggal,
								jam,
								id_user,
								kode_penjualan) 
	                       VALUES('$tgl_sekarang',
								'$jam_sekarang',
								'$_SESSION[userid]',
								'$_POST[kode_penjualan]')");
  header('location:../../media.php?module=penjualan&act=edittransaksipenjualan&kode='.$kode);							
							
}
?>

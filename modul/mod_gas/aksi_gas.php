<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Input user
if ($module=='gas' AND $act=='input'){

    mysql_query("INSERT INTO gas(ukuran,
									stok,
									harga) 
							VALUES ('$_POST[ukuran]',
									'$_POST[stok]',
									'$_POST[harga]')");
  
  header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='gas' AND $act=='update'){
 
	mysql_query("UPDATE gas SET	stok		= '$_POST[stok]',
								ukuran		= '$_POST[ukuran]',
								harga		= '$_POST[harga]'
								WHERE id_gas		= '$_POST[id]'");
 
  header('location:../../media.php?module='.$module);
}
// Hapus produk
elseif ($module=='gas' AND $act=='hapus'){
  mysql_query("DELETE FROM gas WHERE id_gas='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>

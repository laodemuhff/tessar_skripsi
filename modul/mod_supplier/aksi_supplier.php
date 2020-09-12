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
// Hapus supplier
if ($module=='supplier' AND $act=='hapus'){
  mysql_query("DELETE FROM supplier WHERE kode_supplier='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input supplier
elseif ($module=='supplier' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO supplier(kode_supplier,
                                 nama_supplier,
                                 no_telp,
								 alamat) 
	                       VALUES('$_POST[kode_supplier]',
                                '$_POST[nama_supplier]',
                                '$_POST[no_telp]',
								'$_POST[alamat]')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=supplier')</script>";
}

// Update supplier
elseif ($module=='supplier' AND $act=='update'){
 
    mysql_query("UPDATE supplier SET nama_supplier   = '$_POST[nama_supplier]',
                                  alamat         = '$_POST[alamat]',  
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  kode_supplier     = '$_POST[id]'");
  
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=supplier')</script>";
}
}
?>

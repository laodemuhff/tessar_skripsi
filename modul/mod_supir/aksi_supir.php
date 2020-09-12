<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus supir
if ($module=='supir' AND $act=='hapus'){
  mysql_query("DELETE FROM supir WHERE id_supir='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input supir
elseif ($module=='supir' AND $act=='input'){
  mysql_query("INSERT INTO supir(id_supir,
								  nama,
								  alamat,
								  no_telp,
								  tgl_lahir) 
							VALUES('$_POST[id_supir]',
							       '$_POST[nama]',
								   '$_POST[alamat]',
								   '$_POST[no_telp]',
								   '$_POST[tgl_lahir]')");
  header('location:../../media.php?module='.$module);
}

// Update supir
elseif ($module=='supir' AND $act=='update'){
  mysql_query("UPDATE supir SET nama = '$_POST[nama]',
								 alamat = '$_POST[alamat]',
								 no_telp = '$_POST[no_telp]',
								 tgl_lahir = '$_POST[tgl_lahir]'
								WHERE id_supir = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>

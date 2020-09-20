<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus agen
if ($module=='agen' AND $act=='hapus'){
  mysql_query("DELETE FROM agen WHERE id_agen='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input agen
elseif ($module=='agen' AND $act=='input'){
  mysql_query("INSERT INTO agen(nama_agen,alamat,no_telp,kuota) VALUES('$_POST[nama_agen]','$_POST[alamat]','$_POST[no_telp]','$_POST[kuota]')");
  header('location:../../media.php?module='.$module);
}

// Update agen
elseif ($module=='agen' AND $act=='update'){
  mysql_query("UPDATE agen SET nama_agen = '$_POST[nama_agen]',
							     alamat = '$_POST[alamat]',
								 no_telp = '$_POST[no_telp]',
								 kuota = '$_POST[kuota]'
							WHERE id_agen = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>

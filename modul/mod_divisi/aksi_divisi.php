<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus divisi
if ($module=='divisi' AND $act=='hapus'){
  mysql_query("DELETE FROM divisi WHERE id_divisi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input divisi
elseif ($module=='divisi' AND $act=='input'){
  mysql_query("INSERT INTO divisi(nama_divisi) VALUES('$_POST[nama_divisi]')");
  header('location:../../media.php?module='.$module);
}

// Update divisi
elseif ($module=='divisi' AND $act=='update'){
  mysql_query("UPDATE divisi SET nama_divisi = '$_POST[nama_divisi]' WHERE id_divisi = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>

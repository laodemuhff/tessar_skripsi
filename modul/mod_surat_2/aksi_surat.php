<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus surat
if ($module=='surat' AND $act=='hapus'){
  mysql_query("DELETE FROM surat_tugas WHERE id_surat='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input surat
elseif ($module=='surat' AND $act=='input'){
  mysql_query("INSERT INTO surat_jalan(id_surat,
									  id_supir,
									  id_agen,
									  tanggal,
									  biaya,
									  id_user) 
							VALUES('$_POST[id_surat]',
							       '$_POST[supir]',
								   '$_POST[agen]',
								   '$_POST[tanggal]',
								   '$_POST[biaya]',
								   '$_SESSION[userid]')");
  header('location:../../media.php?module='.$module);
}

// Update surat
elseif ($module=='surat' AND $act=='update'){
  mysql_query("UPDATE surat_jalan SET id_agen = '$_POST[agen]',
								 id_supir = '$_POST[supir]',
								 tanggal = '$_POST[tanggal]',
								 biaya = '$_POST[biaya]'
								WHERE id_surat = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>

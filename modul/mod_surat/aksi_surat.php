<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$module=$_GET[module];
$act=$_GET[act];

// Hapus surat
if ($module=='surat' AND $act=='hapus'){
  mysql_query("DELETE FROM surat_jalan WHERE id_surat='$_GET[id]'");
  mysql_query("DELETE FROM detail_surat WHERE id_surat='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input surat
elseif ($module=='surat' AND $act=='input'){
$kode=$_POST[id_surat];
  mysql_query("INSERT INTO surat_jalan(id_surat,
									  id_supir,
									  tanggal,
									  biaya,
									  id_user) 
							VALUES('$_POST[id_surat]',
							       '$_POST[supir]',
								   '$_POST[tanggal]',
								   '$_POST[biaya]',
								   '$_SESSION[userid]')");
header('location:../../media.php?module=surat&act=datasurat&kode='.$kode);
}
elseif ($module=='surat' AND $act=='inputdata'){
$kode=$_POST[id_surat];
  mysql_query("INSERT INTO detail_surat(id_surat,
									  id_gas,
									  id_agen,
									  jumlah) 
							VALUES('$_POST[id_surat]',
							       '$_POST[gas]',
								   '$_POST[agen]',
								   '$_POST[jumlah]')");
header('location:../../media.php?module=surat&act=datasurat&kode='.$kode);
}
// Update surat
elseif ($module=='surat' AND $act=='update'){
  mysql_query("UPDATE surat_jalan SET id_supir = '$_POST[supir]',
								 tanggal = '$_POST[tanggal]',
								 biaya = '$_POST[biaya]'
								WHERE id_surat = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
// Hapus detail
elseif ($module=='surat' AND $act=='delete'){
$edit=mysql_query("SELECT * FROM detail_surat WHERE id_detail='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[id_surat];
  mysql_query("DELETE FROM detail_surat WHERE id_detail='$_GET[kode]'");
  header('location:../../media.php?module=surat&act=datasurat&kode='.$kodes);
}
// Upload surat
elseif ($module=='surat' AND $act=='upload'){
$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  UploadFile($nama_file);
  mysql_query("UPDATE surat_jalan SET file    = '$nama_file'
								WHERE id_surat = '$_POST[id]'");
  echo "<script>window.alert('Upload Surat Berhasil');
        window.location=('../../media.php?module=surat')</script>";
}
?>

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
	$total_biaya = 0;
	if(isset($_POST['rincian_biaya'])){
		foreach($_POST['rincian_biaya'] as $item){
			$result = mysql_query("INSERT INTO rincian_biaya_surat_jalan(
										id_surat,
									 	keterangan,
									  	biaya)
							VALUES('$_POST[id_surat]',
								   '$item[keterangan]',
								   '$item[biaya]')") or die(mysql_error());

			$total_biaya += $item['biaya'];
		}
	}

	$kode=$_POST[id_surat];
  	mysql_query("INSERT INTO surat_jalan(id_surat,
									  id_supir,
									  tanggal,
									  biaya,
									  id_user) 
							VALUES('$_POST[id_surat]',
							       '$_POST[supir]',
								   '$_POST[tanggal]',
								   '$total_biaya',
								   '$_SESSION[userid]')");
header('location:../../media.php?module=surat&act=datasurat&kode='.$kode);
}
elseif ($module=='surat' AND $act=='inputdata'){
$kode=$_POST[id_surat];
$agen_surat = $_POST[agen_surat];

foreach($agen_surat as $key => $value){
  mysql_query("INSERT INTO detail_surat(id_surat,
									  id_gas,
									  id_agen,
									  jumlah) 
							VALUES('$_POST[id_surat]',
							       '$_POST[gas]',
								   '$value',
								   '$_POST[jumlah]')");
}
header('location:../../media.php?module=surat&id_surat='.$_POST[id_surat].'&redirect_cetak=1');
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
 	mysql_query("UPDATE surat_jalan SET file = '$nama_file' WHERE id_surat = '$_POST[id]'");
 	mysql_query("UPDATE surat_jalan SET status = 'confirmed' WHERE id_surat = '$_POST[id]'");

  	echo "<script>window.alert('Upload Surat Berhasil');
        window.location=('../../media.php?module=surat')</script>";
}

elseif ($module == 'surat' AND $act == 'update_detail_surat'){

	if(isset($_POST['rincian_biaya_tambahan']) && isset($_FILES['rincian_biaya_tambahan'])){
		
		//upload foto

		$vfile_upload_data = array();
		foreach($_FILES['rincian_biaya_tambahan']['name'] as $key => $item){
			$nama_file = $item['nota'];

			//direktori file
			$vdir_upload = "../../files/";
			$vfile_upload = $vdir_upload . $nama_file;
			$vfile_upload_data[] = $nama_file; 

			//Simpan gambar dalam ukuran sebenarnya
			move_uploaded_file($_FILES['rincian_biaya_tambahan']["tmp_name"][$key]['nota'], $vfile_upload);
		}

		// truncate scondary type
		$total_biaya_secondary = 0;
		$query = mysql_query("SELECT SUM(biaya) as total_biaya_secondary FROM rincian_biaya_surat_jalan WHERE id_surat = '$_POST[id_surat]' AND `type` = 'secondary' ") or die(mysql_error());
		$total_biaya_secondary = mysql_fetch_assoc($query);
		$total_biaya_secondary = isset($total_biaya_secondary['total_biaya_secondary']) ? $total_biaya_secondary['total_biaya_secondary'] : 0;

		mysql_query("DELETE FROM rincian_biaya_surat_jalan WHERE id_surat = '$_POST[id_surat]' AND `type` = 'secondary' ") or die(mysql_error());

		$total_biaya = $_POST['current_total_biaya'] - $total_biaya_secondary;
	
		foreach($_POST['rincian_biaya_tambahan'] as $key => $item){
			$result = mysql_query("INSERT INTO rincian_biaya_surat_jalan(
										id_surat,
									 	keterangan,
										`type`,
										foto_nota,
									  	biaya)
							VALUES('$_POST[id_surat]',
								   '$item[keterangan]',
								   'secondary',
								   'files/$vfile_upload_data[$key]',
								   '$item[biaya]')") or die(mysql_error());

			$total_biaya += $item['biaya'];
		}

		mysql_query("UPDATE surat_jalan SET biaya = '$total_biaya' WHERE id_surat = '$_POST[id_surat]' ");

		header('location:../../media.php?module=surat&act=detailsurat&id='.$_POST['id_surat']);

	}
}
?>

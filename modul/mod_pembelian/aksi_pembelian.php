<?php
session_start();
include "../../config/koneksi.php";
include "../../config/library.php";
$module=$_GET[module];
$act=$_GET[act];
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");
if ($module=='pembelian' AND $act=='input'){
	$edit=mysql_query("SELECT * FROM pembelian WHERE kode_pembelian='$_POST[kode_pembelian]'");
    $r=mysql_fetch_array($edit);
	$kode=$_POST[kode_pembelian];
	$harga_beli=$_POST[harga_beli];
	$jumlah=$_POST[jumlah];
	mysql_query("INSERT INTO detail_pembelian(kode_pembelian,
								id_gas,
								harga_beli,
								jumlah) 
	                       VALUES('$_POST[kode_pembelian]',
								'$_POST[gas]',
								'$_POST[harga_beli]',
								'$_POST[jumlah]')");
$id_gas=$_POST[gas];
$kode_supplier=$_POST[kode_supplier];							
$cek=mysql_query("SELECT * FROM gas WHERE id_gas='$id_gas'");
$p    = mysql_fetch_array($cek);
$stok=$p[stok];
$harga1=$p[harga];
$tot1=$stok*$harga1;
$tot2=$jumlah*$harga_beli;
$stok2=$jumlah+$stok;
$hasil=($tot1+$tot2)/$stok2;
															
	mysql_query("UPDATE gas SET stok   = stok+'$_POST[jumlah]'
                       WHERE  id_gas = '$_POST[gas]'");

  header('location:../../media.php?module=pembelian&act=transaksipembelian&kode='.$kode);							
							
}
elseif ($module=='pembelian' AND $act=='tambah'){
$kode=$_POST[kode_pembelian];
	mysql_query("INSERT INTO pembelian(kode_pembelian,					 
									kode_supplier,
									tgl_pembelian,
									id_user) 
	                       VALUES('$_POST[kode_pembelian]',
                                '$_POST[kode_supplier]',
								'$_POST[tgl_pembelian]',
								'$_SESSION[userid]')");
	
								
	header('location:../../media.php?module=pembelian&act=transaksipembelian&kode='.$kode);							
}
// Hapus gas
elseif ($module=='pembelian' AND $act=='delete'){
$edit=mysql_query("SELECT * FROM detail_pembelian WHERE id_detail='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[kode_pembelian];
	$jumlah=$r[jumlah];
	$id_gas=$r[id_gas];
  mysql_query("DELETE FROM detail_pembelian WHERE id_detail='$_GET[kode]'");
  mysql_query("UPDATE gas SET stok   = stok-'$jumlah'                                   
                           WHERE  id_gas     = '$id_gas'");
  header('location:../../media.php?module=pembelian&act=transaksipembelian&kode='.$kodes);
}
elseif ($module=='pembelian' AND $act=='ubah'){
	$edit=mysql_query("SELECT * FROM pembelian WHERE kode_pembelian='$_POST[kode_pembelian]'");
    $r=mysql_fetch_array($edit);
	$kode=$_POST[kode_pembelian];
	$harga_beli=$_POST[harga_beli];
	$jumlah=$_POST[jumlah];
	mysql_query("INSERT INTO detail_pembelian(kode_pembelian,
								id_gas,
								harga_beli,
								jumlah) 
	                       VALUES('$_POST[kode_pembelian]',
								'$_POST[gas]',
								'$_POST[harga_beli]',
								'$_POST[jumlah]')");
$id_gas=$_POST[gas];
$kode_supplier=$_POST[kode_supplier];							
$cek=mysql_query("SELECT * FROM gas WHERE id_gas='$id_gas'");
$p    = mysql_fetch_array($cek);
$stok=$p[stok];
$harga1=$p[harga];
$tot1=$stok*$harga1;
$tot2=$jumlah*$harga_beli;
$stok2=$jumlah+$stok;
$hasil=($tot1+$tot2)/$stok2;
															
	mysql_query("UPDATE gas SET stok   = stok+'$_POST[jumlah]'
                       WHERE  id_gas = '$_POST[gas]'");
					   
mysql_query("INSERT INTO log_pembelian(tanggal,
								jam,
								id_user,
								kode_pembelian) 
	                       VALUES('$tgl_sekarang',
								'$jam_sekarang',
								'$_SESSION[userid]',
								'$_POST[kode_pembelian]')");
  header('location:../../media.php?module=pembelian&act=edittransaksipembelian&kode='.$kode);							
							
}
elseif ($module=='pembelian' AND $act=='delete2'){
$edit=mysql_query("SELECT * FROM detail_pembelian WHERE id_detail='$_GET[kode]'");
    $r=mysql_fetch_array($edit);
	$kodes=$r[kode_pembelian];
	$jumlah=$r[jumlah];
	$id_gas=$r[id_gas];
  mysql_query("DELETE FROM detail_pembelian WHERE id_detail='$_GET[kode]'");
  mysql_query("UPDATE gas SET stok   = stok-'$jumlah'                                   
                           WHERE  id_gas     = '$id_gas'");
	mysql_query("INSERT INTO log_pembelian(tanggal,
								jam,
								id_user,
								kode_pembelian) 
	                       VALUES('$tgl_sekarang',
								'$jam_sekarang',
								'$_SESSION[userid]',
								'$kodes')");
  header('location:../../media.php?module=pembelian&act=edittransaksipembelian&kode='.$kodes);
}

	elseif ($module=='pembelian' AND $act=='upload_nota'){
		$nama_file   = $_FILES['nota_pembelian']['name'];

		$vdir_upload = "../../files/";
		$vfile_upload = $vdir_upload . $nama_file;

		//Simpan gambar dalam ukuran sebenarnya
		move_uploaded_file($_FILES['nota_pembelian']["tmp_name"], $vfile_upload);

		// cek if kode pembelian exist 
		$cek_nota = mysql_query("SELECT * FROM nota_pembelian WHERE kode_pembelian = '$_POST[kode_pembelian]' limit 1");

		if(empty(mysql_fetch_assoc($cek_nota))){
			mysql_query("INSERT INTO nota_pembelian(kode_pembelian, foto_nota) VALUES('$_POST[kode_pembelian]', 'files/$nama_file')");
		}else{
			mysql_query("UPDATE nota_pembelian SET foto_nota = 'files/$nama_file' WHERE kode_pembelian = '$_POST[kode_pembelian]' ");
		}
		// $size= $_FILES['nota_pembelian']['size'];
		// print_r($size);exit;
	  	header('location:../../media.php?module=pembelian&act=detailpembelian&id='.$_POST['kode_pembelian']);
	}
?>

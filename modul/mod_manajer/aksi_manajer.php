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
// Hapus manajer
if ($module=='manajer' AND $act=='hapus'){
  mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='manajer' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO user(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
								 level,
								 id_divisi) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'manajer',
								'$_POST[divisi]')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=manajer')</script>";
}

// Update user
elseif ($module=='manajer' AND $act=='update'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE user SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  email         = '$_POST[email]',
                                  username      = '$_POST[username]',
								  id_divisi     = '$_POST[divisi]',								  
                                  no_telp       = '$_POST[no_telp]'  
                           WHERE  id_user     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE user SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',  
                                 id_divisi     = '$_POST[divisi]',
								 username         = '$_POST[username]',  
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE id_user      = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=manajer')</script>";
}
}
?>

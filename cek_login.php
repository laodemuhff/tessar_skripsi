<?php
include "config/koneksi.php";

$username = $_POST['username'];
$pass     = md5($_POST['password']);

$login=mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[userid]     = $r[id_user];
  $_SESSION[namauser]     = $r[username];
  $_SESSION[username]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_user];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[divisi]    = $r[id_divisi];
  header('location:media.php?module=home');
}

else{

  echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";

}

?>

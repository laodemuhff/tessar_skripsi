<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.jasa.value == 0){
    alert("Anda belum memilih jasa pengiriman barang.");
    form.jasa.focus();
    return (false);
  }
  if (form.event.value == 1){
	alert("Minimal Pemesanan Belum Terpenuhi.");
	form.event.focus();
	return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  return (true);
}


function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}


$(document).ready(function() {
	$('#jasa').change(function() { 
		var category = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'config/kota.php',
			data: 'perusahaan=' + category, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#kota').html('<tr><td colspan=2>Loading ....</td></tr>');	
			},
			success: function(response) {
				$('#kota').html(response);
			}
		});
    });
});

</script>

<?php
// Halaman utama (Home)
if ($_GET[module]=='store'){
  // Data selamat datang mengacu pada id_modul=56
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='56'");
	$r      = mysql_fetch_array($profil);
     echo " 
            </div><div class='profil2'>$r[static_content]<br /> </div>
          </div> "; 
		  // di atas hanya tambahan
  echo "<h4 class='heading colr2'>==========</h4><br />";
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 12");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    //$disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 
    $d=$r['diskon'];
    $hargatetap="<span class='price'> Rp. <b>$hargadisc,-</b></span></div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;
	 <span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             <a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
  }
}


// Modul detail produk
elseif ($_GET[module]=='detailproduk'){

	$detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);


    $harga = format_rupiah($d[harga]);
    $disc     = ($d[diskon]/100)*$d[harga];
    $hargadisc     = number_format(($d[harga]-$disc),0,",",".");


	echo "<h4 class='heading colr'>Kategori: <a href='kategori-$d[id_kategori]-$d[kategori_seo].html'>$d[nama_kategori]</a></h4></div>";

	echo"<div class='feat_prod_box_details'>";
 	if ($d[gambar]!=''){
		echo "<div class='prod_img3'><a href='foto_produk/$d[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'<img src='foto_produk/$d[gambar]' width=180  class='tooltip' title='klik untuk memperbesar gambar' border='0' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'/></a>

                </div>";}
	            echo"<div class='details_big_box'>
            <div class='product_title_big'>$d[nama_produk]</div>
            <div class='details'>$d[deskripsi]</div><br />
                    <div class='table6'>&bull; HARGA: <span class='table7'>Rp. $hargadisc,-</span></div>
			        
                    <div class='table6'>&bull; STOK:<span class='table7'> $d[stok] item</span></div><br />
                    <a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='more'><img src='images/beli.gif' alt='' title='' border='0' /></a>
                    <div class='clear'></div>
                    </div>
                    
                    <div class='box_bottom'></div>
                </div> <div class='clear'></div>
            </div><br /> ";

          
// Produk Lainnya (random)          
  $sql=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 4");
      
  echo "<h4 class='heading colr'>Produk Lainnya</h4></div>";
      
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'><span class='price'> <br /></span>&nbsp;<span class='price'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
	 <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>DETAIL</a>            
          </div> 
          </div>";
  }
}

// Modul produk per kategori
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);

  echo "<h4 class='heading colr'>Kategori: $n[nama_kategori]</h4></div>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging3;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
 	$sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $posisi,$batas");		 
	$jumlah = mysql_num_rows($sql);

	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'><span class='price'> <br /></span>&nbsp;<span class='price'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
	 <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>DETAIL</a>            
          </div> 
          </div>";
  }
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);
  echo "<div class=halaman>Halaman : $linkHalaman </div><br>";
  }
  else{
    echo "<p align=left><span class='table7'>Belum ada produk pada kategori ini.</p>";
  }
}
// Menu utama di header
// Modul profil
if ($_GET['module']=='profilkami'){
  // Data profil mengacu pada id_modul=43
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
	$r      = mysql_fetch_array($profil);
  echo "<h4 class='heading colr'>Profil Kami</h4>
    	  <div class='prod_box_bigx'>
            </div>
          <div class='profil'>
              <div>$r[static_content]</div>
			  <div class='bottom_prod_box_big4'></div>
          </div>    
          </div>
          </div>";                             
}
// Modul cara pembelian
if ($_GET['module']=='carabeli'){
  // Data cara pembelian mengacu pada id_modul=45
	$cara = mysql_query("SELECT * FROM modul WHERE id_modul='45'");
	$r      = mysql_fetch_array($cara);
  echo "<h4 class='heading colr'>Cara Pembelian</h4>
             <div class='carabeli'>
              <div>$r[static_content]</div>
          </div>    
          </div>
			  <div class='bottom_prod_box_big7'></div>
          </div>";                             
}
// Modul semua produk
elseif ($_GET[module]=='semuaproduk'){
  echo "<h4 class='heading colr'>Semua Produk</h4>";
  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging2;
  $batas  = 16;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 
    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'><span class='price'> <br /></span>&nbsp;<span class='price'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
	 <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html' class='prod_details'>DETAIL</a>            
          </div> 
          </div>";
  }  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);
  echo "<div class='halaman'>Halaman : $linkHalaman </div>";
}
// Modul keranjang belanja
elseif ($_GET[module]=='keranjangbelanja'){
  // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanjanya masih kosong. Silahkan Anda berbelanja terlebih dahulu');
        window.location=('index.php')</script>";
    }
  else{  
    echo "<h4 class='heading colr'>Keranjang Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=23> <th>
		 <span class='table'>No</th> <th>
		 <span class='table'>Produk</th><th>
		 <span class='table'>Nama Produk</th><th>
		 <span class='table'>Qty</th><th>
		 <span class='table'>Harga</th><th>
		 <span class='table'>Sub Total</th>
		 <th><span class='table'>Hapus</th></tr>";  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
       echo "<tr background='images/bg_tab2.jpg'  align=center><td><span class='table2'>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><a href='produk-$r[id_produk]-$r[produk_seo].html'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'><img width=80 class='imgcart' src=foto_produk/$r[gambar]  class='tooltip' title='klik untuk memperbesar gambar'></td>
              <td><span class='table2'>$r[nama_produk]</td>
              <td><input type=text name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\"></td>
              <td><span class='table2'>$hargadisc</td>
              <td><span class='table2'>$subtotal_rp</td>
              <td align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'><img src=images/kali.png border=0 title=Hapus></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr><td colspan=6 align=right><br><span class='table3'>Total:</td><td colspan=2><br><span class='table3'>Rp. $total_rp,-</b></td></tr>
        <tr></td>
        <td colspan=2><br /><input style='width: 130px; height: 22px;' type=submit  class= simplebtn value='UPDATE KERANJANG'><br /></td>
        </tr>
        </tbody>
  </table>";
echo "<br /><br /><br /><br /><p>*   Apabila Anda mengubah jumlah (Qty), jangan lupa tekan tombol <b>Update Keranjang</b><br />
               **  Total harga di atas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b><br />
			   ***  Minimal Pemesanan untuk setiap produk adalah 50 pcs</b></p><br />
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
           <div class='bottom_prod_box_big3'></div>
          </div>";             
}
}
// Modul Konfirmasi Pembayaran
elseif ($_GET['module']=='konfirmasipembayaran'){
 echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'>Konfirmasi Pembayaran</h4>"; 
  echo "<b> <div class='table5'>Konfirmasi pembayaran Anda, dengan cara mengisi form di bawah ini:</b>
        <table width=100% style='border: 0pt dashed #0000CC;padding: 10px;'>
        <form action=konfirmasi-aksi.html method=POST enctype='multipart/form-data'>
		<tr><td><span class='table2'>$id_konfir</td><input type=hidden name=id[$id_konfir] value=$r[id_konfir]>
        <tr><td><span class='table4'>Nomer Id Order Anda:</td><td>  <input type=text class='isikoment3' name=no_order size=40></td></tr><tr></tr><tr></tr>
        <tr><td><span class='table4'>Nama Pemilik Rekening</td><td>  <input type=text class='isikoment3' name=nama size=55></td></tr><tr></tr><tr></tr>
		<tr><td><span class='table4'>Gambar Bukti Transfer </td><td> <input type=file name='fupload' size=40>Tipe gambar harus JPG/JPEG & ukuran lebar maks:400px</td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td><span class=isikomen>(masukkan 6 kode di atas)<br /><input type=text class='isikoment3' name=kode size=10 maxlength=6><br /></td></tr>
        </td><td colspan=2><p style='padding-top:20px ;'><input style=' width: 200px; height: 30px;' type=submit  class=simplebtn value='KIRIM KONFIRMASI BAYAR'></td></tr>
        </form></table><br />";
  echo "</div>
    <div class='bottom_prod_box_big6'></div>
    </div>";            
}
// Modul bayar aksi
elseif ($_GET['module']=='konfirmasiaksi'){
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
  echo "<div id='content'>          
          <div id='content-detail'>";
$no_order=trim($_POST[no_order]);
$nama=trim($_POST[nama]);
$fupload=trim($_POST[fupload]);
if (empty($no_order)){
  echo "<span class='table8'>Anda belum mengisikan Nomer Id Order<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($nama)){
  echo "<span class='table8'>Anda belum mengisikan Nama Pemilik Rekening<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($lokasi_file)){
  echo "<span class='table8'>Anda belum memilih Gambar Bukti Transfer <br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){
  UploadBayar($nama_file);
  mysql_query("INSERT INTO konfir(id_orders,
                                   nama_pemilik,
                                   gambar) 
                        VALUES('$_POST[no_order]',
							   '$_POST[nama]',
                               '$nama_file')");
  echo "<h4 class='heading colr'>Konfirmasi Pembayaran</h4></span><br />"; 
  echo "<span class='table8'><p align=center><div class='table5'><b>Terima kasih sudah melakukan konfirmasi pembayaran. <br /> Kami akan segera memprosesnya.</b></p>";
		}else{
			echo "<span class='table8'>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "<span class='table8'>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}
  echo "</div>
<div class='bottom_prod_box_big9'>
    </div>";            
}
// Modul hasil pencarian produk 
elseif ($_GET['module']=='hasilcari'){
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;
  $cari = "SELECT * FROM produk WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_produk DESC LIMIT 6";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);
  echo "<h4 class='heading colr'>Hasil Pencarian</h4>";
  if ($ketemu > 0){
  echo "<div class='table3'>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></font> <b>:</b> </div>";
    while($t=mysql_fetch_array($hasil)){
      // Tampilkan hanya sebagian isi produk
      $isi_produk = htmlentities(strip_tags($t['deskripsi'])); // mengabaikan tag html
      $isi = substr($isi_produk,0,250); // ambil sebanyak 250 karakter
      $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
            <div class='product_title_big'><a href=produk-$t[id_produk]-$t[produk_seo].html>$t[nama_produk]</a></div>
            $isi ... <a href=produk-$t[id_produk]-$t[produk_seo].html><span class='table6'>selengkapnya</a>
	      </div>
          </div> 
          </div>
          </div>    
          <span class='bottom_prod_box_big_yacari'></div>"; 
      }        
    }                                                          
  else{
    echo "<p><div class='table3'>Tidak ditemukan produk dengan kata <font style='background-color:#D5F1FF'><b>$kata</b></p>
	 <div class='bottom_prod_box_big_nocari'></div>";
  }
}
// Modul selesai belanja
if ($_GET['module']=='selesaibelanja'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{
  echo "<h4 class='heading colr'>Data Pembeli</h4>
      <form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
      <table width=650>
      <tr><td><span class='table4'>Nama</td><td>  <input type=text name=nama size=30 class='table5'></td></tr>
      <tr><td><span class='table4'>Alamat Lengkap Kirim</td><td>  <input type=text name=alamat size=70 class='table5'></td></tr>
	   <tr><td valign=top><span class='table4'>Status Pengiriman</td><td>  
          <select name='status'  class='table5'>
          <option>Diambil</option>
		  <option>Dikirim</option>
		  </select>
		  </td></tr>
	  <tr><td valign=top><span class='table4'>Kabupaten</td><td>  
          <select name='jasa' id='jasa' class='table5'>
          <option value='0' selected>- Kabupaten -</option>";
          $tampil=mysql_query("SELECT * FROM kabupaten ORDER BY nama_kabupaten");
          while($r=mysql_fetch_array($tampil)){
             echo "<option value='$r[id_kabupaten]'>$r[nama_kabupaten]</option>";
          }
      echo "</select> </td></tr>
      <tr><td><span class='table4'>Kecamatan</td><td> <span id='kota'><select name='kota' id='kota' class='table5'><option value='0' selected>Tentukan Kecamatan Dahulu</option></select></span></td></tr>
      <tr><td><span class='table4'>Telpon/HP</td><td>  <input type=text name=telpon class='table5'></td></tr>
	  <tr><td><span class='table4'>Tanggal Kirim</td><td>  <input type=text name=tgl_kirim class='table5'></td></tr>
      <tr><td><span class='table4'>Email</td><td>  <input type=text name=email class='table5'></td></tr>
      </table>";
     echo "<h4 class='heading colr'>Konfirmasi Keranjang Belanja Anda</h4>
          <table width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
          <tr background='images/bg_tab.jpg' align=center height=23>
		  <th><span class='table'>No</th>
		  <th><span class='table'>Nama Produk</th>
		  <th><span class='table'>Qty</th>
          <th><span class='table'>Harga</th>
		  <th><span class='table'>Sub Total</th></tr>";  
  $no=1;
  while($r=mysql_fetch_array($sql)){
  //START nampilkan diskon per produk --    
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",","."); 
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
//END nampilkan diskon per produk --
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r['harga']);
    $subtotalberat = $r['berat'] * $r['jumlah']; // total berat per item produk 
    $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli    
    echo "<tr background='images/bg_tab2.jpg' align=center height=23><td><span class='table2'>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td><span class='table2'>$r[nama_produk]</td>
              <td align=center><span class='table2'>$r[jumlah]</td>
              <td><span class='table2'>$harga</td>
              <td><span class='table2'>$subtotal_rp</td>
          </tr>";
    $no++; 
  }
  echo "
            <td align=right colspan=2><span class='table3'>Total Harga:</td><td align=center><span class='table3'>Rp. $total_rp,-</td></tr>
        </tbody></table></div></div></div>
        <div class='bottom_prod_box_big'></div>
        </div>";
    echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
          <div class='center_prod_box_big'>            
          <div class='details_big_cari'><div><table width=520><tr><td><input style='width: 70px; height: 22px;'  class= simplebtn type=button value='KEMBALI' onclick=self.history.back()>
          <span style='float : right;'><input style='width: 110px; height: 22px;' type=submit  class= simplebtn value='PROSES ORDER'></span></td></tr></table>
          </div></div></div>
        <div class='bottom_prod_box_bigx'></div>
        </div>";        
  }
}      
// Modul simpan transaksi
elseif ($_GET[module]=='simpantransaksi'){
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");
if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[kota])){
  echo "Data yang Anda isikan belum lengkap<br />
  	    <a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
else{
// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");
// simpan data pemesanan 
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order,tgl_kirim, id_kota,status) 
             VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[tgl_kirim]','$_POST[kota]','$_POST[status]')");
// mendapatkan nomor orders
$id_orders=mysql_insert_id();
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);
// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}
  echo "<h4 class='heading colr'>Proses Transaksi Selesai</h4>";
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table>
      <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
	  <tr><td>Tanggal Kirim  </td><td> : $_POST[tgl_kirim] </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr>
	  <tr><td>Status Pengiriman         </td><td> : $_POST[status] </td></tr></table><br />
      Nomor Order: <b> <span class='table6'>$id_orders</b><br /><br />";
      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");
echo "<table width=600 border=0 cellpadding=0 cellspacing=1 align=center>
        <tr background='images/bg_tab3.jpg' align=center height=23><th><span class='table'>No</th><th><span class='table'>Nama Produk</th><th><span class='table'>Qty</th><th><span class='table'>Harga</th><th><span class='table'>Sub Total</th></tr>";
$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
        Nama: $_POST[nama] <br />
        Alamat: $_POST[alamat] <br/>
        Telpon: $_POST[telpon] <br /><hr />
		Tanggal Kirim: $_POST[tgl_kirim] <br/><hr/>
		Status Pengiriman: $_POST[status] <br/><hr/>
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
    $disc        = ($d[diskon]/100)*$d[harga];
    $hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
    $subtotal    = ($d[harga]-$disc) * $d[jumlah];
   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d['harga']);
   echo "<tr background='images/bg_tab2.jpg' align=center height=23>
   <td>$no</td>
   <td>$d[nama_produk]</td>
   <td align=center>$d[jumlah]</td>
   <td>Rp. $harga,-</td>
   <td>Rp. $subtotal_rp,-</td>
   </tr>";
   $pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}
$ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,orders WHERE orders.id_kota=kota.id_kota AND orders.id_orders='$id_orders' AND kota.id_kota='$_POST[kota]'"));
  if ($ongkos[status]=='Diambil') {
  $ongkoskirim=0;
  }
  elseif ($ongkos[status]=='Dikirim'){
  $ongkoskirim=$ongkos[ongkos_kirim];
  }

//$ongkoskirim = $ongkoskirim1 * $totalberat;
$grandtotal    = $total + $ongkoskirim; 
$ongkoskirim_rp = format_rupiah($ongkoskirim);
//$ongkoskirim1_rp = format_rupiah($ongkoskirim); 
$grandtotal_rp  = format_rupiah($grandtotal);  
$pesan.="<br /><br />Total : Rp. $total_rp,-
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp 
         <br />Grand Total : Rp. $grandtotal_rp,-
         <br /><br />Silahkan lakukan pembayaran ke Bank Mandiri sebanyak Grand Total yang tercantum, nomor rekeningnya <b>0312849389</b> a.n. Niken Sulanjari";
//$subjek="Pemesanan Online Art Furniture";
// Kirim email dalam format HTML
//$dari = "From: redaksi@artfurniture.com \n";
//$dari .= "Content-type: text/html \r\n";
// Kirim email kekustomer
mail($_POST[email],$subjek,$pesan,$dari);
// Kirim email ke pengelola toko online
mail("rizal@artfurniture.com",$subjek,$pesan,$dari);
echo "<tr><td colspan=4 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=4 align=right>Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=4 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";
echo "<br /><br /><br /><br /><p>- Data order Anda telah masuk Didatabase kami. <br />
               - Apabila Anda tidak melakukan pembayaran, maka data order Anda akan terhapus (transaksi batal)</p><br />
<a href=print_nota.php?id=$id_orders target='_blank'><span class='table6'>Cetak</a>			   
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big10'></div>
          </div>";    		  
}
}
?>
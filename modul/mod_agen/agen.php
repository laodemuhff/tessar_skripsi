<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_agen/aksi_agen.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Agen</h1>
										<div class='clearfix'></div>
								</div>
						</div>
				</div>
				<!-- end row -->
				<div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>";
							if ($_SESSION['leveluser']=='admin'){
							echo"
								<div class='card-header'>
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=agen&act=tambahagen';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>";
								}
								echo"
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Agen</th>
												<th>Alamat</th>
												<th>No. Telp</th>
												<th>Kuota Bulan ini</th>
												<th>Terjual Bulan Ini</th>
												<th>Persentase Terjual</th>";
												if ($_SESSION['leveluser']=='admin'){
													echo "<th>Aksi</th>";
												}
											echo "</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM agen ORDER BY id_agen");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_agen]</td>
												<td>$r[alamat]</td>
												<td>$r[no_telp]</td>
												<td>$r[kuota]</td>";

												$this_month = intval(date('m'));
												$this_year = date('Y');
											
												$sql_terjual = "SELECT sum(detail_penjualan.jumlah) as jumlah FROM penjualan
																	JOIN detail_penjualan ON penjualan.kode_penjualan = detail_penjualan.kode_penjualan
																	JOIN agen ON agen.id_agen = penjualan.id_agen
																	WHERE agen.id_agen = $r[id_agen]	
																	AND MONTH(penjualan.tgl_penjualan) = $this_month
																	AND YEAR(penjualan.tgl_penjualan) = $this_year
																	";	
											
												$terjual_bulan_ini = 0;
												$persentase_terjual = 0;
											
												$query_terjual = mysql_query($sql_terjual) or die(mysql_error());
											
												while($row = mysql_fetch_array($query_terjual)){
													$terjual_bulan_ini = $row['jumlah'] == null ?  0 : $row['jumlah'] ;
													$persentase_terjual = ($terjual_bulan_ini / $r['kuota']) * 100;
												}
													
												echo "
												<td>$terjual_bulan_ini</td>
												<td>$persentase_terjual %</td>	
												<td>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='?module=agen&act=editagen&id=$r[id_agen]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=agen&act=hapus&id=$r[id_agen]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
												}
												echo"
												</td>
											</tr>";
										$no++;
										}
										echo"
										</tbody>
									</table>
									</div>
									
								</div>														
							</div><!-- end card-->					
						</div>
						
								
								
				</div>

            </div>";
 
    break;
  
  case "tambahagen":
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Agen</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=agen&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Agen</label>
									<input type='text' name='nama_agen' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama agen' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp agen' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kuota Per Bulan</label>
									<input type='number' name='kuota' min='0' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Kuota' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editagen":
    $edit=mysql_query("SELECT * FROM agen WHERE id_agen='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit agen</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=agen&act=update'>
								<input type=hidden name=id value='$r[id_agen]'>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama Agen</label>
									<input type='text' name='nama_agen' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' value='$r[nama_agen]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' value='$r[alamat]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp Agen' value='$r[no_telp]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kuota Per Bulan</label>
									<input type='number' name='kuota' min='0' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Kuota' value='$r[kuota]' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Update</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       
    break; 
case "grafik":
    $edit=mysql_query("SELECT * FROM agen WHERE id_agen='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$kuota=$r[kuota];
	$data=mysql_query("SELECT SUM(detail_penjualan.jumlah) AS stok, DATE_FORMAT(penjualan.tgl_penjualan,'%Y/%m') AS tahun_bulan , gas.ukuran, gas.id_gas,penjualan.kode_penjualan,penjualan.tgl_penjualan 
																											FROM detail_penjualan 
																											JOIN penjualan ON penjualan.kode_penjualan=detail_penjualan.kode_penjualan
																											JOIN gas ON gas.id_gas=detail_penjualan.id_gas
																											WHERE gas.id_gas='$_GET[gas]'
																											AND penjualan.id_agen='$_GET[id]'
																											AND month(penjualan.tgl_penjualan)='$_GET[bulan]' 
																											AND year(penjualan.tgl_penjualan) = '$_GET[tahun]'");
    $d=mysql_fetch_array($data);
	$persen=($d[stok]/$kuota)*100;
	$namabulan=$_GET['bulan'];
if ($namabulan == "01") $namabulan = "Januari";
else if ($namabulan == "02") $namabulan = "Februari";
else if ($namabulan == "03") $namabulan = "Maret";
else if ($namabulan == "04") $namabulan = "April";
else if ($namabulan == "05") $namabulan = "Mei";
else if ($namabulan == "06") $namabulan = "Juni";
else if ($namabulan == "07") $namabulan = "Juli";
else if ($namabulan == "08") $namabulan = "Agustus";
else if ($namabulan == "09") $namabulan = "September";
else if ($namabulan == "10") $namabulan = "Oktober";
else if ($namabulan == "11") $namabulan = "November";
else if ($namabulan == "12") $namabulan = "Desember";
$gas=mysql_query("SELECT * FROM gas WHERE id_gas='$_GET[gas]'");
$g=mysql_fetch_array($gas);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Data Agen</h3><br>
								<p>Nama Agen: $r[nama_agen]</p>
								<p>Alamat: $r[alamat]</p>
								<p>No. Telp: $r[no_telp]</p>
								<p>Kuota Per Bulan: $r[kuota]</p>
							</div>
								
							<div class='card-body'>
								
								
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							
								
							<div class='card-body'>
							<form action='' method='GET'>
							<input type='hidden' name='module' value='agen'>
							<input type='hidden' name='act' value='grafik'>
							<input type='hidden' name='id' value='$_GET[id]'>
								  <div class='form-group'>	
									<table>
										<tr>
										<td><td><label for='exampleInputPassword1'>Pilih Bulan</label>
										<select class='form-control select2' name='bulan' required>
											<option value='01'>Januari</option>
											<option value='02'>Februari</option>
											<option value='03'>Maret</option>
											<option value='04'>April</option>
											<option value='05'>Mei</option>
											<option value='06'>Juni</option>
											<option value='07'>Juli</option>
											<option value='08'>Agustus</option>
											<option value='09'>September</option>
											<option value='10'>Oktober</option>
											<option value='12'>November</option>
											<option value='12'>Desember</option>
										</select>
										<select class='form-control select2' name='tahun' required>";
											$qry=mysql_query("SELECT tgl_penjualan FROM penjualan GROUP BY year(tgl_penjualan)");
												while($t=mysql_fetch_array($qry)){
													$data = explode('-',$t['tgl_penjualan']);
													$tahun = $data[0];
													echo "<option value='$tahun'>$tahun</option>";

												}
											echo"
										</select>
										</td>
										</tr>
									</table>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Pilih Ukuran Gas</label>
										<select class='form-control select2' name='gas' required>
											<option value='' selected>- Pilih Gas -</option>";
											$tampil=mysql_query("SELECT * FROM gas ORDER BY id_gas ASC");
											while($r=mysql_fetch_array($tampil)){
											if ($_GET[gas]==$r[id_gas]){
											echo "<option value=$r[id_gas] selected>$r[ukuran]</option>";
											} else {
											echo "<option value=$r[id_gas]>$r[ukuran]</option>";
											}
											}
									echo "</select>
								  </div>
								  <button type='submit' class='btn btn-primary'>Lihat Grafik</button>
								</form>	
								
																
							</div>														
						</div><!-- end card-->					
                    </div>";
					if ($_GET[id] != '' AND $_GET[bulan] != '' AND $_GET[tahun] != '' AND $_GET[gas] != ''){
					echo"
					<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Grafik Penjualan Gas Ukuran $g[ukuran] Bulan $namabulan $_GET[tahun]</h3><br>
								<div class='alert alert-primary' role='alert'>
								  Penjualan sudah mencapai $d[stok] tabung ($persen%)
								</div>
							</div>
								
							<div class='card-body'>
							<div id='container3'></div>	
								
																
							</div>														
						</div><!-- end card-->					
                    </div>";
					}
					echo"
		</div>";
	
       
    break;	
}
}
?>

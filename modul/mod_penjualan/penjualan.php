<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_penjualan/aksi_penjualan.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Penjualan</h1>
										<div class='clearfix'></div>
								</div>
						</div>
				</div>
				<!-- end row -->
				<div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
								<div class='card-header'>
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=penjualan&act=tambahpenjualan';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Kode penjualan</th>
												<th>Kode Agen</th>
												<th>Alamat Agen</th>
												<th>Tgl. penjualan</th>
												<th>Petugas</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$no=1;
										$tampil = mysql_query("SELECT * FROM penjualan,agen,user WHERE penjualan.id_agen=agen.id_agen 
																								 AND penjualan.id_user=user.id_user
																								 ORDER BY kode_penjualan ASC ");					
										while($r=mysql_fetch_array($tampil)){
										$tanggal=tgl_indo($r[tgl_penjualan]);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[kode_penjualan]</td>
												<td>$r[id_agen]: $r[nama_agen]</td>
												<td>$r[alamat]</td>
												<td>$tanggal</td>
												<td>$r[nama_lengkap]</td>
												<td><a href=?module=penjualan&act=media.php?module=penjualan&act=edittransaksipenjualan&kode=$r[kode_penjualan] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'> Ubah</i></a>
													<a href=?module=penjualan&act=detailpenjualan&id=$r[kode_penjualan] class='btn btn-info btn-xs' title='Detail'><i class='fa fa-folder'> Detail</i></a>
													<a href=modul/mod_penjualan/cetak.php?kode=$r[kode_penjualan] target='_blank' class='btn btn-warning btn-xs' title='Cetak'><i class='fa fa-print'> Cetak</i></a>
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
  
  case "tambahpenjualan":
  $sql=mysql_query("select * from penjualan order by kode_penjualan DESC LIMIT 0,1");
	$data=mysql_fetch_array($sql);
	$kodeawal=substr($data['kode_penjualan'],3,3)+1;
	if($kodeawal<10){
		$kode='PNJ00'.$kodeawal;
	}elseif($kodeawal > 9 && $kodeawal <=99){
		$kode='PNJ0'.$kodeawal;
	}else{
		$kode='PNJ'.$kodeawal;
	}
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah penjualan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=penjualan&act=tambah'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode penjualan</label>
									<input type='text' name='kode_penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$kode' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Pilih agen</label>
										<select class='form-control select2' name='id_agen' required>
											<option value=''>- Pilih agen -</option>";
												$tampil=mysql_query("SELECT * FROM agen ORDER BY nama_agen");
												while($r=mysql_fetch_array($tampil)){
										echo"<option value=$r[id_agen]>$r[id_agen]: $r[nama_agen]</option>";
											}
									echo"</select>
								 </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. penjualan</label>
									<input type='date' name='tgl_penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp penjualan' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
		</div>";
		
	break;

  case "transaksipenjualan":
    $agen=mysql_query("SELECT * FROM agen,penjualan WHERE agen.id_agen=penjualan.id_agen AND penjualan.kode_penjualan='$_GET[kode]'");
    $p=mysql_fetch_array($agen);
	$tanggal=tgl_indo($r[tgl_penjualan]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> FORM PENJUALAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=penjualan&act=input'>
								<input type=hidden name='id_agen' value='$r[id_agen]'>
								<input type=hidden name='kode_penjualan' value='$_GET[kode]'>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Cari Gas</label>
										<select class='form-control select2' name='gas' required>
											<option value='' selected>- Pilih Gas -</option>";
											$tampil=mysql_query("SELECT * FROM gas ORDER BY id_gas ASC");
											while($r=mysql_fetch_array($tampil)){
											echo "<option value=$r[id_gas]>$r[ukuran]</option>";
											}
									echo "</select>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Jumlah</label>
									<input type='number' min='0' name='jumlah' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Jumlah' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DATA AGEN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode agen</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[alamat]' readonly>
								  </div>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       echo"
	   <div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Ukuran</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Sub total</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM detail_penjualan,gas WHERE detail_penjualan.id_gas=gas.id_gas
																			AND detail_penjualan.kode_penjualan='$_GET[kode]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga_jual];
										$subtotal=$jml*$harga;
										$total       = $total + $subtotal;
										$total_rp    = format_rupiah($total);
										$subtotal_rp = format_rupiah($subtotal);
										$harga_rp       = format_rupiah($harga);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[ukuran]</a></td>
												<td>Rp. $harga_rp</td>		         
												<td>$r[jumlah]</td>
												<td>Rp. $subtotal_rp</td>
												<td><a href=$aksi?module=penjualan&act=delete&kode=$r[id] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
											</tr>";
										$no++;
										}
										echo"
											<tr>
												<td colspan=4 align=right>Total :  </td>
												<td align=left><b>Rp. $total_rp</b></td>
											</tr>
										</tbody>
									</table>
									</div>
									
								</div>														
							</div><!-- end card-->					
						</div>
						
								
								
				</div>";
    break;

case "detailpenjualan":
    $agen=mysql_query("SELECT * FROM agen,penjualan WHERE agen.id_agen=penjualan.id_agen AND penjualan.kode_penjualan='$_GET[id]'");
    $p=mysql_fetch_array($agen);
	$tanggal=tgl_indo($r[tgl_penjualan]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DETAIL PENJUALAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Penjualan</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[kode_penjualan]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. Penjualan</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[tgl_penjualan]' readonly>
								  </div>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DATA AGEN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode agen</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[alamat]' readonly>
								  </div>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       echo"
	   <div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Ukuran</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Sub total</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM detail_penjualan,gas WHERE detail_penjualan.id_gas=gas.id_gas
																			AND detail_penjualan.kode_penjualan='$_GET[id]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga];
										$subtotal=$jml*$harga;
										$total       = $total + $subtotal;
										$total_rp    = format_rupiah($total);
										$subtotal_rp = format_rupiah($subtotal);
										$harga_rp       = format_rupiah($harga);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[ukuran]</a></td>
												<td>Rp. $harga_rp</td>		         
												<td>$r[jumlah]</td>
												<td>Rp. $subtotal_rp</td>
											</tr>";
										$no++;
										}
										echo"
											<tr>
												<td colspan=4 align=right>Total :  </td>
												<td align=left><b>Rp. $total_rp</b></td>
											</tr>
										</tbody>
									</table>
									</div>
									<a href=modul/mod_penjualan/cetak.php?kode=$_GET[id] target='_blank' class='btn btn-warning'>Cetak</a> <button onclick=self.history.back() class='btn btn-danger'>Kembali</button>
								</div>														
							</div><!-- end card-->					
						</div>
						
				<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
									<div class='card mb-3'>
										<div class='card-header'>
											<h3><i class='fa fa-table'></i> Log Data Penjualan</h3>
											
										</div>
											
										<div class='card-body'>
											
											<table class='table table-responsive-xl'>
											  <thead>
												<tr>
												  <th scope='col'>Tanggal</th>
												  <th scope='col'>Jam</th>
												  <th scope='col'>Petugas</th>
												</tr>
											  </thead>
											  <tbody>";
											  $log = mysql_query("SELECT * FROM log_penjualan,user WHERE log_penjualan.id_user=user.id_user 
																								   AND log_penjualan.id_user=user.id_user
																								   AND log_penjualan.kode_penjualan='$_GET[id]'
																								   ORDER BY tanggal DESC, jam DESC ");					
												while($v=mysql_fetch_array($log)){
												$tanggal=tgl_indo($v[tanggal]);
												echo"
												<tr>
												  <th scope='row'>$tanggal</th>
												  <td>$v[jam]</td>
												  <td>$v[nama_lengkap]</td>
												</tr>";
												}
												echo"
											  </tbody>
											</table>
											
										</div>														
									</div><!-- end card-->					
								</div>				
								
				</div>";
    break;	
	case "edittransaksipenjualan":
    $agen=mysql_query("SELECT * FROM agen,penjualan WHERE agen.id_agen=penjualan.id_agen AND penjualan.kode_penjualan='$_GET[kode]'");
    $p=mysql_fetch_array($agen);
	$tanggal=tgl_indo($r[tgl_penjualan]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> FORM PENJUALAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=penjualan&act=ubah'>
								<input type=hidden name='id_agen' value='$r[id_agen]'>
								<input type=hidden name='kode_penjualan' value='$_GET[kode]'>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Cari Gas</label>
										<select class='form-control select2' name='gas' required>
											<option value='' selected>- Pilih Gas -</option>";
											$tampil=mysql_query("SELECT * FROM gas ORDER BY id_gas ASC");
											while($r=mysql_fetch_array($tampil)){
											echo "<option value=$r[id_gas]>$r[ukuran]</option>";
											}
									echo "</select>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Jumlah</label>
									<input type='number' name='jumlah' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Jumlah' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DATA AGEN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode agen</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_agen]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='penjualan' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[alamat]' readonly>
								  </div>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       echo"
	   <div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Ukuran</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Sub total</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM detail_penjualan,gas WHERE detail_penjualan.id_gas=gas.id_gas
																			AND detail_penjualan.kode_penjualan='$_GET[kode]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga_jual];
										$subtotal=$jml*$harga;
										$total       = $total + $subtotal;
										$total_rp    = format_rupiah($total);
										$subtotal_rp = format_rupiah($subtotal);
										$harga_rp       = format_rupiah($harga);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[ukuran]</a></td>
												<td>Rp. $harga_rp</td>		         
												<td>$r[jumlah]</td>
												<td>Rp. $subtotal_rp</td>
												<td><a href=$aksi?module=penjualan&act=delete2&kode=$r[id] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
											</tr>";
										$no++;
										}
										echo"
											<tr>
												<td colspan=4 align=right>Total :  </td>
												<td align=left><b>Rp. $total_rp</b></td>
											</tr>
										</tbody>
									</table>
									</div>
									
								</div>														
							</div><!-- end card-->					
						</div>
						
								
								
				</div>";
    break;
}
}
?>

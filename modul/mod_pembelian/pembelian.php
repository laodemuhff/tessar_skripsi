<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_pembelian/aksi_pembelian.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Pembelian</h1>
										<div class='clearfix'></div>
								</div>
						</div>
				</div>
				<!-- end row -->
				<div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
								<div class='card-header'>
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=pembelian&act=tambahpembelian';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Pembelian</th>
												<th>Kode Supplier</th>
												<th>Tgl. Pembelian</th>
												<th>Petugas</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$no=1;
										$tampil = mysql_query("SELECT * FROM pembelian,supplier,user WHERE pembelian.kode_supplier=supplier.kode_supplier 
																									 AND pembelian.id_user=user.id_user
																									 ORDER BY kode_pembelian ASC ");					
										while($r=mysql_fetch_array($tampil)){
										$tanggal=tgl_indo($r[tgl_pembelian]);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[kode_pembelian]</td>
												<td>$r[kode_supplier]: $r[nama_supplier]</td>
												<td>$tanggal</td>
												<td>$r[nama_lengkap]</td>
												<td><a href=?module=pembelian&act=media.php?module=pembelian&act=edittransaksipembelian&kode=$r[kode_pembelian] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'> Ubah</i></a>
													<a href=?module=pembelian&act=detailpembelian&id=$r[kode_pembelian] class='btn btn-info btn-xs' title='Detail'><i class='fa fa-folder'> Detail</i></a>
													<a href=modul/mod_pembelian/cetak.php?kode=$r[kode_pembelian] target='_blank' class='btn btn-warning btn-xs' title='Cetak'><i class='fa fa-print'> Cetak</i></a>
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
  
  case "tambahpembelian":
  $sql=mysql_query("select * from pembelian order by kode_pembelian DESC LIMIT 0,1");
	$data=mysql_fetch_array($sql);
	$kodeawal=substr($data['kode_pembelian'],3,3)+1;
	if($kodeawal<10){
		$kode='PBL00'.$kodeawal;
	}elseif($kodeawal > 9 && $kodeawal <=99){
		$kode='PBL0'.$kodeawal;
	}else{
		$kode='PBL'.$kodeawal;
	}
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Pembelian</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=pembelian&act=tambah'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Pembelian</label>
									<input type='text' name='kode_pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$kode' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Pilih Supplier</label>
										<select class='form-control select2' name='kode_supplier' required>
											<option value=''>- Pilih Supplier -</option>";
												$tampil=mysql_query("SELECT * FROM supplier ORDER BY nama_supplier");
												while($r=mysql_fetch_array($tampil)){
										echo"<option value=$r[kode_supplier]>$r[kode_supplier]: $r[nama_supplier]</option>";
											}
									echo"</select>
								 </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. Pembelian</label>
									<input type='date' name='tgl_pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp pembelian' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
		</div>";
		
	break;

  case "transaksipembelian":
    $supplier=mysql_query("SELECT * FROM supplier,pembelian WHERE supplier.kode_supplier=pembelian.kode_supplier AND pembelian.kode_pembelian='$_GET[kode]'");
    $p=mysql_fetch_array($supplier);
	$tanggal=tgl_indo($r[tgl_pembelian]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> FORM PEMBELIAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=pembelian&act=input'>
								<input type=hidden name='kode_supplier' value='$r[kode_supplier]'>
								<input type=hidden name='kode_pembelian' value='$_GET[kode]'>
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
									<label for='exampleInputEmail1'>Harga Beli</label>
									<input type='number' name='harga_beli' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Harga Beli' required>
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
								<h3><i class='fa fa-check-square-o'></i> DATA SUPPLIER</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Supplier</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[kode_supplier]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_supplier]' readonly>
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
										$tampil=mysql_query("SELECT * FROM detail_pembelian,gas WHERE detail_pembelian.id_gas=gas.id_gas
																			AND detail_pembelian.kode_pembelian='$_GET[kode]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga_beli];
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
												<td><a href=$aksi?module=pembelian&act=delete&kode=$r[id_detail] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
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

case "detailpembelian":
    $supplier=mysql_query("SELECT * FROM supplier,pembelian WHERE supplier.kode_supplier=pembelian.kode_supplier AND pembelian.kode_pembelian='$_GET[id]'");
    $p=mysql_fetch_array($supplier);
	$tanggal=tgl_indo($r[tgl_pembelian]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DETAIL PEMBELIAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Pembelian</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[kode_pembelian]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. Pembelian</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[tgl_pembelian]' readonly>
								  </div>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DATA SUPPLIER</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Supplier</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[kode_supplier]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_supplier]' readonly>
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
										$tampil=mysql_query("SELECT * FROM detail_pembelian,gas WHERE detail_pembelian.id_gas=gas.id_gas
																			AND detail_pembelian.kode_pembelian='$_GET[id]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga_beli];
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
									<a href=modul/mod_pembelian/cetak.php?kode=$_GET[id] target='_blank' class='btn btn-warning'>Cetak</a> <button onclick=self.history.back() class='btn btn-danger'>Kembali</button>
								</div>														
							</div><!-- end card-->					
						</div>
						
					
		<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
									<div class='card mb-3'>
										<div class='card-header'>
											<h3><i class='fa fa-table'></i> Log Data Pembelian</h3>
											
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
											  $log = mysql_query("SELECT * FROM log_pembelian,user WHERE log_pembelian.id_user=user.id_user 
																								   AND log_pembelian.id_user=user.id_user
																								   AND log_pembelian.kode_pembelian='$_GET[id]'
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
case "edittransaksipembelian":
    $supplier=mysql_query("SELECT * FROM supplier,pembelian WHERE supplier.kode_supplier=pembelian.kode_supplier AND pembelian.kode_pembelian='$_GET[kode]'");
    $p=mysql_fetch_array($supplier);
	$tanggal=tgl_indo($r[tgl_pembelian]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> FORM PEMBELIAN</h3>
								
							</div>
								
							<div class='card-body'>								
								<form method=POST action='$aksi?module=pembelian&act=ubah'>
								<input type=hidden name='kode_supplier' value='$r[kode_supplier]'>
								<input type=hidden name='kode_pembelian' value='$_GET[kode]'>
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
									<label for='exampleInputEmail1'>Harga Beli</label>
									<input type='number' name='harga_beli' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Harga Beli' required>
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
								<h3><i class='fa fa-check-square-o'></i> DATA SUPPLIER</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Kode Supplier</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[kode_supplier]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama_supplier]' readonly>
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
										$tampil=mysql_query("SELECT * FROM detail_pembelian,gas WHERE detail_pembelian.id_gas=gas.id_gas
																			AND detail_pembelian.kode_pembelian='$_GET[kode]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										$harga=$r[harga_beli];
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
												<td><a href=$aksi?module=pembelian&act=delete2&kode=$r[id_detail] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
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

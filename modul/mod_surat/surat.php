<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_surat/aksi_surat.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Surat Jalan</h1>
										<div class='clearfix'></div>
								</div>
						</div>
				</div>
				<!-- end row -->
				<div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
								<div class='card-header'>
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=surat&act=tambahsurat';\"><i class='fa fa-plus'></i>Tambah</button>
								</div							
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>ID surat</th>
												<th>Supir</th>
												<th>Tanggal</th>
												<th>Biaya</th>
												<th>Petugas</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM surat_jalan JOIN supir ON surat_jalan.id_supir=supir.id_supir
																					   JOIN user ON surat_jalan.id_user=user.id_user
																					   ORDER BY id_surat DESC");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$tanggal=tgl_indo($r[tanggal]);
										$biayarp    = format_rupiah($r[biaya]);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[id_surat]</td>
												<td>$r[id_supir]: $r[nama]</td>
												<td>$tanggal</td>
												<td>Rp. $biayarp</td>
												<td>$r[nama_lengkap]</td>
												<td>";
													if($r['status'] == 'pending')
														echo "<span class='badge badge-warning' style='padding:10px; font-size:0.9em;'>$r[status]</span>";
													else
														echo "<span class='badge badge-success' style='padding:10px; font-size:0.9em;'>$r[status]</span>";
												echo "</td>
												<td>";
												if($_SESSION['leveluser'] == 'manajer'){
													echo "<a href='?module=surat&act=detailsurat&id=$r[id_surat]' class='btn btn-success btn-sm' title='Edit' ><i class='fa fa-folder'></i> Detail</a>";
												}else{
													echo "<a href='?module=surat&act=editsurat&id=$r[id_surat]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='?module=surat&act=detailsurat&id=$r[id_surat]' class='btn btn-success btn-sm' title='Edit' ><i class='fa fa-folder'></i> Detail</a>
													<a href='?module=surat&act=uploadsurat&id=$r[id_surat]' class='btn btn-info btn-sm' title='Edit' ><i class='fa fa-Upload'></i> Upload Surat</a>
													<a href='$aksi?module=surat&act=hapus&id=$r[id_surat]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
												}
												
												echo "</td>
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
  
  case "tambahsurat":
  $sql=mysql_query("select * from surat_jalan order by id_surat DESC LIMIT 0,1");
	$data=mysql_fetch_array($sql);
	$kodeawal=substr($data['id_surat'],3,3)+1;
	if($kodeawal<10){
		$kode='SRT00'.$kodeawal;
	}elseif($kodeawal > 9 && $kodeawal <=99){
		$kode='SRT0'.$kodeawal;
	}else{
		$kode='SRT'.$kodeawal;
	}
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Surat Jalan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=surat&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Surat Jalan</label>
									<input type='text' name='id_surat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$kode' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Supir</label>
										<select class='form-control select2' name='supir' required>
											<option value=''>- Pilih Supir -</option>";
												$tampil=mysql_query("SELECT * FROM supir ORDER BY nama ASC");
												while($r=mysql_fetch_array($tampil)){
										echo"<option value=$r[id_supir]>$r[id_supir]: $r[nama]</option>";
											}
									echo"</select>
								 </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Biaya</label>
									<input type='number' name='biaya' min='o' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Biaya' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tanggal</label>
									<input type='date' name='tanggal' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editsurat":
    $edit=mysql_query("SELECT * FROM surat_jalan WHERE id_surat='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit Surat Jalan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=surat&act=update'>
								<input type=hidden name=id value='$r[id_surat]'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Surat Jalan</label>
									<input type='text' name='name_surat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[id_surat]' readonly>
								  </div>
								   <div class='form-group'>
									<label for='exampleInputEmail1'>Supir</label>
										<select class='form-control select2' name='supir' required>";
											$tampil=mysql_query("SELECT * FROM supir ORDER BY nama ASC");
												if ($r[id_supir]==0){
													echo "<option value=0 selected>- Pilih Supir -</option>";
												}   

											while($w=mysql_fetch_array($tampil)){
												if ($r[id_supir]==$w[id_supir]){
													echo "<option value=$w[id_supir] selected>$w[id_supir]: $w[nama]</option>";
												}
												else{
													echo "<option value=$w[id_supir]>$w[id_supir]: $w[nama]</option>";
												}
											}
									echo"</select>
								 </div>
								  
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Biaya</label>
									<input type='number' min='0' name='biaya' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Biaya' value='$r[biaya]' required>
								  </div>
								   <div class='form-group'>
									<label for='exampleInputEmail1'>Tanggal</label>
									<input type='date' name='tanggal' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[tanggal]' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Update</button> Atau 
								  <button type='button' class='btn btn-success' onclick=\"window.location.href='?module=surat&act=datasurat&kode=$_GET[id]';\"><i class='fa fa-edit'></i>Edit Detail Surat</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       
    break; 
case "datasurat":
    $supplier=mysql_query("SELECT * FROM surat_jalan WHERE id_surat='$_GET[kode]'");
    $p=mysql_fetch_array($supplier);
	$tanggal=tgl_indo($r[tgl_pembelian]);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> FORM SURAT JALAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=surat&act=inputdata'>
								<input type=hidden name='id_surat' value='$_GET[kode]'>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Cari Agen</label>
										<select class='form-control' name='agen_surat[]' id='agen_surat' multiple required>
											<option value='' disabled>- Pilih Agen -</option>";
											$tampil=mysql_query("SELECT * FROM Agen ORDER BY nama_agen ASC");
											while($r=mysql_fetch_array($tampil)){
												echo "<option value=$r[id_agen]>$r[nama_agen]</option>";
											}
									echo "</select>
								  </div>
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
								<h3><i class='fa fa-check-square-o'></i> DATA SURAT</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Surat</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_surat]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tanggal</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[tanggal]' readonly>
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
												<th>Agen</th>
												<th>Ukuran</th>
												<th>Jumlah</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM detail_surat,gas,agen WHERE detail_surat.id_gas=gas.id_gas
																			AND detail_surat.id_agen=agen.id_agen
																			AND detail_surat.id_surat='$_GET[kode]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_agen]</a></td>
												<td>$r[ukuran]</a></td>	         
												<td>$r[jumlah]</td>
												<td><a href=$aksi?module=surat&act=delete&kode=$r[id_detail] class='btn btn-danger' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\">Hapus</a></td>
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
						
								
								
				</div>";
    break;	
	
	case "detailsurat":
    $surat=mysql_query("SELECT * FROM surat_jalan JOIN supir ON surat_jalan.id_supir=supir.id_supir
													 JOIN user ON surat_jalan.id_user=user.id_user 
													 WHERE surat_jalan.id_surat='$_GET[id]'");
    $p=mysql_fetch_array($surat);
	$tanggal=tgl_indo($p[tanggal]);
	$biayarp    = format_rupiah($p[biaya]);
	$gambar=$p[file];
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DETAIL SURAT JALAN</h3>
								
							</div>
								
							<div class='card-body'>
								
								
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Surat</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_surat]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tanggal</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$tanggal' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Biaya</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$biayarp' readonly>
								  </div>";
								  if ($gambar!='') {
								  echo"
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Download Surat</label>
									<p class='help-block'><img src='files/$p[file]' width='400px' height='400px'></p>
									<a href='downlot.php?file=$p[file]' class='btn btn-success btn-sm' title='Download'><i class='fa fa-download'></i> Download Surat</a>
								  </div>";
								  }
								  else {
								  echo"
								  <div class='form-group'>
									<label for='exampleInputEmail1'><font color='red'>Belum Upload Surat</font></label>
									
								  </div>";
								  }
								
							echo"									
							</div>														
						</div><!-- end card-->					
                    </div>
					
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> DATA SUPIR</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Supir</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[id_supir]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[nama]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='text' name='pembelian' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$p[no_telp]' readonly>
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
												<th>Agen</th>
												<th>Ukuran</th>
												<th>Jumlah</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM detail_surat,gas,agen WHERE detail_surat.id_gas=gas.id_gas
																			AND detail_surat.id_agen=agen.id_agen
																			AND detail_surat.id_surat='$_GET[id]'");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$jml=$r[jumlah];
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_agen]</a></td>
												<td>$r[ukuran]</a></td>	         
												<td>$r[jumlah]</td>
											</tr>";
										$no++;
										}
										echo"
											
										</tbody>
									</table>
									</div>
									<a href=modul/mod_surat/cetak.php?id=$_GET[id] target='_blank' class='btn btn-success'>Cetak</a> <button onclick=self.history.back() class='btn btn-danger'>Kembali</button>
								</div>														
							</div><!-- end card-->
							
						</div>
						
								
								
				</div>";
    break;
case "uploadsurat":
    $edit=mysql_query("SELECT * FROM surat_jalan WHERE id_surat='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Upload Surat Jalan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=surat&act=upload' enctype='multipart/form-data'>
								<input type=hidden name=id value='$r[id_surat]'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Upload Surat Jalan</label>
									<input type='file' name='fupload' id='exampleInputFile' accept='.xls,.xlsx,.docs,.docx,.pdf,.txt' required>
								  </div>
								   
								  <button type='submit' class='btn btn-primary'>Simpan</button> 
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       
    break; 	
}
}
?>
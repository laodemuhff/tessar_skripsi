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
												<th>Agen</th>
												<th>Tanggal</th>
												<th>Biaya</th>
												<th>Petugas</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM surat_jalan JOIN supir ON surat_jalan.id_supir=supir.id_supir
																					   JOIN agen ON surat_jalan.id_agen=agen.id_agen
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
												<td>$r[nama_agen]</td>
												<td>$tanggal</td>
												<td>Rp. $biayarp</td>
												<td>$r[nama_lengkap]</td>
												<td>
													<a href='?module=surat&act=editsurat&id=$r[id_surat]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=surat&act=hapus&id=$r[id_surat]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
												
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
									<label for='exampleInputEmail1'>Agen</label>
										<select class='form-control select2' name='agen' required>
											<option value=''>- Pilih Agen -</option>";
												$tampil=mysql_query("SELECT * FROM agen ORDER BY nama_agen ASC");
												while($r=mysql_fetch_array($tampil)){
										echo"<option value=$r[id_agen]>$r[nama_agen]</option>";
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
									<label for='exampleInputEmail1'>Agen</label>
										<select class='form-control select2' name='agen' required>";
											$tampil=mysql_query("SELECT * FROM agen ORDER BY nama_agen ASC");
												if ($r[id_agen]==0){
													echo "<option value=0 selected>- Pilih agen -</option>";
												}   

											while($w=mysql_fetch_array($tampil)){
												if ($r[id_agen]==$w[id_agen]){
													echo "<option value=$w[id_agen] selected>$w[id_agen]: $w[nama_agen]</option>";
												}
												else{
													echo "<option value=$w[id_agen]>$w[id_agen]: $w[nama_agen]</option>";
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
								  <button type='submit' class='btn btn-primary'>Update</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	
       
    break;  
}
}
?>

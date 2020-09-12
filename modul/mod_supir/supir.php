<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_supir/aksi_supir.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Supir</h1>
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
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=supir&act=tambahsupir';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>";
								}
								echo"
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>ID Supir</th>
												<th>Nama</th>
												<th>Alamat</th>
												<th>No. Telp</th>
												<th>Tgl. Lahir</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM supir ORDER BY id_supir DESC");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$tgl_lahir=tgl_indo($r[tgl_lahir]);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[id_supir]</td>
												<td>$r[nama]</td>
												<td>$r[alamat]</td>
												<td>$r[no_telp]</td>
												<td>$tgl_lahir</td>
												<td>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='?module=supir&act=editsupir&id=$r[id_supir]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=supir&act=hapus&id=$r[id_supir]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
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
  
  case "tambahsupir":
  $sql=mysql_query("select * from supir order by id_supir DESC LIMIT 0,1");
	$data=mysql_fetch_array($sql);
	$kodeawal=substr($data['id_supir'],3,3)+1;
	if($kodeawal<10){
		$kode='DRV00'.$kodeawal;
	}elseif($kodeawal > 9 && $kodeawal <=99){
		$kode='DRV0'.$kodeawal;
	}else{
		$kode='DRV'.$kodeawal;
	}
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Supir</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=supir&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Supir</label>
									<input type='text' name='id_supir' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$kode' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Supir</label>
									<input type='text' name='nama' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama Supir' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp Supir' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. Lahir</label>
									<input type='date' name='tgl_lahir' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editsupir":
    $edit=mysql_query("SELECT * FROM supir WHERE id_supir='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit Supir</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=supir&act=update'>
								<input type=hidden name=id value='$r[id_supir]'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>ID Supir</label>
									<input type='text' name='name_supir' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[id_supir]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama Supir</label>
									<input type='text' name='nama' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' value='$r[nama]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' value='$r[alamat]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp supir' value='$r[no_telp]' required>
								  </div>
								   <div class='form-group'>
									<label for='exampleInputEmail1'>Tgl. Lahir</label>
									<input type='date' name='tgl_lahir' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[tgl_lahir]' required>
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

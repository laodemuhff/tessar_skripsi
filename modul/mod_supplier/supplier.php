<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_supplier/aksi_supplier.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Supplier</h1>
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
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=supplier&act=tambahsupplier';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>";
								}
								echo"
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Nama supplier</th>
												<th>Alamat</th>
												<th>No. Telp</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM supplier ORDER BY kode_supplier DESC");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_supplier]</td>
												<td>$r[alamat]</td>
												<td>$r[no_telp]</td>
												<td>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='?module=supplier&act=editsupplier&id=$r[kode_supplier]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=supplier&act=hapus&id=$r[kode_supplier]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
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
  
  case "tambahsupplier":
  $sql=mysql_query("select * from supplier order by kode_supplier DESC LIMIT 0,1");
	$data=mysql_fetch_array($sql);
	$kodeawal=substr($data['kode_supplier'],3,3)+1;
	if($kodeawal<10){
		$kode='SPL00'.$kodeawal;
	}elseif($kodeawal > 9 && $kodeawal <=99){
		$kode='SPL0'.$kodeawal;
	}else{
		$kode='SPL'.$kodeawal;
	}
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Supplier</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=supplier&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Supplier</label>
									<input type='text' name='kode_supplier' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Kode supplier' value='$kode' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Supplier</label>
									<input type='text' name='nama_supplier' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama supplier' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp supplier' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editsupplier":
    $edit=mysql_query("SELECT * FROM supplier WHERE kode_supplier='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit supplier</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=supplier&act=update'>
								<input type=hidden name=id value='$r[kode_supplier]'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Supplier</label>
									<input type='text' name='kode_supplier' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Kode supplier' value='$r[kode_supplier]' readonly>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama supplier</label>
									<input type='text' name='nama_supplier' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' value='$r[nama_supplier]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Alamat</label>
									<input type='text' name='alamat' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Alamat' value='$r[alamat]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nomor Telp supplier' value='$r[no_telp]' required>
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

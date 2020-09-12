<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_divisi/aksi_divisi.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Divisi</h1>
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
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=divisi&act=tambahdivisi';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>";
								}
								echo"
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Divisi</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM divisi ORDER BY id_divisi DESC");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_divisi]</td>
												<td>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='?module=divisi&act=editdivisi&id=$r[id_divisi]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=divisi&act=hapus&id=$r[id_divisi]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
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
  
  case "tambahdivisi":
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Divisi</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=divisi&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Nama Divisi</label>
									<input type='text' name='nama_divisi' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editdivisi":
    $edit=mysql_query("SELECT * FROM divisi WHERE id_divisi='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit Divisi</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=divisi&act=update'>
								<input type=hidden name=id value='$r[id_divisi]'>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama Divisi</label>
									<input type='text' name='nama_divisi' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' value='$r[nama_divisi]' required>
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

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_gas/aksi_gas.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Gas</h1>
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
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=gas&act=tambahgas';\"><i class='fa fa-plus'></i>Tambah</button>
								</div>";
								}
								echo"
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Ukuran</th>
												<th>Stok</th>
												<th>Harga</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										$tampil=mysql_query("SELECT * FROM gas ORDER BY id_gas DESC");
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										$harga=format_rupiah($r[harga]);
										echo"
											<tr>
												<td>$no</td>
												<td>$r[ukuran]</td>
												<td>$r[stok]</td>
												<td>Rp. $harga</td>
												<td>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='?module=gas&act=editgas&id=$r[id_gas]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>
													<a href='$aksi?module=gas&act=hapus&id=$r[id_gas]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
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
  
  case "tambahgas":
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah Gas</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=gas&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Ukuran</label>
									<input type='text' name='ukuran' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Ukuran Gas' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Harga</label>
									<input type='number' name='harga' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan harga Jual' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Stok</label>
									<input type='number' name='stok' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Stok Gas' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editgas":
    $edit=mysql_query("SELECT * FROM gas WHERE id_gas='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit Gas</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=gas&act=update'>
								<input type=hidden name=id value='$r[id_gas]'>
								  
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Ukuran</label>
									<input type='text' name='ukuran' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[ukuran]' placeholder='Masukkan Ukuran Gas' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Harga</label>
									<input type='number' name='harga' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[harga]' placeholder='Masukkan harga Jual' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Stok</label>
									<input type='number' name='stok' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' value='$r[stok]' placeholder='Masukkan Stok Gas' required>
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

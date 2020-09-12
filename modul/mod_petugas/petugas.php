<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_petugas/aksi_petugas.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class='container-fluid'>		
				<div class='row'>
						<div class='col-xl-12'>
								<div class='breadcrumb-holder'>
										<h1 class='main-title float-left'>Data Petugas</h1>
										<div class='clearfix'></div>
								</div>
						</div>
				</div>
				<!-- end row -->
				<div class='row'>
				
						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-12'>						
							<div class='card mb-3'>
								<div class='card-header'>";
								if ($_SESSION['leveluser']=='admin'){
								echo"
									<button type='button' class='btn btn-success' onclick=\"window.location.href='?module=petugas&act=tambahpetugas';\"><i class='fa fa-plus'></i>Tambah</button>";
									}
									echo"
								</div>
									
								<div class='card-body'>
									<div class='table-responsive'>
									<table id='example1' class='table table-bordered table-hover display'>
										<thead>
											<tr>
												<th>No</th>
												<th>Divisi</th>
												<th>Username</th>
												<th>Nama</th>
												<th>Email</th>
												<th>No. Telp</th>
												<th>Aksi</th>
											</tr>
										</thead>										
										<tbody>";
										if ($_SESSION['leveluser']=='admin'){
										$tampil = mysql_query("SELECT * FROM user LEFT JOIN divisi ON user.id_divisi=divisi.id_divisi WHERE user.level='petugas' ORDER BY user.id_user ASC");
										}
										else {
										$tampil = mysql_query("SELECT * FROM user LEFT JOIN divisi ON user.id_divisi=divisi.id_divisi WHERE user.level='petugas'  AND id_user='$_SESSION[userid]' ORDER BY user.id_user ASC");
										}
										$no=1;
										while ($r=mysql_fetch_array($tampil)){
										echo"
											<tr>
												<td>$no</td>
												<td>$r[nama_divisi]</td>
												<td>$r[username]</td>
												<td>$r[nama_lengkap]</td>
												<td>$r[email]</td>
												<td>$r[no_telp]</td>
												<td><a href='?module=petugas&act=editpetugas&id=$r[id_user]' class='btn btn-primary btn-sm' title='Edit' ><i class='fa fa-edit'></i> Edit</a>";
												if ($_SESSION['leveluser']=='admin'){
												echo"
													<a href='$aksi?module=petugas&act=hapus&id=$r[id_user]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>";
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
  
  case "tambahpetugas":
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Tambah petugas</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=petugas&act=input'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Username</label>
									<input type='text' name='username' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Username' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Password</label>
									<input type='password' name='password' class='form-control' id='exampleInputNumber1' aria-describedby='numberlHelp' placeholder='Enter Password' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Divisi</label>
										<select class='form-control' name='divisi' required>
											<option value='' selected>- Pilih divisi -</option>";
											$tampil=mysql_query("SELECT * FROM divisi ORDER BY nama_divisi");
											while($r=mysql_fetch_array($tampil)){
											echo "<option value=$r[id_divisi]>$r[nama_divisi]</option>";
											}
										echo "</select>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama</label>
									<input type='text' name='nama_lengkap' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' required>
								  </div>
								   <div class='form-group'>
									<label for='exampleInputPassword1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan No. Telp' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Email</label>
									<input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Simpan</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
	break;

  case "editpetugas":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Form Edit petugas</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='$aksi?module=petugas&act=update'>
								<input type=hidden name=id value='$r[id_user]'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Username</label>
									<input type='text' name='username' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Username' value='$r[username]' required>
									
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Password</label>
									<input type='password' name='password' class='form-control' id='exampleInputNumber1' aria-describedby='numberlHelp' placeholder='Masukkan Password'>
									<small id='emailHelp' class='form-text text-muted'>Jika Password Tidak Diganti, Dikosongkan saja</small>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Divisi</label>
										<select class='form-control' name='divisi' required>";
										$tampil=mysql_query("SELECT * FROM divisi ORDER BY nama_divisi");
										if ($r[id_divisi]==0){
										echo "<option value=0 selected>- Pilih Mata Pelajaran -</option>";
										}   

										while($w=mysql_fetch_array($tampil)){
										if ($r[id_divisi]==$w[id_divisi]){
										echo "<option value=$w[id_divisi] selected>$w[nama_divisi]</option>";
										}
										else{
										echo "<option value=$w[id_divisi]>$w[nama_divisi]</option>";
										}
										}
										echo "</select>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Nama</label>
									<input type='text' name='nama_lengkap' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama' value='$r[nama_lengkap]' required>
								  </div>
								   <div class='form-group'>
									<label for='exampleInputPassword1'>No. Telp</label>
									<input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan No. Telp' value='$r[no_telp]' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputPassword1'>Email</label>
									<input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
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

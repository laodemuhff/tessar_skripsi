<?php
session_start();
$login=mysql_query("SELECT * FROM user WHERE username='$_SESSION[namauser]'");
$r=mysql_fetch_array($login);

?>
		
			<div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h1 class="main-title float-left">Dashboard</h1>
													
													<div class="clearfix"></div><br>
											</div>
									</div>
						</div>
						<!-- end row -->

						<?php
						$tgl_sekarang = date("Y-m-d");
						$cek=mysql_query("SELECT * FROM pembelian");
						$ketemu=mysql_num_rows($cek);
						$cek2=mysql_query("SELECT * FROM penjualan");
						$ketemu2=mysql_num_rows($cek2);
						$cek3=mysql_query("SELECT * FROM agen");
						$ketemu3=mysql_num_rows($cek3);
						if ($_SESSION['leveluser']=='admin'){
						echo"
						<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						
						<b>Nama</b>: $r[nama_lengkap]	
														
													<br />
													<b>Level User: </b>: ADMIN
						<p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
						</div>
						
							<div class='row'>
									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-default'>
													<i class='fa fa-file-text-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Pembelian GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu</h1>
													<span class='text-white'>$ketemu Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-warning'>
													<i class='fa fa-bar-chart float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Penjualan GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu2</h1>
													<span class='text-white'>$ketemu2 Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-info'>
													<i class='fa fa-user-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Agen</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu3</h1>
													<span class='text-white'>$ketemu3 Data</span>
											</div>
									</div>

									
							</div>
							";
							
							
							}
							elseif ($_SESSION['leveluser']=='petugas'){
							if ($_SESSION['divisi']==1) {
							echo"
						<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						
						<b>Nama</b>: $r[nama_lengkap]	
														
													<br />
													<b>Level User: </b>: PETUGAS DIVISI OPERASIONAL
						<p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
						</div>
						
							<div class='row'>
									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-default'>
													<i class='fa fa-file-text-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Pembelian GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu</h1>
													<span class='text-white'>$ketemu Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-warning'>
													<i class='fa fa-bar-chart float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Penjualan GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu2</h1>
													<span class='text-white'>$ketemu2 Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-info'>
													<i class='fa fa-user-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Agen</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu3</h1>
													<span class='text-white'>$ketemu3 Data</span>
											</div>
									</div>

									
							</div>";
							}
							else {
							echo"
						<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						
						<b>Nama</b>: $r[nama_lengkap]	
														
													<br />
													<b>Level User: </b>: PETUGAS DIVISI KEUANGAN
						<p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
						</div>
						
							<div class='row'>
									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-default'>
													<i class='fa fa-file-text-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Pembelian GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu</h1>
													<span class='text-white'>$ketemu Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-warning'>
													<i class='fa fa-bar-chart float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Penjualan GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu2</h1>
													<span class='text-white'>$ketemu2 Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-info'>
													<i class='fa fa-user-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Agen</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu3</h1>
													<span class='text-white'>$ketemu3 Data</span>
											</div>
									</div>

									
							</div>";
							}
							}
							elseif ($_SESSION['leveluser']=='manajer'){
							if ($_SESSION['divisi']==1) {
							echo"
						<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						
						<b>Nama</b>: $r[nama_lengkap]	
														
													<br />
													<b>Level User: </b>: MANAJER DIVISI OPERASIONAL
						<p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
						</div>
						
							<div class='row'>
									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-default'>
													<i class='fa fa-file-text-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Pembelian GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu</h1>
													<span class='text-white'>$ketemu Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-warning'>
													<i class='fa fa-bar-chart float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Penjualan GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu2</h1>
													<span class='text-white'>$ketemu2 Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-info'>
													<i class='fa fa-user-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Agen</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu3</h1>
													<span class='text-white'>$ketemu3 Data</span>
											</div>
									</div>

									
							</div>";
							
							echo " <h4 class='main-title float-left'>GRAFIK</h4>
							<div class='box-body'>
								<div class='box-body table-responsive no-padding'>
									<form action='' method='GET'>
										<input type='hidden' name='module' value='home'>
										<table>
											<tr>
												<td>
													Dari Tanggal <input type='date' name='dari' id='exampleInputPassword1' required> 
													Sampai <input type='date' name='sampai' id='exampleInputPassword1' required>
													<input type='submit' style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
													<button type='button' class='btn btn-success btn-sm' onclick=\"window.location.href='?module=home';\">Reset</button>
												</td>
											</tr>
										</table>
									 </form>
									<br>
             					</div>";
		$dari=tgl_indo($_GET[dari]);
		$sampai=tgl_indo($_GET[sampai]);
		if ($_GET[dari] == '' AND $_GET[sampai] == ''){		
		echo"
		<center>Semua Periode</center>";
		}
		if ($_GET[dari] != '' AND $_GET[sampai] != ''){
		echo"
		<center>Dari Tanggal $dari Sampai tanggal $sampai</center>";
		}
		echo"		
		<div class='row'>
							
			<div class='col-lg-12'>
				<h1 class='page-header'>Grafik Penjualan</h1>
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-12'>
				<div class='panel panel-default'>
					<div class='panel-body'>
																
						<div id='container'></div>																				
											
											
					</div>
				</div>
			</div>
		</div>";
							}
							else {
							echo"
						<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						
						<b>Nama</b>: $r[nama_lengkap]	
														
													<br />
													<b>Level User: </b>: MANAJER DIVISI KEUANGAN
						<p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
						</div>
						
							<div class='row'>
									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-default'>
													<i class='fa fa-file-text-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Pembelian GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu</h1>
													<span class='text-white'>$ketemu Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-warning'>
													<i class='fa fa-bar-chart float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Penjualan GAS</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu2</h1>
													<span class='text-white'>$ketemu2 Data</span>
											</div>
									</div>

									<div class='col-xs-12 col-md-6 col-lg-6 col-xl-3'>
											<div class='card-box noradius noborder bg-info'>
													<i class='fa fa-user-o float-right text-white'></i>
													<h6 class='text-white text-uppercase m-b-20'>Agen</h6>
													<h1 class='m-b-20 text-white counter'>$ketemu3</h1>
													<span class='text-white'>$ketemu3 Data</span>
											</div>
									</div>

									
							</div>";
							echo " <h4 class='main-title float-left'>GRAFIK</h4>
							<div class='box-body'>
			<div class='box-body table-responsive no-padding'>
			<form action='' method='GET'>
			<input type='hidden' name='module' value='home'>
			<table>
			<tr>
			<td>
                    
                    
						<td>Dari Tanggal
						<input type='date' name='dari' id='exampleInputPassword1' required> Sampai
						<input type='date' name='sampai' id='exampleInputPassword1' required>
                    <input type='submit' style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
					<button type='button' class='btn btn-success btn-sm' onclick=\"window.location.href='?module=home';\">Reset</button>
					</td>
					</tr>
				</table>
             </form><br>
             </div>";
		$dari=tgl_indo($_GET[dari]);
		$sampai=tgl_indo($_GET[sampai]);
		if ($_GET[dari] == '' AND $_GET[sampai] == ''){		
		echo"
		<center>Semua Periode</center>";
		}
		if ($_GET[dari] != '' AND $_GET[sampai] != ''){
		echo"
		<center>Dari Tanggal $dari Sampai tanggal $sampai</center>";
		}
		
		echo "<div class='row'>
			<div class='col-lg-12'>
				<h1 class='page-header'>Grafik Pembelian</h1>
			</div>
		</div>
		<div class='row'>
			<div class='col-lg-12'>
				<div class='panel panel-default'>
					<div class='panel-body'>
																
						<div id='container2'></div>																				
											
											
					</div>
				</div>
			</div>
		</div>";
							}
							}
					?>
							<!-- end row -->
			</div>

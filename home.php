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

		$supplier=mysql_query("SELECT * FROM supplier");
		$agen=mysql_query("SELECT * FROM agen");
		$gas=mysql_query("SELECT * FROM gas");
		
		if ($_SESSION['leveluser']=='admin'){
			echo"
				<div class='alert alert-info' role='alert'>
					<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional & Keuangan</h4>
					<b>Nama</b>: $r[nama_lengkap]		
					<br/>
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
				</div>";

		}elseif ($_SESSION['leveluser']=='petugas'){
			
			if ($_SESSION['divisi']==1) {
				echo"
					<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Operasional</h4>
						<b>Nama</b>: $r[nama_lengkap]	
						<br/>
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
			}else{
				echo"
					<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Keuangan</h4>
						<b>Nama</b>: $r[nama_lengkap]		
						<br/>
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

		}elseif ($_SESSION['leveluser']=='manajer'){
					
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
			
					echo "  
					<div class='row'>
						<div class='col-md-12'>
							<h4 class='main-title float-left'>Grafik</h4>
						</div>
						<div class='box-body col-md-12' style='background-color:white; padding:20px'>
							<h5>Filter Grafik</h5>
							<form action='' method='GET'>
								<div class='form-row align-items-center'>
									<input type='hidden' name='module' value='home'>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Dari Tanggal </label>";
										if(isset($_GET['dari']))
											echo "<input type='date' name='dari' class='form-control form-control-sm' value='$_GET[dari]' required>";
										else{
											$last_year = date('Y-m-d', strtotime('-1year', strtotime(date('Y-m-d'))));
											echo "<input type='date' name='dari' class='form-control form-control-sm' value='$last_year' required>";
										}
									echo "</div>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Sampai Tanggal</label>";
										if(isset($_GET['sampai']))
											echo "<input type='date' name='sampai' class='form-control form-control-sm' value='$_GET[sampai]' required>";
										else{
											$now = date('Y-m-d');
											echo "<input type='date' name='sampai' class='form-control form-control-sm' value='$now' required>";
										}
									echo "</div>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Gas </label>
										<select name='gas' class='form-control form-control-sm'>
											<option value=''>All Weight</option>";
											while ($r=mysql_fetch_assoc($gas)){
												if(isset($_GET['gas'])){
													if($_GET['gas'] == $r['id_gas'])
														echo "<option value='$r[id_gas]' selected>$r[ukuran]</option>";
													else
														echo "<option value='$r[id_gas]'>$r[ukuran]</option>";
												}else
													echo "<option value='$r[id_gas]'>$r[ukuran]</option>";
											}
								echo " </select> 
								</div>
								<div class='col-md-2 my-1'>
									<label class='form-label-sm'>Agen </label>
										<select name='multi_agen[]' class='form-control form-control-sm' id='multi_agen' multiple>";
											if(!isset($_GET[multi_agen]) || (isset($_GET[multi_agen][0]) && $_GET[multi_agen][0] == 'all'))
												echo "<option value='all' selected>All Agen</option>";
											else
												echo "<option value='all'>All Agen</option>";

											$tampil=mysql_query("SELECT * FROM agen ORDER BY nama_agen ASC");
											while($r=mysql_fetch_array($tampil)){
												if(isset($_GET[multi_agen])){
													if(in_array($r['id_agen'], $_GET[multi_agen]))
														echo "<option value=$r[id_agen] selected>$r[nama_agen]</option>";
													else
														echo "<option value=$r[id_agen]>$r[nama_agen]</option>";
												}
												else
													echo "<option value=$r[id_agen]>$r[nama_agen]</option>";
											}
										echo "</select>";
												
									if(isset($_GET[bandingkan]) && isset($_GET[multi_agen][0])){
										echo "<input type='checkbox' name='bandingkan' id='bandingkan' checked> Bandingkan";
									}else{
										echo "<input type='checkbox' name='bandingkan' id='bandingkan'> Bandingkan";
									}

						  		echo "</div>
									<div class='col-auto' style='margin-top: 1.85rem!important;'>			
										<input type='submit' class='btn btn-info btn-sm' value='Lihat'>
									</div>
									<div class='col-auto mt-4' style='margin-top: 1.85rem!important;'>				
										<button type='button' class='btn btn-success btn-sm' onclick=\"window.location.href='?module=home';\">Reset</button>
									</div>
									<div class='col-auto mt-4' style='margin-top: 1.85rem!important;'>	
										<button type='button' class='btn btn-primary btn-sm' onclick=\"window.location.href='?module=home';\">
											<i class='fa fa-file-text-o'></i>			
											&nbsp;Cetak Laporan
										</button>
									</div>
								</div>
							</form>
							<br>
						</div>
					</div>";

					echo 
					"<div class='row'>
						<div class='col-lg-12'>
							<h1 class='page-header'>
								<span class='badge badge-success' style='font-size:1em'>Grafik Penjualan</span>&nbsp; ";
								$dari=tgl_indo($_GET[dari]);
								$sampai=tgl_indo($_GET[sampai]);
			
								if ($_GET[dari] == '' AND $_GET[sampai] == ''){		
									echo"<span style='font-size:1em'>1 Tahun Terakhir</span>";
								}
								if ($_GET[dari] != '' AND $_GET[sampai] != ''){
									$diff = abs(strtotime($_GET[sampai]) - strtotime($_GET[dari]));
									$years = ($diff / (365*60*60*24));
								
									if($years / floor($years) == 1){
										echo"<span style='font-size:1em'>".$years." Tahun Terakhir</span>";
									}else{
										echo"<span class='badge badge-info' style='font-size:1em;'>Dari Tanggal $dari Sampai tanggal $sampai </span>&nbsp; ";
									}
								}

								// if ($_GET[agen] != ''){
								// 	$query = mysql_query("SELECT * FROM agen WHERE id_agen = '$_GET[agen]' limit 1");
								// 	while($r = mysql_fetch_assoc($query)){
								// 		echo"<span class='badge badge-info' style='font-size:1em;'> $r[nama_agen]</span>";
								// 	}
								// }
							echo "</h1>
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
			}else{
				echo"
					<div class='alert alert-info' role='alert'>
						<h4 class='alert-heading'>Selamat Datang di Sistem Monitoring Transaksi Pelayanan Keuangan</h4>
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
			
				echo "  
					<div class='row'>
						<div class='col-md-12'>
							<h4 class='main-title float-left'>Grafik</h4>
						</div>
						<div class='box-body col-md-12' style='background-color:white; padding:20px'>
							<h5>Filter Grafik</h5>
							<form action='' method='GET'>
								<div class='form-row align-items-center'>
									<input type='hidden' name='module' value='home'>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Dari Tanggal </label>";
										if(isset($_GET['dari']))
											echo "<input type='date' name='dari' class='form-control form-control-sm' value='$_GET[dari]' required>";
										else{
											$last_year = date('Y-m-d', strtotime('-1year', strtotime(date('Y-m-d'))));
											echo "<input type='date' name='dari' class='form-control form-control-sm' value='$last_year' required>";
										}
									echo "</div>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Sampai Tanggal</label>";
										if(isset($_GET['sampai']))
											echo "<input type='date' name='sampai' class='form-control form-control-sm' value='$_GET[sampai]' required>";
										else{
											$now = date('Y-m-d');
											echo "<input type='date' name='sampai' class='form-control form-control-sm' value='$now' required>";
										}
									echo "</div>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Gas </label>
										<select name='gas' class='form-control form-control-sm'>
											<option value=''>All Weight</option>";
											while ($r=mysql_fetch_assoc($gas)){
												if(isset($_GET['gas'])){
													if($_GET['gas'] == $r['id_gas'])
														echo "<option value='$r[id_gas]' selected>$r[ukuran]</option>";
													else
														echo "<option value='$r[id_gas]'>$r[ukuran]</option>";
												}else
													echo "<option value='$r[id_gas]'>$r[ukuran]</option>";
											}
									echo " </select> 
									</div>
									<div class='col-md-2 my-1'>
										<label class='form-label-sm'>Supplier </label>
											<select name='multi_supplier[]' class='form-control form-control-sm' id='multi_supplier' multiple>";
												if(!isset($_GET[multi_supplier]) || (isset($_GET[multi_supplier][0]) && $_GET[multi_supplier][0] == 'all'))
													echo "<option value='all' selected>All Suplier</option>";
												else
													echo "<option value='all'>All Suplier</option>";

												$tampil=mysql_query("SELECT * FROM supplier ORDER BY nama_supplier ASC");
												while($r=mysql_fetch_array($tampil)){
													if(isset($_GET[multi_supplier])){
														if(in_array($r['kode_supplier'], $_GET[multi_supplier]))
															echo "<option value=$r[kode_supplier] selected>$r[nama_supplier]</option>";
														else
															echo "<option value=$r[kode_supplier]>$r[nama_supplier]</option>";
													}
													else
														echo "<option value=$r[kode_supplier]>$r[nama_supplier]</option>";
												}
									echo "</select>";
												
									if(isset($_GET[bandingkan]) && isset($_GET[multi_supplier][0])){
										echo "<input type='checkbox' name='bandingkan' id='bandingkan' checked> Bandingkan";
									}else{
										echo "<input type='checkbox' name='bandingkan' id='bandingkan'> Bandingkan";
									}

								  echo "</div>
									<div class='col-auto' style='margin-top: 1.85rem!important;'>			
										<input type='submit' class='btn btn-info btn-sm' value='Lihat'>
									</div>
									<div class='col-auto mt-4' style='margin-top: 1.85rem!important;'>				
										<button type='button' class='btn btn-success btn-sm' onclick=\"window.location.href='?module=home';\">Reset</button>
									</div>
									<div class='col-auto mt-4' style='margin-top: 1.85rem!important;'>	
										<button type='button' class='btn btn-primary btn-sm' onclick=\"window.location.href='?module=home';\">
											<i class='fa fa-file-text-o'></i>			
											&nbsp;Cetak Laporan
										</button>
									</div>
								</div>
							</form>
							<br>
						</div>
					</div>";
						
					echo 
					"<div class='row'>
						<div class='col-lg-12'>
							<h1 class='page-header'>
								<span class='badge badge-success' style='font-size:1em'>Grafik Pembelian</span>&nbsp; ";
								$dari=tgl_indo($_GET[dari]);
								$sampai=tgl_indo($_GET[sampai]);
			
								if ($_GET[dari] == '' AND $_GET[sampai] == ''){		
									echo"<span style='font-size:1em'>1 Tahun Terakhir</span>";
								}
								if ($_GET[dari] != '' AND $_GET[sampai] != ''){
									$diff = abs(strtotime($_GET[sampai]) - strtotime($_GET[dari]));
									$years = ($diff / (365*60*60*24));
								
									if($years / floor($years) == 1){
										echo"<span style='font-size:1em'>".$years." Tahun Terakhir</span>";
									}else{
										echo"<span class='badge badge-info' style='font-size:1em;'>Dari Tanggal $dari Sampai tanggal $sampai </span>&nbsp; ";
									}
								}

								if ($_GET[gas] != ''){
									$query = mysql_query("SELECT * FROM gas WHERE id_gas = '$_GET[id_gas]' limit 1");
									while($r = mysql_fetch_assoc($query)){
										echo"<span class='badge badge-info' style='font-size:1em;'>$r[ukuran]</span>";
									}
								}
							echo "</h1>
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

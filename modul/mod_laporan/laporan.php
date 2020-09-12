<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

  if ($_SESSION['leveluser']=='admin'){
   echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Laporan Penjualan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='modul/mod_laporan/cetakpenjualan.php' target='_blank'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Dari Tanggal</label>
									<input type='date' name='dari' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Sampai Tanggal</label>
									<input type='date' name='sampai' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Proses</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
		echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Laporan Pembelian</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='modul/mod_laporan/cetakpembelian.php' target='_blank'>
								 <div class='form-group'>
									<label for='exampleInputEmail1'>Dari Tanggal</label>
									<input type='date' name='dari' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Sampai Tanggal</label>
									<input type='date' name='sampai' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div> 
								  <button type='submit' class='btn btn-primary'>Proses</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
		}
		elseif ($_SESSION['leveluser']=='manajer'){
		if ($_SESSION['divisi']==1) {
		echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Laporan Penjualan</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='modul/mod_laporan/cetakpenjualan.php' target='_blank'>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Dari Tanggal</label>
									<input type='date' name='dari' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Sampai Tanggal</label>
									<input type='date' name='sampai' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <button type='submit' class='btn btn-primary'>Proses</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
		}
		else {
		echo"
	<div class='row'>
			
                    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>						
						<div class='card mb-3'>
							<div class='card-header'>
								<h3><i class='fa fa-check-square-o'></i> Laporan Pembelian</h3>
								
							</div>
								
							<div class='card-body'>
								
								<form method=POST action='modul/mod_laporan/cetakpembelian.php' target='_blank'>
								 <div class='form-group'>
									<label for='exampleInputEmail1'>Dari Tanggal</label>
									<input type='date' name='dari' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div>
								  <div class='form-group'>
									<label for='exampleInputEmail1'>Sampai Tanggal</label>
									<input type='date' name='sampai' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Masukkan Nama divisi' required>
								  </div> 
								  <button type='submit' class='btn btn-primary'>Proses</button>
								</form>
																
							</div>														
						</div><!-- end card-->					
                    </div>
		</div>";
		}
		}
		
		
	 

}
?>

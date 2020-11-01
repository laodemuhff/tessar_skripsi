<?php
   session_start();
	include "config/koneksi.php";
   include "config/library.php";
   include "config/fungsi_indotgl.php";
   include "config/fungsi_rupiah.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Sistem Monitoring Transaksi Pelayanan Operasional</title>
		<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<!-- <link type="text/css" rel="stylesheet" media="all" href="css/chat.css" /> -->
		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
		<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
		<!-- END CSS for this page -->
		<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
		
</head>

<body class="adminbody">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="index.html" class="logo"><img alt="Logo" src="assets/images/logo.png" /> <span>USER</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        
						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hello, <?php echo" $_SESSION[namalengkap] "; ?></small> </h5>
                                </div>

                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off"></i> <span>Logout</span>
                                </a>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>

        </nav>

	</div>
	<!-- End Navigation -->
	
 
	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">
        <?php
		if ($_SESSION['leveluser']=='admin'){
		?>
			<ul>
			
					<li class="submenu">
						<a href="media.php?module=home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-users"></i> <span> Master User </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=admin">Admin</a></li>
								<li><a href="media.php?module=petugas">Petugas</a></li>
								<li><a href="media.php?module=manajer">Manajer</a></li>
							</ul>
                    </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-tv"></i> <span> Master Data </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=divisi">Divisi</a></li>
								<li><a href="media.php?module=agen">Agen</a></li>
								<li><a href="media.php?module=supir">Supir</a></li>
								<li><a href="media.php?module=supplier">Supplier</a></li>
								<li><a href="media.php?module=gas">Gas</a></li>
							</ul>
                    </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-laptop"></i> <span> Master Transaksi </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=pembelian">Pembelian</a></li>
								<li><a href="media.php?module=penjualan">Penjualan</a></li>
							</ul>
                    </li>
					<li class="submenu">
                        <a href="media.php?module=laporan"><i class="fa fa-fw fa-copy"></i><span> Laporan </span> </a>
                    </li>
			
				
            </ul>
		<?php
		}
		elseif ($_SESSION['leveluser']=='petugas'){
		if ($_SESSION['divisi']==1) {
		?>
		<ul>
			
					<li class="submenu">
						<a href="media.php?module=home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
						<a href="media.php?module=petugas"><i class="fa fa-fw fa-user"></i><span> Profil Petugas </span> </a>
                    </li>
					<li class="submenu">
                     <a href="#"><i class="fa fa-fw fa-tv"></i> <span> Master Data </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=divisi">Divisi</a></li>
								<li><a href="media.php?module=agen">Agen</a></li>
								<li><a href="media.php?module=supir">Supir</a></li>
								<li><a href="media.php?module=supplier">Supplier</a></li>
								<li><a href="media.php?module=gas">Gas</a></li>
                        <li><a href="media.php?module=surat">Surat Jalan</a></li>
							</ul>
               </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-laptop"></i> <span> Master Transaksi </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=penjualan">Penjualan</a></li>
							</ul>
                    </li>
			
				
            </ul>
			<?php
			} else {
			?>
			<ul>
			
					<li class="submenu">
						<a href="media.php?module=home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
						<a href="media.php?module=petugas"><i class="fa fa-fw fa-user"></i><span> Profil User </span> </a>
                    </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-tv"></i> <span> Master Data </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=divisi">Divisi</a></li>
								<li><a href="media.php?module=agen">Agen</a></li>
								<li><a href="media.php?module=supir">Supir</a></li>
								<li><a href="media.php?module=supplier">Supplier</a></li>
								<li><a href="media.php?module=gas">Gas</a></li>
							</ul>
                    </li>
					<li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-laptop"></i> <span> Master Transaksi </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=pembelian">Pembelian</a></li>
							</ul>
                    </li>
			
				
            </ul>
			<?php
			
			}
			}

		elseif ($_SESSION['leveluser']=='manajer'){
		if ($_SESSION['divisi']==1) {
		?>
		<ul>
			
					<li class="submenu">
						<a href="media.php?module=home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
						<a href="media.php?module=manajer"><i class="fa fa-fw fa-user"></i><span> Profil User </span> </a>
               </li>
               <li class="submenu">
                     <a href="#"><i class="fa fa-fw fa-tv"></i> <span> Master Data </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=divisi">Divisi</a></li>
								<li><a href="media.php?module=agen">Agen</a></li>
								<li><a href="media.php?module=supir">Supir</a></li>
								<li><a href="media.php?module=supplier">Supplier</a></li>
								<li><a href="media.php?module=gas">Gas</a></li>
                        <li><a href="media.php?module=surat">Surat Jalan</a></li>
							</ul>
               </li>
					<li class="submenu">
						<a href="media.php?module=agen"><i class="fa fa-fw fa-laptop"></i><span> Data Agen </span> </a>
                    </li>
					<li class="submenu">
                        <a href="media.php?module=laporan"><i class="fa fa-fw fa-copy"></i><span> Laporan </span> </a>
                    </li>
			
				
            </ul>
			<?php
			} else {
			?>
			<ul>
			
					<li class="submenu">
						<a href="media.php?module=home"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>
					<li class="submenu">
						<a href="media.php?module=manajer"><i class="fa fa-fw fa-user"></i><span> Profil User </span> </a>
                    </li>
                    <li class="submenu">
                     <a href="#"><i class="fa fa-fw fa-tv"></i> <span> Master Data </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="media.php?module=divisi">Divisi</a></li>
								<li><a href="media.php?module=agen">Agen</a></li>
								<li><a href="media.php?module=supir">Supir</a></li>
								<li><a href="media.php?module=supplier">Supplier</a></li>
								<li><a href="media.php?module=gas">Gas</a></li>
                        <li><a href="media.php?module=surat">Surat Jalan</a></li>
							</ul>
               </li>
					<li class="submenu">
                        <a href="media.php?module=laporan"><i class="fa fa-fw fa-copy"></i><span> Laporan </span> </a>
                    </li>
			
				
            </ul>
			<?php
			
			}
			}
			?>
            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
		<?php
if ($_GET['module']=='home'){
    include "home.php";
  
}

// Bagian divisi
elseif ($_GET['module']=='divisi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser'] == 'manajer'){
    include "modul/mod_divisi/divisi.php";
  }
}

// Bagian agen
elseif ($_GET['module']=='agen'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser']=='manajer'){
    include "modul/mod_agen/agen.php";
  }
}
// Bagian gas
elseif ($_GET['module']=='gas'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser'] == 'manajer'){
    include "modul/mod_gas/gas.php";
  }
}
// Bagian supplier
elseif ($_GET['module']=='supplier'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser'] == 'manajer'){
    include "modul/mod_supplier/supplier.php";
  }
}
// Bagian admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }
}
// Bagian supir
elseif ($_GET['module']=='supir'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser'] == 'manajer'){
    include "modul/mod_supir/supir.php";
  }
}
// Bagian surat
elseif ($_GET['module']=='surat'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas' OR $_SESSION['leveluser'] == 'manajer'){
    include "modul/mod_surat/surat.php";
  }
}
// Bagian petugas
elseif ($_GET['module']=='petugas'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_petugas/petugas.php";
  }
}
// Bagian manajer
elseif ($_GET['module']=='manajer'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='manajer'){
    include "modul/mod_manajer/manajer.php";
  }
}
// Bagian pembelian
elseif ($_GET['module']=='pembelian'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_pembelian/pembelian.php";
  }
}
// Bagian penjualan
elseif ($_GET['module']=='penjualan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_penjualan/penjualan.php";
  }
}

// Bagian laporan
elseif ($_GET['module']=='laporan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='manajer' ){
    include "modul/mod_laporan/laporan.php";
  }
}


		?>
        </div>
			<!-- END container-fluid -->
	</div>
		<!-- END content -->
	<!-- END content-page -->
    
	<footer class="footer">
		<span class="text-right">
		Copyright @ 2020 <a href="#">PT. DWI HEKSA EKA</a>
		</span>
		<span class="float-right">
		Dikembangkan Oleh Tessar</a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/chat.js"></script>	 -->
<script src="assets/js/moment.min.js"></script>
	
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

	<!-- Counter-Up-->
	<script src="assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>			

	<script>
		$(document).ready(function() {
			// data-tables
			$('#example1').DataTable();
			$('.display').DataTable();		
			// counter-up
			$('.counter').counterUp({
				delay: 10,
				time: 600
			});
		} );		
	</script>
	<!-- BEGIN Java Script for this page -->
<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script> 
<!-- END Java Script for this page -->
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="js/repeater/jquery.repeater.js"></script>
<script>								
$(document).ready(function() {
    $('.select2').select2();

    $('#agen_surat').select2({
         placeholder: 'Silahkan Pilih'
   });

   $('#multi_supplier').select2({
         placeholder: 'Silahkan Pilih'
   });
});
</script>
<?php
	include "config/koneksi.php";
   if ($_GET['module']=='home'){
      if ($_SESSION['leveluser']=='manajer'){ 
         if ($_SESSION['divisi']==1) {
            // get data penjualan
            $sql   =  "SELECT sum(detail_penjualan.jumlah) as jumlah, detail_penjualan.harga_jual as harga, gas.ukuran as ukuran_gas, agen.nama_agen as agen, penjualan.tgl_penjualan as tgl_penjualan
            FROM detail_penjualan,gas, agen, penjualan 
            WHERE detail_penjualan.id_gas=gas.id_gas
            AND (detail_penjualan.kode_penjualan=penjualan.kode_penjualan)
            AND (penjualan.id_agen = agen.id_agen)";

            if ($_GET[dari] != '' AND $_GET[sampai] != ''){
               $sql .= " AND (penjualan.tgl_penjualan BETWEEN '$_GET[dari]' AND '$_GET[sampai]')";        
            }

            if ($_GET[gas] != ''){
               $sql .=  " AND (detail_penjualan.id_gas = '$_GET[gas]')";    
            }   
            
            if(!isset($_GET[bandingkan])){
               
               if(isset($_GET[multi_agen][0])){
                  $agen_pertama = $_GET[multi_agen][0];
                  if($agen_pertama != 'all'){
                     $sql .= "AND agen.id_agen IN(";
                     foreach($_GET[multi_agen] as $key => $value){
                        $sql .= "'$value',";
                     }
                     $sql = rtrim($sql, ', ');
                     $sql .= ")";
                  }
               }

            }else{

               if(isset($_GET[multi_agen][0])){
                  $agen_pertama = $_GET[multi_agen][0];
                  if($agen_pertama == 'all'){
                     $query_multi_series = []; 
                     $query_agen2 = mysql_query("SELECT * FROM agen");
                     $count = 0;
                     while($row = mysql_fetch_assoc($query_agen2)){
                        $kode = $row['id_agen'];
                        $query_multi_series[$count]['name'] = $row['nama_agen'];
                        $query_multi_series[$count]['query'] = mysql_query($sql." AND agen.id_agen = '$kode' GROUP BY tgl_penjualan ORDER BY tgl_penjualan") or die(mysql_error());
                        $count++;
                     }
                  }else{
                     $query_multi_series = []; 
                     foreach($_GET[multi_agen] as $key => $value){
                        $query_agen2 = mysql_query("SELECT * FROM agen WHERE id_agen = '$value' ");
                        while($row = mysql_fetch_assoc($query_agen2)){
                           $query_multi_series[$key]['name'] = $row['nama_agen'];
                        }
                        $query_multi_series[$key]['query'] = mysql_query($sql." AND agen.id_agen = '$value' GROUP BY tgl_penjualan ORDER BY tgl_penjualan") or die(mysql_error());
                     }
                  }
               }
            }

            // print_r($sql);exit;
            $sql .= 'GROUP BY tgl_penjualan ORDER BY tgl_penjualan';
            $query = mysql_query($sql) or die(mysql_error());

         }
         
         if($_SESSION['divisi']==2){
            $sql   =  "SELECT sum(detail_pembelian.jumlah) as jumlah, detail_pembelian.harga_beli as harga, gas.ukuran as ukuran_gas, supplier.nama_supplier as supplier, pembelian.tgl_pembelian as tgl_pembelian
            FROM detail_pembelian,gas, supplier, pembelian 
            WHERE detail_pembelian.id_gas=gas.id_gas
            AND (detail_pembelian.kode_pembelian=pembelian.kode_pembelian)
            AND (pembelian.kode_supplier = supplier.kode_supplier)";

            if ($_GET[dari] != '' AND $_GET[sampai] != ''){
               $sql .= " AND (pembelian.tgl_pembelian BETWEEN '$_GET[dari]' AND '$_GET[sampai]')";        
            }

            if ($_GET[gas] != ''){
               $sql .=  " AND (detail_pembelian.id_gas = '$_GET[gas]')";    
            }   
            
            if(!isset($_GET[bandingkan])){
               
               if(isset($_GET[multi_supplier][0])){
                  $supplier_pertama = $_GET[multi_supplier][0];
                  if($supplier_pertama != 'all'){
                     $sql .= "AND supplier.kode_supplier IN(";
                     foreach($_GET[multi_supplier] as $key => $value){
                        $sql .= "'$value',";
                     }
                     $sql = rtrim($sql, ', ');
                     $sql .= ")";
                  }
               }

            }else{

               if(isset($_GET[multi_supplier][0])){
                  $supplier_pertama = $_GET[multi_supplier][0];
                  if($supplier_pertama == 'all'){
                     $query_multi_series = []; 
                     $query_supplier2 = mysql_query("SELECT * FROM supplier");
                     $count = 0;
                     while($row = mysql_fetch_assoc($query_supplier2)){
                        $kode = $row['kode_supplier'];
                        $query_multi_series[$count]['name'] = $row['nama_supplier'];
                        $query_multi_series[$count]['query'] = mysql_query($sql." AND supplier.kode_supplier = '$kode' GROUP BY tgl_pembelian ORDER BY tgl_pembelian") or die(mysql_error());
                        $count++;
                     }
                  }else{
                     $query_multi_series = []; 
                     foreach($_GET[multi_supplier] as $key => $value){
                        $query_supplier2 = mysql_query("SELECT * FROM supplier WHERE kode_supplier = '$value' ");
                        while($row = mysql_fetch_assoc($query_supplier2)){
                           $query_multi_series[$key]['name'] = $row['nama_supplier'];
                        }
                        $query_multi_series[$key]['query'] = mysql_query($sql." AND supplier.kode_supplier = '$value' GROUP BY tgl_pembelian ORDER BY tgl_pembelian") or die(mysql_error());
                     }
                  }
               }
            }

            // print_r($sql);exit;
            $sql .= 'GROUP BY tgl_pembelian ORDER BY tgl_pembelian';
            $query = mysql_query($sql) or die(mysql_error());

         }

      }
   }

   if ($_GET['module']=='home'){
      if ($_SESSION['leveluser']=='manajer'){
         if ($_SESSION['divisi']==1) {
            if(isset($query_multi_series) && !empty($query_multi_series)){
   ?>
               <script type="text/javascript">
                  // globally available
                  $(function() {
                     new Highcharts.chart('container', {
   
                        chart: {
                           type: 'column',
                           zoomType: 'x'
                        },   
   
                        title: {
                           <?php
                              $agen = 'Semua Agen';
                              if(isset($_GET[multi_agen][0])){
                                 if($_GET[multi_agen][0] == 'all'){
                                    $agen = 'Semua Agen';
                                 }else{
                                    if(sizeof($_GET[multi_agen]) == 1){
                                       $agen_pertama = $_GET[multi_agen][0];
                                       $query_agen = mysql_query("SELECT * FROM agen WHERE id_agen =  '$agen_pertama '");
                                       while($row = mysql_fetch_assoc($query_agen)){
                                          $agen = $row['nama_agen'];
                                       }
                                    }else{
                                       $agen = '[';
                                       foreach($_GET[multi_agen] as $key => $value){
                                          $kode = $value;
                                          $query_agen = mysql_query("SELECT * FROM agen WHERE id_agen =  '$kode'");
                                          while($row = mysql_fetch_assoc($query_agen)){
                                             $agen .= $row['nama_agen'].',';
                                          }
                                       }
                                       $agen = rtrim($agen, ', ');
                                       $agen .= ']';
                                    }
                                 }
                              } 
                           ?>
   
                           text: 'Grafik Perbandingan Penjualan Gas ke <?php echo $agen; ?>'
                        },
   
                        subtitle: {
                           text: document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                        },
   
                        xAxis: {
                              type: 'datetime',
                        },
                        
                        yAxis: {
                           title: {
                              text: 'Jumlah penjualan gas'
                           }
                        },
   
                        legend: {
                           layout: 'vertical',
                           align: 'right',
                           verticalAlign: 'middle'
                        },
   
                        plotOptions: {
                           column: {
                                 pointPadding: 0.2,
                                 borderWidth: 0
                           }
                        },
   
                        series: [
   
                           <?php
                              foreach($query_multi_series as $key => $value){
                           ?>
                                 {
                                    name: "<?php echo $value['name'] ?>",
                                    data: [
                                       <?php
                                       while($row2 = mysql_fetch_array($value['query'])){
                                          $tgl_penjualan = (int) strtotime($row2['tgl_penjualan']. '+7hours').'000';
                                       ?>
                                          [
                                             <?php echo $tgl_penjualan ?>,
                                             <?php echo $row2['jumlah'] ?>
                                          ],
                                       <?php
                                       }
                                       ?>
                                    ] 
                                 },
   
                           <?php
                              }
                           ?>
                        
                        ],
   
                        responsive: {
                           rules: [{
                              condition: {
                                    maxWidth: 500
                              },
                              chartOptions: {
                                    legend: {
                                       layout: 'horizontal',
                                       align: 'center',
                                       verticalAlign: 'bottom'
                                    }
                              }
                           }]
                        }
   
                     }); 
                  });
               </script>
   
               <?php    
               
               }else{ 
               
               ?>
               <script type="text/javascript">
                     // globally available
                     $(function() {
                        new Highcharts.Chart({
                           chart: {
                              renderTo: 'container',
                              type: 'column',
                              zoomType: 'x'
                           },   
                           title: {
                              <?php
                                 $agen = 'Semua Agen';
                                 if(isset($_GET[multi_agen][0])){
                                    if($_GET[multi_agen][0] == 'all'){
                                       $agen = 'Semua agen';
                                    }else{
                                       if(sizeof($_GET[multi_agen]) == 1){
                                          $agen_pertama = $_GET[multi_agen][0];
                                          $query_agen = mysql_query("SELECT * FROM agen WHERE id_agen =  '$agen_pertama '");
                                          while($row = mysql_fetch_assoc($query_agen)){
                                             $agen = $row['nama_agen'];
                                          }
                                       }else{
                                          $agen = '[';
                                          foreach($_GET[multi_agen] as $key => $value){
                                             $kode = $value;
                                             $query_agen = mysql_query("SELECT * FROM agen WHERE id_agen =  '$kode'");
                                             while($row = mysql_fetch_assoc($query_agen)){
                                                $agen .= $row['nama_agen'].',';
                                             }
                                          }
                                          $agen = rtrim($agen, ', ');
                                          $agen .= ']';
                                       }
                                    }
                                 } 
                              ?>
   
                              text: 'Grafik Total Penjualan Gas ke <?php echo $agen; ?>'
                           },
                           subtitle: {
                              text: document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                           },
                           xAxis: {
                              type: 'datetime',
                           },
                           yAxis: {
                              title: {
                                 text: 'Jumlah penjualan gas'
                              }
                           },
                           legend: {
                              enabled: false
                           },

                           plotOptions: {
                              column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                              }
                           },
   
                           series:[
                              {
                                 name: 'jumlah penjualan gas',
                                 data: [
                                    <?php
                                       while($row = mysql_fetch_array($query)){
                                          $tgl_penjualan = (int) strtotime($row['tgl_penjualan']. '+7hours').'000';
                                    ?>
                                       [
                                          <?php echo $tgl_penjualan ?>,
                                          <?php echo $row['jumlah'] ?>
                                       ],
                                    <?php
                                       }
                                    ?>
                                 ]
                              }
                           ]
                        });
                     });	
                  </script>
            <?php  
            }
         }  
      }
   }
   ?>


<?php
if ($_GET['module']=='home'){
   if ($_SESSION['leveluser']=='manajer'){
      if ($_SESSION['divisi']==2) {
         if(isset($query_multi_series) && !empty($query_multi_series)){
?>
            <script type="text/javascript">
               // globally available
               $(function() {
                  new Highcharts.chart('container2', {

                     chart: {
                        type: 'column',
                        zoomType: 'x'
                     },   

                     title: {
                        <?php
                           $supplier = 'Semua Supplier';
                           if(isset($_GET[multi_supplier][0])){
                              if($_GET[multi_supplier][0] == 'all'){
                                 $supplier = 'Semua Supplier';
                              }else{
                                 if(sizeof($_GET[multi_supplier]) == 1){
                                    $supplier_pertama = $_GET[multi_supplier][0];
                                    $query_supplier = mysql_query("SELECT * FROM supplier WHERE kode_supplier =  '$supplier_pertama '");
                                    while($row = mysql_fetch_assoc($query_supplier)){
                                       $supplier = $row['nama_supplier'];
                                    }
                                 }else{
                                    $supplier = '[';
                                    foreach($_GET[multi_supplier] as $key => $value){
                                       $kode = $value;
                                       $query_supplier = mysql_query("SELECT * FROM supplier WHERE kode_supplier =  '$kode'");
                                       while($row = mysql_fetch_assoc($query_supplier)){
                                          $supplier .= $row['nama_supplier'].',';
                                       }
                                    }
                                    $supplier = rtrim($supplier, ', ');
                                    $supplier .= ']';
                                 }
                              }
                           } 
                        ?>

                        text: 'Grafik Perbandingan Pembelian Gas dari <?php echo $supplier; ?>'
                     },

                     subtitle: {
                        text: document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                     },

                     xAxis: {
                           type: 'datetime',
                     },
                     
                     yAxis: {
                        title: {
                           text: 'Jumlah pembelian gas'
                        }
                     },

                     legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                     },

                     plotOptions: {
                        column: {
                              pointPadding: 0.2,
                              borderWidth: 0
                        }
                     },

                     series: [

                        <?php
                           foreach($query_multi_series as $key => $value){
                        ?>
                              {
                                 name: "<?php echo $value['name'] ?>",
                                 data: [
                                    <?php
                                    while($row2 = mysql_fetch_array($value['query'])){
                                       $tgl_pembelian = (int) strtotime($row2['tgl_pembelian']. '+7hours').'000';
                                    ?>
                                       [
                                          <?php echo $tgl_pembelian ?>,
                                          <?php echo $row2['jumlah'] ?>
                                       ],
                                    <?php
                                    }
                                    ?>
                                 ] 
                              },

                        <?php
                           }
                        ?>
                     
                     ],

                     responsive: {
                        rules: [{
                           condition: {
                                 maxWidth: 500
                           },
                           chartOptions: {
                                 legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                 }
                           }
                        }]
                     }

                  }); 
               });
            </script>

            <?php    
            
            }else{ 
            
            ?>
            <script type="text/javascript">
                  // globally available
                  $(function() {

                     new Highcharts.Chart({
                        chart: {
                           renderTo: 'container2',
                           type: 'column',
                           zoomType: 'x'
                        },   
                        title: {
                           <?php
                              $supplier = 'Semua Supplier';
                              if(isset($_GET[multi_supplier][0])){
                                 if($_GET[multi_supplier][0] == 'all'){
                                    $supplier = 'Semua Supplier';
                                 }else{
                                    if(sizeof($_GET[multi_supplier]) == 1){
                                       $supplier_pertama = $_GET[multi_supplier][0];
                                       $query_supplier = mysql_query("SELECT * FROM supplier WHERE kode_supplier =  '$supplier_pertama '");
                                       while($row = mysql_fetch_assoc($query_supplier)){
                                          $supplier = $row['nama_supplier'];
                                       }
                                    }else{
                                       $supplier = '[';
                                       foreach($_GET[multi_supplier] as $key => $value){
                                          $kode = $value;
                                          $query_supplier = mysql_query("SELECT * FROM supplier WHERE kode_supplier =  '$kode'");
                                          while($row = mysql_fetch_assoc($query_supplier)){
                                             $supplier .= $row['nama_supplier'].',';
                                          }
                                       }
                                       $supplier = rtrim($supplier, ', ');
                                       $supplier .= ']';
                                    }
                                 }
                              } 
                           ?>

                           text: 'Grafik Total Pembelian Gas dari <?php echo $supplier; ?>'
                        },
                        subtitle: {
                           text: document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                        },
                        xAxis: {
                           type: 'datetime',
                        },
                        yAxis: {
                           title: {
                              text: 'Jumlah pembelian gas'
                           }
                        },
                        legend: {
                           enabled: false
                        },

                        plotOptions: {
                           column: {
                              pointPadding: 0.2,
                              borderWidth: 0
                           }
                        },

                        series:[
                           {
                              name: 'jumlah pembelian gas',
                              data: [
                                 <?php
                                    while($row = mysql_fetch_array($query)){
                                       $tgl_pembelian = (int) strtotime($row['tgl_pembelian']. '+7hours').'000';
                                 ?>
                                    [
                                       <?php echo $tgl_pembelian ?>,
                                       <?php echo $row['jumlah'] ?>
                                    ],
                                 <?php
                                    }
                                 ?>
                              ]
                           }
                        ]
                     });
                  });	
               </script>
         <?php  
         }
      }  
   }
}
?>

<?php
if ($_GET['module']=='surat' && isset($_GET['id_surat']) && isset($_GET['redirect_cetak'])){
   if ($_SESSION['leveluser']=='manajer' || $_SESSION['leveluser'] == 'petugas'){
      if ($_SESSION['divisi']==1) {
?>
         <script>
               $(function(){
                   var id_surat = "<?php echo $_GET['id_surat'] ?>"
                   
                   window.open('modul/mod_surat/cetak.php?id='+id_surat, '_blank');
               })
         </script>
<?php
      }
   }
}
?>

<script>
   $(function(){
      $('.repeater').repeater({
         initEmpty: true,
         show: function () {
            $(this).slideDown();
         },
         hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
         }
      });
   })

</script>
</body>
</html>
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
		<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
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
						<a href="media.php?module=manajer"><i class="fa fa-fw fa-user"></i><span> Profil Petugas </span> </a>
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
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
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
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_gas/gas.php";
  }
}
// Bagian supplier
elseif ($_GET['module']=='supplier'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
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
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_supir/supir.php";
  }
}
// Bagian surat
elseif ($_GET['module']=='surat'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
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
<script type="text/javascript" src="js/chat.js"></script>	
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
 
<!-- END Java Script for this page -->
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script>								
$(document).ready(function() {
    $('.select2').select2();

    $('#agen_surat').select2({
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
            $sql   = "SELECT Sum(detail_penjualan.jumlah) as Tot_Qty, gas.ukuran 
                      FROM detail_penjualan,gas,penjualan 
                      WHERE detail_penjualan.id_gas=gas.id_gas 
                      AND detail_penjualan.kode_penjualan=penjualan.kode_penjualan";
                      
            if ($_GET[dari] != '' AND $_GET[sampai] != ''){
               $sql .= " AND (penjualan.tgl_penjualan BETWEEN '$_GET[dari]' AND '$_GET[sampai]')";     
            }
                     
            if ($_GET[agen] != ''){
               $sql .=  " AND (penjualan.id_agen = '$_GET[agen]')";    
            } 

            $sql .= " GROUP BY gas.id_gas ORDER BY gas.id_gas DESC";
            $query = mysql_query($sql)  or die(mysql_error());
         }
         
         if($_SESSION['divisi']==2){
            // get data pembelian
            $sql   =  "SELECT Sum(detail_pembelian.jumlah) as Tot_Qty, gas.ukuran 
                       FROM detail_pembelian,gas,pembelian 
                       WHERE detail_pembelian.id_gas=gas.id_gas
                       AND (detail_pembelian.kode_pembelian=pembelian.kode_pembelian)";
                       
                       
            if ($_GET[dari] != '' AND $_GET[sampai] != ''){
               $sql .= " AND (pembelian.tgl_pembelian BETWEEN '$_GET[dari]' AND '$_GET[sampai]')";        
            }
                     
            if ($_GET[supplier] != ''){
               $sql .=  " AND (pembelian.kode_supplier = '$_GET[supplier]')";    
            }   
            
            $sql .= " GROUP BY gas.id_gas ORDER BY gas.id_gas DESC";
            $query = mysql_query($sql) or die(mysql_error());
         }

      }
   }

if ($_GET['module']=='home'){
   if ($_SESSION['leveluser']=='manajer'){
      if ($_SESSION['divisi']==1) {
?>
         <script src="highcharts.js" type="text/javascript"></script>
            <script type="text/javascript">
            var chart1; // globally available
            $(document).ready(function() {
               chart1 = new Highcharts.Chart({
                  chart: {
                     renderTo: 'container',
                     type: 'column'
                  },   
                  title: {
                     text: 'Grafik Penjualan gas'
                  },
                  xAxis: {
                     categories: ['nama gas']
                  },
                  yAxis: {
                     title: {
                        text: 'Jumlah'
                     }
                  },
                  series:             
                  [
                  <?php 
                  if(isset($query)){
                     while($ret = mysql_fetch_array($query)){
                        $gas=$ret['ukuran'];                     
                        $jumlah=$ret['Tot_Qty'];            
                  ?>
                        // javascript code
                        {
                           name: '<?php echo $gas; ?>',
                           data: [<?php echo $jumlah; ?>]
                        },
                     <?php } ?>
                  <?php } ?>
                  ]
               });
            });	
         </script>
<?php
      }
   }
}
?>


<?php
if ($_GET['module']=='home'){
   if ($_SESSION['leveluser']=='manajer'){
      if ($_SESSION['divisi']==2) {
?>
      <script type="text/javascript">
         var chart2; // globally available
         $(document).ready(function() {
            chart2 = new Highcharts.Chart({
               chart: {
                  renderTo: 'container2',
                  type: 'column'
               },   
               title: {
                  text: 'Grafik Pembelian gas'
               },
               xAxis: {
                  categories: ['nama gas']
               },
               yAxis: {
                  title: {
                     text: 'Jumlah'
                  }
               },
               series:             
               [
               <?php 
               if(isset($query)){
                  while($ret = mysql_fetch_array($query)){
                     $gas=$ret['ukuran']; 
                     $jumlah=$ret['Tot_Qty'];                               
               ?>
                     {
                        name: '<?php echo $gas; ?>',
                        data: [<?php echo $jumlah ?>]
                     },
                  <?php } ?>
               <?php } ?>
               ]
            });
         });	
      </script>
<?php
      }  
   }
}
?>

<script src="highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart3; // globally available
	$(document).ready(function() {
      chart3 = new Highcharts.Chart({
         chart: {
            renderTo: 'container3',
            type: 'column'
         },   
         title: {
            text: 'Grafik Penjualan'
         },
         xAxis: {
            categories: ['Tanggal']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
            <?php 
        	include "config/koneksi.php";
           $sql   = "SELECT SUM(detail_penjualan.jumlah) AS stok, DATE_FORMAT(penjualan.tgl_penjualan,'%Y/%m') AS tahun_bulan , gas.ukuran, gas.id_gas,penjualan.kode_penjualan,penjualan.tgl_penjualan 
																											FROM detail_penjualan 
																											JOIN penjualan ON penjualan.kode_penjualan=detail_penjualan.kode_penjualan
																											JOIN gas ON gas.id_gas=detail_penjualan.id_gas
																											WHERE gas.id_gas='$_GET[gas]'
																											AND penjualan.id_agen='$_GET[id]'
																											AND month(penjualan.tgl_penjualan)='$_GET[bulan]' 
																											AND year(penjualan.tgl_penjualan) = '$_GET[tahun]'
																											GROUP BY penjualan.tgl_penjualan ASC";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
            	$gas=$ret['tgl_penjualan'];                     
                 $sql_jumlah   = "SELECT SUM(detail_penjualan.jumlah) AS stok, DATE_FORMAT(penjualan.tgl_penjualan,'%Y/%m') AS tahun_bulan , gas.ukuran, gas.id_gas,penjualan.kode_penjualan,penjualan.tgl_penjualan 
																											FROM detail_penjualan 
																											JOIN penjualan ON penjualan.kode_penjualan=detail_penjualan.kode_penjualan
																											JOIN gas ON gas.id_gas=detail_penjualan.id_gas
																											WHERE gas.id_gas='$_GET[gas]'
																											AND penjualan.id_agen='$_GET[id]'
																											AND month(penjualan.tgl_penjualan)='$_GET[bulan]' 
																											AND year(penjualan.tgl_penjualan) = '$_GET[tahun]'
																											AND penjualan.tgl_penjualan='$gas'
																											GROUP BY penjualan.tgl_penjualan ASC
				 ";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['stok'];                 
                  }             
                  ?>
                  {
                      name: '<?php echo $gas; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
</body>
</html>
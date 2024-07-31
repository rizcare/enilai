<?php 

	@session_start();
  error_reporting(0);
	include 'config/connection.php';

	// if (@$_SESSION['logged'] == false) {
	// 	header('Location:login.php');
	// }
  if ($_SESSION['id_user'] == null) {
    echo "<script>alert('Harap login terlebih dahulu');window.location.href='login.php'</script>";
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:login.php');
  }

 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Nilai</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!--charts js-->
  <script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
  <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
  
  <style type="text/css">
    body{

    }
    .atas{
      color: white;
    }

    /*footer{
      margin-top: -100px;
      width: 100%;
      position: relative;
    }*/
    .wrapper{
      height: 90%;
    }
  </style>
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">RSMH</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E</b>-Nilai</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <?php if (@$_SESSION['logged'] == 1): ?>
            <li><a class="dropdown-item" href="?p=karyawan">Data Karyawan</a></li>

          <?php endif ?>
          <?php if (@$_SESSION['logged'] == null):?>
            <li class="dropdown user user-menu">
            <a href="login.php" >
              <span class="hidden-xs">Login</span>
            </a>
          </li>
          <?php endif ?>
          <?php if (@$_SESSION['logged'] == 2 || @$_SESSION['logged'] == 1): ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">
              <img src="#" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['name'] ?></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu" style="width: 100px">
              <a class="dropdown-item pull-right" href="?logout" style="color: red;margin: 10px;font-size: 20px" onclick="return confirm('Yakin Keluar?')"><i class="fa fa-circle-o text-red"></i> Logout</a>
              
            </div>
          </li>
          <?php endif ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= (@$_GET['p']=='')?'active':'' ?>">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <?php if (@$_SESSION['logged'] == 1): ?>
          <li class="treeview <?= (@$_GET['p']=='penilaian')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-clipboard"></i> <span>Penilaian Kepala Unit</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
<!--              <li><a href="?p=penilaian"><i class="fa fa-circle-o"></i> Semua Penilaian</a></li> -->			
              <li><a href="?p=penilaian&act=administrasi"><i class="fa fa-circle-o"></i>Penilaian Administrasi</a></li>
              <li><a href="?p=penilaian&act=casemix"><i class="fa fa-circle-o"></i>Penilaian Casemix</a></li>
              <li><a href="?p=penilaian&act=cs"><i class="fa fa-circle-o"></i>Penilaian Clean Service</a></li>
              <li><a href="?p=penilaian&act=driver"><i class="fa fa-circle-o"></i>Penilaian Driver</a></li>
              <li><a href="?p=penilaian&act=farmasi"><i class="fa fa-circle-o"></i>Penilaian Farmasi</a></li>
              <li><a href="?p=penilaian&act=gizi"><i class="fa fa-circle-o"></i>Penilaian Instalasi Gizi</a></li>
              <li><a href="?p=penilaian&act=humas"><i class="fa fa-circle-o"></i>Penilaian Humas Marketing</a></li>
              <li><a href="?p=penilaian&act=ibs"><i class="fa fa-circle-o"></i>Penilaian IBS</a></li>
              <li><a href="?p=penilaian&act=igd"><i class="fa fa-circle-o"></i>Penilaian IGD</a></li>
              <li><a href="?p=penilaian&act=intensif"><i class="fa fa-circle-o"></i>Penilaian Intensif</a></li>
              <li><a href="?p=penilaian&act=ipsrs"><i class="fa fa-circle-o"></i>Penilaian IPSRS</a></li>
              <li><a href="?p=penilaian&act=it"><i class="fa fa-circle-o"></i>Penilaian IT</a></li>
              <li><a href="?p=penilaian&act=kesling"><i class="fa fa-circle-o"></i>Penilaian Kesling</a></li>
              <li><a href="?p=penilaian&act=keuangan"><i class="fa fa-circle-o"></i>Penilaian Keuangan</a></li>
              <li><a href="?p=penilaian&act=lab"><i class="fa fa-circle-o"></i>Penilaian Laboratorium</a></li>
              <li><a href="?p=penilaian&act=perina"><i class="fa fa-circle-o"></i>Penilaian Perinatologi</a></li>
              <li><a href="?p=penilaian&act=ponek"><i class="fa fa-circle-o"></i>Penilaian Ponek</a></li>
              <li><a href="?p=penilaian&act=portir"><i class="fa fa-circle-o"></i>Penilaian Portir</a></li>
              <li><a href="?p=penilaian&act=radiologi"><i class="fa fa-circle-o"></i>Penilaian Radiologi</a></li>
              <li><a href="?p=penilaian&act=ranap_anak"><i class="fa fa-circle-o"></i>Penilaian Ranap Anak</a></li>
              <li><a href="?p=penilaian&act=ralan"><i class="fa fa-circle-o"></i>Penilaian Rawat Jalan</a></li>			  
              <li><a href="?p=penilaian&act=rm"><i class="fa fa-circle-o"></i>Penilaian Rekam Medis</a></li>
              <li><a href="?p=penilaian&act=rpdb"><i class="fa fa-circle-o"></i>Penilaian RPDB</a></li>
              <li><a href="?p=penilaian&act=security"><i class="fa fa-circle-o"></i>Penilaian Security</a></li>
              <li><a href="?p=penilaian&act=vk"><i class="fa fa-circle-o"></i>Penilaian VK</a></li>				  
            </ul>
          </li>		
          <li class="treeview <?= (@$_GET['p']=='user')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-user"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=user&act=create"><i class="fa fa-plus-square"></i> Buat User </a></li>
              <li><a href="?p=user"><i class="fa fa-circle-o"></i> Data User</a></li>
            </ul>
          </li>	  		  
<!--          <li class="treeview <?= (@$_GET['p']=='karyawan')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-user-secret"></i> <span>Karyawan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=karyawan"><i class="fa fa-circle-o"></i> Data Karyawan</a></li>
            </ul>
          </li>
-->		  
          <li class="treeview <?= (@$_GET['p']=='periode')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-clock-o"></i> <span>Periode Penilaian</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=periode&act=create"><i class="fa fa-plus-square"></i> Tambah data periode </a></li>
              <li><a href="?p=periode"><i class="fa fa-circle-o"></i> Data periode</a></li>
            </ul>
          </li>
<!--          <li class="treeview <?= (@$_GET['p']=='criteria')?'active':'' ?>">
            <a href="#">
              <i class="fa fa-list"></i> <span>Kinerja</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?p=criteria&act=create"><i class="fa fa-plus-square"></i> Buat Kinerja</a></li>
              <li><a href="?p=criteria"><i class="fa fa-circle-o"></i> Data Kinerja</a></li>
            </ul>
          </li>
-->
        <?php endif; ?>
        
        <?php if (@$_SESSION['logged'] == true): ?>
          <li class="header">OTHER</li>
          <li><a href="?logout" onclick="return confirm('Yakin Keluar?')"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        
        <?php 

          $page = @$_GET['p'];
          $action = @$_GET['act'];

          switch ($page) {
            case 'user':
              if ($action == "create") {
                include 'page/user/create.php';
              } else if ($action == "edit") {
                include 'page/user/edit.php';
              } else {
                include 'page/user/index.php';
              }
              break;

            case 'criteria':
              if ($action == "create") {
                include 'page/kriteria/create.php';
              } else if ($action == "edit") {
                include 'page/kriteria/edit.php';
              } else if ($action == "show") {
                include 'page/kriteria/show.php';
              } else {
                include 'page/kriteria/index.php';
              }
              break;

            case 'create_skor':
              if ($action == "edit") {
                include 'page/pemberiannilai/edit.php';
              } else {
                include 'page/pemberiannilai/create.php';
              }
              break;

            case 'karyawan':
              if ($action == "create") {
                include 'page/karyawan/create.php';
              }else if ($action == "edit") {
                include 'page/karyawan/edit.php';
              }else if ($action == "upload") {
                include 'page/karyawan/upload.php';
              } else {
                include 'page/karyawan/index.php';
              }
              break;

            case 'periode':
              if ($action == "create") {
                include 'page/periode/create.php';
              }else if ($action == "edit") {
                include 'page/periode/edit.php';
              }else{
                include 'page/periode/index.php';
              }
              break;

            case 'penilaian':
// ponek			
              if ($action == "ponek") {				  
                include 'page/penilaian/ponek/ponek.php';
              }else if ($action == "nilai_ponek") {
                include 'page/penilaian/ponek/nilai_ponek.php';
// administrasi				
              }else if ($action == "administrasi") {				  				  
                include 'page/penilaian/administrasi/administrasi.php';
              }else if ($action == "nilai_administrasi") {
                include 'page/penilaian/administrasi/nilai_administrasi.php';
// casemix				
              }else if ($action == "casemix") {				  				  
                include 'page/penilaian/casemix/casemix.php';
              }else if ($action == "nilai_casemix") {
                include 'page/penilaian/casemix/nilai_casemix.php';
// cs				
              }else if ($action == "cs") {				  				  
                include 'page/penilaian/cs/cs.php';
              }else if ($action == "nilai_cs") {
                include 'page/penilaian/cs/nilai_cs.php';
// driver				
              }else if ($action == "driver") {				  				  
                include 'page/penilaian/driver/driver.php';
              }else if ($action == "nilai_driver") {
                include 'page/penilaian/driver/nilai_driver.php';
// farmasi				
              }else if ($action == "farmasi") {				  				  
                include 'page/penilaian/farmasi/farmasi.php';
              }else if ($action == "nilai_farmasi") {
                include 'page/penilaian/farmasi/nilai_farmasi.php';
// gizi				
              }else if ($action == "gizi") {				  				  
                include 'page/penilaian/gizi/gizi.php';
              }else if ($action == "nilai_gizi") {
                include 'page/penilaian/gizi/nilai_gizi.php';
// humas marketing				
              }else if ($action == "humas") {				  				  
                include 'page/penilaian/humas/humas.php';
              }else if ($action == "nilai_humas") {
                include 'page/penilaian/humas/nilai_humas.php';
// ibs				
              }else if ($action == "ibs") {				  				  
                include 'page/penilaian/ibs/ibs.php';
              }else if ($action == "nilai_ibs") {
                include 'page/penilaian/ibs/nilai_ibs.php';
// igd				
              }else if ($action == "igd") {				  				  
                include 'page/penilaian/igd/igd.php';
              }else if ($action == "nilai_igd") {
                include 'page/penilaian/igd/nilai_igd.php';
// intensif				
              }else if ($action == "intensif") {				  				  
                include 'page/penilaian/intensif/intensif.php';
              }else if ($action == "nilai_intensif") {
                include 'page/penilaian/intensif/nilai_intensif.php';
// ipsrs				
              }else if ($action == "ipsrs") {				  				  
                include 'page/penilaian/ipsrs/ipsrs.php';
              }else if ($action == "nilai_ipsrs") {
                include 'page/penilaian/ipsrs/nilai_ipsrs.php';
// it				
              }else if ($action == "it") {				  				  
                include 'page/penilaian/it/it.php';
              }else if ($action == "nilai_it") {
                include 'page/penilaian/it/nilai_it.php';
// kesling				
              }else if ($action == "kesling") {				  				  
                include 'page/penilaian/kesling/kesling.php';
              }else if ($action == "nilai_kesling") {
                include 'page/penilaian/kesling/nilai_kesling.php';
// keuangan				
              }else if ($action == "keuangan") {				  				  
                include 'page/penilaian/keuangan/keuangan.php';
              }else if ($action == "nilai_keuangan") {
                include 'page/penilaian/keuangan/nilai_keuangan.php';
// lab				
              }else if ($action == "lab") {				  				  
                include 'page/penilaian/lab/lab.php';
              }else if ($action == "nilai_lab") {
                include 'page/penilaian/lab/nilai_lab.php';
// perina				
              }else if ($action == "perina") {				  				  
                include 'page/penilaian/perina/perina.php';
              }else if ($action == "nilai_perina") {
                include 'page/penilaian/perina/nilai_perina.php';
// portir				
              }else if ($action == "portir") {				  				  
                include 'page/penilaian/portir/portir.php';
              }else if ($action == "nilai_portir") {
                include 'page/penilaian/portir/nilai_portir.php';
// radiologi				
              }else if ($action == "radiologi") {				  				  
                include 'page/penilaian/radiologi/radiologi.php';
              }else if ($action == "nilai_radiologi") {
                include 'page/penilaian/radiologi/nilai_radiologi.php';
// ranap anak				
              }else if ($action == "ranap_anak") {				  				  
                include 'page/penilaian/ranap_anak/ranap_anak.php';
              }else if ($action == "nilai_ranap_anak") {
                include 'page/penilaian/ranap_anak/nilai_ranap_anak.php';
// rm				
              }else if ($action == "rm") {				  				  
                include 'page/penilaian/rm/rm.php';
              }else if ($action == "nilai_rm") {
                include 'page/penilaian/rm/nilai_rm.php';
// rpdb				
              }else if ($action == "rpdb") {				  				  
                include 'page/penilaian/rpdb/rpdb.php';
              }else if ($action == "nilai_rpdb") {
                include 'page/penilaian/rpdb/nilai_rpdb.php';
// security				
              }else if ($action == "security") {				  				  
                include 'page/penilaian/security/security.php';
              }else if ($action == "nilai_security") {
                include 'page/penilaian/security/nilai_security.php';
// vk				
              }else if ($action == "vk") {				  				  
                include 'page/penilaian/vk/vk.php';
              }else if ($action == "nilai_vk") {
                include 'page/penilaian/vk/nilai_vk.php';
// rawat jalan				
              }else if ($action == "ralan") {				  				  
                include 'page/penilaian/ralan/ralan.php';
              }else if ($action == "nilai_vk") {
                include 'page/penilaian/ralan/nilai_ralan.php';				
// semua karyawan
              }else if ($action == "nilai") {				  
                include 'page/penilaian/semua_karyawan/penilaian.php';
              } else {
                include 'page/penilaian/index.php';				
              }
              break;
            
            case 'TRUNCATE':
              include 'page/pus/del.php';
              break;
             case 'apus-import':
              include 'page/pus/imp.php';
              break;
            

            case 'alternatif':
              if(@$_GET['d']!="")
                include 'page/alternatif/index.php';
              else
                //include 'page/alternatif/pilihstatus.php';
                include 'page/alternatif/index.php';
              break;

            case 'report':
              include 'page/laporan/index.php';
              break;

            case 'rank':
              include 'page/peringkat/index.php';
              break;  

            case 'fuzzy':
              include 'page/fuzzy/index.php';
              break; 

            case 'fuzzy-upload':
              include 'page/fuzzy/upload.php';   
              break;        
            
            default:
              include 'page/dashboard.php';
              break;
          }

         ?>      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
  </footer>

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

</body>
</html>

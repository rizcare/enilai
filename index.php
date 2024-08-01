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
    body {}

    .atas {
      color: white;
    }

    /*footer{
      margin-top: -100px;
      width: 100%;
      position: relative;
    }*/
    .wrapper {
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

            <?php if (@$_SESSION['logged'] == 1) : ?>
              <li><a class="dropdown-item" href="?p=karyawan">Data Karyawan</a></li>

            <?php endif ?>
            <?php if (@$_SESSION['logged'] == null) : ?>
              <li class="dropdown user user-menu">
                <a href="login.php">
                  <span class="hidden-xs">Login</span>
                </a>
              </li>
            <?php endif ?>
            <?php if (@$_SESSION['logged'] == true) : ?>
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
          <li class="<?= (@$_GET['p'] == '') ? 'active' : '' ?>">
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <!-- admin -->
          <?php if (@$_SESSION['logged'] == 1) : ?>
            <li class="treeview <?= (@$_GET['p'] == 'penilaian') ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-clipboard"></i> <span>Penilaian Kepala Unit</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?p=penilaian"><i class="fa fa-circle-o"></i> Semua Penilaian</a></li>
              </ul>
            </li>
            <li class="treeview <?= (@$_GET['p'] == 'user') ? 'active' : '' ?>">
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
            <li class="treeview <?= (@$_GET['p'] == 'karyawan') ? 'active' : '' ?>">
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

            <li class="treeview <?= (@$_GET['p'] == 'periode') ? 'active' : '' ?>">
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
            <li class="treeview <?= (@$_GET['p'] == 'criteria') ? 'active' : '' ?>">
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
          <?php endif; ?>
          <!-- administrasi -->
          <?php if (@$_SESSION['logged'] == 2) : ?>
            <li><a href="?p=penilaian&act=administrasi"><i class="fa fa-circle-o"></i>Penilaian Administrasi</a></li>
          <?php endif; ?>
          <!-- Casemix -->
          <?php if (@$_SESSION['logged'] == 3) : ?>
            <li><a href="?p=penilaian&act=Casemix"><i class="fa fa-circle-o"></i>Penilaian Casemix</a></li>
          <?php endif; ?>
          <!-- Clean Service -->
          <?php if (@$_SESSION['logged'] == 4) : ?>
            <li><a href="?p=penilaian&act=Clean. Service"><i class="fa fa-circle-o"></i>Penilaian Clean Service</a></li>
          <?php endif; ?>
          <!-- Driver -->
          <?php if (@$_SESSION['logged'] == 5) : ?>
            <li><a href="?p=penilaian&act=Driver"><i class="fa fa-circle-o"></i>Penilaian Driver</a></li>
          <?php endif; ?>
          <!-- Farmasi -->
          <?php if (@$_SESSION['logged'] == 6) : ?>
            <li><a href="?p=penilaian&act=Farmasi"><i class="fa fa-circle-o"></i>Penilaian Farmasi</a></li>
          <?php endif; ?>
          <!-- Gizi -->
          <?php if (@$_SESSION['logged'] == 7) : ?>
            <li><a href="?p=penilaian&act=Instalasi Gizi"><i class="fa fa-circle-o"></i>Penilaian Instalasi Gizi</a></li>
          <?php endif; ?>
          <!-- Humas Marketing -->
          <?php if (@$_SESSION['logged'] == 8) : ?>
            <li><a href="?p=penilaian&act=Humas Marketing"><i class="fa fa-circle-o"></i>Penilaian Humas Marketing</a></li>
          <?php endif; ?>
          <!-- IBS -->
          <?php if (@$_SESSION['logged'] == 9) : ?>
            <li><a href="?p=penilaian&act=IBS"><i class="fa fa-circle-o"></i>Penilaian IBS</a></li>
          <?php endif; ?>
          <!-- IGD -->
          <?php if (@$_SESSION['logged'] == 10) : ?>
            <li><a href="?p=penilaian&act=IGD"><i class="fa fa-circle-o"></i>Penilaian IGD</a></li>
          <?php endif; ?>
          <!-- Intensif -->
          <?php if (@$_SESSION['logged'] == 11) : ?>
            <li><a href="?p=penilaian&act=Intensif"><i class="fa fa-circle-o"></i>Penilaian Intensif</a></li>
          <?php endif; ?>
          <!-- IPSRS -->
          <?php if (@$_SESSION['logged'] == 12) : ?>
            <li><a href="?p=penilaian&act=IPSRS"><i class="fa fa-circle-o"></i>Penilaian IPSRS</a></li>
          <?php endif; ?>
          <!-- IT -->
          <?php if (@$_SESSION['logged'] == 13) : ?>
            <li><a href="?p=penilaian&act=IT"><i class="fa fa-circle-o"></i>Penilaian IT</a></li>
          <?php endif; ?>
          <!-- Laboratorium -->
          <?php if (@$_SESSION['logged'] == 14) : ?>
            <li><a href="?p=penilaian&act=Laboratorium"><i class="fa fa-circle-o"></i>Penilaian Laboratorium</a></li>
          <?php endif; ?>
          <!-- Perinatologi -->
          <?php if (@$_SESSION['logged'] == 15) : ?>
            <li><a href="?p=penilaian&act=Perinatologi"><i class="fa fa-circle-o"></i>Penilaian Perinatologi</a></li>
          <?php endif; ?>
          <!-- Ponek -->
          <?php if (@$_SESSION['logged'] == 16) : ?>
            <li><a href="?p=penilaian&act=PONEK"><i class="fa fa-circle-o"></i>Penilaian Ponek</a></li>
          <?php endif; ?>
          <!-- Radiologi -->
          <?php if (@$_SESSION['logged'] == 17) : ?>
            <li><a href="?p=penilaian&act=Radiologi"><i class="fa fa-circle-o"></i>Penilaian Radiologi</a></li>
          <?php endif; ?>
          <!-- Ranap Anak -->
          <?php if (@$_SESSION['logged'] == 18) : ?>
            <li><a href="?p=penilaian&act=Ranap Anak"><i class="fa fa-circle-o"></i>Penilaian Ranap Anak</a></li>
          <?php endif; ?>
          <!-- Rawat Jalan -->
          <?php if (@$_SESSION['logged'] == 19) : ?>
            <li><a href="?p=penilaian&act=Rawat Jalan"><i class="fa fa-circle-o"></i>Penilaian Rawat Jalan</a></li>
          <?php endif; ?>
          <!-- Rekam Medis -->
          <?php if (@$_SESSION['logged'] == 20) : ?>
            <li><a href="?p=penilaian&act=Rekam Medis"><i class="fa fa-circle-o"></i>Penilaian Rekam Medis</a></li>
          <?php endif; ?>
          <!-- RPDB -->
          <?php if (@$_SESSION['logged'] == 21) : ?>
            <li><a href="?p=penilaian&act=RPDB"><i class="fa fa-circle-o"></i>Penilaian RPDB</a></li>
          <?php endif; ?>
          <!-- Security -->
          <?php if (@$_SESSION['logged'] == 22) : ?>
            <li><a href="?p=penilaian&act=Security"><i class="fa fa-circle-o"></i>Penilaian Security</a></li>
          <?php endif; ?>
          <!-- VK -->
          <?php if (@$_SESSION['logged'] == 23) : ?>
            <li><a href="?p=penilaian&act=VK"><i class="fa fa-circle-o"></i>Penilaian VK</a></li>
          <?php endif; ?>
          <!-- SDM -->
          <?php if (@$_SESSION['logged'] == 24) : ?>
            <li><a href="?p=pemberiannilai"><i class="fa fa-circle-o"></i>Penilaian SDM</a></li>
          <?php endif; ?>		  


          <?php if (@$_SESSION['logged'] == true) : ?>
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

          case 'pemberiannilai':
            if ($action == "nilai_sdm") {
              include 'page/pemberiannilai/nilai_sdm.php';
            } else {
              include 'page/pemberiannilai/index.php';
            }
            break;

          case 'karyawan':
            if ($action == "create") {
              include 'page/karyawan/create.php';
            } else if ($action == "edit") {
              include 'page/karyawan/edit.php';
            } else if ($action == "upload") {
              include 'page/karyawan/upload.php';
            } else {
              include 'page/karyawan/index.php';
            }
            break;

          case 'periode':
            if ($action == "create") {
              include 'page/periode/create.php';
            } else if ($action == "edit") {
              include 'page/periode/edit.php';
            } else {
              include 'page/periode/index.php';
            }
            break;

          case 'penilaian':
            if (isset($_GET['id'])) {
              include 'page/penilaian/penilaian.php';
            } else if ($action == "nilai_sdm") {
              include 'page/penilaian/nilai_sdm.php';			  
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
            if (@$_GET['d'] != "")
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
    $(function() {
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
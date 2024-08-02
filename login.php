<?php 

  @session_start();
  include 'config/connection.php';
 error_reporting(0);
  if (isset($_POST['sigin'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "select * from pegawai_user where username='$user' and password='$pass'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
      if ($data['level']=='admin') {
        $_SESSION['logged'] = 1;
      }elseif ($data['level']=='kepala_unit_administrasi') {
       $_SESSION['logged'] = 2;
      }elseif ($data['level']=='kepala_unit_casemix') {
       $_SESSION['logged'] = 3;
      }elseif ($data['level']=='kepala_unit_cs') {
       $_SESSION['logged'] = 4;
      }elseif ($data['level']=='kepala_unit_driver') {
       $_SESSION['logged'] = 5;
      }elseif ($data['level']=='kepala_unit_farmasi') {
       $_SESSION['logged'] = 6;
      }elseif ($data['level']=='kepala_unit_gizi') {
       $_SESSION['logged'] = 7;
      }elseif ($data['level']=='kepala_unit_humas_marketing') {
       $_SESSION['logged'] = 8;
      }elseif ($data['level']=='kepala_unit_ibs') {
       $_SESSION['logged'] = 9;
      }elseif ($data['level']=='kepala_unit_igd') {
       $_SESSION['logged'] = 10;
      }elseif ($data['level']=='kepala_unit_intensif') {
       $_SESSION['logged'] = 11;
      }elseif ($data['level']=='kepala_unit_ipsrs') {
       $_SESSION['logged'] = 12;
      }elseif ($data['level']=='kepala_unit_it') {
       $_SESSION['logged'] = 13;
      }elseif ($data['level']=='kepala_unit_laboratorium') {
       $_SESSION['logged'] = 14;
      }elseif ($data['level']=='kepala_unit_perinatologi') {
       $_SESSION['logged'] = 15;
      }elseif ($data['level']=='kepala_unit_ponek') {
       $_SESSION['logged'] = 16;
      }elseif ($data['level']=='kepala_unit_radiologi') {
       $_SESSION['logged'] = 17;
      }elseif ($data['level']=='kepala_unit_ranap_anak') {
       $_SESSION['logged'] = 18;
      }elseif ($data['level']=='kepala_unit_rawat_jalan') {
       $_SESSION['logged'] = 19;
      }elseif ($data['level']=='kepala_unit_rekam_medis') {
       $_SESSION['logged'] = 20;
      }elseif ($data['level']=='kepala_unit_rpdb') {
       $_SESSION['logged'] = 21;
      }elseif ($data['level']=='kepala_unit_security') {
       $_SESSION['logged'] = 22;
      }elseif ($data['level']=='kepala_unit_vk') {
       $_SESSION['logged'] = 23;
      }elseif ($data['level']=='SDM') {
       $_SESSION['logged'] = 24;
      }elseif ($data['level']=='kabag_keuangan') {
       $_SESSION['logged'] = 25;
      }elseif ($data['level']=='kabag_sdm') {
       $_SESSION['logged'] = 26;
      }elseif ($data['level']=='kabag_umum') {
       $_SESSION['logged'] = 27;
      }elseif ($data['level']=='kabid_pelayanan') {
       $_SESSION['logged'] = 28;
      }elseif ($data['level']=='kabid_penunjang') {
       $_SESSION['logged'] = 29;
      }elseif ($data['level']=='wadir_pelayanan') {
       $_SESSION['logged'] = 30;
      }elseif ($data['level']=='wadir_umum') {
       $_SESSION['logged'] = 31;
      }elseif ($data['level']=='direktur') {
       $_SESSION['logged'] = 32;	   
      }else{
        $_SESSION['logged'] = null;
      }
      //$_SESSION['logged'] = 1;
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['name'] = $data['nama'];
      
      echo "<script>alert('Login berhasil!');window.location.href='index.php'</script>";  

    }
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Kinerja</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Fuzzy</b>AHP</a> -->
    <img src="assets/img/logo.jpeg" width="300px">
  </div>
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="sigin">Sign In</button>
          <div class="" style="margin-top: 10px;">
            <a href="index.php">Kembali ke Halaman utama?</a>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

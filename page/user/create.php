<?php 

	if (isset($_POST['simpan'])) {
		$nik     = $_POST['nik'];
		$nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Level    = $_POST['Level'];

		$sql = "insert into pegawai_user values(null,'$nik', '$nama', '$username', '$password', '$Level')";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=user'</script>";
		} else {
			echo "Error : " . mysqli_error($con);
		}
	}

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form User</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NIP</label>
              <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukan NIP" name="nik" required>
            </div>		  
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password" name="password" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Level</label>
              <select name="Level" class="form-control">
                <option selected disabled>-- Pilih Level --</option>
                <option value="admin">Admin</option>
                <option value="kanit">Kepala Unit</option>
                <option value="kabag">Kepala Bagian</option>
                <option value="sdm">Sumber Daya Manusia</option>
                <option value="wadir">Wakil direktur</option>
                <option value="direktur">Direktur</option>				
              </select>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->
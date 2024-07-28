<?php 

	if (isset($_POST['simpan'])) {

    $kriteria = $_POST['kriteria'];
    $bidang = $_POST['bidang'];

		$sql = "insert into pegawai_kriteria values(null,'$kriteria', '$bidang')";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=criteria&act=create'</script>";
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
          <h3 class="box-title">Form Sikap Kerja</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->		
        <form role="form" method="post">
          <div class="box-body">		  
            <div class="form-group">
              <label for="exampleInputEmail1">Kinerja</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Kinerja" name="kriteria" required>
            </div>
            <div class="form-group">
             <label for="bidang">Bidang</label>			
            <select name="bidang" id="bidang" class="form-control input-lg">
                <?php
                $query    =mysqli_query($con, "SELECT * FROM bidang ORDER BY nama");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$data['nama'];?>"><?php echo $data['nama'];?></option>
                <?php
                }
                ?>
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

  <script src="assets/jquery.js"></script>
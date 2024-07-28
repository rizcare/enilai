<?php 

  $id = $_GET['id'];
  $sql = "select * from pegawai_kriteria where id_kriteria='$id'";
  $query = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($query);


  if (isset($_POST['simpan'])) {

    $kriteria = $_POST['kriteria'];
    $bidang = $_POST['bidang'];

    $sql = "update pegawai_kriteria set kriteria='$kriteria', bidang='$bidang' where id_kriteria='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=criteria'</script>";
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
          <h3 class="box-title">Form Kinerja</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="kriteria">Kinerja</label>
              <textarea type="text" class="form-control input-lg" id="kriteria" name="kriteria" required><?= $data['kriteria'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="viewbidang">Bidang Sebelumnya</label>
              <input type="text" class="form-control input-lg" id="viewbidang" value="<?= $data['bidang'] ?>" readonly>
            </div>			
            <div class="form-group">
             <label for="bidang">Bidang Sekarang</label>			
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
            <button type="submit" class="btn btn-primary" name="simpan">Edit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->
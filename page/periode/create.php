<?php 
  if (isset($_POST['simpan'])) {
    $periode=$_POST['periode'];
    $tahun=$_POST['tahun'];
      $label=$periode." ".$tahun;
      $cekagy=mysqli_query($con,"SELECT * from pegawai_periode where label like '".$label."'");
      if (mysqli_num_rows($cekagy) > 0) {
        echo "<script>alert('Data ".$label." Sudah Tersedia!');window.location.href='index.php?p=periode'</script>";
      }else{
        $input=mysqli_query($con,"INSERT INTO pegawai_periode values (null, '$periode','$label','$tahun')");
        if ($input == TRUE) {
          echo "<script>alert('Data ".$label." Berhasil Ditambahkan!');window.location.href='index.php?p=periode'</script>";
        }else{
          echo "<script>alert('Data ".$label." Gagal dieksekusi!');window.location.href='index.php?p=periode&act=create'</script>";
        }
      }   
  }

 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form input Periode</h3>
          
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Periode</label>
              <select name="periode" class="form-control input-lg" required>
                <option value="SEMESTER 1">SEMESTER 1</option>
                <option value="SEMESTER 2">SEMESTER 2</option>				
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tahun</label>
              <input type="number" class="form-control input-lg" id="exampleInputEmail1" placeholder="Tahun tahun" name="tahun" value="<?php echo date('Y'); ?>" required>
              
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

  </div>

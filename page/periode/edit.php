<?php 
if (isset($_POST['simpan'])) {
    $periode=$_POST['periode'];
    $tahun=$_POST['tahun'];
    $label=$periode." ".$tahun;
      $update=mysqli_query($con,"UPDATE pegawai_periode set periode='$periode', label='$label', tahun='$tahun' where id_periode='".$_GET['id']."'");
        if ($update == TRUE) {
          echo "<script>alert('Data ".$label." Berhasil Diubah!');window.location.href='index.php?p=periode'</script>";
        }else{
          echo "<script>alert('Data ".$label." Gagal dieksekusi!');window.location.href='index.php?p=periode&act=edit&id=".$_GET['id']."'</script>";
        }
      

}
$edit=mysqli_query($con,"SELECT * from pegawai_periode where id_periode = '".$_GET['id']."'");
$r=mysqli_fetch_array($edit);


 ?>
<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form edit Periode <?php echo $r['label'].' ';?></h3>
          
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
            <button type="submit" class="btn btn-primary" name="simpan">Edit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>

  </div>

<?php 

	$id = $_GET['id'];
  $sql = "select * from pegawai where id='$id'";
  $query = mysqli_query($con, $sql);
  $peg = mysqli_fetch_array($query);


  if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $sql = "update pegawai_user set nik='$nik', nama='$nama', username='$username', password='$password', Level='$level' where id_user='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=user'</script>";
    } else {
      echo "Error : " . mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
<!--        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">NIP</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan NIP" name="nik" required value="<?= $data['nik'] ?>">
            </div>		  
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama" name="nama" required value="<?= $data['nama'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Username" name="username" required value="<?= $data['username'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password" name="password" required value="<?= $data['password'] ?>">
            </div>
            <div class="form-group">
              <label>Level</label>
              <select name="level" class="form-control custom-select">
                <option disabled>-- Pilih Level --</option>
                <option value="admin" <?= ($data['level']=='admin')?'selected':'' ?>>Admin</option>
                <option value="kanit" <?= ($data['level']=='kanit')?'selected':'' ?>>Kepala Unit</option>
                <option value="kabag" <?= ($data['level']=='kabag')?'selected':'' ?>>Kepala Bagian</option>
                <option value="sdm" <?= ($data['level']=='sdm')?'selected':'' ?>>Sumber Daya Manusia</option>
                <option value="wadir" <?= ($data['level']=='wadir')?'selected':'' ?>>Wakil Direktur</option>
                <option value="direktur" <?= ($data['level']=='direktur')?'selected':'' ?>>Direktur</option>				
              </select>
            </div>
          </div>
-->		  
          <!-- /.box-body -->
<!--          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
-->

    <header style="display: flex; justify-content: end;">
	<div style="width: 50%;"align="center">
		<img src="assets/img/logokajian.png" align="center" width="180" height="90" class="img-profil" style="width:55%;">
	</div>
	
        <div style="width: 50%;">
            <table cellspacing="0" cellpadding="5" style="width: 100%;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;">
                <tr>
                    <td colspan="4" style="background-color:#005456; color:#fff; text-align: center;font-weight: bold;">
                        IDENTIFIKASI Pegawai
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;" width="30%">Nama</th>
                    <th width="1%">:</th>
                    <td style="text-align: left;" width="54%"><?= $peg['nama'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;" width="30%">NIP</th>
                    <th width="1%">:</th>
                    <td style="text-align: left;" width="54%"><?= $peg['nik'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Jabatan</th>
                    <th>:</th>
                    <td style="text-align: left;"><?= $peg['jbtn'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">Mulai Kerja</th>
                    <th>:</th>
                    <td style="text-align: left;"><?= $peg['mulai_kerja'] ?></td>
                </tr>				
            </table>
        </div>
    </header>
    <section>
        <table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
            <tr>
                <td colspan="9" style="background-color:#005456; color:#fff; text-align: center;font-weight: bold;">
                    PENILAIAN KINERJA RUMAH SAKIT MITRA HUSADA
                </td>
            </tr>
        </table>
        <table border="1" cellspacing="0" cellpadding="4" style="width: 100%;">
            <tr bgcolor="#f3f2f2">
                <td rowspan="3" width="3%" style="font-size: 13px;" align="center">NO</td>
                <td rowspan="3" width="37%" style="font-size: 13px;" align="center">KOMPONEN PENELITIAN KINERJA</td>
                <td colspan="5" width="50%" style="font-size: 13px;" align="center">NILAI</td>
            </tr>
            <tr bgcolor="#f3f2f2">
                <td width="5%" align="center">SK</td>
                <td width="5%" align="center">K</td>
                <td width="5%" align="center">C</td>
                <td width="5%" align="center">B</td>
                <td width="5%" align="center">SB</td>				
            </tr>
            <tr bgcolor="#f3f2f2">
                <td width="5%" align="center">1</td>
                <td width="5%" align="center">2</td>
                <td width="5%" align="center">3</td>
                <td width="5%" align="center">4</td>
                <td width="5%" align="center">5</td>				
            </tr>
            <tr>
            <tr>
                <td align="center">1</td>
                <td>apaaaa</td>						
                <td align="center">2</td>
                <td align="center">3</td>
                <td align="center">4</td>
                <td align="center">5</td>
                <td align="center">1</td>			
            </tr>			
        </table>		
        <br>
          <div class="box-footer" align="right">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>		
    </section>	
   </div>
      <!-- /.box -->


  </div>
    <!--/.col (left) -->
    
</div>
  <!-- /.row -->
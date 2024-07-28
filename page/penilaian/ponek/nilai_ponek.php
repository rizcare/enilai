<?php 

	$id = $_GET['id'];
  $sql = "select * from pegawai where id='$id'";
  $query = mysqli_query($con, $sql);
  $peg = mysqli_fetch_array($query);


  if (isset($_POST['simpan'])) {
    $id_kriteria = $_POST['id_kriteria'];
    $periode = $_POST['periode'];
    $tgl_jam = $_POST['tgl_jam'];
    $nip = $_POST['nip'];
    $nilai = $_POST['nilai'];
    $penilai = $_POST['penilai'];	
	
	$sql = "insert into pegawai_nilai_kerja values('$id_kriteria', '$periode', '$tgl_jam', '$nip', '$nilai', '$penilai')";
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
                    <th style="text-align: left;" width="30%">&nbsp;Nama</th>
                    <th width="1%">:</th>
                    <td style="text-align: left;" width="54%"><?= $peg['nama'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;" width="30%">&nbsp;NIP</th>
                    <th width="1%">:</th>
                    <td style="text-align: left;" width="54%"><?= $peg['nik'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">&nbsp;Jabatan</th>
                    <th>:</th>
                    <td style="text-align: left;"><?= $peg['jbtn'] ?></td>
                </tr>
                <tr>
                    <th style="text-align: left;">&nbsp;Mulai Kerja</th>
                    <th>:</th>
                    <td style="text-align: left;"><?= $peg['mulai_kerja'] ?></td>
                </tr>				
            </table>				
        </div>
    </header>
<form role="form" method="post">	
    <section>	
        <table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
            <tr>
                <td colspan="9" style="background-color:#005456; color:#fff; text-align: center;font-weight: bold;">
                    PENILAIAN KINERJA RUMAH SAKIT MITRA HUSADA
                </td>
            </tr>
        </table>
				<div>	
					<select name="periode" id="periode" class="form-control input">
						<?php
							$query    =mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
							while ($period = mysqli_fetch_array($query)) {
						?>
							<option align="center" value="<?=$period['id_periode'];?>"><?php echo $period['label'];?></option>
						<?php
							}
						?>
					</select>
				</div>		
        <table border="1" cellspacing="0" cellpadding="4" style="width: 100%;">
            <tr bgcolor="#f3f2f2">
                <td rowspan="3" width="3%" style="font-size: 13px;" align="center">NO</td>
                <td rowspan="3" width="87%" style="font-size: 13px;" align="center">KOMPONEN PENELITIAN KINERJA</td>
                <td colspan="5" width="10%" style="font-size: 13px;" align="center">NILAI</td>
            </tr>
            <tr bgcolor="#f3f2f2">
                <td width="2%" align="center">SK</td>
                <td width="2%" align="center">K</td>
                <td width="2%" align="center">C</td>
                <td width="2%" align="center">B</td>
                <td width="2%" align="center">SB</td>				
            </tr>
            <tr bgcolor="#f3f2f2">
                <td align="center">1</td>
                <td align="center">2</td>
                <td align="center">3</td>
                <td align="center">4</td>
                <td align="center">5</td>				
            </tr>
            <tr bgcolor="#abfead">
                <td align="center"><b>A.<b></td>
                <td colspan="6"><b>Sikap Kerja<b></td>	
            </tr>			
                <?php
                $query    =mysqli_query($con, "SELECT * FROM pegawai_sikap ORDER BY id_sikap");
				$no=0;
                while ($sikap = mysqli_fetch_array($query)) {
				$no++;	
                ?>			
            <tr>
                <td align="center"><?php echo $no;?></td>
                <td name="id_kriteria[]" id="id_kriteria">&nbsp;<?php echo $sikap['nama_sikap'];?></td>
                <td colspan="5" align="center">
				  <select align="center" name="nilai[]" class="form-control custom-select">
					<option value=""selected></option>					
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>					
				  </select>				
				</td>				
            </tr>
                <?php
                }
                ?>
            <tr bgcolor="#abfead">
                <td align="center"><b>B.<b></td>
                <td colspan="6"><b>Kinerja Pelayanan<b></td>	
            </tr>				
                <?php
                $query    =mysqli_query($con, "SELECT * FROM pegawai_kriteria where bidang='Ponek' ORDER BY id_kriteria");
				$no=0;
                while ($pel = mysqli_fetch_array($query)) {
				$no++;	
                ?>				
            <tr>
                <td align="center"><?php echo $no;?></td>							
                <td name="id_kriteria[]" id="id_kriteria">&nbsp;<?php echo $pel['kriteria'];?></td>
                <td colspan="5" align="center">
				  <select align="center" name="nilai[]" class="form-control custom-select">
					<option value=""></option>					
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>					
				  </select>				
				</td>
				
            </tr>
                <?php
                }
                ?>
            <tr>
                <td colspan="2" align="center"><b>Jumlah Nilai</b></td>							
                <td colspan="5" align="center"></td>
				
            </tr>				
        </table>
		<br>
    <footer style="display: flex; justify-content: end;">	
          <div style="width: 50%;" align="left">
			<b>
			Keterangan : 
			(
			<font color="#bd1e1e">SK</font> = <font color="#bd1e1e">Sangat Kurang</font>,
			<font color="#ca862d"> K</font> = <font color="#ca862d">Kurang</font>,
			<font color="orange"> C</font> = <font color="orange">Cukup</font>,
			<font color="#50b86b"> B</font> = <font color="#50b86b">Baik</font>,
			<font color="#0a8a2b"> SB</font> = <font color="#0a8a2b">Sangat Baik</font>
			)
			</b>
          </div>		
          <div style="width: 50%;" align="right">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
	</footer>	  
		<br>		  
    </section>
</form>	
   </div>
      <!-- /.box -->


  </div>
    <!--/.col (left) -->
    
</div>
  <!-- /.row -->
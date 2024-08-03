<?php
include_once '../../../config/connection.php';

session_start();
date_default_timezone_set('Asia/Jakarta');
$idUser = $_SESSION['id_user'];
$id = $_GET['id'];
$getPeriode = $_GET['periode'] ?? 'SEMESTER 1 2024'; // pertama kali di buka

// user penilai
$sqlUser = "select * from pegawai_user
			left join pegawai on pegawai.nik = pegawai_user.nik
			where id_user='$idUser'";
$queryUser = mysqli_query($con, $sqlUser);

// user dinilai
$sql = "select * from pegawai where id='$id'";
$query = mysqli_query($con, $sql);

$peg = mysqli_fetch_array($query);
$user = mysqli_fetch_array($queryUser);

$bidang = $peg['bidang'];
$nip = $peg['nik'];
$penilai = $user['nik'];

	if (isset($_POST['simpan'])) {

    $periode = $_POST['periode'];
    $tgl_jam = date('Y-m-d H:i:s'); // waktu sekarang
    $sakit = $_POST['sakit'];
	$keterlambatan = $_POST['keterlambatan'];
	$pulang_cepat = $_POST['pulang_cepat'];
	$pelanggaran_ringan = $_POST['pelanggaran_ringan'];
	$pelanggaran_sedang = $_POST['pelanggaran_sedang'];
	$pelanggaran_berat = $_POST['pelanggaran_berat'];
	$sp1 = $_POST['sp1'];
	$sp2 = $_POST['sp2'];
	$sp3 = $_POST['sp3'];
	$catatan = $_POST['catatan'];

		$sql = "insert into pegawai_nilai_sdm values(null,'$periode', '$tgl_jam', '$nip', '$sakit', '$keterlambatan', '$pulang_cepat', '$pelanggaran_ringan', '$pelanggaran_sedang', '$pelanggaran_berat', '$sp1', '$sp2', '$sp3', '$catatan', '$penilai')";
		$sdm = mysqli_query($con, $sql);
		if ($sdm) {
			echo "<script>alert('Data berhasil diubah!')</script>";
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


            <header style="display: flex; justify-content: end;">
                <div style="width: 50%;" align="center">
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

                    <div style="display: flex; justify-content: end;">
                        <div style="width: 50%;" align="left">
                            <input align="center" class="form-control input" value="Penilai : <?= $user['nama']; ?>" readonly></input>
                        </div>
                        <div style="width: 50%;" align="right">
                            <select name="periode" id="periode" class="form-control input" onchange="changePeriode(this)">
                                <?php
                                $query    = mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
                                while ($period = mysqli_fetch_array($query)) {
                                ?>
                                    <option align="center" <?= $getPeriode == $period['label'] ? 'selected' : '' ?> value="<?= $period['label']; ?>"><?= $period['label']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>			
<br>
<!-- Penilaian Kepala Unit -->
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"> Penilaian Kepala Unit</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              </div><!-- /.box-tools -->
          </div>

            <div class="box-body table-responsive collapse">
                    <div style="display: flex; justify-content: end;">
                        <div style="width: 50%;" align="left">
                            <input align="center" class="form-control input" value="Penilai : <?= $user['nama']; ?>" readonly></input>
                        </div>
                        <div style="width: 50%;" align="right">
                            <select name="periode" id="periode" class="form-control input" onchange="changePeriode(this)">
                                <?php
                                $query    = mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
                                while ($period = mysqli_fetch_array($query)) {
                                ?>
                                    <option align="center" <?= $getPeriode == $period['label'] ? 'selected' : '' ?> value="<?= $period['label']; ?>"><?= $period['label']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>			
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
                        $query    = mysqli_query($con, "SELECT * FROM pegawai_sikap ORDER BY id_sikap");
                        $no = 0;
                        while ($sikap = mysqli_fetch_array($query)) {
                            $no++;
                            $sikap_id = $sikap['id_sikap'];
                            $query_sikap = mysqli_query($con, "SELECT * FROM pegawai_nilai_sikap WHERE id_sikap=$sikap_id AND nip=$nip AND penilai=$penilai AND periode='$getPeriode'");
                            $nilai_sikap = mysqli_fetch_assoc($query_sikap);
                        ?>
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td>
                                    <a type="text" class="form-control input" ><?= $sikap['nama_sikap'] ?></a>
                                </td>
                                <td colspan="5" align="center">
                                    <select align="center" class="form-control custom-select">
                                        <option value="" selected></option>
                                        <option value="1" <?= $nilai_sikap['nilai'] == '1' ? 'selected' : ''; ?>>1</option>
                                        <option value="2" <?= $nilai_sikap['nilai'] == '2' ? 'selected' : ''; ?>>2</option>
                                        <option value="3" <?= $nilai_sikap['nilai'] == '3' ? 'selected' : ''; ?>>3</option>
                                        <option value="4" <?= $nilai_sikap['nilai'] == '4' ? 'selected' : ''; ?>>4</option>
                                        <option value="5" <?= $nilai_sikap['nilai'] == '5' ? 'selected' : ''; ?>>5</option>
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
                        $query    = mysqli_query($con, "SELECT * FROM pegawai_kriteria where bidang='$bidang' ORDER BY id_kriteria");
                        $no = 0;
                        while ($kriteria = mysqli_fetch_array($query)) {
                            $no++;
                            $kriteria_id = $kriteria['id_kriteria'];
                            $query_kriteria = mysqli_query($con, "SELECT * FROM pegawai_nilai_kerja WHERE id_kriteria=$kriteria_id AND nip=$nip AND penilai=$penilai AND periode='$getPeriode'");
                            $nilai_kriteria = mysqli_fetch_assoc($query_kriteria);
                        ?>
                            <input type="hidden" value="<?= $kriteria['id_kriteria']; ?>">
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td>
                                    <a type="text" class="form-control input"><?= $kriteria['kriteria'] ?></a>
                                </td>
                                <td colspan="5" align="center">
                                    <select align="center" class="form-control custom-select">
                                        <option value="" selected></option>
                                        <option value="1" <?= $nilai_kriteria['nilai'] == '1' ? 'selected' : ''; ?>>1</option>
                                        <option value="2" <?= $nilai_kriteria['nilai'] == '2' ? 'selected' : ''; ?>>2</option>
                                        <option value="3" <?= $nilai_kriteria['nilai'] == '3' ? 'selected' : ''; ?>>3</option>
                                        <option value="4" <?= $nilai_kriteria['nilai'] == '4' ? 'selected' : ''; ?>>4</option>
                                        <option value="5" <?= $nilai_kriteria['nilai'] == '5' ? 'selected' : ''; ?>>5</option>
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
                        <div>
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
            </div>
      </div>
<!-- Penilaian SDM -->
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Penilaian SDM</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              </div><!-- /.box-tools -->
          </div>

            <div class="box-body table-responsive collapse">
                    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                        <tr>
                            <td colspan="9" style="background-color:#005456; color:#fff; text-align: center;font-weight: bold;">
                                PENILAIAN KINERJA RUMAH SAKIT MITRA HUSADA
                            </td>
                        </tr>
                    </table>
                    <div style="display: flex; justify-content: end;">
                        <div style="width: 50%;" align="left">
                            <input align="center" class="form-control input" value="Penilai : <?= $user['nama']; ?>" readonly></input>
                        </div>
                        <div style="width: 50%;" align="right">
                            <select name="periode" id="periode" class="form-control input" onchange="changePeriode(this)">
                                <?php
                                $query    = mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
                                while ($period = mysqli_fetch_array($query)) {
                                ?>
                                    <option align="center" <?= $getPeriode == $period['label'] ? 'selected' : '' ?> value="<?= $period['label']; ?>"><?= $period['label']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <table border="1" cellspacing="0" cellpadding="4" style="width: 100%;">
                        <tr bgcolor="#f3f2f2">
                            <td width="3%" style="font-size: 13px;" align="center">NO</td>
                            <td width="70%" style="font-size: 13px;" align="center">Indikator Penilaian Kinerja</td>
                            <td width="27%" style="font-size: 13px;" align="center">NILAI</td>
                        </tr>
                        <tr bgcolor="#abfead">
                            <td align="center"><b>A.<b></td>
                            <td colspan="2"><b>&nbsp;Kedisiplinan Kehadiran<b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>&nbsp;Alfa</td>
							<td>
								<input style="text-align:center;" type="text" class="form-control" id="alfa" name="alfa" value="<?= $sdm['alfa'] ?>">							
							</td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Sakit</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="sakit" name="sakit" value="<?= $sdm['sakit'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Keterlambatan</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="keterlambatan" name="keterlambatan" value="<?= $sdm['keterlambatan'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>&nbsp;Pulang Cepat</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="pulang_cepat" name="pulang_cepat" value="<?= $sdm['pulang_cepat'] ?>">
							</td>
                        </tr>						
                        <tr bgcolor="#abfead">
                            <td align="center"><b>B.<b></td>
                            <td colspan="2"><b>&nbsp;Pelanggaran<b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>&nbsp;Pelanggaran Ringan</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="pelanggaran_ringan" name="pelanggaran_ringan" value="<?= $sdm['pelanggaran_ringan'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Pelanggaran Sedang</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="pelanggaran_sedang" name="pelanggaran_sedang" value="<?= $sdm['pelanggaran_sedang'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Pelanggaran Berat</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="pelanggaran_berat" name="pelanggaran_berat" value="<?= $sdm['pelanggaran_berat'] ?>">
							</td>
                        </tr>						
                        <tr bgcolor="#abfead">
                            <td align="center"><b>C.<b></td>
                            <td colspan="2"><b>&nbsp;Surat Peringatan<b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>&nbsp;Surat Peringatan ke 1 (satu)</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="sp1" name="sp1" value="<?= $sdm['sp1'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Surat Peringatan ke 2 (dua)</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="sp2" name="sp2" value="<?= $sdm['sp2'] ?>">
							</td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Surat Peringatan ke 3 (tiga)</td>
							<td>
							<input style="text-align:center;" type="text" class="form-control" id="sp3" name="sp3" value="<?= $sdm['sp3'] ?>">
							</td>
                        </tr>
                        <tr bgcolor="#abfead">
                            <td align="center" colspan="3"><b>&nbsp;Catatan<b></td>
                        </tr>
                        <tr bgcolor="#abfead">
							<td colspan="3">
							<textarea type="text" class="form-control" id="catatan" name="catatan" value="<?= $sdm['catatan'] ?>"></textarea>
							</td>
                        </tr>						
                    </table>
            </div>

      </div>
	  
<!-- Penilaian SDM -->
      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Penilaian Kabag</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
          </div>

            <div class="box-body table-responsive">
            <form role="form" method="post">
                    <div style="display: flex; justify-content: end;">
                        <div style="width: 50%;" align="left">
                            <input align="center" class="form-control input" value="Penilai : <?= $user['nama']; ?>" readonly></input>
                        </div>
                        <div style="width: 50%;" align="right">
                            <select name="periode" id="periode" class="form-control input" onchange="changePeriode(this)">
                                <?php
                                $query    = mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
                                while ($period = mysqli_fetch_array($query)) {
                                ?>
                                    <option align="center" <?= $getPeriode == $period['label'] ? 'selected' : '' ?> value="<?= $period['label']; ?>"><?= $period['label']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>			
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
                            <tr>
                                <td align="center">1</td>
                                <td>&nbsp;Penampilan</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td>&nbsp;Komunikasi</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td>&nbsp;Kerja Sama</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">4</td>
                                <td>&nbsp;Kordinasi</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">5</td>
                                <td>&nbsp;Motivasi Kerja</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">6</td>
                                <td>&nbsp;Kedisiplinan</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>							
                        <tr bgcolor="#abfead">
                            <td align="center"><b>B.<b></td>
                            <td colspan="6"><b>Tanggung Jawab<b></td>
                        </tr>
                            <tr>
                                <td align="center">1</td>
                                <td>&nbsp;Ketepatan waktu menyelesaikan pekerjaan</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td>&nbsp;Penerimaan atas tugas tambahan</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td>&nbsp;Inisiatif</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                        <tr bgcolor="#abfead">
                            <td align="center"><b>C.<b></td>
                            <td colspan="6"><b>Kompetensi<b></td>
                        </tr>
                            <tr>
                                <td align="center">1</td>
                                <td>&nbsp;Ketepatan pengambilan keputusan</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td>&nbsp;Pemecahan masalah</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td>&nbsp;Kemampuan dalam bekerja</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                                <td align="center">4</td>
                                <td>&nbsp;Produktifitas</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>
                                <td align="center">5</td>
                                <td>&nbsp;Kreatifitas</td>
                                <td colspan="5" align="center">
                                </td>
                            </tr>							
                        <tr>
                            <td colspan="2" align="center"><b>Jumlah Nilai</b></td>
                            <td colspan="5" align="center"></td>

                        </tr>						
                    </table>
                    <br>
                    <footer style="display: flex; justify-content: end;">
                        <div style="width: 70%;" align="left">
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
                        <div style="width: 30%;" align="right">
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                    </footer>
                    <br>
            </form>
            </div>

      </div>	  
        </div>
        <!-- /.box -->


    </div>
    <!--/.col (left) -->

</div>
<!-- /.row -->

<script>
    function changePeriode(selectElement) {
        let selectedValue = selectElement.value;
        let url = new URL(window.location.href);

        if (url.searchParams.has('periode')) {
            url.searchParams.set('periode', selectedValue);
        } else {
            url.searchParams.append('periode', selectedValue);
        }

        window.location.href = url;
    }

    console.log('<?= $getPeriode ?>');
</script>
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
            <form role="form" method="post">
                <section>
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
                    <br>
                    <footer style="display: flex; justify-content: end;">
                        <div style="width: 50%;" align="left">
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
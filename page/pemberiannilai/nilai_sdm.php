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
    $id_kriteria = $_POST['id_kriteria'];
    $id_sikap = $_POST['id_sikap'];
    $periode = $_POST['periode'];
    $tgl_jam = date('Y-m-d H:i:s'); // waktu sekarang
    $nilai = $_POST['nilai'];
    $nilai_sikap = $_POST['nilai_sikap'];

    try {
        mysqli_begin_transaction($con);
        // sikap
        for ($i = 0; $i < count($id_sikap); $i++) {
            if ($nilai_sikap[$i]) {
                // Cek apakah data sudah ada
                $result = mysqli_query($con, "SELECT * FROM pegawai_nilai_sikap WHERE id_sikap='$id_sikap[$i]' AND periode='$periode' AND nip='$nip' AND penilai='$penilai'");

                if (mysqli_num_rows($result) > 0) {
                    $query = "UPDATE pegawai_nilai_sikap SET nilai='$nilai_sikap[$i]', tgl_jam='$tgl_jam' WHERE id_sikap='$id_sikap[$i]' AND periode='$periode' AND nip='$nip' AND penilai='$penilai'";
                } else {
                    $query = "INSERT INTO pegawai_nilai_sikap (id_sikap, periode, tgl_jam, nip, nilai, penilai) VALUES ('$id_sikap[$i]', '$periode', '$tgl_jam', '$nip', '$nilai_sikap[$i]', '$penilai')";
                }

                mysqli_query($con, $query);
            }
        }

        // kriteria
        for ($i = 0; $i < count($id_kriteria); $i++) {
            if ($nilai[$i]) {
                // Cek apakah data sudah ada
                $result = mysqli_query($con, "SELECT * FROM pegawai_nilai_kerja WHERE id_kriteria='$id_kriteria[$i]' AND periode='$periode' AND nip='$nip' AND penilai='$penilai'");

                if (mysqli_num_rows($result) > 0) {
                    $query = "UPDATE pegawai_nilai_kerja SET nilai='$nilai[$i]', tgl_jam='$tgl_jam' WHERE id_kriteria='$id_kriteria[$i]' AND periode='$periode' AND nip='$nip' AND penilai='$penilai'";
                } else {
                    $query = "INSERT INTO pegawai_nilai_kerja (id_kriteria, periode, tgl_jam, nip, nilai, penilai) VALUES ('$id_kriteria[$i]', '$periode', '$tgl_jam', '$nip', '$nilai[$i]', '$penilai')";
                }

                mysqli_query($con, $query);
            }
        }
        mysqli_commit($con);

        if ($query) {
            echo "<script>alert('Data berhasil diubah!')</script>";
        } else {
            echo "Error : " . mysqli_error($con);
            mysqli_rollback($con);
        }
    } catch (\Throwable $th) {
        mysqli_rollback($con);
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
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Sakit</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Keterlambatan</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>&nbsp;Pulang Cepat</td>
							<td></td>
                        </tr>						
                        <tr bgcolor="#abfead">
                            <td align="center"><b>B.<b></td>
                            <td colspan="2"><b>&nbsp;Pelanggaran<b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>&nbsp;Pelanggaran Ringan</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Pelanggaran Sedang</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Pelanggaran Berat</td>
							<td></td>
                        </tr>						
                        <tr bgcolor="#abfead">
                            <td align="center"><b>C.<b></td>
                            <td colspan="2"><b>&nbsp;Surat Peringatan<b></td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>&nbsp;Surat Peringatan ke 1 (satu)</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">2</td>
                            <td>&nbsp;Surat Peringatan ke 2 (dua)</td>
							<td></td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>&nbsp;Surat Peringatan ke 3 (tiga)</td>
							<td></td>
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
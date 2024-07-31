<?php
include_once '../../../config/connection.php';

session_start();
date_default_timezone_set('Asia/Jakarta');
$idUser = $_SESSION['id_user'];
$id = $_GET['id'];

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
                        <select name="periode" id="periode" class="form-control input">
                            <?php
                            $query    = mysqli_query($con, "SELECT * FROM pegawai_periode ORDER BY label");
                            while ($period = mysqli_fetch_array($query)) {
                            ?>
                                <option align="center" value="<?= $period['label']; ?>"><?php echo $period['label']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </div>
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
                        $query    = mysqli_query($con, "SELECT * FROM pegawai_sikap ORDER BY id_sikap");
                        $no = 0;
                        while ($sikap = mysqli_fetch_array($query)) {
                            $no++;
                            $sikap_id = $sikap['id_sikap'];
                            $query_sikap = mysqli_query($con, "SELECT * FROM pegawai_nilai_sikap WHERE id_sikap=$sikap_id AND nip=$nip AND penilai=$penilai");
                            $nilai_sikap = mysqli_fetch_assoc($query_sikap);
                        ?>
                            <input type="hidden" name="id_sikap[]" value="<?= $sikap_id; ?>">
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td>
                                    <a type="text" class="form-control input" id="id_sikap"><?= $sikap['nama_sikap'] ?></a>
                                </td>
                                <td colspan="5" align="center">
                                    <select align="center" name="nilai_sikap[]" class="form-control custom-select">
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
                        $query    = mysqli_query($con, "SELECT * FROM pegawai_kriteria where bidang='RPDB' ORDER BY id_kriteria");
                        $no = 0;
                        while ($kriteria = mysqli_fetch_array($query)) {
                            $no++;
                            $kriteria_id = $kriteria['id_kriteria'];
                            $query_kriteria = mysqli_query($con, "SELECT * FROM pegawai_nilai_kerja WHERE id_kriteria=$kriteria_id AND nip=$nip AND penilai=$penilai");
                            $nilai_kriteria = mysqli_fetch_assoc($query_kriteria);							
                        ?>
                            <input type="hidden" name="id_kriteria[]" value="<?= $kriteria['id_kriteria']; ?>">
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td>
                                    <a type="text" class="form-control input" id="id_kriteria"><?= $kriteria['kriteria'] ?></a>
                                </td>
                                <td colspan="5" align="center">
									<select align="center" name="nilai[]" class="form-control custom-select">
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
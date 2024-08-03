<div class="row">
	<div class="col-xs-12">

		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data karyawan </h3>
				<h3 class="box-title pull-right">
				</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Jabatan</th>
							<th>Nama karyawan</th>
							<th>NIP</th>
							<th>Departemen</th>
							<th>Aksi</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_GET['act'])) {
							$sortir = $_GET['act'];
							$sql = "select * from pegawai where stts_aktif='AKTIF' AND bidang='$sortir' ORDER BY jbtn ASC";
						} else {
							$sql = "select * from pegawai where stts_aktif='AKTIF' ORDER BY jbtn ASC";
						}
						$query = mysqli_query($con, $sql);
						while ($row = mysqli_fetch_assoc($query)) :
							$departemen = mysqli_query($con, "SELECT * from departemen where dep_id='$row[departemen]'");
							$depar = mysqli_fetch_array($departemen);
						?>
							<tr>
								<td><?= $row['jbtn'] ?></td>
								<td><?= $row['nama'] ?></td>
								<td><?= $row['nik'] ?></td>
								<td><?= $depar['nama'] ?></td>
								<td>
									<a href="#editEmployeeModal<?= $row['id'] ?>" class="View" data-toggle="modal"><button class="glyphicon glyphicon-user" data-toggle="tooltip" title="View"></button></a>
									<a target="blank" href="index.php?p=kabag&act=nilai_kabag&id=<?= $row['id'] ?>" class="edit"><button class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Penilaian"></button></a>
								</td>
								<td></td>
							</tr>

							<div id="editEmployeeModal<?= $row['id'] ?>" class="modal fade">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<form>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Data Kepegawaian</h4>
											</div>
											<div class="modal-body modal-xl">
												<article class="row">
													<div class="col-md-12 col-lg-12">
														<div class="card profile-card">
															<div class="profile-body">
																<div class="clearfix">
																	<div class="col-md-12 col-lg-3">
																		<div class="image-area">
																			<img src="http://36.64.204.210/mitra/webapps/penggajian/<?= $row['photo'] ?>" width="180" height="180" class="img-thumbnail" alt="Profile Image" />
																		</div>
																	</div>
																	<div class="col-md-12 col-lg-9">
																		<div class="content-area">
																			<dl class="dl-horizontal no-margin">
																				<dt>NIP :</dt>
																				<dd><?= $row['nik'] ?></dd>
																				<dt>Nama :</dt>
																				<dd><?= $row['nama'] ?></dd>
																				<dt>Tipe Pegawai :</dt>
																				<dd><?= $row['jbtn'] ?></dd>
																				<dt>No KTP :</dt>
																				<dd><?= $row['no_ktp'] ?></dd>
																				<dt>Tanggal Lahir :</dt>
																				<dd><?= $row['tmp_lahir'] ?>, <?= $row['tgl_lahir'] ?></dd>
																				<dt>Jenis Kelamin :</dt>
																				<dd><?= $row['jk'] ?></dd>
																			</dl>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</article>

												<article class="row">
													<div class="col-md-12 col-lg-12">
														<div class="card">
															<div class="body" style="padding: 5px !important;">
																<div class="ralan_view">
																	<ul class="nav nav-tabs" role="tablist">
																		<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Personal Info</a></li>
																	</ul>

																	<div class="tab-content">
																		<div role="tabpanel" class="tab-pane fade in active" id="home">
																			<div class="row">
																				<div class="col-lg-12 col-md-12">
																					<div class="panel panel-default">
																						<div class="panel-body">
																							<dl class="dl-horizontal no-margin">
																								<dt>NPWP :</dt>
																								<dd><?= $row['npwp'] ?></dd>
																								<dt>Agama :</dt>
																								<dd><?= $row['agama'] ?></dd>
																								<dt>Status Nikah :</dt>
																								<dd><?= $row['stts_nikah'] ?></dd>
																								<dt>Alamat :</dt>
																								<dd><?= $row['alamat'] ?></dd>
																								<dt>Pendidikan Terakhir :</dt>
																								<dd><?= $row['pendidikan'] ?></dd>
																								<dt>Nomor Telpon :</dt>
																								<dd><?= $row['no_telp'] ?></dd>
																							</dl>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</article>
											</div>
											<div class="modal-footer">
												<input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
											</div>
										</form>
									</div>
								</div>
							</div>

						<?php endwhile; ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3">Index karyawan May Various</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
<script>
	$(document).ready(function() {
		setTimeout(function() {
			$('#message').hide();
		}, 3000);
	});
</script>
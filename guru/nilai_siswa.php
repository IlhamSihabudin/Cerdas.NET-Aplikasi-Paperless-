<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$link = "?menu=nilai_siswa";

if (!empty($_GET['rombel'])) {
$isi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_rombel WHERE rombel='$_GET[rombel]'"));
$kd_rombel = $isi['kd_rombel'];
$rombel = $isi['rombel'];

}
 ?>

<form method="POST" enctype="multipart/form-data">
	<section class="forms"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Filter</h3>
						</div>
						<div class="card-body">
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label class="form-control-label">Filter Menurut Rombel</label>
									<select name="rombel" class="form-control" required>
										<?php if (!empty($_GET['rombel'])) { ?>
										<option value="<?= $kd_rombel ?>" disabled selected><?= $rombel ?></option>
										<?php }else{ ?>
										<option value="" disabled selected>Pilih Salah Satu</option>
										<?php }

										$tampil = $oop->selectAll($con, "tb_rombel");
										if ($tampil == "") { ?>
										<option value="" disabled>Tidak Ada Rombel</option>
										<?php }else{ 
											foreach ($tampil as $rombel) { ?>
											<option value="<?= $rombel['rombel'] ?>"><?= $rombel['rombel'] ?></option>
											<?php }
										} ?>
									</select>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary" name="go"><i class="fa "></i> Go</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php 
				if (isset($_POST['go'])) {
					echo "<script>document.location.href='?menu=nilai_siswa&rombel=$_POST[rombel]'</script>";
				}

				if (!empty($_GET['rombel'])) { ?>

				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Nilai Siswa</h3>
						</div>
						<div class="card-body">
							<form method="POST" enctype="multipart/form-data">
								<div class="table-responsive">
									<table id="example" class="table table-striped table-hover text-center">
										<thead>
											<tr>
												<th>NIS</th>
												<th>Nama Siswa</th>
												<th>Jenis Kelamin</th>
												<th>Rombel</th>
												<th>Rayon</th>
												<th>Detail</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($con, "SELECT * FROM daftar_siswa WHERE rombel = '$_GET[rombel]'");
											$cek = mysqli_num_rows($query);
											if ($cek == 0) { ?>
											<tr>
												<td colspan="7">Nothing</td>
											</tr>
											<?php }else{
												while ($row = mysqli_fetch_array($query)) {
													if ($row['rekomendasi'] == "ya") {
														$ya = "checked";
														$tidak = "";
													}elseif ($row['rekomendasi'] == "tidak") {
														$ya = "";
														$tidak = "checked";
													}
													?>
													<tr>
														<td><?= $row['nis'] ?></td>
														<td><?= $row['nama'] ?></td>
														<td><?= $row['jk'] ?></td>
														<td><?= $row['rombel'] ?></td>
														<td><?= $row['rayon'] ?></td>
														<td>
															<a href="?menu=detail_nilai&rombel=<?= $row['rombel'] ?>&nis=<?= $row['nis'] ?>" class="btn btn-info">Detail <i class="fa fa-angle-double-right"></i></a>
														</td>
													</tr>
													<?php
													$whereUp = "nis = '$row[nis]'"; 
													if (@$_POST['recom' . $row['nis']] == 'ya') {
														$field = "rekomendasi = 'ya'";
													}else{
														$field = "rekomendasi = 'tidak'";
													}

													if (isset($_REQUEST['simpan'])) {
														$oop->update($con, "tb_siswa", $field, $whereUp, $link);
													}
													?>
													<?php }
												} ?>
											</tbody>
										</table>
									</div>
								</form>
							</div>
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</section>
	</form>
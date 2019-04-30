<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$link = "?menu=buat_report";

if (!empty($_GET['rombel'])) {
$isi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_rombel WHERE rombel='$_GET[rombel]'"));
$rombel = $isi['rombel'];
}

if (!empty($_GET['ulangan'])) {
$isi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tb_quiz WHERE jenis = 'ulangan' AND nama_quiz = '$_GET[ulangan]'"));
$ulangan = $isi['nama_quiz'];
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
										<option value="<?= $rombel ?>" disabled selected><?= $rombel ?></option>
										<?php }else{ ?>
										<option value="" disabled selected>Pilih Salah Satu</option>
										<?php }

										$tampil = $oop->selectAll($con, "tb_rombel");
										if ($tampil == "") { ?>
										<option value="" disabled>Tidak Ada Rombel</option>
										<?php }else{ 
											foreach ($tampil as $row_rombel) { ?>
											<option value="<?= $row_rombel['rombel'] ?>"><?= $row_rombel['rombel'] ?></option>
											<?php }
										} ?>
									</select>
								</div>
								<div class="form-group">
									<label class="form-control-label">Jenis Ulangan</label>
									<select name="ulangan" class="form-control" required>
										<?php if (!empty($_GET['ulangan'])) { ?>
										<option value="<?= $ulangan ?>" disabled selected><?= $ulangan ?></option>
										<?php }else{ ?>
										<option value="" disabled selected>Pilih Salah Satu</option>
										<?php }
										$sql = mysqli_query($con, "SELECT * FROM tb_quiz WHERE jenis = 'ulangan'");
										$cek = mysqli_num_rows($sql);
										if ($cek == 0) { ?>
											<option value="" disabled>Tidak Ada Rombel</option>
										<?php }else{
											while ($row_ulangan = mysqli_fetch_array($sql)) { ?>
												<option value="<?= $row_ulangan['nama_quiz'] ?>"><?= $row_ulangan['nama_quiz'] ?></option>
										<?php	}
										} ?>
									</select>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary" name="go">Go</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php 
				if (isset($_POST['go'])) {
					echo "<script>document.location.href='?menu=buat_report&rombel=$_POST[rombel]&ulangan=$_POST[ulangan]'</script>";
				}

				if (!empty($_GET['rombel']) AND !empty($_GET['ulangan'])) { ?>

				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Nilai Siswa</h3>
						</div>
						<div class="card-body">
							<form method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<a href="print.php?rombel=<?= $_GET['rombel'] ?>&ulangan=<?= $_GET['ulangan'] ?>" class="btn btn-info" name="print" target="outter"><i class="fa fa-print"></i> Print</a>
									<a href="export.php?rombel=<?= $_GET['rombel'] ?>&ulangan=<?= $_GET['ulangan'] ?>" class="btn btn-success" name="excel" target="outter"><i class="fa fa-file-excel-o"></i> Export Excel</a>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-hover table-bordered text-center">
										<thead>
											<tr>
												<th>NIS</th>
												<th>Nama Siswa</th>
												<th>Hasil</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE rombel = '$_GET[rombel]' AND nama_quiz = '$_GET[ulangan]'");
											$cek = mysqli_num_rows($query);
											if ($cek == 0) { ?>
											<tr>
												<td colspan="7">Nothing</td>
											</tr>
											<?php }else{
												while ($row = mysqli_fetch_array($query)) { 
													if ($row['hasil'] < 75) {?>
														<tr class="bg-danger" style="color: white">
															<td><?= $row['nis'] ?></td>
															<td><?= $row['nama'] ?></td>
															<td><?= $row['hasil'] ?></td>
														</tr>
													<?php }else{ ?>
														<tr>
															<td><?= $row['nis'] ?></td>
															<td><?= $row['nama'] ?></td>
															<td><?= $row['hasil'] ?></td>
														</tr>
													<?php }
														}
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
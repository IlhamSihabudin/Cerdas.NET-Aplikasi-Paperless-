<?php 
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$date = date('d-M-Y');
echo $date;

$oop = new oop();
$ulangan = $_GET['ulangan'];
$rombel = $_GET['rombel'];

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$date - Laporan Nilai Ulangan $ulangan - $rombel.xls");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
	<div class="text-center">
		<h1 style="font-weight: bold">Hasil Ulangan <?= $_GET['ulangan'] ?></h1>
		<h2>Rombel <?= $_GET['rombel'] ?></h2>
	</div><br>
		<div class="table-responsive">
			<table border="1">
				<thead>
					<tr>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Hasil</th>
						<th>Tanggal Mengerjakan</th>
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
						while ($row = mysqli_fetch_array($query)) { ?>
							<tr>
								<td><?= $row['nis'] ?></td>
								<td><?= $row['nama'] ?></td>
								<td><?= $row['hasil'] ?></td>
								<td><?= $row['tgl'] ?></td>
							</tr>
							<?php }
							} ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
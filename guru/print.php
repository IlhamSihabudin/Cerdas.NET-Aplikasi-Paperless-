<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script>window.print()</script>
</head>
<body>
	<div class="container">
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
			<tr>
				<td width="7%" rowspan="3" align="center" valign="top"><img src="../foto/logo.png" width="100"/></td>
				<td width="93%" valign="top" style="font-size: 20pt"><strong>&nbsp;&nbsp;LAPORAN NILAI </strong></td>
			</tr>
			<tr>
				<td valign="top" style="font-size: 16pt">&nbsp;&nbsp;SMK Wikrama Kota Bogor </td>
			</tr>
			<tr>
				<td valign="top" style="font-size: 16pt">&nbsp;&nbsp;Ilmu yang Amaliah, Amal yang Ilmiah, Akhlakul Karimah </td>
			</tr>
		</table>
		<hr>
	<div class="text-center">
		<h1 style="font-weight: bold">Hasil Ulangan <?= $_GET['ulangan'] ?></h1>
		<h2>Rombel <?= $_GET['rombel'] ?></h2>
	</div><br>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered text-center">
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
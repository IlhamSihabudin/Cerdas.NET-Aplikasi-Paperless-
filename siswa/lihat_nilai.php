<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
 ?>

<section class="forms"> 
	<div class="container-fluid">
		<form method="POST">
			<div class="row">
				<div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Ulangan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Ulangan' AND nis = '$_SESSION[username]'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($ulangan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $ulangan['nama_quiz'] ?></td>
                            <td><?= $ulangan['hasil'] ?></td>
                            <td><?= $ulangan['tgl'] ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Perbaikan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Perbaikan' AND nis = '$_SESSION[username]'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($perbaikan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $perbaikan['nama_quiz'] ?></td>
                            <td><?= $perbaikan['hasil'] ?></td>
                            <td><?= $perbaikan['tgl'] ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="h4">Latihan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example2" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>Nama Quiz</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = mysqli_query($con, "SELECT * FROM nilai_siswa WHERE jenis_quiz='Latihan' AND nis = '$_SESSION[username]'");
                      $cek = mysqli_num_rows($sql);
                        if ($cek == 0) { ?>
                          <tr>
                            <td colspan="5">Nothing</td>
                          </tr>
                      <?php }else{
                              while ($latihan = mysqli_fetch_array($sql)) { ?>
                          <tr>
                            <td><?= $latihan['nama_quiz'] ?></td>
                            <td><?= $latihan['hasil'] ?></td>
                            <td><?= $latihan['tgl'] ?></td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
			</div>
		</form>
	</div>
</section>
<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
@$whereGet = "nik = '$_GET[id]'";
$table = "tb_guru";
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Daftar Guru</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Lahir</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Tanggal Daftar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $tampil = $oop->selectAllOrder($con,$table,"nik","asc");
                      if ($tampil == "") { ?>
                      <tr>
                        <td colspan="9">Nothing</td>
                      </tr>
                      <?php }else{
                        foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['nik'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['jk'] ?></td>
                          <td><?= $row['tgl_lahir'] ?></td>
                          <td><?= $row['email'] ?></td>
                          <td><?= $row['alamat'] ?></td>
                          <td><img src="../foto/<?= $row['foto'] ?>" width="80px"></td>
                          <td><?= $row['tgl_daftar'] ?></td>
                        </tr>
                        <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
@$whereGet = "nis = '$_GET[id]'";
$table = "daftar_siswa";
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Daftar Siswa</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-hover text-center">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Rombel</th>
                        <th>Rayon</th>
                        <th>Tanggal Daftar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $tampil = $oop->selectAllOrder($con,$table,"nis","asc");
                      if ($tampil == "") { ?>
                      <tr>
                        <td colspan="9">Nothing</td>
                      </tr>
                      <?php }else{
                        foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['nis'] ?></td>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['jk'] ?></td>
                          <td><?= $row['rombel'] ?></td>
                          <td><?= $row['rayon'] ?></td>
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
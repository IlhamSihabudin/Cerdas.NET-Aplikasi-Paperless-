<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "daftar_siswa";
$where = "nis = '$_SESSION[username]'";

$data = $oop->selectWhere($con, $table, $where);
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-6" style="margin: auto;">
        <div class="card">
          <div class="card-header d-flex align-items-center bg-primary" style="color: white">
            <h3 class="h2">Profile</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-lg-12">
                  <table class="table" style="font-size: 14pt">
                    <tr>
                      <td>NIK</td>
                      <td>:</td>
                      <td>
                        <?= $data['nis'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td>
                        <?= $data['nama'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Kelamin</td>
                      <td>:</td>
                      <td>
                        <?= $data['jk'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Rombel</td>
                      <td>:</td>
                      <td>
                        <?= $data['rombel'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Rayon</td>
                      <td>:</td>
                      <td>
                        <?= $data['rayon'] ?>
                      </td>
                    </tr>
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
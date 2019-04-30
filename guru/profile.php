<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_guru";
$where = "username = '$_SESSION[username]'";

$data = $oop->selectWhere($con, $table, $where);
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-close">
            <h3 class="h4"><a href="?menu=change_profile" class="btn btn-success" style="margin-top: -8px;color: white"><i class="fa fa-pencil-square-o"></i> Edit Profile</a></h3>
          </div>
          <div class="card-header d-flex align-items-center">
            <h3 class="h2">Profile</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-lg-5 text-center" style="padding: 20px;">
                  <img src="../foto/<?= $data['foto'] ?>" width="300px;">
                </div>
                <div class="col-lg-7">
                  <table class="table">
                    <tr>
                      <td>NIK</td>
                      <td>:</td>
                      <td>
                        <?= $data['nik'] ?>
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
                      <td>Tanggal Lahir</td>
                      <td>:</td>
                      <td>
                        <?= $data['tgl_lahir'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td>
                        <?= $data['email'] ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td>
                        <?= $data['alamat'] ?>
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
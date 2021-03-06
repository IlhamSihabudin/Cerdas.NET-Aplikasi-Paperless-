<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$link = "?menu=input_rayon";
@$whereGet = "kd_rayon = '$_GET[id]'";
$table = "tb_rayon";
@$isi = "rayon = '$_POST[rayon]'";

if (isset($_POST['simpan'])) {
  $oop->insert($con, $table, $isi, $link);
}

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $whereGet);
}

if (isset($_POST['edit'])) {
  $oop->update($con, $table, $isi, $whereGet, $link);
}

if (isset($_GET['hapus'])) {
  $oop->delete($con, $table, $whereGet, $link);
}
?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <?php if (isset($_GET['edit'])) { ?>
              <h3 class="h4">Edit Rayon</h3>
            <?php }else{ ?>
              <h3 class="h4">Input Rayon</h3>
            <?php } ?>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">  
                <label class="form-control-label">Nama Rayon</label>
                <input type="text" class="form-control" name="rayon" value="<?= @$data['rayon'] ?>">
              </div>
              <div class="form-group text-center">
                <?php if (isset($_GET['edit'])) { ?>
                  <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-upload"></i> Edit</button>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"></i> Simpan</button>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Daftar Rayon</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>Kode Rayon</th>
                      <th>Rayon</th>
                      <th>Edit</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $tampil = $oop->selectAll($con,$table);
                    if ($tampil == "") { ?>
                    <tr>
                      <td colspan="4">Nothing</td>
                    </tr>
                    <?php }else{
                      foreach ($tampil as $row) { ?>
                      <tr>
                        <td><?= $row['kd_rayon'] ?></td>
                        <td><?= $row['rayon'] ?></td>
                        <td>
                          <a href="?menu=input_rayon&edit&id=<?= $row['kd_rayon'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                        </td>
                        <td>
                          <a href="?menu=input_rayon&hapus&id=<?= $row['kd_rayon'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                        </td>
                      </tr>
                      <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');

$oop = new oop();
$table = "tb_materi";
@$where = "kd_materi = '$_GET[id]'";


$nampil = $oop->selectWhere($con, "tb_guru", "nik = '$_SESSION[username]'");
$upload_by = $nampil['nama'];

$link = "?menu=input_materi";
@$isi = "jdl_materi = '$_POST[jdl_materi]', materi = '$_POST[materi]',  upload_by = '$upload_by', tgl_upload = '$tanggal', kelas = '$_POST[kelas]'";

if (isset($_POST['simpan'])) {
  $oop->insert($con, $table, $isi, $link);
}

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $where);
	  switch ($data['kelas']) {
	  	case "X":
	  		$x = "selected";
	  		break;
	  	
	  	case "XI":
	  		$xi = "selected";
	  		break;

	  	case "XII":
	  		$xii = "selected";
	  		break;
	  }
}

if (isset($_POST['edit'])) {
  $oop->update($con, $table, $isi, $where, $link);
}

if (isset($_GET['hapus'])) {
  $oop->delete($con, $table, $where, $link);
}


?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <?php if (isset($_GET['edit'])) { ?>
              <h3 class="h4">Edit Materi</h3>
            <?php }else{ ?> 
              <h3 class="h4">Input Materi</h3>
            <?php } ?>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label class="form-control-label">Judul Materi</label>
                <input type="text" name="jdl_materi" class="form-control" placeholder="Masukan Judul Materi"  value="<?= @$data['jdl_materi'] ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Kelas</label>
                 <select name="kelas" class="form-control input-material" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="X" <?= @$x ?>>Kelas X</option>
                    <option value="XI" <?= @$xi ?>>Kelas XI</option>
                    <option value="XII" <?= @$xii ?>>Kelas XII</option>
                 </select>
              </div>
              <div class="form-group">
                <label class="form-control-label">Isi Materi</label>
                <textarea class="ckeditor" name="materi" id="editor1" required><?= @$data['materi'] ?></textarea>
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

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">List Materi</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>Judul Materi</th>
                      <th>Tanggal Upload</th>
                      <th>Kelas</th>
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
                        <td><?= $row['jdl_materi'] ?></td>
                        <td><?= $row['tgl_upload'] ?></td>
                        <td><?= $row['kelas'] ?></td>
                        <td>
                          <a href="?menu=input_materi&edit&id=<?= $row['kd_materi'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                        </td>
                        <td>
                          <a href="?menu=input_materi&hapus&id=<?= $row['kd_materi'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
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
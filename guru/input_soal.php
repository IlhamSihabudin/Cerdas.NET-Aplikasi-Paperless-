<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_soal";
@$where = "kd_soal = '$_GET[id]'";
$link = "?menu=input_soal";

if (isset($_GET['edit'])) {
  $data = $oop->selectWhere($con, $table, $where);
  $soal = $data['soal'];
  $opsi_a = $data['opsi_1'];
  $opsi_b = $data['opsi_2'];
  $opsi_c = $data['opsi_3'];
  $opsi_d = $data['opsi_4'];
  $opsi_e = $data['opsi_5'];

  if ($data['jawaban'] == $data['opsi_1']) {
    $a = "checked";
    $b = "";
    $c = "";
    $d = "";
    $e = "";
  }elseif ($data['jawaban'] == $data['opsi_2']) {
    $a = "";
    $b = "checked";
    $c = "";
    $d = "";
    $e = "";
  }elseif ($data['jawaban'] == $data['opsi_3']) {
    $a = "";
    $b = "";
    $c = "checked";
    $d = "";
    $e = "";
  }elseif ($data['jawaban'] == $data['opsi_4']) {
    $a = "";
    $b = "";
    $c = "";
    $d = "checked";
    $e = "";
  }elseif ($data['jawaban'] == $data['opsi_5']) {
    $a = "";
    $b = "";
    $c = "";
    $d = "";
    $e = "checked";
  }
}else{
  @$soal = $_POST['soal'];
  @$opsi_a = $_POST['opsi_a'];
  @$opsi_b = $_POST['opsi_b'];
  @$opsi_c = $_POST['opsi_c'];
  @$opsi_d = $_POST['opsi_d'];
  @$opsi_e = $_POST['opsi_e'];

  if (@$_POST['jawaban'] == "a") {
    $a = "checked";
    $b = "";
    $c = "";
    $d = "";
    $e = "";
  }elseif (@$_POST['jawaban'] == "b") {
    $a = "";
    $b = "checked";
    $c = "";
    $d = "";
    $e = "";
  }elseif (@$_POST['jawaban'] == "c") {
    $a = "";
    $b = "";
    $c = "checked";
    $d = "";
    $e = "";
  }elseif (@$_POST['jawaban'] == "d") {
    $a = "";
    $b = "";
    $c = "";
    $d = "checked";
    $e = "";
  }elseif (@$_POST['jawaban'] == "e") {
    $a = "";
    $b = "";
    $c = "";
    $d = "";
    $e = "checked";
  }
}


if (@$_POST['jawaban'] == "a") {
  @$jawaban = $_POST['opsi_a'];
}elseif (@$_POST['jawaban'] == "b") {
  @$jawaban = $_POST['opsi_b'];
}elseif (@$_POST['jawaban'] == "c"){
  @$jawaban = $_POST['opsi_c'];
}elseif (@$_POST['jawaban'] == "d") {
  @$jawaban = $_POST['opsi_d'];
}elseif (@$_POST['jawaban'] == "e") {
  @$jawaban = $_POST['opsi_e'];
}

if (isset($_POST['simpan'])) {
  if (@$_POST['jawaban'] == "") {
    echo "<script>alert('Pilih Salah Satu Jawaban');</script>";
  }else{
    @$nama_file = $_FILES['foto']['name'];
    if (@$nama_file != "") {
      @$tmp_file = $_FILES['foto']['tmp_name'];
      @$type = $_FILES['foto']['type'];
      if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
        move_uploaded_file($tmp_file,"../foto/$nama_file");

        $isi = "soal = '$_POST[soal]', gambar = '$nama_file', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";

        $oop->insert($con, $table, $isi, $link);
      }else{
        echo "<script>alert('Masukan File Bertipe Foto');</script>";      
      }
    }else{

      $isi = "soal = '$_POST[soal]', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";

      $oop->insert($con, $table, $isi, $link);
    }
  }
}

if (isset($_POST['duplicate'])) {
  @$nama_file = $_FILES['foto']['name'];
  if (@$nama_file != "") {
    @$tmp_file = $_FILES['foto']['tmp_name'];
    @$type = $_FILES['foto']['type'];
    if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
      move_uploaded_file($tmp_file,"../foto/$nama_file");

      $isi = "soal = '$_POST[soal]', gambar = '$nama_file', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";

      $oop->insert($con, $table, $isi, $link);
    }else{
      echo "<script>alert('Masukan File Bertipe Foto');</script>";      
    }
  }else{
    $cek_duplicate = $oop->selectWhere($con, $table, $where);

    if ($cek_duplicate['gambar'] == "") {
      $isi = "soal = '$_POST[soal]', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";
    }else{
      $isi = "soal = '$_POST[soal]', gambar = '$cek_duplicate[gambar]', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";
    }


    $oop->insert($con, $table, $isi, $link);
  }
}

if (isset($_POST['edit'])) {
    @$nama_file = $_FILES['foto']['name'];

  if (@$nama_file != "") {
    @$tmp_file = $_FILES['foto']['tmp_name'];
    @$type = $_FILES['foto']['type'];
    if ($type=="image/jpeg" || $type=="image/jpg" || $type=="image/gif" || $type=="image/x-png") {
      move_uploaded_file($tmp_file,"../foto/$nama_file");

      $isi = "soal = '$_POST[soal]', gambar = '$nama_file', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";

      $oop->update($con, $table, $isi, $where, $link);
    }else{
      echo "<script>alert('Masukan File Bertipe Foto');</script>";      
    }
  }else{

    $isi = "soal = '$_POST[soal]', opsi_1 = '$_POST[opsi_a]', opsi_2 = '$_POST[opsi_b]', opsi_3 = '$_POST[opsi_c]', opsi_4 = '$_POST[opsi_d]', opsi_5 = '$_POST[opsi_e]', jawaban = '$jawaban'";

    $oop->update($con, $table, $isi, $where, $link);
  }
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
            <h3 class="h4">Edit Soal</h3>
            <?php }else{ ?>
            <h3 class="h4">Input Soal</h3>
            <?php } ?>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label class="form-control-label">Soal</label>
                <textarea class="form-control" name="soal" placeholder="Masukan Soal" required><?= @$soal ?></textarea>
              </div>
              <div class="form-group">
                <label class="form-control-label">Gambar</label>
                <input type="file" class="form-control" name="foto">
              </div>
              <div class="form-group">
                <label class="form-control-label">Opsi A</label>
                <input type="text" class="form-control" name="opsi_a" placeholder="Masukan Opsi A" value="<?= @$opsi_a ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Opsi B</label>
                <input type="text" class="form-control" name="opsi_b" placeholder="Masukan Opsi B" value="<?= @$opsi_b ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Opsi C</label>
                <input type="text" class="form-control" name="opsi_c" placeholder="Masukan Opsi C" value="<?= @$opsi_c ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Opsi D</label>
                <input type="text" class="form-control" name="opsi_d" placeholder="Masukan Opsi D" value="<?= @$opsi_d ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Opsi E</label>
                <input type="text" class="form-control" name="opsi_e" placeholder="Masukan Opsi E" value="<?= @$opsi_e ?>" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Jawaban Yang Benar</label>
                <div class="row" style="padding: 5px;">
                  <div class="i-checks col-lg-2">
                    <input id="a" type="radio" value="a" id="jawaban" name="jawaban" class="radio-template" <?= @$a ?>>
                    <label for="a">A</label>
                  </div>
                  <div class="i-checks col-lg-2">
                    <input id="b" type="radio" value="b" id="jawaban" name="jawaban" class="radio-template" <?= @$b ?>>
                    <label for="b">B</label>
                  </div>
                  <div class="i-checks col-lg-2">
                    <input id="c" type="radio" value="c" id="jawaban" name="jawaban" class="radio-template" <?= @$c ?>>
                    <label for="c">C</label>
                  </div>
                  <div class="i-checks col-lg-2">
                    <input id="d" type="radio" value="d" id="jawaban" name="jawaban" class="radio-template" <?= @$d ?>>
                    <label for="d">D</label>
                  </div>
                  <div class="i-checks col-lg-2">
                    <input id="e" type="radio" value="e" id="jawaban" name="jawaban" class="radio-template" <?= @$e ?>>
                    <label for="e">E</label>
                  </div>
                </div>
              </div>
              <div class="form-group text-center">
                <?php if (isset($_GET['edit'])) { ?>
                <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-upload"></i> Edit</button>
                <button type="submit" class="btn btn-warning" name="duplicate"><i class="fa fa-copy"></i> Duplicate Soal</button>
                <?php }else{ ?>
                <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"></i> Simpan</button>
                <?php } ?>
                </div
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
         <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Daftar Soal</h3>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>Soal</th>
                      <th>Gambar</th>
                      <th>Opsi A</th>
                      <th>Opsi B</th>
                      <th>Opsi C</th>
                      <th>Opsi D</th>
                      <th>Opsi E</th>
                      <th>Jawaban</th>
                      <th>Edit</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $tampil = $oop->selectAll($con,$table);
                    if ($tampil == "") { ?>
                    <tr>
                      <td colspan="10">Nothing</td>
                    </tr>
                    <?php }else{
                      foreach ($tampil as $row) { ?>
                        <tr>
                          <td><?= $row['soal'] ?></td>
                          <?php if ($row['gambar'] == "") { ?>
                            <td>-</td>
                          <?php }else{ ?>
                            <td><img src="../foto/<?= $row['gambar'] ?>" width="80px"></td>
                          <?php } ?>
                          <td><?= $row['opsi_1'] ?></td>
                          <td><?= $row['opsi_2'] ?></td>
                          <td><?= $row['opsi_3'] ?></td>
                          <td><?= $row['opsi_4'] ?></td>
                          <td><?= $row['opsi_5'] ?></td>
                          <td><?= $row['jawaban'] ?></td>
                          <td>
                            <a href="?menu=input_soal&edit&id=<?= $row['kd_soal'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=input_soal&hapus&id=<?= $row['kd_soal'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
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

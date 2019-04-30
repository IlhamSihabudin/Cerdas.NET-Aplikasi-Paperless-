<?php 
include '../config/koneksi.php';
include '../library/controllers.php';

$oop = new oop();
$table = "tb_quiz";
@$where = "pkt_soal = '$_GET[id]'";
$link = "?menu=list_quiz";
$isi2 = "status = 'nonaktif'";

if (isset($_GET['hapus'])) {
  $query = mysqli_query($con, "UPDATE tb_soal SET pkt_soal = '' WHERE $where;");
  
  $oop->delete($con, $table, $where, $link);
}

if (isset($_GET['aktifkan'])) {
  $isi1 = "status = 'aktif'";
  $cek_soal1 = $oop->selectWhere($con, $table, $where);
  $cek_soal2 = $oop->selectCount($con, "tb_soal", $where);
  
  if ($cek_soal1['jumlah_soal'] <= $cek_soal2) {
    $oop->update($con, $table, $isi1, $where, $link);
  }else{
    echo "<script>alert('Jumlah Soal Yang Dipilih Masih Kurang');document.location.href='$link'</script>";
  }
}

if (isset($_GET['nonaktifkan'])) {
  $oop->update($con, $table, $isi2, $where, $link);
}
 ?>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      <!-- Basic Form-->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">List Quiz</h3>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>Paket Soal</th>
                      <th>Nama Quiz</th>
                      <th>Jenis</th>
                      <th>Lama Waktu</th>
                      <th>Jumlah Soal</th>
                      <th>Jumlah Soal Yang Dipilih</th>
                      <th>Edit</th>
                      <th>Hapus</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                    $tampil = $oop->selectAll($con,$table);
                    if ($tampil == "") { ?>
                    <tr>
                      <td colspan="9">Nothing</td>
                    </tr>
                    <?php }else{
                      foreach ($tampil as $row) { 
                          $soal_terpilih = $oop->selectCount($con, "tb_soal", "pkt_soal = '$row[pkt_soal]'");
                        ?>
                        <tr>
                          <td><?= $row['pkt_soal'] ?></td>
                          <td><?= $row['nama_quiz'] ?></td>
                          <td><?= $row['jenis'] ?></td>
                          <td><?= $row['lama_waktu'] . " menit" ?></td>
                          <td><?= $row['jumlah_soal'] ?></td>
                          <td><?= $soal_terpilih ?></td>
                          <td>
                            <a href="?menu=buat_quiz&edit&id=<?= $row['pkt_soal'] ?>"><i class="fa fa-pencil text-success" style="font-size: 20pt"></i></a>
                          </td>
                          <td>
                            <a href="?menu=list_quiz&hapus&id=<?= $row['pkt_soal'] ?>" onclick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-trash text-danger" style="font-size: 20pt"></i></a>
                          </td>
                          <?php if ($soal_terpilih < $row['jumlah_soal']) {
                            $query = mysqli_query($con, "UPDATE tb_quiz SET status='nonaktif' WHERE pkt_soal = '$row[pkt_soal]'");
                          } ?>
                          <td>
                            <?php if ($row['status'] == "aktif") { ?>
                              <a href="?menu=list_quiz&nonaktifkan&id=<?= $row['pkt_soal'] ?>" class="btn btn-info">Nonaktifkan</a>
                            <?php }else{ ?>
                              <a href="?menu=list_quiz&aktifkan&id=<?= $row['pkt_soal'] ?>" class="btn btn-secondary">Aktifkan</a>
                            <?php } ?>
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
<?php 
  if (isset($_POST['mulai'])) {
    $_SESSION['quiz'] = "begin";

    echo "<script>document.location.href='?menu=quiz_begin'</script>";
  }

  if (isset($_POST['kembali'])) {
    echo "<script>document.location.href='?menu=quiz'</script>";
  }
 ?>

 <form method="post">
  <section class="forms"> 
    <div class="container-fluid">
      <div class="row">
        <!-- Basic Form-->
        <div class="col-lg-12" style="margin: auto;">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Informasi Quiz</h3>
            </div>
            <div class="card-body">
              <ol class="form-control-label" style="font-size: 15pt">
                <li>Baca dengan saksama dan teliti sebelum memilih jawaban.</li>
                <li>Pastikan koneksi anda terjamin dan bagus.</li>
                <li>Pilih browser versi terbaru.</li>
                <li>Jika terjadi masalah silahkan laporkan ke pengawas ruangan.</li>
                <li>Jangan lupa berdoa.</li>
              </ol>
            </div>
            <div class="card-footer">
              <div>
                <button type="submit" name="mulai" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Mulai Mengerjakan</button>
                <button type="submit" name="kembali" class="btn btn-danger"><i class="fa fa-mail-reply"></i> Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
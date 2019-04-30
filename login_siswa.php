<?php 
  if (isset($_POST['login_guru'])) {
    echo "<script>document.location.href='?menu=login_guru'</script>";
  }

  if (isset($_POST['materi'])) {
    echo "<script>document.location.href='materi'</script>";
  }

  if (isset($_POST['lgn_siswa'])) {
      @$table = "tb_siswa";
      @$session = "siswa";
      $oop->login($con, $table, $user, $pass, $session);
    }
 ?>

<div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <form method="post">
                  <div class="logo">
                    <h1>CERDAS.NET</h1>
                  </div>
                  <p>
                    Orang Yang Cerdas Adalah Orang Yang Selalu Jujur Pada Dirinya Sendiri.
                  </p>
                  <p>
                    <button type="submit" class="btn btn-warning" name="materi">Lihat Materi <i class="fa fa-angle-double-right" style="font-size: 19px;"></i></button>
                    <button type="submit" class="btn btn-success" name="login_guru">Login Guru <i class="fa fa-angle-double-right" style="font-size: 19px;"></i></button>
                  </p>
                  </form>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form id="login-form" method="post">
                    <div style="text-align: center;">
                      <i class="fa fa-unlock-alt" style="font-size: 48pt; color: #2b90d9;"></i>
                    </div>
                    <div class="form-group">
                      <input id="username" type="text" name="username" required class="input-material">
                      <label for="username" class="label-material">Username</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required class="input-material">
                      <label for="password" class="label-material">Password</label>
                    </div>
                    <button id="login" name="lgn_siswa" type="submit" class="btn btn-primary col-lg-5 col-md-7">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
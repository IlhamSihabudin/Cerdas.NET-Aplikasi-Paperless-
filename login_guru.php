<?php 
  if (isset($_POST['login_murid'])) {
    echo "<script>document.location.href='?menu=login_murid'</script>";
  }

  if (isset($_POST['lgn_guru'])) {
      @$table = "tb_guru";
      @$session = "guru";
      $oop->login($con, $table, $user, $pass, $session);
    }
 ?>

<div class="row">
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content" style="padding: 10%">
                  <form id="login-form" method="post">
                    <div style="text-align: center;">
                      <i class="fa fa-unlock-alt text-success" style="font-size: 48pt;"></i>
                    </div>
                    <div class="form-group">
                      <input id="username" type="text" name="username" required class="input-material">
                      <label for="username" class="label-material">Username</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required class="input-material">
                      <label for="password" class="label-material">Password</label>
                    </div>
                    <button id="login" name="lgn_guru" type="submit" class="btn btn-success col-lg-5 col-md-7">Login</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center" style="background-color: rgba(40, 167, 69, 0.8)">
                <div class="content">
                  <form method="post">
                  <div class="logo">
                    <h1>CERDAS.NET</h1>
                    <p>
                      Guru Yang Baik Akan Mengorbankan Waktunya Untuk Ke Suksesan Muridnya.
                    </p>
                  </div>
                  <p>
                    <div class="form-group">
                        <button class="btn btn-primary" name="login_murid"><i class="fa fa-angle-double-left" style="font-size: 19px;"></i> Login Murid</button>
                    </div>
                  </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
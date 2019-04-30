<?php 
  if (isset($_POST['login_murid'])) {
    echo "<script>document.location.href='?menu=login_murid'</script>";
  }

  if (isset($_POST['login_guru'])) {
    echo "<script>document.location.href='?menu=login_guru'</script>";
  }

  if (isset($_POST['lgn_guru'])) {
      @$user = base64_encode($_POST['username']);
      @$pass = base64_encode($_POST['password']);
      @$table = "tb_admin";
      @$session = "admin";
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
                      <i class="fa fa-unlock-alt" style="font-size: 48pt; color: #dc3545;"></i>
                    </div>
                    <div class="form-group">
                      <input id="username" type="text" name="username" required class="input-material">
                      <label for="username" class="label-material">Username</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required class="input-material">
                      <label for="password" class="label-material">Password</label>
                    </div>
                    <button id="login" name="lgn_guru" type="submit" class="btn btn-danger col-lg-5 col-md-7">Login</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center" style="background-color: rgba(220, 53, 69, 0.8)">
                <div class="content">
                  <form method="post">
                  <div class="logo">
                    <h1>CERDAS.NET</h1>
                  </div>
                  <p>
                    <div class="form-group">
                        <button class="btn btn-primary" name="login_murid"><i class="fa fa-angle-double-left" style="font-size: 19px;"></i> Login Murid</button>
                        <button class="btn btn-warning" name="login_guru"><i class="fa fa-angle-double-left" style="font-size: 19px;"></i> Login Guru</button>
                    </div>
                  </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php
  $title = "Login";
  $bodyType = "";
  //Array of additional js files to be loaded
  $jsAdditional = [];
  //Array of additional css files to be loaded
  $cssAdditional = [
    "/public/assets/css/custom.css",
    "/public/assets/css/pages/auth.css",
  ];
  //Modulos Fijos Superiores
  include('views/header.php');
?>

<div id="auth">
  <div class="row h-100">
    <div class="col-lg-5 col-12">
      <div id="auth-left">
        <div class="auth-logo mx-auto">
          <a href="<?php echo URL?>">
            <img src="public/assets/images/logo/logo.png" alt="Logo" style="width: 100%;height:100%">
          </a>
        </div>
        <h1 class="auth-title">Ingresar.</h1>
        <form action="<?php echo URL?>/login/authenticate" method="post">
          <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" name="email" class="form-control form-control-xl" placeholder="Usuario">
            <div class="form-control-icon">
              <i class="bi bi-person"></i>
            </div>
          </div>
          <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password" class="form-control form-control-xl" placeholder="Contraseña">
            <div class="form-control-icon">
              <i class="bi bi-shield-lock"></i>
            </div>
          </div>
          <input type="hidden" name="send" value="yes">
          <?php $this->showMessages();?>
          <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Ingrese</button>
        </form>
        <div class="text-center mt-5 text-lg fs-5">
          <p>
            <a class="font-bold" href="auth-forgot-password.html">¿Olvidó su contraseña?</a>.
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
      <div id="auth-right">

      </div>
    </div>
  </div>

</div>
<?php
include('views/scripts.php');
?>
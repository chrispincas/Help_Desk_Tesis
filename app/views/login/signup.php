<?php
$title = "Registro";
$bodyType = "body-background-image";
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
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card mt-5">
        <div class="card-header mx-auto">
          <h3 class="mx-auto">Regístrese</h3> <!--Revisar BG -->
        </div>
        <div class="card-body">
          <?php $this->showMessages();?>
          <form action="<?php echo URL?>/signup/newUser" method="post">
            <div class="row">
              <div class="col-md-6 form-group has-icon-left">
                <label for="name">Nombre</label>
                <div class="position-relative mt-2">
                  <input type="text" class="form-control" placeholder="Nombre" name="name">
                  <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-6 form-group has-icon-left">
                <label for="email">Email</label>
                <div class="position-relative mt-2">
                  <input type="email" class="form-control" placeholder="email" name="email">
                  <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-6 form-group has-icon-left">
                <label for="password">Contraseña</label>
                <div class="position-relative mt-2">
                  <input type="password" class="form-control" placeholder="Contraseña" name="password">
                  <div class="form-control-icon">
                    <i class="bi bi-lock"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-6 form-group has-icon-left">
                <label for="password2">Repita la contraseña</label>
                <div class="position-relative mt-2">
                  <input type="password" class="form-control" placeholder="Repita la contraseña" name="password2">
                  <div class="form-control-icon">
                    <i class="bi bi-lock"></i>
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Registrarse</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
include('views/scripts.php');
?>
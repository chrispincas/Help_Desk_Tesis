<?php
$user = $this->d['user'];
$reseller = $this->d['reseller'];
$list_users = $this->d['list_users'];
$module = 'users';
?>
<?php 
  include('views/head.php');
  include('views/header.php');
  include('views/sidebar.php');
?>
  <div class="row-fluid text-center">
    <?php $this->showMessages();?>
  </div>
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <h1>Editar Usuario</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form action="<?php echo constant('URL');?>/users/updateUser" method="post">
                  <input type="hidden" id="id" name="id" value="<?php echo $reseller->getId();?>">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="identificacion">Identificacion</label>
                      <input type="number" name="identificacion" id="identificacion" class="form-control" required value="<?php echo $reseller->getIdentificacion();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" id="nombre" class="form-control input-uppercase" required value="<?php echo $reseller->getNombre();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="correo">Correo</label>
                      <input type="email" name="correo" id="correo" class="form-control input-lowercase" required value="<?php echo $reseller->getCorreo();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefono">Telefono</label>
                      <input type="tel" name="telefono" id="telefono" class="form-control" required value="<?php echo $reseller->getTelefono();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="ubicacion">Ubicacion</label>
                      <input type="text" name="ubicacion" id="ubicacion" class="form-control input-uppercase" required value="<?php echo $reseller->getUbicacion();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="padre_id">Usuario Padre</label>
                      <select name="padre_id" class="form-control">
                        <?php foreach($list_users as $r):?>
                          <option <?php if($r->getId()==$reseller->getPadre_id()){ echo 'selected';} ?> value="<?php echo $r->getId();?>"><?php echo $r->getNombre(); ?></option>
                        <?php endforeach?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="saldo">Saldo</label>
                      <input type="text" name="saldo" id="saldo" class="form-control input-uppercase" readonly value="<?php echo $reseller->getSaldo();?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="role">Rol</label>
                      <select name="role" class="form-control">
                        <option <?php if($reseller->getRole()=='consulta'){echo 'selected';} ?>  value="consulta">Consulta</option>
                        <option <?php if($reseller->getRole()=='cajero'){echo 'selected';} ?>  value="cajero">Cajero</option>
                        <option <?php if($reseller->getRole()=='reseller'){echo 'selected';} ?>  value="reseller">Reseller</option>
                        <option <?php if($reseller->getRole()=='admin'){echo 'selected';} ?>  value="admin">Admin</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="estado">Estado</label>
                      <select name="estado" class="form-control">
                        <option <?php if($reseller->getEstado()==0){echo 'selected';} ?> value="0">Inactivo</option>
                        <option <?php if($reseller->getEstado()==1){echo 'selected';} ?> value="1">Activo</option>
                      </select>
                    </div>
                    <div class="d-block d-sm-none form-group col-md-6 offset-md-3 text-center">
                      <a href="<?php echo constant('URL') . '/' . $module; ?>" class="btn btn-lg btn-block btn-warning">Volver</a>
                    </div>
                    <div class="form-group col-md-6 offset-md-3 text-center">
                      <button type="submit" class="btn btn-lg btn-block btn-primary">Editar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php
  include('views/footer.php');
  include('views/scripts.php');
  ?>
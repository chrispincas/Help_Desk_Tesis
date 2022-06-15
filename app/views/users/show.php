<?php
	$user = $this->d['user'];
	$user_edit = $this->d['user_edit'];
	$role = $this->d['role'];
	$roles = $this->d['roles'];
	$groups = $this->d['groups'];

	$title = "Agregar Usuario";
	$bodyType = "";
	//Array of additional js files to be loaded
	$jsAdditional = [
	];
	//Array of additional css files to be loaded
	$cssAdditional = [
		"/public/assets/css/custom.css"
	];

	require_once 'views/header.php';
?>
<div id="app">
	<?php require_once 'views/sidebar.php'; ?>
		<div id="main" class="layout-navbar">

		<?php require_once 'views/topbar.php'; ?>
		<div id="main-content">

		<div class="page-content">
			<section class="row">
				<?php $this->showMessages();?>
				<div class="card">
					<div class="header-card pt-4 px-3">
						<h3>Editar Usuario</h3>
					</div>
					<div class="body-card px-3 py-3">
						<form action="<?php echo URL?>/users/updateUser" method="POST" class="form form-vertical needs-validation" novalidate>
							<input type="hidden" name="id" value="<?php echo $user_edit->getId()?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="name">Nombre</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Nombre Completo" id="name" name="name" value="<?php echo $user_edit->getName()?>" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-person-circle"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="employeeId">Código de empleado</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Nombre Completo" id="employeeId" name="employeeId" value="<?php echo $user_edit->getEmployeeId()?>" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-person-circle"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="email">Email</label>
											<div class="position-relative">
												<input type="email" class="form-control" placeholder="Correo electrónico" id="email" name="email" value="<?php echo $user_edit->getEmail()?>" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-envelope"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="groupId">Grupo</label>
											<div class="position-relative">
												<select name="groupId" id="groupId" class="form-control form-select">
													<?php foreach($groups as $g):?>
														<option <?php echo ($user_edit->getGroupId()==$g->getId()) ? "selected" : ""; ?> value="<?php echo $g->getId() ?>"><?php echo $g->getGroup() ?></option>
													<?php endforeach?>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="roleId">Rol</label>
											<div class="position-relative">
												<select name="roleId" id="roleId" class="form-control form-select">
													<?php foreach($roles as $r):?>
														<option <?php echo ($user_edit->getRoleId()==$r->getId()) ? "selected" : ""; ?> value="<?php echo $r->getId() ?>"><?php echo $r->getRol() ?></option>
													<?php endforeach?>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="status">Estado</label>
											<div class="position-relative">
												<select name="status" id="status" class="form-control form-select">
													<option <?php echo ($user_edit->getStatus()==0) ? "selected" : ""; ?> value="0">Inactivo</option>
													<option <?php echo ($user_edit->getStatus()==1) ? "selected" : ""; ?> value="1">Activo</option>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="createdAt">Fecha Creación</label>
											<div class="position-relative">
												<input type="createdAt" class="form-control" placeholder="Correo electrónico" id="createdAt" name="createdAt" value="<?php echo $user_edit->getCreatedAt()?>" disabled>
												<div class="form-control-icon pb-2">
													<i class="bi bi-envelope"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="modifiedAt">Última Modificación</label>
											<div class="position-relative">
												<input type="modifiedAt" class="form-control" placeholder="Correo electrónico" id="modifiedAt" name="modifiedAt" value="<?php echo $user_edit->getModifiedAt()?>" disabled>
												<div class="form-control-icon pb-2">
													<i class="bi bi-envelope"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 d-flex mt-3 justify-content-center">
										<button type="submit" class="btn btn-primary me-1 mb-1">Editar Usuario</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>

		<?php require_once 'views/footer.php'; ?>
	</div>
</div>
</div>
<?php
require_once 'views/scripts.php';;
?>
<script>
	(function () {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>

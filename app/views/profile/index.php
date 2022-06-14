<?php
$user = $this->d['user'];
$user_edit = $this->d['user_edit'];
$role = $this->d['role'];
$roles = $this->d['roles'];

$title = "Perfil de Usuario";
$bodyType = "";
//Array of additional js files to be loaded
$jsAdditional = [];
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
					<?php $this->showMessages(); ?>
					<div class="card">
						<div class="header-card pt-4 px-3">
							<h3>Actualización de datos</h3>
						</div>
						<div class="body-card px-3 py-3">
							<form action="<?php echo URL ?>/users/updateProfile" method="POST" class="form form-vertical needs-validation" novalidate>
								<input type="hidden" name="id" value="<?php echo $user_edit->getId() ?>">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group has-icon-left">
												<label class="mb-2" for="name">Nombre</label>
												<div class="position-relative">
													<input type="text" class="form-control" placeholder="Nombre Completo" id="name" name="name" value="<?php echo $user_edit->getName() ?>" required>
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
													<input type="email" class="form-control" placeholder="Correo electrónico" id="email" name="email" value="<?php echo $user_edit->getEmail() ?>" required>
													<div class="form-control-icon pb-2">
														<i class="bi bi-envelope"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group has-icon-left">
												<label class="mb-2" for="employeeId">Código de empleado</label>
												<div class="position-relative">
													<input type="text" class="form-control" placeholder="Nombre Completo" id="employeeId" name="employeeId" value="<?php echo $user_edit->getEmployeeId() ?>" disabled>
													<div class="form-control-icon pb-2">
														<i class="bi bi-person-circle"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group has-icon-left">
												<label class="mb-2" for="createdAt">Fecha Creación</label>
												<div class="position-relative">
													<input type="createdAt" class="form-control" placeholder="Correo electrónico" id="createdAt" name="createdAt" value="<?php echo $user_edit->getCreatedAt() ?>" disabled>
													<div class="form-control-icon pb-2">
														<i class="bi bi-envelope"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group has-icon-left">
												<label class="mb-2" for="modifiedAt">Última Modificación</label>
												<div class="position-relative">
													<input type="modifiedAt" class="form-control" placeholder="Correo electrónico" id="modifiedAt" name="modifiedAt" value="<?php echo $user_edit->getModifiedAt() ?>" disabled>
													<div class="form-control-icon pb-2">
														<i class="bi bi-envelope"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 d-flex mt-3 justify-content-center">
											<button type="submit" class="btn btn-primary me-1 mb-1">Actualizar datos</button>
											<button type="button" class="btn btn-danger me-1 mb-1" data-bs-toggle="modal" data-bs-target="#inlineForm">Cambiar Clave</button>
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
<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel33">Cambiar contraseña</h4>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<i class="bi bi-x-lg"></i>
				</button>
			</div>
			<form action="<?php echo URL ?>/users/updatePassword" method="POST" class="form needs-validation">
				<input type="hidden" value="<?php echo $user_edit->getId() ?>" name="id">
				<div class="modal-body">
					<label>Nueva Clave: </label>
					<div class="form-group mt-2">
						<input type="password" placeholder="Nueva Clave" name="password" class="form-control" required>
					</div>
					<label>Repita la clave: </label>
					<div class="form-group mt-2">
						<input type="password" placeholder="Repita la nueva clave" name="password2" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary ml-1">
						Cambiar clave
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
require_once 'views/scripts.php';;
?>
<script>
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
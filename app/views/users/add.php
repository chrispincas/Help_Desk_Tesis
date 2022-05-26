<?php
	$user = $this->d['user'];
	$role = $this->d['role'];
	$roles = $this->d['roles'];
	$groups = $this->d['groups'];

	$title = "Agregar Usuario";
	$bodyType = "";
	//Array of additional js files to be loaded
	$jsAdditional = [
		"/public/assets/vendors/summernote/summernote-lite.min.js"
	];
	//Array of additional css files to be loaded
	$cssAdditional = [
		"/public/assets/css/custom.css",
		"/public/assets/vendors/summernote/summernote-lite.min.css"
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
						<h3>Agregar Usuario</h3>
					</div>
					<div class="body-card px-3 py-3">
						<form action="<?php echo URL?>/users/newUser" method="POST" class="form form-vertical needs-validation" novalidate>
							<div class="form-body">
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="name">Nombre</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Nombre Completo" id="name" name="name" required>
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
												<input type="email" class="form-control" placeholder="Correo electrónico" id="email" name="email" required>
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
														<option value="<?php echo $g->getId() ?>"><?php echo $g->getGroup() ?></option>
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
														<option value="<?php echo $r->getId() ?>"><?php echo $r->getRol() ?></option>
													<?php endforeach?>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-center">
										<button type="submit" class="btn btn-primary me-1 mb-1">Agregar Usuario</button>
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

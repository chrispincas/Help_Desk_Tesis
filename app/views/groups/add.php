<?php
	$user = $this->d['user'];
	$role = $this->d['role'];

	$title = "Agregar Grupo";
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
						<h3>Agregar Grupo</h3>
					</div>
					<div class="body-card px-3 py-3">
						<form action="<?php echo URL?>/groups/newGroup" method="POST" class="form form-vertical needs-validation" novalidate>
							<div class="form-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="groupName">Nombre del Grupo</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Nombre del Grupo" id="groupName" name="groupName" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-person-circle"></i>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-12 d-flex justify-content-center">
										<button type="submit" class="btn btn-primary me-1 mb-1">Agregar Grupo</button>
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

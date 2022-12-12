<?php
	$user = $this->d['user'];
	$role = $this->d['role'];
	$categories = $this->d['categories'];
	$users = $this->d['users'];
	$groups = $this->d['groups'];

	$title = "Agregar Ticket";
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
						<h3>Agregar Ticket</h3>
					</div>
					<div class="body-card px-3 py-3">
						<form action="<?php echo URL?>/tickets/newTicket" method="POST" class="form form-vertical needs-validation" enctype="multipart/form-data" onsubmit="return postForm()" novalidate>
							<div class="form-body">
								<div class="row">
									<?php if($user->getRoleId()==1 || $user->getRoleId()==2):?>
										<div class="col-md-12">
											<div class="form-group has-icon-left">
												<label class="mb-2" for="userId">Usuario</label>
												<div class="position-relative">
													<select name="userId" id="userId" class="form-control form-select" required>
														<option value="">Escoja una opción</option>
														<?php foreach($users as $c):?>
														<option value="<?php echo $c->getId() ?>"><?php echo $c->getName() ?></option>
														<?php endforeach?>
													</select>
													<div class="form-control-icon pb-2">
														<i class="bi bi-person-circle"></i>
													</div>
												</div>
											</div>
										</div>
									<?php else:?>
										<input type="hidden" name="userId" value="<?php echo $user->getId()?>">
									<?php endif?>
									
									<div class="col-md-12">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="subject">Resumen</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Resumen" id="subject" name="subject" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-phone"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="priority">Tipo de impacto</label>
											<div class="position-relative">
												<select name="priority" id="priority" class="form-control form-select">
													<option value="Bajo">Bajo</option>
													<option value="Medio">Medio</option>
													<option value="Alto">Alto</option>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="category">Tipo de servicio</label>
											<div class="position-relative">
												<select name="category" id="category" class="form-control form-select" required>
													<option value="">Escoja una opción</option>
													<?php foreach($categories as $c):?>
													<option value="<?php echo $c->getId() ?>"><?php echo $c->getCategory() ?></option>
													<?php endforeach?>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-card-list"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="subcategory">Tipo de requerimiento</label>
											<div class="position-relative">
												<select name="subcategory" id="subcategory" class="form-control form-select" required>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-card-list"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="phone">Teléfono</label>
											<div class="position-relative">
												<input type="tel" class="form-control" placeholder="Teléfono" id="phone" name="phone" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-phone"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="email">Correo</label>
											<div class="position-relative">
												<?php if($user->getRoleId()>2):?>
													<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $user->getEmail()?>" readonly="true" required >
												<?php else:?>
													<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $user->getEmail()?>" required >
												<?php endif?>
												<div class="form-control-icon pb-2">
													<i class="bi bi-envelope"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="subcategory">Asignación</label>
											<div class="position-relative">
												<select name="group" id="group" class="form-control form-select" required>
													<?php foreach($groups as $g):?>
														<option value="<?php echo $g->getId() ?>"><?php echo $g->getGroup() ?></option>
													<?php endforeach?>
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-card-list"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="mb-2" for="attachments">Evidencias (Opcional)</label>
											<input class="form-control" type="file" name="attachments" id="attachments">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label class="mb-2" for="description" class="mb-2">Descripción</label>
											<textarea name="description" id="description"></textarea>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-center">
										<button type="submit" class="btn btn-primary me-1 mb-1">Enviar</button>
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
<script>
	$('#description').summernote({
		tabsize: 2,
		height: 120,
		styleWithSpan: false
	})

	function postForm() {
		$('textarea[name="description"]').html($('#description').code());
	}

	$("#category").change(function(){
		const id = parseInt($(this).val())
		if(id!=0){
			$.post("<?php echo constant('URL')?>/tickets/getSubcategories",
			{categoryId:id},
			function(res){
				$("#subcategory").html("")
				if(JSON.parse(res).length > 0){
					$.each(JSON.parse(res), function(index, value){
						$("#subcategory").append("<option value='"+value.id+"'>"+value.subcategory+"</option>")
					})
				}
				
			})
		}else{
			$("#subcategory").html("")
		}
	})
</script>
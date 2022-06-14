<?php
	$user = $this->d['user'];
	$role = $this->d['role'];
	$categories = $this->d['categories'];
	$subcategories = $this->d['subcategories'];
	$ticketStatus = $this->d['ticketStatus'];
	$tickets = $this->d['tickets'];
	$comments = $this->d['comments'];

	$title = "Ver Ticket";
	$bodyType = "";
	//Array of additional js files to be loaded
	$jsAdditional = [
		"/public/assets/vendors/summernote/summernote-lite.min.js"
	];
	//Array of additional css files to be loaded
	$cssAdditional = [
		"/public/assets/css/widgets/chat.css",
		"/public/assets/css/custom.css",
		"/public/assets/vendors/summernote/summernote-lite.min.css",
	];

	function actualValue($actual, $expected) {
		if ($actual == $expected) {
			echo "selected";
		}
	}

	function booleanActualValue($actual, $expected) {
		if ($actual == $expected) {
			return true;
		}
	}

	function isOwnerChat($actualUserId, $expectedUserId){
		$content = '';
		if ($actualUserId == $expectedUserId) {
			$content = 'chat-left';
		}else{
			$content = '';
		}
		echo $content;
	}

	function isOwnerDate($actualUserId, $expectedUserId){
		$content = '';
		if ($actualUserId == $expectedUserId) {
			$content = 'left';
		}else{
			$content = 'right';
		}
		echo $content;
	}

	require_once 'views/header.php';
?>
<style>

</style>
<div id="app">
	<?php require_once 'views/sidebar.php'; ?>
	<div id="main">
		<header class="mb-3">
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>
		</header>

		<div class="page-heading">
			<h3>
				Agregar Ticket - <?php echo $user->getName() ?>
				(<?php echo $role->getRole() ?>)
			</h3>
		</div>
		<div class="page-content">
			<section class="row">
				<?php $this->showMessages();?>
				<div class="card">
					<div class="header-card pt-4 px-3">
						<h3>Ticket # <?php echo $tickets->getId()?> - <?php echo $tickets->getSubject()?></h3>
					</div>
					<div class="body-card px-3 py-3">
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col-md-6">
										<div class="name">
											<h6 class="mb-1">Datos Generales</h6>
											<span class="text-s">Nombre: <?php echo $tickets->getName()?></span></br>
											<span class="text-s">Telefono: <?php echo $tickets->getPhone()?></span></br>
											<span class="text-s">Email: <?php echo $tickets->getEmail()?></span></br>
											<span class="text-s">Fecha de creacion: <?php echo $tickets->getCreatedAt()?></span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="name">
											<h6 class="mb-1">Archivos adjuntos</h6>
											<a href="<?php echo $tickets->getFiles()?>" target="_blank" class="text-s"><?php echo $tickets->getFiles()?></a></br>
										</div>
									</div>
								</div>
								
							</div>
							<div class="card-body pt-4 bg-grey">
								<div class="chat-content">

									<div class="chat chat-left">
										<div class="chat-body">
											<div class="chat-message">
												<?php echo $tickets->getName()?>:
												<?php echo $tickets->getDescription()?>
											</div>
											<div class="chat-hour-left">Actualización : 2022-16-04 14:56:50</div>
										</div>
									</div>
									
									<?php foreach($comments as $com):?>
										<div class="chat <?php isOwnerChat($tickets->getUserId(), $com->getUserId()) ?>">
											<div class="chat-body">
												<div class="chat-message">
													<p><?php echo $com->getUserName()?>:</p>
													<?php echo $com->getComment()?>
												</div>
												<div class="chat-hour-<?php isOwnerDate($tickets->getUserId(), $com->getUserId())  ?>">
													Actualización: <?php echo $com->getCreatedAt()?>
												</div>
											</div>
										</div>
									<?php endforeach?>
									
								
								</div>
							</div>
							<?php if($tickets->getStatus() != "Cerrado"):?>
							<div class="card-footer">
								<form action="<?php echo URL?>/tickets/updateTicket" method="POST" class="form form-vertical needs-validation" enctype="multipart/form-data" onsubmit="return postForm()" novalidate>
									<input type="hidden" value="<?php echo $tickets->getId()?>" name="id">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12 onlyAdmin">
												<h5>Reasignar campos</h5>
											</div>
											<div class="col-md-3 onlyAdmin">
												<div class="form-group has-icon-left">
													<label class="mb-2" for="ticketStatus">Estado de Ticket</label>
													<div class="position-relative">
														<select name="ticketStatus" id="ticketStatus" class="form-control form-select" >
															<?php foreach($ticketStatus as $t):?>
																<option <?php actualValue($tickets->getStatus(),$t->getStatus())?> value="<?php echo $t->getId()?>"><?php echo $t->getStatus()?></option>
															<?php endforeach?>
														</select>
														<div class="form-control-icon pb-1">
															<i class="bi bi-flag-fill"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3 onlyAdmin">
												<div class="form-group has-icon-left">
													<label class="mb-2" for="priority">Tipo de impacto</label>
													<div class="position-relative">
														<select name="priority" id="priority" class="form-control form-select" >
															<option <?php actualValue($tickets->getPriority(),"Bajo")?> value="Bajo">Bajo</option>
															<option <?php actualValue($tickets->getPriority(),"Medio")?> value="Medio">Medio</option>
															<option <?php actualValue($tickets->getPriority(),"Alto")?> value="Alto">Alto</option>
														</select>
														<div class="form-control-icon pb-1">
															<i class="bi bi-backspace-fill"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3 onlyAdmin">
												<div class="form-group has-icon-left">
													<label class="mb-2" for="category">Tipo de servicio</label>
													<div class="position-relative">
														<select name="category" id="category" class="form-control form-select"  required>
															<option value="">Escoja una opción</option>
															<?php foreach($categories as $c):?>
															<option <?php actualValue($tickets->getCategory(),$c->getCategory())?> value="<?php echo $c->getId() ?>"><?php echo $c->getCategory() ?></option>
															<?php endforeach?>
														</select>
														<div class="form-control-icon pb-1">
															<i class="bi bi-card-list"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3 onlyAdmin">
												<div class="form-group has-icon-left">
													<label class="mb-2" for="subcategory">Tipo de requerimiento</label>
													<div class="position-relative">
														<select name="subcategory" id="subcategory" class="form-control form-select"  required>
														<?php foreach($subcategories as $s):?>
															<?php if(booleanActualValue($tickets->getSubcategory(),$s->getSubcategory())):?>
																<option value="<?php echo $s->getId() ?>"><?php echo $s->getSubcategory() ?></option>
															<?php endif?>
														<?php endforeach?>
														</select>
														<div class="form-control-icon pb-1">
															<i class="bi bi-card-list"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label class="mb-2" for="description" class="mb-2">Agregar Comentario</label>
													<textarea name="description" id="description"></textarea>
												</div>
											</div>
											<div class="col-12 d-flex justify-content-center">
												<button type="submit" name="closeTicket" value="no" class="btn btn-primary me-1 mb-1">Comentar</button>
												<button type="submit" name="closeTicket" value="yes" class="btn btn-danger me-1 mb-1">Cerrar Ticket</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<?php endif?>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php require_once 'views/footer.php'; ?>
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
<script>
	<?php if($user->getRoleId()<=2):?>
		$('.onlyAdmin').show();
	<?php endif?>
	$('#description').summernote({
		tabsize: 2,
		height: 120,
		styleWithSpan: false
	})

	function postForm() {
		$('textarea[name="description"]').html($('#description').code());
	}

	$("#category").change(function() {
		const id = parseInt($(this).val())
		if (id != 0) {
			$.post("<?php echo constant('URL') ?>/tickets/getSubcategories", {
					categoryId: id
				},
				function(res) {
					$("#subcategory").html("")
					if (JSON.parse(res).length > 0) {
						$.each(JSON.parse(res), function(index, value) {
							$("#subcategory").append("<option value='" + value.id + "'>" + value.subcategory + "</option>")
						})
					}

				})
		} else {
			$("#subcategory").html("")
		}
	})
</script>
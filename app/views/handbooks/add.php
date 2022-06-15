<?php
	$user = $this->d['user'];
	$role = $this->d['role'];
	$categories = $this->d['categories'];

	$title = "Agregar Manual";
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
						<h3>Agregar Manual</h3>
					</div>
					<div class="body-card px-3 py-3">
						<form action="<?php echo URL?>/handbooks/create" method="POST" class="form form-vertical needs-validation" enctype="multipart/form-data" novalidate>
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="title">Nombre de manual</label>
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Nombre de manual" id="title" name="title" required>
												<div class="form-control-icon pb-2">
													<i class="bi bi-book"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="mb-2" for="attachments">Archivo</label>
											<input class="form-control" type="file" name="attachments" id="attachments">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group has-icon-left">
											<label class="mb-2" for="categoryId">Categoria</label>
											<div class="position-relative">
												<select name="categoryId" id="categoryId" class="form-control form-select">
													<option value="">Escoja una opción</option>
													<?php foreach($categories as $c):?>
														<option value="<?php echo $c->getId() ?>"><?php echo $c->getCategory() ?></option>
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
											<label class="mb-2" for="subcategoryId">Subcategoria</label>
											<div class="position-relative">
												<select name="subcategoryId" id="subcategoryId" class="form-control form-select">
												</select>
												<div class="form-control-icon pb-2">
													<i class="bi bi-backspace-fill"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-center">
										<button type="submit" class="btn btn-primary me-1 mb-1">Agregar Manual</button>
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
	$(document).ready(function(){
		$("#categoryId").change(function(){
			const id = parseInt($(this).val())
			if(id!=0){
				$.post("<?php echo constant('URL')?>/tickets/getSubcategories",
				{categoryId:id},
				function(res){
					$("#subcategoryId").html("")
					if(JSON.parse(res).length > 0){
						$.each(JSON.parse(res), function(index, value){
							$("#subcategoryId").append("<option value='"+value.id+"'>"+value.subcategory+"</option>")
						})
					}
					
				})
			}else{
				$("#subcategoryId").html("")
			}
		})
	})
</script>

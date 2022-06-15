<?php
$user = $this->d['user'];
$role = $this->d['role'];
$tickets = $this->d['tickets'];

$title = "Tickets";
$bodyType = "";
//Array of additional js files to be loaded
$jsAdditional = [
	"/public/assets/vendors/simple-datatables/simple-datatables.js",
	"/public/assets/vendors/sweetalert2/sweetalert2.all.min.js",
];
//Array of additional css files to be loaded
$cssAdditional = [
	"/public/assets/css/custom.css",
	"/public/assets/vendors/simple-datatables/style.css",
	"/public/assets/vendors/sweetalert2/sweetalert2.min.css",
];

function expiration($initialDate, $finalDate, $status, $priority){
	if($status == "Cerrado"){
		$initialDate = strtotime($initialDate);
		$finalDate = strtotime($finalDate);
		$difference = $finalDate - $initialDate;
		$hours = round($difference / (60 * 60), 0);
		if($hours < 1){
			$mins = round($difference / 60, 0);
			$time = $mins." minutos";
		}else{
			$time = $hours." horas";
		}
		return "<span class='badge bg-success'>".$time."</span>";
	}else{
		$initialDate = strtotime($initialDate);
		$finalDate = strtotime(date("Y-m-d H:i:s"));
		$difference = $finalDate - $initialDate;
		$hours = round($difference / (60 * 60), 0);
		if($hours < 1){
			$mins = round($difference / 60, 0);
			$time = $mins." minutos";
		}else{
			$time = $hours." horas";
		}
		switch ($priority) {
			case "Alto":
				if ($hours <= 24) {
					return "<span class='badge bg-warning text-dark'>".$time."</span>";
				} else {
					return "<span class='badge bg-danger'>Vencido".$time."</span>";
				}
				break;
			case "Medio":
				if ($hours <= 48) {
					return "<span class='badge bg-warning text-dark'>".$time."</span>";
				} else {
					return "<span class='badge bg-danger'>Vencido ".$time."</span>";
				}
				break;
			case "Bajo":
				if ($hours <= 72) {
					return "<span class='badge bg-warning text-dark'>".$time."</span>";
				} else {
					return "<span class='badge bg-danger'>Vencido ".$time."</span>";
				}
				break;
			default;
				break;
		}
	}
}

require_once 'views/header.php';

?>

<div id="app">
	<?php require_once 'views/sidebar.php'; ?>
	<div id="main" class="layout-navbar">

		<?php require_once 'views/topbar.php'; ?>
		<div id="main-content">

			<div class="page-heading">
				<h3>
					Módulo Tickets
				</h3>
			</div>
			<div class="page-content">
				<section class="row">
					<?php $this->showMessages(); ?>
					<div class="card">
						<div class="header-card pt-4 px-3">
							<a href="<?php echo URL ?>/tickets/add" class="btn btn-success">Agregar ticket</a>
						</div>
						<div class="body-card px-3 py-3">
							<table class="table table-striped mt-3" id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Asunto</th>
										<th>Categoría</th>
										<th>Subcategoría</th>
										<th>Usuario</th>
										<th>Estado</th>
										<th>Fecha Creación</th>
										<th>Fecha Modificación</th>
										<th>Vencimiento</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tickets as $t) : ?>
										<tr>
											<td><?php echo $t->getId() ?></td>
											<td><?php echo $t->getSubject() ?></td>
											<td><?php echo $t->getCategory() ?></td>
											<td><?php echo $t->getSubcategory() ?></td>
											<td><?php echo $t->getName() ?></td>
											<td>
												<span class="badge <?php echo $t->getStatus() == "Cerrado" ? 'bg-danger' : 'bg-primary'; ?>"><?php echo $t->getStatus() ?></span>
											</td>
											<td><?php echo $t->getCreatedAt() ?></td>
											<td><?php echo $t->getModifiedAt() ?></td>
											<td><?php echo expiration($t->getCreatedAt(), $t->getModifiedAt(), $t->getStatus(), $t->getPriority()) ?></td>
											<td>
												<a href="<?php echo URL ?>/tickets/showTicket?id=<?php echo $t->getId() ?>" class="btn btn-primary">
													<i class="bi bi-eye"></i>
												</a>
												<?php if ($user->getRoleId() <= 2) : ?>
													<a href="#" data-id="<?php echo $t->getId() ?>" class="btn btn-danger removeTicket">
														<i class="bi bi-trash"></i>
													</a>
												<?php endif ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
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
	let table1 = document.querySelector('#table');
	let dataTable = new simpleDatatables.DataTable(table1);

	document.addEventListener('click', function(e) {
		for (let t = e.target; t && t != this; t = t.parentNode) {
			if (t.matches("#table tbody tr td a.removeTicket")) {
				let id = $(t).attr('data-id')
				Swal.fire({
					title: 'Seguro desea borrar el ticket ' + id + '?',
					text: "No podrá revertir el cambio!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, quiero borrar el registro!',
					cancelButtonText: 'No, cancelar!',
				}).then((result) => {
					if (result.isConfirmed) {
						location.href = '<?php echo URL ?>/tickets/removeTicket?id=' + id;
					}
				})
				break
			}
		}
	}, false)
</script>
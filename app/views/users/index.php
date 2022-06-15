<?php
$user = $this->d['user'];
$role = $this->d['role'];
$users = $this->d['users'];

$title = "Usuarios";
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

require_once 'views/header.php';

?>

<div id="app">
	<?php require_once 'views/sidebar.php'; ?>
	<div id="main" class="layout-navbar">

		<?php require_once 'views/topbar.php'; ?>
		<div id="main-content">

			<div class="page-heading">
				<h3>
					Módulo Usuarios
				</h3>
			</div>
			<div class="page-content">
				<section class="row">
					<?php $this->showMessages(); ?>
					<div class="card">
						<div class="header-card pt-4 px-3">
							<a href="<?php echo URL ?>/users/add" class="btn btn-success">Agregar Usuario</a>
						</div>
						<div class="body-card px-3 py-3">
							<table class="table table-striped mt-3" id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Código</th>
										<th>Email</th>
										<th>Grupo</th>
										<th>Rol</th>
										<th>Estado</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($users as $u) : ?>
										<tr>
											<td><?php echo $u->getId() ?></td>
											<td><?php echo $u->getName() ?></td>
											<td><?php echo $u->getEmployeeId() ?></td>
											<td><?php echo $u->getEmail() ?></td>
											<td><?php echo $u->getGroupName() ?></td>
											<td><?php echo $u->getRoleName() ?></td>
											<td>
												<?php if($u->getStatus() == "0"):?>
													<span class="badge bg-danger">Inactivo</span>
												<?php else: ?>
													<span class="badge bg-success">Activo</span>
												<?php endif; ?>
											</td>
											<td>
												<a href="<?php echo URL ?>/users/showUser?id=<?php echo $u->getId() ?>" class="btn btn-primary">
													<i class="bi bi-eye"></i>
												</a>
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

	
</script>
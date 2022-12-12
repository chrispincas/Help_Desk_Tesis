<?php
$user = $this->d['user'];
$handbooks = $this->d['handbooks'];
$role = $this->d['role'];

$title = "Manuales";
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
					Módulo Manuales
				</h3>
			</div>
			<div class="page-content">
				<section class="row">
					<?php $this->showMessages(); ?>
					<div class="card">
						<div class="header-card pt-4 px-3">
							<?php if($user->getRoleId()==1):?>
							<a href="<?php echo URL ?>/handbooks/add" class="btn btn-success">Agregar Manual</a>
							<?php endif?>
						</div>
						<div class="body-card px-3 py-3">
							<table class="table table-striped mt-3" id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Título</th>
										<th>Categoría</th>
										<th>Subcategoría</th>
										<th>Url</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($handbooks as $h) : ?>
										<tr>
											<td><?php echo $h->getId() ?></td>
											<td><?php echo $h->getCategory()?></td>
											<td><?php echo $h->getSubcategory() ?></td>
											<td><?php echo $h->getTitle() ?></td>
											<td><a href="<?php echo $h->getUrl() ?>" target="_blank"><?php echo $h->getUrl() ?></a></td>
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
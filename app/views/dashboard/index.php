<?php

$user = $this->d['user'];
$role = $this->d['role'];
$total_users = $this->d['total_users'];
$total_tickets = $this->d['total_tickets'];
$total_tickets_status = $this->d['total_tickets_status'];
$total_tickets_category = $this->d['total_tickets_category'];

$json_total_tickets_status = [];
$json_total_tickets_category = [];

foreach ($total_tickets_status as $t){
	$json_total_tickets_status[] = [
		'name'=>$t->getField(),
		'data'=>[(int)$t->getCount()]
	];
}

foreach ($total_tickets_category as $t){
	$json_total_tickets_category[] = [
		'name'=>$t->getField(),
		'data'=>[(int)$t->getCount()]
	];
}
$json_total_tickets_status = json_encode($json_total_tickets_status);
$json_total_tickets_category = json_encode($json_total_tickets_category);

$title = "Home";
$bodyType = "";
//Array of additional js files to be loaded
$jsAdditional = [
	"/public/assets/js/pages/dashboard.js",
];
//Array of additional css files to be loaded
$cssAdditional = [
	"/public/assets/css/custom.css",
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
					Panel Principal
				</h3>
			</div>
			<div class="page-content">
				<section class="row">
					<div class="col-12 col-lg-12">
						<div class="row">
							<div class="col-6 col-lg-4 col-md-6">
								<div class="card">
									<div class="card-body px-3 py-4-5">
										<div class="row">
											<div class="col-md-4">
												<div class="stats-icon purple">
													<i class="iconly-boldShow"></i>
												</div>
											</div>
											<div class="col-md-8">
												<h6 class="text-muted font-semibold">Tickets Abiertos</h6>
												<h6 class="font-extrabold mb-0">
													<?php echo $total_tickets->getCount() ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-4 col-md-6">
								<div class="card">
									<div class="card-body px-3 py-4-5">
										<div class="row">
											<div class="col-md-4">
												<div class="stats-icon blue">
													<i class="iconly-boldProfile"></i>
												</div>
											</div>
											<div class="col-md-8">
												<h6 class="text-muted font-semibold">Total Usuarios</h6>
												<h6 class="font-extrabold mb-0">
													<?php echo $total_users->getCount() ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-4 col-md-6">
								<div class="card">
									<div class="card-body px-3 py-4-5">
										<div class="row">
											<div class="col-md-4">
												<div class="stats-icon red">
													<i class="iconly-boldBookmark"></i>
												</div>
											</div>
											<div class="col-md-8">
												<h6 class="text-muted font-semibold">Total Manuales</h6>
												<h6 class="font-extrabold mb-0">13</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="card">
									<div class="card-header">
										<h4>Estado de tickets</h4>
									</div>
									<div class="card-body">
										<div id="chart-profile-visit"></div>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="card">
									<div class="card-header">
										<h4>Asignación de tickets</h4>
									</div>
									<div class="card-body">
										<div id="chart-pie"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			<?php require_once 'views/footer.php'; ?>
		</div>
	</div>
</div>
<script>
	const json_ticket_status = <?php echo $json_total_tickets_status?>;
	const json_tickets_category = <?php echo $json_total_tickets_category?>;
</script>
<?php
require_once 'views/scripts.php';;
?>
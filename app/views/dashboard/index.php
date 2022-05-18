<?php

$user = $this->d['user'];
$role = $this->d['role'];

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
							<div class="col-6 col-lg-3 col-md-6">
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
												<h6 class="font-extrabold mb-0">112</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-3 col-md-6">
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
												<h6 class="font-extrabold mb-0">183</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-3 py-4-5">
										<div class="row">
											<div class="col-md-4">
												<div class="stats-icon green">
													<i class="iconly-boldAdd-User"></i>
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
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-3 py-4-5">
										<div class="row">
											<div class="col-md-4">
												<div class="stats-icon red">
													<i class="iconly-boldBookmark"></i>
												</div>
											</div>
											<div class="col-md-8">
												<h6 class="text-muted font-semibold">FAQs</h6>
												<h6 class="font-extrabold mb-0">10</h6>
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
<?php
require_once 'views/scripts.php';;
?>
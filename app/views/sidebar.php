<?php
	function loadMenuClassActive($item, $titlePage){
		foreach($item as $key => $value){
			if($value == $titlePage){
				echo "active";
			}
		}
	}
?>
<div id="sidebar" class="active">
	<div class="sidebar-wrapper active">
		<div class="sidebar-header">
			<div class="d-flex justify-content-between">
				<div class="logo">
					<a href="#">
						<img src="<?php echo URL ?>/public/assets/images/logo/logo.png" alt="Logo">
					</a>
				</div>
				<div class="toggler">
					<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
				</div>
			</div>
		</div>
		<div class="sidebar-menu">
			<ul class="menu">
				<li class="sidebar-item <?php loadMenuClassActive(["Home"],$title)?>">
					<a href="<?php echo URL ?>/dashboard" class='sidebar-link'>
						<i class="bi bi-grid-fill"></i>
						<span>Panel Principal</span>
					</a>
				</li>

				<?php if($user->getRoleId()==1):?>
					<li class="sidebar-item <?php loadMenuClassActive(["Usuarios", "Agregar Usuario", "Ver Usuario"],$title)?>">
						<a href="<?php echo URL ?>/users" class='sidebar-link'>
							<i class="bi bi-person-circle"></i>
							<span>Usuarios</span>
						</a>
					</li>
					<li class="sidebar-item <?php loadMenuClassActive(["Grupos", "Agregar Grupo", "Ver Grupo"],$title)?>">
						<a href="<?php echo URL ?>/groups" class='sidebar-link'>
							<i class="bi bi-people-fill"></i>
							<span>Grupos</span>
						</a>
					</li>
				<?php endif;?>

				<li class="sidebar-item <?php loadMenuClassActive(["Tickets", "Agregar Ticket", "Ver Ticket"],$title)?>">
					<a href="<?php echo URL ?>/tickets" class='sidebar-link'>
						<i class="bi bi-archive-fill"></i>
						<span>Tickets</span>
					</a>
				</li>

				<li class="sidebar-item <?php loadMenuClassActive(["Manuales", "Agregar Manual", "Ver Manual"],$title)?>">
					<a href="<?php echo URL ?>/handbooks" class='sidebar-link'>
						<i class="bi bi-file-code-fill"></i>
						<span>Manuales</span>
					</a>
				</li>
				
				<?php if($user->getRoleId()==1):?>
				<li class="sidebar-item <?php loadMenuClassActive(["Configuracion"],$title)?>">
					<a href="<?php echo URL ?>/settings" class='sidebar-link'>
						<i class="bi bi-gear-fill"></i>
						<span>Configuracion</span>
					</a>
				</li>
				<?php endif;?>
			</ul>
		</div>
		<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
	</div>
</div>
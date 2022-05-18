<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo APP_NAME." - ".$title; ?></title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo URL?>/public/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo URL?>/public/assets/vendors/iconly/bold.css">
	<link rel="stylesheet" href="<?php echo URL?>/public/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="<?php echo URL?>/public/assets/vendors/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="<?php echo URL?>/public/assets/css/app.css">
	<link rel="shortcut icon" href="<?php echo URL?>/public/assets/images/favicon.svg" type="image/x-icon">
	<?php if($cssAdditional>0): ?>
		<?php foreach($cssAdditional as $css): ?>
			<link rel="stylesheet" href="<?php echo URL.$css;?>"></link>
		<?php endforeach; ?>	
	<?php endif; ?>
</head>
<body class="<?php echo $bodyType;?>">
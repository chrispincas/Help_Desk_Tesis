  <script src="<?php echo URL?>/public/assets/vendors/jquery/jquery.min.js"></script>
	<script src="<?php echo URL?>/public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?php echo URL?>/public/assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo URL?>/public/assets/vendors/apexcharts/apexcharts.js"></script>
	<script src="<?php echo URL?>/public/assets/js/main.js"></script>
	
	<?php if($jsAdditional>0): ?>
		<?php foreach($jsAdditional as $js): ?>
			<script src="<?php echo URL.$js?>"></script>
		<?php endforeach; ?>	
	<?php endif; ?>
	
</body>

</html>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php $this->getInclude('head-complete'); ?>
	</head>
	<body class="nav-md">
		
		<div class="container body">
			<div class="main_container">
				<?php $this->getInclude('sidebar'); ?>
				<?php $this->getInclude('navbar'); ?>
				<div class="right_col" role="main">
					<?php
						// echo !isset($_SESSION) ? json_encode(array()) : json_encode($_SESSION);
					?>
				
					<?php $this->getPage($vista, $dataView); ?>
				</div>
				<footer>
					<div class="pull-right">
						<?php echo TITLE_MD  . " - " . getPowerBy(); ?>
					</div>
					<div class="clearfix"></div>
				</footer>
			</div>
		</div>
		<?php $this->getInclude('footer-complete'); ?>
		<?php $this->getInclude('templates-complete'); ?>
		<?php $this->getInclude('scripts-complete'); ?>
	</body>
</html>
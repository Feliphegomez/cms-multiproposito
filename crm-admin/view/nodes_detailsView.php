<?php
	$thisNode = $this->datos['node'];
	$thisPage = $this->datos;
?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3><?php echo "vista de nodos desde el sistema"; ?></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?php echo "[{$thisNode->id}] {$thisNode->title}"; ?></h2>
					<!-- //
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a></li>
								<li><a href="#">Settings 2</a></li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					</ul>
					-->
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?php
						#echo htmlentities(utf8_encode($thisNode->description), ENT_QUOTES | ENT_IGNORE, "UTF-8");
						#echo utf8_decode($thisNode->description);
						echo ($thisNode->description);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
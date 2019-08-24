

<hr>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Debug <small>Debug del sistema</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-xs-12">
			
			<div class="x_panel">
				<div class="x_title">
					<h2>all <small>basic table subtitle</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<section class="col-lg-12" style="height:400px;overflow-y:scroll;">
						<?php echo ($this->tableDebug($all)); ?>
					</section>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>this <small>basic table subtitle</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<section class="col-lg-12" style="height:400px;overflow-y:scroll;">
						<?php echo ($this->tableDebug($this)); ?>
					</section>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>helper <small>basic table subtitle</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<section class="col-lg-12" style="height:400px;overflow-y:scroll;">
						<?php echo ($this->tableDebug($helper)); ?>
					</section>
				</div>
			</div>
			
		</div>
	</div>
</div>





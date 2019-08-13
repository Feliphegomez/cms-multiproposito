<?php 
	$myInfo = $this->datos['user'];
	$thisPage = $this->datos;
	?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Mi Perfil</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						<?php echo $this->datos['title']; ?>
						<small><?php echo $this->datos['subtitle']; ?></small>
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<form action="<?php echo $this->linkUrl('Usuarios', 'mi_perfil_edit'); ?>" method="post">
					<?php 
						// echo json_encode($myInfo->__sleep());
						foreach($myInfo->createFieldsForm(array(
							'username',
							'names',
							'surname',
							'phone',
							'mobile',
							'email',
						), false, false) as $field) {
							$h = "<div class=\"form-group\">";
								$h .= "<label class=\"control-label col-xs-12\" for=\"first-name\">";
									$h .= "{$field->label} ";
									$h .= ($field->required === true) ? "<span class=\"required\">*</span>" : '';
								$h .= "</label>";
								$h .= "<div class=\"col-xs-12\">";
									$h .= ($field->innerHtml);
								$h .= "</div>";
							$h .= "</div>";	
							echo $h;
						};
					?>
					<div class="clearfix"></div>
					
					<div class="separator">
						<div>
							<input type="hidden" name="controller" value="Usuarios">
							<input type="hidden" name="view" value="mi_perfil_edit">
							<input type="submit" value="Guardar Cuenta" class="btn btn-default">
						</div>
					</div>
					<div class="clearfix"></div>
					<p><?php #echo $myInfo->fields; ?></p>
					
				</form>
				</div>
			</div>
		</div>
	</div>
</div>


				
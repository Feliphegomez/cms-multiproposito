<div>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<form action="<?php echo $this->linkUrl('Login', 'register'); ?>" method="post">
					<h1><?php echo $title; ?></h1>
					<p><?php echo $description; ?></p>
					
					<?php 
						foreach($this->user->createFieldsForm(null, true, false) as $field){
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
						<div>
							<?php echo solvemedia_get_html(SM_KEY_PUBLIC, null, true); ?>
						</div>
					<!--
					  <div><input type="text" class="form-control" placeholder="Username" required="" /></div>
					  <div><input type="email" class="form-control" placeholder="Email" required="" /></div>
					  <div><input type="password" class="form-control" placeholder="Password" required="" /></div>
					  -->
						<div>
							<input type="hidden" name="controller" value="Login">
							<input type="hidden" name="view" value="login">
							<input type="submit" value="Crear Cuenta" class="btn btn-default">
							<a class="reset_pass" href="<?php echo $this->linkUrl('Login', 'index'); ?>">¿Ya tienes cuenta?</a>
						</div>
					<div class="clearfix"></div>
					<p>
						<?php #echo $this->user; ?>
						
					</p>
					
					<div class="separator">
						<p class="change_link">¿Ya tienes cuenta?
							<a href="<?php echo $this->linkUrl('Login', 'index'); ?>" class="to_register"> Ingresar </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i class="fa fa-paw"></i> <?php echo TITLE_MD; ?></h1>
							<p><?php echo TITLE_SM; ?> | Developer by <a href="https://github.com/Feliphegomez">FelipheGomez</a></p>
						</div>
					</div>
				</form>
				
				
			</section>
		</div>
	</div>
</div>
<div>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<form action="/login" method="post">
					<h1><?php echo $title; ?></h1>
					<p><?php echo $description; ?></p>
					  <div><input type="text" class="form-control" placeholder="Username" required="" /></div>
					  <div><input type="email" class="form-control" placeholder="Email" required="" /></div>
					  <div><input type="password" class="form-control" placeholder="Password" required="" /></div>
					<div>
						<input type="hidden" name="controller" value="Login">
						<input type="hidden" name="view" value="login">
						<input type="submit" value="Crear Cuenta" class="btn btn-default">
						<a class="reset_pass" href="<?php echo $this->linkUrl('Login', 'index'); ?>">¿Ya tienes cuenta?</a>
					</div>
					<div class="clearfix"></div>
					
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
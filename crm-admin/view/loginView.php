<div>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<form action="/login?redirect=<?php echo $this->linkUrl('Login', 'index', json_decode("{ \"result\": \"login\" }")); ?>" method="post">
					<h1><?php echo $title; ?></h1>
					<p><?php echo $description; ?></p>
					<div><input class="form-control" name="username" type="text" value="<?php echo (isset($this->post['username'])) ? $this->post['username'] : ''; ?>" placeholder="Tu usuario" required autocomplete="off" /></div>
					<div><input class="form-control" name="password" type="password" placeholder="Tu contraseña" required /></div>
					<div>
						<input type="hidden" name="controller" value="Login">
						<input type="hidden" name="view" value="login">
						<input type="submit" value="Ingresar" class="btn btn-default">
						<a class="reset_pass" href="<?php echo $this->linkUrl('Login', 'create'); ?>">¿Nuevo en <?php echo TITLE_XS; ?>?</a>
					</div>
					<div class="clearfix"></div>
					
					<div class="separator">
						<p class="change_link">Olvidaste tu contraseña?
							<a href="#" class="to_register"> Crear Cuenta </a>
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

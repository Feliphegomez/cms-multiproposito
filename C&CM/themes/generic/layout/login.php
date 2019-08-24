<?php 
if(
	isset($this->post['username'])
	&& isset($this->post['password'])
){
	if(!isset($_SESSION['user'])){
		$title = 'Upps!';
		$description = 'Datos invalidos, intenta nuevamente...';
	}else{
	}
}
?>

<div>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<form action="/login?redirect=<?php echo $helper->url('Login', 'validate'); ?>" method="post">
						<h1><?php echo $title; ?></h1>
						<p><?php echo $description; ?></p>
						<hr>
						<?php if(isUser() == false){ ?>
								<div><input class="form-control" name="username" type="text" value="<?php echo (isset($this->post['username'])) ? $this->post['username'] : ''; ?>" placeholder="Tu usuario" required autocomplete="off" /></div>
								<div><input class="form-control" name="password" type="password" placeholder="Tu contraseña" required /></div>
							
								<div>
									<input type="hidden" name="controller" value="Login">
									<input type="hidden" name="view" value="login">
									<input type="submit" value="Ingresar" class="btn btn-default">
									<a class="reset_pass" href="<?php echo $helper->url('Login', 'create'); ?>">¿Nuevo en <?php echo TITLE_XS; ?>?</a>
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
										<p><?php echo TITLE_MD  . " - " . getPowerBy(); ?></p>
									</div>
								</div>
						<?php } else { ?>
							Espere mientras lo redireccionamos...
							<meta http-equiv="Refresh" content="1; url=/index.html">
						<?php } ?>
					</form>
			</section>
		</div>
	</div>
</div>

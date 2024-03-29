<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?php echo (isset($_SESSION['user']) && isset($_SESSION['user']['username'])) ? $_SESSION['user']['username'] : 'Ingresa'; ?>
						<i class="fa fa-user"></i>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<?php if(isUser() == true){ ?>
							<li><a href="<?php echo $this->linkUrl('Usuarios', 'mi_perfil'); ?>"> Mi Perfil</a></li>
							<li>
								<a data-toggle="tooltip" data-placement="top" title="Salir">
									<form method="POST" action="/logout">
										<button style="background-color: transparent;border: 0px;" type="submit"><i class="fa fa-sign-out pull-right"></i>Cerrar Sesion</button>
									</form>
								</a>
							</li>
						<?php } else { ?>
							<li><a href="<?php echo linkUrl('Login', 'index'); ?>"> Ingresar</a></li>
							<li><a href="<?php echo $this->linkUrl('Login', 'create'); ?>"> Crear Cuenta</a></li>
						<?php } ?>
					</ul>
				</li>

				<?php if(isUser() == true){ ?>
					<?php
					if(isUser() && isset($this->adapter) && validatePermission($this->adapter, 'Usuarios', 'calendar')){ $this->getInclude('navbar-my-calendar'); };
					if(isUser() && isset($this->adapter) && validatePermission($this->adapter, 'Usuarios', 'inbox')){ $this->getInclude('navbar-inbox-user'); };
						if(isUser() && isset($this->adapter) && validatePermission($this->adapter, 'SAC', 'inbox')){ $this->getInclude('navbar-inbox-sac');	};
						if(isUser() && isset($this->adapter) && validatePermission($this->adapter, 'SAC', 'requests_new')){ $this->getInclude('navbar-requests-new'); };
						if(isUser() && isset($this->adapter) && validatePermission($this->adapter, 'SAC', 'requests_technicals')){ $this->getInclude('navbar-requests-technicals'); };
					?>
				<?php } ?>
			</ul>
		</nav>
	</div>
</div>

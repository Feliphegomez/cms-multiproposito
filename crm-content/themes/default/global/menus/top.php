<?php $myInfo = (isset($_SESSION['user'])) ? $_SESSION['user'] : null; ?>
<div class="nav_menu">
	<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="">
				<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php echo $this->getUserNames(); ?> 
					<i class="fa fa-user"></i> 
					<span class=" fa fa-angle-down"></span>
				</a>
				<ul class="dropdown-menu dropdown-usermenu pull-right">
					<?php if(ControladorBase::isUser() == true){ ?>
						<li><a href="<?php echo $this->linkUrl('Usuarios', 'mi_perfil'); ?>"> Mi Cuenta</a></li>
						<li>
							<a data-toggle="tooltip" data-placement="top" title="Salir">
								<form method="POST" action="/logout">
									<button style="background-color: transparent;border: 0px;" type="submit"><i class="fa fa-sign-out pull-right"></i>Cerrar Sesion</button>
								</form>
							</a>
						</li>
					<?php } else { ?>
						<li><a href="<?php echo $this->linkUrl('Login', 'index'); ?>"> Ingresar</a></li>
						<li><a href="<?php echo $this->linkUrl('Login', 'create'); ?>"> Crear Cuenta</a></li>
					<?php } ?>
				</ul>
			</li>
			
				
			<?php if(ControladorBase::isUser() == true){ ?>
				<!-- // mesageria publica -->
				<li role="presentation" class="dropdown" id="navbartop-notifications-inbox" @click="load()">
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-green" v-if="count > 0">{{ count }}</span>
					</a>
					<ul class="dropdown-menu list-unstyled msg_list" role="menu">
						<template v-if="records.length > 0">
							<li v-for="(inbox, i) in records">
								<a v-bind:href="'/index.php?controller=MiCuenta&action=inbox#/conversation/' + inbox.conversation.id + '/view'" v-if="inbox.conversation.conversations_replys[0]">
									<span>
										<span><b>{{ inbox.conversation.conversations_replys[0].user.names }} </b></span>
										<span class="time">{{ inbox.conversation.conversations_replys[0].created }}</span>
									</span>
									<span class="message">
										{{ inbox.conversation.conversations_replys[0].reply.slice(0,150) }}...
										<!-- <br><b>Estado PQRS: </b> {{ inbox.status.name }} -->
									</span>
								</a>
							</li>
						</template>
						<template v-else>
							<li>
								<a>
									<span><span></span><span class="time"></span></span>
									<span class="message">No hay conversaciones.</span>
								</a>
							</li>
						</template>
						
						<li>
							<div class="text-center">
								<a href="<?php echo $this->linkUrl('MiCuenta', 'inbox'); ?>">
									<strong>Bandeja de Mensajes</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul>
				</li>
			<?php } ?>
		</ul>
	</nav>
</div>
<?php if(ControladorBase::isUser() == true){ ?>
	<script>
	var NotificationsInboxNavbarTop = new Vue({
		data(){
			return {
				count: 0,
				records: []
			};
		},
		created(){
			var self = this;
			self.load();
		},
		methods: {
			load(){
				var self = this;
				api.get('/records/conversations_groups', {
					params: {
						filter: [
							'user,in,<?php echo ($myInfo['id']); ?>',
							// 'conversations.status,eq,2'
						],
						join: [
							'conversations',
							'conversations,conversations_replys',
							'conversations,conversations_replys,users_login',
						]
					}
				})
				.then(response => {
					self.validateResult(response);
				})
				.catch(e => {
					// Capturamos los errores
					self.validateResult(e);
				});
			},
			getLink(pqrs){
				var self = this;
				action = '';
				pqrs.id = (pqrs.id != undefined && pqrs.id > 0) ? pqrs.id : 0;
				typeId = (pqrs.type.id != undefined && pqrs.type.id > 0) ? pqrs.type.id : ((pqrs.type != undefined && pqrs.type > 0) ? pqrs.type : 0);
				return '/index.php?controller=PQRSF&action=ver_pqrsf&type=' + typeId + '&id=' + pqrs.id;
			},
			validateResult(response){
				var self = this;
				if (response.data != undefined && response.data.records != undefined){
					self.records = [];
					self.count = 0;
					if(response.data.records[0]){
						response.data.records.forEach(item => {
								self.records.push(item);
							if(item.status === 2){
								self.count++;
							}
						});
					} else {
						self.searchBox.errorText = "Esta queja no fue encontrada";
					}
				} else {
					 console.log('Error: consulta'); 
					 console.log(response.data); 
				}
			},
		},
	}).$mount('#navbartop-notifications-inbox');
	</script>
<?php } ?>
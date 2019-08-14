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
				
<div id="compose-inbox" class="compose col-md-6 col-xs-12">
	<div class="compose-header">
		Nuevo Mensaje para el Equipo Monteverde LTDA
		<button type="button" class="close compose-close">
			<span>×</span>
		</button>
	</div>
	
	
	<template  v-if="enabled == true">
		<div class="compose-body">
			<div id="alerts"></div>
			<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
					<ul class="dropdown-menu"></ul>
				</div>
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a data-edit="fontSize 5"><p style="font-size:17px">Huge</p></a></li>
						<li><a data-edit="fontSize 3"><p style="font-size:14px">Normal</p></a></li>
						<li><a data-edit="fontSize 1"><p style="font-size:11px">Small</p></a></li>
					</ul>
				</div>

				<div class="btn-group">
					<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
					<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
					<a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
					<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
				</div>

				<div class="btn-group">
					<a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
					<a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
					<a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
					<a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
				</div>

				<div class="btn-group">
					<a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
					<a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
					<a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
					<a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
				</div>

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
					<div class="dropdown-menu input-append">
						<input class="span2" placeholder="URL" type="text" data-edit="createLink" />
						<button class="btn" type="button">Add</button>
					</div>
					<a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
				</div>

				<div class="btn-group">
					<a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
					<input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
				</div>

				<div class="btn-group">
					<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
					<a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
				</div>
			</div>
			
			<div id="editor-compose" class="editor-wrapper"></div>
		</div>
		
		<div class="compose-footer">
			<button type="button" class="btn btn-md btn-default" @click="slideToggle">
				Cerrar
			</button>
			<button id="send" class="btn btn-sm btn-success" type="button">Enviar Mensaje</button>
		</div>
	</template>
	<template  v-else>
		<h4>¿Deseas contactarnos?</h4>
		<template  v-if="!session.user || !session.user.id">
			<div class="compose-body">
				FORMULARIO DE SOLICITUD DE 1RA VEZ
			</div>
			<div class="compose-footer">
				<button type="button" class="btn btn-md btn-default" @click="slideToggle">
					Cerrar
				</button>
				<button class="btn btn-md btn-success" type="button">
					Entiendo
				</button>
			</div>
		</template>
		<template  v-else>
			<div class="compose-body">
				<p>Mauris suscipit pharetra metus sed aliquam. Ut sem metus, vehicula vel turpis eget, tempus efficitur felis. Fusce tristique quis ex ut fringilla. Donec vitae nisi nisi. Donec in magna a dui dignissim consequat. Sed aliquam commodo nisl sit amet pharetra. Fusce eu mauris volutpat, laoreet mauris at, tincidunt nisl. Sed vitae consequat nisl. Duis eleifend orci a venenatis pulvinar. Mauris massa sapien, semper ut dui et, varius rhoncus ipsum.</p>
			</div>
			<div class="compose-footer">
				<button type="button" class="btn btn-md btn-default" @click="slideToggle">
					Cerrar
				</button>
				<button @click="compose" class="btn btn-md btn-success" type="button">
					Continuar
				</button>
			</div>
		</template>
			
	</template>
	
</div>

<script>
	var ComposeInbox = new Vue({
		data(){
			return {
				editor: null,
				enabled: false,
				conversation_id: 0,
				session: <?php echo json_encode(ControladorBase::validateSession()); ?>,
			};
		},
		mounted(){
			var self = this;
			console.log('enabled', self.enabled);
			console.log('conversation_id', self.conversation_id);
			console.log('session', self.session);
			self.init_compose();
		},
		methods: {
			init_compose(){
				var self = this;
				if( typeof ($.fn.slideToggle) === 'undefined'){
					console.log('init_compose undefined');
					return;
				}
				//self.slideToggle();
				console.log('init_compose');
			},
			slideToggle(){
				var self = this;
				$('#compose-inbox, .compose-close').slideToggle();
			},
			compose(){
				var self = this;
				console.log('compose');
				if(self.conversation_id > 0){
					self.loadConversation();
				}else{
					self.createConversation();
				}
			},
			loadConversation(){
				var self = this;
				console.log('loadConversation');
				console.log(self.conversation_id);
			},
			createConversation(){
				var self = this;
				api.post('/records/conversations', {
					status: 0
				})
				.then(r => {
					self.validateCreateConversationResult(r);
				})
				.catch(e => {
					// Capturamos los errores
					self.validateCreateConversationResult(e.response);
				});
			},
			validateCreateConversationResult(a){
				console.log('validateCreateConversationResult');
				var self = this;
				if(a.data > 0){
					self.enabled = true;
					self.conversation_id = a.data;
					self.init_wysiwyg();
				}
			},
			init_wysiwyg(){
				var self = this;
				console.log('init_wysiwyg');
				if(self.enabled = true){
					
					if( typeof ($.fn.wysiwyg) === 'undefined'){
						console.log('wysiwyg undefined');
						return;
					}
					console.log('wysiwyg');
					
					
					function init_wysiwyg() {
						if( typeof ($.fn.wysiwyg) === 'undefined'){ return; }
						// console.log('init_wysiwyg');	
						function init_ToolbarBootstrapBindings() {
						  var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
							  'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
							  'Times New Roman', 'Verdana'
							],
							fontTarget = $('[title=Font]').siblings('.dropdown-menu');
						  $.each(fonts, function(idx, fontName) {
							fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
						  });
						  $('a[title]').tooltip({
							container: 'body'
						  });
						  $('.dropdown-menu input').click(function() {
							  return false;
							})
							.change(function() {
							  $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
							})
							.keydown('esc', function() {
							  this.value = '';
							  $(this).change();
							});

						  $('[data-role=magic-overlay]').each(function() {
							var overlay = $(this),
							  target = $(overlay.data('target'));
							overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
						  });

						  if ("onwebkitspeechchange" in document.createElement("input")) {
							var editorOffset = $('#editor').offset();

							$('.voiceBtn').css('position', 'absolute').offset({
							  top: editorOffset.top,
							  left: editorOffset.left + $('#editor').innerWidth() - 35
							});
						  } else {
							$('.voiceBtn').hide();
						  }
						}

						function showErrorAlert(reason, detail) {
						  var msg = '';
						  if (reason === 'unsupported-file-type') {
							msg = "Unsupported format " + detail;
						  } else {
							console.log("error uploading file", reason, detail);
						  }
						  $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
						}

					   $('.editor-wrapper').each(function(){
							var id = $(this).attr('id');	//editor-one
							
							$(this).wysiwyg({
								toolbarSelector: '[data-target="#' + id + '"]',
								fileUploadError: showErrorAlert
							});	
						});
				 
						
						window.prettyPrint;
						prettyPrint();
					
					};
					init_wysiwyg();
					//self.createEditor();
				}

			},
			createEditor(){
				var self = this;
				console.log('createEditor');
				$('#editor-compose').wysiwyg({
					//toolbarSelector: '[data-target="#' + 'editor' + '"]',
					//fileUploadError: showErrorAlert
				});
				console.log("Creado...");
				/*
					
					self.elements = $('#editor');
					console.log(self.elements);
					console.log(self.elements.length);
					
					var i;
					for (i = 0; i < self.elements.length; i++) {
						console.log('elements : ' + i, self.elements[i]);
						// text += cars[i] + "<br>";
					}
				var id = $(a).attr('id');	//editor-one
				
				$(a).wysiwyg({
					toolbarSelector: '[data-target="#' + id + '"]',
					fileUploadError: showErrorAlert
				});	*/
			}
		},
	}).$mount('#compose-inbox');
	
<?php if(ControladorBase::isUser() == true){ ?>
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
<?php } ?>		
	</script>
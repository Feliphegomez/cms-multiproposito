<?php
	$session = validateSession(false);
	$myInfo = validateSession(true);
?>

<script>
var ComposeInbox = new Vue({
	data(){
		return {
			editor: null,
			enabled: false,
			conversation_id: 0,
			messageText: '',
			session: <?php echo json_encode($session); ?>,
			thisForm: {
				titulo: 'Contactar',
				subtitulo: '',
				descripcion: 'Esta información se enviara al departamento <code>Comercial</code> y serán ellos los encargados de continuar su  <a href="#">proceso</a>',
				action: "create",
				tabla: "requests",
				fields: {
					type: {
						show: false,
						required: true,
						value: 0
					},
					spanTitle001: {
						label: "Infomacion de contacto",
						typeInput: "section",
					},
					identification_type: {
						label: "Tipo de Documento",
						required: true,
						typeInput: "select",
						options: "identifications_types",
						value: ""
					},
					identification_number: {
						label: "# Documento",
						required: true,
						typeInput: "text",
						value: ""
					},
					names: {
						label: "Nombres o Razón social",
						required: true,
						typeInput: "text",
						value: ""
					},
					surname: {
						label: "Apellidos",
						required: true,
						typeInput: "text",
						value: ""
					},
					email: {
						label: "Correo electronico",
						required: true,
						typeInput: "email",
						value: ""
					},
					phone: {
						label: "Teléfono Fijo",
						required: true,
						typeInput: "text",
						value: ""
					},
					mobile: {
						label: "Teléfono Móvil",
						required: true,
						typeInput: "text",
						value: ""
					},
					spanTitle002: {
						label: "Infomacion del servicio",
						typeInput: "section",
					},
					department: {
						label: "Departamento",
						required: true,
						typeInput: "select",
						options: "geo_departments"
					},
					city: {
						label: "Ciudad",
						required: true,
						typeInput: "select",
						options: "geo_citys"
					},
					address:{
						label: "Dirección",
						required: true,
						typeInput: "textarea"
					},
					points_reference: {
						label: "Puntos de referencia (Dirección)",
						required: false,
						typeInput: "textarea"
					},
					request: {
						label: "Cuentanos que deseas...",
						required: true,
						typeInput: "textarea"
					},
					spanTitle003: {
						label: "Infomacion de Acceso",
						typeInput: "section",
					},
					username: {
						label: "Elija un usuario",
						required: true,
						typeInput: "text",
						value: ""
					},
					password: {
						label: "Elija una contraseña",
						required: true,
						typeInput: "password",
						value: ""
					},
				},
				callEvent(resultado){
					if(resultado.id != undefined && resultado.id > 0){

					}
				},
				style: {
					columns_size: 4,
					label_size: 12,
					input_size: 12
				},
			}
		};
	},
	mounted(){
		var self = this;
		self.init_compose();
	},
	methods: {
		sendMessage(){
			var self = this;
			self.messageText = document.getElementById('editor').innerHTML;

			if(self.messageText == '' || self.messageText.length < 50){
				alert('El mensaje es demaciado corto para ser enviado....');
			}else{
				if(self.session.user != undefined && self.session.user.id > 0){
					if(self.conversation_id === 0){ self.createConversation(); }
				}else{
					alert('Utiliza el formulario correcto.');
				}
			}
		},
		init_compose(){
			var self = this;
			if( typeof ($.fn.slideToggle) === 'undefined'){
				console.log('init_compose undefined');
				return;
			}
		},
		slideToggle(){
			var self = this;
			$('#compose-inbox, .compose-close').slideToggle();
		},
		loadConversation(){
			var self = this;
		},
		validateResult(a, call){
			var self = this;
			a.data = (a.data && a.data > 0) ? a.data : 0;
			return call(a.data);
		},
		escapeHtml(unsafe){
			return unsafe
			 .replace(/&/g, "&amp;")
			 .replace(/</g, "&lt;")
			 .replace(/>/g, "&gt;")
			 .replace(/"/g, "&quot;")
			 .replace(/'/g, "&#039;");
		},
		createConversation(){
			var self = this;

			api.post('/records/conversations', {
				user: self.session.user.id
			})
			.then(r => {
				// console.log('then', r);
				self.validateResult(r, function(a){
					if(a > 0){
						self.conversation_id = a;
						self.addReplyInConversation();
					}
				});
			})
			.catch(e => {
				// console.log('then', e);
				self.validateResult(e.response, function(a){
					if(a > 0){
						self.conversation_id = a;
						self.addReplyInConversation();
					}
				});
			});
		},
		addReplyInConversation(){
			var self = this;
			// "text": self.escapeHtml(self.messageText)
			api.post('/records/conversations_replys', {
				reply: JSON.stringify(
					{
						"text": (self.messageText)
					}
				),
				conversation: self.conversation_id,
				user: self.session.user.id
			})
			.then(r => {
				self.validateResult(r, function(a){
					if(a > 0){
						self.addUserInConversation();
					}
				});
			})
			.catch(e => {
				self.validateResult(e.response, function(a){
					if(a > 0){
						self.addUserInConversation();
					}
				});
			});
		},
		addUserInConversation(){
			var self = this;

			api.post('/records/conversations_groups', {
				conversation: self.conversation_id,
				user: self.session.user.id
			})
			.then(r => {
				self.validateResult(r, function(a){
					if(a > 0){
						document.getElementById("editor").innerHTML = "";
						alert("Tu mensaje fue enviado con exito.");
					}
				});
			})
			.catch(e => {
				self.validateResult(e.response, function(a){
					if(a > 0){
						alert("Tu mensaje fue enviado con exito.")
					}
				});
			});
		},
	},
}).$mount('#compose-inbox');

<?php if(isUser()){ ?>
	<?php if(validatePermission($this->adapter, 'Usuarios', 'inbox')){ ?>
		var NotificationsInboxNavbarTop = new Vue({
			data(){
				return {
					count: 0,
					conversations: [],
					records: [],
					timer: ''
				};
			},
			created(){
				var self = this;
				self.fetchEventsList();
				self.timer = setInterval(self.fetchEventsList, 30000); // 3000 = 3Sec - 30000 = 30Seg - 300000 = 5 Min
			},
			methods: {
				fetchEventsList() {
					var self = this;
					self.load();
				},
				cancelAutoUpdate(){
					var self = this;
					clearInterval(self.timer);
				},
				load(){
					var self = this;
					api.get('/records/conversations_groups', {
						params: {
							filter: [
								'user,eq,<?php echo ($myInfo['id']); ?>',
								// 'conversations.status,eq,2'
							],
							join: [
								// 'conversations',
								// 'conversations,conversations_replys',
								// 'conversations,conversations_replys,users',
							],
							order: 'id,desc'
						}
					})
					.then(response => { self.validateResult(response); })
					.catch(e => { self.validateResult(e.response); });
				},
				validateResult(a){
					var self = this;
					try{
						if (a.data != undefined && a.data.records != undefined){
							self.conversations = [];
							a.data.records.forEach(item => {
								self.conversations.push(item.conversation);
							});
							if(self.conversations.length > 0){
								api.get('/records/conversations/', {
									params: {
										filter: [
											'id,in,' + self.conversations.join(',')
										],
										join: [
											'conversations_replys',
											'conversations_replys,users'
										],
										order: 'updated,desc'
									}
								})
								.then(response => { self.validateConversations(response); })
								.catch(e => { self.validateConversations(e.response); });
							}
						}
					}catch(e){
						console.log(e.response);
					};
				},
				validateConversations(response){
					var self = this;
					self.records = [];
					self.count = 0;
					try{
						if (response.data != undefined){

							if (response.data.records.length > 0){
								response.data.records.forEach(item => {
									if(item.conversations_replys.length > 0){
										item.conversations_replys.forEach(function(a){
											a.reply = JSON.parse(a.reply);
										});
										item.updated = new Date(item.updated).toConversationsFormat();
										if (item.status === 3){ self.count++; }
										self.records.push(item);
									}
								});
							} else {
								self.searchBox.errorText = "No hay mensajes";
							}
						}
					}catch(e){
						console.log(e.response);
					};

				},
				getAvatar(user){
					var self = this;
					isAvatar = (user.avatar == undefined || user.avatar == null || user.avatar < 0) ? false : true;
					if(isAvatar == true){
						return "/index.php?controller=Sistema&action=picture&id=" + user.avatar;
					}else{
						return "/crm-content/uploads/avatar001.jpg";
					}
				},
			},
		}).$mount('#navbartop-notifications-inbox');
	<?php } ?>
	
	<?php if(validatePermission($this->adapter, 'SAC', 'inbox')){ ?>
		var NotificationsInboxNavbarTopSAC = new Vue({
			data(){
				return {
					count: 0,
					conversations: [],
					records: [],
					timer: ''
				};
			},
			created(){
				var self = this;
				self.fetchEventsList();
				self.timer = setInterval(self.fetchEventsList, 30000); // 3000 = 3Sec --- 300000
			},
			methods: {
				fetchEventsList() {
					var self = this;
					self.load();
				},
				cancelAutoUpdate(){
					var self = this;
					clearInterval(self.timer);
				},
				load(){
					var self = this;
					api.get('/records/conversations', {
						params: {
							filter: [
								'sac,eq,1'
								// 'status,in,0,1'
								// 'conversations.status,eq,2'
							],
							join: [
								// 'conversations',
								// 'conversations,conversations_replys',
								// 'conversations,conversations_replys,users',
							],
							order: 'id,desc'
						}
					})
					.then(response => { self.validateResult(response); })
					.catch(e => { self.validateResult(e.response); });
				},
				validateResult(a){
					var self = this;
					try{
						if (a.data != undefined && a.data.records != undefined){
							self.conversations = [];
							a.data.records.forEach(item => {
								self.conversations.push(item.id);
							});
							if(self.conversations.length > 0){
								api.get('/records/conversations', {
									params: {
										filter: [
											'id,in,' + self.conversations.join(',')
										],
										join: [
											'conversations_replys',
											'conversations_replys,users'
										],
										order: 'updated,desc'
									}
								})
								.then(response => { self.validateConversations(response); })
								.catch(e => { self.validateConversations(e.response); });
							}
						}
					}catch(e){
						console.log(e.response);
					};
				},
				validateConversations(response){
					var self = this;
					self.records = [];
					self.count = 0;
					try{
						if (response.data != undefined){

							// console.log('item: response;', response);
							if (response.data.records.length > 0){
								response.data.records.forEach(item => {
									if(item.conversations_replys.length > 0){
										item.conversations_replys.forEach(function(a){
											a.reply = JSON.parse(a.reply);
										});
										item.updated = new Date(item.updated).toConversationsFormat();
										if (item.status === 0 || item.status === 1){ self.count++; }
										self.records.push(item);
									}
								});
							} else {
								self.searchBox.errorText = "No hay mensajes";
							}
						}
					}catch(e){
						console.log(e.response);
					};

				},
				getAvatar(user){
					var self = this;
					isAvatar = (user.avatar == undefined || user.avatar == null || user.avatar < 0) ? false : true;
					if(isAvatar == true){
						return "/index.php?controller=Sistema&action=picture&id=" + user.avatar;
					}else{
						return "/crm-content/uploads/avatar001.jpg";
					}
				},
			},
		}).$mount('#navbartop-notifications-inbox-sac');
	<?php } ?>

	<?php if(validatePermission($this->adapter, 'Usuarios', 'calendar')){ ?>
		var NotificationsCalendarNavbarTop = new Vue({
			data(){
				return {
					count: 0,
					records: [],
					timer: '',
					selected: null,
					calendarEl: null,
					calendar: null,
					events: [],
				};
			},
			created(){
				var self = this;
				self.fetchEventsList();
				self.timer = setInterval(self.fetchEventsList, 30000); // 3000 = 3Sec - 30000 = 30Seg - 300000 = 5 Min
			},
			methods: {
				refreshCalendar(){
					var self = this;
					if(self.records.length > 0){
						self.calendar.render();
					}
				},
				loadCalendar(){
					var self = this;
					self.calendarEl = document.getElementById('calendar-navbar');
					self.calendar = new FullCalendar.Calendar(self.calendarEl, {
						timeZone: 'UTC',
						lang: 'es',
						selectHelper: true,
						eventClick: function(calEvent, jsEvent, view) {
							api.get('/records/events/' + calEvent.event.id, {
								params: {
								}
							})
							.then(response => {
								if(response.data != undefined && response.data.request > 0){
									location.replace('/micuenta/calendar#/view/' + response.data.id);
								}else{
									console.log("Error encontrando la solicitud.");
								}
							});
						},
						header: {
							left: '', // listWeek,timeGridWeek
							center: 'title',
							right: '', // today prev,next
						},
						height: 250,
						plugins: [ 'list', 'timeGrid' ],
						//defaultView: 'timeGridWeek',
						defaultView: 'listWeek',
						events: self.records
					});
					
				},
				fetchEventsList() {
					var self = this;
					self.load();
				},
				cancelAutoUpdate(){
					var self = this;
					clearInterval(self.timer);
				},
				load(){
					var self = this;
					api.get('/records/users_events', {
						params: {
							filter: [
								'user,eq,<?php echo ($myInfo['id']); ?>',
								// 'conversations.status,eq,2'
							],
							join: [
								'events',
								'events,events_types',
								'events,requests',
								'events,requests,identifications_types',
								'events,requests,geo_departments',
								'events,requests,geo_citys',
								'events,requests,requests_status',
								'events,requests,requests_types'
								// 'conversations,conversations_replys',
								// 'conversations,conversations_replys,users',
							],
							order: 'id,desc'
						}
					})
					.then(response => { self.validateResult(response); })
					.catch(e => { self.validateResult(e.response); });
				},
				validateResult(a){
					var self = this;
					try{
						if (a.data != undefined && a.data.records != undefined){
							self.records = [];
							var hoy = new Date();
							a.data.records.forEach(item => {
								fStart = new Date(item.event.start);

								if (hoy.getDate() == fStart.getDate()
								&& hoy.getMonth() == fStart.getMonth()
								&& hoy.getFullYear() == fStart.getFullYear()) {
									self.count++;
								}

								self.records.push(item.event);
							});
							self.loadCalendar();
						}
					}catch(e){
						console.log(e.response);
					};
				},
				validateConversations(response){
					var self = this;
					self.records = [];
					self.count = 0;
					try{
						if (response.data != undefined){

							if (response.data.records.length > 0){
								response.data.records.forEach(item => {
									if(item.conversations_replys.length > 0){
										item.conversations_replys.forEach(function(a){
											a.reply = JSON.parse(a.reply);
										});
										item.updated = new Date(item.updated).toConversationsFormat();
										if (item.status === 3){ self.count++; }
										self.records.push(item);
									}
								});
							} else {
								self.searchBox.errorText = "No hay mensajes";
							}
						}
					}catch(e){
						console.log(e.response);
					};

				},
				getAvatar(user){
					var self = this;
					isAvatar = (user.avatar == undefined || user.avatar == null || user.avatar < 0) ? false : true;
					if(isAvatar == true){
						return "/index.php?controller=Sistema&action=picture&id=" + user.avatar;
					}else{
						return "/crm-content/uploads/avatar001.jpg";
					}
				},
			},
		}).$mount('#navbartop-notifications-calendar');
	<?php } ?>

	<?php if(validatePermission($this->adapter, 'SAC', 'requests_new')){ ?>
		var NotificationsRequestsNewNavbarTop = new Vue({
			data(){
				return {
					count: 0,
					records: [],
					timer: '',
				};
			},
			created(){
				var self = this;
				self.fetchEventsList();
				self.timer = setInterval(self.fetchEventsList, 30000); // 3000 = 3Sec - 30000 = 30Seg - 300000 = 5 Min
			},
			methods: {
				refreshList(){
					var self = this;
					self.load();
				},
				fetchEventsList() {
					var self = this;
					self.load();
				},
				cancelAutoUpdate(){
					var self = this;
					clearInterval(self.timer);
				},
				load(){
					var self = this;
					api.get('/records/requests', {
						params: {
							filter: [
								'status,in,0,1'
							],
							join: [
								'identifications_types',
								'geo_departments',
								'geo_citys',
								'requests_status',
								'requests_types'
							],
							order: 'id,desc'
						}
					})
					.then(response => { self.validateResult(response); })
					.catch(e => { self.validateResult(e.response); });
				},
				validateResult(a){
					var self = this;
					try{
						if (a.data != undefined && a.data.records != undefined){
							self.records = [];
							self.count = 0;
							a.data.records.forEach(item => {
								console.log('item', item);
									item.created = item.created != undefined ? new Date(item.created).toConversationsFormat() : '';
									item.updated = item.updated != undefined ? new Date(item.updated).toConversationsFormat() : '';
									self.records.push(item);
									self.count++;
							});
						}
					}catch(e){
						console.log(e);
						console.log(e.response);
					};
				},
			},
		}).$mount('#navbartop-notifications-requests-new');
	<?php } ?>

	<?php if(validatePermission($this->adapter, 'SAC', 'requests_technicals')){ ?>
		var NotificationsRequestsTechnicalNavbarTop = new Vue({
			data(){
				return {
					count: 0,
					count_danger: 0,
					records: [],
					timer: '',
				};
			},
			created(){
				var self = this;
				self.fetchEventsList();
				self.timer = setInterval(self.fetchEventsList, 30000); // 3000 = 3Sec - 30000 = 30Seg - 300000 = 5 Min
			},
			methods: {
				refreshList(){
					var self = this;
					self.load();
				},
				fetchEventsList() {
					var self = this;
					self.load();
				},
				cancelAutoUpdate(){
					var self = this;
					clearInterval(self.timer);
				},
				load(){
					var self = this;
					
					api.get('/records/requests', {
						params: {
							filter: [
								'status,in,2'
							],
							join: [
								'identifications_types',
								'geo_departments',
								'geo_citys',
								'requests_status',
								'requests_types',
								'events',
								'events,users_events',
							],
							order: 'id,desc'
						}
					})
					.then(response => { self.validateResult(response); })
					.catch(e => { self.validateResult(e.response); });
					
				},
				validateResult(a){
					var self = this;
					try{
						if (a.data != undefined && a.data.records != undefined){
							self.records = [];
							self.count = 0;
							self.count_danger = 0;
							a.data.records.forEach(item => {
								item.created = new Date(item.created).toConversationsFormat();
								item.updated = new Date(item.updated).toConversationsFormat();

								hoy = new Date();
								fStart = (item.events[0].start != undefined) ? new Date(item.events[0].start) : new Date();
								users_search = item.events[0];
								
								users_search.users_events.forEach(function(user){
									if(user.user == "<?php echo $_SESSION['user']['id']; ?>"){
										self.records.push(item);
										if (hoy.getDate() == fStart.getDate() && hoy.getMonth() == fStart.getMonth() && hoy.getFullYear() == fStart.getFullYear()) {
											self.count++;
										} else if (hoy.getDate() > fStart.getDate() && hoy.getMonth() == fStart.getMonth() && hoy.getFullYear() == fStart.getFullYear()) {
											self.count_danger++;
										} else if (hoy.getMonth() > fStart.getMonth() && hoy.getFullYear() >= fStart.getFullYear()) {
											self.count_danger++;
										}
									}
								});

							});
						}
					}catch(e){
						console.log(e);
						console.log(e.response);
					};
				},
				validateConversations(response){
					var self = this;
					self.records = [];
					self.count = 0;
					try{
						if (response.data != undefined){

							if (response.data.records.length > 0){
								response.data.records.forEach(item => {
									if(item.conversations_replys.length > 0){
										item.conversations_replys.forEach(function(a){
											a.reply = JSON.parse(a.reply);
										});
										item.updated = new Date(item.updated).toConversationsFormat();
										if (item.status === 3){ self.count++; }
										self.records.push(item);
									}
								});
							} else {
								self.searchBox.errorText = "No hay mensajes";
							}
						}
					}catch(e){
						console.log(e.response);
					};

				},
				getAvatar(user){
					var self = this;
					isAvatar = (user.avatar == undefined || user.avatar == null || user.avatar < 0) ? false : true;
					if(isAvatar == true){
						return "/index.php?controller=Sistema&action=picture&id=" + user.avatar;
					}else{
						return "/crm-content/uploads/avatar001.jpg";
					}
				},
			},
		}).$mount('#navbartop-notifications-requests-technicals');
	<?php } ?>
<?php } else { ?>

<?php } ?>
</script>

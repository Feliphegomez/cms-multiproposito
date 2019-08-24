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
				console.log('loadConversation');
				console.log(self.conversation_id);
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
				console.log('createConversation');
				
				api.post('/records/conversations', {
					user: self.session.user.id
				})
				.then(r => {
					console.log('then', r);
					self.validateResult(r, function(a){
						if(a > 0){
							self.conversation_id = a;
							self.addReplyInConversation();
						}
					});
				})
				.catch(e => {
					console.log('then', e);
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
				console.log('addUserInConversation');
				
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
	var NotificationsInboxNavbarTop = new Vue({
		data(){
			return {
				count: 0,
				conversations: [],
				records: []
			};
		},
		mounted(){
			var self = this;
			self.load();
		},
		methods: {
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
								item.conversations_replys.forEach(function(a){
									a.reply = JSON.parse(a.reply);
								});
								
								const epochTime = new Date(item.updated);
								item.updated = epochTime.toConversationsFormat();
								
								
								
								self.records.push(item);
								if (item.status === 3){ self.count++; }
							});
						} else {
							self.searchBox.errorText = "No hay mensajes";
						}
					} 
				}catch(e){
					console.log(response);
					console.log(e);
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
	<?php if(isUser() && validatePermission($this->adapter, 'SAC', 'inbox')){ ?>
	var NotificationsInboxNavbarTop = new Vue({
		data(){
			return {
				count: 0,
				conversations: [],
				records: []
			};
		},
		mounted(){
			var self = this;
			self.load();
		},
		methods: {
			load(){
				var self = this;
				api.get('/records/conversations', {
					params: {
						filter: [
							'status,in,0,1'
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
						
						console.log('item: response;', response);
						if (response.data.records.length > 0){
							response.data.records.forEach(item => {
								item.conversations_replys.forEach(function(a){
									a.reply = JSON.parse(a.reply);
								});
								
								const epochTime = new Date(item.updated);
								item.updated = epochTime.toConversationsFormat();
								
								
								self.records.push(item);
								if (item.status === 0 || item.status === 1){ self.count++; }
							});
						} else {
							self.searchBox.errorText = "No hay mensajes";
						}
					} 
				}catch(e){
					console.log(response);
					console.log(e);
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
<?php } ?>
</script>
<?php $myInfo = (isset($_SESSION['user'])) ? $_SESSION['user'] : null; ?>
<div class="" id="micuenta-inbox">
	<div class="page-title">
		<div class="title_left">
			<h3>MiCuenta <small>Inbox</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Inbox <small>Bandeja de mensajes</small></h2>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<div class="row">
						<div class="col-sm-3 mail_list_column">
							<button id="compose" class="btn btn-sm btn-success btn-block" type="button">Redactar</button>
							
							<template v-if="records.length == 0">
								<a href="#">
									<div class="mail_list">
										<div class="left">
											
										</div>
										<div class="right">
											<h3> <small></small></h3>
											<p>No hay conversaciones.</p>
										</div>
									</div>
								</a>
							</template>
							<template v-else>
								<template v-for="(inbox, i) in records">
									<router-link tag="a" :to="{ name: 'MiCuenta-Inbox-Conversation-View', params: { conversation_id: inbox.conversation.id }}">
										<div class="mail_list">
											<div class="left">
												<i class="fa fa-circle" v-if="inbox.conversation.status.id == 1"></i> 
												<i class="fa fa-circle-o" v-else></i> 
												<!-- // <i class="fa fa-edit"></i> -->
											</div>
											<div class="right">
												<h3> {{ inbox.replys[0].user.names }} <small>{{ inbox.replys[0].created }}</small> </h3>
												<p v-html="inbox.replys[0].reply.text.replace(/<\/?[^>]+(>|$)/g, '').slice(0,50) + '...'"></p>
											</div>
										</div>
									</router-link>
								</template>
							</template>
						</div>
						
						<div class="col-sm-9 mail_view">
							<router-view :key="$route.fullPath"></router-view>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<template id="micuenta-inbox-home">
	<div>
		
	</div>
</template>
		

<template id="micuenta-inbox-conversations-view">
	<div>
		<div class="inbox-body">
			<div class="mail_heading row">
				<div class="col-md-8">
					<div class="btn-group">
						<button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
						<button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
						<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
						<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
					</div>
				</div>
				<div class="col-md-4 text-right">
					<p class="date"> Fecha de creacion: {{ conversation.created }}</p>
				</div>
				<div class="col-md-12">
					<h4> {{ conversation.status.name }}</h4>
					<!-- // <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum.</h4> -->
				</div>
			</div>
			
				
			<template>
				<template v-for="(item, a) in conversation.replys">
					<template v-if="item.user.id === user_id">
						<div class="sender-info">
							<div class="row">
								<div class="col-md-12">
									<strong>Tú</strong>
									<span>(@{{ item.user.username }})</span> dices: <strong></strong>
									<!-- <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a> -->
								</div>
							</div>
						</div>
					</template>
					<template v-else>
						<div class="sender-info">
							<div class="row">
								<div class="col-md-12">
									<strong>item.user.names</strong>
									<span>(@{{ item.user.username }})</span> dice: <strong></strong>
									<a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
								</div>
							</div>
						</div>
					</template>
					<div class="view-mail" v-html="item.reply.text"></div>
					
					
					<div class="x_content" style="overflow:auto;">
						<div class="sender-info">
							<div class="row">
								<div class="col-md-12">
									<strong></strong>
									<span>Usuario: ({{ item.user.username }})</span> <strong></strong>
									<a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
								</div>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="view-mail"></div>
					</div>
					
					<!-- //
					<div class="attachment">
						<p>
							<span><i class="fa fa-paperclip"></i> 1 attachments — </span>
							<a href="#">Download all attachments</a> | <a href="#">View all images</a>
						</p>
						<ul>
							<li>
								<a href="#" class="atch-thumb">
									<img src="images/inbox.png" alt="img" />
								</a>
								<div class="file-name">
									image-name.jpg
								</div>
								<span>12KB</span>
								<div class="links">
									<a href="#">View</a> - <a href="#">Download</a>
								</div>
							</li>
						</ul>
					</div>
					-->
					
					<div class="btn-group">
						<button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
						<button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
						<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
						<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
					</div>
				</template>
				
			<!-- // {{ conversation }} -->
			<div class="ln_solid"></div>
			
			<div class="x_content">
				<textarea rows="6" v-model="me.compose.text" class="form-control"></textarea>
			</div>
				
			<div class="btn-group pull-right">
				<!-- // <button v-if="conversation.status.id == 0 || conversation.status.id == 2" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> </button> -->
				<button @click="sendMessage" class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i> Enviar Mensaje</button>
				<!-- // <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button> -->
			</div>
			</template>
		</div>
		
		
		<div>
		</div>
	</div>
</template>

<script>
var InboxHome = Vue.extend({
	template: '#micuenta-inbox-home',
	data: function () {
		return {
		};
	},
	methods: {
	}
});

var InboxConversationsView = Vue.extend({
	template: '#micuenta-inbox-conversations-view',
	data: function () {
		return {
			user_id: <?php echo (isset($myInfo['id'])) ? $myInfo['id'] : 0; ?>,
			conversation: {
				id: '',
				created: '',
				status: {
					id: '',
					name: ''
				},
				updated: '',
				replys: [],
			},
			me: {
				avatar: "https://lh6.googleusercontent.com/-lr2nyjhhjXw/AAAAAAAAAAI/AAAAAAAARmE/MdtfUmC0M4s/photo.jpg?sz=48",				
				compose: {
					text: '',
				},
			},
			you: {
				avatar: "https://a11.t26.net/taringa/avatares/9/1/2/F/7/8/Demon_King1/48x48_5C5.jpg"
			},
		};
	},
	methods: {
		validateResultConversation(r){
			// console.log('validateResultConversation', r)
			
			var self = this;
			if (r.data != undefined){
				// console.log(r.data);
				self.conversation.id = r.data.id;
				self.conversation.created = r.data.created;
				self.conversation.status = r.data.status;
				self.conversation.updated = r.data.updated;
				r.data.conversations_replys.forEach(function(rp){
					rp.reply = JSON.parse(rp.reply);
				});
				self.conversation.replys = r.data.conversations_replys;
			} else {
				 console.log('Error: consulta validateResultConversation'); 
				 //console.log(response); 
			}
		},
		showErrorAlert(reason, detail){
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
		},
		sendMessage(){
			var self = this;
			obj_message = {};
			
			if(self.me.compose.text != ''){
				console.log('enviar');
				obj_message.reply = JSON.stringify({ "text": self.me.compose.text });
				obj_message.conversation = Number(self.$route.params.conversation_id);
				obj_message.user = self.user_id;
				console.log(obj_message);
				api.post('/records/conversations_replys/', obj_message)
				.then(response => {
					self.me.compose.text = '';
					self.load();
				})
				.catch(e => {
					console.log("Error");
					console.log(e.response);
				});
			}
		},
		load(){
			var self = this;
			conversation_id = (!self.$route.params.conversation_id) ? 0 : self.$route.params.conversation_id;
			
			api.get('/records/conversations/' + conversation_id, {
				params: {
					filter: [],
					join: [
						'conversations_status',
						'conversations_replys',
						'conversations_replys,users',
					]
				}
			})
			.then(response => { self.validateResultConversation(response); })
			.catch(e => { self.validateResultConversation(e); });
		},
	},
	created(){},
	mounted(){
		var self = this;
		self.load();
	},
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: InboxHome, name: 'MiCuenta-Inbox' },
		{ path: '/conversation/:conversation_id/view', component: InboxConversationsView, name: 'MiCuenta-Inbox-Conversation-View' },
	]
});


var Inbox = new Vue({
	router: router,
	data(){
		return {
			count: 0,
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
						'user,in,<?php echo ($myInfo['id']); ?>',
						//'status,in,0,1'
					],
					join: [
						'conversations',
						'conversations,conversations_status',
						'conversations,conversations_replys',
						'conversations,conversations_replys,users',
					]
				}
			})
			.then(response => {
				self.validateResult(response);
			})
			.catch(e => {
				// Capturamos los errores
				self.validateResult(e.response);
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
				self.records = [];
				self.count = 0;
			if (response != undefined){
				if (response.data != undefined && response.data.records != undefined){
					if(response.data.records[0] != undefined){
						response.data.records.forEach(item => {
							item.conversation.conversations_replys.forEach(function(rp){
								rp.reply = JSON.parse(rp.reply);
							});
							item.replys = item.conversation.conversations_replys;
							self.records.push(item);
							self.count++;
						});
					} else {
						self.searchBox.errorText = "Esta queja no fue encontrada";
					}
				} else {
					 console.log('Error: consulta validateResult'); 
					 console.log(response); 
				}
			}
		},
	},
}).$mount('#micuenta-inbox');

</script>


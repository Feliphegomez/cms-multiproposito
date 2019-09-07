<?php
	$session = validateSession(false);
	$myInfo = validateSession(true);
	$description = json_decode(json_encode($description));
?>
<div id="form-dinamyc" class="form">
	<div class="note">
		<p>
			<a class="btn icon-btn btn-info" href="/"><span class="glyphicon btn-glyphicon glyphicon-hand-left img-circle text-info"></span>Regresar</a>

			<?= $title; ?>
		</p>
	</div>
	<div class="form-content bk">
		<forms-create-dynamic :options_form="thisForm"></forms-create-dynamic>

	</div>
</div>

<style>
	#form-dinamyc {
		color: #666666;
	}
	.btn-glyphicon { padding:8px; background:#ffffff; margin-right:4px; }
.icon-btn { padding: 1px 15px 3px 2px; border-radius:50px;}
</style>

<script>
var FormDinamyc = new Vue({
	data(){
		return {
			editor: null,
			enabled: false,
			conversation_id: 0,
			messageText: '',
			session: <?= json_encode($session); ?>,
			thisForm: <?= $description; ?>
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
}).$mount('#form-dinamyc');
</script>

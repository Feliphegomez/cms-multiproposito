<?php 
	$session = validateSession(false);
	$myInfo = validateSession(true);
	$description = json_decode(json_encode($description));
?>

<div class="page-title">
  	<div class="title_left">
    	<h3><?= isset($title) ? $title : ""; ?> <small> <?= isset($subtitle) ? $subtitle : ""; ?></small></h3>
  	</div>
	<div id="form-dinamyc" class="col-xs-12">
		<div class="compose-body">
			<div class="row">
				<div class="col-sm-12">
					<forms-create-dynamic :options_form="thisForm"></forms-create-dynamic>
				</div>
			</div>
			<div class="big-button">
				
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<style>
#form-dinamyc {
	color: #666666;
}
</style>

<script>
var FormDinamyc = new Vue({
	data(){
		return {
			editor: null,
			enabled: false,
			conversation_id: 0,
			messageText: '',
			session: <?php echo json_encode($session); ?>,
			thisForm: <?php echo $description; ?>
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
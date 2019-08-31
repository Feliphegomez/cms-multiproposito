<?php
// nxZA1Xgc4E	andres.gomez@monteverdeltda.com
// 2gdH2whLlT	soporte@monteverdeltda.com
// -------------------------------------------------------------------------
/*
$buzonPruebas = new stdClass();
$buzonPruebas->host = 'mail.monteverdeltda.com';
$buzonPruebas->port = '143';
$buzonPruebas->user = 'soporte@monteverdeltda.com';
$buzonPruebas->pass = '2gdH2whLlT';
$buzonPruebas2 = new stdClass();
$buzonPruebas2->host = 'mail.monteverdeltda.com';
$buzonPruebas2->port = '143';
$buzonPruebas2->user = 'andres.gomez@monteverdeltda.com';
$buzonPruebas2->pass = 'nxZA1Xgc4E';
$buzones = array($buzonPruebas, $buzonPruebas2);
*/
$inboxs = new EmailBussines($this->adapter);
$inboxs->getAllByUser($_SESSION['user']['id']);
$buzones = $inboxs->buzones;
$accountSelected = (!isset($this->post['accountSelected']) || !isset($buzones[$this->post['accountSelected']])) ? 0 : $this->post['accountSelected'];
if(!isset($buzones[$accountSelected])){
	echo "No existe correo.";
	exit();
}
$inboxs->setBuzon($accountSelected);
$messages = $inboxs->getMessages();

# echo json_encode($messages);

?>

<div class="" id="my-mail">
	<div class="page-title">
		<div class="title_left">
			<h3>Correo Electronico <small>Herramienta Corporativa</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">

			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-sm-3 mail_list_column" style="max-height: calc(75vh);overflow-y: auto;overflow-x: hidden;">
							<!-- // <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button> -->
							<hr>
							<router-link tag="a" :to="{ name: 'Mail-Message-View', params: { message_index: a } }" v-for="(mail, a) in records" :key="a" style="overflow: hidden;">
								<div class="mail_list">
									<div class="left">
										<template v-if="mail.seen === 'unread'">
											<i class="fa fa-circle"></i>
										</template>
										<template v-else>
											<i class="fa fa-circle-o"></i>
										</template>
										<!-- <i class="fa fa-edit"></i> -->
									</div>
									<div class="right">
										<h3>{{ mail.subject }}	<small>{{ mail.date }}</small> </h3>
										<p>{{ mail.from[0].personal }}</p>
									</div>
								</div>
							</router-link>
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

<template id="mail-home">
	<div>
	</div>
</template>


<template id="mail-message-view">
	<div>
		<template v-if="record !== null">
			<div class="inbox-body">
			  <div class="mail_heading row">
			    <div class="col-md-8">

			      <div class="btn-group">
			        <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
			        <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
			        <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
			        <button @click="deletMail(record.bUid, record.mUid)" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
			      </div>
			    </div>
			    <div class="col-md-4 text-right">
			      <p class="date">{{ record.date }}</p>
			    </div>
			    <div class="col-md-12">
			      <h4>
							Asunto: {{ record.subject }}
						</h4>
			    </div>
			  </div>
			  <div class="sender-info">
			    <div class="row">
			      <div class="col-md-12">
			        <strong>{{ record.from[0].personal }}</strong> Para <strong>{{ record.to[0].personal }}</strong>
			        <!-- // <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a> -->
							<br>
							<hr>
			      </div>
			    </div>
			  </div>
			  <div class="view-mail" style="overflow:auto;">
					<div>
						-{{ record.mUid }}-
						
					</div>
					<!-- <div v-html="$root.getBodyParse(record.message)"></div> -->
					<object style="height: auto;min-height: calc(65vh);max-height: 100%;" width="100%" :data="'/?controller=Bussines&action=getBody&mail=' + record.bUid + '&message_id=' + record.mUid"></object>
					<hr>
					<object style="height: auto;min-height: calc(65vh);" width="100%" :data="'/?controller=Bussines&action=getAttach&mail=' + record.bUid + '&message_id=' + record.mUid"></object>

			  </div>
			  <div class="attachment">
					<!--
				    <p>
				      <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
				      <a href="#">Download all attachments</a> |
				      <a href="#">View all images</a>
				    </p>
						<hr>
					{{ record.output }}
					-->

					<!--//
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
			          <a href="#">View</a> -
			          <a href="#">Download</a>
			        </div>
			      </li>

			      <li>
			        <a href="#" class="atch-thumb">
			          <img src="images/inbox.png" alt="img" />
			        </a>

			        <div class="file-name">
			          img_name.jpg
			        </div>
			        <span>40KB</span>

			        <div class="links">
			          <a href="#">View</a> -
			          <a href="#">Download</a>
			        </div>
			      </li>
			      <li>
			        <a href="#" class="atch-thumb">
			          <img src="images/inbox.png" alt="img" />
			        </a>

			        <div class="file-name">
			          img_name.jpg
			        </div>
			        <span>30KB</span>

			        <div class="links">
			          <a href="#">View</a> -
			          <a href="#">Download</a>
			        </div>
			      </li>
			    </ul>
					-->
			  </div>
			  <div class="btn-group">
			    <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
			    <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
			    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
			    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
			  </div>
			</div>
		</template>
	</div>
</template>

<script>
var MailHome = Vue.extend({
	template: '#mail-home',
	data() {
		return {
			records: this.$root.records
		};
	},
	mounted(){
		var self = this;
	},
	methods: {
	}
});

var MailMessageView = Vue.extend({
	template: '#mail-message-view',
	data() {
		return {
			message_index: this.$route.params.message_index,
			record: null,
		};
	},
	mounted(){
		var self = this;
		self.record = self.$root.records[self.message_index];
		//self.record.date = new Date(self.record.date).toConversationsFormat()
		console.log(self.record);
	},
	methods: {
		deletMail(bUid, mUid){
			var self = this;
			axios.get('/?aaontroller=Bussines&action=getDeling&mail=' + bUid + '&message_id=' + mUid, {
			})
			.then(abi => {
				console.log('abi', abi);
				location.reload();
			});
		}
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MailHome, name: 'Mail-Home' },
			{ path: '/message/view/:message_index', component: MailMessageView, name: 'Mail-Message-View' },
	]
});

var MyMail = new Vue({
	router: router,
	data(){
		return {
			records:<?php  echo json_encode(array_reverse($messages)); ?>
		};
	},
	mounted(){
		var self = this;
		console.log(self.records);
	},
	methods: {
		getDayTextDate(day){
			array = [
				'Domingo',
				'Lunes',
				'Martes',
				'Miercoles',
				'Jueves',
				'Viernes',
				'Sabado'
			];
			return array[day]
		},
		getDayTextMonth(month){
			array = [
				'Enero',
				'Febrero',
				'Marzo',
				'Abril',
				'Mayo',
				'Junio',
				'Julio',
				'Agosto',
				'Septiembre',
				'Octubre',
				'Noviembre',
				'Diciembre'
			];
			return array[month]
		},
		getBodyParse(text) {
		    var map = {
		        '&amp;': '&',
		        '&#038;': "&",
		        '&lt;': '<',
		        '&gt;': '>',
		        '&quot;': '"',
		        '&#039;': "'",
		        '&#8217;': "’",
		        '&#8216;': "‘",
		        '&#8211;': "–",
		        '&#8212;': "—",
		        '&#8230;': "…",
		        '&#8221;': '”'
		    };

		    return text.replace(/\&[\w\d\#]{2,5}\;/g, function(m) { return map[m]; });
		},
	},
}).$mount('#my-mail');

</script>

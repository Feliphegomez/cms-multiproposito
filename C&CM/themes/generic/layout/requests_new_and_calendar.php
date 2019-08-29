
<div class="" id="micuenta-requests">
	<div class="page-title">
		<div class="title_left">
			<h3>Mi Cuenta <small> Mis Solicitudes</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">						
						<div class="col-sm-12 mail_view">
							<router-view :key="$route.fullPath"></router-view>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<template id="micuenta-requests-list">
	<div>
		<table class="table table-striped projects">
		  <thead>
			<tr>
			  <th style="width: 1%"># Rad.</th>
			  <th style="width: 20%">Responsable</th>
			  <th>Team Members</th>
			  <th>Project Progress</th>
			  <th>Status</th>
			  <th>Type</th>
			  <th style="width: 20%">#Edit</th>
			</tr>
		  </thead>
			<tbody>
				<tr v-for="(item, i) in records">
					<td>{{ getRadicado(item) }}</td>
					<td>
						<a>{{ item.names }} {{ item.surname }}</a>
						<br />
						<small>{{ item.created }}</small>
					</td>
					<td>
						<ul class="list-inline">
							<li v-for="(member_team, i2) in item.requests_team">
								<small>{{ member_team }}</small>
								<img src="images/user.png" class="avatar" alt="Avatar">
							</li>
						</ul>
					</td>
					<td class="project_progress">
						<div class="progress progress_sm">
							<div class="progress-bar bg-green" role="progressbar" :data-transitiongoal="item.status.progress"></div>
						</div>
						<small>{{ item.status.progress }}% Completado</small>
					</td>
					<td>
						<button type="button" class="btn btn-success btn-xs">{{ item.status.name }}</button>
					</td>
					<td>
						<button type="button" class="btn btn-default btn-xs">{{ item.type.title }}</button>
					</td>
					<td>
						<router-link tag="a" :to="{ name: 'MiCuenta-Requests-View', params: { request_id: item.id } }" class="btn btn-primary btn-xs">
							<i class="fa fa-folder"></i> Ver mas
						</router-link>
						<!--
						<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
						<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
						-->
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<template id="micuenta-requests-view">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h2>{{ record.type.title }}</h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-calendar-o"></i>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<router-link tag="a" :to="{ name: 'MiCuenta-Requests-Calendar-Create', params: { request_id: $route.params.request_id } }">
									<i class="fa fa-plus"></i> Agendar una visita
								</router-link>
							</li>
							<li><a href="#">Ver agenda de la solicitud</a></li>
						</ul>
					</li>
					
					<!-- //	
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					-->
					<router-link tag="li" :to="{ name: 'MiCuenta-Requests' }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<ul class="stats-overview">
						<li>
							<span class="name"> Estimated budget </span>
							<span class="value text-success"> 2300 </span>
						</li>
						<li>
							<span class="name"> Total amount spent </span>
							<span class="value text-success"> 2000 </span>
						</li>
						<li class="hidden-phone">
							<span class="name"> Estimated project duration </span>
							<span class="value text-success"> 20 </span>
						</li>
					</ul>
					<br />
					<ul class="stats-overview">
						<li>
							<span class="name">
								Departamento / Ciudad
							</span>
							<span class="value text-success">
								{{ record.city.name }}, {{ record.department.name }}
							</span>
						</li>
						<li class="hidden-phone">
							<span class="name">Direccion </span>
							<span class="value text-success"> {{ record.address }} </span>
						</li>
						<li class="hidden-phone">
							<span class="name"> Puntos de referencia </span>
							<span class="value text-success"> {{ record.points_reference }} </span>
						</li>
					</ul>
					<br />
					<!-- // <div id="mainb" style="height:350px;"></div> -->
					<div>
						<h4>Actividad Reciente</h4>
						<ul class="messages">
							<template v-if="record.requests_activity.length > 0">
								<li v-for="activity in record.requests_activity">
									<!-- // <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
									<div class="message_date">
										<!--
										<h3 class="date text-info">{{ record.created.split(" ")[0].split("-")[2] }}</h3>
										<p class="month">{{ returnMouthText(record.created.split(" ")[0].split("-")[1]) }}</p>
										-->
									</div>
									<div class="message_wrapper">
										<h4 class="heading">(@{{ activity.user.username }}) - {{ activity.user.names }}  {{ activity.user.surname }}</h4>
										<blockquote class="message" v-if="activity.info.text != undefined">{{ activity.info.text }}</blockquote>
										<br />
										<template v-if="activity.type == 'attachment'">
											<p class="url" v-for="attachment in activity.info.attachment">
												<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
												<!-- //
												<a :href="attachment.path_short"><i class="fa fa-paperclip"></i> {{ attachment.name }} [ {{ attachment.size }} B ]</a>
												<a :href="attachment.path_short"><i class="fa fa-paperclip"></i> {{ attachment.name }} [ {{ (attachment.size/1024) }} Kb ]</a>
												<a :href="attachment.path_short"><i class="fa fa-paperclip"></i> {{ attachment.name }} [ {{ ((attachment.size/1024)/1024) }} Mb ]</a>
												-->
												<a target="_blank" :href="attachment.path_short"><i class="fa fa-paperclip"></i> {{ attachment.name }} </a>
											</p>
										</template>
									</div>
								</li>
							</template>
							<template v-else>							
								<li>
									<!-- // <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
									<div class="message_date">
										<h3 class="date text-info"></h3>
										<p class="month"></p>
									</div>
									<div class="message_wrapper">
										<h4 class="heading">Mensaje automatico del sistema</h4>
										<blockquote class="message">
											No te impocientes, nuetro equipo esta validando tu solicitud.
										</blockquote>
										<br />
										<!--
										<p class="url">
											<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
											<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
										</p>
										-->
									</div>
								</li>
							</template>
							<!-- //
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-error">21</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Brian Michaels</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1" aria-hidden="true" data-icon=""></span>
										<a href="#" data-original-title="">Download</a>
									</p>
								</div>
							</li>
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-info">24</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Desmond Davison</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
										<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
									</p>
								</div>
							</li>
							-->
						</ul>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<section class="panel">
						<div class="x_title">
							<h2>Especificaciones de la solicitud</h2>
							<div class="clearfix"></div>
						</div>
						<div class="panel-body">
							<h3 class="green"><i class="fa fa-paint-brush"></i> {{ record.status.name }}</h3>
							<p>{{ record.request }}</p>
							<br />
							<div class="project_detail">
								<p class="title">Tipo de documento</p>
								<p>{{ record.identification_type.name }}</p>
								<p class="title"># de documento</p>
								<p>{{ record.identification_type.code }} {{ record.identification_number }}</p>
								<p class="title">Nombres o Razón social</p>
								<p>{{ record.names }}</p>
								<p class="title">Apellidos</p>
								<p>{{ record.surname }}</p>
								<p class="title">Correo electronico</p>
								<p>{{ record.email }}</p>
								<p class="title">Teléfono Fijo</p>
								<p>{{ record.phone }}</p>
								<p class="title">Teléfono Móvil</p>
								<p>{{ record.mobile }}</p>
							</div>
							<br />
							<h5>Archivos en la solicitud</h5>
							<ul class="list-unstyled project_files">
								<li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a></li>
								<!-- //	
								<li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a></li>
								<li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a></li>
								<li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a></li>
								<li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a></li>
								-->
							</ul>
							<br />
							<div class="text-center mtop20">
								<a href="#" class="btn btn-sm btn-primary">Add files</a>
								<a href="#" class="btn btn-sm btn-warning">Report contact</a>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</template>

<style scope="micuenta-requests-calendar-create">
body {
	margin: 0;
	padding: 0;
	font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
	font-size: 14px;
}
#top {
	background: #eee;
	border-bottom: 1px solid #ddd;
	padding: 0 10px;
	line-height: 40px;
	font-size: 12px;
}
#calendar {
	max-width: 900px;
	margin: 40px auto;
	padding: 0 10px;
}
</style>
<template id="micuenta-requests-calendar-create">
	<div>
		<div class="row">
			<div class="col-sm-3">
				<div id='external-events'>
				<h4>Draggable Events</h4>

				<div id='external-events-list'>
				<div class='fc-event'>My Event 1</div>
				<div class='fc-event'>My Event 2</div>
				<div class='fc-event'>My Event 3</div>
				<div class='fc-event'>My Event 4</div>
				<div class='fc-event'>My Event 5</div>
				</div>

				<p>
				<input type='checkbox' id='drop-remove' />
				<label for='drop-remove'>remove after drop</label>
				</p>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="col-sm-12">
				  <div id='top'>
					Locales:
					<select id='locale-selector'></select>

				  </div>
				</div>
				<div class="col-sm-12">
					<div id='calendar-ing'></div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var MyRequestsList = Vue.extend({
	template: '#micuenta-requests-list',
	data: function () {
		return {
			records: []
		};
	},
	mounted(){
		var self = this;
		self.load();
	},
	methods: {
		zfill: zfill,
		getRadicado(item){
			var self = this;
			radSeparate = item.created.split(" ");
			radFecha = radSeparate[0].split("-");
			return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
		},
		load(){
			var self = this;
			api.get('/records/requests', {
				params: {
					filter: [
						'status,in,0,1'
					],
					join: [
						'requests_types',
						'requests_status',
						'requests_team',
						'requests_team,users'
					]
				}
			})
			.then(response => { self.validateResult(response); })
			.catch(e => { self.validateResult(e); });
		},
		validateResult(r){
			var self = this;
			self.records = [];
			if (r.data.records != undefined){
				// console.log(r.data);
				self.records = r.data.records;
			} else {
				 console.log('Error: consulta validateResult'); 
				 //console.log(response); 
			}
		},
	}
});

var MyRequestsView = Vue.extend({
	template: '#micuenta-requests-view',
	data: function () {
		return {
			request_id: 0,
			record: {
			  "id": 0,
			  "type": {
				"id": 0,
				"title": "",
				"subtitle": "",
				"description": "",
				"highlight": 0
			  },
			  "identification_type": 0,
			  "identification_number": "",
			  "names": "",
			  "surname": "",
			  "department": 0,
			  "city": 0,
			  "address": "",
			  "points_reference": "",
			  "email": "",
			  "phone": "",
			  "mobile": "",
			  "request": "",
			  "status": {
				"id": 0,
				"name": "",
				"progress": 0,
				"close": 0
			  },
			  "created": "",
			  "updated": "",
			  "requests_team": [],
			  "requests_activity": [],
			},
		};
	},
	mounted(){
		var self = this;
		self.load();
	},
	methods: {
		zfill: zfill,
		returnMouthText(mouth){
			array = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];
			return array[mouth-1];
		},
		getRadicado(item){
			var self = this;
			radSeparate = item.created.split(" ");
			radFecha = radSeparate[0].split("-");
			return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
		},
		load(){
			var self = this;
			self.request_id = (!self.$route.params.request_id) ? 0 : self.$route.params.request_id;
			api.get('/records/requests/' + self.request_id, {
				params: {
					join: [
						'identifications_types',
						'geo_departments',
						'geo_citys',
						'requests_types',
						'requests_status',
						'requests_team',
						'requests_team,users',
						'requests_activity',
						'requests_activity,users',
					]
				}
			})
			.then(response => { self.validateResult(response); })
			.catch(e => { self.validateResult(e); });
		},
		validateResult(r){
			var self = this;
			if (r.data != undefined){
				// console.log(r.data);
				r.data.requests_activity.forEach(function(x){
					x.info = JSON.parse(x.info);
				});
				self.record = r.data;
			} else {
				 console.log('Error: consulta validateResult'); 
				 //console.log(response); 
			}
		},
	}
});

var MyRequestsCalendarCreate = Vue.extend({
	template: '#micuenta-requests-calendar-create',
	data: function () {
		return {
			records: []
		};
	},
	mounted(){
		var self = this;
		// self.load();
		
		  document.addEventListener('DOMContentLoaded', function() {
			var initialLocaleCode = 'es';
			var localeSelectorEl = document.getElementById('locale-selector');
			var calendarEl = document.getElementById('calendar-ing');
			var Draggable = FullCalendarInteraction.Draggable;
			
					/* initialize the external events
			-----------------------------------------------------------------*/
			var containerEl = document.getElementById('external-events-list');
			new Draggable(containerEl, {
			  itemSelector: '.fc-event',
			  eventData: function(eventEl) {
				return {
				  title: eventEl.innerText.trim()
				}
			  }
			});

			//// the individual way to do it
			// var containerEl = document.getElementById('external-events-list');
			// var eventEls = Array.prototype.slice.call(
			//   containerEl.querySelectorAll('.fc-event')
			// );
			// eventEls.forEach(function(eventEl) {
			//   new Draggable(eventEl, {
			//     eventData: {
			//       title: eventEl.innerText.trim(),
			//     }
			//   });
			// });


			var calendar = new FullCalendar.Calendar(calendarEl, {
			  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
			  defaultView: 'timeGridWeek',
			  header: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			  },
			  defaultDate: '2019-08-12',
			  locale: initialLocaleCode,
			  buttonIcons: false, // show the prev/next text
			  weekNumbers: true,
			  navLinks: true, // can click day/week names to navigate views
			  editable: true,
			  droppable: true, // this allows things to be dropped onto the calendar
			  drop: function(arg) {
				// is the "remove after drop" checkbox checked?
				if (document.getElementById('drop-remove').checked) {
				  // if so, remove the element from the "Draggable Events" list
				  arg.draggedEl.parentNode.removeChild(arg.draggedEl);
				}
			  },
			  eventLimit: true, // allow "more" link when too many events
			  events: [
				{
				  title: 'All Day Event',
				  start: '2019-08-01'
				},
				{
				  title: 'Long Event',
				  start: '2019-08-07',
				  end: '2019-08-10'
				},
				{
				  groupId: 999,
				  title: 'Repeating Event',
				  start: '2019-08-09T16:00:00'
				},
				{
				  groupId: 999,
				  title: 'Repeating Event',
				  start: '2019-08-16T16:00:00'
				},
				{
				  title: 'Conference',
				  start: '2019-08-11',
				  end: '2019-08-13'
				},
				{
				  title: 'Meeting',
				  start: '2019-08-12T10:30:00',
				  end: '2019-08-12T12:30:00'
				},
				{
				  title: 'Lunch',
				  start: '2019-08-12T12:00:00'
				},
				{
				  title: 'Meeting',
				  start: '2019-08-12T14:30:00'
				},
				{
				  title: 'Happy Hour',
				  start: '2019-08-12T17:30:00'
				},
				{
				  title: 'Dinner',
				  start: '2019-08-12T20:00:00'
				},
				{
				  title: 'Birthday Party',
				  start: '2019-08-13T07:00:00'
				},
				{
				  title: 'Click for Google',
				  url: 'http://google.com/',
				  start: '2019-08-28'
				}
			  ]
			});

			calendar.render();

			// build the locale selector's options
			calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
			  var optionEl = document.createElement('option');
			  optionEl.value = localeCode;
			  optionEl.selected = localeCode == initialLocaleCode;
			  optionEl.innerText = localeCode;
			  localeSelectorEl.appendChild(optionEl);
			});

			// when the selected option changes, dynamically change the calendar option
			localeSelectorEl.addEventListener('change', function() {
			  if (this.value) {
				calendar.setOption('locale', this.value);
			  }
			});

		  });

	},
	methods: {
		zfill: zfill,
		getRadicado(item){
			var self = this;
			radSeparate = item.created.split(" ");
			radFecha = radSeparate[0].split("-");
			return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
		},
		load(){
			var self = this;
			api.get('/records/requests', {
				params: {
					filter: [
						'status,in,0,1'
					],
					join: [
						'requests_types',
						'requests_status',
						'requests_team',
						'requests_team,users'
					]
				}
			})
			.then(response => { self.validateResult(response); })
			.catch(e => { self.validateResult(e); });
		},
		validateResult(r){
			var self = this;
			self.records = [];
			if (r.data.records != undefined){
				// console.log(r.data);
				self.records = r.data.records;
			} else {
				 console.log('Error: consulta validateResult'); 
				 //console.log(response); 
			}
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MyRequestsList, name: 'MiCuenta-Requests' },
		{ path: '/view/:request_id', component: MyRequestsView, name: 'MiCuenta-Requests-View' },
		{ path: '/view/:request_id/calendar/create', component: MyRequestsCalendarCreate, name: 'MiCuenta-Requests-Calendar-Create' },
	]
});


var MyRequests = new Vue({
	router: router,
	data(){
		return {
			count: 0,
			records: []
		};
	},
	mounted(){
		var self = this;
	},
	methods: {
	},
}).$mount('#micuenta-requests');

</script>


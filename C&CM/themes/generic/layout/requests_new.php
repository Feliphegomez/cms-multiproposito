<style>
.scheduler_default_corner div {
	color: rgb(243, 243, 243) !important;
	background: rgb(243, 243, 243) !important;
	background-color: rgb(243, 243, 243) !important;
}
</style>

<div class="" id="micuenta-requests">
	<div class="page-title">
		<div class="title_left">
			<h3>SAC <small> Solicitudes Nuevas</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
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
						<small>{{ item.created }}</small>
						<br />
						<a>{{ item.names }} {{ item.surname }}</a>
					</td>
					<td>
						<ul class="list-inline">
							<li v-for="(member_team, i2) in item.requests_team">
								<small>{{ member_team.user.username }}</small>
								<img src="/C&CM/themes/generic/assets/images/default_user.png" class="avatar" alt="Avatar" />
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

<style scoped="micuenta-requests-view">
	.panel_toolbox>li>a {
		color: #666 !important;
	}
</style>
<template id="micuenta-requests-view">
	<div>
		<div class="x_panel">
			<template v-if="in_team == true">
				<div class="x_title">
					<h2>{{ record.type.title }}</h2>
					<ul class="nav navbar-right panel_toolbox">
						<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-calendar-o"></i>
								Visitas Tecnicas
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<router-link tag="a" :to="{ name: 'MiCuenta-Requests-Calendar-View', params: { request_id: $route.params.request_id } }">
										<i class="fa fa-calendar"></i> Ver agenda de la solicitud
									</router-link>
								</li>
								<li>
									<router-link tag="a" :to="{ name: 'MiCuenta-Requests-Calendar-Create', params: { request_id: $route.params.request_id } }">
										<i class="fa fa-calendar-plus-o"></i> Agendar una visita
									</router-link>
								</li>
							</ul>
						</li>
						<li>
							<a @click="changeStatus(1)" v-if="record.status.id != 1 && record.status.id != 0">
								<i class="fa fa-life-ring"></i>
								<template v-if="record.status.id > 1">
									Regresar a (Aten. Cliente)
								</template>
								<template v-else>
									Enviar a (Aten. Cliente)
								</template>
							</a>
						</li>
						<li>
							<a @click="changeStatus(2)" v-if="record.status.id != 2">
								<i class="fa fa-tree"></i> Enviar a (Ings. Forestales)
							</a>
						</li>
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

								<div class="row">
									<div class="col-sm-12">
										<div class="x_content">
											<div class="row" role="tabpanel" data-example-id="togglable-tabs">
												<div class="col-sm-12">
													<ul id="myTab1" class="nav nav-tabs bar_tabs_ " role="tablist">
														<li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Actividad Reciente</a></li>
														<li role="presentation" class=""><a @click="refreshCalendar" href="#tab_calendar" role="tab" id="calendar-tabb" data-toggle="tab" aria-controls="calendar" aria-expanded="false">Calendario</a></li>
														<li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Propuestas</a></li>
													</ul>
												</div>

												<div class="col-sm-12">
													<div id="myTabContent2" class="tab-content">
														<div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">

															<ul class="messages">
																<template v-if="record.requests_activity.length > 0">
																	<li v-for="activity in record.requests_activity">
																		<!-- // <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
																		<div class="message_date">
																		<h3 class="date text-info">{{ record.created.split(" ")[0].split("-")[2] }}</h3>
																		<p class="month">{{ returnMouthText(record.created.split(" ")[0].split("-")[1]) }}</p>
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
																			<template v-else-if="activity.type == 'events'">
																				<ul>
																					<li  v-for="event in activity.info.events">
																						<span class="fs1 text-info fa fa-calendar-o" aria-hidden="true"></span>
																							{{ event.title }}
																							<br>Inicio: {{ event.start }}
																							<br>Fin: {{ event.end }}
																					</li>
																				</ul>
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
																				Esta solicitud necesita de tu gestión, Comencemos!
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
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane fade" id="tab_calendar" aria-labelledby="calendar-tab">
															<div id="calendar-list"></div>
															<template v-if="events.length == 0 || events == undefined || events == null">
																No se a programado agenta.
																<hr>

																	<router-link class="btn btn-sm btn-success" tag="a" :to="{ name: 'MiCuenta-Requests-Calendar-Create', params: { request_id: $route.params.request_id } }">
																		<i class="fa fa-calendar-plus-o"></i> Agendar una visita
																	</router-link>

															</template>
														</div>



														<div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
															<ul class="messages">
																<li>
																	<!-- // <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
																	<div class="message_date">
																		<h3 class="date text-info"></h3>
																		<p class="month"></p>
																	</div>
																	<div class="message_wrapper">
																		<h4 class="heading">Mensaje automatico del sistema</h4>
																		<blockquote class="message">
																			Aún no tenemos propuestas, espera que nuestros especialistas analicen tu solicitud y realicen el estudio para enviarte tu propuesta.
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
															</ul>
														</div>
														<div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
															<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
																booth letterpress, commodo enim craft beer mlkshk </p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
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
									<a href="#" class="btn btn-sm btn-primary">Gestionar Inventario</a>
									<!--
										<a href="#" class="btn btn-sm btn-primary">Add files</a>
										<a href="#" class="btn btn-sm btn-warning">Report contact</a>
									-->
								</div>
							</div>
						</section>
					</div>
				</div>
			</template>
			<template v-else>
				<p>Para acceder a la solucitud debes ser parte del equipo que esta atendiendo la misma, puedes ingresar al equipo pulsando el botón de abajo.</p>
				<a class="btn btn-success btn-lg" @click="addMeInTeam">
						<i class="fa fa-user-plus"></i>
						Ingresar
				</a>
			</template>
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
		<div class="x_panel">
			<div class="x_title">
				<h2>Agendar Visita Técnica</h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
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
					<router-link tag="li" :to="{ name: 'MiCuenta-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-sm-12">
					<div class="space">
						Scale:
						<label><input type="radio" name="scale" id="scale-hour" value="Hour"> Horas</label>
						<label><input type="radio" name="scale" id="scale-day" value="Day"> Días</label>
					</div>
					</div>
					<div class="col-sm-12">
						<div id="scheduler-app">
							<scheduler id="dp" :config="initConfig" ref="scheduler"></scheduler>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="micuenta-requests-calendar-view">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Agenda de Solicitud</h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
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
					<router-link tag="li" :to="{ name: 'MiCuenta-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-sm-12">
						<div id="calendar-list"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
Vue.component('scheduler', {
	props: ['id', 'config'],
	template: '<div :id="id"></div>',
	mounted: function () {
		var self = this;
		self.control = new DayPilot.Scheduler(this.id, this.config).init();
		 self.control.timeHeaders = [
			{ groupBy: "Month", format: "MMM yyyy" },
			{ groupBy: "Day", format: "ddd d" },
			{ groupBy: "Hour"}
		];

		self.control.treeEnabled = true;
		self.control.treePreventParentUsage = true;
		self.control.resources = [
			{ name: "Locations", id: "G1", expanded: true, children:[
				{ name : "Room 1", id : "A" },
				{ name : "Room 2", id : "B" },
				{ name : "Room 3", id : "C" },
				{ name : "Room 4", id : "D" }
			]}
			];
			self.control.heightSpec = "Max";
			// self.control.height = 300;
			self.control.events.list = [];
			// self.control.viewType = 'Gantt';
			self.control.eventMovingStartEndEnabled = true;
			self.control.eventResizingStartEndEnabled = true;
			self.control.timeRangeSelectingStartEndEnabled = true;

			self.control.onEventMoving = function(args) {
				if (args.e.resource() !== args.resource) {
					if (args.e.start() !== args.start || args.e.end() !== args.end) {
						args.left.enabled = false;
						args.right.html = "Solo puedes cambiar la hora del evento.";
						args.allowed = false;
					}
				} else {
					args.left.enabled = false;
					args.right.html = "No puedes mover el cupo al mismo lugar.";
					args.allowed = false;
				}
			};

			// event resizing
			self.control.onEventResized = function (args) {
				self.control.message("Resized: " + args.e.text());
			};

			// event creating
			self.control.onTimeRangeSelected = function (args) {
				F_start = new Date(args.start);
				F_end = new Date(args.start.addMinutes(90));

				bootbox.confirm({
					message: "Deseas crear un evento relacionado con la solicitud? <br><hr>"
					+ "<b>F. Inicio del evento</b>: [" + F_start.toMysqlFormat() + "] <br>"
					+ "<b>F. Fin del evento</b>: [" + F_end.toMysqlFormat() + "] <br>",
					locale: 'es',
					callback: function (rM) {
						if(rM == true){
							DayPilot.Modal.prompt("Titulo del evento", "Visita Técnica (Ings. Forestales)").then(function(modal) {
								self.control.clearSelection();
								var title = modal.result;
								if (!title) return;
								eventInsert = {
									title: title,
									all_day: 0,
									resource: args.resource.split(':')[1],
									start: F_start.toMysqlFormat(),
									end: F_end.toMysqlFormat(),
									type: 2,
									request: self.$route.params.request_id,
								};
								api.post('/records/events', eventInsert)
								.then(r => {
									if(r.data != undefined){
										console.log('r.data', r.data);
										eventInsert.id = r.data;
										api.post('/records/users_events', {
											user: args.resource.split(':')[0],
											event: r.data
										})
										.then(rs => {
											if(rs.data != undefined){
												console.log('rs.data', rs.data);


												// Agregar Actividad del evento en la solicitud
												api.post('/records/requests_activity', {
													request: self.$route.params.request_id,
													user: <?php echo $_SESSION['user']['id']; ?>,
													type: 'events',
													info: JSON.stringify({
														"text": "Se agendo una visita tecnica.",
														"events": [ eventInsert ]
													}),
												})
												.then(activityResult => {
													if(activityResult.data != undefined){
														console.log('activityResult.data', activityResult.data);
													}
												});


												var e = new DayPilot.Event({
													start: args.start,
													end: args.start.addMinutes(90),
													id: r.data,
													resource: args.resource,
													text: title
												});

												self.control.events.add(e);
												self.control.message("El evento a sido creado");
												self.$root.loadResources();
											}
										})
										.catch(e => {
											console.error(e.response);
										});

									}
								})
								.catch(e => {
									console.error(e.response);
								});

							});
						}else{
							self.control.clearSelection();
						}

					}
				});
			};

			self.control.onEventMove = function(args) {
				if (args.ctrl) {
					/*
					var newEvent = new DayPilot.Event({
						start: args.newStart,
						end: args.newEnd,
						text: "Copy of " + args.e.text(),
						resource: args.newResource,
						id: DayPilot.guid()  // generate random id
					});
					self.control.events.add(newEvent);
					// notify the server about the action here
					args.preventDefault(); // prevent the default action - moving event to the new location
					*/
				}
			};

			self.control.showNonBusiness = false;
			self.control.showNonBusinessForceHours = true;
			self.control.init();

			function barColor(i) {
				var colors = ["#3c78d8", "#6aa84f", "#f1c232", "#cc0000"];
				return colors[i % 4];
			}
			function barBackColor(i) {
				var colors = ["#a4c2f4", "#b6d7a8", "#ffe599", "#ea9999"];
				return colors[i % 4];
			}

			timeHeaders = {
				Hour: [
					{ groupBy: "Month", format: "MMM yyyy" },
					{ groupBy: "Day", format: "ddd d" },
					{ groupBy: "Hour"}
				],
				Day:[
					{ groupBy: "Month", format: "MMM yyyy" },
					{ groupBy: "Day", format: "ddd d" }
				],
			};
		$(document).ready(function() {
			$("input[type=radio]").change(function() {
				var val = $("input[type=radio]:checked").val();

				self.control.scale = val;
				self.control.timeHeaders = timeHeaders[val];
				self.control.update();
			});
			var d = new Date();
			d.setDate(d.getDate() - 1);

			self.control.scrollTo(d.toMysqlFormat());
		});
	}
});

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
				// Progressbar
				$(document).ready(function() {
					console.log('ok');
					$('.progress .progress-bar').progressbar();
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
			filter = self.$route.params.filterStatus != undefined ? "status,in," + self.$route.params.filterStatus : ""
			api.get('/records/requests', {
				params: {
					filter: [
						filter
					],
					join: [
						'requests_types',
						'requests_status',
						'requests_team',
						'requests_team,users'
					],
					order: 'updated,asc'
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
			in_team: false,
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
			calendarEl: null,
			calendar: null,
			events: [],
		};
	},
	mounted(){
		var self = this;
		self.load();
	},
	methods: {
		refreshCalendar(){
			var self = this;
			if(self.events.length > 0){
				self.calendar.render();
			}
		},
		loadCalendar(){
			var self = this;
			self.calendarEl = document.getElementById('calendar-list');
			self.calendar = new FullCalendar.Calendar(self.calendarEl, {
				timeZone: 'UTC',
				lang: 'es',
				header: {
					left: 'listWeek,timeGridWeek',
					center: 'title',
					right: 'today prev,next',
				},
				height: 450,
				plugins: [ 'list', 'timeGrid' ],
				//defaultView: 'timeGridWeek',
				defaultView: 'listWeek',
				events: self.events
			});
		},
		loadReservations(){
			var self = this;
			api.get('/records/events', {
				params: {
					filter: [
						'request,eq,' + self.$route.params.request_id
					]
				}
			})
			.then(response => { self.validateResultCalendar(response); })
			.catch(e => { self.validateResultCalendar(e.response); });
		},
		validateResultCalendar(r){
			var self = this;
			console.log('r', r);
			if(r.data != undefined && r.data.records != undefined){
				self.events = r.data.records;
				self.loadCalendar();
			}
		},
		zfill: zfill,
		changeStatus(status){
			var self = this;
			bootbox.confirm({
				message: "Confirmas que has terminado tu gestion y deseas enviar la solicitud al grupo de Ings. Forestales para su gestión.<br>",
				locale: 'es',
				callback: function (rM) {
					if(rM == true){
						api.put('/records/requests/' + self.request_id, {
							id: self.request_id,
							status: status
						})
						.then(rd => {
							if(rd.data != undefined && rd.data > 0){


								api.post('/records/requests_activity', {
									request: self.$route.params.request_id,
									user: <?php echo $_SESSION['user']['id']; ?>,
									type: 'status',
									info: JSON.stringify({
										"text": "Se actualizó el estado de la solicitud."
									}),
								})
								.then(activityResult => {
									if(activityResult.data != undefined){
										console.log('Gracias por  tu gestión.');
										self.load();
										router.push({ name: 'MiCuenta-Requests-View', params: { request_id: self.$route.params.request_id} })
									}
								});

							}
						});
					}
				}
			});
		},
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
		searchMeInTeam(){
			var self = this;
			self.record.requests_team.forEach(function(a){
				if(a.user.id == <?php echo $_SESSION['user']['id']; ?>){
					self.in_team = true;
					return;
				}
			});
		},
		addMeInTeam(){
			var self = this;
			if(self.in_team == false){
				api.post('/records/requests_team', {
					request: self.$route.params.request_id,
					user: <?php echo $_SESSION['user']['id']; ?>
				})
				.then(rd => {
					if(rd.data != undefined && rd.data > 0){
						api.post('/records/requests_activity', {
							request: self.$route.params.request_id,
							user: <?php echo $_SESSION['user']['id']; ?>,
							type: 'team_new_member',
							info: JSON.stringify({
								"text": "Se agregado personal para gestionar la solicitud."
							}),
						})
						.then(activityResult => {
							if(activityResult.data != undefined){
								console.log('Gracias por  tu gestión.');
								self.load();
							}
						});
					}
				})
			}
		},
		validateResult(r){
			var self = this;
			if (r.data != undefined){
				// console.log(r.data);
				r.data.requests_activity.forEach(function(x){
					x.info = JSON.parse(x.info);
				});
				self.record = r.data;
				self.searchMeInTeam();
				self.loadReservations();
			} else {
				 console.log('Error: consulta validateResult');
				 //console.log(response
			}
		},
	}
});

var MyRequestsCalendarView = Vue.extend({
	template: '#micuenta-requests-calendar-view',
	data: function () {
		return {
			calendarEl: null,
			calendar: null,
			events: [],
		}
	},
	methods: {
		loadCalendar(){
			var self = this;
			self.calendarEl = document.getElementById('calendar-list');
			self.calendar = new FullCalendar.Calendar(self.calendarEl, {
				timeZone: 'UTC',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				},
				plugins: [ 'list', 'timeGrid' ],
				//defaultView: 'timeGridWeek',
				defaultView: 'listWeek',
				events: self.events
			});
			self.calendar.render();
		},
		loadReservations(){
			var self = this;
			api.get('/records/events', {
				params: {
					filter: [
						'request,eq,' + self.$route.params.request_id
					]
				}
			})
			.then(response => { self.validateResult(response); })
			.catch(e => { self.validateResult(e.response); });
		},
		validateResult(r){
			var self = this;
			console.log('r', r);
			if(r.data != undefined && r.data.records != undefined){
				self.events = r.data.records;
				self.loadCalendar();
			}
		},
	},
	mounted(){
		var self = this;
		self.loadReservations();
	},
});

var MyRequestsCalendarCreate = Vue.extend({
	template: '#micuenta-requests-calendar-create',
	data: function () {
		return {
			tecnichals_ids: [],
			tecnichals: [],
			events: [],
			records: [],
			initConfig: {
				locale: 'es-mx',
				crosshairType: "Full",
				// autoScroll: "Always",
				timeHeaders: [
					{
						"groupBy": "Day",
						"format": "dddd, d MMMM yyyy"
					},
					{
						"groupBy": "Hour"
					},
					{
						"groupBy": "Cell",
						"format": "mm"
					}
				],
				scale: "CellDuration",
				cellDuration: 30,
				days: DayPilot.Date.today().daysInMonth() *2,
				startDate: DayPilot.Date.today().firstDayOfMonth(),
				businessBeginsHour: 7,
				businessEndsHour: 19,
				businessWeekends: false,
				eventHeight: 30,
				eventMovingStartEndEnabled: true,
				eventResizingStartEndEnabled: true,
				timeRangeSelectingStartEndEnabled: true,
				groupConcurrentEvents: true,
				timeRangeSelectedHandling: "Enabled",
				eventMoveHandling: "Update",
				onEventMoved: function (args) {
					var dp = args.e.calendar;
					console.log('source ', args.e.data.id);
					api.put('/records/events/' + args.e.data.id, {
						id: args.e.data.id,
						resource: args.e.resource().split(':')[1]
					})
					.then(rd => {
						console.log('rd.data response', rd);
						if(rd.data != undefined && rd.data > 0){
							this.message("Cupo movido: " + args.e.text());
							dp.events.update(args.e);
						}
					});
				},
				eventResizeHandling: "Update",
				onEventResized: function (args) {
					this.message("Event resized: " + args.e.text());
				},
				eventClickHandling: "Enabled",
				onEventClicked: function (args) {
					Radicado = args.e.data.request != undefined ? " Solicitud Referente: " + args.e.data.request : "";
					this.message("Evento: " + args.e.text() + Radicado);
				},
			  eventHoverHandling: "Bubble",
			  bubble: new DayPilot.Bubble({
				onLoad: function(args) {
				  // if event object doesn't specify "bubbleHtml" property
				  // this onLoad handler will be called to provide the bubble HTML
				  //args.html = "Event details";
				  args.html = "Detalles del evento";
				}
			  }),
			  contextMenu: new DayPilot.Menu({
				items: [
					{
						text:"Cambiar titulo",
						onClick: function(args) {
							var dp = args.source.calendar;
							DayPilot.Modal.prompt("Titulo del evento", args.source.data.text)
							.then(function(modal) {
								var title = modal.result;
								if (!title) return;
								args.source.data.text = title;

								api.put('/records/events/' + args.source.data.id, {
									id: args.source.data.id,
									title: title
								})
								.then(rd => {
									console.log('rd.data response', rd.data);
									if(rd.data != undefined && rd.data > 0){
										dp.events.update(args.source);
									}
								})
								.catch(e => { console.error(e.response); });
							});
						}
					},
					{
						text: "• Color Rojo", onClick: function (args) {
							var dp = args.source.calendar;
							var e = args.source;
							api.put('/records/events/' + args.source.data.id, {
								id: args.source.data.id,
								barColor: "#cc0000"
							})
							.then(rd => {
								console.log('rd.data response', rd.data);
								if(rd.data != undefined && rd.data > 0){
									e.data.barColor = "#cc0000";
									dp.events.update(e);
								}
							})
							.catch(e => { console.error(e.response); });
						}
					},
					{
						text: "✔ Color Verde", onClick: function (args) {
							var dp = args.source.calendar;
							var e = args.source;
							api.put('/records/events/' + args.source.data.id, {
								id: args.source.data.id,
								barColor: "#3c763d"
							})
							.then(rd => {
								console.log('rd.data response', rd.data);
								if(rd.data != undefined && rd.data > 0){
									e.data.barColor = "#3c763d";
									dp.events.update(e);
								}
							})
							.catch(e => { console.error(e.response); });
						}
					},
					{
						text:"Eliminar",
						onClick: function(args) {
							var dp = args.source.calendar;
							console.log('.source',args.source);
							console.log('.source.data', args.source.data);
							if(args.source.data != undefined && args.source.data.id != undefined){

								bootbox.confirm({
									message: "Desea eliminar este evento y todo lo relacionado al mismo?, recuerde que esta operacion es inrreversible.<br><hr>",
									locale: 'es',
									callback: function (rM) {
										if(rM == true){
											api.delete('/records/events/' + args.source.data.id)
											.then(rd => {
												console.log('rd.data response', rd.data);
												if(rd.data != undefined && rd.data > 0){
													dp.events.remove(args.source);
												}
											})
											.catch(e => {
												console.error(e.response);
											});
										}
									}
								});

							}
						}
					},
					// { text:"-"},
					// { text:"Power by ", onClick: function(){ window.open("https://github.com/feliphegomez", "_blank") } },
				]
			  }),
			  treeEnabled: true,
			  rowHeaderHideIconEnabled: true,
			}
		};
	},
	computed: {
		// returns DayPilot.Scheduler object (https://api.daypilot.org/daypilot-scheduler-class/)
		scheduler: function () {
			return this.$refs.scheduler.control;
		}
	},
	mounted(){
		var self = this;
		self.loadResources();


	},
	methods: {
		loadReservations: function () {
			var self = this;
			api.get('/records/users_events', {
				params: {
					filter: [
						'user,in,' + self.tecnichals_ids.join(',')
					],
					join: [
						'events'
					]
				}
			})
			.then(response => { self.validateEvents(response); })
			.catch(e => { self.validateEvents(e); });
		},
		loadResources() {
			var self = this;
			self.tecnichals_ids = [];
			self.tecnichals = [];

			api.get('/records/technicals', {
				params: {
					join: [
						'events',
						'users'
					]
				}
			})
			.then(response => { self.validateTechnicals(response); })
			.catch(e => { self.validateTechnicals(e); });

		},
		validateEvents(events){
			var self = this;
			if(events.data.records != undefined){
				self.events = [];
				events.data.records.forEach((item) => {
					console.log('events', item);
					self.events.push({
						id: item.event.id,
						resource: item.user + ":" + item.event.resource,
						all_day: item.event.all_day,
						start: new DayPilot.Date(item.event.start),
						end: new DayPilot.Date(item.event.end),
						text: item.event.title,
						barColor: item.event.barColor,
						request: item.event.request
					});
				});
				self.scheduler.update({events: self.events});
			}
		},
		validateTechnicals(technical){
			var self = this;

			if(technical.data.records != undefined){
				self.tecnichals = [];
				technical.data.records.forEach((item) => {
					self.tecnichals_ids.push(item.user.id);
					self.tecnichals.push({
						id: item.user.id,
						name: item.user.names + ' ' + item.user.surname,
						expanded: true,
						children: [
							{name: "Cupo 1", id: item.user.id+":R1"},
							{name: "Cupo 2", id: item.user.id+":R2"},
							{name: "Cupo 3", id: item.user.id+":R3"},
							{name: "Cupo 4", id: item.user.id+":R4"},
							{name: "Cupo 5", id: item.user.id+":R5"}
						]
					});
				});
				self.scheduler.update({resources: self.tecnichals});
				self.loadReservations();
			}
		},
		zfill: zfill,
		getRadicado(item){
			var self = this;
			radSeparate = item.created.split(" ");
			radFecha = radSeparate[0].split("-");
			return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MyRequestsList, name: 'MiCuenta-Requests' },
		{ path: '/filter/status/:filterStatus', component: MyRequestsList, name: 'MiCuenta-filterStatus' },
		{ path: '/view/:request_id', component: MyRequestsView, name: 'MiCuenta-Requests-View' },
		{ path: '/view/:request_id/calendar/create', component: MyRequestsCalendarCreate, name: 'MiCuenta-Requests-Calendar-Create' },
		{ path: '/view/:request_id/calendar/view', component: MyRequestsCalendarView, name: 'MiCuenta-Requests-Calendar-View' },
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

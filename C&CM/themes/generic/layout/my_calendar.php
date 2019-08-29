<div class="" id="micuenta-calendar">
	<div class="page-title">
		<div class="title_left">
			<h3>Mi Cuenta <small> Mi Calendario</small></h3>
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

<template id="micuenta-calendar-home">
	<div>
		<div class="x_panel">
		  <div class="x_title">
			<h2>Calendario <small>Mis Eventos</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">

			<div id='my-calendar-home'></div>

		  </div>
		</div>


		<!-- calendar modal -->
		<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
					</div>
					<div class="modal-body">
						<div id="testmodal" style="padding: 5px 20px;">
							<form id="antoform" class="form-horizontal calender" role="form">
								<div class="form-group">
									<label class="col-sm-3 control-label">Title</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="title" name="title">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary antosubmit">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel2">Editar Evento</h4>
					</div>
					<div class="modal-body">
						<div id="testmodal2" style="padding: 5px 20px;">
							<form id="antoform2" class="form-horizontal calender" role="form" action="javascript:return false;" method="POST">
								<div class="form-group">
									<label class="col-sm-3 control-label">Titulo</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="title2" name="title2">
									</div>
								</div>
							</form>
						</div>
						<!--
						<div class="table table-responsive">
							<table class="table table-border table-hover">
								<template v-if="selected != null">
									<tr v-for="(value, name, index) in selected">
										<td :title="index">{{ name }}</td>
										<td>
											<template class="table table-responsive" v-if="(typeof value === 'object' || typeof value === 'function') && (value !== null)">
												<table class="table table-border table-hover">
													<tr v-for="(v, n, i) in value">
														<td :title="i">{{ n }}</td>
														<td><div v-html="v"></div></td>
													</tr>
												</table>
											</template>
											<template v-else><div v-html="value"></div></template>
										</td>
									</tr>
								</template>
							</table>
						</div>
						-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary antosubmit3">Ver Completo</button>
						<button type="button" class="btn btn-success antosubmit2">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
		<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
	</div>
</template>


<template id="micuenta-calendar-view">
	<div>
		<div class="x_panel">
		  <div class="x_title">
				<h2>Mi Calendario<small>Evento</small></h2>
				<ul class="nav navbar-right panel_toolbox">
				  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<router-link tag="li" :to="{ name: 'MiCuenta-Calendar-Home' }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>


			<div class="x_content">

				<div class="col-md-9 col-sm-9 col-xs-12">

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

					<div id="mainb" style="height:350px;"></div>

					<div>

						<h4>Recent Activity</h4>

						<!-- end of user messages -->
						<ul class="messages">
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
						</ul>
						<!-- end of user messages -->


					</div>


				</div>

				<!-- start project-detail sidebar -->
				<div class="col-md-3 col-sm-3 col-xs-12">

					<section class="panel">

						<div class="x_title">
							<h2>Project Description</h2>
							<div class="clearfix"></div>
						</div>
						<div class="panel-body">
							<h3 class="green"><i class="fa fa-paint-brush"></i> Gentelella</h3>

							<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
							<br />

							<div class="project_detail">

								<p class="title">Client Company</p>
								<p>Deveint Inc</p>
								<p class="title">Project Leader</p>
								<p>Tony Chicken</p>
							</div>

							<br />
							<h5>Project files</h5>
							<ul class="list-unstyled project_files">
								<li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
								</li>
								<li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
								</li>
								<li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
								</li>
								<li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
								</li>
								<li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
								</li>
							</ul>
							<br />

							<div class="text-center mtop20">
								<a href="#" class="btn btn-sm btn-primary">Add files</a>
								<a href="#" class="btn btn-sm btn-warning">Report contact</a>
							</div>
						</div>

					</section>

				</div>
				<!-- end project-detail sidebar -->

			</div>
		</div>
	</div>
</template>

<script>
var MyCalendarHome = Vue.extend({
	template: '#micuenta-calendar-home',
	data: function () {
		return {
			calendarEl: null,
			calendar: null,
			events: [],
			selected: {
				address: '',
				city: 0,
				created: '',
				department: 0,
				email: '',
				id: 0,
				identification_number: '',
				identification_type: 0,
				mobile: '',
				names: '',
				phone: '',
				points_reference: '',
				request: null,
				status: null,
				surname: '',
				type: null,
				updated: ''
			}
		}
	},
	methods: {
		loadCalendar(){
			var self = this;
			if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
			var date = new Date(),
				d = date.getDate(),
				m = date.getMonth(),
				y = date.getFullYear(),
				started,
				categoryClass;

			var calendar = $('#my-calendar-home').fullCalendar({
				timeZone: 'UTC',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				},
				selectable: false,
				selectHelper: true,
				select: function(start, end, allDay) {
					$('#fc_create').click();
					started = start;
					ended = end;
					$(".antosubmit").on("click", function() {
						var title = $("#title").val();
						if (end) {
							ended = end;
						}
						categoryClass = $("#event_type").val();
						if (title) {
							calendar.fullCalendar('renderEvent', {
								title: title,
								start: started,
								end: end,
								allDay: allDay
							},
								true // make the event "stick"
							);
						}

						$('#title').val('');
						calendar.fullCalendar('unselect');
						$('.antoclose').click();
						return false;
					});
				},
				eventClick: function(calEvent, jsEvent, view) {
					self.selected = calEvent.request;

					$('#fc_edit').click();
					$('#title2').val(calEvent.title);
					categoryClass = $("#event_type").val();
					$(".antosubmit2").on("click", function() {
						bootbox.confirm({
							message: "Deseas cambiar el titulo del evento?.<br><hr>",
							locale: 'es',
							callback: function (rM) {
								if(rM == true){
									api.put('/records/events/' + calEvent.id, {
										id: calEvent.id,
										title: $("#title2").val()
									})
									.then(rd => {
										if(rd.data != undefined && rd.data > 0){
											calEvent.title = $("#title2").val();
											calendar.fullCalendar('updateEvent', calEvent);
											$('.antoclose2').click();
										}
									});
								}
							}
						});

					});
					$(".antosubmit3").on("click", function() {
						$('.antoclose2').click();
						api.get('/records/events/' + calEvent.id, {
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
					});
					calendar.fullCalendar('unselect');
				},
				editable: false,
				events: self.events,
			});
		},
		loadReservations(){
			var self = this;
			api.get('/records/users_events', {
				params: {
					filter: [
						'user,eq,<?php echo $_SESSION['user']['id']; ?>'
					],
					join: [
						'events',
						'events,requests',
						'events,requests,requests_types',
						'events,requests,requests_status',
						'events,requests,identifications_types',
						'events,requests,geo_departments',
						'events,requests,geo_citys',
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
				r.data.records.forEach(function(a){
					self.events.push(a.event);
				});
				self.loadCalendar();
			}
		},
	},
	mounted(){
		var self = this;
		self.loadReservations();
	},
});

var MyCalendarView = Vue.extend({
	template: '#micuenta-calendar-view',
	data() {
		return {
			event_id: this.$route.params.event_id,
			record: {
				all_day: 0,
				barColor: "",
				end: ",",
				id: this.$route.params.event_id,
				request: 0,
				resource: "",
				start: "",
				title: "",
				type: {
					id: 0,
					name: ""
				}
			}
		};
	},
	mounted(){
		var self = this;
		api.get('/records/events/' + self.event_id, {
			params: {
				join: [
					'events_types',
				],
			}
		})
		.then(response => { self.validateResult(response); })
		.catch(e => { self.validateResult(e.response); });
	},
	methods: {
		validateResult(a){
			var self = this;
			if(a.data != undefined){
				self.record = a.data;
			}
		}
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MyCalendarHome, name: 'MiCuenta-Calendar-Home' },
		{ path: '/view/:event_id', component: MyCalendarView, name: 'MiCuenta-Calendar-View' },
	]
});

MyCalendarView

var MyCalendar = new Vue({
	router: router,
	data(){
		return {
		};
	},
	mounted(){
		var self = this;
	},
	methods: {
	},
}).$mount('#micuenta-calendar');

</script>

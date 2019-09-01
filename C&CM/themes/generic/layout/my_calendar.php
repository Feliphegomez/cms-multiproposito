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


<style scoped="micuenta-calendar-view">
	.main {
	  width: 80%;
	  margin: auto;
	  min-width: 600px;
	}

	.content{
	  display: inline-block;
	  width: 69%;
	  
	}
	.sticky.stuck{
	  border-bottom: thin solid rgba(0,0,0,.2);
	  box-shadow:0 10px 15px -10px rgba(0,0,0,.1);
	}

	article {
	  margin: 20px;
	  background: #FFF;
	  box-shadow:1px 2px 3px rgba(0,0,0,.2);
	  position: relative;
	}

	.art-text{
	  padding: 10px 20px;
	  overflow: auto;
	}

	.header-img {
	  width: 100%;
	  display: block;
	}

	.art-text img{
	  max-width: 100%;
	  float: left;
	  margin: 10px 10px 0 0;
	}

	.embedded-video{
	  margin: 0;
	  padding: 0;
	}

	hr {
	  margin: 10px 0;
	  border: none;
	  border-top: thin solid rgba(0,0,0,.1);
	}

	article:before{
	  content: "\f05a";
	  color: rgba(255,255,255,.9);
	  display: block;
	  position: absolute;
	  font-style: normal;
	  font-weight: normal;
	  font-size: 28px;
	  text-align: center;
	  padding: 5px 10px;
	  top: 0px;
	  right: 0px;
	  border-bottom-left-radius: 20px;
	  z-index: 100;
	}

	article:after{
	  content: "Published: "attr(data-post-date);
	  position: absolute;
	  font-size: 10px;
	  padding: 3px 5px;
	  bottom: 0px;
	  right: 0px;
	  background: #FAFAFA;
	  color: #AAA;
	  
	}

	article.info:before{
	  content: "\f05a";
	  background: #29F;
	}

	article.video:before{
	  content: "\f03d";
	  background: #82F;
	}
	  
	article.announcement:before{
	  font-family: FontAwesome;
	  content: "\f0a1";
	  background-color: #E32;
	}

	aside {
	  display: inline-block;
	  width: 30%;
	  vertical-align: top;
	}

	.calendar{
	  margin: 20px auto;
	  min-width: 150px;
	  max-width: 240px;
	}

	.ui-datepicker-header {
		color: #333;  
		font-weight: bold;
		line-height: 30px;
	}  

	.ui-datepicker {
	  text-align: center;
	  color: #666;
	  position: relative;
	}

	.date-block{
	  text-align: center;
	  background: #D32;
	  color: #F4F4F4;
	  font-size: 18pt;
	  padding: 10px;
	  
	}

	.date-day{
	  font-size: 24pt;
	}
	.date-date{
	  font-size: 48pt;
	}

	.ui-datepicker-prev, .ui-datepicker-next {  
		display: inline-block;  
		width: 52px;  
		height: 30px;  
		text-align: center;  
		cursor: pointer;  
		background-color:none;  
		background-repeat: no-repeat;
		overflow: hidden;
		position: absolute;
		color: #D54;
	}
	.ui-datepicker-prev {  
		left: 0;  
		border-radius:0 0 30px 0;
	}  
	.ui-datepicker-next {  
		right: 0;  
		border-radius:0 0 0 30px; 
	}  

	.ui-datepicker-prev:before {
	  content: "\f053";
	  display: block;
	}

	.ui-datepicker-next:before {
	  content: "\f054";
	  display: block;
	  
	}

	.ui-datepicker-year{
	  font-weight: normal;
	  color: #999;
	}


	.ui-datepicker-month{
	  font-weight: bold;
	  background: #EEE;
	  font-size: 12pt;
	  border: none;
	}

	.ui-datepicker-calendar {
	  border-collapse:collapse;
	  width: 100%;
	  margin-top: 10px;
	  text-align: center;
	}

	.ui-datepicker td a, .ui-datepicker td span{
	  text-decoration: none;
	  display: block;
	  width: 100%;
	  font-size: 12px;
	  padding: 10px 0;
	  color: #333;
	  border-radius: 50%;
	  transition:all .1s ease;
	}

	.ui-datepicker td span{
	  color: #BBB;
	}

	.ui-datepicker .ui-state-active {
	  background: #BBB;
	}
	.ui-datepicker .ui-state-highlight {
	  background: #FFF;
	  color: #D32;
	}


	.ui-datepicker a:hover {
	  background: #d32;
	  color: #FAFAFA;
	}

	.social-buttons a{
	  display: inline-block;
	  color: #555;
	  font-size: 24pt;
	  width: 15%;
	  text-align: center;
	  
	}

	.social-buttons a:hover{
	  color: #D43 ;
	  color: attr(data-color);
	}



	.twitter-timeline {
	  width: 100%;
	  min-width: 300px;
	  height: 500px;
	  border-radius:10px;
	}

	/*//////////// MEDIA ////////////*/

	@media screen and (max-width:600px){
	  .main, aside, .container, .content, article{
		margin-left: 0;
		margin-right:0;
		padding: 0;
		display: block;
		width: auto;
		min-width: 0;
	  }
	  
	  .calendar {
		width: 100%;
		max-width: none;
	  }
	  
	  
	  .ui-datepicker td a, .ui-datepicker td span{
		border-radius:0;
	  }
	  
	  
	  .twitter-feed{
		margin: 20px;
	  }
	}
</style>

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
				<div class="main">
					<div class="container">
					
					<aside >
					  <div class="calendar">
						<div class="date-block">
							<div class="date-day">{{ getDayTextDate(new Date(record.start).getDay()) }}</div>
							<div class="date-date">{{ new Date(record.start).getDate() }}</div>
							<span class="date-month">{{ getDayTextMonth(new Date(record.start).getMonth()) }}</span>,
							<span class="date-year">{{ new Date(record.start).getFullYear() }}</span>
						</div>
						<div id="datepicker"></div>
					  </div>
					  <hr />
					  <span id="debug"></span>
					  <div class="social-buttons">
						<a href="#" data-color="#53F"><i class="fa fa-comment"></i></a>
						<a href="#"><i class="fa fa-photo"></i></a>
					  </div>
					  <hr />
						<h3 class="green"><i class="fa fa-paint-brush"></i> {{ record.type.name }}</h3>
						<p>{{ record.request.request }}</p>
						
						<ul class="list-unstyled project_files">
							<li><i class="fa fa-marker"></i> Dirección</li>
							<li><i class="fa fa-plus"></i> {{ record.request.address }}</li>
							<li><i class="fa fa-marker"></i> Puntos de referencia</li>
							<li><i class="fa fa-plus"></i> {{ record.request.points_reference }}</li>
						</ul>
						
						<br />

						<div class="project_detail">
							<h5>Información de Contacto</h5>
							
							<p class="title">Nombres o Razón social</p>
							<p>{{ record.request.names }}</p>
							<p class="title">Apellidos</p>
							<p>{{ record.request.surname }}</p>
							<p class="title">Correo Electronico</p>
							<p>{{ record.request.email }}</p>
							<p class="title">Teléfono Fijo</p>
							<p>{{ record.request.phone }}</p>
							<p class="title">Teléfono Móvil</p>
							<p>{{ record.request.mobile }}</p>
						</div>

						<br />
						<div class="text-center mtop20">
							<a href="#" class="btn btn-sm btn-primary">Add files</a>
							<a href="#" class="btn btn-sm btn-warning">Report contact</a>
						</div>
					</aside>
						<div class="content">
							<article class="announcement"  :data-post-date="new Date(record.request.created).toConversationsFormat()">
								<div class="sticky">
									<h2>{{ record.title }}</h2>
								</div>
								<div class="art-text">
									<p>Solicitud: </p>
									<p>{{ record.request.request }}</p>
								</div>
								
							</article>
							<article class="announcement"  data-post-date="April 8">
								<div class="sticky">
									<img src="http://webapps.jhu.edu/jhuniverse/images/site/campuslife/campuslife.jpg" alt="RPI" class="header-img"/>
									<h2>This is an Announcement</h2>
								</div>
								<div class="art-text">
									<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
									<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
								</div>
								
							</article>
							
						<!-- // 
					  <article class="info" data-post-date="April 6">
						
						<h2 class="sticky">This is an Info Article</h2>
						<div class="art-text">
						<img src="https://www.stanford.edu/~dritchie/img/portrait_small.jpg" alt="guy" width="200" />
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  </div>
					   </article>
					  <article class="info" data-post-date="April 6">
						<h2 class="sticky">This is a long Info Article</h2>
						
						<div class="art-text">         
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						<img src="https://d2d3qesrx8xj6s.cloudfront.net/img/screenshots/nofeat-082ad0d329107b782f65a06faa2804ac4c905e3f.jpg" alt="school" />
						<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  </div>
					   </article>
					  
					  <article class="video" data-post-date="April 6"><iframe class="embedded-video" height="315" width="100%" src="//www.youtube.com/embed/GLkbcsNJIv0" frameborder="0" allowfullscreen></iframe>
					  <h2 class="sticky">This is a Video Article</h2>
						<div class="art-text">
						
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  
						 <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  </div>
					   </article>
					   -->
					</div>
					
				  </div>
				  
				</div>
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
				plugins: [ 'list', 'timeGrid' ],
				defaultView: 'listYear',
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
					'requests',
				],
			}
		})
		.then(response => { self.validateResult(response); })
		.catch(e => { self.validateResult(e.response); });
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
		validateResult(a){
			var self = this;
			if(a.data != undefined){
				//a.data.start = new Date(a.data.start);
				//a.data.end = new Date(a.data.end);
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

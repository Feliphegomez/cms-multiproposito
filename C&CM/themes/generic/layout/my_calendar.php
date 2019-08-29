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

<template id="micuenta-calendar-view">
	<div>
		<div class="x_panel">
		  <div class="x_title">
			<h2>Calendar Events <small>Sessions</small></h2>
			<ul class="nav navbar-right panel_toolbox">
			  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#">Settings 1</a>
				  </li>
				  <li><a href="#">Settings 2</a>
				  </li>
				</ul>
			  </li>
			  <li><a class="close-link"><i class="fa fa-close"></i></a>
			  </li>
			</ul>
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
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary antosubmit2">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
		<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
	</div>
</template>


<script>
var MyCalendarView = Vue.extend({
	template: '#micuenta-calendar-view',
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

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MyCalendarView, name: 'MiCuenta-Calendar-View' },
	]
});


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

<?php
	$user = (object) validateSession(true);
?>
<div class="" id="profiles">
	<div class="page-title">
		<div class="title_left">
			<h3>Mi Perfil <small> Ver</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<router-view :key="$route.fullPath"></router-view>
		</div>
	</div>
</div>


<template id="profiles-my">
	<div>
		<div class="x_panel">
			<div class="x_content">
				<div class="col-md-4 col-sm-4 col-xs-12 profile_left">
					<div class="profile_img">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view" :src="getAvatar(record.avatar)" alt="Avatar" :title="record.username">
						</div>
					</div>
					<h3>{{ record.names }} {{ record.surname }}</h3>
					<ul class="list-unstyled user_data">
						<li><i class="fa fa-map-marker user-profile-icon"></i> {{ getAddress(record) }} </li>
						<li><i class="fa fa-at user-profile-icon"></i> {{ record.username }}</li>
						<li class="m-top-xs">
							<i class="fa fa-envelope-o user-profile-icon"></i>
							<a :href="'mailto:' + record.email">{{ record.email }}</a>
						</li>
					</ul>
					<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
					<br />

				</div>

				<div class="col-md-8 col-sm-8 col-xs-12">
					<!-- //
					  <div class="profile_title">
						<div class="col-md-6">
						  <h2>User Activity Report</h2>
						</div>
						<div class="col-md-6">
							<div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
								<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
							</div>
						</div>
					  </div>
					-->
					<!-- start of user-activity-graph -->
					<!--// <div id="graph_bar" style="width:100%; height:280px;"></div> -->
					<!-- end of user-activity-graph -->
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Actividad en Solicitudes</a></li>
							<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
							<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
								<!-- start recent activity -->
								<ul class="messages">
									<li v-for="(activity, index1) in record.requests_activity">
										<img :src="getAvatar(record.avatar)" class="avatar" alt="Avatar">
										<div class="message_date">
											<h3 class="date text-info">
												{{ activity.created.split(" ")[0].split("-")[2] }}
											</h3>
											<p class="month">
												{{ returnMouthText(activity.created.split(" ")[0].split("-")[1]) }}
											</p>
										</div>
										<div class="message_wrapper">
											<h4 class="heading">{{ record.names }} {{ record.surname }}</h4>
											<blockquote class="message">
												<template v-if="activity.info.text != undefined">
													{{ activity.info.text }}
												</template>


											</blockquote>
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
											<br />
											<!-- //
											<p class="url">
												<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
												<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
											</p>-->
										</div>
									</li>
								</ul>
								<!-- end recent activity -->
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
								<!-- start user projects -->
								<table class="data table table-striped no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Project Name</th>
											<th>Client Company</th>
											<th class="hidden-phone">Hours Spent</th>
											<th>Contribution</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>New Company Takeover Review</td>
											<td>Deveint Inc</td>
											<td class="hidden-phone">18</td>
											<td class="vertical-align-mid">
												<div class="progress">
													<div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
												</div>
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>New Partner Contracts Consultanci</td>
											<td>Deveint Inc</td>
											<td class="hidden-phone">13</td>
											<td class="vertical-align-mid">
												<div class="progress">
													<div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
												</div>
											</td>
										</tr>
										<tr>
										  <td>3</td>
										  <td>Partners and Inverstors report</td>
										  <td>Deveint Inc</td>
										  <td class="hidden-phone">30</td>
										  <td class="vertical-align-mid">
												<div class="progress">
													<div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
												</div>
										  </td>
										</tr>
										<tr>
											<td>4</td>
											<td>New Company Takeover Review</td>
											<td>Deveint Inc</td>
											<td class="hidden-phone">28</td>
											<td class="vertical-align-mid">
												<div class="progress">
													<div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<!-- end user projects -->
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
								<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
var ProfilesMy = Vue.extend({
	template: '#profiles-my',
	data() {
		return {
			record: {
				"id": <?php echo $user->id; ?>,
				"username": "guest",
				"names": "Ups",
				"surname": "No encontrado",
				"phone": "+(57) 0000000",
				"mobile": "+(57) 3000000000",
				"email": "sin@correo.com",
				"permissions": 0,
				"avatar": null,
				"registered": "2019-01-01 00:00:00",
				"updated": "2019-01-01 00:00:00",
				"last_connection": "2019-01-01 00:00:00"
			}
		};
	},
	mounted(){
		var self = this;
		self.$root.loadScripts();
		self.load();
	},
	methods: {
		returnMouthText(mouth){
			array = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];
			return array[mouth-1];
		},
		load(){
			var self = this;
			api.get('/records/users/' + self.record.id, {
				params: {
					join: [
						'media',
						'geo_departments',
						'geo_citys',
						'identifications_types',
						'requests_activity',
					]
				}
			})
			.then(r => { self.validateResult(r); })
			.catch(e => { self.validateResult(e.response); });
		},
		validateResult(r){
			var self = this;
			if (r.data != undefined){
				r.data.requests_activity.forEach(function(activity){
					activity.info = JSON.parse(activity.info);
				});
				self.record = r.data;
			} else {
				 console.log('Error: consulta validateResult');
				 //console.log(response
			}
		},
		getAvatar(avatar){
			var self = this;
			// Result: imagen default base64 or url image
			if(avatar == null){
				return (self.$root.avatar_default);
			}else{
				if(avatar.type != undefined && self.$root.types_avatar_accepted.indexOf(avatar.type) != -1) {
					return avatar.path_short;
				} else {
					return (self.$root.avatar_default);
				}
			}
		},
		getAddress(record){
			var self = this;
			// Result: San Francisco, California, USA
			address = (record.address != undefined && record.address != null) ? record.address : '';
			department = (record.department != undefined && record.department.id != undefined && record.department.id > 0) ? record.department.name : '';
			city = (record.city != undefined && record.city.id != undefined && record.city.id > 0) ? record.city.name : '';
			return address + ', ' + city + ', ' + department;
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: ProfilesMy, name: 'Profiles-My' },
	]
});

var Profiles = new Vue({
	router: router,
	data(){
		return {
			avatar_default: '<?php echo IMAGE_DEFAULT; ?>',
			types_avatar_accepted: [
				'image/png',
				'image/jpeg',
				'image/jpge',
				'image/jpg',
				'image/gif'
			],
			count: 0,
			record: []
		};
	},
	mounted(){
		var self = this;

	},
	methods: {
		zfill: zfill,
		formatMoney: formatMoney,
		loadScripts(){
			var self = this;
			$('.collapse-link-2').on('click', function() {
				var $BOX_PANEL = $(this).closest('.x_panel'),
					$ICON = $(this).find('i'),
					$BOX_CONTENT = $BOX_PANEL.find('.x_content');

				// fix for some div with hardcoded fix class
				if ($BOX_PANEL.attr('style')) {
					$BOX_CONTENT.slideToggle(200, function(){
						$BOX_PANEL.removeAttr('style');
					});
				} else {
					$BOX_CONTENT.slideToggle(200);
					$BOX_PANEL.css('height', 'auto');
				}

				$ICON.toggleClass('fa-chevron-up fa-chevron-down');
			});

			$('.close-link-2').click(function () {
				var $BOX_PANEL = $(this).closest('.x_panel');

				$BOX_PANEL.remove();
			});
		},
	},
}).$mount('#profiles');

</script>

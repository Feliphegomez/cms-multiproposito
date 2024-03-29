onyxDropzone<style>
.scheduler_default_corner div {
	color: rgb(243, 243, 243) !important;
	background: rgb(243, 243, 243) !important;
	background-color: rgb(243, 243, 243) !important;
}
</style>

<div class="" id="RequestsNew-requests">
	<div class="page-title">
		<div class="title_left">
			<h3>SAC <small> Solicitudes Nuevas</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<router-view :key="$route.fullPath"></router-view>
		</div>
	</div>
</div>

<template id="RequestsNew-requests-list">
	<div>
		<div class="x_panel">
			<div class="x_content">
				<div class="row">
					<div class="col-sm-12 mail_view">
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
												<img src="/C&CM/themes/generic/assets/images/default_user.png" class="avatar" data-toggle="tooltip" data-placement="top" :title="member_team.user.username" />
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
										<router-link tag="a" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: item.id } }" class="btn btn-primary btn-xs">
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
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped="RequestsNew-requests-view">
	.panel_toolbox>li>a {
		color: #666 !important;
	}
</style>
<template id="RequestsNew-requests-view">
	<div>
		<div class="x_panel">
			<template v-if="in_team == true">
				<div class="x_title">
					<h2>{{ record.type.title }}</h2>
					<ul class="nav navbar-right panel_toolbox">
						<!-- // <li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li> -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-calendar-o"></i>
								Visitas Tecnicas
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<router-link tag="a" :to="{ name: 'RequestsNew-Requests-Calendar-View', params: { request_id: $route.params.request_id } }">
										<i class="fa fa-calendar"></i> Ver agenda de la solicitud
									</router-link>
								</li>
								<li>
									<router-link tag="a" :to="{ name: 'RequestsNew-Requests-Calendar-Create', params: { request_id: $route.params.request_id } }">
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
						<router-link tag="li" :to="{ name: 'RequestsNew-Requests' }">
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
													<li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Reportes técnicos</a></li>
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
															<router-link class="btn btn-sm btn-success" tag="a" :to="{ name: 'RequestsNew-Requests-Calendar-Create', params: { request_id: $route.params.request_id } }">
																<i class="fa fa-calendar-plus-o"></i> Agendar una visita
															</router-link>
														</template>
													</div>

													<div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
														<ul class="messages">

															<template v-if="record.proposals.length > 0">
																<li v-for="(proposal, indexProposal) in record.proposals"  :Key="proposal.id">
																	<!-- // <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
																	<template>
																		<div class="message_date">
																			<template v-if="proposal.close === 1">
																				<template v-if="proposal.response != null">
																					<h3 class="date text-info" v-if="proposal.response == 1">APROBADA</h3>
																					<h3 class="date text-info" v-else>DECLINADA</h3>
																				</template>
																				<template v-else>
																					<h3 class="date text-info">Esp. Respuesta</h3>
																				</template>
																			</template>
																			<template v-else>
																				<h3 class="date text-info">Sin terminar</h3>
																			</template>
																			<p class="month">
																				Propuesta #: {{ getRadicado(proposal) }}
																			</p>
																		</div>
																		<div class="message_wrapper">
																			<h4 class="heading"></h4>
																			<blockquote class="message">
																				{{ proposal.created }}
																				<template v-if="proposal.response != null">
																					<p v-if="proposal.response == 0">{{ proposal.response_notes }}</p>
																				</template>
																			</blockquote>
																			<br />
																			<p class="url">
																				<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>

																				<router-link v-if="proposal.close === 1" class="btn btn-sm btn-success" tag="a" :to="{ name: 'RequestsNew-Requests-proposals-View', params: { request_id: $route.params.request_id, proposal_id: proposal.id } }">
																					<i class="fa fa-eye"></i> Ver la propuesta
																				</router-link>

																				<router-link v-if="proposal.close === 0" class="btn btn-sm btn-primary" tag="a" :to="{ name: 'RequestsNew-Requests-proposals-Edit', params: { request_id: $route.params.request_id, proposal_id: proposal.id } }">
																					<i class="fa fa-calendar-plus-o"></i> Continuar con la propuesta
																				</router-link>

																				<template v-if="indexProposal == (record.proposals.length-1) && proposal.response != null && proposal.response == 0">
																					<router-link v-if="proposal.close === 1" class="btn btn-sm btn-primary" tag="a" :to="{ name: 'RequestsNew-Requests-proposals-Create', params: { request_id: $route.params.request_id } }">
																						<i class="fa fa-calendar-plus-o"></i> Nueva propuesta
																					</router-link>
																				</template>


																				<template v-if="indexProposal == (record.proposals.length-1) && proposal.response != null && proposal.response == 1">
																					<a class="btn btn-lg btn-success">
																						Terminar Proceso
																					</a>
																				</template>
																			</p>
																		</div>
																	</template>
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
																			Aún no tenemos propuestas...
																			<hr>
																			<router-link class="btn btn-sm btn-success" tag="a" :to="{ name: 'RequestsNew-Requests-proposals-Create', params: { request_id: $route.params.request_id } }">
																				<i class="fa fa-calendar-plus-o"></i> Crear una propuesta
																			</router-link>
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

													<div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
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
																		Aún no tenemos reportes...
																		<hr>
																		<router-link tag="a" :to="{ name: 'RequestsNew-Requests-Technicals', params: { request_id: $route.params.request_id } }" class="btn btn-sm btn-primary">
																			<i class="fa fa-plus"></i>
																			Gestionar Reporte
																		</router-link>
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
									<template v-if="record.requests_media.length > 0">
										<li v-for="(media, m) in record.requests_media">
											<a @click="window.open(media.media.path_short, 'viewPop-' + media.media.id, 'menubar=no,location=no,resizable=yes,scrollbars=no,status=yes,navbar=false,height=500,width=550')">
												<template v-if="media.media.type.split('/')[1] == 'png' || media.media.type.split('/')[1] == 'jpge' || media.media.type.split('/')[1] == 'jpg'">
													<i class="fa fa-picture-o"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[1] == 'text'">
													<i class="fa fa-file-text-o"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[1] == 'pdf'">
													<i class="fa fa-file-pdf-o"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[1] == 'mln'">
													<i class="fa fa-mail-forward"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[1] == 'docx' || media.media.type.split('/')[1] == 'doc'">
													<i class="fa fa-file-word-o"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[1] == 'xlsx'">
													<i class="fa fa-file-excel-o"></i>
												</template>
												<template v-else-if="media.media.type.split('/')[0] == 'audio'">
													<i class="fa fa-file-audio-o"></i>
												</template>
												<template v-else>
													<i class="fa fa-file-o"></i>
												</template>
												{{ media.media.name }}
											</a>
										</li>
									</template>

								</ul>
								<br />
								<div class="text-center mtop20" v-if="upf_enable != null && upf_enable != false">
										<h2>Haga clic y seleccione los archivos o simplemente arrastrelos hasta el recuadro.</h2>
										<div class="clearfix"></div>
									<div class="row full-dark-bg">
										<div class="col-md-6">
											<form action="/?controller=Media&action=upload_file" class="dropzone files-container" method="POST">
												<div class="fallback">
													<input name="file" type="file" multiple />
												</div>
												<input name="request_id" type="hidden" :value="$route.params.request_id" />
											</form>
										</div>
										<div class="col-md-6">
											<h4 class="section-sub-title"><span></span></h4>
											<span>Solo se admiten los tipos de archivos JPG, PNG, PDF, DOC (Word), XLS (Excel), PPT, ODT y RTF.</span>
											<span>El tamaño maximo permitido es de 25MB.</span>
										</div>
											<!-- Uploaded files section - ->
										<div class="col-md-12">
											<h4 class="section-sub-title"><span>Archivos</span> Subidos (<span class="uploaded-files-count">0</span>)</h4>
											<span class="no-files-uploaded">No has subido nada aún..</span>
											<div class="preview-container dz-preview uploaded-files">
												<div id="previews">
													<div id="onyx-dropzone-template">
														<div class="onyx-dropzone-info">
															<div class="thumb-container">
																<img data-dz-thumbnail />
															</div>
															<div class="details">
																<div>
																	<span data-dz-name></span> <span data-dz-size></span>
																</div>
																<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
																<div class="dz-error-message"><span data-dz-errormessage></span></div>
																<div class="actions">
																	<a href="#!" data-dz-remove><i class="fa fa-times"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										-->
									</div>
								</div>
								<br />

								<div class="text-center mtop20">
									<a v-if="upf_enable == null || upf_enable == false" class="btn btn-sm btn-warning" @click="getUploads">
										<!-- // <i class="fa fa-calendar-plus-o"></i> -->
										Subir Archivos
									</a>
									<a class="btn btn-sm btn-primary" @click="finishUploads" v-else>
										<!-- // <i class="fa fa-calendar-plus-o"></i> -->
										Finalizar
									</a>
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

<style scope="RequestsNew-requests-calendar-create">
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
<template id="RequestsNew-requests-calendar-create">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Agendar Visita Técnica</h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // <li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li> -->
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
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
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

<template id="RequestsNew-requests-calendar-view">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Agenda de Solicitud</h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // <li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li> -->
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
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
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

<template id="RequestsNew-requests-technicals-create">
	<div>
		<!-- //
		<div class="x_panel">
			<div class="x_title">
				<h2>Plain Page</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				Add content to the page ...
			</div>
		</div>
		-->

		<div class="x_panel">
			<div class="x_title">
				<h2>Mantenimiento de Jardines</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="3">Cantidad de área (M2) o Etapas de la urbanizacion:</td>
						<td colspan="3"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="2">Tiene jardines en area baja:</td>
						<td colspan="4"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="2">Tiene jardines de altura (# de piso ...):</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="2">Personal en altura:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="2">Limpieza:</td>
						<td colspan="4"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Roceria de cesped:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Roceria en área baja:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Roceria en altura:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Bordeo:</td>
						<td colspan="5"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Plateo:</td>
						<td colspan="5"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Cordoneo:</td>
						<td colspan="5"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Fertilización:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Radicular:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Foliar: <input class="form-control" /></td>
						<td colspan="1">EDAFICO - Agrimins: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Jardineras:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Concreto:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Materas:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="2" rowspan="4">PODA:</td>
						<td colspan="1">Setos:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad de individuos:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Arbustos Jovenes:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad de individuos:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Poda en área baja: <input class="form-control" /></td>
						<td colspan="1"># de cortes: <input class="form-control" /></td>
						<td colspan="1">Poda en altura: <input class="form-control" /></td>
						<td colspan="1"># de cortes: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Personal de altura:</td>
						<td colspan="3"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="2">Fumigacion contra hongos:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Fumigacion contra plagas:</td>
						<td colspan="2"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Siembra</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="1">Arbusto:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad #:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Arboles:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad #:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Plantas de flor:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad #:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Plantas de hoja verde:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad #:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Enrredaderas:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Cantidad #:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Tierra abonada:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1"># de bultos: <input class="form-control" /></td>
						<td colspan="1">Chiper: <input class="form-control" /></td>
						<td colspan="1"># de bultos: </td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Fertilización:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Radicular: <input class="form-control" /></td>
						<td colspan="1">Foliar: <input class="form-control" /></td>
						<td colspan="1">EDAFICO-Agrimins:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Poda</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="1">Setos:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="1">Cantidad de individuos #:</td>
						<td colspan="2"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Arbustos Jóvenes:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="1">Cantidad de individuos #:</td>
						<td colspan="2"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Otros:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="1">Cantidad de individuos #:</td>
						<td colspan="2"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Poda en área baja:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1"># de cortes: <input class="form-control" /></td>
						<td colspan="1">Podas en altura: <input class="form-control" /></td>
						<td colspan="1"># de cortes: <input class="form-control" /></td>
						<td colspan="1">Personal de altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Tiene Permiso:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="2">Desea gestionar el permiso por medio de MONTEVERDE LTDA?:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Tala</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="2">Cantidad de individuos #: <input class="form-control" /></td>
						<td colspan="1">Clase <input class="form-control" /></td>
						<td colspan="1">Tala en área baja: <input class="form-control" /></td>
						<td colspan="1">Tala en altura: <input class="form-control" /></td>
						<td colspan="1">Personal en altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Tiene permiso:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="2">Desea gestionar el permiso por medio de MONTEVERDE LTDA?:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Transplante</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="2">Cantidad de individuos #: <input class="form-control" /></td>
						<td colspan="1">Clase: <input class="form-control" /></td>
						<td colspan="1">Transplante en área baja: <input class="form-control" /></td>
						<td colspan="1">Transplante en altura: <input class="form-control" /></td>
						<td colspan="1">Personal en altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Tiene permiso:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="2">Desea gestionar el permiso por medio de MONTEVERDE LTDA?:</td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Diseño de jardines</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="1">Diseño de interiores:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase de plantas: <input class="form-control" /></td>
						<td colspan="1">Diseño en área baja: <input class="form-control" /></td>
						<td colspan="1">Diseño en altura: <input class="form-control" /></td>
						<td colspan="1">Permiso en altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Diseño de exteriores:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase de plantas: <input class="form-control" /></td>
						<td colspan="1">Diseño en área baja: <input class="form-control" /></td>
						<td colspan="1">Diseño en altura: <input class="form-control" /></td>
						<td colspan="1">Permiso en altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="1">Diseño sugerido por el cliente:</td>
						<td colspan="1"><input class="form-control" /></td>
						<td colspan="1">Clase de plantas: <input class="form-control" /></td>
						<td colspan="1">Diseño en área baja: <input class="form-control" /></td>
						<td colspan="1">Diseño en altura: <input class="form-control" /></td>
						<td colspan="1">Permiso en altura: <input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="3">Cantidad de plantas sugeridas para el jardin: </td>
						<td colspan="3"><textarea class="form-control"></textarea></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Roceria de cesped</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="1">Roceria en área baja:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="1">Roceria en altura: <input class="form-control" /></td>
						<td colspan="1">Personal en altura: </td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>Roceria de cesped en taludes</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="1">Roceria en área baja:</td>
						<td colspan="2"><input class="form-control" /></td>
						<td colspan="1">Roceria en altura: <input class="form-control" /></td>
						<td colspan="1">Personal en altura: </td>
						<td colspan="1"><input class="form-control" /></td>
					</tr>
					<tr>
						<td colspan="6">
							Observaciones:
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table width="100%" class="table table-bordered">
					<tr>
						<td colspan="6">
							Anotaciones Finales::
							<textarea class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</template>

<template id="RequestsNew-requests-proposals-create">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h2>Crear una nueva propuesta</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<li><a @click="saveproposal" class="#"><i class="fa fa-save"></i></a></li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<section class="content invoice">
					<div class="row">
						<div class="col-xs-12 invoice-header">
							<h1><i class="fa fa-globe"></i> PROPUESTA DE PRESTACION DE SERVICIOS. <small class="pull-right">Fecha: {{ record.created }}</small></h1>
						</div>
					</div>

					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">
							Creada por:
							<address>
								<strong>{{ record.create_by.names }} {{ record.create_by.surname }}</strong>
								<br>Teléfono Fijo: {{ record.create_by.phone }}
								<br>Teléfono Movil: {{ record.create_by.mobile }}
								<br>Email: {{ record.create_by.email }}
							</address>
						</div>
						<div class="col-sm-4 invoice-col">
							Para:
							<address>
								<strong>{{ request.names }} {{ request.surname }}</strong>
								<br>{{ request.identification_type.code }} {{ request.identification_number }}
								<br>{{ request.address }} {{ request.city.name }} - {{ request.department.name }}
								<br>Teléfono Fijo: {{ request.phone }}
								<br>Teléfono Movil: {{ request.mobile }}
								<br>Email: {{ request.email }}
							</address>
						</div>
						<div class="col-sm-4 invoice-col">
							<b>Propuesta # {{ getRadicado(record) }}</b>
							<br><br><b>Solicitud #:</b> {{ getRadicado(request) }}
							<br><b>Fecha limite:</b> <input style="width: 45%;display: inline;" v-model="record.payment_due" type='text' class="form-control" data-toggle="tooltip" data-placement="top" title="Formato: AÑO-MES-DIA HORA:MINUTOS:SEGUNDOS 2019-12-31 23:59:00" />
							<br><b># Cliente:</b>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 table">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Cantidad</th>
										<th style="width: 22%">Producto o Servicio</th>
										<th>Valor Unitario</th>
										<th style="width: 22%">Descripcion</th>
										<th>Tipo de Medición</th>
										<th style="width: 14%">Subtotal</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr class="form-group multiple-form-group input-group-" v-for="(item, index) in record.items">
										<div>
											<td>
												<input @change="calc" v-model="item.qty" type="text" class="form-control">
											</td>
											<td>
												<input v-model="item.name" type="text" class="form-control">
											</td>
											<td>
												<input @change="calc" v-model="item.vu" type="number" step="0.01" class="form-control">
											</td>
											<td>
												<input v-model="item.description" type="text" class="form-control">
											</td>
											<td>
												<div class="input-group-btn input-group-select">
													<select v-model="item.medition" class="form-control">
														<option value="">Ninguno</option>
														<option value='{"name":"Metros Líneales", "code":"M", "value":"m"}'>M - Metros Líneales</option>
														<option value='{"name":"Metros Cuadrados", "code":"M2", "value":"m2"}'>M2 - Metros Cuadrados</option>
														<option value='{"name":"Metros Cúbicos", "code":"M3", "value":"m3"}'>M2 - Metros Cúbicos</option>
													</select>
												</div>
											</td>
											<td>$ {{ $root.formatMoney(item.subtotal) }}</td>
											<td>
												<span class="input-group-btn">

													<button v-if="index === (record.items.length-1)" @click="addItem" type="button" class="btn btn-success btn-add">+</button>
													<button @click="removeItem(index)" type="button" class="btn btn-danger btn-add">-</button>
												</span>
											</td>
										</div>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="row">
						<!-- accepted payments column -->
						<div class="col-xs-6">
							<p class="lead">Metodos de pago:</p>
							<img src="/C&CM/themes/generic/assets/images/visa.png" alt="Visa">
							<img src="/C&CM/themes/generic/assets/images/mastercard.png" alt="Mastercard">
							<img src="/C&CM/themes/generic/assets/images/american-express.png" alt="American Express">
							<img src="/C&CM/themes/generic/assets/images/paypal.png" alt="Paypal">
							<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
							</p>
						</div>
						<!-- /.col -->
						<div class="col-xs-6">
							<p class="lead">Monto adeudado </p>
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<th style="width:50%">Subtotal:</th>
											<td>$ {{ $root.formatMoney(subtotal) }}</td>
										</tr>
										<tr>
											<th>Impuestos:</th>
											<td><input v-model="record.tax" type="number" step="0.01" class="form-control"></td>
										</tr>
										<tr>
											<th>Envío:</th>
											<td><input v-model="record.shipping" type="number" step="0.01" class="form-control"></td>
										</tr>
										<tr>
											<th>Total:</th>
											<td>$ {{ $root.formatMoney(record.total) }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<!-- this row will not appear when printing -->
					<div class="row no-print">
						<div class="col-xs-12">
							<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
							<!-- // <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Enviar Propuesta</button> -->
							<button @click="closed" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Cerrar & Publicar</button>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</template>

<template id="RequestsNew-requests-proposals-view">
	<div>
		<div class="x_panel">
			<div class="x_title">
				<h1><i class="fa fa-globe"></i> PROPUESTA DE PRESTACION DE SERVICIOS. <small class="pull-right">Fecha: {{ record.created }}</small></h1>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link-2"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<router-link tag="li" :to="{ name: 'RequestsNew-Requests-View', params: { request_id: $route.params.request_id } }">
						<a class="close-link"><i class="fa fa-close"></i></a>
					</router-link>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<section class="content invoice">
					<div class="row">
						<div class="col-xs-12 invoice-header">

						</div>
					</div>

					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">
							Creada por:
							<address>
								<strong>{{ record.create_by.names }} {{ record.create_by.surname }}</strong>
								<br>Teléfono Fijo: {{ record.create_by.phone }}
								<br>Teléfono Movil: {{ record.create_by.mobile }}
								<br>Email: {{ record.create_by.email }}
							</address>
						</div>
						<div class="col-sm-4 invoice-col">
							Para:
							<address>
								<strong>{{ record.request.names }} {{ record.request.surname }}</strong>
								<br>{{ record.request.identification_type.code }} {{ record.request.identification_number }}
								<br>{{ record.request.address }} {{ record.request.city.name }} - {{ record.request.department.name }}
								<br>Teléfono Fijo: {{ record.request.phone }}
								<br>Teléfono Movil: {{ record.request.mobile }}
								<br>Email: {{ record.request.email }}
							</address>
						</div>
						<div class="col-sm-4 invoice-col">
							<b>Propuesta # {{ getRadicado(record) }}</b>
							<br><br><b>Solicitud #:</b> {{ getRadicado( record.request) }}
							<br><b>Fecha limite:</b> {{ new Date(record.payment_due).toMysqlFormat() }}
							<br><b># Cliente:</b>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 table">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Cantidad</th>
										<th style="width: 22%">Producto o Servicio</th>
										<th>Valor Unitario</th>
										<th style="width: 22%">Descripcion</th>
										<th>Tipo de Medición</th>
										<th style="width: 14%">Subtotal</th>
									</tr>
								</thead>
								<tbody>
									<tr class="form-group multiple-form-group input-group-" v-for="(item, index) in record.items">
										<div>
											<td>{{ item.qty }}</td>
											<td>{{ item.name }}</td>
											<td>{{ item.vu }}</td>
											<td>{{ item.description }}</td>
											<td>{{ item.medition.name }}</td>
											<td>$ {{ $root.formatMoney(item.subtotal) }}</td>
										</div>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="row">
						<!-- accepted payments column -->
						<div class="col-xs-6">
							<p class="lead">Metodos de pago:</p>
							<img src="/C&CM/themes/generic/assets/images/visa.png" alt="Visa">
							<img src="/C&CM/themes/generic/assets/images/mastercard.png" alt="Mastercard">
							<img src="/C&CM/themes/generic/assets/images/american-express.png" alt="American Express">
							<img src="/C&CM/themes/generic/assets/images/paypal.png" alt="Paypal">
							<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
							</p>
						</div>
						<!-- /.col -->
						<div class="col-xs-6">
							<p class="lead">Monto adeudado </p>
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<th style="width:50%">Subtotal:</th>
											<td>$ {{ record.subtotal }}</td>
										</tr>
										<tr>
											<th>Impuestos:</th>
											<td>{{ record.tax }}</td>
										</tr>
										<tr>
											<th>Envío:</th>
											<td>{{ record.shipping }}</td>
										</tr>
										<tr>
											<th>Total:</th>
											<td>$ {{ $root.formatMoney(record.total) }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<!-- this row will not appear when printing -->
					<div class="row no-print">
						<div class="col-xs-12">
							<button v-if="record.response == null" @click="declineProposal" class="btn btn-warning"><i class="fa fa-thumbs-o-down"></i> Declinar Propuesta</button>

							<button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
							<button class="btn btn-info pull-right"><i class="fa fa-send"></i> Enviar Propuesta</button>
							<button v-if="record.response == null" @click="acceptedProposal" class="btn btn-success pull-right"><i class="fa fa-thumbs-o-up"></i> Aceptar Propuesta</button>

						</div>
					</div>
				</section>
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
	template: '#RequestsNew-requests-list',
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
	template: '#RequestsNew-requests-view',
	data: function () {
			var self = this;
			return {
				upf_enable: this.$route.params.upf_enable,
				window: window,
				in_team: false,
				request_id: this.$route.params.request_id,
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
				  "requests_media": []
				},
				calendarEl: null,
				calendar: null,
				events: [],
				onyxDropzone: null
			};
	},
	mounted(){
		var self = this;

		var Onyx = Onyx || {};
		Onyx = {
			init: function() {
				var self = this, obj;
				for (obj in self) {
					if ( self.hasOwnProperty(obj)) {
						var _method =  self[obj];
						if ( _method.selector !== undefined && _method.init !== undefined ) {
							if ( $(_method.selector).length > 0 ) { _method.init(); }
						}
					}
				}
			},
			userFilesDropzone: {
				selector: 'form.dropzone',
				init: function() {
					var base = this,
						container = $(base.selector);
					base.initFileUploader(base, 'form.dropzone');
				},
				initFileUploader: function(base, target) {
					var previewNode = document.querySelector("#onyx-dropzone-template");
					previewNode.id = "";
					var previewTemplate = previewNode.parentNode.innerHTML;
					previewNode.parentNode.removeChild(previewNode);
					var onyxDropzone = new Dropzone(target, {
						url: ($(target).attr("action")) ? $(target).attr("action") : "/?controller=Media&action=upload_file", // Check that our form has an action attr and if not, set one here
						maxFiles: 5,
						maxFilesize: 8,
						acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
						previewTemplate: previewTemplate,
						previewsContainer: "#previews",
						clickable: true,
						createImageThumbnails: true,
						dictDefaultMessage: "Arrastra los archivos aquí para subirlos.", // Default: Drop files here to upload
						dictFallbackMessage: "Su navegador no admite la carga de archivos de arrastrar y soltar.", // Default: Your browser does not support drag'n'drop file uploads.
						dictFileTooBig: "El archivo es demasiado grande ({{filesize}} MiB). Tamaño máximo de archivo: {{maxFilesize}} MiB.", // Default: File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.
						dictInvalidFileType: "No puedes subir archivos de este tipo.", // Default: You can't upload files of this type.
						dictResponseError: "El servidor respondió con el código {{statusCode}}.", // Default: Server responded with {{statusCode}} code.
						dictCancelUpload: "Cancelar carga.", // Default: Cancel upload
						dictUploadCanceled: "Subida cancelada.", // Default: Upload canceled.
						dictCancelUploadConfirmation: "¿Estás seguro de que deseas cancelar esta carga?", // Default: Are you sure you want to cancel this upload?
						dictRemoveFile: "Remover archivo", // Default: Remove file
						dictRemoveFileConfirmation: null, // Default: null
						dictMaxFilesExceeded: "No puedes subir más archivos.", // Default: You can not upload any more files.
						dictFileSizeUnits: {
							tb: "TB",
							gb: "GB",
							mb: "MB",
							kb: "KB",
							b: "b"
						},
						on: {
							success: function(file, response) {
								console.log('file', file);
								console.log('response', response);
								// self.load();
								let parsedResponse = JSON.parse(response);
								file.upload_ticket = parsedResponse.response.id;
								// Make it wait a little bit to take the new element

								console.log('parsedResponse', parsedResponse);
								console.log('upload_ticket', upload_ticket);

								setTimeout(function(){
									$(".uploaded-files-count").html(base.dropzoneCount());
									console.log('Files count: ' + base.dropzoneCount());
								}, 350);
								// Something to happen when file is uploaded
							}
						}
					});
					Dropzone.autoDiscover = false;
					onyxDropzone.on("addedfile", function(file) {
						console.log('file', file);
						$('.preview-container').css('visibility', 'visible');
						file.previewElement.classList.add('type-' + base.fileType(file.name)); // Add type class for this element's preview
					});
					onyxDropzone.on("totaluploadprogress", function (progress) {
						var progr = document.querySelector(".progress .determinate");
						if (progr === undefined || progr === null) return;
						progr.style.width = progress + "%";
					});
					onyxDropzone.on('dragenter', function () {
						$(target).addClass("hover");
					});
					onyxDropzone.on('dragleave', function () {
						$(target).removeClass("hover");
					});
					onyxDropzone.on('drop', function () {
						$(target).removeClass("hover");
					});
					onyxDropzone.on('addedfile', function () {
						// Remove no files notice
						$(".no-files-uploaded").slideUp("easeInExpo");
					});
					onyxDropzone.on('removedfile', function (file) {
						console.log('target_file', file.upload_ticket);
						$.ajax({
							type: "POST",
							url: ($(target).attr("action")) ? $(target).attr("action") : "/?controller=Media&action=upload_file",
							data: {
								target_file: file.upload_ticket,
								delete_file: 1
							},
							success: function (r) {
								console.log('Response: ', r);
							},
						});
						// Show no files notice
						if ( base.dropzoneCount() == 0 ) {
							$(".no-files-uploaded").slideDown("easeInExpo");
							$(".uploaded-files-count").html(base.dropzoneCount());
						}
					});

				},
				dropzoneCount: function() {
					var filesCount = $("#previews > .dz-success.dz-complete").length;
					return filesCount;
				},
				fileType: function(fileName) {
					var fileType = (/[.]/.exec(fileName)) ? /[^.]+$/.exec(fileName) : undefined;
					return fileType[0];
				}
			}
		};

		self.load();
	},
	methods: {
		getUploads(){
			var self = this;
			router.push({ name: 'RequestsNew-Requests-Uploads', params: { request_id: self.$route.params.request_id, upf_enable: true } });
			location.reload();
		},
		finishUploads(){
			var self = this;
			router.push({ name: 'RequestsNew-Requests-View', params: { request_id: self.$route.params.request_id } });
		},
		loadScriptsOnyx(){
		},
		loadOnyx(){
			var self = this;
		},
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
				// defaultView: 'listWeek',
				defaultView: 'listYear',
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
										router.push({ name: 'RequestsNew-Requests-View', params: { request_id: self.$route.params.request_id} })
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
						'proposals,users',
						'requests_media',
						'requests_media,media',
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
	template: '#RequestsNew-requests-calendar-view',
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
				defaultView: 'listYear',
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
	template: '#RequestsNew-requests-calendar-create',
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

var MyRequestsTechnicalsCreate = Vue.extend({
	template: '#RequestsNew-requests-technicals-create',
	data() {
		return {};
	},
	mounted(){
		var self = this;
		self.$root.loadScripts();
	},
});

var MyRequestsproposalsCreate = Vue.extend({
	template: '#RequestsNew-requests-proposals-create',
	data() {
		return {
			proposal_id: this.$route.params.proposal_id,
			request_id: this.$route.params.request_id,
			request: {
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
			  "created": "2018-01-01 01:00:00",
			  "updated": "",
			  "requests_team": [],
			  "requests_activity": [],
			},
			record: {
				subtotal: 0,
				total: 0,
				items: [],
				create_by: {
					names: '',
					surname: '',
				},
			}
		};
	},
	mounted(){
		var self = this;
		self.$root.loadScripts();
		self.loadForms();
		self.load();
	},
	computed: {
		subtotal(){
			var self = this;
			self.calc();
			return self.record.subtotal;
		},
	},
	methods: {
		closed(){
			var self = this;
			api.put('/records/proposals/' + self.proposal_id, {
				id: self.proposal_id,
				items: JSON.stringify(self.record.items),
				subtotal: self.record.subtotal,
				shipping: self.record.shipping,
				tax: self.record.tax,
				total: self.record.total,
				close: 1,
				closed: new Date().toMysqlFormat(),
				payment_due: self.record.payment_due,
			})
			.then(b => {
				if(b != undefined){
					$.notify("Cerrada con éxito", "success");
					router.push({ name: 'RequestsNew-Requests-proposals-View', params: { request_id: self.request_id, proposal_id: self.proposal_id } });
				}
			})
			.catch(e => {
				console.error(e.response);
			});
		},
		calc(){
			var self = this;
			self.record.subtotal = 0;
			if(self.record.items != undefined && self.record.items.length > 0){
				self.record.items.forEach(function(a){
					a.subtotal = (parseFloat(a.vu) * parseFloat(a.qty));
					self.record.subtotal += a.subtotal;
				});
			}
			self.record.total = (parseFloat(self.record.subtotal) + parseFloat(self.record.shipping) + parseFloat(self.record.tax));
		},
		zfill: zfill,
		itemDefault(){
			return {
				qty: 0,
				name: '',
				vu: 0,
				description: '',
				medition: '',
				subtotal: 0
			};
		},
		addItem(){
			var self = this;
			self.record.items.push(self.itemDefault());
		},
		removeItem(index){
			var self = this;
			self.record.items.splice(index, 1);

		},
		loadForms(){
			var self = this;
			self.record.items.push(self.itemDefault());
		},
		returnMouthText(mouth){
			array = [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ];
			return array[mouth-1];
		},
		getRadicado(item){
			var self = this;
			if(item.created != undefined){
				radSeparate = item.created.split(" ");
				radFecha = radSeparate[0].split("-");
				return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
			}else{
				return "#NA#";
			}
		},
		load(){
			var self = this;
			if(self.$route.name == "RequestsNew-Requests-proposals-Create"){
				// validar que no exista una propuesta abierta
				api.get('/records/proposals/', {
					params: {
						filter: [
							'request,eq,' + self.request_id,
							'close,eq,0'
						],
						join: [
							'requests,identifications_types',
							'requests,geo_departments',
							'requests,geo_citys',
							'requests,requests_types',
							'requests,requests_status',
						]
					}
				})
				.then(a => {
					if(a.data.records != undefined && a.data.records.length == 0){
						api.post('/records/proposals', {
							request: self.request_id,
							create_by: <?php echo $_SESSION['user']['id']; ?>
						})
						.then(b => {
							if(b != undefined){
								if(b.data != undefined && b.data > 0){
									self.proposal_id = b.data;
									self.loadproposal();
								}
							}
						})
						.catch(e => {
							console.error(e.response);
						});
					}else{
						// en caso de haaber una propuesta abierta, se abre está
						if(a.data != undefined && a.data.records != undefined && a.data.records[0] != undefined && a.data.records[0].id != undefined && a.data.records[0].id > 0){
							self.proposal_id = a.data.records[0].id;
							self.loadproposal();
						}
					}
				});
			}else{
				self.loadproposal();
				// en caso de haaber una propuesta existente, se abre está
			}
		},
		loadproposal(){
			var self = this;
			api.get('/records/proposals/' + self.proposal_id, {
				params: {
					filter: [
						'request,eq,' + self.request_id,
						'close,eq,0'
					],
					join: [
						'users',
						'requests',
						'requests,identifications_types',
						'requests,geo_departments',
						'requests,geo_citys',
						'requests,requests_types',
						'requests,requests_status',
					]
				}
			})
			.then(r => { self.validateResult(r); })
			.catch(e => { self.validateResult(e.response); });
		},
		validateResult(r){
			var self = this;
			if (r.data != undefined){
				if(r.data != undefined){
					if(r.data.items != null){
						r.data.items = JSON.parse(r.data.items);
					}else{
						r.data.items = [];
						r.data.items.push(self.itemDefault());
					}
				}
				self.request = r.data.request;
				r.data.request = r.data.request.id;
				self.record = r.data;
				console.log('r.data', r.data);
			} else {
				 console.log('Error: consulta validateResult');
				 //console.log(response
			}
		},
		saveproposal(){
			var self = this;
			api.put('/records/proposals/' + self.proposal_id, {
				id: self.proposal_id,
				items: JSON.stringify(self.record.items),
				subtotal: self.record.subtotal,
				shipping: self.record.shipping,
				tax: self.record.tax,
				total: self.record.total,
				payment_due: self.record.payment_due,
			})
			.then(b => {
				if(b != undefined){
					$.notify("Guardada con éxito", "success");
				}
			})
			.catch(e => {
				console.error(e.response);
			});
		},
	}
});

var MyRequestsproposalsView = Vue.extend({
	template: '#RequestsNew-requests-proposals-view',
	data() {
		return {
			proposal_id: this.$route.params.proposal_id,
			request_id: this.$route.params.request_id,
			record: {
				subtotal: 0,
				total: 0,
				items: [],
				create_by: {
					names: '',
					surname: '',
				},
				request: {
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
				  "created": "2018-01-01 01:00:00",
				  "updated": "",
				  "requests_team": [],
				  "requests_activity": [],
				},
			}
		};
	},
	mounted(){
		var self = this;
		self.$root.loadScripts();
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
			if(item.created != undefined){
				radSeparate = item.created.split(" ");
				radFecha = radSeparate[0].split("-");
				return radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(item.id, 5);
			}else{
				return "#NA#";
			}
		},
		load(){
			var self = this;
			api.get('/records/proposals/' + self.proposal_id, {
				params: {
					filter: [
						'request,eq,' + self.request_id,
						'close,eq,1'
					],
					join: [
						'users',
						'requests',
						'requests,identifications_types',
						'requests,geo_departments',
						'requests,geo_citys',
						'requests,requests_types',
						'requests,requests_status',
					]
				}
			})
			.then(r => { self.validateResult(r); })
			.catch(e => { self.validateResult(e.response); });
		},
		validateResult(r){
			var self = this;
			if (r.data != undefined){
				if(r.data.items != null){
					r.data.items = JSON.parse(r.data.items);
					r.data.items.forEach(function(a){
						if(a.medition != undefined && a.medition != null && a.medition != ""){
							a.medition = JSON.parse(a.medition);
						}
					});
				}
				self.record = r.data;
			} else {
				 console.log('Error: consulta validateResult');
				 //console.log(response
			}
		},
		acceptedProposal(){
			var self = this;
			bootbox.confirm({
			    message: "Confirmas que aceptas esta propuesta.",
			    locale: 'es',
			    callback: function (a) {
			        if(a == true){
						api.put('/records/proposals/' + self.proposal_id, {
							id: self.proposal_id,
							response: 1,
							response_date: new Date().toMysqlFormat(),
							response_by: <?php echo $_SESSION['user']['id']; ?>
						})
						.then(rd => {
							if(rd.data != undefined && rd.data > 0){
								api.post('/records/requests_activity', {
									request: self.$route.params.request_id,
									user: <?php echo $_SESSION['user']['id']; ?>,
									type: 'status',
									info: JSON.stringify({
										"text": "Se aprobó una propuesta."
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
		declineProposal(){
			var self = this;

			bootbox.prompt({
					locale: 'es',
					title: "Cuentanos el motivo, Así nuestro equipo intentara solucionarlo.",
					inputType: 'text',
					callback(rD) {
						if(rD != null){
							console.log('proposal_id ', self.$route.params.proposal_id);
							console.log('response ', rD);

							api.put('/records/proposals/' + self.$route.params.proposal_id, {
							  id: self.$route.params.proposal_id,
							  response: 0,
							  response_date: new Date().toMysqlFormat(),
							  response_by: '<?= $_SESSION['user']['id']; ?>',
							  response_notes: rD
							})
							.then(rd => {
							  if(rd.data != undefined && rd.data > 0){
							    api.post('/records/requests_activity', {
							      request: self.$route.params.request_id,
							      user: <?= $_SESSION['user']['id']; ?>,
							      type: 'status',
							      info: JSON.stringify({
							        "text": "Se rechazó una propuesta. "
							      }),
							    })
							    .then(activityResult => {
							      if(activityResult.data != undefined){
							        console.log('Gracias por  tu gestión.');
							        self.load();
							        router.push({ name: 'RequestsNew-Requests-View', params: { request_id: self.$route.params.request_id} })
							      }
							    })
							    .catch(e => { self.showErrorSQL(e); });
							  }
							})
							.catch(e => { self.showErrorSQL(e); });

						} else {
							console.log('No existe respuesta');
						}
					}
			});
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: MyRequestsList, name: 'RequestsNew-Requests' },
		{ path: '/filter/status/:filterStatus', component: MyRequestsList, name: 'RequestsNew-filterStatus' },
		{ path: '/view/:request_id', component: MyRequestsView, name: 'RequestsNew-Requests-View' },
		{ path: '/view/:request_id/:upf_enable', component: MyRequestsView, name: 'RequestsNew-Requests-Uploads' },
		{ path: '/view/:request_id/calendar/create', component: MyRequestsCalendarCreate, name: 'RequestsNew-Requests-Calendar-Create' },
		{ path: '/view/:request_id/calendar/view', component: MyRequestsCalendarView, name: 'RequestsNew-Requests-Calendar-View' },
		{ path: '/view/:request_id/technicals/create', component: MyRequestsTechnicalsCreate, name: 'RequestsNew-Requests-Technicals' },
		{ path: '/view/:request_id/proposals/create', component: MyRequestsproposalsCreate, name: 'RequestsNew-Requests-proposals-Create' },
		{ path: '/view/:request_id/proposals/edit/:proposal_id', component: MyRequestsproposalsCreate, name: 'RequestsNew-Requests-proposals-Edit' },
		{ path: '/view/:request_id/proposals/view/:proposal_id', component: MyRequestsproposalsView, name: 'RequestsNew-Requests-proposals-View' },
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
		formatMoney(n, c, d, t){
			var c = isNaN(c = Math.abs(c)) ? 2 : c,
				d = d == undefined ? "." : d,
				t = t == undefined ? "," : t,
				s = n < 0 ? "-" : "",
				i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
				j = (j = i.length) > 3 ? j % 3 : 0;
			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		},
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
		}
	},
}).$mount('#RequestsNew-requests');

</script>

<?php 
$myInfo = $this->myUser;
$list = new RequestType($this->adapter);
$alltypes = $list->getAll('ASC');	
?>

<div class="" id="app">
	<div class="page-title">
	  <div class="title_left">
		<h3>Mi Cuenta</h3>
	  </div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		 <router-view :key="$route.fullPath"></router-view>
	  </div>
	</div>
  </div>
 
<template id="create">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Nueva <small>Solicitud </small></h2>
						
						<ul class="nav navbar-right panel_toolbox">
							<!-- //
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a></li>
									<li><a href="#">Settings 2</a></li>
								</ul>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
							-->
							<router-link tag="li" :to="{ name: 'Home' }">
								<a class="close-link"><i class="fa fa-close"></i></a>
							</router-link>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						
						<forms-create-dynamic :options_form="thisForm"></forms-create-dynamic>
					</div>
					<!-- // 
					<div class="x_content">
						<br />
						<button v-on:click="count++">You clicked me {{ count }} times.</button>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
</template>
 
<template id="home">
	<div>
		<div class="x_panel" style="height:600px;">
			<div class="x_content">
				<div class="row">
					<div class="col-md-12">
						<?php
							foreach($alltypes as $type){
								if($type->highlight == 1){
									?>
									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="pricing ui-ribbon-container">
											<div class="ui-ribbon-wrapper">
												<div class="ui-ribbon">
													Nuevo
												</div>
											</div>
											<div class="title">
												<h2></h2>
												<h1><?php echo $type->title; ?></h1>
												<span><?php echo $type->subtitle; ?></span>
											</div>
											<div class="x_content">
												<div><?php echo htmlspecialchars_decode(htmlspecialchars($type->description)); ?></div>
												<div class="pricing_footer">
													<router-link tag="a" :to="{ name: 'Create', params: { request_type: '<?php echo (($type->id)); ?>' }}" class="btn btn-primary btn-block" role="button">
														Lo <span> entendí!</span>
													</router-link>
													<!-- // <p><a href="javascript:void(0);">Sign up</a></p> -->
												</div>
											</div>
										</div>
									</div>
									
									<?php 
								}else{
									?>
									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="pricing">
											<div class="title">
												<h2><?php echo $type->subtitle; ?></h2>
												<h1><?php echo $type->title; ?></h1>
											</div>
											<div class="x_content">
												<div><?php echo htmlspecialchars_decode(htmlspecialchars($type->description)); ?></div>
												<div class="pricing_footer">
													<router-link tag="a" :to="{ name: 'Create', params: { request_type: '<?php echo (($type->id)); ?>' }}" class="btn btn-success btn-block" role="button">
														Lo <span> entendí!</span>
													</router-link>

													<!-- // <p><a href="javascript:void(0);">Sign up</a></p> -->
												</div>
											</div>
										</div>
									</div>
									<?php 
								}
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var Create = Vue.extend({
	template: '#create',
	data: function () {
		return {
			thisForm: {
				titulo: 'Mi Cuenta - Nueva solicitud',
				subtitulo: '',
				descripcion: 'Esta información se enviara al departamento <code>Comercial</code> y serán ellos los encargados de continuar su  <a href="#">proceso</a>',
				action: "create",
				tabla: "requests",
				fields: {
					type: {
						show: false,
						required: true,
						value: this.$route.params.request_type
					},
					spanTitle001: {
						label: "Infomacion de contacto",
						typeInput: "section",
					},
					identification_type: {
						label: "Tipo de documento de identidad",
						required: true,
						typeInput: "select",
						options: "identifications_types",
						value: ""
					},
					identification_number: {
						label: "Documento de identidad",
						required: true,
						typeInput: "text",
						value: ""
					},
					names: {
						label: "Nombres o Razón social",
						required: true,
						typeInput: "text",
						value: "<?php echo $myInfo->names; ?>"
					},
					surname: {
						label: "Apellidos",
						required: true,
						typeInput: "text",
						value: "<?php echo $myInfo->surname; ?>"
					},
					email: {
						label: "Correo electronico",
						required: true,
						typeInput: "email",
						value: "<?php echo $myInfo->email; ?>"
					},
					phone: {
						label: "Teléfono Fijo",
						required: true,
						typeInput: "text",
						value: "<?php echo $myInfo->phone; ?>"
					},
					mobile: {
						label: "Teléfono Móvil",
						required: true,
						typeInput: "text",
						value: "<?php echo $myInfo->mobile	; ?>"
					},
					spanTitle003: {
						label: "Infomacion del servicio",
						typeInput: "section",
					},
					department: {
						label: "Departamento",
						required: true,
						typeInput: "select",
						options: "geo_departments"
					},
					city: {
						label: "Ciudad",
						required: true,
						typeInput: "select",
						options: "geo_citys"
					},
					address:{
						label: "Dirección",
						required: true,
						typeInput: "textarea"
					},
					points_reference: {
						label: "Puntos de referencia (Dirección)",
						required: false,
						typeInput: "textarea"
					},
					request: {
						label: "Cuentanos que deseas...",
						required: true,
						typeInput: "textarea"
					},
				},
				callEvent(resultado){
					if(resultado.id != undefined && resultado.id > 0){
						api.post('/records/users_requests', {
							user: '<?php echo $myInfo->id; ?>',
							request: resultado.id
						}).then(function (response) {
							bootbox.alert({
								message: "<h1>Muy Bien!</h1><br>La solicitud se a creado y enviado con éxito, el # del Radicado es <h5>" + resultado.recordId + "</h5>",
								callback: function () {
									location.reload();
								}
							})
						}).catch(function (error) {
							console.log(error);
							console.log(error.response);
						});
					}
				}
			}
		};
	},
	created(){
		var self = this;
		console.log(self.$route.params.request_type);
	}
});

var Home = Vue.extend({
	template: '#home',
	data: function () {
		return {
			
		};
	},
	
});


var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: Home, name: 'Home' },
		{ path: '/new/:request_type', component: Create, name: 'Create', params: { subject: 'requests' } },
	]
});

var app = new Vue({
	router: router,
	components: {
		'forms-create-dynamic': FormsCreateDynamic,
	},
}).$mount('#app');
</script>

<li role="presentation" class="dropdown" id="navbartop-notifications-requests-new" @click="refreshList()">
	<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
		<i class="fa fa-at"></i>
		<span class="badge bg-green" v-if="count > 0">{{ count }}</span>
	</a>
	<ul class="dropdown-menu list-unstyled msg_list" role="menu">
		<div style="height:auto;overflow-y:scroll;    overflow: auto">
			<template v-if="records.length == 0 || records == undefined || records == null">
				<li>
					<a>
						<span>
							<span></span>
							<span class="time"></span>
						</span>
						<span class="message">No hay solicitudes.</span>
					</a>
				</li>
			</template>
			<template v-else>
				<li v-for="item in records">
					<a :href="'/SAC/requests_new/#/view/' + item.id">
						<span>
							<span>{{ item.names }} {{ item.surname }} </span>
							<span class="time">{{ item.updated }}</span>
						</span>
						<span class="message">{{ item.request.replace(/<\/?[^>]+(>|$)/g, '').slice(0,25) }}</span>
					</a>
				</li>
			</template>
		</div>
		<li>
			<div class="text-center">
				<a href="/SAC/requests_new/#/filter/status/0,1">
					<strong>Nuevas Solicitudes</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</li>
	</ul>
</li>


<li role="presentation" class="dropdown" id="navbartop-notifications-calendar" @click="refreshCalendar()">
	<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
		<i class="fa fa-calendar-o"></i>
		<span class="badge bg-green" v-if="count > 0">{{ count }}</span>
	</a>
	<ul class="dropdown-menu list-unstyled msg_list" role="menu">
		<div style="height:auto;overflow-y:scroll;    overflow: auto">
			<div id="calendar-navbar"></div>
			<template v-if="records.length == 0 || records == undefined || records == null">
				No tienes eventos
			</template>
		</div>
		<li>
			<div class="text-center">
				<a href="/micuenta/calendar#/">
					<strong>Mi calendario</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</li>
	</ul>
</li>

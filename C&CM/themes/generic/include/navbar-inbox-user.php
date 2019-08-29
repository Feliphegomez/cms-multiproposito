
<li role="presentation" class="dropdown" id="navbartop-notifications-inbox" @click="load()">
	<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
		<i class="fa fa-envelope-o"></i>
		<span class="badge bg-green" v-if="count > 0">{{ count }}</span>
	</a>
	<ul class="dropdown-menu list-unstyled msg_list" role="menu">
		<div style="height:auto;overflow-y:scroll;    overflow: auto;">

			<template v-if="records.length > 0">
				<li v-for="(inbox, i) in records">
					<a v-bind:href="'/index.php?controller=Usuarios&action=inbox#/conversation/' + inbox.id + '/view'" v-if="inbox.conversations_replys[0]">
						<span class="image"><img :src="getAvatar(inbox.conversations_replys[0].user)" alt="Profile Image"></span>
						<span>
							<span><b>{{ inbox.conversations_replys[0].user.names }} </b></span>
							<span class="time">{{ inbox.updated }}</span>
						</span>
						<span class="message">{{ inbox.conversations_replys[0].reply.text.replace(/<\/?[^>]+(>|$)/g, '').slice(0,25) }}</span>
					</a>
				</li>
			</template>
			<template v-else><li><a><span><span></span><span class="time"></span></span><span class="message">No hay conversaciones.</span></a></li></template>
		</div>

		<li>
			<div class="text-center">
				<a href="<?php echo $this->linkUrl('Usuarios', 'inbox'); ?>">
					<strong>Bandeja de Mensajes</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</li>
	</ul>
</li>

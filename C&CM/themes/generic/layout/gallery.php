<div class="" id="gallery">
	<div class="row">
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Gestión de archivos <small> Media</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<router-view :key="$route.fullPath"></router-view>
				</div>
			</div>
		</div>
	</div>
</div>
<template id="gallery-list">
	<div>
		<div class="row">
			<template v-if="records.length == 0">
				<p>No hay archivos.</p>
			</template>
			<template v-else>
				<div class="col-md-55" v-for="(item, i) in records">
					<div class="thumbnail">
						<div class="image view view-first">
							<template v-if="(item.type.split('image/')[1])">
								<img style="width: 100%; height: 100%; display: block;" :src="item.path_short" alt="image" />
							</template>
							<template v-else-if="(item.type == 'application/pdf')">
								<img style="width: 100%; height: 100%; display: block;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2IDU2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHN0eWxlIHR5cGU9InRleHQvY3NzIj4uc3Qwe2ZpbGw6I0UyNTc0Qzt9LnN0MXtmaWxsOiNCNTM2Mjk7fS5zdDJ7ZmlsbDojRkZGRkZGO308L3N0eWxlPjxnPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zNi45LDBoLTI5QzcuMiwwLDYuNCwwLjYsNi40LDEuOVY1NWMwLDAuNCwwLjYsMSwxLjUsMWg0MC4xYzAuNywwLDEuNS0wLjYsMS41LTFWMTNjMC0wLjctMC4xLTAuOS0wLjMtMS4xTDM3LjcsMC4zQzM3LjQsMC4xLDM3LjIsMCwzNi45LDBMMzYuOSwweiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0zNy40LDAuMVYxMmgxMS45TDM3LjQsMC4xeiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0xNy4zLDM0LjNoLTEuNlYyNC4xaDIuOWMwLjQsMCwwLjksMC4xLDEuMiwwLjNjMC40LDAuMSwwLjcsMC40LDEuMSwwLjZjMC40LDAuMywwLjYsMC42LDAuNywxYzAuMywwLjQsMC4zLDAuOSwwLjMsMS4yYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMSwwLjQtMC40LDAuNy0wLjcsMWMtMC4zLDAuMy0wLjYsMC41LTEuMSwwLjZjLTAuNCwwLjEtMC45LDAuMy0xLjUsMC4zaC0xLjN2My44SDE3LjN6IE0xNy4zLDI1LjR2NGgxLjVjMC4zLDAsMC40LDAsMC42LTAuMXMwLjQtMC4xLDAuNS0wLjRjMC4xLTAuMSwwLjMtMC40LDAuNC0wLjZzMC4xLTAuNiwwLjEtMWMwLTAuMSwwLTAuNC0wLjEtMC42YzAtMC4zLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMy0wLjQtMC40LTAuNi0wLjVjLTAuMy0wLjEtMC42LTAuMy0xLTAuM2gtMS4xVjI1LjR6Ii8+PHBhdGggY2xhc3M9InN0MiIgZD0iTTMyLjIsMjguOWMwLDAuOS0wLjEsMS41LTAuMywyLjFjLTAuMSwwLjYtMC40LDEuMS0wLjYsMS41Yy0wLjMsMC40LTAuNiwwLjctMC45LDFjLTAuNCwwLjMtMC42LDAuNC0xLDAuNWMtMC40LDAuMS0wLjYsMC4xLTAuOSwwLjNjLTAuMywwLTAuNSwwLTAuNiwwaC0zLjlWMjQuMWgzYzAuOSwwLDEuNiwwLjEsMi4yLDAuNGMwLjYsMC4zLDEuMSwwLjYsMS42LDEuMWMwLjQsMC41LDAuNywxLDEsMS41QzMyLjEsMjcuOCwzMi4yLDI4LjQsMzIuMiwyOC45TDMyLjIsMjguOXogTTI3LjMsMzNjMS4xLDAsMS45LTAuNCwyLjQtMS4xYzAuNS0wLjcsMC43LTEuOCwwLjctMy4xYzAtMC40LDAtMC45LTAuMS0xLjJzLTAuMy0wLjctMC42LTEuMWMtMC4zLTAuNC0wLjYtMC42LTEuMS0wLjdjLTAuNS0wLjMtMS4xLTAuMy0xLjktMC4zaC0xVjMzTDI3LjMsMzNMMjcuMywzM3oiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzYuMiwyNS40djMuMWg0LjN2MS4xaC00LjN2NC41aC0xLjZWMjRoNi4zdjEuM2gtNC42VjI1LjR6Ii8+PC9nPjwvc3ZnPg==" alt="image" />
							</template>
							<template v-else-if="(item.type == 'application/doc')">
								<img style="width: 100%; height: 100%; display: block;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojMDA5NkU2O30uc3Qxe2ZpbGw6IzAwNjJCMjt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTIyLjUsMjkuOGMwLDAuOC0wLjEsMS41LTAuMywyLjFzLTAuNCwxLjEtMC43LDEuNXMtMC42LDAuNy0wLjksMC45cy0wLjcsMC40LTEsMC41QzE5LjMsMzQuOSwxOSwzNSwxOC44LDM1Yy0wLjMsMC0wLjUsMC0wLjYsMGgtMy44VjI1aDNjMC44LDAsMS42LDAuMSwyLjIsMC40czEuMiwwLjYsMS42LDEuMXMwLjcsMSwxLDEuNUMyMi40LDI4LjYsMjIuNSwyOS4yLDIyLjUsMjkuOHogTTE3LjYsMzMuOWMxLjEsMCwxLjktMC40LDIuNC0xLjFzMC43LTEuNywwLjctMy4xYzAtMC40LDAtMC44LTAuMS0xLjJjLTAuMS0wLjQtMC4zLTAuOC0wLjYtMS4xcy0wLjctMC42LTEuMi0wLjhzLTEuMS0wLjMtMS45LTAuM2gtMXY3LjZDMTYsMzMuOSwxNy42LDMzLjksMTcuNiwzMy45eiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0zMi41LDMwYzAsMC44LTAuMSwxLjYtMC4zLDIuMnMtMC41LDEuMi0wLjksMS42Yy0wLjQsMC40LTAuOCwwLjgtMS4zLDFzLTEuMSwwLjMtMS43LDAuM3MtMS4yLTAuMS0xLjctMC4zcy0wLjktMC41LTEuMy0xcy0wLjctMS0wLjktMS42cy0wLjMtMS40LTAuMy0yLjJzMC4xLTEuNiwwLjMtMi4yYzAuMi0wLjYsMC41LTEuMiwwLjktMS42YzAuNC0wLjQsMC44LTAuOCwxLjMtMXMxLjEtMC4zLDEuNy0wLjNzMS4yLDAuMSwxLjcsMC4zczAuOSwwLjUsMS4zLDFjMC40LDAuNCwwLjcsMSwwLjksMS42QzMyLjQsMjguNCwzMi41LDI5LjIsMzIuNSwzMHogTTI4LjIsMzMuOGMwLjMsMCwwLjctMC4xLDEtMC4yYzAuMy0wLjEsMC42LTAuMywwLjgtMC42YzAuMi0wLjMsMC40LTAuNywwLjYtMS4yczAuMi0xLjEsMC4yLTEuOGMwLTAuNy0wLjEtMS4zLTAuMi0xLjdjLTAuMS0wLjUtMC4zLTAuOS0wLjUtMS4ycy0wLjUtMC41LTAuOC0wLjdjLTAuMy0wLjEtMC42LTAuMi0wLjktMC4yYy0wLjMsMC0wLjcsMC4xLTEsMC4yYy0wLjMsMC4xLTAuNiwwLjMtMC44LDAuNmMtMC4yLDAuMy0wLjQsMC43LTAuNiwxLjJzLTAuMiwxLjEtMC4yLDEuOGMwLDAuNywwLjEsMS4zLDAuMiwxLjhzMC4zLDAuOSwwLjUsMS4yczAuNSwwLjUsMC44LDAuN0MyNy42LDMzLjcsMjcuOSwzMy44LDI4LjIsMzMuOHoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNNDEuNiwzNC4xYy0wLjQsMC40LTAuOCwwLjYtMS4zLDAuOGMtMC41LDAuMi0xLDAuMy0xLjUsMC4zYy0wLjYsMC0xLjItMC4xLTEuNy0wLjNzLTAuOS0wLjUtMS4zLTFzLTAuNy0xLTAuOS0xLjZzLTAuMy0xLjQtMC4zLTIuMnMwLjEtMS42LDAuMy0yLjJjMC4yLTAuNiwwLjUtMS4yLDAuOS0xLjZjMC40LTAuNCwwLjgtMC44LDEuMy0xYzAuNS0wLjIsMS4xLTAuMywxLjctMC4zYzAuNSwwLDEuMSwwLjEsMS41LDAuM2MwLjUsMC4yLDAuOSwwLjUsMS4zLDAuOGwtMS4xLDFjLTAuMi0wLjMtMC41LTAuNS0wLjgtMC42cy0wLjYtMC4yLTAuOS0wLjJjLTAuMywwLTAuNywwLjEtMSwwLjJjLTAuMywwLjEtMC42LDAuMy0wLjgsMC42Yy0wLjIsMC4zLTAuNCwwLjctMC42LDEuMnMtMC4yLDEuMS0wLjIsMS44YzAsMC43LDAuMSwxLjMsMC4yLDEuOHMwLjMsMC45LDAuNSwxLjJzMC41LDAuNSwwLjgsMC43YzAuMywwLjEsMC42LDAuMiwwLjksMC4yczAuNi0wLjEsMC45LTAuMnMwLjUtMC4zLDAuOC0wLjZMNDEuNiwzNC4xeiIvPjwvZz48L3N2Zz4=" alt="image" />
							</template>
							<template v-else-if="(item.type == 'application/zip')">
								<img style="width: 100%; height: 100%; display: block;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojNTU2MDgwO30uc3Qxe2ZpbGw6IzNGNDg1RTt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTI0LjksMjV2MS4zbC00LjgsNy4ybC0wLjMsMC4yaDUuMVYzNWgtNi43di0xLjNsNC44LTcuMmwwLjMtMC4yaC01LjFWMjVIMjQuOXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMjguOSwzNWgtMS43VjI1aDEuN1YzNXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzMsMzVoLTEuNlYyNWgyLjljMC40LDAsMC45LDAuMSwxLjMsMC4yczAuOCwwLjMsMS4xLDAuNmMwLjMsMC4zLDAuNiwwLjYsMC44LDFzMC4zLDAuOCwwLjMsMS4zYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMiwwLjQtMC40LDAuOC0wLjcsMWMtMC4zLDAuMy0wLjcsMC41LTEuMSwwLjdzLTAuOSwwLjItMS40LDAuMkgzM0wzMywzNUwzMywzNXogTTMzLDI2LjJ2NGgxLjVjMC4yLDAsMC40LDAsMC42LTAuMWMwLjItMC4xLDAuNC0wLjIsMC41LTAuM3MwLjMtMC40LDAuNC0wLjZzMC4yLTAuNiwwLjItMWMwLTAuMiwwLTAuNC0wLjEtMC42YzAtMC4yLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjMtMC40LTAuNi0wLjVzLTAuNi0wLjItMS0wLjJMMzMsMjYuMkwzMywyNi4yeiIvPjwvZz48L3N2Zz4=" alt="image" />
							</template>
							<template v-else>
								<iframe style="width: 100%; height: 100%; display: block;" :src="'/?controller=Media&action=image_text&txt_input=' + item.type.split('/')[1]" alt="image"></iframe>
							</template>
							
							<div class="mask">
								<p style="overflow: hidden;max-height: 45px;">{{ item.type }}</p>
								<div class="tools tools-bottom">
									<a target="_blank" :href="item.path_short"><i class="fa fa-link"></i></a>
									<a href="#"><i class="fa fa-pencil"></i></a>
									<a @click="deleteItem(item.id)"><i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>
						<div class="caption">
							<p>{{ item.name }}</p>
						</div>
					</div>
				</div>
			</template>
			
		</div>
	</div>
</template>
<script>
var GalleryList = Vue.extend({
	template: '#gallery-list',
	data: function () {
		return {
			records: []
		};
	},
	mounted(){
		var self = this;
		self.load();
	},
	methods: {
		load(){
			var self = this;
			api.get('/records/media', {
				params: {
					order: 'id,desc'
				}
			})
			.then(response => {
				self.validateResult(response);
			})
			.catch(e => {
				// Capturamos los errores
				self.validateResult(e.response);
			});
		},
		validateResult(a){
			var self = this;
			try {
				if (a.data != undefined && a.data.records != undefined){
					self.records = a.data.records;
				}
			}catch(e){
				console.log(e);
				console.log(e.response);
			}
		},
		deleteItem(id){
			var self = this;
			bootbox.confirm({
				message: "Debes confirmar antes de continuar, esta modificacion es irreversible.",
				locale: 'es',
				callback: function (result) {
					if(result === true){
						$.ajax({
							type: "POST",
							url: "/?controller=Media&action=upload_file",
							data: {
								target_file: id,
								delete_file: 1
							},
							success: function (r) {
								console.log('Response: ', r);
								r = JSON.parse(r);
								if(r.status != 'error'){
									console.log("Borrado OK.");
									for( var i = 0; i < self.records.length; i++){ 
									   if ( self.records[i].id === id) {
										 self.records.splice(i, 1); 
									   }
									}
								}else{
									console.log("Error");
								}
							}
						});
					}
				}
			});
		}
	}
});


var Gallery = new Vue({
	router: new VueRouter({
		linkActiveClass: 'active',
		routes:[
			{ path: '/', component: GalleryList, name: 'Gallery-List' },
		]
	}),
	methods: {
	},
}).$mount('#gallery');

</script>
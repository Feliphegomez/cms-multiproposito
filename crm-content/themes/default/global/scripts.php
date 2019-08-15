
<?php $myInfo = (isset($_SESSION['user'])) ? $_SESSION['user'] : null; ?>


<!-- Custom Theme Scripts -->
<script src="<?php echo $this->urlNav; ?>/assets/build/js/custom.js"></script>
<script>

<?php if(ControladorBase::validatePermission("PQRSF", "navbar_legal") == true){ ?>
	var NotificationsLegalNavbarTop = new Vue({
		data(){
			return {
				count: 0,
				records: []
			};
		},
		created(){
			var self = this;
			self.load();
		},
		methods: {
			load(){
				var self = this;
				api.get('/records/pqrs', {
					params: {
						filter: [
							'type,in,1,2,3',
							'status,in,1',
						],
						join: [
							'types_identifications',
							'geo_departments',
							'geo_citys',
							'pqrs_status',
							'pqrs_types',
						]
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
			getLink(pqrs){
				var self = this;
				action = '';
				pqrs.id = (pqrs.id != undefined && pqrs.id > 0) ? pqrs.id : 0;
				typeId = (pqrs.type.id != undefined && pqrs.type.id > 0) ? pqrs.type.id : ((pqrs.type != undefined && pqrs.type > 0) ? pqrs.type : 0);
				return '/index.php?controller=PQRSF&action=ver_pqrsf&type=' + typeId + '&id=' + pqrs.id;
			},
			validateResult(response){
				var self = this;
				if (response.data != undefined && response.data.records != undefined){
					self.records = response.data.records;
					self.count = self.records.length;
					if(response.data.records[0]){
						/*
						self.searchBox.error = false;
						self.record = response.data.records[0];
						self.record.event_occurred = self.record.event_occurred.replace(/(?:\r\n|\r|\n)/g, '<br>');
						self.record.petition = self.record.petition.replace(/(?:\r\n|\r|\n)/g, '<br>');
						
						radSeparate = response.data.records[0].created.split(" ");
						if(radSeparate[0] != undefined){
							radFecha = radSeparate[0].split("-");
							if(radFecha.length === 3){
								self.recordId = radFecha[0] + radFecha[1] + radFecha[2] + self.zfill(response.data.records[0].id, 5);
								self.recordDateText = radFecha[0] + radFecha[1] + radFecha[2];
							}
						}
						self.searchBox.errorText = "Esta queja si fue encontrada";
						*/
					} else {
						self.searchBox.errorText = "Esta queja no fue encontrada";
					}
				} else {
					 console.log('Error: consulta'); 
					 console.log(response.data); 
				}
			},
		},
	}).$mount('#navbartop-notifications-legal');
<?php } ?>


<?php if(ControladorBase::validatePermission("SAC", "inbox") == true && $myInfo != null){ ?>
	var NotificationsInboxSACNavbarTop = new Vue({
		data(){
			return {
				count: 0,
				records: []
			};
		},
		created(){
			var self = this;
			self.load();
		},
		methods: {
			load(){
				var self = this;
				api.get('/records/conversations', {
					params: {
						filter: [
							// 'user,in,<?php echo ($myInfo['id']); ?>',
							'status,in,0,2'
						],
						join: [
							'conversations_replys',
							'conversations_replys,users_login',
						]
					}
				})
				.then(response => {
					self.validateResult(response);
				})
				.catch(e => {
					// Capturamos los errores
					self.validateResult(e);
				});
			},
			getLink(pqrs){
				var self = this;
				action = '';
				pqrs.id = (pqrs.id != undefined && pqrs.id > 0) ? pqrs.id : 0;
				typeId = (pqrs.type.id != undefined && pqrs.type.id > 0) ? pqrs.type.id : ((pqrs.type != undefined && pqrs.type > 0) ? pqrs.type : 0);
				return '/index.php?controller=PQRSF&action=ver_pqrsf&type=' + typeId + '&id=' + pqrs.id;
			},
			validateResult(response){
				var self = this;
				if (response.data != undefined && response.data.records != undefined){
					self.records = [];
					self.count = 0;
					if(response.data.records[0]){
						response.data.records.forEach(item => {
							self.records.push(item);
							self.count++;
						});
					} else {
						self.searchBox.errorText = "Esta queja no fue encontrada";
					}
				} else {
					 console.log('Error: consulta'); 
					 console.log(response.data); 
				}
			},
		},
	}).$mount('#navbartop-notifications-inbox-sac');
<?php } ?>
</script>
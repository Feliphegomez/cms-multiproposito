<?php
	if(isUser() == true && $guests == 1){
		echo "Espere mientras lo redireccionamos...";
		echo "<meta http-equiv=\"Refresh\" content=\"0; url=/index.html\">";
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<?php $this->getInclude('head-complete'); ?>

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap&subset=latin-ext,vietnamese" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>

			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
			<script>
				$(document).ready(function(){
					var date_input=$('input[name="date"]'); //our date input has the name "date"
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					date_input.datepicker({
						format: 'yyyy-mm-dd',
						container: container,
						todayHighlight: true,
						autoclose: true,
					})
				})
			</script>

			<style>
				body{
					background-image: url(<?php echo $this->getDirTheme(); ?>/assets/images/bg-1.jpg);
					background-position-x: center;
					background-position-y: center;
					background-size: cover;
					background-repeat-x: no-repeat;
					background-repeat-y: no-repeat;
					background-attachment: fixed;
					background-origin: initial;
					background-clip: initial;
					background-color: initial;
				}
				.top-buffer-1 { margin-top:20px; }
				.top-buffer { margin-top:2px; }
				fieldset.scheduler-border {
					border: 1px groove #ddd !important;
					padding: 0 1.4em 1.4em 1.4em !important;
					margin: 0 0 1.5em 0 !important;
					-webkit-box-shadow:  0px 0px 0px 0px #000;
							box-shadow:  0px 0px 0px 0px #000;
				}

					legend.scheduler-border {
						font-size: 1.2em !important;
						font-weight: bold !important;
						text-align: left !important;
						width:auto;
						padding:0 1px;
						border-bottom:none;
					}
				.login-wrapper {
					width: 100%;
					height: 100%;
					position: absolute;
					display: table;
					z-index: 2;
				}
				.note
				{
					text-align: center;
					height: 80px;
					background: -webkit-linear-gradient(left, #0072ff, #8811c5);
					color: #fff;
					font-weight: bold;
					line-height: 80px;
				}
				.note p{ font-size:30px; }
				.form-content
				{
					padding: 5%;
					border: 1px solid #ced4da;
					margin-bottom: 2%;
				}
				.form-control{
					border-radius:1.5rem;
				}
				.bk{
					background-color: white;
				}
				@media print {
					body * {
						visibility: visible;
					  }
					  #section-to-print, #section-to-print * {
						visibility: hidden;
					  }
					  #section-to-print {
						position: absolute;
						left: 0;
						top: 0;
					  }
				   .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
						float: left;
				   }
				   .col-sm-12 {
						width: 100%;
				   }
				   .col-sm-11 {
						width: 91.66666667%;
				   }
				   .col-sm-10 {
						width: 83.33333333%;
				   }
				   .col-sm-9 {
						width: 75%;
				   }
				   .col-sm-8 {
						width: 66.66666667%;
				   }
				   .col-sm-7 {
						width: 58.33333333%;
				   }
				   .col-sm-6 {
						width: 50%;
				   }
				   .col-sm-5 {
						width: 41.66666667%;
				   }
				   .col-sm-4 {
						width: 33.33333333%;
				   }
				   .col-sm-3 {
						width: 25%;
				   }
				   .col-sm-2 {
						width: 16.66666667%;
				   }
				   .col-sm-1 {
						width: 8.33333333%;
				   }
				}
			</style>
  </head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<section class="content-section video-section">
					<div class="pattern-overlay">
						<div class="container">
							<div class="row">
								<br><br>
								<div class="col-xs-10 col-xs-offset-1 bg-dark">
										<div class="container register-form top-buffer-1">
											<?php
												$this->getPage($vista, $dataView);
											?>
										</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php $this->getInclude('footer-complete'); ?>
		<?php $this->getInclude('templates-complete'); ?>
		<?php $this->getInclude('scripts-complete'); ?>
	</body>
</html>

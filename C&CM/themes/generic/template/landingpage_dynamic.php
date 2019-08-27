<?php 
	if(isUser() == true && $guests == 1){
		echo "Espere mientras lo redireccionamos...";
		echo "<meta http-equiv=\"Refresh\" content=\"0; url=/index.html\">";
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php $this->getInclude('head-complete'); ?>

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap&subset=latin-ext,vietnamese" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.2.10/jquery.mb.YTPlayer.js"></script>

	<style>
	body {
		margin:0;
		color:#edf3ff;
		background:#c8c8c8;
		background:url(<?php echo $this->getDirTheme(); ?>/assets/images/bg-2.jpg) fixed;
		background-size: cover;
		font:600 16px/18px 'Open Sans',sans-serif;
	}
	.big-button .btn {
		font-size: 14px;
		line-height: 20px;
		padding: 14px 28px;
	}
	.big-button .btn-success {
		background: #8ca744;
		border: 1px solid #ffffff00;
	}
	.big-button .btn-success:hover {
		background: #8ca744;
		border: 1px solid #ffffff00;
	}
	.social-icons {
		width: 40px;
		height: 40px;
		background-color: #8ca744;
		color: #fff!important;
		line-height: 25px;
		border: none;
	}
	.social-icons i {
		color: #FFF;
		font-size: 18px;
		vertical-align: middle;
	}
	.big-text h3 {
		color: #fff;
		text-align: center;
		font-size: 21px;
		margin-bottom: 10px;
		font-weight: 500;
		text-transform: uppercase;
	}
	.list-services {
		margin: 0;
		padding: 0;
		border: 0;
		font: inherit;
		font-size: 100%;
		vertical-align: baseline;
	}
	.list-services h2 {
		font-family: 'Quicksand', sans-serif;
		font-weight: 400;
		font-size: 16px;
		color: #fff;
		text-align: center;
		font-size: 14px;
		margin-bottom: 10px;
		font-weight: 500;
	}
	.bg-dark {
		/* width: calc(50vw); */
		background-color: rgba(0, 0, 0, 0.4);
		border-radius: calc(3vw);
	}
	/*
	body {
		min-height: calc(100vh);
		overflow-x: hidden;
		background-image: url(<?php echo $this->getDirTheme(); ?>/assets/images/bg-2.jpg);
		background-size: cover;
		background-position: center;
		background-attachment: fixed;
		background-repeat: no-repeat;
	}
	.bg-dark {
		/* width: calc(85vw); */
		background-color: rgba(0, 0, 0, 0.4);
		border-radius: calc(3vw);
	}
	.video-section .pattern-overlay {
	min-height: calc(25vh);
	}
	.video-section h1, .video-section h3{
	text-align:center;
	color:#fff;
	}
	.video-section h1{
	font-size:75px;
	font-family: 'Buenard', serif;
	font-weight:bold;
	text-transform: uppercase;
	margin: 40px auto 0px;
	text-shadow: 1px 1px 1px #000;
	-webkit-text-shadow: 1px 1px 1px #000;
	-moz-text-shadow: 1px 1px 1px #000;
	}
	.video-section h3{
	font-size: 18px;
	font-weight:lighter;
	margin: 0px auto 15px;
	}
	.video-section .buttonBar{display:none;}
	.player {font-size: 1px;}
	.mbYTP_wrapper {
		height: calc(100vh);
	}
	.social-icons {
		width: 40px;
		height: 40px;
		background-color: rgba(255,255,255,.3);
		color: #fff!important;
		line-height: 25px;
	}
	.social-icons i {
		color: #FFF;
		font-size: 18px;
		vertical-align: middle;
	}
	.big-button .btn {
		font-size: 14px;
		line-height: 20px;
		padding: 14px 28px;
	}
	.big-text h3 {
		color: #fff;
		text-align: center;
		font-size: 21px;
		margin-bottom: 10px;
		font-weight: 500;
		text-transform: uppercase;
	}
	.list-services {
		margin: 0;
		padding: 0;
		border: 0;
		font: inherit;
		font-size: 100%;
		vertical-align: baseline;
	}
	.list-services h2 {
		font-family: 'Quicksand', sans-serif;
		font-weight: 400;
		font-size: 16px;
		color: #fff;
		text-align: center;
		font-size: 14px;
		margin-bottom: 10px;
		font-weight: 500;
	}
	span.section {
		color: #CCC;
	}
	*/
	</style>

  </head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<section class="content-section video-section">
					<div class="pattern-overlay">
						<!-- // https://www.youtube.com/watch?v=MjviJBZ8Vpo -->
						<!-- // <a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=2IulRjQ4gOw',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a> -->
						<div class="container">
							<div class="row">
								<br><br>
								<div class="col-xs-10 col-xs-offset-1 bg-dark">
									<div class="col-middle ">
										<div class="text-center text-center">
											<div class="col-sm-12">
												<?php $this->getPage($vista, $dataView); ?>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="text-right text-right">
											
											<div class="clearfix"></div>
										</div>
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

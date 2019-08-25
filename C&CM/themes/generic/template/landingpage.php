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
			background: #000;
			min-height: calc(100vh);
			overflow-x: hidden;
		}
		.mid_center {
			/* width: calc(50vw); */
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
		.big-button .btn-success {
			background: #8ca744;
			border: 1px solid #ffffff00;
		}
		.big-button .btn-success:hover {
			background: #8ca744;
			border: 1px solid #ffffff00;
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
		</style>

		<script>
			$(document).ready(function () {
				$(".player").mb_YTPlayer();
			});
		</script>
  </head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<section class="content-section video-section">
					<div class="pattern-overlay">
						<a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=MjviJBZ8Vpo',containment:'.video-section', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a>
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="col-middle">
										<div class="text-center text-center">
											<!-- // 
											<h1 class="error-number"><?php echo $title; ?></h1>
											<h2><?php echo $subtitle; ?></h2>
											-->
											<!-- <p>Full authentication is required to access this resource. <a href="#">Report this?</a></p>  style="height:500px;overflow-y:scroll;"-->
											<div class="mid_center">
												<br>
												<br>
												<br>
												<br>
												<div><?php echo htmlspecialchars_decode(htmlspecialchars($description)); ?></div>
											</div>
											<?php // $this->getPage($vista, $dataView); ?>
											<!-- //
											<div class="row">
												<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
													<div class="feature-block-v7 feature-block">
														<div class="feature-icon text-brand bg-brand-light mb-5">
															<i class="fas fa-paint-roller"></i>
														</div>
														<div class="feature-content">
															<h2><?php echo $title; ?></h2>
															<p class="lead"><?php echo $subtitle; ?> </p>
															<hr class="m-t-30 m-b-30">
															<div style="height:500px;overflow-y:scroll;"><?php echo htmlspecialchars_decode(htmlspecialchars($description)); ?></div>
															<a href="#" class="btn btn-rounded btn-outline-primary">Get the app</a>
														</div>
													</div>
												</div>
												<div class="offset-xl-1 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="circle-1"></div>
													<div class="feature-app-img">
														<img src="https://jituchauhan.com/quanto/quanto/images/iphone-img-2.png" alt="App Landing Page Template - Quanto">
													</div>
												</div>
											</div>
											-->
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

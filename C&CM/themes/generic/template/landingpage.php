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

	<style>
	body {
		margin:0;
		color:#edf3ff;
		background:#c8c8c8;
		background:url(<?php echo $this->getDirTheme(); ?>/assets/images/bg-1.jpg) fixed;
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
	/*
	body {
		min-height: calc(100vh);
		overflow-x: hidden;
		background-image: url(<?php echo $this->getDirTheme(); ?>/assets/images/bg-1.jpg);
		background-size: cover;
		background-position: center;
		background-attachment: fixed;
		background-repeat: no-repeat;
		
	}
	.bg-dark {
		/* width: calc(50vw); */
		/* background-color: rgba(0, 0, 0, 0.4); */
		border-radius: calc(3vw);
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
						<div class="container">
							<div class="row">
								<div class="col-xs-10 col-xs-offset-1">
									<div class="col-middle">
												<br>
												<br>
										<div class="text-center text-center bg-dark">
											<div class="">
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
												<br>
												<br>
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

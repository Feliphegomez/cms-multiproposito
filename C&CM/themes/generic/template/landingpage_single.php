<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title><?php echo $this->getTitle(); ?> </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
<style>
body { font-family: 'Circular Std Book'; font-style: normal; font-weight: normal; font-size: 16px; line-height: 27px; color: #808294; -webkit-font-smoothing: antialiased; background: #f8f8fb; }
.body-bg { background-color: #fbfbfc; }
h1, h2, h3, h4, h5, h6 { color: #181825; margin: 0px 0px 15px 0px; font-family: 'Circular Std Book'; }
h1 { font-size: 42px; line-height: 54px; letter-spacing: -1px; }
h2 { font-size: 34px; line-height: 44px; letter-spacing: -1px; }
h3 { font-size: 26px; line-height: 33px; letter-spacing: -1px; }
h4 { font-size: 20px; line-height: 31px; }
h5 { font-size: 16px; line-height: 21px; }
h6 { font-size: 13px; line-height: 21px; }
.h2 { font-size: 35px; line-height: 48px; letter-spacing: -1px; }
.h3, h3 {
    font-size: 26px;
    line-height: 38px;
}
p { margin: 0px 0px 24px 0px; }
p:last-child { margin: 0px; }
a { color: #3544ee; }
a:hover { color: #202db8; text-decoration: none; }
a:active, a:hover { outline: 0; text-decoration: none; }
a.text-primary:focus, a.text-primary:hover {
    color: #202db8!important;
}
.space-medium { padding-top: 100px; padding-bottom: 100px; }

.btn { font-size: 16px; padding: 11px 21px; border-radius: 4px; overflow: hidden; display: inline-block; vertical-align: middle; -webkit-transform: perspective(1px) translateZ(0); transform: perspective(1px) translateZ(0); box-shadow: 0 0 1px rgba(0, 0, 0, 0); overflow: hidden; -webkit-transition-duration: 0.3s; transition-duration: 0.3s; -webkit-transition-property: color, background-color; transition-property: color, background-color; transition: .3s ease; font-family: 'Circular Std Medium' !important; }
.btn-outline-primary { color: #3544ee; background-color: transparent; border-color: #3544ee; }
.btn-outline-primary:hover { color: #fff; background-color: #3544ee; border-color: #3544ee; }
.btn-outline-primary.focus, .btn-outline-primary:focus { color: #fff; background-color: #3544ee; border-color: #3544ee; box-shadow: 0 0 0 1px rgb(53, 68, 238); }
.btn-rounded { border-radius: 100px; }


.feature-block-v7 { }
.feature-block-v7.feature-block { margin-bottom: 30px; }
.feature-block-v7 .feature-content { }
.feature-block-v7 .feature-title { margin-bottom: 5px; font-size: 21px; }
.feature-block-v7 .feature-text { }
.feature-block-v7 .feature-icon { background-color: #e1e4fd; color: #3544ee; padding: 18px; font-size: 20px; display: block; text-align: center; width: 60px; height: 60px; margin-bottom: 30px; line-height: 1.5; border-radius: 100%; }
.feature-app-img { position: relative; text-align: center; }
.circle-1 { position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); width: 390px; height: 390px; background-color: #3be1a4; color: white; text-align: center; line-height: 100px; border-radius: 50%; font-size: 1.3rem; }
.circle-1:hover { cursor: pointer; }
.circle-1::after, .circle-1::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #3be1a4; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-1::after { background: rgb(59, 225, 164); }
.circle-1::after::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #3be1a4; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-1::before { background: rgb(59, 225, 164); -webkit-animation-delay: -0.5s; animation-delay: -0.5s; }
.circle-2 { position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); width: 390px; height: 390px; background-color: #9c4efb; color: white; text-align: center; line-height: 100px; border-radius: 50%; font-size: 1.3rem; }
.circle-2:hover { cursor: pointer; }
.circle-2::after, .circle-2::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #9c4efb; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-2::after { background: rgba(156, 78, 251, .5); }
.circle-2::after::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #3be1a4; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-2::before { background: rgba(156, 78, 251, .5); -webkit-animation-delay: -0.5s; animation-delay: -0.5s; }
.circle-3 { position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); width: 390px; height: 390px; background-color: #fb8645; color: white; text-align: center; line-height: 100px; border-radius: 50%; font-size: 1.3rem; }
.circle-3:hover { cursor: pointer; }
.circle-3::after, .circle-3::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #fb8645; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-3::after { background: rgba(251, 134, 69, .5); }
.circle-3::after::before { content: ""; display: block; position: absolute; top: 0; left: 0; width: 390px; height: 390px; background: #3be1a4; border-radius: 50%; z-index: -1; -webkit-animation: grow 3s ease-in-out infinite; animation: grow 3s ease-in-out infinite; }
.circle-3::before { background: rgba(251, 134, 69, .5); -webkit-animation-delay: -0.5s; animation-delay: -0.5s; }
@-webkit-keyframes grow {
	0% { -webkit-transform: scale(1, 1); transform: scale(1, 1); opacity: 1; }
	100% { -webkit-transform: scale(1.8, 1.8); transform: scale(1.8, 1.8); opacity: 0; }
}
@keyframes grow {
	0% { -webkit-transform: scale(1, 1); transform: scale(1, 1); opacity: 1; }
	100% { -webkit-transform: scale(1.8, 1.8); transform: scale(1.8, 1.8); opacity: 0; }
}

</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

  </head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 <div class="space-medium">
        <div class="container">
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
             <div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-4"> 
					Created for <a href="https://jituchauhan.com/quanto/" target="_blank" class="text-primary">jituchauhan.com</a>
				</div>
			</div>
        </div>
    </div>
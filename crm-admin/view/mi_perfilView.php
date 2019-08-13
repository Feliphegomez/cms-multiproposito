<?php $myData = (isset($_SESSION['user']['id'])) ? $_SESSION['user'] : array(); ?>
<?php $myInfo = new stdClass(); ?>
<?php foreach($myData as $k => $v) { $myInfo->{$k} = $v; } ?>

<?php $userInfo = new Usuario(); ?>
<?php $userInfo->getById($myInfo->id); ?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Mi Perfil</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						<?php echo "{$userInfo->username}"; ?>
						<small><?php echo "{$userInfo->names} {$userInfo->surname}"; ?></small>
					</h2>
					<!--//
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a></li>
								<li><a href="#">Settings 2</a></li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					</ul>
					-->
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
						<div class="profile_img">
							<div id="crop-avatar">
								<!-- <img class="img-responsive avatar-view" src="" alt="Avatar" title="Change the avatar"> -->
								<img class="img-responsive avatar-view" src="<?php echo ($userInfo->avatar->getUrl()); ?>" alt="Avatar" title="Change the avatar">
							</div>
						</div>
						<h3><?php echo "{$userInfo->names} {$userInfo->surname}"; ?></h3>
						<ul class="list-unstyled user_data">
							<li><i class="fa fa-user user-profile-icon"></i> <?php echo $userInfo->username; ?></li>
							<li><i class="fa fa-phone user-profile-icon"></i> <?php echo isset($userInfo->phone) ? $userInfo->phone : 'Sin informacion'; ?></li>
							<li><i class="fa fa-mobile user-profile-icon"></i> <?php echo isset($userInfo->mobile) ? $userInfo->mobile : 'Sin informacion'; ?></li>
							<li><i class="fa fa-envelope user-profile-icon"></i> <?php echo isset($userInfo->email) ? $userInfo->email : 'Sin informacion'; ?></li>
							<li><i class="fa fa-clock-o user-profile-icon"></i> <?php echo isset($userInfo->last_connection) ? $userInfo->last_connection : 'Sin informacion'; ?></li>
							<!-- //
							<li class="m-top-xs">
								<i class="fa fa-external-link user-profile-icon"></i>
								<a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
							</li>
							-->
						</ul>
						<a href="<?php echo $this->linkUrl('Usuarios', 'mi_perfil_edit'); ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Editar Mi Perfil</a>
						<br />
						<!--
						<h4>Skills</h4>
						<ul class="list-unstyled user_data">
							<li>
								<p>Web Applications</p>
								<div class="progress progress_sm">
									<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
								</div>
							</li>
							<li>
								<p>Website Design</p>
								<div class="progress progress_sm">
									<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
								</div>
							</li>
							<li>
								<p>Automation & Testing</p>
								<div class="progress progress_sm">
									<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
								</div>
							</li>
							<li>
								<p>UI / UX</p>
								<div class="progress progress_sm">
									<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
								</div>
							</li>
							<li>
								<p><?php #echo json_encode($myInfo); ?>
								<div class="progress progress_sm">
									<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
								</div>
							</li>
						</ul>
						-->
					</div>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="profile_title">
							<div class="col-md-6">
								<h2>Actividad del usuario</h2>
							</div>
							<div class="col-md-6">
								<div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
									<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
								</div>
							</div>
						</div>
						
						<div id="graph_bar" style="width:100%; height:280px;"></div>
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a></li>
								<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
								<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
									<ul class="messages">
										<li>
											<img src="<?php echo ($userInfo->avatar->getUrl()); ?>" class="avatar" alt="Avatar">
											<div class="message_date">
												<h3 class="date text-info">24</h3>
												<p class="month">May</p>
											</div>
											<div class="message_wrapper">
												<h4 class="heading">$this->userData</h4>
												<blockquote class="message"><?php echo json_encode($this->userData); ?></blockquote>
												<br />
												<p class="url">
													<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
													<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
												</p>
											</div>
										</li>
										<li>
											<img src="<?php echo ($userInfo->avatar->getUrl()); ?>" class="avatar" alt="Avatar">
											<div class="message_date">
												<h3 class="date text-error">21</h3>
												<p class="month">May</p>
											</div>
											<div class="message_wrapper">
												<h4 class="heading">Brian Michaels</h4>
												<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
												<br />
												<p class="url">
													<span class="fs1" aria-hidden="true" data-icon=""></span>
													<a href="#" data-original-title="">Download</a>
												</p>
											</div>
										</li>
										<li>
											<img src="<?php echo ($userInfo->avatar->getUrl()); ?>" class="avatar" alt="Avatar">
											<div class="message_date">
												<h3 class="date text-info">24</h3>
												<p class="month">May</p>
											</div>
											<div class="message_wrapper">
												<h4 class="heading">Desmond Davison</h4>
												<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
												<br />
												<p class="url">
													<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
													<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
												</p>
											</div>
										</li>
										<li>
											<img src="<?php echo ($userInfo->avatar->getUrl()); ?>" class="avatar" alt="Avatar">
											<div class="message_date">
												<h3 class="date text-error">21</h3>
												<p class="month">May</p>
											</div>
											<div class="message_wrapper">
												<h4 class="heading">Brian Michaels</h4>
												<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
												<br />
												<p class="url">
													<span class="fs1" aria-hidden="true" data-icon=""></span>
													<a href="#" data-original-title="">Download</a>
												</p>
											</div>
										</li>
									</ul>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
									<table class="data table table-striped no-margin">
										<thead>
											<tr>
												<th>#</th>
												<th>Project Name</th>
												<th>Client Company</th>
												<th class="hidden-phone">Hours Spent</th>
												<th>Contribution</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>New Company Takeover Review</td>
												<td>Deveint Inc</td>
												<td class="hidden-phone">18</td>
												<td class="vertical-align-mid">
													<div class="progress">
														<div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
													</div>
												</td>
											</tr>
											<tr>
												<td>2</td>
												<td>New Partner Contracts Consultanci</td>
												<td>Deveint Inc</td>
												<td class="hidden-phone">13</td>
												<td class="vertical-align-mid">
													<div class="progress">
														<div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
													</div>
												</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Partners and Inverstors report</td>
												<td>Deveint Inc</td>
												<td class="hidden-phone">30</td>
												<td class="vertical-align-mid">
													<div class="progress">
														<div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
													</div>
												</td>
											</tr>
											<tr>
												<td>4</td>
												<td>New Company Takeover Review</td>
												<td>Deveint Inc</td>
												<td class="hidden-phone">28</td>
												<td class="vertical-align-mid">
													<div class="progress">
													<div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
									<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
									photo booth letterpress, commodo enim craft beer mlkshk </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
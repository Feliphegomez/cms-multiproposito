<?php 
$myInfo = $this->myUser;
$list = new Request($this->adapter);
$allrequests = $list->getAllUser($myInfo->id);
?>

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Projects <small>Listing design</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p>
						Simple table with project listing with progress and editing options
					</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Project Name</th>
                          <th>Team Members</th>
                          <th>Project Progress</th>
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
						<tbody>
							<?php 
								foreach($allrequests as $item){ 
									$req = new Request($this->adapter);
									$req->getById($item->request);
							?>
								<tr>
									<td>#</td>
									<td>
										<a><?php echo "{$req->names} {$req->surname}"; ?></a>
										<br />
										<small><?php echo "{$req->created}"; ?></small>
									</td>
									<td>
										<ul class="list-inline">
											<li>
												<img src="images/user.png" class="avatar" alt="Avatar">
											</li>
											<li>
											<img src="images/user.png" class="avatar" alt="Avatar">
											</li>
											<li>
											<img src="images/user.png" class="avatar" alt="Avatar">
											</li>
											<li>
											<img src="images/user.png" class="avatar" alt="Avatar">
											</li>
										</ul>
									</td>
									<td class="project_progress">
										<div class="progress progress_sm">
											<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo ($req->status->progress); ?>"></div>
										</div>
										<small><?php echo ($req->status->progress); ?>% Complete</small>
									</td>
									<td>
										<button type="button" class="btn btn-success btn-xs"><?php echo ($req->status->name); ?></button>
									</td>
									<td>
										<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
										<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
										<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

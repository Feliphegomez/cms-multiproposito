<?php 
// nxZA1Xgc4E	andres.gomez@monteverdeltda.com
// 2gdH2whLlT	soporte@monteverdeltda.com
// -------------------------------------------------------------------------
$buzonPruebas = new stdClass();
$buzonPruebas->host = 'mail.monteverdeltda.com';
$buzonPruebas->port = '143';
$buzonPruebas->user = 'andres.gomez@monteverdeltda.com';
$buzonPruebas->pass = 'nxZA1Xgc4E';

$buzones = array($buzonPruebas);

/*
$mbox = imap_open();

echo "<h1>Buzones</h1>\n";
$carpetas = imap_listmailbox($mbox, "{mail.monteverdeltda.com:143}", "*");

if ($carpetas == false) {
    echo "Llamada fallida<br />\n";
} else {
    foreach ($carpetas as $val) {
        echo $val . "<br />\n";
    }
}

echo "<h1>Cabeceras en INBOX</h1>\n";
$cabeceras = imap_headers($mbox);

if ($cabeceras == false) {
    echo "Llamada fallida<br />\n";
} else {
    foreach ($cabeceras as $val) {
        echo $val . "<br />\n";
    }
}

imap_close($mbox);
*/
date_default_timezone_set("America/Bogota");
echo json_encode($buzones)."<br><hr>";
echo json_encode($this->post)."<br><hr>";

$accountSelected = (!isset($this->post['accountSelected']) || !isset($buzones[$this->post['accountSelected']])) ? 0 : $this->post['accountSelected'];
echo json_encode($accountSelected)."<br><hr>";

if(!isset($buzones[$accountSelected])){
	echo "No existe correo.";
	exit();
}

$inbox = $buzones[$accountSelected];



$mbox = imap_open("{{$inbox->host}:{$inbox->port}}", $inbox->user, $inbox->pass);
$n_msgs = imap_num_msg($mbox);

echo "<h1>Buzones</h1>\n";
$carpetas = imap_listmailbox($mbox, "{{$inbox->host}:{$inbox->port}}", "*");

if ($carpetas == false) {
    echo "Llamada fallida<br />\n";
} else {
    foreach ($carpetas as $val) {
        echo $val . "<br />\n";
    }
}

#$messages = imap_headers($mbox);
$messages = array();
for ($i=1; $i<$n_msgs; $i++) {
	$item = imap_headerinfo($mbox, $i);
	$item->fetchstructure = imap_fetchstructure($mbox, $i);
	$item->body = imap_body($mbox, $i);
	$messages[] = $item;
	#$messages[] = imap_header($mbox, $i);
}
imap_close($mbox);
 
 

echo json_encode($n_msgs)."<br><hr>";
#echo json_encode($messages)."<br><hr>";

function imapString($value){
	$senderaddress = imap_mime_header_decode($value);
	$encode = $senderaddress[0]->charset;
	switch(strtoupper($encode)){
		case 'DEFAULT':
			return $value;
		break;
		default:
			#return $encode;
			return iconv($senderaddress[0]->charset, 'UTF-8', $senderaddress[0]->text);
		break;
	}
}
?>



<div class="">

            <div class="page-title">
              <div class="title_left">
                <h3>Inbox Design <small>Some examples to get you started</small></h3>
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
                    <h2>Inbox Design<small>User Mail</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column">
                        <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
						
						<?php 
								/*
								{
								**	"date":"Mon, 22 Jul 2019 10:12:02 -0500",
									"Date":"Mon, 22 Jul 2019 10:12:02 -0500",
								**	"subject":"Ingreso",
									"Subject":"Ingreso",
									"message_id":"",
								**	"toaddress":"Andres Felipe Gomez Maya ",
								**	"to":[{"personal":"Andres Felipe Gomez Maya", //Para
									"mailbox":"andres.gomez",
									"host":"monteverdeltda.com"}],
								**	"fromaddress":"Andrea Higuita Caro ",
								**	"from":[{"personal":"Andrea Higuita Caro","mailbox":"andrea.higuita","host":"monteverdeltda.com"}],
								**	"ccaddress":"gerencia@gestinpro.com",
								**	"cc":[{"mailbox":"gerencia","host":"gestinpro.com"}],
								**	"reply_toaddress":"Andrea Higuita Caro ",
								**	"reply_to":[{"personal":"Andrea Higuita Caro","mailbox":"andrea.higuita","host":"monteverdeltda.com"}],
								**	"senderaddress":"Andrea Higuita Caro ",
								**	"sender":[{"personal":"Andrea Higuita Caro","mailbox":"andrea.higuita","host":"monteverdeltda.com"}],
									"Recent":" ",
									"Unseen":" ",
									"Flagged":" ",
									"Answered":" ",
									"Deleted":" ",
									"Draft":" ",
									"Msgno":" 1",
									"MailDate":"22-Jul-2019 10:12:20 -0500",
									"Size":"3961",
									"udate":1563808340
								}
								*/
							foreach (array_reverse($messages) as $val) {
								# echo json_encode($val);
								# iconv_mime_decode($string,0,"UTF-8"); 
								$date = strtotime($val->date);
								?>
								<a href="#">
								  <div class="mail_list">
									<div class="left">
									  <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
									</div>
									<div class="right">
										<h3>
											<?php echo imapString($val->senderaddress); ?> 
											<small><?php echo date("Y-m-d h:i:sa", $date); ?></small>
										</h3>
									  <p><?php echo imapString($val->subject); ?> </p>
									  <!-- // <p><?php echo ($val->Size / (1024*10)); ?></p> -->
									</div>
								  </div>
								</a>
								<?php 
							}
						?>
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                                <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"> 8:02 PM 12 FEB 2014</p>
                            </div>
                            <div class="col-md-12">
                              <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum.</h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>Jon Doe</strong>
                                <span>(jon.doe@gmail.com)</span> to
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                            <!-- // 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                            <p>Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                              mollit anim id est laborum.</p>
                            <p>Modesed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							  -->
							  
							  
							  
						<?php 
							function foreacTags($message, $part=''){
								$h = $part."<br>";
								foreach ($message as $k=>$v) {
									if(!is_object($v) && !is_array($v)){
										$h .= $part.imapString($v)."<br>";
									}else{
										$h .= $part."{$k} : "."<br>";
										$h .= $part.foreacTags($v, "{$part}{$part}")."<br>";
									}
								}
								return $h;
							}
							
							
							echo imap_qprint($messages[0]->body);
							// echo imapString($messages[0]->body);
							echo "<hr>";
							echo foreacTags($messages[0], '- ');
							/*
							$imap = imap_open("{pop.example.com:995/pop3/ssl/novalidate-cert}", "username", "password"); 

							if( $imap ) { 
								
								 //Check no.of.msgs 
								 $num = imap_num_msg($imap); 

								 //if there is a message in your inbox 
								 if( $num >0 ) { 
									  //read that mail recently arrived 
									  echo imap_qprint(imap_body($imap, $num)); 
								 } 

								 //close the stream 
								 imap_close($imap); 
							} */
						?>
                          </div>
                          <div class="attachment">
                            <p>
                              <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                              <a href="#">Download all attachments</a> |
                              <a href="#">View all images</a>
                            </p>
                            <ul>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  image-name.jpg
                                </div>
                                <span>12KB</span>


                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  img_name.jpg
                                </div>
                                <span>40KB</span>

                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  img_name.jpg
                                </div>
                                <span>30KB</span>

                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                            </ul>
                          </div>
                          <div class="btn-group">
                            <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                            <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                          </div>
                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
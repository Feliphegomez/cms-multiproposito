<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class BussinesController extends ControladorBase{
    public $conectar;
    public $adapter;
    public $user;

    public function __construct() {
        parent::__construct();
        $this->conectar=new Conectar();
        $this->adapter=$this->conectar->conexion();

    }

    public function index(){
    }


    public function get_part($data, $encoding) {
        switch($encoding) {
            case ENC7BIT: return $data; // 7BIT
            case ENC8BIT: return $data; // 8BIT
            case ENCBINARY: return $data; // BINARY
            case ENCBASE64: return base64_decode($data); // BASE64
            #case ENCQUOTEDPRINTABLE: return quoted_printable_decode($data); // QUOTED_PRINTABLE
            #case ENCQUOTEDPRINTABLE: return imap_qprint($data); // QUOTED_PRINTABLE
            #case ENCQUOTEDPRINTABLE: return (utf8_decode(quoted_printable_decode($data))); // QUOTED_PRINTABLE
            case ENCQUOTEDPRINTABLE: return json_decode(json_encode(imap_qprint($data))); // QUOTED_PRINTABLE
            case ENCOTHER:
            default:
                return ($data); // OTHER
        }
    }

    public function getDeling(){
		$options = $this->get;
		if(isset($options['mail']) && isset($options['message_id'])) {
			$inbox = new EmailBussines($this->adapter);
			$inbox->getAllById($options['mail']);
			for($i=0; $i <= (count($inbox->buzones)-1); $i++){
				if(isset($inbox->buzones[$i]->id) && $inbox->buzones[$i]->id == $options['mail']){
					$inbox->setBuzon($i);
					break;
				}
			}
			$message = $inbox->getMessage($options['message_id']);
			$chequeo = imap_mailboxmsginfo($inbox->mbox);
			imap_delete($inbox->mbox, $options['message_id'].":".$options['message_id']);
			$chequeo = imap_mailboxmsginfo($inbox->mbox);
			imap_expunge($inbox->mbox);
			$chequeo = imap_mailboxmsginfo($inbox->mbox);
			imap_close($inbox->mbox);
		}
	}
		  

    public function getBody(){
		$options = $this->get;
		if(isset($options['mail']) && isset($options['message_id'])) {
			$inbox = new EmailBussines($this->adapter);
			$inbox->getAllById($options['mail']);
			for($i=0; $i <= (count($inbox->buzones)-1); $i++){
				if(isset($inbox->buzones[$i]->id) && $inbox->buzones[$i]->id == $options['mail']){
					$inbox->setBuzon($i);
					break;
				}
			}
		  $message = $inbox->getMessage($options['message_id']);
		  if($message != false){
			$html = '';
			foreach($message->html as $index=>$h){
				$html .= $h;
			}
			$mailHTML=$html;
			#$mailId="email.eml";
			
			$mailId = array($options['message_id'], $inbox->buzonSelected);
			
			
			$generatePartURL=function ($messgeId, $cid) {
				// return "https://crm.ltsolucion.com/?controller=Bussines&action=getBody&mail={$messgeId[1]}&message_id={$messgeId[0]}#/{$cid}"; //Adapt this url according to your needs
				return "\"><object data=\"https://crm.ltsolucion.com/?controller=Bussines&action=getAttach&mail={$messgeId[1]}&message_id={$messgeId[0]}#/{$cid}\"></object> <depure \"";
			};
			$replace=function ($matches) use ($generatePartURL, $mailId) {
				list($uri, $cid) = $matches;
				return $generatePartURL($mailId, $cid);
			};
			$mailHTML=preg_replace_callback("/cid:([^'\" \]]*)/", $replace, $mailHTML);
			
			echo ($mailHTML);
		  //echo json_encode($inbox);
		  }
      }
    }

    public function getAttach(){
      $options = $this->get;
      if(isset($options['mail']) && isset($options['message_id'])) {
          $inbox = new EmailBussines($this->adapter);
          $inbox->getById($options['mail']);
          $messages = array();
          $mbox = imap_open("{{$inbox->host}:{$inbox->port}}", $inbox->user, $inbox->pass);
          $mails = imap_fetch_overview($mbox, "{$options['message_id']}", SE_UID);
          #echo json_encode($mails);
          $n_msgs = count($mails);
          $i = (isset($mails[0]->uid)) ? $mails[0]->uid : 1;

          if ($mails == false) {
              echo "Llamada fallida<br />\n";
          } else {
            $item = imap_headerinfo($mbox, $i);
            $overview = imap_fetch_overview($mbox, $i, 0);
            $structure = imap_fetchstructure($mbox, $i);
            $message = '';

            if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
                $part = $structure->parts[1];
                $message = imap_fetchbody($mbox,$i,2);

                $msg = '_';
                switch ($part->encoding) {
                  case '0':
                    // 0	7bit	ENC7BIT
                   #  echo 0;
                    $msg = (imap_qprint($message));
                    # echo $msg;
                    break;
                  case '1':
                    // 1	8bit	ENC8BIT
                    echo 1;
                    break;
                  case '2':
                    // 2	Binary	ENCBINARY
                    echo 2;
                    break;
                  case '3':
                    // 3	Base64	ENCBASE64
                    # echo 3;
                    $msg = $this->get_part($message, ENCBASE64);
                    $f = finfo_open();
                    $finfo = finfo_buffer($f, $msg, FILEINFO_MIME_TYPE);

                    if($finfo == 'image/png'){
						echo "<img style=\"float:left;width:230px;height:90%;\" src=\"data:image/png;base64, $message\" alt=\"Red dot\" />";
						exit();
						#$data = $this->get_part($message, ENCBASE64);
						#$data = utf8_decode(utf8_encode(base64_decode($message)));
						$data = base64_decode((($message)));
						#$data = imap_qprint($msg);
						$f = finfo_open();
						$finfo = finfo_buffer($f, $msg, FILEINFO_MIME);
						

						$data = strstr($finfo,';',true);
						
						
						echo json_encode($data);
						exit();
						$im = imagecreatefromstring($data);
						  if ($im !== false) {
								header('Content-Type: image/png');
								imagepng($im);
								imagedestroy($im);
							}
							else {
								echo 'Ocurrió un error.';
							}
						  exit();
						  
                    }else if($finfo == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                      header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                      header("Content-Disposition: attachment; filename=\"file_name.xls\"");
                      header("Content-Transfer-Encoding: binary");
                      #header("Content-Length: file_size");
                      #echo $msg;
                    }else if($finfo == 'aplication/pdf'){
                      header("Content-Type: {$finfo}");
                      echo $msg;
                    }else if($finfo == 'text/plain'){
                      header("Content-Type: {$finfo}");
                      echo $msg;
                    }else{
                      echo $finfo;
                      // echo $msg;
                    }
                    break;
                  case '4':
                    // 4	Quoted-Printable	ENCQUOTEDPRINTABLE
                    # echo 4;
                    $msg = imap_qprint($message);
                    echo utf8_decode($msg);
                    break;
                  case '5':
                    // 5	other	ENCOTHER
                    echo 5;
                    break;
                  default:
                    echo "error";
                    break;
                }


                $msg = '';
                exit();
            }
          }
          imap_close($mbox);



      } else if (isset($options['mail']) && isset($options['subject']) && isset($options['since'])) {
        $inbox = new EmailBussines($this->adapter);
        $inbox->getById($options['mail']);
        $messages = array();
        $mbox = imap_open("{{$inbox->host}:{$inbox->port}}", $inbox->user, $inbox->pass);
        $carpetas = imap_listmailbox($mbox, "{mail.monteverdeltda.com:143}", "INBOX");

        # ($search_criteria = "UNSEEN", $date_format = "Y-m-d H:i:s") {
        # $msgs = imap_search($this->imap_stream, $search_criteria);


        if ($carpetas == false) {
            echo "Llamada fallida<br />\n";
        } else {
            // foreach ($carpetas as $val) {
                // echo $val . "<br />\n";
            // }
        }

        $cabeceras = imap_headers($mbox);

        if ($cabeceras == false) {
            echo "Llamada fallida<br />\n";
        } else {
          $cabeceras = imap_search($mbox, "SUBJECT \"{$options['subject']}\" SINCE \"{$options['since']}\"", SE_UID);
          $n_msgs = imap_num_msg($mbox);
          $n_msgs2 = count($cabeceras);

            for ($i = 1; $i <= $n_msgs; $i++) {
              $item = imap_headerinfo($mbox, $i);
              $overview = imap_fetch_overview($mbox, $i, 0);
              $structure = imap_fetchstructure($mbox, $i);
              $message = '';

                            exit();
              if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
                  $part = $structure->parts[1];
                  $message = imap_fetchbody($mbox,$i,2);
                  // $message = imap_qprint($message);
                  if($part->encoding == 3) {
                    $message = imap_base64($message);
                  } else if($part->encoding == 1) {
                    $message = imap_8bit($message);
                  } else {
                    $message = imap_qprint($message);
                  }
                  $message = ($message);
              }

              $item->overview = array();
              foreach ($overview as $index => $elements) {
                $la = new stdClass();
                foreach ($elements as $k => $v) {
                  $la->{$k} = imapString($v);
                  $item->overview[] = $la;
                }
              }

              $item->overviewDefault = $item->overview[0];
              $item->overviewDefault->seen = isset($item->overviewDefault->seen) ? 'read' : 'unread';

              /*
              $item->output = new stdClass();
              $item->output->seen = $overview[0]->seen ? 'read' : 'unread';
              $item->output->from = isset($item->from[0]->personal) ? imapString(($item->from[0]->personal)) : utf8_decode(imap_utf8($overview[0]->from));
              $item->output->fromFull = imapString($overview[0]->from);
              $item->output->date = utf8_decode(imap_utf8($overview[0]->date));
              $item->output->subject = new stdClass();
              $item->output->subject->encoding = 	$part->encoding;
              $item->output->subject->subject = isset($overview[0]->subject) && $overview[0]->subject != '' ? imapString($overview[0]->subject) : 'Sin asunto';
              $item->subject = isset($item->subject) ? imapString($item->subject) : 'Sin asunto';
              #$item->message = htmlspecialchars($message, ENT_QUOTES);
              $item->message = htmlspecialchars($message);
              #$output = '';
              #$output.= '<div class="toggle'.($overview[0]->seen ? 'read' : 'unread').'">';
              #$output.= '<span class="from">From: '.utf8_decode(imap_utf8($overview[0]->from)).'</span>';
              #$output.= '<span class="date">on '.utf8_decode(imap_utf8($overview[0]->date)).'</span>';
              #$output.= '<br /><span class="subject">Subject('.$part->encoding.'): '.utf8_decode(imap_utf8($overview[0]->subject)).'</span> ';
              #$output.= '</div>';
              #$output.= '<div class="body">'.$message.'</div><hr />';
              // $item->output = $output;
              $messages[] = $item;
              #$messages[] = imap_header($mbox, $i);
              */
            }
        }
        imap_close($mbox);
      }
      exit(0);
    }
    
	public function getBodyMail($uid, $imap) {
        $body = $this->get_partMail($imap, $uid, "TEXT/HTML");
        // if HTML body is empty, try getting text body
        if ($body == "") {
            $body = $this->get_partMail($imap, $uid, "TEXT/PLAIN");
        }
        return $body;
    }

    public function get_partMail($imap, $uid, $mimetype, $structure = false, $partNumber = false)
    {
        if (!$structure) {
            $structure = imap_fetchstructure($imap, $uid, FT_UID);
        }
        if ($structure) {
            if ($mimetype == $this->get_mime_typeMail($structure)) {
                if (!$partNumber) {
                    $partNumber = 1;
                }
                $text = imap_fetchbody($imap, $uid, $partNumber, FT_UID);
				echo "$structure->encoding";
				return $this->get_part($text, $structure->encoding);
                /*switch ($structure->encoding) {
                    case 3:
                        return imap_base64($text);
                    case 4:
                        return ((imap_qprint($text)));
                    default:
                        return (($text));
                }*/
            }
            // multipart
            if ($structure->type == 1) {
                foreach ($structure->parts as $index => $subStruct) {
                    $prefix = "";
                    if ($partNumber) {
                        $prefix = $partNumber . ".";
                    }
                    $data = $this->get_partMail($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
                    if ($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }

    function get_mime_typeMail($structure)
    {
        $primaryMimetype = ["TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER"];

        if ($structure->subtype) {
            return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }
}

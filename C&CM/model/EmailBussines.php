<?php
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class EmailBussines extends EntidadBase{
	public $adapter;
	public $inbox;
	public $mbox;
	public $buzones;
	public $carpetas;
	public $messages;
	public $buzonSelected;
	public $inboxSelected;
	public $total_messages;
	
	public $Messages;
	
	public $charset;
	public $htmlmsg;
	public $plainmsg;
	public $attachments;

    public function __construct($adapter) {
		$this->adapter = $adapter;
        $table = TBL_MAILS;
        parent::__construct($table, $adapter);
		$this->buzones = [];
		$this->messages = array();
		$this->carpetas = array();
		$this->total_messages = 0;
    }
	
	public function reConnect(){
		imap_reopen($this->mbox, $this->inboxSelected) or die(implode(", ", imap_errors()));
	}

	public function getById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
		}
	}

    public function getAllByUser($user){
		$usersMails = new UsersMails($this->adapter);
		$mailList = $usersMails->getAllByUser($user);
		foreach ($mailList as $a) {
			$this->buzones[] = $a;
		}
	}

    public function getAllById($id){
		$id = (isset($id) && $id > 0) ? $id : 0;
		$items = parent::getById($id);
		if(isset($items[0])){
			$this->setAllData($items[0]);
			$this->buzones = $items;
		}
    }

    public function getAllBy($column, $value){
		$items = parent::getBy($column, $value);
		$r = array();
		foreach($items as $child) {
			$r[] = $child;
		}
		return $r;
    }
	
	public function setFolder($folder='INBOX'){
		foreach($this->carpetas as $a){
			if($a == "{{$this->inbox->host}:{$this->inbox->port}}{$folder}") {
				$this->inboxSelected = "{{$this->inbox->host}:{$this->inbox->port}}{$folder}";
				# $messages = imap_list($mbox, "{mail.monteverdeltda.com:143}", "INBOX");
				$this->reConnect();
				#$this->messages = (imap_search($this->mbox, "ALL", SE_UID, "UTF-8"));
				$this->messages = (imap_search($this->mbox, "ALL", SE_UID, "UTF-8"));
				
				$this->total_messages = count($this->messages);
			}
		}
	}
	
	public function setBuzon($buzonSelected){
		if(isset($this->buzones[$buzonSelected]) && isset($this->buzones[$buzonSelected]->mail)){
			$this->buzonSelected = $this->buzones[$buzonSelected]->mail;
			
		} else if(isset($this->buzones[$buzonSelected]) && isset($this->buzones[$buzonSelected]->host)){
			$this->buzonSelected = $this->buzones[$buzonSelected]->id;
			
		} else {
			echo "Parametrizar setBuzon:: ";
			exit();
		}
		
		$this->inbox = new Emails($this->adapter);
		$this->inbox->getById($this->buzonSelected);
		$this->mbox = imap_open("{{$this->inbox->host}:{$this->inbox->port}}", $this->inbox->user, $this->inbox->pass);			
		$this->carpetas = imap_list($this->mbox, "{{$this->inbox->host}:{$this->inbox->port}}", "INBOX");
		$this->total_messages = imap_num_msg($this->mbox);
		$this->setFolder();
	}
	
	public function upperListEncode() {
		//convert mb_list_encodings() to uppercase
		$encodes=mb_list_encodings();
		foreach ($encodes as $encode) $tencode[]=strtoupper($encode);
		return $tencode;
    }
	
	function decodeVal($string) {
		$tabChaine=imap_mime_header_decode($string);
		$texte='';
		for ($i=0; $i<count($tabChaine); $i++) {
			switch (strtoupper($tabChaine[$i]->charset)) { //convert charset to uppercase
				case 'UTF-8': $texte.= $tabChaine[$i]->text; //utf8 is ok
					break;
				case 'DEFAULT': $texte.= $tabChaine[$i]->text; //no convert
					break;
				default: if (in_array(strtoupper($tabChaine[$i]->charset),$this->upperListEncode())) //found in mb_list_encodings()
							{$texte.= mb_convert_encoding($tabChaine[$i]->text,'UTF-8',$tabChaine[$i]->charset);}
						 else { //try to convert with iconv()
							  $ret = iconv($tabChaine[$i]->charset, "UTF-8", $tabChaine[$i]->text);    
							  if (!$ret) $texte.=$tabChaine[$i]->text;  //an error occurs (unknown charset) 
							  else $texte.=$ret;
							}                    
					break;
				}
		}
			
		return $texte;    
	}
	
	public function convertKeyValuesIMAP($item){
		$new = new stdClass();
		foreach($item as $key=>$value){
			$new->{$key} = "";
			if (!is_array($value) && !is_object($value)) {
				$new->{$key} = $this->decodeVal($value);
			}else{
				$new->{$key} = $this->convertKeyValuesIMAP($value);
			}
		}
		return $new;
	}
	
	public function getMessages($limit=null){
		$this->Messages = array();
		$total = ($limit == null) ? ($this->total_messages > 10) ? 25 : $this->total_messages : ($limit == '*') ? $this->total_messages : $limit;
		for ($i = 0; $i <= ($total-1); $i++) {
			if(isset($this->messages[$i])){
				$msg_id = $this->messages[$i];
				$imap_headerinfo = @imap_headerinfo($this->mbox, $msg_id, FT_UID);
				if($imap_headerinfo != false){
					$item = $this->convertKeyValuesIMAP($imap_headerinfo);
					$mUid = @imap_uid($this->mbox, $msg_id);
					$msg = @htmlspecialchars(quoted_printable_decode(imap_fetchbody($this->mbox,$msg_id,1.1)));
					$mime = @imap_mime_header_decode($msg); // sin utilizar
					
					$item->msg_id = $msg_id; // ID mensaje IMAP
					$item->mUid = $mUid; // ID mensaje IMAP
					$item->bUid = $this->inbox->id; // ID mensaje IMAP
					$item->headerinfo = $imap_headerinfo; // Header info mensaje
					$item->info = $imap_headerinfo; // Info mensaje reparada
					$item->msg = $msg; // Messages Simple
					$this->Messages[] = $item;
				}
			};
		}
		return $this->Messages;
	}

	public function getMessage($msg_id=0){
		$imap_headerinfo = @imap_headerinfo($this->mbox, $msg_id, FT_UID);
		if($imap_headerinfo != false){
			$item = $this->convertKeyValuesIMAP($imap_headerinfo);
			$mUid = imap_uid($this->mbox, $msg_id);
			$msg = htmlspecialchars(quoted_printable_decode(imap_fetchbody($this->mbox,$msg_id,1.1)));
			$mime = imap_mime_header_decode($msg); // sin utilizar
			
			$item->msg_id = $msg_id; // ID mensaje IMAP
			$item->mUid = $mUid; // ID mensaje IMAP
			$item->bUid = $this->inbox->id; // ID mensaje IMAP
			$item->headerinfo = $imap_headerinfo; // Header info mensaje
			$item->info = $imap_headerinfo; // Info mensaje reparada
			$item->msg = $msg; // Messages Simple
			$item->html = ($this->getHTML($this->mbox,$msg_id)); // Body info mensaje
			
			return $item;
		}
	}

	function getmsg($mbox,$msg_id) {
		$r = array();
		// HEADER
		$h = imap_header($mbox,$msg_id);
		// add code here to get date, from, to, cc, subject...

		// BODY
		$s = imap_fetchstructure($mbox,$msg_id);
		if (!isset($s->parts))  // simple
			$r[] = $this->getpart($mbox,$msg_id,$s,0);  // pass 0 as part-number
		else {  // multipart: cycle through each part
			foreach ($s->parts as $partno0=>$p){
				$r[] = $this->getpart($mbox,$msg_id,$p,$partno0+1);
			}
		}
		return $r;
	}
	
	function getHTML($mbox,$msg_id) {
		$r = array();
		$h = imap_header($mbox,$msg_id);
		$s = imap_fetchstructure($mbox,$msg_id);
		if (!isset($s->parts))
			$r[] = $this->getpartHTML($mbox,$msg_id,$s,0);
		else {
			foreach ($s->parts as $partno0=>$p){
				$r[] = $this->getpartHTML($mbox,$msg_id,$p,$partno0+1);
			}
		}
		return $r;
	}
	
	function getpartHTML($mbox,$mid,$p,$partno=null) {
		$htmlmsg = '';
		$plainmsg = '';
		$charset = 'UTF-8';
		$data = (isset($partno) && $partno != null) ? imap_fetchbody($mbox,$mid,$partno) : imap_body($mbox,$mid);
		if (isset($p->encoding) && $p->encoding==4)
			$data = quoted_printable_decode($data);
		elseif (isset($p->encoding) && $p->encoding==3)
			//$data = imap_base64($data);
			$data = base64_decode($data);
		$params = array();
		if (isset($p->parameters))
			foreach ($p->parameters as $x)
				$params[strtolower($x->attribute)] = $x->value;
		if (isset($p->dparameters))
			foreach ($p->dparameters as $x)
				$params[strtolower($x->attribute)] = $x->value;
				
		// ATTACHMENT
		if (isset($params['filename']) || isset($params['name'])) {
			// filename may be given as 'Filename' or 'Name' or both
			$filename = (isset($params['filename']))? $params['filename'] : $params['name'];
			
			$htmlmsg .= "Archivo adjunto {$filename} \n\n";
			#$file = tmpfile();
			#$path = stream_get_meta_data($file)['uri']; // eg: /tmp/phpFx0513a
			//$htmlmsg .= "Archivo adjunto URL: {$path} \n\n";
			
			
			// print_r(imap_mime_header_decode(base64_encode()));mime_content_type 
			
			// filename may be encoded, so see imap_mime_header_decode()
			//$r->attachments[$filename] = $data;  // this is a problem if two files have same name
		}
		
		// TEXT
		if ($p->type == 0 && $data) {
			// Messages may be split in different parts because of inline attachments,
			// so append parts together with blank row.
			if (strtolower($p->subtype)=='plain')
				$plainmsg .= trim($data) ."\n\n";
			else
				$htmlmsg .= ($data) ."<br><br>";
			$charset = $params['charset'];  // assume all parts are same charset
		}

		// EMBEDDED MESSAGE
		elseif ($p->type==2 && $data) {
			$plainmsg .= $data."\n\n";
		}
		
		// SUBPART RECURSION
		if (isset($p->parts)) {
			foreach ($p->parts as $partno0=>$p2)
				$htmlmsg .= $this->getpartHTML($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
		}
		

		// $htmlmsg = (utf8_decode(quoted_printable_decode($htmlmsg)));
		$htmlmsg = (imapString($htmlmsg));
		#$htmlmsg = htmlspecialchars(utf8_encode($htmlmsg));
		return $htmlmsg;
	}
	
	function getpartL($mbox,$mid,$p,$partno=null) {
		$htmlmsg = '-';
		$data = (isset($partno) && $partno != null) ? imap_fetchbody($mbox,$mid,$partno) : imap_body($mbox,$mid);
		if (isset($p->encoding) && $p->encoding==4)
			$data = quoted_printable_decode($data);
		elseif (isset($p->encoding) && $p->encoding==3)
			$data = base64_decode($data);
		$params = array();
		if (isset($p->parameters))
			foreach ($p->parameters as $x)
				$params[strtolower($x->attribute)] = $x->value;
		if (isset($p->dparameters))
			foreach ($p->dparameters as $x)
				$params[strtolower($x->attribute)] = $x->value;

		// ATTACHMENT
		if (isset($params['filename']) || isset($params['name'])) {
			// filename may be given as 'Filename' or 'Name' or both
			$filename = (isset($params['filename']))? $params['filename'] : $params['name'];
			// filename may be encoded, so see imap_mime_header_decode()
			$r->attachments[$filename] = $data;  // this is a problem if two files have same name
		}

		// TEXT
		if ($p->type == 0 && $data) {
			// Messages may be split in different parts because of inline attachments,
			// so append parts together with blank row.
			if (strtolower($p->subtype)=='plain')
				$r->plainmsg .= trim($data) ."\n\n";
			else
				$htmlmsg .= $data ."<br><br>";
			$r->charset = $params['charset'];  // assume all parts are same charset
		}

		// EMBEDDED MESSAGE
		elseif ($p->type==2 && $data) {
			$r->plainmsg .= $data."\n\n";
		}

		// SUBPART RECURSION
		if (isset($p->parts)) {
			foreach ($p->parts as $partno0=>$p2)
				$this->getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
		}
		
		$htmlmsg = htmlspecialchars(utf8_encode($r->htmlmsg));
		return $htmlmsg;
	}
	
	function getpart($mbox,$mid,$p,$partno=null) {
		$r = new stdClass();
		$r->htmlmsg = $r->plainmsg = $r->charset = '-';
		$r->attachments = array();
		
		// $partno = '1', '2', '2.1', '2.1.3', etc for multipart, 0 if simple
		// DECODE DATA
		$data = (isset($partno) && $partno != null) ? imap_fetchbody($mbox,$mid,$partno) : imap_body($mbox,$mid);  // simple -  // multipart
		// Any part may be encoded, even plain text messages, so check everything.
		if (isset($p->encoding) && $p->encoding==4)
			$data = quoted_printable_decode($data);
		elseif (isset($p->encoding) && $p->encoding==3)
			$data = base64_decode($data);

		// PARAMETERS
		// get all parameters, like charset, filenames of attachments, etc.
		$params = array();
		if (isset($p->parameters))
			foreach ($p->parameters as $x)
				$params[strtolower($x->attribute)] = $x->value;
		if (isset($p->dparameters))
			foreach ($p->dparameters as $x)
				$params[strtolower($x->attribute)] = $x->value;

		// ATTACHMENT
		// Any part with a filename is an attachment,
		// so an attached text file (type 0) is not mistaken as the message.
		if (isset($params['filename']) || isset($params['name'])) {
			// filename may be given as 'Filename' or 'Name' or both
			$filename = (isset($params['filename']))? $params['filename'] : $params['name'];
			// filename may be encoded, so see imap_mime_header_decode()
			$r->attachments[$filename] = $data;  // this is a problem if two files have same name
		}

		// TEXT
		if ($p->type == 0 && $data) {
			// Messages may be split in different parts because of inline attachments,
			// so append parts together with blank row.
			if (strtolower($p->subtype)=='plain')
				$r->plainmsg .= trim($data) ."\n\n";
			else
				$r->htmlmsg .= $data ."<br><br>";
			$r->charset = $params['charset'];  // assume all parts are same charset
		}

		// EMBEDDED MESSAGE
		// Many bounce notifications embed the original message as type 2,
		// but AOL uses type 1 (multipart), which is not handled here.
		// There are no PHP functions to parse embedded messages,
		// so this just appends the raw source to the main message.
		elseif ($p->type==2 && $data) {
			$r->plainmsg .= $data."\n\n";
		}

		// SUBPART RECURSION
		if (isset($p->parts)) {
			foreach ($p->parts as $partno0=>$p2)
				$this->getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
		}
		
		$r->htmlmsg = htmlspecialchars(utf8_encode($r->htmlmsg));
		return $r;
	}
}

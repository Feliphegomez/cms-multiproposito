<?php 
class TemplateBase {
	public $folder;
	public $head;
	public $scripts;
	public $footer;
	public $ccr;
	private $baseCode;
	public $session;
	private $thisClassName;
	
	public function __construct(){
		$this->folder = folder_content . "/themes/" . TEMA_DEFECTO;
		$this->urlNav = "/crm-content/themes/" . TEMA_DEFECTO;
		$this->baseCode = $this->getBaseCode();
		$this->ccr = $this->getCopyright();
		
		$user = ControladorBase::validateSession();
		if(isset($user['user']) && is_array($user['user'])){ $this->session = $user['user']; }else{ $this->session = null; }
		$this->thisClassName = $this->getClassName();	
	}
	
	public function getCodeBase(){
		return $this->baseCode;
	}
	
	public function includeFile($urlFileInThemeFolder){
		if(!file_exists($this->folder . $urlFileInThemeFolder)){
			return false;
		}else{
			require_once("{$this->folder}{$urlFileInThemeFolder}");
		}
	}
	
	public function getClassName(){
		return $thisClassName = str_replace(array(
			"controller",
			"Controller",
		), array(
			"",
			"",
		), get_class($this));
	}
	
	public function loadDataFile($urlFileInThemeFolder){
		if(!file_exists($this->folder . $urlFileInThemeFolder)){
			return false;
		}else{
			return (@file_get_contents($this->folder . $urlFileInThemeFolder));
		}
	}
	
	public function loadDataJsonFile($urlFileInThemeFolder){
		if(file_exists($this->folder . $urlFileInThemeFolder)){
			if(json_decode(@file_get_contents($this->folder . $urlFileInThemeFolder))){
				return json_decode(@file_get_contents($this->folder . $urlFileInThemeFolder));
			}else{
				return (@file_get_contents($this->folder . $urlFileInThemeFolder));
			}
		}else{
			return false;
		}
	}
	
	public function getHead(){
		$this->includeFile('/global/head.php');
		#return $this->loadDataFile('/global/head.php');
	}
	
	public function getFooter(){
		$this->includeFile('/global/footer.php');
	}
	
	public function getScripts(){
		$this->includeFile('/global/scripts.php');
		#return $this->loadDataFile('/global/scripts.php');
	}
	
	public function getBaseCode(){
		return ($this->loadDataJsonFile('/global/base.json'));
	}
	
	public function getCopyright(){
		return base64_decode("RGVzYXJyb2xsYWRvciBwb3IgRmVsaXBoZUdvbWV6");
	}
	
	public function getTemplate(){
		return ($this);
	}
	
	public function getBody() : string {
		return "";
	}
	
	public function getMenuTop(){
		$this->includeFile('/global/menus/top.php');
	}
	
	public function getMenuLeft(){
		$this->includeFile('/global/menus/left.php');
	}
	
	public function treeCode(){
		return $this->templateToCode($this->baseCode);
	}
	
	function templateToCodeTree($codeTemplate){
		$html = '';
		if(is_array($codeTemplate)){
			foreach($codeTemplate as $i => $prms){
				if(isset($prms->name)){
					$clss = (isset($prms->class)) ? $prms->class : '';
					
						if(isset($prms->tag)){ $html .= "< {$prms->tag} class=\"{$clss}\" > <br>"; }
							$html .= str_repeat(' - ', $i)."< !-- // ↑ Inicio {$prms->name} -- > <br>";
					
							if(isset($prms->function)){
								$html .= str_repeat(" - ", $i)."function => {$prms->function}::Result - ";
								if(method_exists($this, $prms->function)){
									$html .= "encontrada.";
									$html .= str_repeat("	", $i).$this->{$prms->function}();
								}else{
									$html .= "NO encontrada.";
								}
								
								$html .= "<br>";
							}
					
					
							if(isset($prms->includes) && is_array($prms->includes)){
								$html .= $this->templateToCode($prms->includes);
							}
							
					$html .= str_repeat(" - ", $i)."< !-- // ↓ Fin {$prms->name} -- > <br>";
						if(isset($prms->tag)){ $html .= "< / {$prms->tag} >"; }
					$html .= "<br>";
				}
			}
		}
		return $html;
	}
	
    public function linkUrl($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        return ("index.php?controller=".$controlador."&action=".$accion);
    }
	
	/* Mas optiones y function para acceder desde los componentes del tema */
	public function userActive(){
		return ControladorBase::isUser();
	}
	
	public function getUserId() : int {
		if($this->userActive() === true){
			return (isset($this->session['id']) && $this->session['id'] != null) ? $this->session['id'] : 0;
		}else{
			return 0;
		}		
	}
	
	public function getUserUsername() : string {
		if($this->userActive() === true){
			return (isset($this->session['id']) && $this->session['username'] != null) ? $this->session['username'] : '';
		}else{
			return "";
		}		
	}
	
	public function getUserNames() : string {
		if($this->userActive() === true){
			return (isset($this->session['id']) && $this->session['names'] != null) ? $this->session['names'] : $this->getUserUsername();
		}else{
			return "";
		}		
	}
	
	public function getUserSurname() : string {
		if($this->userActive() === true){
			return (isset($this->session['id']) && $this->session['surname'] != null) ? $this->session['surname'] : '';
		}else{
			return "";
		}		
	}
	
	public static function getModules() : array {
		$Mydir = folder_content . '/modules/';
		$dirs = array();
		foreach(glob($Mydir.'*', GLOB_ONLYDIR) as $dir) {
			$dir = str_replace($Mydir, '', $dir);
			$dirs[] = $dir;
		}
		return $dirs;
	}
}
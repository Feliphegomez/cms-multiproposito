<?php 


class MenuBase {
	public $datos;
	public $user;
	
	public $data;
	public $allmodules;
	
	public function __construct($column=null, $value=null, $enable_tree=false){
		$this->user = (isset($_SESSION['user'])) ? $_SESSION['user'] : array();
		$this->datos = array();
		if($value != null && $column != null){
			$this->loadMenu($column, $value);
		}
		$this->loadChilds($enable_tree);
	}
	
	public function loadMenu($column, $value){
		$this->datos = new Menu();
		$this->datos->getBy($column, $value);
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
     
    public function linkUrl($controlador=CONTROLADOR_DEFECTO, $accion=ACCION_DEFECTO, $params=null){
		$urlParams = ControladorBase::returnParamsUrl($params);
        return ("index.php?controller={$controlador}&action={$accion}&{$urlParams}");
    }
 
    public function loadChilds($enable_tree=false){
		if($this->datos->total_childs > 0){
			$items = new MenuElements();
			
			if($enable_tree == true){
				$childs = $items->getAllBy('menu', $this->datos->id);
				foreach($childs as $child){
					if($child->parent == 0){
						$tree = new MenuElements();
						$child->childs = $tree->getAllBy('parent', $child->id);
						
						$this->datos->childs[] = $child;
					}
				}
			}else{
				$this->datos->childs = $items->getAllBy('menu', $this->datos->id);
			}
		}
	}
	
	public function toUL(){
		$r = "<div class=\"menu_section\">";
			$r .= "<h3>{$this->datos->name}</h3>";
			$r .= "<ul class=\"nav side-menu\">";
				foreach($this->datos->childs as $item_menu){
					$r .= "<li>";
						$r .= $this->createItemHtmlLink($item_menu);
						$r .= (isset($item_menu->childs) && count($item_menu->childs) > 0) ? $this->createChildMenu($item_menu->childs) : '';
					$r .= "</li>";
				}
			$r .= "</ul>";
		$r .= "</div>";
		return $r;
	}
	
	public function createChildMenu($childs){
		$r = "<ul class=\"nav child_menu\">";
		foreach($childs as $child){
			$r .= "<li>";
				$r .= $this->createItemHtmlLink($child);
				$r .= (isset($childs->childs) && count($childs->childs) > 0) ? $this->createChildMenu($childs->childs) : '';
			$r .= "</li>";
		}
		# if($showNoActives === true){ $r .= "<li><a href=\"#\">{$moduloIcon}{$infoThisModule->name} <span class=\"label label-success pull-right\">Inactivo</span></a></li>\n"; }
		$r .= "</ul>";
		return $r;
	}
	
	public function createItemHtmlLink($item_menu){
		$item_menu->tag_id = (isset($item_menu->tag_id) && $item_menu->tag_id != null && $item_menu->tag_id != "") ? $item_menu->tag_id : generateRandomString();
		$item_menu->tag_class = (isset($item_menu->tag_class) && $item_menu->tag_class != null && $item_menu->tag_class != "") ? " class=\"{$item_menu->tag_class}\" " : ' ';
		$item_menu->tag_href = (isset($item_menu->tag_href) && $item_menu->tag_href != null && $item_menu->tag_href != "") ? $item_menu->tag_href : '#';
		$item_menu->icon = (isset($item_menu->icon) && $item_menu->icon != null && $item_menu->icon != "") ? " <i class=\"{$item_menu->icon}\"></i> " : '';
		$item_menu->title = 
			(isset($item_menu->childs) && count($item_menu->childs) > 0) 
				? " {$item_menu->title} <span class=\"fa fa-chevron-down\"></span> " 
				: " {$item_menu->title} ";
		/*
		$item_menu->title = 
			(isset($item_menu->childs) && count($item_menu->childs) > 0) 
				? " {$item_menu->title} <span class=\"label label-success pull-right\">Mas</span> <span class=\"fa fa-chevron-down\"></span> " 
				: " {$item_menu->title} <span class=\"label label-success pull-right\">Principal</span> ";
			*/
				
			$r = "<a id=\"{$item_menu->tag_id}\" href=\"{$item_menu->tag_href}\">{$item_menu->icon} {$item_menu->title} </a>";
			$r = "<a id=\"{$item_menu->tag_id}\" href=\"{$item_menu->tag_href}\">{$item_menu->icon} {$item_menu->title} </a>";
			#$r = "<a href=\"#\"{$item_menu->tag_class}>{$item_menu->icon}{$item_menu->title}</a>";
		return $r;
	}
}

<?php
class Controller{
	protected $recentHouses=[];
	protected $cur_path='view/';
	protected $page_css=[];
	protected $page_html=[];
	protected $page_content=[];
	protected $page_js=[];
	private $models;
	public function __construct(){
	}
	public function redirect($page='app_main'){
		$this->cur_path='view/';
		$this->page_css=[];
		$this->page_html=[];
		$this->page_js=[];

		if($page==='login'||!isset($_SESSION['userId'])||$_SESSION['userId']==''){
			$this->cur_path.='app/';
			$this->getFiles($this->cur_path.'login/');
		}
		elseif(substr($page,0,3)==='app'){
			$this->cur_path.='app/';

			$this->page_css[]=$this->cur_path.'utils/appBasic.css';
			$this->getFiles($this->cur_path.'utils/background/');
			$this->getFiles($this->cur_path.'utils/leftBar/');
			$this->getFiles($this->cur_path.'utils/upperBar/');
			$this->getFiles($this->cur_path.'utils/mask/');
			
			if($page==="app_main"){
				//load recent house
				$recentHouses=[];
				$this->getFiles($this->cur_path.'main/',1);
			}
		}
		require realpath('view/structure.php');
	}
	public function load($path){
		$content_html=[];
		$content_css=[];
		$content_js=[];
		$this->importFolder($path,$html,$css,$js);
		foreach($content_css as $css){
			echo "<link rel='stylesheet' type='text/css' href='$css'>\n";
		}
		foreach($content_html as $html){
			include "$html";
		}
		foreach($content_js as $js){
			echo "<script src='$js'></script>\n";
		}
	}
	private function getFiles($path,$isContent=0){
		$html=[];
		$css=[];
		$js=[];
		$this->importFolder($path,$html,$css,$js);
		if($isContent==0) $this->page_html=array_merge($this->page_html,$html);
		else $this->page_content=array_merge($this->page_content,$html);
		$this->page_css =array_merge($this->page_css,$css);
		$this->page_js  =array_merge($this->page_js,$js);
	}
	private function importFolder($path,&$html,&$css,&$js){
		$html=array_merge($html,glob("$path{*.html,*.php}", GLOB_BRACE));
		$css =array_merge($css ,glob("$path{*.css}", GLOB_BRACE));
		$js  =array_merge($js  ,glob("$path{*.js}", GLOB_BRACE));

		$dirs = glob($path.'/*', GLOB_ONLYDIR);
		if (count($dirs) > 0) {
			foreach ($dirs as $dir) importFolder($path.$dir.'/',$html,$css,$js);
		}
	}
}

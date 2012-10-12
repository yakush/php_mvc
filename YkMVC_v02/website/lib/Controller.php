<?php

class Controller extends Object {

	private $viewSections=array();
	private $currentSection=NULL;

	/////////////////////////////////////////
	//to be used in controller:
	public function redirect($to){
		header("Location: ".$to);
		//exit();
	}

	public function renderJSON($obj){
		echo json_encode($obj);
	}

	public function renderView($name=NULL,$layout='default'){

		//view:
		$viewPath='';
		if ($name==NULL){
			//no view name - set path to : views/<controller>/<action_name>View.php
			$viewPath = VIEWS_PATH . lcfirst(Router::$controller) . '/' . lcfirst(Router::$action) .'View.php';
		}elseif (preg_match('@/@', $name)){
			//name is a full-path view - set path to: views/<name>View.php
			$viewPath = VIEWS_PATH . lcfirst($name) .'View.php';
		}
		else{
			//name is a relative-path view - set path to: views/<base_name>/<name>View.php
			$viewPath = VIEWS_PATH . lcfirst(Router::$controller) . '/' . lcfirst($name) .'View.php';

		}

		if( file_exists($viewPath) ){
			ob_start();
			include $viewPath;
			$viewContents = ob_get_contents();
			ob_end_clean();
			$this->viewSections['main'] =$viewContents;
				
			if ($this->currentSection){
				//unfinished sections found:
				throw new Exception('unfinished section ('.$this->currentSection.') found at $viewPath. use $this->endSection() to end a section.');
			}
		}else{
			throw new Exception('The view file ' . $viewPath . ' could not be found');
		}

		//layout:
		if ($layout){
			$layoutPath = LAYOUTS_PATH . $layout . '.php';
			if( file_exists($layoutPath) ){
				include $layoutPath;
			}else{
				throw new Exception('The layout ' . $layoutPath . ' could not be found');
			}
		}else{
			// no layout - just render the main section.
			$this->renderSection();
		}

	}

	/////////////////////////////////////////
	//to be used in layout:
	public function renderSection($name=NULL){
		$name=$name?$name:'main';

		if (isset($this->viewSections[$name])){
			echo($this->viewSections[$name]);
		}else{
			//throw new Exception('The view section ' . $name . ' could not be found');
		}
	}

	/////////////////////////////////////////
	//to be used in view
	public function startSection($name){
		if ($this->currentSection){
			throw new Exception('cannot nest view sections! currently in '.$this->currentSection.' section, tried to start ' . $name . 'section.');
			return;
		}
		$this->currentSection = $name;
		//start buffering:
		ob_start();
	}

	public function endSection(){
		if (!$this->currentSection){
			throw new Exception('tried to end a view section without starting it...  ');
		}

		$contents = ob_get_contents();
		ob_end_clean();
		$this->viewSections[$this->currentSection]=$contents;
		$this->currentSection = NULL;
	}

	public function renderPartial($name, $model=NULL){
		$partialPath = PARTIALS_PATH . lcfirst($name) . 'View.php';
		if( file_exists($partialPath) ){
			include $partialPath;
		}else{
			throw new Exception('The partial ' . $partialPath . ' could not be found');
		}
	}


}
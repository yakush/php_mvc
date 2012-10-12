<?php
class ErrorController extends Controller{
	
	public function notFound(){
		//test redirect
		//$this->redirect('http://www.google.com');
		
		//test render view:
		$this->renderView();
		//$this->renderView(NULL,'alt_01'); //default controller/actionView || alt_01 layout 
		//$this->renderView(NULL,NULL); //default controller/actionView || no layout
		//$this->renderView('another'); // relative: controller/<user_defined>View
		//$this->renderView('shared/someOther'); // absolute: <user_defined_path>/<user_defined_view>View
		
		//test json
		//$this->renderJSON(array('a'=>123,'b'=>'bbb','inner'=>array('aa'=>1,'bb'=>2)));
		
	}
	
}
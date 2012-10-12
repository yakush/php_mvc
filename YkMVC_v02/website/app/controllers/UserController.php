<?php
class UserController extends Controller{
	
	public function details(){
		//test redirect
		//$this->redirect('http://www.google.com');
		
		//test render view:
		//$this->renderView();
		//$this->renderView(NULL,'alt_01'); //default controller/actionView || alt_01 layout 
		//$this->renderView(NULL,NULL); //default controller/actionView || no layout
		//$this->renderView('another'); // relative: controller/<user_defined>View
		//$this->renderView('shared/someOther'); // absolute: <user_defined_path>/<user_defined_view>View
		
		//test json
		$user_name = isset ($_GET['user_name']) ? $_GET['user_name']:"unknown";
		$user_id =  isset ($_GET['user_id']) ? $_GET['user_id']:"unknown";
		$this->renderJSON(array('user_name'=>$user_name,'user_id'=>$user_id,'inner'=>array('aa'=>1,'bb'=>2)));
		
	}
	
}
<?php

class Router extends Object {
	public static $route_found = false;
	public static $path = null;
	public static $controller='';
	public static $action = '';
	
	private static $notFoundController=null;
	private static $notFoundAction=null;
	
	public $method = '';
	public $uri = '';
	
	

	public function __construct(){
		$this->uri = $this->getUri();
		//$this->segments = explode('/', trim($this->uri, '/'));
		$this->method = $this->getMethod();
	}

	public static function instance() {
		static $instance = null;

		if( $instance === null ) {
			$instance = new Router;
		}

		return $instance;
	}
 
	protected function getMethod() {
		return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
	}

	protected function getUri($prefix_slash = false) {
		if( isset($_SERVER['PATH_INFO']) ) {
			$uri = $_SERVER['PATH_INFO'];
		}elseif( isset($_SERVER['REQUEST_URI']) ) {
			$uri = $_SERVER['REQUEST_URI'];

			if( strpos($uri, $_SERVER['SCRIPT_NAME']) === 0 ) {
				$uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}elseif( strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0 ) {
				$uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}

			// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
			// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
			if( strncmp($uri, '?/', 2) === 0 ) {
				$uri = substr($uri, 2);
			}

			$parts = preg_split('#\?#i', $uri, 2);
			$uri = $parts[0];

			if( isset($parts[1]) ) {
				$_SERVER['QUERY_STRING'] = $parts[1];
				parse_str($_SERVER['QUERY_STRING'], $_GET);
			}else {
				$_SERVER['QUERY_STRING'] = '';
				$_GET = array();
			}
			$uri = parse_url($uri, PHP_URL_PATH);
		}else {
			// Couldn't determine the URI, so just return false
			return false;
		}

		// Do some final cleaning of the URI and return it
		return ($prefix_slash ? '/' : '').str_replace(array('//', '../'), '/', trim($uri, '/'));
	}
	
	public static function setNotFoundAction($controller,$action){
		//$router = static::instance();
		$router = self::instance();
		self::$notFoundController=$controller;
		self::$notFoundAction=$action;
	}

	// map a route
	public static function map($route,$controller,$action,$defaults=null,$constraints=null,$requireMethod=null) {
		//$router = static::instance();
		$router = self::instance();
		
		$origRoute=$route;

		//check allready found:
		//if (static::$route_found){
		if (self::$route_found){
			return false;
		}

		//check method:
		if ($requireMethod!=null && $requireMethod!=$router->method){
			return false;
		}

		//inject the constraints to $route:
		if ($constraints){
			foreach ($constraints as $key=>$value){
				$route = preg_replace('@{'.$key.'}@', $value, $route);
			}
		}
		
		//inject other (non-constarinted) route to $route '{something}' -> '[\w\.]+':
		$route = preg_replace('@{[a-zA-Z0-9_]+}@', '\\w+', $route);
		
		//check route:
		//if (!preg_match('@^'.$route.'(?:\.(\w+))?$@uD', $uri , $matches))  {
		if (!preg_match('@^'.$route.'$@uD', $router->uri , $matches)) {
			return false;
		}

		// ----------------------
		// OK - all matched:
		//static::$route_found = true;
		self::$route_found = true;

		//replace route-vars ( '{varName}' )  in the route with the actual uri values and put into $_GET:
		$routeParts = preg_split('@/@', $origRoute); //split route to parts (by '/')
		$uriParts = preg_split('@/@', $router->uri); //split uri to parts (by '/')
		
		for ($i=0; $i<sizeof($routeParts);$i++){
			$routePart=$routeParts[$i];
			if (preg_match('@{[a-zA-Z0-9_]+}@', $routePart)){
				$key = trim($routePart,'{}');
				$_GET[$key]= isset($_GET[$key]) ? $_GET[$key] : $uriParts[$i];
			}
		}
		
		//add defaults to $_GET:
		if ($defaults){
			foreach ($defaults as $key => $value){
				$_GET[$key]= isset($_GET[$key]) ? $_GET[$key] : $value;
			}
		}

		//fire the controller
		$router->dispatch($controller,$action);
		return true;
	}

	public static function checkAndFirteNotFound(){
		//$router = static::instance();
		$router = self::instance();
		if (self::$notFoundController!=null && self::$notFoundAction!=null && !self::$route_found){
			$router->dispatch(self::$notFoundController,self::$notFoundAction);
		}
	}
	
	function dispatch($controller,$action){
		/*
		///debug
		echo ('method: '.$this->method .'<br/>');
		echo ('uri: '.$this->uri.'<br/>');
		echo ('<br/>');
		
		echo ('controller: ' . $controller . '<br/>');
		echo ('action: ' . $action . '<br/>');
		echo ('<br/>');
		
		echo ('_GET: ');
		var_dump($_GET);
		*/
		
		///
		$router = self::instance();
		
		//static::$controller=$controller;
		//static::$action=$action;
		//static::loadController($controller);
		self::$controller=$controller;
		self::$action=$action;
		self::loadController($controller);
		
		//echo 'controller: ' . self::$controller . '<br>';
		//echo 'action: ' . self::$action . '<br>';
		
		
		$controllerClassName = ucfirst($controller) . 'Controller';
		if( class_exists($controllerClassName) ) {
			$controllerClass= new $controllerClassName();
			// run the matching action
			if( is_callable(array($controllerClass, $action)) ) {
				$controllerClass->$action();
			}else
				throw new Exception('The action <strong>' . $action . '</strong> could not be called from the controller <strong>' . $controllerClassName . '</strong>');
			
		}else{	
			throw new Exception('The class <strong>' . $controllerClassName . '</strong> could not be found in <pre>' . CONTOLLERS_PATH . $controllerClassName . '.php</pre>');
		}
		

	}

	public static function loadController($name) {
		$controller_path = CONTOLLERS_PATH . ucfirst($name) . 'Controller.php';
		if( file_exists($controller_path) )
			include_once $controller_path;
		else
			throw new Exception('The file <strong>' . $controller_path . '</strong> could not be found at <pre>' . CONTOLLERS_PATH . '</pre>');
	}

	/*
	 public static function resource($controller) {
	self::get('/' . $controller, $controller . '#index');
	self::get('/' . $controller . '/new', $controller . '#add');
	self::get('/' . $controller . '/edit/(.*)', $controller . '#edit');

	self::post('/' . $controller, $controller . '#create');
	self::put('/' . $controller, $controller . '#update');
	self::delete('/' . $controller, $controller . '#destroy');
	}

	public static function get($route, $path) {
	self::$path = $path;
	Sammy::process($route, 'GET');
	}

	public static function post($route, $path) {
	self::$path = $path;
	Sammy::process($route, 'POST');
	}

	public static function put($route, $path) {
	self::$path = $path;
	Sammy::process($route, 'PUT');
	}

	public static function delete($route, $path) {
	self::$path = $path;
	Sammy::process($route, 'DELETE');
	}

	public static function ajax($route, $path) {
	self::$path = $path;
	Sammy::process($route, 'XMLHttpRequest');
	}

	public static function pre_dispatch($uri) {
	$path = explode('/', $uri);
	$controller = $path[0];
	$action = (empty($path[1])) ? 'index' : $path[1];
	$format = 'html';

	if( preg_match('/\.(\w+)$/', $action, $matches) ) {
	$action = str_replace($matches[0], '', $action);
	$format = $matches[1];
	}

	self::$path = $controller . '#' . $action;
	self::dispatch($format);

	}

	public static function dispatch($format) {

	// runs when find a matching route
	$path = explode('#', self::$path);
	$controller = $path[0];
	$action = $path[1];

	$class_name = ucfirst($controller) . 'Controller';

	// include the app_controller
	self::load_controller('app');

	// include the matching route controller
	self::load_controller($controller);

	if( class_exists($class_name) ) {
	$tmp_class = new $class_name();

	// run the matching action
	if( is_callable(array($tmp_class, $action)) ) {
	$tmp_class->$action();
	}else
		die('The action <strong>' . $action . '</strong> could not be called from the controller <strong>' . $class_name . '</strong>');
	}else
		die('The class <strong>' . $class_name . '</strong> could not be found in <pre>' . APP_PATH . 'controllers/' . $controller . '_controller.php</pre>');

	self::get_user_vars($tmp_class);

	// include the view file
	// self::load_view($controller, $action, $format);

	// load the layout
	$layout_path = self::get_layout($controller, $action, $format);
	if( !empty($layout_path) ) {
	$layout = file_get_contents($layout_path);

	// replace {PAGE_CONTENT} view file
	$view_path = self::view_path($controller, $action, $format);
	if( !empty($view_path) )
		$layout = str_replace('{PAGE_CONTENT}', file_get_contents($view_path), $layout);
	else
		$layout = str_replace('{PAGE_CONTENT}', '', $layout);

	$filename = BASE_PATH . 'tmp/' . time() . '.php';

	$file = fopen($filename, 'a');
	fwrite($file, $layout);
	fclose($file);

	self::load_layout($filename);

	unlink($filename);
	}
	}
	
	public static function load_controller($name) {
		$controller_path = APP_PATH . 'controllers/' . $name . '_controller.php';
		if( file_exists($controller_path) )
			include_once $controller_path;
		else
			die('The file <strong>' . $name . '_controller.php</strong> could not be found at <pre>' . $controller_path . '</pre>');
	}

	public static function load_view($controller, $action, $format) {
		$view_path = self::view_path();
		if( !empty($view_path) ) {
			unset($controller, $action, $format);

			foreach( self::$__user_vars as $var => $value ) {
				$$var = $value;
			}

			include_once $view_path;
		}
	}

	public static function get_layout($controller, $action, $format) {
		// controller-action.format.php
		$controller_action_path = APP_PATH . 'views/layouts/' . $controller . '-' . $action . '.' . $format . '.php';

		// controller.format.php
		$controller_path = APP_PATH . 'views/layouts/' . $controller . '.' . $format . '.php';

		// application.format.php
		$application_path = APP_PATH . 'views/layouts/application.' . $format . '.php';

		$path_to_use = null;

		// find the path to use
		if( file_exists($controller_action_path) )
			$path_to_use = $controller_action_path;

		elseif( file_exists($controller_path) )
		$path_to_use = $controller_path;

		elseif( file_exists($application_path) )
		$path_to_use = $application_path;

		return $path_to_use;
	}

	public static function view_path($controller, $action, $format) {
		$view_path = APP_PATH . 'views/' . $controller . '/' . $action . '.' . $format . '.php';
		$path = null;

		if( file_exists($view_path) )
			$path = $view_path;

		return $path;
	}

	public static function load_layout($filename) {
		foreach( self::$__user_vars as $var => $value ) {
			$$var = $value;
		}

		include $filename;
	}
	*/
}
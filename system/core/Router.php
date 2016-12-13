<?php


class MR_Router
{
	public $final_path;
	private $path;
	private $route = array();
	//private $strings = 	array(':any' => '.*',':num' => '[0-9]+');

	public function __construct()
	{	
		$this->get_config_route();
		// get the path and set the default controller and creat the final path
		$this->get_path();
		$this->create_final_path();
	}

	// include route.php from application folder
	private function get_config_route ()
	{
		require_once APPPATH.'config'.DS.'route'.EXT;

		if (isset($route) && is_array($route))
		{
			$this->route = $route;
		}
	}

	// get the path from the url
	private function get_path ()
	{
		if (isset($_SERVER['PATH_INFO']))
		{
			$this->path = trim(strtolower($_SERVER['PATH_INFO']),'/');
			//$this->create_final_path();
		}
		else if (isset($this->route['default_controller']) && $this->route['default_controller'] != '')
		{
			$this->path = trim(strtolower($this->route['default_controller']),'/');
		}
		else
		{
			// show error about the default controller or the path not found
		}
	}

	// create the final path
	private function create_final_path ()
	{
		//echo $this->path.'<br>';
		$matches = array();
		$p = $this->path; // default value

		foreach ($this->route as $k => $v)
		{
			// conpare the route array with the path and create the final path
			if (preg_match("/^".$k."$/",$this->path,$matches))
			{
				//print_r($matches);
				$p = $v; // ex : p/$1/$2

				for ($i = 1; count($matches) > $i; $i++)
				{
					$p = str_replace('$'.$i,$matches[$i],$p);
				}
				break;
			}
		}

		//$p = str_replace("$3",'',$p);
		//echo $p;
		return $this->final_path = $p;
	}


	// activate the controller and methods
	public function active_route ()
	{
		// explode url page to get the controller, method, arguements
		$path = explode('/',trim(strip_tags($this->final_path),'/'));

		$controller = $path[0];
		
		// include controller file from application
		$controller_file_path = APPPATH.'controllers/'.$controller.EXT;
		
		if (file_exists($controller_file_path))
		{
			include_once $controller_file_path;
		}
		else
		{
			exit('the controller file \''.$controller.'\' not found !');
		}

		// activate the class controller
		if (!class_exists($controller))
		{
			exit('can\'t call to the \''.$controller.'\' controller');
		}
		else
		{
			$con = new $controller();
		}

		// activate the method (function)
		if (count($path) == 1)
		{
			$con->index();
		}
		else if (count($path) == 2)
		{
			$con->{$path[1]}();
		}
		else
		{
			$allParam = '';
			
			foreach ($path as $k => $param)
			{
				if ($k == 0 or $k == 1)
				{
					continue;
				}
				else
				{
					$allParam .= "'".$param."',";
				}
			}

			$allParam = trim($allParam,',');

			//eval('return $con->login(\'ok\',\'hello\');');
			@eval('return $con->{$path[1]}('.$allParam.');');
		}
	}

}

?>
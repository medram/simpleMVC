<?php

/**
* Desc: Load class and files
*
*/

class MR_Loader
{
	/**
	* All class, models, files, helpers were loaded
	*
	*/
	private static $_loaded = array();


	// include files if were exists
	private function load_file($path)
	{
		if (file_exists(BASEPATH.$path))
		{
			return include_once BASEPATH.$path;
		}
		else if (file_exists(APPPATH.$path))
		{
			return include_once APPPATH.$path;
		}
		else
		{
			// log error
			exit('ERROR : The file not found '.$path);
		}
	}

	/**
	* just activate class
	*
	* @param string $class_name : name of the class to activate it like (eg: new $class_name())
	* @param array $config : it is a data parameters will be passed to the class (eg: new 					 $class_name($config))
	*/
	private function activate_class($class_name, $config = NULL)
	{
		return empty($config)? new $class_name() : new $class_name($config);
	}


	// check if the file was includeed or not
	private function is_loaded_file($class_name, $class_type = 'libs')
	{
		if (isset(self::$_loaded[$class_type]) && in_array($class_name, self::$_loaded[$class_type]))
		{
			return true;
		}
		return false;
	}


	// load library
	public function library ($file_name, $config = array())
	{
		$file_name = strtolower($file_name);
		$path = 'libs'.DS.$file_name.EXT;
		
		if ($this->is_loaded_file($file_name))
		{
			// activate the class
			return $this->activate_class($file_name, $config);
		}
		else
		{
			// load the class
			self::$_loaded['libs'][] = $file_name;
			$this->load_file($path);
			
			// activate the class
			return $this->activate_class($file_name, $config);
		}
	}


	// load model	
	public function model ($file_name)
	{
		$ext_helper = '';
		$path = 'models'.DS.$file_name.$ext_helper.EXT;
		
		if ($this->is_loaded_file($file_name, 'models'))
		{
			// activate the class
			return $this->activate_class($file_name);
		}
		else
		{
			// load the class
			self::$_loaded['models'][] = $file_name;
			$this->load_file($path);			
			
			// activate the class
			return $this->activate_class($file_name);
		}
	}


	// load view
	public function view ($tpl, $data = array(), $return_status = false)
	{
		$path = APPPATH.'views'.DS.$tpl.EXT;
		
		if (! file_exists($path))
		{
			exit('ERROR: the file not found');
		}

		// create variables to view template
		if (is_array($data) && count($data) > 0)
		{
			foreach ($data as $k => $v)
			{
				$$k = $v;
				//return str_replace('{{'.$k.'}}',$v,$tpl);
			}
		}
		return require_once($path);
	} // end view function


	// for debug mod
	public function __destruct()
	{
		echo '<br><pre>------------ static ----------<br>';
		print_r(self::$_loaded);
		echo '</pre><br>';
	}


/*

	// load helper
	public function helper ($file_name)
	{
		$ext_helper = '_helper';
		$path = 'helpers'.DS.$file_name.$ext_helper.EXT;
			
		if (file_exists(BASEPATH.$path))
		{
			return include_once BASEPATH.$path;
		}
		else if (file_exists(APPPATH.$path))
		{
			return include_once APPPATH.$path;
		}
		else
		{
			exit('ERROR : The helper file \''.$file_name.$ext_helper.'\' not found');
		}
	}


*/

}

?>
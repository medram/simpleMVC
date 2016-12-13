<?php
/**
* Desc: principal functions here to medram (bootstrap) to work
*
*/

/**
* Desc: load class
*
* if a class not exists before, this class exists in the folder
* auto load the default classes
* activate the class 
*
*/

/**
function load_file ($file_path)
{
	if (file_exists($file_path))
	{
		return require_once $file_path;
	}
	else
	{
		// file not found
		// log_error();
	}
}

*/

// set the enviroment of the project
function set_environment ()
{
	switch (ENVIRONMENT)
	{
		case 'development':
				// show all errors
				error_reporting(-1);
				@ini_set('display_errors',1);
				@ini_set('error_reporting',E_ALL);
			break;
		case 'product':
				// hide all errors
				error_reporting(0);
				@ini_set('display_errors',0);
				@ini_set('error_reporting',0);
			break;
		default:
			// show all errors
			// E_ALL & ~E_ERROR & ~E_WARNING & ~E_NOTICE
			error_reporting(E_ALL);
	}
}

// instence function
function &instance ()
{
	return MR_Controller::get_instance();
}

// load class and activate it :D
function &load_class($class,$directory = 'libs',$param = NULL)
{
	static $classes = array();
	
	$class = strtolower($class);
	$prefix_class = 'MR_';

	if (isset($classes[$class]))
	{
		return $classes[$class];
	}
	/*
	echo '<pre>';
	print_r($classes);
	echo '</pre><br>';
	*/
	/**
	*Desc: prefix classes of libraries ond other classes
	* ex: MR_;
	*/

	// check if the file class exists and load it
	foreach (array(BASEPATH,APPPATH) as $path)
	{
		$class_file = $path.$directory.DS.$class.EXT;
		
		if (file_exists($class_file))
		{
			if (!class_exists($class))
			{
				// load the class
				require_once $class_file;
			}
		}
	}

	// auto load the default class here
	/*
	*	the code must be here
	*/


	// activate the class
	loaded_classes(array($class,$prefix_class.$class));
	$class = $prefix_class.$class;
	$classes[$class] = isset($param)? new $class($param) : new $class() ;
	return $classes[$class];

}

function loaded_classes($class = array())
{
	static $_loaded_class = array();

	if (count($class) == 2)
	{
		$_loaded_class[$class[0]] = $class[1];
	}
	else
	{
		return $_loaded_class;
	}

}

function config_item()
{

}





?>
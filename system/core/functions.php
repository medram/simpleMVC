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

if ( ! function_exists("custom_err"))
{
	//set_error_handler('custom_err');
	function custom_err ($errno,$errMsg,$errFile,$errLine)
	{
		// define('ENVIRONMENT','development');
		if (ENVIRONMENT == 'development')
		{
			echo '<br><pre>';
			echo '<b>Error type: </b>'.mapErrorCode($errno).'<br>';
			echo '<b>Error massage:</b> '.$errMsg.'<br>';
			echo '<b>File:</b> '.$errFile.'</b><br>';
			echo '<b>line:</b> '.$errLine.'<br></pre><br>';
			//die();
		}
	}



}

function mapErrorCode($code) {
    $error = $log = null;
    switch ($code) {
        case E_PARSE:
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            $log = LOG_ERR;
            break;
        case E_WARNING:
        case E_USER_WARNING:
        case E_COMPILE_WARNING:
        case E_RECOVERABLE_ERROR:
            $error = 'Warning';
            $log = LOG_WARNING;
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            $log = LOG_NOTICE;
            break;
        case E_STRICT:
            $error = 'Strict';
            $log = LOG_NOTICE;
            break;
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
            $error = 'Deprecated';
            $log = LOG_NOTICE;
            break;
        default :
            break;
    }
    return $error;
}

function log_error($msg,$kill=true)
{
	echo $msg;
	if ($kill)
	{
		die() or exit();
	}
}

function &get_config ()
{
	static $_config;
	
	if (! empty($_config) && isset($_config[0]))
	{
		return $_config[0];
	}

	//$path = BASEPATH.'core/config'.EXT;
	$path = APPPATH.'config/config'.EXT;

	// check if the config file exists
	if ( ! file_exists($path))
	{
		log_error('the config file not found on '.$path);
	}
	else
	{
		// load the config file
		require_once $path;
		
		// check if the config var exists
		if ( ! isset($config) || ! is_array($config))
		{
			log_error('the config var is not found or isn\'t an array on the folder');
		}
		else
		{
			$_config[0] = $config;
			return $_config[0];
		}
	}
}

/**
* get the config data from the config folder
* @param string $item : the item want be got it 
* @return if the item exists the function return to the value or the item else return an array of     *         config
*/
function config_item ($item = null)
{
	static $all_config = array();
	/*
	echo '<pre>';
	print_r($all_config);
	echo '</pre>';
	*/

	if (empty($all_config))
	{
		$all_config[0] =& get_config();
	}

	// check if the item exists
	if ($item != null)
	{
		return isset($all_config[0][$item])? $all_config[0][$item] : null;
	}
	else
	{
		// return config data array if the item was null
		return (array) $all_config[0];
	}
}





?>
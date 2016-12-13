<?php

class MR_Controller
{
	// Load libs, models, classes, helpers
	public $load;
	private static $get_instance;

	public function __construct ()
	{
		// load Loader class
		$this->load =& load_class('Loader','core');
		self::$get_instance =& $this;
	}

	public static function &get_instance()
	{
		return self::$get_instance;
	}



}

?>
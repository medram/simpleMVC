<?php

/**
* activate the bootstrap class (medram)
* Note: medram = Mohammed Ramouchy 
*/
new Medram();

class Medram
{

	public function __construct ()
	{
		// include pricipal files
		require_once BASEPATH.'core/constants'.EXT;
		require_once BASEPATH.'core/functions'.EXT;
		require_once BASEPATH.'core/Model.php';

		/**
		* ----------------------------------------------------
		* set a environment 
		* ----------------------------------------------------
		*/
		set_environment();

		/**
		* ----------------------------------------------------
		* set a custom error here 
		* ----------------------------------------------------
		*/
		set_error_handler('custom_err');

		/** 
		* ----------------------------------------------------
		* load classes and activate it
		* ----------------------------------------------------
		*/
		//$MR_Loader 	=& load_class('Loader','core');
		$MR_Router 	=& load_class('Router','core');
		//$MR_Model =& load_class('Model','core');

		// load MR_Controller
		$MR_Controller =& load_class('Controller','core');

		// show the page (activate the controller and methods)
		$MR_Router->active_route();
		
		// Debug
		/*
		echo '<pre>';
		print_r(loaded_classes());
		echo '</pre>';
		*/

	}



} // end class Bootstrap


?>
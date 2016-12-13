<?php

/**
* Desc: Load class and files
*
*/

class MR_Loader
{

	public function __construct()
	{
		
	}


	// load library
	public function library ($file_name)
	{
		$path = 'libs'.DS.$file_name.EXT;
			
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
			exit('ERROR : The library file \''.$file_name.'\' not found');
		}
	}

	// load model	
	public function model ($file)
	{
		$ext_helper = '_model';
		$path = 'models'.DS.$file_name.$ext_helper.EXT;
			
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
			exit('ERROR : The model file \''.$file_name.$ext_helper.'\' not found');
		}
	}

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

	// load view
	public function view ($tpl,$data=array())
	{
		$file_path = APPPATH.'views'.DS.$tpl.EXT;
		
		if (!file_exists($file_path))
		{
			echo 'the file <b>'.$tpl.EXT.'</b> Not found !';
		}
		else
		{
			if (is_array($data) && count($data) > 0)
			{
				foreach ($data as $k => $v)
				{
					$$k = $v;
					//return str_replace('{{'.$k.'}}',$v,$tpl);
				}
			}
			return include_once $file_path;			
		}
	} // end view function


}

?>
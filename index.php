<?php

/**
* Powred by: Mohammed Ramouchy
* Email: mramouchy@gmail.com
* Date: 01/11/2016
* Project name: Medram MVC
* Description: I want to create my MVC 
*/


$system_folder = 'system';
$application_folder = 'application';
$view_folder = 'views';



/**
* Options: development, product
* Desc: Show the errors or not 
*/
define('ENVIRONMENT','development');

define('BASE_URL','http://'.$_SERVER['HTTP_HOST'].'/test/mvc/');
define('DS','/');
define('EXT','.php');

define('BASEPATH',basename($system_folder).DS);
define('APPPATH',basename($application_folder).DS);

// load bootstrap file
require_once BASEPATH.'core/Medram'.EXT;


?>
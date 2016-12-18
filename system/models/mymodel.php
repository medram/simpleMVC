<?php

class mymodel extends MR_Model
{
	public $hello = 'My first model';

	public function __construct()
	{
		parent::__construct();
		echo 'this is my model';
	}
}


?>
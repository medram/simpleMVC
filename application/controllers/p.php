<?php

class P extends MR_controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index ($page)
	{
		echo '<h1>'.$page.' page</h1>';
	}
}

?>
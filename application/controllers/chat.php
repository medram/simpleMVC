<?php

class chat extends MR_controller
{
	public $data;

	public function __construct()
	{
		parent::__construct();
	}

	public function index ()
	{
		$this->data['title'] = 'chat online';
		$this->view('chat',$this->data);
	}

}

?>
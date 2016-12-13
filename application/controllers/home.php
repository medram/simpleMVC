<?php

class Home extends MR_Controller
{
	public $data;

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		$this->data['title'] = 'this is Home page';
		$this->data['username'] = 'Mohammed';
		
		//echo '<pre>';
		//var_dump($this->load);
		//echo '</pre>';
		$this->load->view('home',$this->data);
	}
}

?>
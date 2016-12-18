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

		$data['username'] = 'mohammed';
		$data['email'] = 'med@gmail.com';

		$data2['username'] = 'Nabil';
		$data2['email'] = 'nabil@gmail.com';

		
		
		$db = $this->load->library('database',$data);
		$db2 = $this->load->library('database',$data2);
		echo '<pre>';
		print_r($db);
		print_r($db2);
		echo '</pre>';
		
		$model = $this->load->model('mymodel');
		echo $model->hello;
		$model = $this->load->model('mymodel');
		echo $model->hello;
		
		//$this->session->set_userdata(array('username','email'));
		$this->load->library('session');

		$d['username'] = 'MOHAMMED';
		$this->load->view('home',$d);
	}
}

?>
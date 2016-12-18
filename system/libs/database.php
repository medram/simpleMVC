<?php

class Database
{
	public $info = 'this is info !';
	public function __construct ($data)
	{
		$this->username = $data['username'];
		echo $data['username'].' '.$data['email'].' database loaded !!';
	}
}

?>
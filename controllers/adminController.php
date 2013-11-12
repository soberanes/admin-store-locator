<?php

class adminController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->_view->titulo = "Admin";
		$this->_view->render('index');
	}
	
	function login(){
		echo "<pre>";
		var_dump($_POST);
		echo "</pre>";
	}
	


}

?>
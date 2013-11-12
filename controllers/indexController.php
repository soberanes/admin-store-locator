<?php

class indexController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->_view->titulo = "Index";
		$this->_view->render('index');
	}

	public function login(){
		$this->_view->titulo = "login";
		$this->_view->render('login');
	}

}

?>
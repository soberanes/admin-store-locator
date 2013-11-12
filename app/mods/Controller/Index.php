<?php
class Controller_Index extends Controller_Abstract{

	protected $_controller = 'index';
	
	public function indexAction(){
		
		if(!isset($_SESSION['user_id'])){
			$redirect = URL.'/login';
			header('Location: '.$redirect);
		}
		
	}
	
	


}



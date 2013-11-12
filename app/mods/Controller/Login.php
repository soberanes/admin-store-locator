<?php
class Controller_Login extends Controller_Abstract{

	protected $_controller = 'login';
	
	public function indexAction(){
		

		if(isset($_GET['login'])){
			$error = $_GET['login'];
			$this->view->error = $error;
		}
		
	}
	
	public function loginAction(){
		if( isset($_POST['usuario']) && isset($_POST['password']) ){
			
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];
			
			//DB Adapter
			$db = $this->_db;
			
			$db->setFetchMode(Zend_Db::FETCH_OBJ);
	        $sql = 'SELECT * FROM users WHERE username = "'.$usuario.'" AND password = "'.$password.'"';
	        $datos = $db->fetchAll($sql,Zend_Db::FETCH_BOTH); 
			
			$login = count($datos);
			
			
			
			if($login > 0){
				//logged
				
				foreach($datos as $user){
					$_SESSION['user_id'] = $user->id;
					$_SESSION['user_name'] = $user->name;
					$_SESSION['user_username'] = $user->username;
					$_SESSION['user_password'] = $user->password;
					$_SESSION['user_active'] = $user->active;
				}

				$redirect = URL.'/index';
				header('Location: '.$redirect);
			}else{
				//no logged yet
				$redirect = URL.'/login/index?login=failed';
				header('Location: '.$redirect);
			}
			
		}
	}
	
	public function logoutAction(){
		$_SESSION = array();
    	session_destroy();
		$redirect = URL.'/index';
		header('Location: '.$redirect);
	}
	
}
		
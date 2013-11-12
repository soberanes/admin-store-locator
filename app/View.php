<?php

class View
{
	private $_controlador;

	public function __construct(Request $peticion)
	{
		$this->_controlador = $peticion->getControlador();
	}

	public function render($vista)
	{
		$menu = array(
			array(
				'id' => 'inicio',
				'titulo' => 'Inicio',
				'enlace' => BASE_URL
			),
			array(
				'id' => 'pagina-dos',
				'titulo' => 'Página Dos',
				'enlace' => BASE_URL . 'index/segunda/'
			),
		);

		$_layoutParams = array(
			'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
			'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
			'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
			'menu' => $menu
		);
		$rutaView = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . $this->_controlador . DS . $vista . '.phtml';
		//echo $rutaView;die;
		if(is_readable($rutaView)){
			require_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			require_once $rutaView;
			require_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
		} else {
			throw new Exception('Error de vista');
		}
	}
}

?>
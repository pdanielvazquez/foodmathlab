<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->library('session');
	}

	public function index(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'',
			'usuario'	=>	'Usuario',
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
		);
		$this->load->view('Plantillas/html_open_view', $config);
		$this->load->view('Plantillas/head_view');
		$this->load->view('Plantillas/body_open_view');
		$this->load->view('Plantillas/wraper_open_view');
		$this->load->view('Plantillas/navbar_view');
		$this->load->view('Plantillas/sidebar_view');
		$this->load->view('Plantillas/content_wraper_open_view');
		$this->load->view('Plantillas/content_wraper_header_view');
		
		/*Aqui va el contenido*/
		$this->load->view('Productos/productos_view');

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Productos/productos_datatable_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function nuevo(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$marcas = $this->General_model->get('marcas', array(), array('marca'=>'asc'), 'marca');
		$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
		$campos = array(
			'Contenido energético <small>(Energía, calorias)</small>'=>'energia', 
			'Calorias de grasa <small>(Energía de grasa)</small>'=>'calograsas', 
			'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>'=>'lipidos', 
			'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>'=>'acidosgs', 
			'Sodio <small><br>(Sal, Na)</small>'=>'sodio', 
			'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>'=>'hidratos', 
			'Azucares <small><br>(Azucares añadidos)</small>'=>'azucaresa', 
			'Proteinas <small><br>(Proteinas totales)</small>'=>'proteina', 
			'Grasas monoinsaturadas <small>(Ácidos gm)</small>'=>'acidosgm', 
			'Grasas poliinsaturadas <small>(Ácidos gp)</small>'=>'acidosgp', 
			'Grasas Trans <small><br>(Ácidos grasos trans)</small>'=>'acidostrans', 
			'Fibra <small><br>(Fibra dietética)</small>'=>'fibra', 
			'Colesterol'=>'colesterol', 
			'Vitamina A'=>'vitaa', 
			'Ácidos Ascord'=>'acidoascord', 
			'Tiamina'=>'tiamina', 
			'Robifavlina'=>'riboflavina', 
			'Ácidos Pantotenico'=>'acidopanto', 
			'Vitamina D'=>'vitad', 
			'Niacina'=>'niacina', 
			'Piridoxina'=>'piridoxina', 
			'Ácidos fólico'=>'acidofolico', 
			'Cobalamina'=>'cobalamina', 
			'Vitamina E'=>'vitaminae', 
			'Tocoferol'=>'tocoferol', 
			'Vitak'=>'vitak', 
			'Calcio'=>'calcio', 
			'Fosforo'=>'fosforo', 
			'Hierro'=>'hierro', 
			'Magnesio'=>'magnesio', 
			'Potasio'=>'potasio', 
			'Zinc'=>'zinc', 
			'Ácido Linoleico'=>'acidolino'
		);

		$data = array(
			'marcas'	=>	$marcas,
			'categorias'=>	$categorias,
			'campos'	=>	$campos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'',
			'usuario'	=>	$usuario->nombre,
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
		);

		$this->load->view('Plantillas/html_open_view', $config);
		$this->load->view('Plantillas/head_view');
		$this->load->view('Plantillas/body_open_view');
		$this->load->view('Plantillas/wraper_open_view');
		$this->load->view('Plantillas/navbar_view');
		$this->load->view('Plantillas/sidebar_view');
		$this->load->view('Plantillas/content_wraper_open_view');
		$this->load->view('Plantillas/content_wraper_header_view');
		
		/*Aqui va el contenido*/
		$this->load->view('Productos/nuevo_producto_view', $data);
		$this->load->view('Productos/nuevo_producto_modales_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*funcionalidad Javascript*/
		$this->load->view('Productos/nuevo_producto_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function registro(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		$valores_productos = array(
			'id_prod'		=>	'',
			'id_user'	=>	$this->session->idUser,
			'nombre'		=>	$this->input->post('producto_nombre'),
			'cantidad_neta'	=>	$this->input->post('producto_cantidad_neta'),
			'cantidad_porcion'	=>	$this->input->post('producto_cantidad_porcion'),
			'fecha'			=>	date("Y-m-d H:i:s"),
			'tipo'			=>	($this->input->post('um_porcion')=='g') ? 'solido' : 'liquido',
		);
		//print_r($valores_productos);

		foreach ($_POST as $campo => $valor) {
			if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
				switch($this->input->post('um_'.$campo)){
					case 'mg':
						$valor = $valor/1000;
						break;
					case 'mcg':
						$valor = $valor/1000000;
						break;
				}
				$valores_productos[$campo] = $valor;
			}
		}
		print_r($valores_productos);
		$this->General_model->set('productos_foodmathlab', $valores_productos);
		redirect(base_url('productos_registrados'));
	}

	public function registrados(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser']), array(), '');
		$data = array(
			'productos'	=>	$productos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'',
			'usuario'	=>	$usuario->nombre,
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
		);

		$this->load->view('Plantillas/html_open_view', $config);
		$this->load->view('Plantillas/head_view');
		$this->load->view('Plantillas/body_open_view');
		$this->load->view('Plantillas/wraper_open_view');
		$this->load->view('Plantillas/navbar_view');
		$this->load->view('Plantillas/sidebar_view');
		$this->load->view('Plantillas/content_wraper_open_view');
		$this->load->view('Plantillas/content_wraper_header_view');
		
		/*Aqui va el contenido*/
		$this->load->view('Productos/productos_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Productos/productos_datatable_view');
		$this->load->view('Productos/productos_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function descripcion(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$id_producto = $this->input->post('id');
		$productos = $this->General_model->get('productos_foodmathlab', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$campos = array(
			'Contenido energético <small>(Energía, calorias)</small>'=>'energia', 
			'Calorias de grasa <small>(Energía de grasa)</small>'=>'calograsas', 
			'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>'=>'lipidos', 
			'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>'=>'acidosgs', 
			'Sodio <small><br>(Sal, Na)</small>'=>'sodio', 
			'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>'=>'hidratos', 
			'Azucares <small><br>(Azucares añadidos)</small>'=>'azucaresa', 
			'Proteinas <small><br>(Proteinas totales)</small>'=>'proteina', 
			'Grasas monoinsaturadas <small>(Ácidos gm)</small>'=>'acidosgm', 
			'Grasas poliinsaturadas <small>(Ácidos gp)</small>'=>'acidosgp', 
			'Grasas Trans <small><br>(Ácidos grasos trans)</small>'=>'acidostrans', 
			'Fibra <small><br>(Fibra dietética)</small>'=>'fibra', 
			'Colesterol'=>'colesterol', 
			'Vitamina A'=>'vitaa', 
			'Ácidos Ascord'=>'acidoascord', 
			'Tiamina'=>'tiamina', 
			'Robifavlina'=>'riboflavina', 
			'Ácidos Pantotenico'=>'acidopanto', 
			'Vitamina D'=>'vitad', 
			'Niacina'=>'niacina', 
			'Piridoxina'=>'piridoxina', 
			'Ácidos fólico'=>'acidofolico', 
			'Cobalamina'=>'cobalamina', 
			'Vitamina E'=>'vitaminae', 
			'Tocoferol'=>'tocoferol', 
			'Vitak'=>'vitak', 
			'Calcio'=>'calcio', 
			'Fosforo'=>'fosforo', 
			'Hierro'=>'hierro', 
			'Magnesio'=>'magnesio', 
			'Potasio'=>'potasio', 
			'Zinc'=>'zinc', 
			'Ácido Linoleico'=>'acidolino'
		);

		$data = array(
			'producto'	=>	$producto,
			'campos'	=>	$campos,
		);

		$this->load->view('Productos/descripcion_producto_view', $data);
	}
}

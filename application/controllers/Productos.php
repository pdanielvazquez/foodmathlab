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
		$campos = array('Energía'=>'energia', 'Calograsas'=>'calograsas', 'Lípidos'=>'lipidos', 'Ácidos grasas saturadas'=>'acidosgs', 'Ácidos gm'=>'acidosgm', 'Ácidos gp'=>'acidosgp', 'Grasas Transgénicas'=>'acidostrans', 'Colesterol'=>'colesterol', 'Sodio'=>'sodio', 'Hidratos'=>'hidratos', 'Fibra'=>'fibra', 'Azucares'=>'azucaresa', 'Proteinas'=>'proteina', 'Vitamina A'=>'vitaa', 'Ácidos Ascord'=>'acidoascord', 'Tiamina'=>'tiamina', 'Robifavlina'=>'riboflavina', 'Ácidos Pantotenico'=>'acidopanto', 'Vitamina D'=>'vitad', 'Niacina'=>'niacina', 'Piridoxina'=>'piridoxina', 'Ácidos fólico'=>'acidofolico', 'Cobalamina'=>'cobalamina', 'Vitamina E'=>'vitaminae', 'Tocoferol'=>'tocoferol', 'Vitak'=>'vitak', 'Calcio'=>'calcio', 'Fosforo'=>'fosforo', 'Hierro'=>'hierro', 'Magnesio'=>'magnesio', 'Potasio'=>'potasio', 'Zinc'=>'zinc', 'Ácido Linoleico'=>'acidolino');
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
			'id_categoria'	=>	$this->input->post('producto_categoria'),
			'id_marca'		=>	$this->input->post('producto_marca'),
			'id_usuario'	=>	$this->session->idUser,
			'ean'			=>	'',
			'nombre'		=>	$this->input->post('producto_nombre'),
			'numImagen'		=>	'',
			'fecha'			=>	date("Y-m-d H:i:s"),
			'rotula'		=>	0,
		);
		//print_r($valores_productos);
		$this->General_model->set('productos', $valores_productos);
		$id_producto = $this->General_model->index('productos', 'id_prod');

		$valores_informacion_nutrimental = array(
			'id_info100'	=>	'',
			'id_prod'		=>	$id_producto,
			'tamano_porcion'=>	'100 g',
		);
		foreach ($_POST as $campo => $valor) {
			if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
				switch($this->input->post('um_'.$campo)){
					case 'mg':
						$valor = $valor/1000;
						break;
					case 'mcg':
						$valor = $valor/1000000;
						break;
					case '%':
						$valor = 100*($this->input->post($campo)/100);
						break;

				}
				$valores_informacion_nutrimental[$campo] = $valor;
				//echo "$campo -> $valor <br>";
			}
		}
		print_r($valores_informacion_nutrimental);
		$this->General_model->set('informacion_productos100', $valores_informacion_nutrimental);
		redirect(base_url('productos_registrados'));
	}

	public function registrados(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$marcas = $this->General_model->get('marcas', array(), array('marca'=>'asc'), 'marca');
		$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
		$productos = $this->General_model->get('productos', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$data = array(
			'marcas'	=>	$marcas,
			'categorias'=>	$categorias,
			'productos'	=>	$productos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
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
		$productos = $this->General_model->get('productos', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$descripciones = $this->General_model->get('informacion_productos100', array('id_prod'=>$id_producto), array(), '');
		$descripcion = ($descripciones!=false) ? $descripciones->row(0) : false;

		$campos = array('Energía (kcal)'=>'energia', 'Calograsas'=>'calograsas', 'Lípidos'=>'lipidos', 'Ácidos grasas saturadas'=>'acidosgs', 'Ácidos gm'=>'acidosgm', 'Ácidos gp'=>'acidosgp', 'Grasas Transgénicas'=>'acidostrans', 'Colesterol'=>'colesterol', 'Sodio'=>'sodio', 'Hidratos'=>'hidratos', 'Fibra'=>'fibra', 'Azucares'=>'azucaresa', 'Proteinas'=>'proteina', 'Vitamina A'=>'vitaa', 'Ácidos Ascord'=>'acidoascord', 'Tiamina'=>'tiamina', 'Robifavlina'=>'riboflavina', 'Ácidos Pantotenico'=>'acidopanto', 'Vitamina D'=>'vitad', 'Niacina'=>'niacina', 'Piridoxina'=>'piridoxina', 'Ácidos fólico'=>'acidofolico', 'Cobalamina'=>'cobalamina', 'Vitamina E'=>'vitaminae', 'Tocoferol'=>'tocoferol', 'Vitak'=>'vitak', 'Calcio'=>'calcio', 'Fosforo'=>'fosforo', 'Hierro'=>'hierro', 'Magnesio'=>'magnesio', 'Potasio'=>'potasio', 'Zinc'=>'zinc', 'Ácido Linoleico'=>'acidolino');

		$data = array(
			'producto'	=>	$producto,
			'descripcion'=>	$descripcion,
			'campos'	=>	$campos,
		);

		$this->load->view('Productos/descripcion_producto_view', $data);
	}
}

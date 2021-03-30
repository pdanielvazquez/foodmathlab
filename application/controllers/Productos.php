<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
	}

	public function index(){

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

		/*Consultas generales*/
		$marcas = $this->General_model->get('marcas', array(), array('marca'=>'asc'), 'marca');
		$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
		$campos = array('Energía (kcal)'=>'energia', 'Calograsas'=>'calograsas', 'Lípidos'=>'lipidos', 'Ácidos grasas saturadas'=>'acidosgs', 'Ácidos gm'=>'acidosgm', 'Ácidos gp'=>'acidosgp', 'Grasas Transgénicas'=>'acidostrans', 'Colesterol'=>'colesterol', 'Sodio'=>'sodio', 'Hidratos'=>'hidratos', 'Fibra'=>'fibra', 'Azucares'=>'azucaresa', 'Proteinas'=>'proteina', 'Vitamina A'=>'vitaa', 'Ácidos Ascord'=>'acidoascord', 'Tiamina'=>'tiamina', 'Robifavlina'=>'riboflavina', 'Ácidos Pantotenico'=>'acidopanto', 'Vitamina D'=>'vitad', 'Niacina'=>'niacina', 'Piridoxina'=>'piridoxina', 'Ácidos fólico'=>'acidofolico', 'Cobalamina'=>'cobalamina', 'Vitamina E'=>'vitaminae', 'Tocoferol'=>'tocoferol', 'Vitak'=>'vitak', 'Calcio'=>'calcio', 'Fosforo'=>'fosforo', 'Hierro'=>'hierro', 'Magnesio'=>'magnesio', 'Potasio'=>'potasio', 'Zinc'=>'zinc', 'Ácido Linoleico'=>'acidolino');
		$data = array(
			'marcas'	=>	$marcas,
			'categorias'=>	$categorias,
			'campos'	=>	$campos,
		);

		/*Configuración de la vista*/
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
		$this->load->view('Productos/nuevo_producto_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');
		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function registro(){
		$valores_productos = array(
			'id_prod'		=>	'',
			'id_categoria'	=>	$this->input->post('producto_categoria'),
			'id_marca'		=>	$this->input->post('producto_marca'),
			'id_provedor'	=>	201,
			'ean'			=>	'',
			'nombre'		=>	$this->input->post('producto_nombre'),
			'numImagen'		=>	'',
			'fecha'			=>	date("Y-m-d H:i:s"),
			'rotula'		=>	0,
		);
		print_r($valores_productos);
		$this->General_model->set('productos', $valores_productos);
		$id_producto = $this->General_model->index('productos', 'id_prod');

		$valores_informacion_nutrimental = array(
			'id_info100'	=>	'',
			'id_prod'		=>	$id_producto,
			'tamano_porcion'=>	'100 g',
		);
		foreach ($_POST as $campo => $valor) {
			if (strpos($campo, 'producto_')<-1) {
				$valores_informacion_nutrimental[$campo] = $valor;
			}
		}
		print_r($valores_informacion_nutrimental);
		$this->General_model->set('informacion_productos100', $valores_informacion_nutrimental);
		redirect(base_url('productos_registrados'));
	}
}

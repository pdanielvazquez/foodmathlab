<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Estadisticas_helper');
		$this->load->library('session');
	}

	public function index(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$productos = $this->General_model->get('productos', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$ids_productos = array();
		if ($productos!=false) {
			foreach ($productos->result() as $producto) {
				array_push($ids_productos, $producto->id_prod);
			}
		}
		$ingredientes = $this->General_model->query('SELECT * FROM informacion_productos100 WHERE id_prod IN ('. implode(',', $ids_productos) .')');

		$campos = array(
			'Energía'			=> 	array('campo'=>'energia'), 
			'Azucares'			=>	array('campo'=>'azucaresa'), 
			'Grasas saturadas'	=>	array('campo'=>'acidosgs'), 
			'Grasa total'		=>	array('campo'=>'lipidos'), 
			'Sodio'				=>	array('campo'=>'sodio'), 
			'Hidratos'			=>	array('campo'=>'hidratos'), 
			'Fibra'				=>	array('campo'=>'fibra'), 
			'Proteinas'			=>	array('campo'=>'proteina')
		);

		foreach ($campos as $cve => $val) {
			$stats = new Estadisticas($ingredientes, $val['campo']);
			$campos[$cve]['media'] 	= $stats->getMedia();
		    $campos[$cve]['de'] 		= $stats->getDE();
		    $campos[$cve]['moda'] 	= $stats->getModa();
		    $campos[$cve]['mediana'] = $stats->getMediana();
		    $campos[$cve]['minimo'] 	= $stats->getMinimo();
		    $campos[$cve]['maximo'] 	= $stats->getMaximo();
		    unset($stats);
		}

		$data = array(
			'productos'		=>	$productos,
			'campos'		=>	$campos,
			'ingredientes'	=>	$ingredientes,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Reportes',
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
		$this->load->view('Reportes/resumen_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		//$this->load->view('Productos/productos_datatable_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

}
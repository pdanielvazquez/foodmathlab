<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
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

}

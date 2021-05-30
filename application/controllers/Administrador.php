<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		$this->load->library('session');
	}

	public function index()
	{

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$usuarios = $this->General_model->get('usuarios', array(), array(), '');
		$opciones = $this->General_model->get('menu_opciones', array(), array(), '');
		$permisos = $this->General_model->get('permisos_menu', array(), array(), '');

		$data = array(
			'usuarios'	=>	$usuarios,
			'opciones'	=>	$opciones,
			'permisos'	=>	$permisos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Administrador',
			'subtitulo'	=>	'usuarios',
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
		$this->load->view('Administrador/usuarios_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*funcionalidad Javascript*/
		$this->load->view('Administrador/usuarios_datatable_view');
		$this->load->view('Administrador/usuarios_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function permisos(){
		$usuario = $this->input->post('id_usuario');
		$opcion = $this->input->post('id_opcion');
		$estado = $this->input->post('estado');
		if ($estado==0) {
			$this->General_model->delete('permisos_menu', array('id_usuario'=>$usuario, 'id_opcion'=>$opcion));
			echo "Eliminado";
		}
		else{
			$valores = array(
				'id_usuario'=>$usuario, 
				'id_opcion'=>$opcion
			);
			$this->General_model->set('permisos_menu', $valores);
			echo "Otorgado";
		}
	}

}

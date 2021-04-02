<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
	}

	public function index()
	{
		$this->load->view('Login/login_view');
	}

	public function login(){
		redirect('productos');
	}

	public function logout(){
		redirect(base_url());
	}

	public function registro(){
		$this->load->view('Login/register_view');
	}

	public function nuevo(){
		$nombre = $this->input->post('name');
		$correo = $this->input->post('email');
		$contra = $this->input->post('pass1');
		$valores = array(
			'id_user'	=>	'',
			'nombre'	=>	$nombre,
			'correo'	=>	$correo,
			'password'	=>	password_hash($contra, PASSWORD_DEFAULT),
		);
		$this->General_model->set('usuarios', $valores);
	}

	public function plantilla(){
		$this->load->view('Plantillas/vacia_view');
	}

	public function segmentada(){
		$this->load->view('Plantillas/html_open_view');
		$this->load->view('Plantillas/head_view');
		$this->load->view('Plantillas/body_open_view');
		$this->load->view('Plantillas/wraper_open_view');
		$this->load->view('Plantillas/navbar_view');
		$this->load->view('Plantillas/sidebar_view');
		$this->load->view('Plantillas/content_wraper_open_view');
		$this->load->view('Plantillas/content_wraper_header_view');
		$this->load->view('Plantillas/main_content_view');
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');
		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

}

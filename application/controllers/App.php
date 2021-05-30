<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('Mi_helper');
		$this->load->model('General_model');
		$this->load->library('session');
	}

	public function index()
	{

		if (isset($_SESSION['idUser'])) {
			redirect(base_url('productos_registrados'));
		}

		$error = ($this->uri->segment(2)=='error') ? 1 : 0;
		$tipo = ($error==1) ? $this->uri->segment(3) : 0;
		$data = array(
			'error'	=>	$error,
			'tipo'	=>	$tipo,
			);
		$this->load->view('Login/login_view', $data);
	}

	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$usuarios = $this->General_model->get('usuarios', array('correo'=>$email), array(), '');
		if ($usuarios!=false) {
			$usuario = $usuarios->row(0);
			if (password_verify($password, $usuario->password)) {
				$this->session->idUser = $usuario->id_user;
				redirect(base_url('inicio'));
			}
			else{
				redirect(base_url('login/error/2'));		
			}
		}
		else{
			redirect(base_url('login/error/1'));	
		}
	}

	public function logout(){
		session_destroy();
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

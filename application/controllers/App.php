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
			redirect(base_url('inicio'));
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
		if (!isset($_POST['g-recaptcha-response'])) {
			redirect(base_url('login/error/3'));
		}

		$reCaptcha = $this->input->post('g-recaptcha-response');
		$secreto = '6Lc8_q4cAAAAABinHBlGPb-1EAof0ukN4cnJ7Eq9';
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$response = file_get_contents($url."?secret=$secreto&response=$reCaptcha");
		$json = json_decode($response);
		print_r($json);
		if ($json->success==1) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$usuarios = $this->General_model->get('usuarios', array('correo'=>$email), array(), '');
			if ($usuarios!=false) {
				$usuario = $usuarios->row(0);
				if (password_verify($password, $usuario->password)) {
					$this->session->idUser = $usuario->id_user;
					/*Registro de actividad en bitácora*/
					$datos = array(
						'id_bitacora'	=>	'',
						'id_usuario'	=>	$_SESSION['idUser'],
						'observacion'	=>	'Inicio de sesión',
						'fecha'			=>	date("Y-m-d H:i:s"),
						);
					$this->General_model->set('bitacora', $datos);
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
		else{
			redirect(base_url('login/error/3'));
		}
	}

	public function logout(){
		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Cierre de sesión',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);
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

}

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

	public function salida()
	{
		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Cierre de sesión',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);
		redirect('logout');
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

	public function recuperar(){
		$error = desencripta($this->uri->segment(2));

		$data = array(
			'error'	=>	$error,
		);

		$this->load->view('Login/recuperar_view', $data);
	}

	public function enviar_correo_recuperacion(){
		if (!isset($_POST['g-recaptcha-response'])) {
			redirect(base_url('recuperar_contrasena/').encripta(2));
		}

		$reCaptcha = $this->input->post('g-recaptcha-response');
		$secreto = '6Lc8_q4cAAAAABinHBlGPb-1EAof0ukN4cnJ7Eq9';
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$response = file_get_contents($url."?secret=$secreto&response=$reCaptcha");
		$json = json_decode($response);
		if ($json->success==1) {
			$email = $this->input->post('correo');
			$usuarios = $this->General_model->get('usuarios', array('correo'=>$email), array(), '');
			if ($usuarios!=false) {
				$usuario = $usuarios->row(0);
				$from_email = 	"no-reply@nutrimonitor.com";
				$to_email 	=	$email;
				$liga = base_url('actualizar_contrasena/'.encripta($email).'/'.encripta($usuario->id_user).'/'.encripta(date("Y-m-d")).'/'.encripta(0));

				$this->load->library('email');
				$config = array();
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'email-smtp.us-east-1.amazonaws.com';
				$config['smtp_user'] = 'AKIA2WEACUCFHGLNR6PI';
				$config['smtp_pass'] = 'BJ/4B7iI6ztwpN+LD6MOepfMIIpoeRaNUm+lWxB0JAUz';
				$config['smtp_crypto'] = 'tls';
				$config['mailtype'] = 'html';
				$config['charset'] = 'utf-8';
				$config['smtp_port'] = '587';
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
		        $this->email->from($from_email, 'Foodmathlab by Nutrimonitor');
		        $this->email->to($to_email);
		        $this->email->subject('Servicio de recuperación de contraseña');
		        $this->email->message("<p>Se ha recibido una solicitud para actualizar la contraseña de la cuenta asociada al correo $to_email para poder acceder a Foodmathlab. Si desea continuar, de click en la liga <a href=\"$liga\" >Actualizar contraseña</a>, sino no es así, haga caso omiso de este correo. <p>NOTA IMPORTANTE: Este vínculo sólo será valido por el día de hoy.</p>");
		        //Send mail
				if($this->email->send())
		            // echo "Congragulation Email Send Successfully.";
					redirect(base_url('recuperar_contrasena/').encripta(3));
		        else
		         //    echo "You have encountered an error";
		        	// echo $this->email->print_debugger();
					redirect(base_url('recuperar_contrasena/').encripta(4));
			}
			else{
				redirect(base_url('recuperar_contrasena/').encripta(1));
			}
		}
		else{
			redirect(base_url('recuperar_contrasena/').encripta(2));
		}
	}

	public function actualizar(){

		$correo 	= desencripta($this->uri->segment(2));
		$id_user 	= desencripta($this->uri->segment(3));
		$fecha 		= desencripta($this->uri->segment(4));
		$error 		= desencripta($this->uri->segment(5));
		$activo 	= ($fecha == date("Y-m-d")) ? 1 : 0;

		$data = array(
			'fecha'		=>	$fecha,
			'id_user'	=>	$id_user,
			'correo'	=>	$correo,
			'activo'	=>	$activo,
			'error'		=>	$error,
		);

		$this->load->view('Login/actualizar_view', $data);

	}

	public function nueva(){

		$correo 	= desencripta($this->input->post('info1'));
		$id_user 	= desencripta($this->input->post('info2'));
		$fecha 		= desencripta($this->input->post('info3'));

		if (!isset($_POST['g-recaptcha-response'])) {
			redirect(base_url('actualizar_contrasena/'.encripta($correo).'/'.encripta($id_user).'/'.encripta($fecha).'/'.encripta(2)));
		}

		$reCaptcha = $this->input->post('g-recaptcha-response');
		$secreto = '6Lc8_q4cAAAAABinHBlGPb-1EAof0ukN4cnJ7Eq9';
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$response = file_get_contents($url."?secret=$secreto&response=$reCaptcha");
		$json = json_decode($response);
		if ($json->success==1) {
			
			$pass1		= $this->input->post('password1');
			$pass2		= $this->input->post('password2');
			$activo 	= ($fecha == date("Y-m-d")) ? 1 : 0;
			$error 		= ($pass1 != $pass2) ? 1 : 0;

			if ($error == 0) {
				$this->General_model->update('usuarios', array('id_user'=>$id_user), array('password'=>password_hash($pass1, PASSWORD_DEFAULT)));
				redirect(base_url().'login/error/4');
				// echo "$pass1 <br>";
				// echo password_hash($pass1, PASSWORD_DEFAULT);
			}
			else{
				$liga = base_url('actualizar_contrasena/'.encripta($correo).'/'.encripta($id_user).'/'.encripta($fecha).'/'.encripta(1));
				redirect($liga);
			}
		}
		else{
			$liga = base_url('actualizar_contrasena/'.encripta($correo).'/'.encripta($id_user).'/'.encripta($fecha).'/'.encripta(2));
			redirect($liga);
		}
	}

}

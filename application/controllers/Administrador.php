<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	private $etiquetados = array(
			'chi'	=>	'Chile', 
			'ecu'	=>	'Ecuador', 
			'mex' 	=>	'México', 
			'col' 	=>	'Colombia', 
			'uru'	=>	'Uruguay', 
			'per'	=>	'Perú', 
			'run'	=>	'Reino Unido', 
			'fra'	=>	'Francia', 
			'isr'	=>	'Israel', 
			'ita'	=>	'Italia', 
			'aus'	=>	'Australia');

	private $indices = array(
			'nrf'	=>	'NRF 9.3', 
			'sai'	=>	'SAIN-LIM', 
			'fuf'	=>	'Fullness Factor', 
			'mes'	=>	'Media Estándar', 
			'sen'	=>	'Sens');

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

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$mensaje = ($this->uri->segment(2)!='')? $this->uri->segment(2) : 0;
		$usuarios = $this->General_model->get('usuarios', array(), array(), '');
		$opciones = $this->General_model->get('menu_opciones', array(), array(), '');
		$permisos = $this->General_model->get('permisos_menu', array(), array(), '');
		$permisos_labs = $this->General_model->get('permisos_labs', array(), array(), '');
		$permisos_etiquetados = $this->General_model->get('permisos_etiquetados', array(), array(), '');
		$permisos_indices = $this->General_model->get('permisos_indices', array(), array(), '');

		$data = array(
			'usuarios'	=>	$usuarios,
			'opciones'	=>	$opciones,
			'permisos'	=>	$permisos,
			'mensaje'	=>	$mensaje,
			'permisos_labs'=>	$permisos_labs,
			'permisos_labels'=>$permisos_etiquetados,
			'permisos_indexes'=>$permisos_indices,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Administrador',
			'subtitulo'	=>	'usuarios',
			'usuario'	=>	$usuario->nombre,
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
			'permisos_submenu'=>$permisos_submenu,
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

	public function usuario_guardar_editar(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->input->post('usuario'));
		$valores = array(
			'nombre'	=>	$this->input->post('nombre'),
			'correo'	=>	$this->input->post('correo'),
		);
		if ($this->input->post('password1')!='') {
			$valores['password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
		}
		$this->General_model->update('usuarios', array('id_user'=>$id_user), $valores);
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/2'));
	}



	public function usuario_editar(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->uri->segment(2));
		$edicion = $this->uri->segment(3);
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$id_user), array(), '');
		$mensaje = ($this->uri->segment(3)!='')? $this->uri->segment(3) : 0;
		$opciones = $this->General_model->get('menu_opciones', array('activo'=>1), array('orden'=>'asc'), '');
		$subopciones = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array('id_opcion'=>'asc', 'orden_submenu'=>'asc'), '');
		$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$id_user), array(), '');
		$permisos_labs = $this->General_model->get('permisos_labs', array('id_usuario'=>$id_user), array(), '');
		$permisos_labels = $this->General_model->get('permisos_etiquetados', array('id_usuario'=>$id_user), array(), '');
		$permisos_indices = $this->General_model->get('permisos_indices', array('id_usuario'=>$id_user), array(), '');

		$data = array(
			'usuarios'	=>	$usuarios,
			'mensaje'	=>	$mensaje,
			'opciones'	=>	$opciones,
			'subopciones'=>	$subopciones,
			'etiquetados'=>	$this->etiquetados,
			'indices'	=>	$this->indices,
			'edicion'	=>	$edicion,
			'permisos_submenu'	=>	$permisos_submenu,
			'permisos_labs'		=>	$permisos_labs,
			'permisos_labels'	=>	$permisos_labels,
			'permisos_indices'	=>	$permisos_indices,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Administrador',
			'subtitulo'	=>	'usuarios',
			'usuario'	=>	$usuario->nombre,
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
			'permisos_submenu'=>$permisos_submenu,
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
		$this->load->view('Administrador/usuarios_editar_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*funcionalidad Javascript*/
		$this->load->view('Administrador/usuarios_datatable_view');
		$this->load->view('Administrador/usuarios_js_view');
		$this->load->view('Administrador/usuarios_toast_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function usuario_nuevo(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->uri->segment(2));
		$edicion = ($this->uri->segment(3)!='')? $this->uri->segment(3) : 0;
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$id_user), array(), '');
		$opciones = $this->General_model->get('menu_opciones', array('activo'=>1), array('orden'=>'asc'), '');
		$subopciones = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array('id_opcion'=>'asc', 'orden_submenu'=>'asc'), '');
		

		$data = array(
			'usuarios'	=>	$usuarios,
			'opciones'	=>	$opciones,
			'subopciones'=>	$subopciones,
			'etiquetados'=>	$this->etiquetados,
			'indices'	=>	$this->indices,
			'edicion'	=>	$edicion,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Administrador',
			'subtitulo'	=>	'> Nuevo usuario',
			'usuario'	=>	$usuario->nombre,
			'menu'		=>	$menu,
			'submenu'	=>	$submenu,
			'permisos_submenu'=>$permisos_submenu,
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
		$this->load->view('Administrador/usuarios_nuevo_view', $data);
		$this->load->view('Administrador/usuarios_nuevo_modal_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*funcionalidad Javascript*/
		$this->load->view('Administrador/usuarios_nuevo_js_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function usuario_guardar_nuevo(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$valores = array(
			'id_user'	=>	'',
			'nombre'	=>	$this->input->post('nombre'),
			'correo'	=>	$this->input->post('correo'),
			'password'	=>	password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
		);
		$this->General_model->set('usuarios', $valores);
		$id_user = $this->General_model->index('usuarios', 'id_user');
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/5'));
	}

	public function usuario_eliminar(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Administrador'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/

		$id_user = desencripta($this->uri->segment(2));
		$valores = array(
			'id_user'	=>	$id_user,
		);
		$this->General_model->delete('usuarios', $valores);

		redirect(base_url('usuarios/1'));
	}

	public function actualizar_subpermisos(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->input->post('usuario_subpermisos'));
		$this->General_model->delete('permisos_submenu', array('id_usuario'	=>	$id_user));
		$this->General_model->delete('permisos_menu', array('id_usuario'=>$id_user));

		foreach ($_POST as $cve => $val) {
			$tipo = explode('_', $cve);
			if ($tipo[0]=='sub') {
				$datos = array(
					'id_usuario'=>$id_user, 
					'id_opcion'=>$tipo[1], 
					'orden_submenu'=>$tipo[2]
				);
				$permiso_menu = $this->General_model->get('permisos_menu', array('id_usuario'=>$id_user, 'id_opcion'=>$tipo[1]), array(), '');
				if ($permiso_menu==false) {
					$this->General_model->set('permisos_menu', array('id_usuario'=>$id_user, 'id_opcion'=>$tipo[1]));				
				}
				$this->General_model->set('permisos_submenu', $datos);				
			}
		}
		
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/1'));
	}

	public function actualizar_labs(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->input->post('usuario_lab'));
		$this->General_model->delete('permisos_labs', array('id_usuario'=>$id_user));
		$datos = array(
			'id_usuario'	=>$id_user, 
			'no_labs'		=>$this->input->post('no_labs'), 
			'no_productos'	=>$this->input->post('no_max_prod'),
		);
		$this->General_model->set('permisos_labs', $datos);				
		
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/2'));
	}

	public function actualizar_labels(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->input->post('usuario_labels'));
		$this->General_model->delete('permisos_etiquetados', array('id_usuario'=>$id_user));

		foreach ($_POST as $cve => $val) {
			$tipo = explode('_', $cve);
			if ($tipo[0]=='label') {
				$datos = array(
					'id_usuario'=>	$id_user, 
					'etiquetado'=>	$val, 
				);
				$this->General_model->set('permisos_etiquetados', $datos);				
			}
		}
		
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/3'));
	}

	public function actualizar_index(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$id_user = desencripta($this->input->post('usuario_index'));
		$this->General_model->delete('permisos_indices', array('id_usuario'=>$id_user));

		foreach ($_POST as $cve => $val) {
			$tipo = explode('_', $cve);
			if ($tipo[0]=='index') {
				$datos = array(
					'id_usuario'=>	$id_user, 
					'indice'=>	$val, 
				);
				$this->General_model->set('permisos_indices', $datos);				
			}
		}
		
		redirect(base_url('usuarios_editar/'.encripta($id_user).'/4'));
	}

}

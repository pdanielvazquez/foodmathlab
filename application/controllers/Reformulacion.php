<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Reformulacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		$this->load->library('session');
		$this->load->helper('NRF93_helper');
		$this->load->helper('Estadisticas_helper');
		$this->load->helper('SainLim_helper');
		$this->load->helper('SainLim_Sens_helper');
		$this->load->helper('fullnessFactor_helper');
		$this->load->helper('media_estandarizada_helper');
		$this->load->helper('extra_helper');
		$this->load->helper('Etiquetado_helper');
	}

	public function index(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		redirect('productos_reformulation');
	}

	/*******************************Reformulation Section*****************************/

	/******************************** Labeled of Reformulation****************************/
	public function grupos_reform(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas*/

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		
		$id = desencripta($this->uri->segment(3));
		
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'],'id_prod'=>$id), array(), '');
		$productos_reform = $this->General_model->get('productos_foodmathlab_v2_reform', array('id_user'=>$_SESSION['idUser'],'id_prod_original'=>$id), array(), '');
        
		$campos = array(
			'energia'			=> 	array('etiqueta'=>'Energía'), 
			'azucaresa'			=>	array('etiqueta'=>'Azúcares'), 
			'acidosgs'			=>	array('etiqueta'=>'Grasas saturadas'), 
			'acidostrans'		=>	array('etiqueta'=>'Grasas trans'), 
			'lipidos'			=>	array('etiqueta'=>'Grasa total'), 
			'sodio'				=>	array('etiqueta'=>'Sodio'), 
		);

		$atributos = array(
			'energia'			=> 	array('etiqueta'=>'Energía'), 
			'azucaresa'			=>	array('etiqueta'=>'Azúcares'), 
			'acidosgs'			=>	array('etiqueta'=>'Grasas saturadas'), 
			'acidostrans'		=>	array('etiqueta'=>'Grasas trans'), 
			'lipidos'			=>	array('etiqueta'=>'Grasa total'), 
			'sodio'				=>	array('etiqueta'=>'Sodio'), 
		);

		$vnrs = array(
			'eu' => array('Europa', 'europa.jpg', $this->valores_referencia_eu),
			'mx' => array('México', 'mexico.jpg', $this->valores_referencia_co),
			'co' => array('Colombia', 'colombia.jpg', $this->valores_referencia_mx),
			'usa' => array('EE.UU.', 'usa.jpg', $this->valores_referencia_eeuu),
		);

		$data = array(
			'productos' => $productos,
			'productos_reform' => $productos_reform,
			'campos'	=>	$campos,
			'atributos'	=>	$atributos,
			'grupos'    =>  $grupos,
			'vnrs'		=>	$vnrs,
		);

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Acceso a lista de productos a reformular',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'> Reformulación',
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
		$this->load->view('Productos/grupos_reform_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		//$this->load->view('Reportes/resumen_js_view');
		$this->load->view('Productos/productos_js_view');
		//$this->load->view('Reportes/grupos_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');

	}

	/********************************* Edit's Reformulation *********************/
	public function editar_reform(){

			if (!isset($_SESSION['idUser'])) {
				redirect('App/logout');
			}

			/*Validación de permiso de acceso al método*/
			$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
			if ($permisos_usuarios==false) {
				redirect('inicio');
			}

			/*Identificador del producto a editar*/
			$id_prod = desencripta($this->uri->segment(2));
			$edicion = $this->uri->segment(3);

			/*Consultas generales*/
			$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
			$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_prod'=>$id_prod), array(), '');

			if ($productos!=false) {
				$campos = $this->campos;

				$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

				$data = array(
					'categorias'=>	$categorias,
					'campos'	=>	$campos,
					'grupos'	=>	$grupos,
					'productos'	=>	$productos,
					'edicion'	=>	$edicion,
				);

				/*Registro de actividad en bitácora*/
				$datos = array(
					'id_bitacora'	=>	'',
					'id_usuario'	=>	$_SESSION['idUser'],
					'observacion'	=>	'Acceso a formulario de reformulación de producto',
					'fecha'			=>	date("Y-m-d H:i:s"),
					);
				$this->General_model->set('bitacora', $datos);

				/*Configuración de la vista*/
				$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
				$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
				$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
				$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
				$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

				$config = array(
					'titulo'	=>	'Productos',
					'subtitulo'	=>	'Reformulación',
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
				$this->load->view('Productos/editar_producto_reform_view', $data);

				$this->load->view('Plantillas/content_wraper_close_view');
				$this->load->view('Plantillas/footer_view');
				$this->load->view('Plantillas/wraper_close_view');
				$this->load->view('Plantillas/scripts_view');

				/*funcionalidad Javascript*/
				$this->load->view('Productos/editar_producto_js_view', $data);
				$this->load->view('Productos/nuevo_producto_js_view');

				$this->load->view('Plantillas/body_close_view');
				$this->load->view('Plantillas/html_close_view');
			}
			else{
				redirect('reformulation');
			}
			
	}

	/****************************End's Edit's Reformulation *******************************/


	/****************************Reformulation ********************************************/

	public function reformulation(){

			if (!isset($_SESSION['idUser'])) {
				redirect('App/logout');
			}

			/*Validación de permiso de acceso al método*/
			$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
			if ($permisos_usuarios==false) {
				redirect('inicio');
			}

			/*Consultas generales*/
			//$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');
			$imagenes = $this->General_model->get('productos_imagenes', array('id_user'=>$_SESSION['idUser']), array(), '');
			$productos = $this->General_model->get('productos_grupos', array('id_user'=>$_SESSION['idUser']), array(), '');
			$productos_reform = $this->General_model->get('productos_foodmathlab_v2_reform', array('id_user'=>$_SESSION['idUser']), array(), '');
		    $grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array('nombre'=>'desc'), '');
			$data = array(
				'productos'	=>	$productos,
				'productos_reform' => $productos_reform,
				'imagenes'	=>	$imagenes,
				'grupos' 	=>	$grupos,
			);

			/*Registro de actividad en bitácora*/
			$datos = array(
				'id_bitacora'	=>	'',
				'id_usuario'	=>	$_SESSION['idUser'],
				'observacion'	=>	'Acceso a resultado de reformulación',
				'fecha'			=>	date("Y-m-d H:i:s"),
				);
			$this->General_model->set('bitacora', $datos);

			/*Configuración de la vista*/
			$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
			$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
			$permisos_submenu = $this->General_model->get('permisos_submenu', array('id_usuario'=>$_SESSION['idUser']), array(), '');
			$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
			$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

			$config = array(
				'titulo'	=>	'Reformulación',
				'subtitulo'	=>	'',
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
			$this->load->view('Productos/productos_reform_view', $data);
			
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

	/******************** End's Formulation Method *********************/


	/******************** Reformulation Products Register **************/
	public function registro_reform(){

			if (!isset($_SESSION['idUser'])) {
				redirect('App/logout');
			}

			/*Validación de permiso de acceso al método*/
			
			$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
			if ($permisos_usuarios==false) {
				redirect('inicio');
			}

			/*Registro de actividad en bitácora*/
			$datos = array(
				'id_bitacora'	=>	'',
				'id_usuario'	=>	$_SESSION['idUser'],
				'observacion'	=>	'Reformulación de producto',
				'fecha'			=>	date("Y-m-d H:i:s"),
				);
			$this->General_model->set('bitacora', $datos);

	        $id_prod_original=desencripta($this->input->post('producto_id'));
			$valores_productos = array(
				'id_prod'		=>	'',
				'id_prod_original' => $id_prod_original,
				'id_user'		=>	$this->session->idUser,
				'id_grupo'		=>	$this->input->post('producto_grupo'),
				'id_categoria'	=>  ($this->input->post('producto_categoria')=='si')? 49 : 0,
				'nombre'		=>	$this->input->post('producto_nombre'),
				'cantidad_neta'	=>	$this->input->post('producto_cantidad_neta'),
				'cantidad_porcion'	=>	$this->input->post('producto_cantidad_porcion'),
				'precio'		=>	$this->input->post('producto_precio'),
				'moneda'		=>	$this->input->post('producto_moneda'),
				'fecha'			=>	date("Y-m-d H:i:s"),
				'tipo'			=>	($this->input->post('um_porcion')=='g') ? 'solido' : 'liquido',
				'ingredientes'	=>	$this->input->post('producto_ingredientes'),
				'comentarios'	=>	$this->input->post('producto_comentarios'),
				'reclamaciones'	=>	$this->input->post('producto_reclamaciones'),
				'upc' 			=>	$this->input->post('producto_upc'),
			);
			//print_r($valores_productos);

			foreach ($_POST as $campo => $valor) {
				if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
					$valores_productos[$campo] = $valor;
				}
			}
			//print_r($valores_productos);

			/*Verificación de unidades de energía*/
			if ($this->input->post('um_energia')=="kcal") {
				$valores_productos['energia'] = $this->input->post('energia');
				$valores_productos['energia_kj'] = $this->input->post('energia')*4.184;
			}
			else{
				$valores_productos['energia'] = floatval($valores_productos['energia']) / 4.184; 
				$valores_productos['energia_kj'] = $this->input->post('energia'); 
			}
			$this->General_model->set('productos_foodmathlab_v2_reform', $valores_productos);
			redirect(base_url('productos_reformulation'));
	}
	/************************** End's Reformulation Products Register****************/
}

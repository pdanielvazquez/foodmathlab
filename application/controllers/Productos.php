<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	private $campos = array(
			array(
				'atributo'	=>	'energia',
				'etiqueta'	=>	'Contenido energético <small>(Energía, calorias)</small>',
				'unidad'	=>	array('kcal','kJ'),
			),
			array(
				'atributo'	=>	'calograsas',
				'etiqueta'	=>	'Calorias de grasa <small>(Energía de grasa)</small>',
				'unidad'	=>	array('kcal','kJ'),
			),
			array(
				'atributo'	=>	'lipidos',
				'etiqueta'	=>	'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidosgs',
				'etiqueta'	=>	'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidosgm',
				'etiqueta'	=>	'Grasas monoinsaturadas<br><small>(Ácidos gm)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidosgp',
				'etiqueta'	=>	'Grasas poliinsaturadas<br><small>(Ácidos gp)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidostrans',
				'etiqueta'	=>	'Grasas Trans <small><br>(Ácidos grasos trans)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'sal',
				'etiqueta'	=>	'Sal <small><br>(Sal)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'sodio',
				'etiqueta'	=>	'Sodio <small><br>(Sodio, Na)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			
			array(
				'atributo'	=>	'hidratos',
				'etiqueta'	=>	'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'azucaresa',
				'etiqueta'	=>	'Azúcares <small><br>(Azúcares añadidos)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'proteina',
				'etiqueta'	=>	'Proteinas <small><br>(Proteinas totales)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			
			array(
				'atributo'	=>	'fibra',
				'etiqueta'	=>	'Fibra <small><br>(Fibra Dietética/Alimentaria)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'colesterol',
				'etiqueta'	=>	'Colesterol<small><br>(Colesterol)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'vitaa',
				'etiqueta'	=>	'Vitamina A<small><br>(RAE, Retinol)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%', 'UI'),
			),
			array(
				'atributo'	=>	'acidoascord',
				'etiqueta'	=>	'Vitamina C<small><br>(Ácido ascórbico)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%', 'UI'),
			),
			array(
				'atributo'	=>	'tiamina',
				'etiqueta'	=>	'Vitamina B1<small><br>(Tiamina)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%', 'UI'),
			),
			array(
				'atributo'	=>	'riboflavina',
				'etiqueta'	=>	'Vitamina B2<small><br>(Robifavlina)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%', 'UI'),
			),
			array(
				'atributo'	=>	'acidopanto',
				'etiqueta'	=>	'Vitamina B5<small><br>(Ácido Pantotenico)</small>',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'vitad',
				'etiqueta'	=>	'Vitamina D<small><br>(Vitamina D)</small>',
				'unidad'	=>	array('mcg', 'g', 'mg', '%', 'UI'),
			),
			array(
				'atributo'	=>	'niacina',
				'etiqueta'	=>	'Vitamina B3<small><br>(Niacina)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'piridoxina',
				'etiqueta'	=>	'Vitamina B6<small><br>(Piridoxina)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidofolico',
				'etiqueta'	=>	'Vitamina B9<small><br>(Ácido fólico, Folato)</small>',
				'unidad'	=>	array('mcg', 'g', 'mg', '%'),
			),
			array(
				'atributo'	=>	'cobalamina',
				'etiqueta'	=>	'Vitamina B12<small><br>(Cobalamina)</small>',
				'unidad'	=>	array('mcg', 'g', 'mg', '%'),
			),
			array(
				'atributo'	=>	'vitaminae',
				'etiqueta'	=>	'Vitamina E<small><br>(Tocoferol)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			/*array(
				'atributo'	=>	'tocoferol',
				'etiqueta'	=>	'Tocoferol',
				'unidad'	=>	array('mg'),
			),*/
			array(
				'atributo'	=>	'vitak',
				'etiqueta'	=>	'Vitamina K<small><br>(Vitamina K)</small>',
				'unidad'	=>	array('mcg', 'g', 'mg', '%'),
			),
			array(
				'atributo'	=>	'calcio',
				'etiqueta'	=>	'Calcio<small><br>(Calcio, Ca)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'fosforo',
				'etiqueta'	=>	'Fosforo<small><br>(Fosforo, P)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'hierro',
				'etiqueta'	=>	'Hierro<small><br>(Hierro, Fierro, Fe)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'magnesio',
				'etiqueta'	=>	'Magnesio<small><br>(Magnesio, Mg)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'potasio',
				'etiqueta'	=>	'Potasio<small><br>(Potasio, K)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'zinc',
				'etiqueta'	=>	'Zinc<small><br>(Zinc, Zn)</small>',
				'unidad'	=>	array('mg', 'g', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'acidolino',
				'etiqueta'	=>	'Ácido Linoleico<small><br>(Omega-3 u Omega 6)</small>',
				'unidad'	=>	array('g', 'mg', 'mcg', '%'),
			),
			array(
				'atributo'	=>	'fruta',
				'etiqueta'	=>	'Fruta',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'verdura',
				'etiqueta'	=>	'Verdura',
				'unidad'	=>	array('g'),
			),
			
		);

	/*VNR's (Valores de referencia)*/

	// Europa
	private $valores_referencia_eu = array(
			'ref_energia' 		=> 2000,
			'ref_grasas_tot' 	=> 70,
			'ref_grasas_sat' 	=> 20,
			'ref_azucares' 		=> 90,
			'ref_sodio' 		=> 2400,
			'ref_hidratos' 		=> 260,
			'ref_fibra' 		=> 25,
			'ref_proteina' 		=> 50,
			'ref_vit_A'			=> 0.0008,	//g
			'ref_vit_C'			=> 80,		//mg
			'ref_vit_E'			=> 12,		//mg
			'ref_calcio'		=> 800,		//mg
			'ref_hierro'		=> 14,		//mg
			'ref_magnesio'		=> 475,		//mg
			'ref_potasio'		=> 2000,	//mg
		);

	// México
	private	$valores_referencia_mx = array(
			'ref_energia' 		=> 2000,
			'ref_grasas_tot' 	=> 66.66,
			'ref_grasas_sat' 	=> 22.22,
			'ref_azucares' 		=> 50,
			'ref_sodio' 		=> 2000,
			'ref_hidratos' 		=> '',
			'ref_fibra' 		=> 30,
			'ref_proteina' 		=> 1,
			'ref_vit_A'			=> 0.000568,//g
			'ref_vit_C'			=> 60,		//mg
			'ref_vit_E'			=> 11,		//mg
			'ref_calcio'		=> 900,		//mg
			'ref_hierro'		=> 17,		//mg
			'ref_magnesio'		=> 248,		//mg
			'ref_potasio'		=> 3500,	//mg
		);

	// Colombia
	private	$valores_referencia_co = array(
			'ref_energia' 		=> 2000,
			'ref_grasas_tot' 	=> 65,
			'ref_grasas_sat' 	=> 20,
			'ref_azucares' 		=> 50,
			'ref_sodio' 		=> 2400,
			'ref_hidratos' 		=> 300,
			'ref_fibra' 		=> 25,
			'ref_proteina' 		=> 50,
			'ref_vit_A'			=> 0.0015,	//g
			'ref_vit_C'			=> 60,		//mg
			'ref_vit_E'			=> 20,		//mg
			'ref_calcio'		=> 1000,	//mg
			'ref_hierro'		=> 18,		//mg
			'ref_magnesio'		=> 400,		//mg
			'ref_potasio'		=> 3500,	//mg
		);

	// EEUU
	private	$valores_referencia_eeuu = array(
			'ref_energia' 		=> 2000,
			'ref_grasas_tot' 	=> 78,
			'ref_grasas_sat' 	=> 20,
			'ref_azucares' 		=> 50,
			'ref_sodio' 		=> 2300,
			'ref_hidratos' 		=> 275,
			'ref_fibra' 		=> 28,
			'ref_proteina' 		=> 50,
			'ref_vit_A'			=> 0.0009, 	//g
			'ref_vit_C'			=> 90,		//mg
			'ref_vit_E'			=> 15,		//mg
			'ref_calcio'		=> 1300,	//mg
			'ref_hierro'		=> 18,		//mg
			'ref_magnesio'		=> 420,		//mg
			'ref_potasio'		=> 4700,	//mg
		);

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

		redirect('productos_registrados');
	}

	public function nuevo(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$campos = $this->campos;
		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser'], 'nombre<>'=>'Trash'), array('nombre'=>'asc'), '');
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');

		$grupos_contador = array();
		if ($grupos!=false) {
			foreach ($grupos->result() as $lab) {
				$grupos_contador[$lab->id_grupo]=0;
			}
		}
		if ($productos!=false) {
			foreach ($productos->result() as $producto) {
				$grupos_contador[$producto->id_grupo]++;
			}
		}

		$permisos_labs = $this->General_model->get('permisos_labs', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$data = array(
			'marcas'	=>	$marcas,
			'campos'	=>	$campos,
			'grupos'	=>	$grupos,
			'contadores'=>	$grupos_contador,
			'permisos_labs'=>$permisos_labs,
		);

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Acceso a formulario de registro de nuevo producto',
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
			'subtitulo'	=>	'> Nuevo producto',
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
		$this->load->view('Productos/nuevo_producto_view', $data);
		$this->load->view('Productos/nuevo_producto_modales_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*funcionalidad Javascript*/
		$this->load->view('Productos/nuevo_producto_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function registro(){

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
			'observacion'	=>	'Registro de nuevo producto',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		$valores_productos = array(
			'id_prod'		=>	'',
			'id_user'		=>	$this->session->idUser,
			'id_grupo'		=>	$this->input->post('producto_grupo'),
			'id_categoria'	=>  ($this->input->post('producto_categoria')=='si')? 49 : 0,
			'nombre'		=>	$this->input->post('producto_nombre'),
			'cantidad_neta'	=>	$this->input->post('producto_cantidad_neta')." ".$this->input->post('um_neta'),
			'cantidad_porcion'	=>	$this->input->post('producto_cantidad_porcion')." ".$this->input->post('um_porcion'),
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
				$valores_productos[$campo] = ($valor!=''? $valor : '0')." ".$_POST['um_'.$campo];
			}
		}

		/*Verificación de unidades de energía*/
		if ($this->input->post('um_energia')=="kcal") {
			$valores_productos['energia'] = $this->input->post('energia')." kcal";
			$valores_productos['energia_kj'] = $this->input->post('energia')*4.184." kJ";
		}
		else{
			$valores_productos['energia'] = floatval($valores_productos['energia']) / 4.184." kcal"; 
			$valores_productos['energia_kj'] = $this->input->post('energia')." kJ"; 
		}
		$this->General_model->set('productos_foodmathlab_v3', $valores_productos);
		redirect(base_url('productos_registrados'));

		//print_r($valores_productos);
	}

	public function registrados(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		/*$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');*/
		$imagenes = $this->General_model->get('productos_imagenes', array('id_user'=>$_SESSION['idUser']), array(), '');
		$productos = $this->General_model->get('productos_grupos_v2', array('id_user'=>$_SESSION['idUser']), array(), '');
		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array('nombre'=>'desc'), '');
		$data = array(
			'productos'	=>	$productos,
			'imagenes'	=>	$imagenes,
			'grupos' 	=>	$grupos,
		);

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Acceso a vista de productos registrados',
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
			'subtitulo'	=>	'> Registrados',
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
		$this->load->view('Productos/productos_view', $data);
		
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


	public function eliminar(){
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
			'observacion'	=>	'Eliminación de un producto',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		/*Id del grupo a eliminar*/
		$id_prod = $this->uri->segment(2);

		$valores = array(
			'id_prod'	=> desencripta($id_prod),
		);
		$this->General_model->delete('productos_foodmathlab_v2', $valores);

		redirect(base_url('productos_registrados'));
	}

	public function descripcion(){

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
			'observacion'	=>	'Acceso a vista de descripción de un producto',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		$this->load->helper('Etiquetado_helper');

		/*Consultas generales*/
		$id_producto = $this->input->post('id');
		$lab = ($this->input->post('lab')!==false)? $this->input->post('lab') : false ;
		$productos = $this->General_model->get('productos_foodmathlab_v3', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$campos = $this->campos;
		
		$productos_energia = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('energia'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('energia'=>'asc'), '');

		$productos_lipidos = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('lipidos'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('lipidos'=>'asc'), '');

		$productos_azucares = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('azucaresa'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('azucaresa'=>'asc'), '');

		$productos_grasasSat = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('acidosgs'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('acidosgs'=>'asc'), '');

		$productos_grasasTrans = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('acidostrans'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('acidostrans'=>'asc'), '');

		$productos_sodio = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('sodio'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array('sodio'=>'asc'), '');

		$productos_indices = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array(), '') : $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser']), array(), '');

		$campos_productos_indices = array(
			'proteinas'			=> 	array('campo'=>'proteina'), 
			'fibras'			=>	array('campo'=>'fibra'), 
			'vitamina_A'		=>	array('campo'=>'vitaa'), 
			'vitamina_C'		=>	array('campo'=>'acidoascord'), 
			'vitamina_D'		=>	array('campo'=>'vitad'), 
			'vitamina_E'		=>	array('campo'=>'vitaminae'), 
			'vitamina_B1'		=>	array('campo'=>'tiamina'), 
			'vitamina_B2'		=>	array('campo'=>'riboflavina'), 
			'calcio'			=>	array('campo'=>'calcio'),
			'hierro'			=>	array('campo'=>'hierro'),
			'magnesio'			=>	array('campo'=>'magnesio'),
			'zinc'				=>	array('campo'=>'zinc'),
			'potasio'			=>	array('campo'=>'potasio'),
			'acido_linoleico'	=>	array('campo'=>'acidolino'),
			'sodio'				=>	array('campo'=>'sodio'), 
			'energia'			=>	array('campo'=>'energia'), 
			'grasas_sat'		=>	array('campo'=>'acidosgs'), 
			'grasas_tot'		=>	array('campo'=>'lipidos'), 
			'azucares'			=>	array('campo'=>'azucaresa'), 
			'fruta'				=>	array('campo'=>'fruta'), 
			'verdura'			=>	array('campo'=>'verdura'), 
			'lipidos'			=>	array('campo'=>'lipidos'), 
		);

		$vnrs = array(
			'eu' => array('Europa', 'europa.jpg', $this->valores_referencia_eu),
			'mx' => array('México', 'mexico.jpg', $this->valores_referencia_co),
			'co' => array('Colombia', 'colombia.jpg', $this->valores_referencia_mx),
			'usa' => array('EE.UU.', 'usa.jpg', $this->valores_referencia_eeuu),
		);

		$permisos_etiquetados = $this->General_model->get('permisos_etiquetados', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$permisos_indices = $this->General_model->get('permisos_indices', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$data = array(
			'id_producto'		=>	$id_producto,
			'producto'			=>	$producto,
			'referencia_eu'		=>	$this->valores_referencia_eu,
			'referencia_co'		=>	$this->valores_referencia_co,
			'referencia_mx'		=>	$this->valores_referencia_mx,
			'referencia_eeuu'	=>	$this->valores_referencia_eeuu,
			'vnrs'				=>	$vnrs,
			'campos'			=>	$campos,
			'grupos'			=>	$grupos,
			'productos_energia'	=>	$productos_energia,
			'productos_lipidos'	=>	$productos_lipidos,
			'productos_azucares'=>	$productos_azucares,
			'productos_grasasSat'=>	$productos_grasasSat,
			'productos_grasasTrans'=>$productos_grasasTrans,
			'productos_sodio'	=>	$productos_sodio,
			'productos_indices'	=>	$productos_indices,
			'campos_productos_indices' => $campos_productos_indices,
			'permisos_etiquetados'	=>	$permisos_etiquetados,
			'permisos_indices'	=>	$permisos_indices,
		);

		$this->load->view('Productos/descripcion_producto_view', $data);
		
		$this->load->view('Productos/descripcion_producto_charts_view', $data);
		
		if (search_index($permisos_i, 'nrf')==true) 
			$this->load->view('Productos/descripcion_producto_nrf93_js_view', $data);
		
		if (search_index($permisos_i, 'sai')==true) 
			$this->load->view('Productos/descripcion_producto_sainlim_js_view', $data);
		
		if (search_index($permisos_i, 'sen')==true) 
			$this->load->view('Productos/descripcion_producto_sens_js_view', $data);
		
		$this->load->view('Productos/descripcion_producto_radio_view', $data);
	}

	public function grafica_maximize(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$tipo_chart = $this->uri->segment(2);
		$nutriente = $this->uri->segment(3);
		$id_producto = $this->uri->segment(4);
		$lab = false ;
		$productos = $this->General_model->get('productos_foodmathlab_v3', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$campos = $this->campos;

		$productos_nutriente = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$producto->id_grupo), array($nutriente=>'asc'), '');

		$prods_nutrimentos = [];
		$nutrientes_arr = [];
		if ($productos_nutriente!=false) {
			foreach ($productos_nutriente->result() as $prod) {
				$prods_nutrimentos[] = array(
					'id_prod'	=>	$prod->id_prod,
					'nombre' 	=>	$prod->nombre,
					'nutriente'	=> 	floatval(explode(" ", $prod->$nutriente)[0]),
				);
				$nutrientes_arr[] = floatval(explode(" ", $prod->$nutriente)[0]);
			}
		}

		$permisos_etiquetados = $this->General_model->get('permisos_etiquetados', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$permisos_indices = $this->General_model->get('permisos_indices', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$data = array(
			'id_producto'		=>	$id_producto,
			'producto'			=>	$producto,
			'referencia_eu'		=>	$this->valores_referencia_eu,
			'referencia_co'		=>	$this->valores_referencia_co,
			'referencia_mx'		=>	$this->valores_referencia_mx,
			'referencia_eeuu'	=>	$this->valores_referencia_eeuu,
			'campos'			=>	$campos,
			'grupos'			=>	$grupos,
			'nutriente'			=>	$nutriente,
			'productos_nutriente'	=>	$productos_nutriente,
			'prods_nutrimentos'	=>	$prods_nutrimentos,
			'nutrientes_arr'	=>	$nutrientes_arr,
			
			'permisos_etiquetados'	=>	$permisos_etiquetados,
			'permisos_indices'	=>	$permisos_indices,
		);

		$this->load->view('Plantillas/head_view');
		$this->load->view('Plantillas/scripts_view');
		$this->load->view('Productos/grafica_maximize_producto_view', $data);
		if ($tipo_chart=='radar') {
			$this->load->view('Productos/descripcion_producto_radio_charts_view', $data);
		}else{
			$this->load->view('Productos/descripcion_producto_bars_charts_view', $data);
		}
	}

	public function editar(){

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
		$productos = $this->General_model->get('productos_foodmathlab_v3', array('id_prod'=>$id_prod), array(), '');

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
				'observacion'	=>	'Acceso a formulario de edición de un producto',
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
				'subtitulo'	=>	'> Edición',
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
			$this->load->view('Productos/editar_producto_view', $data);

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
			redirect('productos');
		}
		
	}

	public function informacion(){

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

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab_v3', array('id_prod'=>$id_prod), array(), '');

		if ($productos!=false) {

			$producto = $productos->row(0);
			$grupo = $producto->id_grupo;
			$campos = $this->campos;

			$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

			$productos_energia = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('energia'=>'asc'), '');

			$prods_nutrimentos = [];
			$prods_lipidos 	= [];
			$prods_azucares	= [];
			$prods_acidosgs	= [];
			$prods_acidostrans	= [];
			$prods_sodio	= [];
			$energias 		= [];
			$lipidos_arr 	= [];
			$azucares_arr	= [];
			$acidosgs_arr	= [];
			$acidostrans_arr= [];
			$sodio_arr		= [];
			if ($productos_energia!=false) {
				foreach ($productos_energia->result() as $prod) {
					
					$prods_nutrimentos[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'energia'	=> 	floatval(explode(" ", $prod->energia)[0]),
					);
					$energias[] = floatval(explode(" ", $prod->energia)[0]);

					$prods_lipidos[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'lipidos'	=> 	floatval(explode(" ", $prod->lipidos)[0]),
					);
					$lipidos_arr[] = floatval(explode(" ", $prod->lipidos)[0]);

					$prods_azucares[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'azucaresa'	=> 	floatval(explode(" ", $prod->azucaresa)[0]),
					);
					$azucares_arr[]	= floatval(explode(" ", $prod->azucaresa)[0]);

					$prods_acidosgs[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'acidosgs'	=> 	floatval(explode(" ", $prod->acidosgs)[0]),
					);
					$acidosgs_arr[]	= floatval(explode(" ", $prod->acidosgs)[0]);

					$prods_acidostrans[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'acidostrans'	=> 	floatval(explode(" ", $prod->acidostrans)[0]),
					);
					$acidostrans_arr[]	= floatval(explode(" ", $prod->acidostrans)[0]);

					$prods_sodio[] = array(
						'id_prod'	=>	$prod->id_prod,
						'nombre' 	=>	$prod->nombre,
						'sodio'	=> 	floatval(explode(" ", $prod->sodio)[0]),
					);
					$sodio_arr[]	= floatval(explode(" ", $prod->sodio)[0]);

				}
			}

			$productos_lipidos = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('lipidos'=>'asc'), '');

			$productos_azucares = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('azucaresa'=>'asc'), '');

			$productos_grasasSat = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('acidosgs'=>'asc'), '');

			$productos_grasasTrans = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('acidostrans'=>'asc'), '');

			$productos_sodio = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array('sodio'=>'asc'), '');

			$productos_indices = $this->General_model->get('productos_foodmathlab_v3', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$grupo), array(), '');

			$campos_productos_indices = array(
				'proteinas'			=> 	array('campo'=>'proteina'), 
				'fibras'			=>	array('campo'=>'fibra'), 
				'vitamina_A'		=>	array('campo'=>'vitaa'), 
				'vitamina_C'		=>	array('campo'=>'acidoascord'), 
				'vitamina_D'		=>	array('campo'=>'vitad'), 
				'vitamina_E'		=>	array('campo'=>'vitaminae'), 
				'vitamina_B1'		=>	array('campo'=>'tiamina'), 
				'vitamina_B2'		=>	array('campo'=>'riboflavina'), 
				'calcio'			=>	array('campo'=>'calcio'),
				'hierro'			=>	array('campo'=>'hierro'),
				'magnesio'			=>	array('campo'=>'magnesio'),
				'zinc'				=>	array('campo'=>'zinc'),
				'potasio'			=>	array('campo'=>'potasio'),
				'acido_linoleico'	=>	array('campo'=>'acidolino'),
				'sodio'				=>	array('campo'=>'sodio'), 
				'energia'			=>	array('campo'=>'energia'), 
				'grasas_sat'		=>	array('campo'=>'acidosgs'), 
				'grasas_tot'		=>	array('campo'=>'lipidos'), 
				'azucares'			=>	array('campo'=>'azucaresa'), 
				'fruta'				=>	array('campo'=>'fruta'), 
				'verdura'			=>	array('campo'=>'verdura'), 
				'lipidos'			=>	array('campo'=>'lipidos'), 
			);

			$vnrs = array(
				'eu' => array('Europa', 'europa.jpg', $this->valores_referencia_eu),
				'mx' => array('México', 'mexico.jpg', $this->valores_referencia_co),
				'co' => array('Colombia', 'colombia.jpg', $this->valores_referencia_mx),
				'usa' => array('EE.UU.', 'usa.jpg', $this->valores_referencia_eeuu),
			);

			$permisos_etiquetados = $this->General_model->get('permisos_etiquetados', array('id_usuario'=>$_SESSION['idUser']), array(), '');
			$permisos_indices = $this->General_model->get('permisos_indices', array('id_usuario'=>$_SESSION['idUser']), array(), '');

			$data = array(
				'campos'	=>	$campos,
				'grupos'	=>	$grupos,
				'productos'	=>	$productos,
				'edicion'	=>	$edicion,
				'producto'	=>	$producto,
				'prods_nutrimentos'	=>	$prods_nutrimentos,
				'energias'			=>	$energias,
				'prods_lipidos'		=>	$prods_lipidos,
				'lipidos_arr'		=>	$lipidos_arr,
				'prods_azucares'	=>	$prods_azucares,
				'azucares_arr'		=>	$azucares_arr,
				'prods_acidosgs'	=>	$prods_acidosgs,
				'acidosgs_arr'		=>	$acidosgs_arr,
				'prods_acidostrans'	=>	$prods_acidostrans,
				'acidostrans_arr'	=>	$acidostrans_arr,
				'prods_sodio'		=>	$prods_sodio,
				'sodio_arr'			=>	$sodio_arr,

				
				'productos_indices'	=>	$productos_indices,
				'campos_productos_indices' => $campos_productos_indices,
				'permisos_etiquetados'	=>	$permisos_etiquetados,
				'permisos_indices'	=>	$permisos_indices,

				'vnrs'				=>	$vnrs,

				'referencia_eu'		=>	$this->valores_referencia_eu,
				'referencia_co'		=>	$this->valores_referencia_co,
				'referencia_mx'		=>	$this->valores_referencia_mx,
				'referencia_eeuu'	=>	$this->valores_referencia_eeuu,
			);

			/*Registro de actividad en bitácora*/
			$datos = array(
				'id_bitacora'	=>	'',
				'id_usuario'	=>	$_SESSION['idUser'],
				'observacion'	=>	'Acceso a formulario de edición de un producto',
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
				'subtitulo'	=>	'> '.$producto->nombre,
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
			$this->load->view('Productos/producto_informacion_view', $data);

			$this->load->view('Plantillas/content_wraper_close_view');
			$this->load->view('Plantillas/footer_view');
			$this->load->view('Plantillas/wraper_close_view');
			$this->load->view('Plantillas/scripts_view');

			/*funcionalidad Javascript*/
			$this->load->view('Productos/descripcion_producto_charts_view', $data);
		
			if (search_index($permisos_indices, 'nrf')==true) 
				$this->load->view('Productos/descripcion_producto_nrf93_js_view', $data);
			
			if (search_index($permisos_indices, 'sai')==true) 
				$this->load->view('Productos/descripcion_producto_sainlim_js_view', $data);
			
			if (search_index($permisos_indices, 'sen')==true) 
				$this->load->view('Productos/descripcion_producto_sens_js_view', $data);
			
			$this->load->view('Productos/descripcion_producto_radio_view', $data);

			$this->load->view('Plantillas/body_close_view');
			$this->load->view('Plantillas/html_close_view');
		}
		else{
			redirect('productos');
		}
		
	}

	public function actualizar(){

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
			'observacion'	=>	'Registro de actualización de un producto',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		$id_prod = desencripta($this->input->post('producto_id'));

		$valores_productos = array(
			'id_grupo'		=>	$this->input->post('producto_grupo'),
			'id_categoria'	=>  ($this->input->post('producto_categoria')=='si')? 49 : 0,
			'nombre'		=>	$this->input->post('producto_nombre'),
			'cantidad_neta'	=>	$this->input->post('producto_cantidad_neta')." ".$this->input->post('um_neta'),
			'cantidad_porcion'	=>	$this->input->post('producto_cantidad_porcion')." ".$this->input->post('um_porcion'),
			'precio'		=>	$this->input->post('producto_precio'),
			'moneda'		=>	$this->input->post('producto_moneda'),
			'fecha'			=>	date("Y-m-d H:i:s"),
			'tipo'			=>	($this->input->post('um_porcion')=='g') ? 'solido' : 'liquido',
			'ingredientes'	=>	$this->input->post('producto_ingredientes'),
			'comentarios'	=>	$this->input->post('producto_comentarios'),
			'reclamaciones'	=>	$this->input->post('producto_reclamaciones'),
			'upc'			=>	$this->input->post('producto_upc'),
		);

		foreach ($_POST as $campo => $valor) {
			echo "$campo -> $valor<br>";
			if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
				$valores_productos[$campo] = ($valor!=''? $valor : '0')." ".$_POST['um_'.$campo];
			}
		}
		
		/*Verificación de unidades de energía*/
		if ($this->input->post('um_energia')=="kcal") {
			$valores_productos['energia'] = $this->input->post('energia')." kcal";
			$valores_productos['energia_kj'] = $this->input->post('energia')*4.184." kJ";
		}
		else{
			$valores_productos['energia'] = floatval($valores_productos['energia']) / 4.184." kcal"; 
			$valores_productos['energia_kj'] = $this->input->post('energia')." kJ"; 
		}
		$this->General_model->update('productos_foodmathlab_v3', array('id_prod'=>$id_prod), $valores_productos);
		redirect(base_url('productos_editar/'.encripta($id_prod).'/1'));
		// print_r($valores_productos);
	}

	public function grupos(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array('nombre'=>'asc'), '');
		$grupos_sTrash = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser'], 'nombre<>'=>'Trash'), array(), '');
		$permisos_labs = $this->General_model->get('permisos_labs', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$data = array(
			'grupos'		=> $grupos,
			'grupos_sTrash'	=> $grupos_sTrash,
			'permisos_labs'	=> $permisos_labs,
		);

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Acceso a vista de Laboratorios registrados',
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
			'subtitulo'	=>	'> Labs',
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
		$this->load->view('Productos/productos_grupos_view', $data);
		
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

	public function grupo_editar(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$id_grupo = desencripta($this->uri->segment(2));
		$edicion = $this->uri->segment(3);

		if (isset($_POST['aceptar'])) {
			$valores = array(
				'descripcion'=>	$this->input->post('grupo_descripcion'),
				'nombre'	=>	$this->input->post('grupo_nombre'),
				'tipo'		=>	$this->input->post('grupo_tipo'),
			);
			$this->General_model->update('grupos', array('id_grupo'=>$id_grupo), $valores);
		}

		$grupos = $this->General_model->get('grupos', array('id_grupo'=>$id_grupo), array(), '');
		$data = array(
			'grupos'	=> $grupos,
			'edicion'	=> $edicion,
		);

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Acceso a formulario de edición de un Lab',
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
			'subtitulo'	=>	'> Edición de Labs',
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
		$this->load->view('Productos/editar_grupos_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Productos/productos_js_view');
		$this->load->view('Productos/editar_grupos_js_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function grupo_nuevo(){
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
			'observacion'	=>	'Registro de un nuevo Lab',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		if (isset($_POST['aceptar'])) {
			$valores = array(
				'id_grupo'	=> '',
				'id_usuario'=>	$_SESSION['idUser'],
				'descripcion'=>	$this->input->post('grupo_descripcion'),
				'nombre'	=>	$this->input->post('grupo_nombre'),
				'tipo'		=>	$this->input->post('grupo_tipo'),
			);
			$this->General_model->set('grupos', $valores);
		}

		redirect(base_url('productos_grupos'));
	}

	public function grupo_eliminar(){
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
			'observacion'	=>	'Eliminación de un Lab',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		/*Id del grupo a eliminar*/
		$id_grupo_borrar = desencripta($this->uri->segment(2));
		$id_grupo_trash = 0;

		/*Verificación de la existencia del grupo Trash del usuario*/
		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser'], 'nombre'=>'Trash'), array(), '');
		if ($grupos!=false) {
			$grupo = $grupos->row(0);
			$id_grupo_trash = $grupo->id_grupo;
		}
		else{
			$valores = array(
				'id_grupo'	=> '',
				'id_usuario'=>	$_SESSION['idUser'],
				'descripcion'=>	'Grupo de productos sin clasificación',
				'nombre'	=>	'Trash',
				'tipo'		=>	'Solido',
			);
			$this->General_model->set('grupos', $valores);
			$id_grupo_trash = $this->General_model->index('grupos', 'id_grupo');
		}

		$this->General_model->update('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$id_grupo_borrar), array('id_grupo'=>$id_grupo_trash));

		$this->General_model->delete('grupos', array('id_grupo'	=> $id_grupo_borrar));

		redirect(base_url('productos_grupos'));
	}

	public function nueva_imagen(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$id_prod = desencripta($this->uri->segment(2));
		$edicion = $this->uri->segment(3);

		if (isset($_POST['subir_archivo'])) {
			$config['upload_path']          = './uploads/productos/';
	        $config['allowed_types']        = 'png|gif|jpg|jpeg';
	        //$config['allowed_types']        = "*";
	        $config['max_size']             = 5120;
	        /*
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;
			*/
	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload('userfile'))
	        {
	                $error = array('error' => $this->upload->display_errors());
	                //print_r($error);
	                //$this->load->view('upload_form', $error);
	                redirect(base_url('productos_imagenes/'.encripta($id_prod)."/3"));
	        }
	        else
	        {
	                $data = array('upload_data' => $this->upload->data());
	                //$this->load->view('upload_success', $data);
	                //print_r($data);
	                $filename = $data['upload_data']['file_name'];
	                $valores = array(
	                	'id'		=>	'',
	                	'id_prod' 	=> 	$id_prod,
	                	'nombre_archivo'	=> $filename,
	                	'fecha_archivo'		=> date("Y-m-d H:i:s"),
	                );
	                $this->General_model->set('imagenes', $valores);
					//echo "nombre del archivo: ".$filename; 
	                redirect(base_url('productos_imagenes/'.encripta($id_prod)."/1"));
	        }
		}

		if (isset($_POST['subir_archivo_url'])) {
			
			$formatos = array(".png", ".jpg", ".jpeg", ".gif");
			$url = $this->input->post('url');
			$aceptado = 0;
			foreach ($formatos as $formato) {
				if (strpos($url, $formato)>-1) {
				    $aceptado = 1;
				}
			}

			if ($aceptado==1) {

				$url_array = explode('/', $url);
				$nombre_archivo = $url_array[count($url_array)-1];
				$imagen = file_get_contents($url);
				file_put_contents('./uploads/productos/'.$nombre_archivo, $imagen);

		        $valores = array(
		          	'id'		=>	'',
		            'id_prod' 	=> 	$id_prod,
		            'nombre_archivo'	=> $nombre_archivo,
		            'fecha_archivo'		=> date("Y-m-d H:i:s"),
		        );
		        $this->General_model->set('imagenes', $valores);
				//echo "nombre del archivo: ".$filename; 
		        redirect(base_url('productos_imagenes/'.encripta($id_prod)."/1"));
			}

		}

		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_prod'=>$id_prod), array(), '');
		$imagenes = $this->General_model->get('imagenes', array('id_prod'=>$id_prod), array(), '');

		$data = array(
			'id_prod' 	=>	$id_prod,
			'productos'	=> $productos,
			'imagenes'	=> $imagenes,
			'edicion'	=> $edicion,
		);

		$producto = ($productos!=false)? $productos->row(0) : false ;

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Formulario para agregar imagenes de producto',
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
			'titulo'	=>	$producto->nombre,
			'subtitulo'	=>	'> Agregar imagenes',
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
		$this->load->view('Productos/productos_imagenes_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Productos/productos_imagenes_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function eliminar_imagen(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Registro de actividad en bitácora*/
		$datos = array(
			'id_bitacora'	=>	'',
			'id_usuario'	=>	$_SESSION['idUser'],
			'observacion'	=>	'Eliminación de imagen de producto',
			'fecha'			=>	date("Y-m-d H:i:s"),
			);
		$this->General_model->set('bitacora', $datos);

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		try {
			$imagen = desencripta($this->uri->segment(2));
			$id_prod = $this->uri->segment(3);
			$valores = array(
				'nombre_archivo'	=>	$imagen,
			);
			$this->General_model->delete('imagenes', $valores);
			unlink('./uploads/productos/'.$imagen);
			redirect(base_url('productos_imagenes/').$id_prod.'/2' );
		} catch (Exception $e) {
			redirect(base_url('productos_imagenes/').$id_prod.'/4' );
		}
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
				'titulo'	=>	'Productos',
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

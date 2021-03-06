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
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'lipidos',
				'etiqueta'	=>	'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'acidosgs',
				'etiqueta'	=>	'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'sal',
				'etiqueta'	=>	'Sal',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'sodio',
				'etiqueta'	=>	'Sodio',
				'unidad'	=>	array('mg'),
			),
			
			array(
				'atributo'	=>	'hidratos',
				'etiqueta'	=>	'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'azucaresa',
				'etiqueta'	=>	'Azucares <small><br>(Azucares añadidos)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'proteina',
				'etiqueta'	=>	'Proteinas <small><br>(Proteinas totales)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'acidosgm',
				'etiqueta'	=>	'Grasas monoinsaturadas <small>(Ácidos gm)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'acidosgp',
				'etiqueta'	=>	'Grasas poliinsaturadas <small>(Ácidos gp)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'acidostrans',
				'etiqueta'	=>	'Grasas Trans <small><br>(Ácidos grasos trans)</small>',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'fibra',
				'etiqueta'	=>	'Fibra <small><br>(Fibra dietética)</small>',
				'unidad'	=>	array('g'),
			),
			
			array(
				'atributo'	=>	'colesterol',
				'etiqueta'	=>	'Colesterol',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'vitaa',
				'etiqueta'	=>	'Vitamina A',
				'unidad'	=>	array('g'),
			),
			array(
				'atributo'	=>	'acidoascord',
				'etiqueta'	=>	'Vitamina C',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'tiamina',
				'etiqueta'	=>	'Tiamina',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'riboflavina',
				'etiqueta'	=>	'Robifavlina',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'acidopanto',
				'etiqueta'	=>	'Ácidos Pantotenico',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'vitad',
				'etiqueta'	=>	'Vitamina D',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'niacina',
				'etiqueta'	=>	'Niacina',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'piridoxina',
				'etiqueta'	=>	'Piridoxina',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'acidofolico',
				'etiqueta'	=>	'Ácidos fólico',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'cobalamina',
				'etiqueta'	=>	'Cobalamina',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'vitaminae',
				'etiqueta'	=>	'Vitamina E',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'tocoferol',
				'etiqueta'	=>	'Tocoferol',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'vitak',
				'etiqueta'	=>	'Vitamina K',
				'unidad'	=>	array('mcg'),
			),
			array(
				'atributo'	=>	'calcio',
				'etiqueta'	=>	'Calcio',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'fosforo',
				'etiqueta'	=>	'Fosforo',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'hierro',
				'etiqueta'	=>	'Hierro',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'magnesio',
				'etiqueta'	=>	'Magnesio',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'potasio',
				'etiqueta'	=>	'Potasio',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'zinc',
				'etiqueta'	=>	'Zinc',
				'unidad'	=>	array('mg'),
			),
			array(
				'atributo'	=>	'acidolino',
				'etiqueta'	=>	'Ácido Linoleico',
				'unidad'	=>	array('g'),
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
		$marcas = $this->General_model->get('marcas', array(), array('marca'=>'asc'), 'marca');
		//$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
		$campos = $this->campos;

		

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$data = array(
			'marcas'	=>	$marcas,
			//'categorias'=>	$categorias,
			'campos'	=>	$campos,
			'grupos'	=>	$grupos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'',
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

		$valores_productos = array(
			'id_prod'		=>	'',
			'id_user'		=>	$this->session->idUser,
			'id_grupo'		=>	$this->input->post('producto_grupo'),
			'id_categoria'	=>  ($this->input->post('producto_categoria')=='si')? 49 : 0,
			'nombre'		=>	$this->input->p0ost('producto_nombre'),
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
		$this->General_model->set('productos_foodmathlab_v2', $valores_productos);
		redirect(base_url('productos_registrados'));
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
		$productos = $this->General_model->get('productos_grupos', array('id_user'=>$_SESSION['idUser']), array(), '');
		$data = array(
			'productos'	=>	$productos,
			'imagenes'	=>	$imagenes,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'',
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

		$this->load->helper('Etiquetado_helper');

		/*Consultas generales*/
		$id_producto = $this->input->post('id');
		$lab = ($this->input->post('lab')!==false)? $this->input->post('lab') : false ;
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$valores_referencia = array(
			'ref_energia' 		=>2000,
			'ref_grasas_tot' 	=> 70,
			'ref_grasas_sat' 	=> 20,
			'ref_azucares' 		=> 90,
			'ref_sodio' 		=> 2400,
			'ref_hidratos' 		=> 260,
			'ref_fibra' 		=> 30,
			'ref_proteina' 		=> 50,
		);

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$campos = $this->campos;
		
		$productos_energia = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('energia'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('energia'=>'asc'), '');

		$productos_lipidos = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('lipidos'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('lipidos'=>'asc'), '');

		$productos_azucares = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('azucaresa'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('azucaresa'=>'asc'), '');

		$productos_grasasSat = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('acidosgs'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('acidosgs'=>'asc'), '');

		$productos_grasasTrans = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('acidostrans'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('acidostrans'=>'asc'), '');

		$productos_sodio = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array('sodio'=>'asc'), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array('sodio'=>'asc'), '');

		$productos_indices = ($lab!=false)? $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser'], 'id_grupo'=>$lab), array(), '') : $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');

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

		$data = array(
			'producto'	=>	$producto,
			'referencia'=>	$valores_referencia,
			'campos'	=>	$campos,
			'grupos'	=>	$grupos,
			'productos_energia'	=>	$productos_energia,
			'productos_lipidos'	=>	$productos_lipidos,
			'productos_azucares'=>	$productos_azucares,
			'productos_grasasSat'=>	$productos_grasasSat,
			'productos_grasasTrans'=>$productos_grasasTrans,
			'productos_sodio'	=>	$productos_sodio,
			'productos_indices'	=>	$productos_indices,
			'campos_productos_indices' => $campos_productos_indices,
		);

		$this->load->view('Productos/descripcion_producto_view', $data);
		$this->load->view('Productos/descripcion_producto_charts_view', $data);
		$this->load->view('Productos/descripcion_producto_nrf93_js_view', $data);
		$this->load->view('Productos/descripcion_producto_sainlim_js_view', $data);
		$this->load->view('Productos/descripcion_producto_sens_js_view', $data);
		//$this->load->view('Productos/descripcion_producto_ff_js_view', $data);
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

			/*Configuración de la vista*/
			$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
			$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
			$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
			$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

			$config = array(
				'titulo'	=>	'Productos',
				'subtitulo'	=>	'Edición',
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

	public function actualizar(){

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Productos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		$id_prod = desencripta($this->input->post('producto_id'));

		$valores_productos = array(
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
			'upc'			=>	$this->input->post('producto_upc'),
		);
		//print_r($valores_productos);

		foreach ($_POST as $campo => $valor) {
			echo "$campo -> $valor<br>";
			if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
				$valores_productos[$campo] = $valor;
			}
		}
		
		/*Verificación de unidades de energía*/
		if ($this->input->post('um_energia')=="kcal") {
			$valores_productos['energia'] = $this->input->post('energia');
			$valores_productos['energia_kj'] = $this->input->post('energia')*4.184;
		}
		else{
			$valores_productos['energia'] = floatval($valores_productos['energia']) / 4.184; 
			$valores_productos['energia_kj'] = $this->input->post('energia'); 
		}
		$this->General_model->update('productos_foodmathlab_v2', array('id_prod'=>$id_prod), $valores_productos);
		redirect(base_url('productos_editar/'.encripta($id_prod).'/1'));
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
		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$data = array(
			'grupos'	=> $grupos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'Labs',
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

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Productos',
			'subtitulo'	=>	'Grupos',
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

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	$producto->nombre,
			'subtitulo'	=>	'Agregar imagenes',
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
}

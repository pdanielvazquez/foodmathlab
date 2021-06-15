<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		$this->load->library('session');
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
		$categorias = $this->General_model->get('categorias', array(), array('categoria'=>'asc'), 'categoria');
		$campos = array(
			array(
				'atributo'	=>	'energia',
				'etiqueta'	=>	'Contenido energético <small>(Energía, calorias)</small>',
				'unidad'	=>	'kcal',
			),
			array(
				'atributo'	=>	'calograsas',
				'etiqueta'	=>	'Calorias de grasa <small>(Energía de grasa)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'lipidos',
				'etiqueta'	=>	'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'acidosgs',
				'etiqueta'	=>	'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'sodio',
				'etiqueta'	=>	'Sodio <small><br>(Sal, Na)</small>',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'hidratos',
				'etiqueta'	=>	'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'azucaresa',
				'etiqueta'	=>	'Azucares <small><br>(Azucares añadidos)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'proteina',
				'etiqueta'	=>	'Proteinas <small><br>(Proteinas totales)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'acidosgm',
				'etiqueta'	=>	'Grasas monoinsaturadas <small>(Ácidos gm)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'acidosgp',
				'etiqueta'	=>	'Grasas poliinsaturadas <small>(Ácidos gp)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'acidostrans',
				'etiqueta'	=>	'Grasas Trans <small><br>(Ácidos grasos trans)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'fibra',
				'etiqueta'	=>	'Fibra <small><br>(Fibra dietética)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'fruta',
				'etiqueta'	=>	'Fruta <small><br>(Cantidad de fruta)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'verdura',
				'etiqueta'	=>	'Verdura <small><br>(Cantidad de verdura)</small>',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'colesterol',
				'etiqueta'	=>	'Colesterol',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'vitaa',
				'etiqueta'	=>	'Vitamina A',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'acidoascord',
				'etiqueta'	=>	'Vitamina C',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'tiamina',
				'etiqueta'	=>	'Tiamina',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'riboflavina',
				'etiqueta'	=>	'Robifavlina',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'acidopanto',
				'etiqueta'	=>	'Ácidos Pantotenico',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'vitad',
				'etiqueta'	=>	'Vitamina D',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'niacina',
				'etiqueta'	=>	'Niacina',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'piridoxina',
				'etiqueta'	=>	'Piridoxina',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'acidofolico',
				'etiqueta'	=>	'Ácidos fólico',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'cobalamina',
				'etiqueta'	=>	'Cobalamina',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'vitaminae',
				'etiqueta'	=>	'Vitamina E',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'tocoferol',
				'etiqueta'	=>	'Tocoferol',
				'unidad'	=>	'',
			),
			array(
				'atributo'	=>	'vitak',
				'etiqueta'	=>	'Vitak',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'calcio',
				'etiqueta'	=>	'Calcio',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'fosforo',
				'etiqueta'	=>	'Fosforo',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'hierro',
				'etiqueta'	=>	'Hierro',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'magnesio',
				'etiqueta'	=>	'Magnesio',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'potasio',
				'etiqueta'	=>	'Potasio',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'zinc',
				'etiqueta'	=>	'Zinc',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'acidolino',
				'etiqueta'	=>	'Ácido Linoleico',
				'unidad'	=>	'mg',
			),
		);

		

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');

		$data = array(
			'marcas'	=>	$marcas,
			'categorias'=>	$categorias,
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
			'id_categoria'	=>	$this->input->post('producto_categoria'),
			'nombre'		=>	$this->input->post('producto_nombre'),
			'cantidad_neta'	=>	$this->input->post('producto_cantidad_neta'),
			'cantidad_porcion'	=>	$this->input->post('producto_cantidad_porcion'),
			'fecha'			=>	date("Y-m-d H:i:s"),
			'tipo'			=>	($this->input->post('um_porcion')=='g') ? 'solido' : 'liquido',
		);
		//print_r($valores_productos);

		foreach ($_POST as $campo => $valor) {
			if ((strpos($campo, 'producto_')<-1) && (strpos($campo, 'um_')<-1)) {
				switch($this->input->post('um_'.$campo)){
					case 'mg':
						$valor = $valor/1000;
						break;
					case 'mcg':
						$valor = $valor/1000000;
						break;
				}
				$valores_productos[$campo] = $valor;
			}
		}
		print_r($valores_productos);
		$this->General_model->set('productos_foodmathlab', $valores_productos);
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
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser']), array(), '');
		$imagenes = $this->General_model->get('productos_imagenes', array('id_user'=>$_SESSION['idUser']), array(), '');
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
		$this->General_model->delete('productos_foodmathlab', $valores);

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

		/*Consultas generales*/
		$id_producto = $this->input->post('id');
		$productos = $this->General_model->get('productos_foodmathlab', array('id_prod'=>$id_producto), array(), '');
		$producto = ($productos!=false) ? $productos->row(0) : false;

		$campos = array(
			'Contenido energético <small>(Energía, calorias)</small>'=>'energia', 
			'Calorias de grasa <small>(Energía de grasa)</small>'=>'calograsas', 
			'Grasas totales <small>(Grasa total, lípidos, grasa, grasas totales)</small>'=>'lipidos', 
			'Grasas saturadas <small>(Grasa sat, ácidos grasos saturados)</small>'=>'acidosgs', 
			'Sodio <small><br>(Sal, Na)</small>'=>'sodio', 
			'Carbohidratos <small>(Carbohidratos totales, Hidratos de carbono)</small>'=>'hidratos', 
			'Azucares <small><br>(Azucares añadidos)</small>'=>'azucaresa', 
			'Proteinas <small><br>(Proteinas totales)</small>'=>'proteina', 
			'Grasas monoinsaturadas <small>(Ácidos gm)</small>'=>'acidosgm', 
			'Grasas poliinsaturadas <small>(Ácidos gp)</small>'=>'acidosgp', 
			'Grasas Trans <small><br>(Ácidos grasos trans)</small>'=>'acidostrans', 
			'Fibra <small><br>(Fibra dietética)</small>'=>'fibra', 
			'Colesterol'=>'colesterol', 
			'Vitamina A'=>'vitaa', 
			'Ácidos Ascord'=>'acidoascord', 
			'Tiamina'=>'tiamina', 
			'Robifavlina'=>'riboflavina', 
			'Ácidos Pantotenico'=>'acidopanto', 
			'Vitamina D'=>'vitad', 
			'Niacina'=>'niacina', 
			'Piridoxina'=>'piridoxina', 
			'Ácidos fólico'=>'acidofolico', 
			'Cobalamina'=>'cobalamina', 
			'Vitamina E'=>'vitaminae', 
			'Tocoferol'=>'tocoferol', 
			'Vitak'=>'vitak', 
			'Calcio'=>'calcio', 
			'Fosforo'=>'fosforo', 
			'Hierro'=>'hierro', 
			'Magnesio'=>'magnesio', 
			'Potasio'=>'potasio', 
			'Zinc'=>'zinc', 
			'Ácido Linoleico'=>'acidolino'
		);

		$data = array(
			'producto'	=>	$producto,
			'campos'	=>	$campos,
		);

		$this->load->view('Productos/descripcion_producto_view', $data);
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
		$id_grupo = $this->uri->segment(2);

		$valores = array(
			'id_grupo'	=> desencripta($id_grupo),
		);
		$this->General_model->delete('grupos', $valores);

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

		if (isset($_POST['subir_archivo'])) {
			$config['upload_path']          = './uploads/productos/';
	        $config['allowed_types']        = 'png|gif|jpg|jpeg';
	        //$config['allowed_types']        = "*";
	        $config['max_size']             = 2048;
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
	                redirect(base_url('productos_imagenes/'.encripta($id_prod)."/2"));
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

		$productos = $this->General_model->get('productos_foodmathlab', array('id_prod'=>$id_prod), array(), '');
		$imagenes = $this->General_model->get('imagenes', array('id_prod'=>$id_prod), array(), '');

		$data = array(
			'id_prod' 	=>	$id_prod,
			'productos'	=> $productos,
			'imagenes'	=> $imagenes,
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
			redirect(base_url('productos_imagenes/').$id_prod.'/1' );
		} catch (Exception $e) {
			redirect(base_url('productos_imagenes/').$id_prod.'/2' );
		}
	}
}

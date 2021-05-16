<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		$this->load->helper('Estadisticas_helper');
		$this->load->helper('Etiquetado_helper');
		$this->load->helper('SainLim_helper');
		$this->load->helper('NRF93_helper');
		$this->load->library('session');
	}

	public function index(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		$tipo = $this->uri->segment(2);

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser'], 'tipo'=>$tipo), array(), '');

		$campos = array(
			'Energía'			=> 	array('campo'=>'energia'), 
			'Azucares'			=>	array('campo'=>'azucaresa'), 
			'Grasas saturadas'	=>	array('campo'=>'acidosgs'), 
			'Grasas trans'		=>	array('campo'=>'acidostrans'), 
			'Grasa total'		=>	array('campo'=>'lipidos'), 
			'Sodio'				=>	array('campo'=>'sodio'), 
			'Hidratos'			=>	array('campo'=>'hidratos'), 
			'Fibra'				=>	array('campo'=>'fibra'), 
			'Proteinas'			=>	array('campo'=>'proteina'),
			'Fruta'				=>	array('campo'=>'fruta'),
			'Verdura'			=>	array('campo'=>'verdura'),
			'Calcio'			=>	array('campo'=>'calcio'),
		);

		foreach ($campos as $cve => $val) {
			$stats = new Estadisticas($productos, $val['campo']);
			$campos[$cve]['media'] 	= $stats->getMedia();
		    $campos[$cve]['de'] 	= $stats->getDE();
		    $campos[$cve]['moda'] 	= $stats->getModa();
		    $campos[$cve]['mediana'] = $stats->getMediana();
		    $campos[$cve]['minimo'] = $stats->getMinimo();
		    $campos[$cve]['maximo'] = $stats->getMaximo();
		    unset($stats);
		}

		$campos_hidden = array(
			'proteinas'			=> 	array('campo'=>'proteinas'), 
			'fibras'			=>	array('campo'=>'fibra'), 
			'vitamina_C'		=>	array('campo'=>'acidoascord'), 
			'vitamina_E'		=>	array('campo'=>'vitaminae'), 
			'vitamina_B1'		=>	array('campo'=>'tiamina'), 
			'vitamina_B2'		=>	array('campo'=>'riboflavina'), 
			/*'vitamina_B6'		=>	array('campo'=>'hidratos'), */
			/*'vitamina_B9'		=>	array('campo'=>'folatos'), */
			'calcio'			=>	array('campo'=>'calcio'),
			'hierro'			=>	array('campo'=>'hierro'),
			'magnesio'			=>	array('campo'=>'magnesio'),
			'zinc'				=>	array('campo'=>'zinc'),
			'potasio'			=>	array('campo'=>'potasio'),
			'acido_linoleico'	=>	array('campo'=>'acidolino'),
			/*'dha'				=>	array('campo'=>'dha'),*/
			'sodio'				=>	array('campo'=>'sodio'), 
			'energia'			=>	array('campo'=>'energia'), 
			'grasas_sat'		=>	array('campo'=>'acidosgs'), 
			'grasas_tot'		=>	array('campo'=>'lipidos'), 
			'azucares'			=>	array('campo'=>'azucaresa'), 
		);

		foreach ($campos_hidden as $cve => $val) {
			$stats = new Estadisticas($productos, $val['campo']);
			$campos_hidden[$cve]['media'] 	= $stats->getMedia();
		    unset($stats);
		}

		$data = array(
			'productos'		=>	$productos,
			'campos'		=>	$campos,
			'indices'		=>	$campos_hidden,
			'ingredientes'	=>	$ingredientes,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Reportes',
			'subtitulo'	=>	$tipo,
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
		$this->load->view('Reportes/resumen_v2_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Reportes/resumen_js_view');
		$this->load->view('Reportes/scatter_js_view');
		$this->load->view('Reportes/nrf93_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function grupos(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas*/

		$grupos = $this->General_model->get('grupos', array('id_usuario'=>$_SESSION['idUser']), array(), '');
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser']), array(), '');

		$campos = array(
			'energia'			=> 	array('etiqueta'=>'Energía'), 
			'azucaresa'			=>	array('etiqueta'=>'Azucares'), 
			'acidosgs'			=>	array('etiqueta'=>'Grasas saturadas'), 
			'acidostrans'		=>	array('etiqueta'=>'Grasas trans'), 
			'lipidos'			=>	array('etiqueta'=>'Grasa total'), 
			'sodio'				=>	array('etiqueta'=>'Sodio'), 
		);

		$atributos = array(
			'energia'			=> 	array('etiqueta'=>'Energía'), 
			'azucaresa'			=>	array('etiqueta'=>'Azucares'), 
			'acidosgs'			=>	array('etiqueta'=>'Grasas saturadas'), 
			'acidostrans'		=>	array('etiqueta'=>'Grasas trans'), 
			'lipidos'			=>	array('etiqueta'=>'Grasa total'), 
			'sodio'				=>	array('etiqueta'=>'Sodio'), 
		);


		$data = array(
			'grupos'	=>	$grupos,
			'productos'	=>	$productos,
			'campos'	=>	$campos,
			'atributos'	=>	$atributos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Reportes',
			'subtitulo'	=>	$tipo,
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
		$this->load->view('Reportes/grupos_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Reportes/resumen_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');

	}

	public function tipos(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Consultas generales*/
		$productos_solidos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser'], 'tipo'=>'solido'), array(), '');

		$productos_liquidos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser'], 'tipo'=>'liquido'), array(), '');

		$campos_solidos = array(
			'Energía'			=> 	array('campo'=>'energia'), 
			'Azucares'			=>	array('campo'=>'azucaresa'), 
			'Grasas saturadas'	=>	array('campo'=>'acidosgs'), 
			'Grasas trans'		=>	array('campo'=>'acidostrans'), 
			'Grasa total'		=>	array('campo'=>'lipidos'), 
			'Sodio'				=>	array('campo'=>'sodio'), 
			'Hidratos'			=>	array('campo'=>'hidratos'), 
			'Fibra'				=>	array('campo'=>'fibra'), 
			'Proteinas'			=>	array('campo'=>'proteina'),
			'Fruta'				=>	array('campo'=>'fruta'),
			'Verdura'			=>	array('campo'=>'verdura'),
			'Calcio'			=>	array('campo'=>'calcio'),
		);

		$campos_liquidos = array(
			'Energía'			=> 	array('campo'=>'energia'), 
			'Azucares'			=>	array('campo'=>'azucaresa'), 
			'Grasas saturadas'	=>	array('campo'=>'acidosgs'), 
			'Grasas trans'		=>	array('campo'=>'acidostrans'), 
			'Grasa total'		=>	array('campo'=>'lipidos'), 
			'Sodio'				=>	array('campo'=>'sodio'), 
			'Hidratos'			=>	array('campo'=>'hidratos'), 
			'Fibra'				=>	array('campo'=>'fibra'), 
			'Proteinas'			=>	array('campo'=>'proteina'),
			'Fruta'				=>	array('campo'=>'fruta'),
			'Verdura'			=>	array('campo'=>'verdura'),
			'Calcio'			=>	array('campo'=>'calcio'),
		);

		foreach ($campos_solidos as $cve => $val) {
			$stats = new Estadisticas($productos_solidos, $val['campo']);
			$campos_solidos[$cve]['media'] 	= $stats->getMedia();
		    $campos_solidos[$cve]['de'] 	= $stats->getDE();
		    $campos_solidos[$cve]['moda'] 	= $stats->getModa();
		    $campos_solidos[$cve]['mediana'] = $stats->getMediana();
		    $campos_solidos[$cve]['minimo'] = $stats->getMinimo();
		    $campos_solidos[$cve]['maximo'] = $stats->getMaximo();
		    unset($stats);
		}

		foreach ($campos_liquidos as $cve => $val) {
			$stats = new Estadisticas($productos_liquidos, $val['campo']);
			$campos_liquidos[$cve]['media'] 	= $stats->getMedia();
		    $campos_liquidos[$cve]['de'] 	= $stats->getDE();
		    $campos_liquidos[$cve]['moda'] 	= $stats->getModa();
		    $campos_liquidos[$cve]['mediana'] = $stats->getMediana();
		    $campos_liquidos[$cve]['minimo'] = $stats->getMinimo();
		    $campos_liquidos[$cve]['maximo'] = $stats->getMaximo();
		    unset($stats);
		}

		$campos_solidos_hidden = array(
			'proteinas'			=> 	array('campo'=>'proteinas'), 
			'fibras'			=>	array('campo'=>'fibra'), 
			'vitamina_C'		=>	array('campo'=>'acidoascord'), 
			'vitamina_E'		=>	array('campo'=>'vitaminae'), 
			'vitamina_B1'		=>	array('campo'=>'tiamina'), 
			'vitamina_B2'		=>	array('campo'=>'riboflavina'), 
			/*'vitamina_B6'		=>	array('campo'=>'hidratos'), */
			/*'vitamina_B9'		=>	array('campo'=>'folatos'), */
			'calcio'			=>	array('campo'=>'calcio'),
			'hierro'			=>	array('campo'=>'hierro'),
			'magnesio'			=>	array('campo'=>'magnesio'),
			'zinc'				=>	array('campo'=>'zinc'),
			'potasio'			=>	array('campo'=>'potasio'),
			'acido_linoleico'	=>	array('campo'=>'acidolino'),
			/*'dha'				=>	array('campo'=>'dha'),*/
			'sodio'				=>	array('campo'=>'sodio'), 
			'energia'			=>	array('campo'=>'energia'), 
			'grasas_sat'		=>	array('campo'=>'acidosgs'), 
			'grasas_tot'		=>	array('campo'=>'lipidos'), 
			'azucares'			=>	array('campo'=>'azucaresa'), 
		);

		$campos_liquidos_hidden = array(
			'proteinas'			=> 	array('campo'=>'proteinas'), 
			'fibras'			=>	array('campo'=>'fibra'), 
			'vitamina_C'		=>	array('campo'=>'acidoascord'), 
			'vitamina_E'		=>	array('campo'=>'vitaminae'), 
			'vitamina_B1'		=>	array('campo'=>'tiamina'), 
			'vitamina_B2'		=>	array('campo'=>'riboflavina'), 
			/*'vitamina_B6'		=>	array('campo'=>'hidratos'), */
			/*'vitamina_B9'		=>	array('campo'=>'folatos'), */
			'calcio'			=>	array('campo'=>'calcio'),
			'hierro'			=>	array('campo'=>'hierro'),
			'magnesio'			=>	array('campo'=>'magnesio'),
			'zinc'				=>	array('campo'=>'zinc'),
			'potasio'			=>	array('campo'=>'potasio'),
			'acido_linoleico'	=>	array('campo'=>'acidolino'),
			/*'dha'				=>	array('campo'=>'dha'),*/
			'sodio'				=>	array('campo'=>'sodio'), 
			'energia'			=>	array('campo'=>'energia'), 
			'grasas_sat'		=>	array('campo'=>'acidosgs'), 
			'grasas_tot'		=>	array('campo'=>'lipidos'), 
			'azucares'			=>	array('campo'=>'azucaresa'), 
		);

		foreach ($campos_solidos_hidden as $cve => $val) {
			$stats = new Estadisticas($productos_solidos, $val['campo']);
			$campos_hidden[$cve]['media'] 	= $stats->getMedia();
		    unset($stats);
		}

		foreach ($campos_liquidos_hidden as $cve => $val) {
			$stats = new Estadisticas($productos_liquidos, $val['campo']);
			$campos_hidden[$cve]['media'] 	= $stats->getMedia();
		    unset($stats);
		}

		$data = array(
			'productos_solidos'		=>	$productos_solidos,
			'productos_liquidos'	=>	$productos_liquidos,
			'campos_solidos'		=>	$campos_solidos,
			'campos_liquidos'		=>	$campos_liquidos,
			'indices_solidos'		=>	$campos_solidos_hidden,
			'indices_liquidos'		=>	$campos_liquidos_hidden,
			'ingredientes'			=>	$ingredientes,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('menu_opciones', array('activo'=>1), array(), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Reportes',
			'subtitulo'	=>	$tipo,
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
		$this->load->view('Reportes/tipos_view', $data);

		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Reportes/resumen_js_view');
		$this->load->view('Reportes/bars_js_view');
		$this->load->view('Reportes/scatter_js_view');
		$this->load->view('Reportes/nrf93_js_view');
		$this->load->view('Reportes/tipos_hidden_js_view');

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}
}
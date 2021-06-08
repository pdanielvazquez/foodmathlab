<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Optimizacion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		$this->load->helper('product_helper');
		$this->load->helper('consulta_helper');
		$this->load->helper('quitasellos_helper');
		$this->load->library('session');
	}

	public function index(){
		redirect('agregar_token');
	}

	public function agregar()
	{

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Optimizacion'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/

		$productos = get_products('');
		
		$data = array(
			'productos' => $productos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Optimizacion',
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
		$this->load->view('Optimizacion/agregar_token_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Optimizacion/generals_js_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function guardar(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Optimizacion'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		$info = $_POST;
		/*Invoca función que genera petición*/
		add($info);

	}


	/*Norma Oficial Mexicana 051*/

	public function nom051()
	{

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Sellos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser']), array(), '');
		
		$data = array(
			'productos'	=>	$productos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Optimizacion',
			'subtitulo'	=>	'MEX NOM-051',
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
		$this->load->view('Optimizacion/sellos_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Optimizacion/sellos_js_view', $data);
		$this->load->view('Optimizacion/sellos_datatable_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function nom051Formulas(){
		$tipo			=	$this->input->post("tipo");
		$Optional_Dec 	= 	0.1;
		$CHO 			=	$this->input->post("CHO");
		$Azucar 		= 	$this->input->post("A");
		$GT 			=	$this->input->post("GT");
		$GTRANS 		=	$this->input->post("GTRANS");
		$GSAT 			=	$this->input->post("GSAT");
		$Proteina 		=	$this->input->post("P");
		$Sodio 			=	$this->input->post("Sodio");
		$Fibra 			=	$this->input->post("F");
		$texto 			= 	'';

		if ( $tipo == "azucar")
		  {
		  	try {
			    list($Energia,$CantEnergia,$CantGrasaTRans,$CantGrasaSat,$Azucar)= QuitaSelloAzucar($GT,$GTRANS,$GSAT,$CHO,$Azucar,$Proteina,$Fibra,$Optional_Dec);
			    $texto = "El valor del Azucar para quitar el sello es: $Azucar";
		  	} catch (Exception $e) {
		  		$texto = "No fue posible eliminar el sello del Azucar";
		  	}
		}
		elseif( $tipo == "grasa") 
		{
			try {
			    list($Energia, $CantEnergia,$CantGrasaTrans,$GSAT,$GT) = QuitaSelloGrasaSat($GT,$GTRANS,$GSAT,$CHO,$Proteina,$Fibra,$Optional_Dec);
				$texto = "El valor de Grasa Saturada para quitar el sello es: $GSAT";
			} catch (Exception $e) {
				$texto = "No fue posible eliminar el sello de la Grasa Saturada";
			}
		}
		elseif( $tipo == "sodio")
		{
			try {
			    $S = QuitaSelloSodio($GT,$GSAT,$GTRANS,$CHO, $Sodio,$Proteina, $Fibra,$Optional_Dec);
			    // echo "La cantidad de Sodio para quitar el sello es: $S";
			    $texto = "El valor de Sodio para quitar el sello es: $S";
				
			} catch (Exception $e) {
				$texto = "No fue posible eliminar el sello del Sodio";
			}
		}
		elseif( $tipo == "energia")
		{
			try {
			  	list($GT,$A,$E)=QuitaSelloEnergia($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec);
			   	$texto =  "El valor de Grasa Total es: $GT, <br>El valor del Azucar es: $A <br>Energía para quitar el sello es: $E";
			} catch (Exception $e) {
				$texto = "No fue posible eliminar el sello de la Energía";
			}
		}
		echo $texto;
	}

	/*FR Nutri Score*/

	public function nutriscore()
	{

		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Sellos'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab', array('id_user'=>$_SESSION['idUser']), array(), '');
		
		$data = array(
			'productos'	=>	$productos,
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Optimizacion',
			'subtitulo'	=>	'FR Nutri Score',
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
		$this->load->view('Optimizacion/nutriscore_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Optimizacion/sellos_js_view', $data);
		$this->load->view('Optimizacion/nutriscore_datatable_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}
}
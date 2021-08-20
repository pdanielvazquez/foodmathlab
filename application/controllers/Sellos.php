<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sellos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('General_model');
		$this->load->helper('Input_helper');
		$this->load->helper('Mi_helper');
		//$this->load->helper('quitasellos_helper');
		$this->load->helper('quitasellos_ver2_helper');
		$this->load->library('session');
	}

	public function index(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}
		redirect('sellos');
	}

	public function quitar()
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
		
		$data = array(
			
		);

		/*Configuración de la vista*/
		$menu = $this->General_model->get('permisos_usuarios', array('activo'=>1, 'id_usuario'=>$_SESSION['idUser']), array('orden'=>'asc'), '');
		$submenu = $this->General_model->get('submenu_opciones', array('activo_submenu'=>1), array(), '');
		$usuarios = $this->General_model->get('usuarios', array('id_user'=>$this->session->idUser), array(), '');
		$usuario = ($usuarios!=false)? $usuarios->row(0) : false ;

		$config = array(
			'titulo'	=>	'Sellos',
			'subtitulo'	=>	'Quitar',
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
		$this->load->view('Sellos/sellos_view', $data);
		
		$this->load->view('Plantillas/content_wraper_close_view');
		$this->load->view('Plantillas/footer_view');
		$this->load->view('Plantillas/wraper_close_view');
		$this->load->view('Plantillas/scripts_view');

		/*Script de configuracion de datatable*/
		$this->load->view('Sellos/sellos_js_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function formulas(){
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
		$GOTRAS 		=	$this->input´->post("GOTRAS");
		$texto 			= 	'';

		if ( $tipo == "azucar")
		  {
		    list($Energia,$CantEnergia,$CantGrasaTRans,$CantGrasaSat,$Azucar)= QuitaSelloAzucar($GT,$GTRANS,$GSAT,$CHO,$Azucar,$Proteina,$Fibra,$Optional_Dec);
		    $texto = "El valor del Azucar para quitar el sello es: $Azucar";
		}
		elseif( $tipo == "grasa") 
		{
		    list($Energia, $CantEnergia,$CantGrasaTrans,$GSAT,$GT) = QuitaSelloGrasaSat($GT,$GTRANS,$GSAT,$CHO,$Proteina,$Fibra,$Optional_Dec);
			$texto = "El valor de Grasa Saturada para quitar el sello es: $GSAT";
		}
		elseif( $tipo == "sodio")
		{
		    $S = QuitaSelloSodio($GT,$GSAT,$GTRANS,$CHO, $Sodio,$Proteina, $Fibra,$Optional_Dec);
		    // echo "La cantidad de Sodio para quitar el sello es: $S";
		    $texto = "El valor de Sodio para quitar el sello es: $S";
		}
		elseif( $tipo == "energia")
		{
		  	list($GT,$A,$E)=QuitaSelloEnergia($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec);
		   	$texto =  "El valor de Grasa Total es: $GT, <br>El valor del Azucar es: $A <br>Energía para quitar el sello es: $E";
		}
		echo $texto;
	}

	public function formulas_ver2(){
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
		$GOTRAS 		=	$this->input´->post("GOTRAS");
		$texto 			= 	'';
	}

	switch ($tipo) {
		case 'azucar':
			$A= QuitaSelloAzucar($GT,$GTRANS,$GSAT,$CHO,$Azucar,$Proteina,$Fibra,$Optional_Dec, $Sodio);
			break;
		case 'grasa':
			list($GSAT,$GTRANS) = QuitaSelloGrasaSat($Azucar,$GT,$GTRANS,$GSAT,$CHO,$Proteina,$Fibra,$Optional_Dec,$Sodio);
			break;
		case 'sodio':
			$S = QuitaSelloSodio($GT,$GSAT,$GTRANS,$CHO, $Sodio,$Proteina, $Fibra,$Optional_Dec);
			break;
		case 'energia':
			$E=QuitaSelloEnergia($GT,$GTRANS,$GSAT, $CHO,$Azucar, $Proteina,$Fibra,$Optional_Dec);
			break;
	}

}

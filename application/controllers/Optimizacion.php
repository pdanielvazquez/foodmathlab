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
		redirect('nom051');
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

		$this->load->helper('Etiquetado_helper');

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');
		
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
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_user'=>$_SESSION['idUser']), array(), '');

		/*Campos a recopilar*/

		$campos_max_values = array(
			array(
				'atributo'	=>	'azucar_max',
				'etiqueta'	=>	'Azucar',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'grasasSat_max',
				'etiqueta'	=>	'Grasas saturadas',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'sodio_max',
				'etiqueta'	=>	'Sodio',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'fv_max',
				'etiqueta'	=>	'Frutas y verduras',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'fibra_max',
				'etiqueta'	=>	'Fibra',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'proteina_max',
				'etiqueta'	=>	'Proteina',
				'unidad'	=>	'g',
			),
		);

		$campos_min_values = array(
			array(
				'atributo'	=>	'azucar_min',
				'etiqueta'	=>	'Azucar',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'grasasSat_min',
				'etiqueta'	=>	'Grasas saturadas',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'sodio_min',
				'etiqueta'	=>	'Sodio',
				'unidad'	=>	'mg',
			),
			array(
				'atributo'	=>	'fv_min',
				'etiqueta'	=>	'Frutas y verduras',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'fibra_min',
				'etiqueta'	=>	'Fibra',
				'unidad'	=>	'g',
			),
			array(
				'atributo'	=>	'proteina_min',
				'etiqueta'	=>	'Proteina',
				'unidad'	=>	'g',
			),
		);

		$campos_bloqueados = array(
			array(
				'atributo'	=>	'azucar_bloq',
				'etiqueta'	=>	'Azucar',
				'unidad'	=>	false,
			),
			array(
				'atributo'	=>	'grasasSat_bloq',
				'etiqueta'	=>	'Grasas saturadas',
				'unidad'	=>	false,
			),
			array(
				'atributo'	=>	'sodio_bloq',
				'etiqueta'	=>	'Sodio',
				'unidad'	=>	false,
			),
			array(
				'atributo'	=>	'fv_bloq',
				'etiqueta'	=>	'Frutas y verduras',
				'unidad'	=>	false,
			),
			array(
				'atributo'	=>	'fibra_bloq',
				'etiqueta'	=>	'Fibra',
				'unidad'	=>	false,
			),
			array(
				'atributo'	=>	'proteina_bloq',
				'etiqueta'	=>	'Proteina',
				'unidad'	=>	false,
			),
		);

		$parametros = array(
			array(
				'atributo'	=>	'param_peso',
				'etiqueta'	=>	'Peso',
				'valor'		=>	0,
			),
			array(
				'atributo'	=>	'param_poblacion',
				'etiqueta'	=>	'Población',
				'valor'		=>	0,
			),
			array(
				'atributo'	=>	'param_reemplazo',
				'etiqueta'	=>	'Reemplazo',
				'valor'		=>	0.5,
			),
			array(
				'atributo'	=>	'param_generaciones',
				'etiqueta'	=>	'Generaciones',
				'valor'		=>	10000,
			),
			array(
				'atributo'	=>	'param_semilla',
				'etiqueta'	=>	'Semilla',
				'valor'		=>	0,
			),
		);
		
		$data = array(
			'productos'	=>	$productos,
			'campos_max_values' => $campos_max_values,
			'campos_min_values' => $campos_min_values,
			'campos_bloqueados' => $campos_bloqueados,
			'parametros'=>	$parametros,
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
		$this->load->view('Optimizacion/nutriscore_js_view', $data);
		$this->load->view('Optimizacion/nutriscore_datatable_view', $data);

		$this->load->view('Plantillas/body_close_view');
		$this->load->view('Plantillas/html_close_view');
	}

	public function token(){
		if (!isset($_SESSION['idUser'])) {
			redirect('App/logout');
		}

		/*Validación de permiso de acceso al método*/
		$permisos_usuarios = $this->General_model->get('permisos_usuarios', array('id_usuario'=>$_SESSION['idUser'], 'opcion'=>'Optimizacion'), array(), '');
		if ($permisos_usuarios==false) {
			redirect('inicio');
		}

		/*Consultas generales*/
		$productos = $this->General_model->get('productos_foodmathlab_v2', array('id_prod'=>$this->input->post('id_prod')), array(), '');

		$producto = ($productos!=false) ? $productos->row(0) : false ;

		if ($producto!=false) {

			//Inicia json a enviar
			$postdata["referenceFood"] = [
				"sugar" 	=> floatval($producto->azucaresa),
		        "carbs" 	=> floatval($producto->hidratos),
		        "totalFat" 	=> floatval($producto->lipidos),
		        "satFat" 	=> floatval($producto->acidosgs),
		        "sodium" 	=> floatval($producto->sodio),
		        "f&v" 		=> floatval($producto->fruta + $producto->verdura),
		        "fiber" 	=> floatval($producto->fibra),
		        "protein" 	=> floatval($producto->proteina),
		        "energy" 	=> floatval($producto->energia)
			];

			//Si maneja maximos valores los agrega al json
			if($this->input->post("azucar_max") != "")
				$postdata["maxValues"]["sugar"] = floatval($this->input->post("azucar_max"));

			if($this->input->post("grasasSat_max") != "")
				$postdata["maxValues"]["satFat"] = floatval($this->input->post("grasasSat_max"));

			if($this->input->post("sodio_max") != "")
				$postdata["maxValues"]["sodium"] = floatval($this->input->post("sodio_max"));

			if($this->input->post("fv_max") != "")
				$postdata["maxValues"]["f&v"] = floatval($this->input->post("fv_max"));

			if($this->input->post("fibra_max") != "")
				$postdata["maxValues"]["fiber"] = floatval($this->input->post("fibra_max"));

			if($this->input->post("proteina_max") != "")
				$postdata["maxValues"]["protein"] = floatval($this->input->post("proteina_max"));

			//Si maneja minimos valores los agrega al json
			if($this->input->post("azucar_min") != "")
				$postdata["minValues"]["sugar"] = floatval($this->input->post("azucar_min"));

			if($this->input->post("grasasSat_min") != "")
				$postdata["minValues"]["satFat"] = floatval($this->input->post("grasasSat_min"));

			if($this->input->post("sodio_min") != "")
				$postdata["minValues"]["sodium"] = floatval($this->input->post("sodio_min"));

			if($this->input->post("fv_min") != "")
				$postdata["minValues"]["f&v"] = floatval($this->input->post("fv_min"));

			if($this->input->post("fibra_min") != "")
				$postdata["minValues"]["fiber"] = floatval($this->input->post("fibra_min"));

			if($this->input->post("proteina_min") != "")
				$postdata["minValues"]["protein"] = floatval($this->input->post("proteina_min"));

			$postdata["lockValues"] = [
				"sugar"		=> $this->input->post("azucar_bloq"),
		        "satFat" 	=> $this->input->post("grasasSat_bloq"),
		        "sodium" 	=> $this->input->post("sodio_bloq"),
		        "f&v" 		=> $this->input->post("fv_bloq"),
		        "fiber" 	=> $this->input->post("fibra_bloq"),
		        "protein" 	=> $this->input->post("proteina_bloq")
			];

			$postdata["params"] = [
				"weightNutriscore" 	=> floatval($this->input->post("param_peso")),
		        "population" 		=> floatval($this->input->post("param_poblacion")),
		        "treplace" 			=> floatval($this->input->post("param_reemplazo")),
		        "generations" 		=> floatval($this->input->post("param_generaciones")),
		        "seed" 				=> floatval($this->input->post("param_semilla")),
			];

			$postdata["foodProperties"] = [
				"cheese"	=> ($producto->id_categoria == 49) ? true : false,
		        "drink" 	=> ($producto->tipo == "liquido") ? true : false,
		        "method" 	=> $this->input->post("metodo"),
			];

			$postdata["forceLetter"] = $this->input->post("forzarLetra");

			//Fin json a enviar

			//Api StartNutriScoreOptimization
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://localhost:5000/StartNutriscoreOptimization",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 300,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($postdata),
				CURLOPT_HTTPHEADER => array(
					"Cache-Control: no-cache",
					"Content-Type: application/json",
				)		
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$response = json_decode($response);

			//Si el API termina correctamente
			if($response->success){

				//Inicia inserts a la base de datos
				
				//Maximos en caso de requerirlos
				$valores_maximos = array(
					"id" 		=>	'',
					"id_prod"	=>	$this->input->post("id"),
					"max_sugar"	=>	$this->input->post("azucar_max"),
					"max_satFat"=>	$this->input->post("grasasSat_max"),
					"max_sodium"=>	$this->input->post("sodio_max"),
					"max_fv"	=>	$this->input->post("fv_max"),
					"max_fiber"	=>	$this->input->post("fibra_max"),
					"max_protein"=>	$this->input->post("proteina_max"),
				);
				$this->General_model->set('valores_maximos', $valores_maximos);

				//Minimos en caso de requerirlos.
				$valores_minimos = array(
					"id" 		=>	'',
					"id_prod"	=>	$this->input->post("id"),
					"min_sugar"	=>	$this->input->post("azucar_min"),
					"min_satFat"=>	$this->input->post("grasasSat_min"),
					"min_sodium"=>	$this->input->post("sodio_min"),
					"min_fv"	=>	$this->input->post("fv_min"),
					"min_fiber"	=>	$this->input->post("fibra_min"),
					"min_protein"=>	$this->input->post("proteina_min"),
				);
				$this->General_model->set('valores_minimos', $valores_minimos);

				$valores_bloqueados = array(
					"id" 			=>	'',
					"id_prod"		=>	$this->input->post("id"),
					"lock_sugar"	=>	$this->input->post("azucar_bloq"),
			        "lock_satFat"	=>	$this->input->post("grasasSat_bloq"),
			        "lock_sodium"	=>	$this->input->post("sodio_bloq"),
			        "lock_fv"		=>	$this->input->post("fv_bloq"),
			        "lock_fiber"	=>	$this->input->post("fibra_bloq"),
			        "lock_protein"	=>	$this->input->post("proteina_bloq"),
					"forceLetter"	=>	$this->input->post("forzarLetra"),
			    );

				$this->General_model->set('valores_bloqueados', $valores_bloqueados);

				$parametros = array(
					"id" 			=>	'',
					"id_prod"		=>	$this->input->post("id"),
					"weightNutriscore"	=>	floatval($this->input->post("param_peso")),
			        "population"		=>	floatval($this->input->post("param_poblacion")),
			        "treplace"			=>	floatval($this->input->post("param_reemplazo")),
			        "generations"		=>	floatval($this->input->post("param_generaciones")),
			        "seed"				=>	floatval($this->input->post("param_semilla")),
			    );

				$this->General_model->set('parametros', $parametros);

				$propiedades = array(
					"cheese"	=>	($producto->id_categoria == 49) ? true : false,
			        "drink"		=>	($producto->tipo == "liquido") ? true : false,
			        "method"	=>	$this->input->post("metodo"),
			    );

				$this->General_model->set('propiedades', $propiedades);
				
				//Se asigna el token al producto y se guarda en la base de datos
				$arrayToken = array(
					"id"		=>	'',
					"token"				=>	$response->token,
					"comment"			=>	"Token inicial",
					"sending_json"		=>	json_encode($postdata),
			    );

				$this->General_model->set('tokens', $arrayToken);

				//Fin inserts a la base de datos

				$id_token = index('tokens', 'id');
				$tokens = $this->General_model->get('tokens', array('id' => $id_token), array(), '');
				$token = ($tokens!=false) ? $tokens->row(0) : false ;
									
				echo ($token!=false)? $token->token : "Error al recuperar el token";
			}
			else{
				echo "Error en la petición";
			}

		}
		else{
			echo "No existe el producto";
		}
	}
}
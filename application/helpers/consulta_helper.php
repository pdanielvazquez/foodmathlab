<?php

class conexion {

	/**
	* Gestiona la conexión con la base de datos local
	*/
	private $dbhost = 'localhost';
	private $dbuser = 'motog';
	private $dbpass = 'otrono10';
	private $dbname = 'foodmathlab';

	/**
	* @return object link_id con la conexión
	*/
	public function load_conexion () {
		$link_id = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
		
		if ($link_id ->connect_error) {
			echo "Error de Connexion ($link_id->connect_errno) $link_id->connect_error\n";
			header('Location: error-conexion.php');
			exit;
		} else {
			$acentos = $link_id->query("SET NAMES 'utf8'");
			return $link_id;
		}
	}

}

class SelectorUniversal {

	/**
	* Realiza una consulta a la BBDD
	* @return array asociativa
	*/
	protected $array;
	protected $tabla;
	protected $clausulas;
	protected $arrayReturn;

	public function __construct($recogeArray, $recogeTabla, $recogeClausulas) {

		$this->array = $recogeArray;
		$this->tabla = $recogeTabla;

		if (isset ($recogeClausulas)) {
			$this->clausulas = $recogeClausulas;
		} else {
			$this->clausulas = "";
		}

	}

	protected function setterConsultaSimple() {

		$conexionSacadatos = new conexion();
		$linkSacadatos = $conexionSacadatos->load_conexion();
		$resultadoArray = $linkSacadatos->query("SELECT * FROM $this->tabla $this->clausulas");

		$i = 0;
		
		while ($row=$resultadoArray->fetch_assoc()) {
			foreach ($this->array as $clave => $valor) {
				$this->arrayReturn[$i][$clave]=$row[$valor];
			}

			$i++;

		}

		$linkSacadatos->close();
		
		return $this->arrayReturn;

	}

	protected function setterConsultaInsertar(){

		$conexionSacadatos = new conexion();
		$linkSacadatos = $conexionSacadatos->load_conexion();

		$columnas = implode(',',array_keys($this->array));
		$values = "'".implode("','", $this->array)."'";
		$consulta = "INSERT INTO $this->tabla ($columnas) VALUES ($values)";

		$resultadoArray = array();

		$linkSacadatos->query($consulta);

		if($linkSacadatos->errno == 0){
			$resultadoArray = array(
					"error" => 0,
					"insert_id" => $linkSacadatos->insert_id
				);
		}else{
			$resultadoArray = array(
					"error" => 1,
					"error" => $linkSacadatos->error,
					"consulta" => $consulta
				);
		}

		$linkSacadatos->close();

		return $resultadoArray;

	}

	protected function setterConsultaUpdate(){

		$conexionSacadatos = new conexion();
		$linkSacadatos = $conexionSacadatos->load_conexion();

		$setsarr = array();
		foreach($this->array as $key => $value){
			$setsarr[] = $key . " = " . $value;
		}
		
		$sets = implode(',',$setsarr);
		$consulta = "UPDATE $this->tabla SET $sets $this->clausulas";

		$resultadoArray = array();

		$linkSacadatos->query($consulta);

		if($linkSacadatos->errno == 0){
			$resultadoArray = array(
					"error" => 0,
				);
		}else{
			$resultadoArray = array(
					"error" => 1,
					"error" => $linkSacadatos->error,
					"consulta" => $consulta
				);
		}

		$linkSacadatos->close();

		return $resultadoArray;

	}

	public function getterConsultaSimple() {
		return $this->setterConsultaSimple();
	}

	public function getterConsultaInsertar()
	{
		return $this->setterConsultaInsertar();
	}

	public function getterConsultaUpdate(){
		return $this->setterConsultaUpdate();
	}

} 
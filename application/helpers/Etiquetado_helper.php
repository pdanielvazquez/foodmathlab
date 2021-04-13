<?php

/**
 * Clase para el etiquetado de productos en Chile
 */
class Etiquetado_chile
{
	private $energia, $sodio, $azucares, $grasas_sat, $tipo;

	function __construct($energia_kcal, $sodio_g, $azucar_g, $grasa_g, $tipo)
	{
		$this->energia 		= $energia_kcal;
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucar_g;
		$this->grasas_sat 	= $grasa_g;
		$this->tipo			= $tipo;
	}

	public function getEnergia(){
		$energia = 0;
		if ($this->tipo == 'solido') {
			if ($this->energia > 275) {
				$energia = 1;
			}
		}
		else if($this->tipo == 'liquido'){
			if ($this->energia > 70) {
				$energia = 1;
			}
		}
		return $energia;
	}

	public function getSodio(){
		$sodio = 0;
		if ($this->tipo == 'solido') {
			if ($this->sodio > 0.4) {
				$sodio = 1;
			}
		}
		else if($this->tipo == 'liquido'){
			if ($this->energia > 0.1) {
				$sodio = 1;
			}
		}
		return $sodio;
	}

	public function getAzucar(){
		$azucar = 0;
		if ($this->tipo == 'solido') {
			if ($this->azucares > 10) {
				$azucar = 1;
			}
		}
		else if($this->tipo == 'liquido'){
			if ($this->azucares > 5) {
				$azucar = 1;
			}
		}
		return $azucar;
	}

	public function getGrasasSat(){
		$grasas_sat = 0;
		if ($this->tipo == 'solido') {
			if ($this->grasas_sat > 4) {
				$grasas_sat = 1;
			}
		}
		else if($this->tipo == 'liquido'){
			if ($this->grasas_sat > 3) {
				$grasas_sat = 1;
			}
		}
		return $grasas_sat;
	}

}
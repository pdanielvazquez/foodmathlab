<?php

/**
 * Clase que calcula las estadisticas generales de un conjunto de datos
 */
class Estadisticas
{
	private $media, $de, $moda, $mediana, $minimo, $maximo, $conjunto;
	
	function __construct($conjunto, $campo)
	{
		$this->media 	= 	0;
		$this->de 		= 	0;
		$this->moda 	=	0;
		$this->mediana	=	0;
		$this->minimo	=	9999999;
		$this->maximo 	=	0;
		$this->conjunto	=	$conjunto; 
		$this->analizar($campo);
	}

	public function analizar($campo){

		/*Si el conjunto tiene datos*/
		if ($this->conjunto!=false) {
			
			/*Variables generales*/
			$datos 		= array();
			$acumulador = 0;
			$tamano 	= count($this->conjunto->result());

			/*Ciclo para recorrer todos los datos*/
			foreach ($this->conjunto->result() as $dato) {
				
				$valor = str_replace('mcg', '', $dato->$campo);
				$valor = str_replace('mg', '', $valor);
				$valor = str_replace('g', '', $valor);
				$valor = str_replace('kcal', '', $valor);
				$valor = str_replace('%', '', $valor);
				$valor = str_replace('ramo', '', $valor);
				$valor = str_replace('NULL', '', $valor);
				$valor = str_replace('INF', '', $valor);
				$valor = str_replace(' ', '', $valor);

				$acumulador	+= $valor;
				array_push($datos, $valor);
				/*Mínimo*/
				if ($valor < $this->minimo)
					$this->minimo = $valor;
				/*Máximo*/
				if ($valor > $this->maximo)
					$this->maximo = $valor;
			}

			/*Media*/
			$media = $acumulador / $tamano;
			$this->media = $media;

			/*Mediana*/
			$mediana = 0;
			sort($datos);
			$middleval = floor(($tamano-1)/2);

			if($tamano % 2) {
				$mediana = $datos[$middleval];
			} 
			else {
				$bajo = $datos[$middleval];
				$alto = $datos[$middleval+1];
				$mediana = (($bajo+$alto)/2);
			}
			$this->mediana = $mediana;

			/*Moda*/
			$cuenta = array_count_values($datos);
		    arsort($cuenta);
		    $this->moda = key($cuenta);

		    /*Desviación estandar*/
		    $this->de = $this->stats_standard_deviation($datos, false);

		}

	}

	public function stats_standard_deviation(array $a, $sample = false) {
	    $n = count($a);
	    if ($n === 0) {
	        /*trigger_error("The array has zero elements", E_USER_WARNING);*/
	        return false;
	    }
	    if ($sample && $n === 1) {
	        /*trigger_error("The array has only 1 element", E_USER_WARNING);*/
	    	return false;
	    }
	    $mean = array_sum($a) / $n;
	    $carry = 0.0;
	    foreach ($a as $val) {
	        $d = ((double) $val) - $mean;
	        $carry += $d * $d;
	    };
	    if ($sample) {
	       --$n;
	    }
	    return sqrt($carry / $n);
	}

	public function getMedia(){
		return $this->media;
	}

	public function getDE(){
		return $this->de;
	}

	public function getModa(){
		return $this->moda;
	}

	public function getMediana(){
		return $this->mediana;
	}

	public function getMinimo(){
		return $this->minimo;
	}

	public function getMaximo(){
		return $this->maximo;
	}
}
<?php

class FullnessFactor
{
	private $energia, $proteinas, $fibra, $lipidos;
	
	function __construct($valores)
	{
		$this->energia 		= (array_key_exists('energia', $valores)) ? $valores['energia'] : 0;
		$this->proteinas 	= (array_key_exists('proteina', $valores)) ? $valores['proteina'] : 0;
		$this->fibras 		= (array_key_exists('fibra', $valores)) ? $valores['fibra'] : 0;
		$this->lipidos 		= (array_key_exists('lipidos', $valores)) ? $valores['lipidos'] : 0;
	}

	public function getFactor(){
		$sumatoria = (41.7/pow($this->energia, 0.7)) + (0.05*$this->proteinas) + (6.17*pow(10, -4)*pow($this->fibra, 3)) - (7.25*pow(10, -6)*pow($this->lipidos, 3)) + 0.617;
		$min = ($sumatoria<5)? $sumatoria : 5;
		return ($min>0.5)? $min : 0.5; 
	}
}
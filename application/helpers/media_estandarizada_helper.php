<?php 

/**
 * 
 */
class MediaEstandarizada
{
	private $energia, $vitamina_A, $vitamina_D, $vitamina_C, $calcio, $hierro, $zinc, $fibra, $grasas_sat, $azucares, $sodio, $medias, $desviaciones;
	
	function __construct($producto, $productos)
	{
		$this->energia 		= (array_key_exists('energia', $producto)) ? $producto['energia'] : 0;
		$this->vitamina_A 	= (array_key_exists('vitamina_A', $producto)) ? $producto['vitamina_A'] : 0;
		$this->vitamina_D 	= (array_key_exists('vitamina_D', $producto)) ? $producto['vitamina_D'] : 0;
		$this->vitamina_C 	= (array_key_exists('vitamina_C', $producto)) ? $producto['vitamina_C'] : 0;
		$this->calcio 		= (array_key_exists('calcio', $producto)) ? $producto['calcio'] : 0;
		$this->hierro 		= (array_key_exists('fibra', $hierro)) ? $producto['hierro'] : 0;
		$this->zinc 		= (array_key_exists('zinc', $producto)) ? $producto['zinc'] : 0;
		$this->fibra 		= (array_key_exists('fibra', $producto)) ? $producto['fibra'] : 0;
		$this->grasas_sat	= (array_key_exists('grasas_sat', $producto)) ? $producto['grasas_sat'] : 0;
		$this->azucares		= (array_key_exists('azucares', $producto)) ? $producto['azucares'] : 0;
		$this->sodio		= (array_key_exists('sodio', $producto)) ? $producto['sodio'] : 0;

		$sumatorias = array();
		foreach ($productos->result() as $prod) {
			$sumatorias['energia'] 		+= $prod->energia;
			$sumatorias['vitamina_A'] 	+= $prod->vitaa;
			$sumatorias['vitamina_D'] 	+= $prod->vitad;
			$sumatorias['vitamina_C'] 	+= $prod->acidoascord;
			$sumatorias['calcio'] 		+= $prod->calcio;
			$sumatorias['hierro'] 		+= $prod->hierro;
			$sumatorias['zinc'] 		+= $prod->zinc;
			$sumatorias['fibra'] 		+= $prod->fibra;
			$sumatorias['grasas_sat'] 	+= $prod->acidosgs;
			$sumatorias['azucares'] 	+= $prod->azucaresa;
			$sumatorias['sodio'] 		+= $prod->sodio;
		}

		//var_dump($sumatorias);

		$no_productos = count($productos->result());
		$this->medias = array();
		$this->desviaciones = array();
		foreach ($sumatorias as $cve => $val) {
			$this->medias[$cve] = $val/$no_productos;
			try {
				$this->desviaciones[$cve] = sqrt(pow($val - ($val/$no_productos), 2)/($no_productos-1)); 
			} catch (Exception $e) {
				$this->desviaciones[$cve] = 0;
			}
		}

		//var_dump($this->desviaciones);
	}

	public function getME(){
		$sumatoria =  0;
		foreach ($this->medias as $cve => $val) {
			try {
				$numerador = $this->$cve - $this->medias[$cve];
				$denominador = $this->desviaciones[$cve];
				if ($denominador==0) {
					$sumatoria += 0;
				}
				else{
					$sumatoria += $numerador/$denominador;
				}
				//echo $cve.": ".$this->$cve." ~ num=".$numerador." ~ den=".$denominador." ~ sumatoria: ".$sumatoria."<br>";	
			} catch (Exception $e) {
				$sumatoria += 0;
			}
			//echo $cve.": ".$this->$cve." ~ x=".$this->medias[$cve]." ~ r=".$this->desviaciones[$cve]." ~ sumatoria: ".$sumatoria."<br>";
			//echo $cve.": ".$sumatoria."<br>";
		}
		return $this->energia + $this->energia*0.1*$sumatoria;
	}
}
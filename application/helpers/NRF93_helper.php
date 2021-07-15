<?

/**
 * Clase que arroja las ternas para una gráfica NRF9.3
 */
class NRF93
{
	private $energia, $proteinas, $fibras, $vit_A, $vit_C, $vit_E, $calcio, $hierro, $magnesio, $potasio, $sodio, $grasas_tot, $azucares, $grasas_sat;

	private $vr_energia, $vr_proteinas, $vr_fibras, $vr_vit_A, $vr_vit_C, $vr_vit_E, $vr_calcio, $vr_hierro, $vr_magnesio, $vr_potasio, $vr_sodio, $vr_grasas_tot, $vr_azucares, $vr_grasas_sat;	
	
	function __construct($valores)
	{
		$this->energia 		= (array_key_exists('energia', $valores)) ? $valores['energia'] : 0;
		$this->proteinas 	= (array_key_exists('proteinas', $valores)) ? $valores['proteinas'] : 0;
		$this->fibras 		= (array_key_exists('fibra', $valores)) ? $valores['fibra'] : 0;
		$this->vit_A 		= (array_key_exists('vitaa', $valores)) ? $valores['vitaa'] : 0;
		$this->vit_C 		= (array_key_exists('acidoascord', $valores)) ? $valores['acidoascord'] : 0;
		$this->vit_E 		= (array_key_exists('vitaminae', $valores)) ? $valores['vitaminae'] : 0;
		$this->calcio 		= (array_key_exists('calcio', $valores)) ? $valores['calcio'] : 0;
		$this->hierro 		= (array_key_exists('hierro', $valores)) ? $valores['hierro'] : 0;
		$this->magnesio 	= (array_key_exists('magnesio', $valores)) ? $valores['magnesio'] : 0;
		$this->potasio 		= (array_key_exists('potasio', $valores)) ? $valores['potasio'] : 0;
		$this->sodio 		= (array_key_exists('sodio', $valores)) ? $valores['sodio'] : 0;
		$this->grasas_tot 	= (array_key_exists('lipidos', $valores)) ? $valores['lipidos'] : 0;
		$this->grasas_sat 	= (array_key_exists('acidosgs', $valores)) ? $valores['acidosgs'] : 0;
		$this->azucares 	= (array_key_exists('azucaresa', $valores)) ? $valores['azucaresa'] : 0;

		$this->vr_energia 		= 2000;
		$this->vr_proteinas 	= 50;
		$this->vr_fibras 		= 25;
		$this->vr_vit_A 		= 0.0008;
		$this->vr_vit_C 		= 0.06;
		$this->vr_vit_E 		= 0.02;
		$this->vr_calcio 		= 1;
		$this->vr_hierro 		= 0.018;
		$this->vr_magnesio 		= 0.4;
		$this->vr_potasio 		= 3.5;
		$this->vr_sodio			= 2400;
		$this->vr_azucares		= 50;
		$this->vr_grasas_tot 	= 65;
		$this->vr_grasas_sat 	= 20;
	}

	public function getNRF9(){
		return 100*(
			($this->fibras/$this->vr_fibras) + 
			($this->proteinas/$this->vr_proteinas) + 
			($this->vit_A/$this->vr_vit_A) + 
			($this->vit_C/$this->vr_vit_C) + 
			($this->vit_E/$this->vr_vit_E) + 
			($this->calcio/$this->vr_calcio) + 
			($this->hierro/$this->vr_hierro) + 
			($this->magnesio/$this->vr_magnesio) + 
			($this->potasio/$this->vr_potasio) 
		);
	}

	public function getNRF3(){
		return 100*( 
			($this->grasas_sat/$this->vr_grasas_sat) + 
			($this->sodio/$this->vr_sodio) + 
			($this->azucares/$this->vr_azucares) 
		);
	}

}
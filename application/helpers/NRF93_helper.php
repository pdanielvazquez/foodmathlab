<?

/**
 * Clase que arroja las ternas para una gráfica NRF9.3
 */
class NRF93
{
	private $energia, $proteinas, $fibras, $vit_A, $vit_C, $vit_E, $calcio, $hierro, $magnesio, $potasio, $sodio, $grasas_tot, $azucares, $grasas_sat;

	private $vr_energia, $vr_proteinas, $vr_fibras, $vr_vit_A, $vr_vit_C, $vr_vit_E, $vr_calcio, $vr_hierro, $vr_magnesio, $vr_potasio, $vr_sodio, $vr_grasas_tot, $vr_azucares, $vr_grasas_sat;	
	
	function __construct($valores, $vnr)
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

		$this->vr_energia 		= $vnr['ref_energia'];
		$this->vr_proteinas 	= $vnr['ref_proteina'];
		$this->vr_fibras 		= $vnr['ref_fibra'];
		$this->vr_vit_A 		= $vnr['ref_vit_A'];
		$this->vr_vit_C 		= $vnr['ref_vit_C'];
		$this->vr_vit_E 		= $vnr['ref_vit_E'];
		$this->vr_calcio 		= $vnr['ref_calcio'];
		$this->vr_hierro 		= $vnr['ref_hierro'];
		$this->vr_magnesio 		= $vnr['ref_magnesio'];
		$this->vr_potasio 		= $vnr['ref_potasio'];
		$this->vr_sodio			= $vnr['ref_sodio'];
		$this->vr_azucares		= $vnr['ref_azucares'];
		$this->vr_grasas_tot 	= $vnr['ref_grasas_tot'];
		$this->vr_grasas_sat 	= $vnr['ref_grasas_sat'];
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
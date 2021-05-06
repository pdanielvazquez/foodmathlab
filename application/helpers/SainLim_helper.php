<?

/**
 * Clase que arroja las ternas para una gráfica SAIN-LIM
 */
class SainLim
{
	private $energia, $proteinas, $fibras, $vit_C, $vit_E, $vit_B1, $vit_B2, $vit_B6, $vit_B9, $calcio, $hierro, $magnesio, $zinc, $potasio, $acido_linoleico, $dha, $sodio, $grasas_sat, $azucares;

	private $vr_energia, $vr_proteinas, $vr_fibras, $vr_vit_C, $vr_vit_E, $vr_vit_B1, $vr_vit_B2, $vr_vit_B9, $vr_calcio, $vr_hierro, $vr_magnesio, $vr_zinc, $vr_potasio, $vr_acido_linoleico, $vr_dha;	
	
	function __construct($valores)
	{
		$this->energia 		= (array_key_exists('energia', $valores)) ? $valores['energia'] : 0;
		$this->proteinas 	= (array_key_exists('proteinas', $valores)) ? $valores['proteinas'] : 0;
		$this->fibras 		= (array_key_exists('fibra', $valores)) ? $valores['fibra'] : 0;
		$this->vit_C 		= (array_key_exists('acidoascord', $valores)) ? $valores['acidoascord'] : 0;
		$this->vit_E 		= (array_key_exists('vitaminae', $valores)) ? $valores['vitaminae'] : 0;
		$this->vit_B1 		= (array_key_exists('tiamina', $valores)) ? $valores['tiamina'] : 0;
		$this->vit_B2 		= (array_key_exists('riboflavina', $valores)) ? $valores['riboflavina'] : 0;
		$this->vit_B6 		= (array_key_exists('hidratos', $valores)) ? $valores['hidratos'] : 0;
		$this->vit_B9 		= (array_key_exists('folatos', $valores)) ? $valores['folatos'] : 0;
		$this->calcio 		= (array_key_exists('calcio', $valores)) ? $valores['calcio'] : 0;
		$this->hierro 		= (array_key_exists('hierro', $valores)) ? $valores['hierro'] : 0;
		$this->magnesio 	= (array_key_exists('magnesio', $valores)) ? $valores['magnesio'] : 0;
		$this->zinc 		= (array_key_exists('zinc', $valores)) ? $valores['zinc'] : 0;
		$this->potasio 		= (array_key_exists('potasio', $valores)) ? $valores['potasio'] : 0;
		$this->acido_linoleico = (array_key_exists('acidolino', $valores)) ? $valores['acidolino'] : 0;
		$this->dha 			= (array_key_exists('dha', $valores)) ? $valores['dha'] : 0;
		$this->sodio 		= (array_key_exists('sodio', $valores)) ? $valores['sodio'] : 0;
		$this->grasas_sat 	= (array_key_exists('acidosgs', $valores)) ? $valores['acidosgs'] : 0;
		$this->azucares 	= (array_key_exists('azucaresa', $valores)) ? $valores['azucaresa'] : 0;

		$this->vr_energia 		= 2000;
		$this->vr_proteinas 	= 50;
		$this->vr_fibras 		= 25;
		$this->vr_vit_C 		= 0.06;
		$this->vr_vit_E 		= 0.02;
		$this->vr_vit_B1 		= 0.0015;
		$this->vr_vit_B2 		= 0.0017;
		$this->vr_vit_B6 		= 1;
		$this->vr_vit_B9 		= 1;
		$this->vr_calcio 		= 1;
		$this->vr_hierro 		= 0.018;
		$this->vr_magnesio 		= 0.4;
		$this->vr_zinc 			= 0.015;
		$this->vr_potasio 		= 3.5;
		$this->vr_acido_linoleico = 1.8;
		$this->vr_dha 			= 1;

	}

	public function getSain(){
		return ((100*( ($this->proteinas/$this->vr_proteinas + $this->fibras/$this->vr_fibras + $this->vit_C/$this->vr_vit_C + $this->vit_E/$this->vr_vit_E + $this->vit_B1/$this->vr_vit_B1 + $this->vit_B2/$this->vr_vit_B2 + $this->vit_B6/$this->vr_vit_B6 + $this->vit_B9/$this->vr_vit_B9 + $this->calcio/$this->vr_calcio + $this->hierro/$this->vr_hierro + $this->magnesio/$this->vr_magnesio + $this->zinc/$this->vr_zinc + $this->potasio/$this->vr_potasio + $this->acido_linoleico/$this->vr_acido_linoleico + $this->dha/$this->vr_dha)/15))/$this->energia)*100;
	}

	public function getLim(){
		return ((($this->sodio/3.153) + ($this->grasas_sat/22) + ($this->azucares/50))/3)*100;
	}

}
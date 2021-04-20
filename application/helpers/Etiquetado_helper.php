<?php

/**
 * Clase para el etiquetado de productos en Chile
 * Escalas: 1 - Etiqueta, 0 - Sin etiqueta
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

/**
 * Clase para el etiquetado de productos en Ecuador
 * Escalas: 2 - Alto, 1 - Medio, 0 - Bajo
 */
class Etiquetado_ecuador
{
	private $grasa_total, $azucares, $sal;
	
	function __construct($grasa_total_g, $azucar_g, $sal_g, $tipo)
	{
		$this->grasa_total 	= $grasa_total_g;
		$this->azucares 	= $azucar_g;
		$this->sal 			= $sal_g;
		$this->tipo			= $tipo;
	}

	public function getGrasaTotal(){
		$grasa = 0;
		if ($this->tipo=='solido') {
			if ($this->grasa_total>=20) {
				$grasa = 2;
			}
			else if($this->grasa_total<20 && $this->grasa_total>3){
				$grasa = 1;
			}
			else if ($this->grasa_total<=3) {
				$grasa = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->grasa_total>=10) {
				$grasa = 2;
			}
			else if($this->grasa_total<10 && $this->grasa_total>1.5){
				$grasa = 1;
			}
			else if ($this->grasa_total<=1.5) {
				$grasa = 0;
			}
		}
		return $grasa;
	}

	public function getAzucar(){
		$azucar = 0;
		if ($this->tipo=='solido') {
			if ($this->azucares>=15) {
				$azucar = 2;
			}
			else if($this->azucares<15 && $this->azucares>5){
				$azucar = 1;
			}
			else if ($this->azucares<=5) {
				$azucar = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->azucares>=7.5) {
				$azucar = 2;
			}
			else if($this->azucares<7.5 && $this->azucares>2.5){
				$azucar = 1;
			}
			else if ($this->azucares<=2.5) {
				$azucar = 0;
			}
		}
		return $azucar;
	}

	public function getSodio(){
		$sal = 0;
		if ($this->sal>=0.6) {
			$sal = 2;
		}
		else if($this->sal<0.6 && $this->sal>0.12){
			$sal = 1;
		}
		else if ($this->sal<=0.12) {
			$sal = 0;
		}
		return $sal;
	}
}

/**
 * Clase para el etiquetado de productos en Perú, primera fase DN No. 033-2016-SA
 * Escalas: 1 - Etiquetado, 0 - Sin etiquetado
 */
class Etiquetado_peru_1a_fase
{
	private $sodio, $azucares, $grasas_sat, $grasas_trans;
	
	function __construct($sodio_g, $azucares_g, $grasas_sat_g, $grasas_trans_g, $tipo)
	{
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->grasas_trans = $grasas_trans_g;
		$this->tipo			= $tipo;
	}

	public function getSodio(){
		$sodio = 0;
		if ($this->tipo=='solido') {
			if ($this->sodio>=0.8) {
				$sodio = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->sodio>=0.1) {
				$sodio = 1;
			}
		}
		return $sodio;
	}

	public function getAzucares(){
		$azucar = 0;
		if ($this->tipo=='solido') {
			if ($this->azucares>=22.5) {
				$azucar = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->azucares>=6) {
				$azucar = 1;
			}
		}
		return $azucar;
	}

	public function getGrasasSat(){
		$grasas = 0;
		if ($this->tipo=='solido') {
			if ($this->grasas_sat>=6) {
				$grasas = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->grasas_sat>=3) {
				$grasas = 1;
			}
		}
		return $grasas;
	}

	public function getGrasasTrans($tipo){
		$grasas = 0;
		if ($tipo=='grasas') {
			if ($this->grasas_trans>=2) {
				$grasas = 1;
			}
		}
		else if($tipo=='otros'){
			if ($this->grasas_trans>=5) {
				$grasas = 1;
			}
		}
		return $grasas;
	}
}

/**
 * Clase para el etiquetado de productos en Perú, segunda fase DN No. 033-2016-SA
 * Escalas: 1 - Etiquetado, 0 - Sin etiquetado
 */
class Etiquetado_peru_2a_fase
{
	private $sodio, $azucares, $grasas_sat, $grasas_trans;
	
	function __construct($sodio_g, $azucares_g, $grasas_sat_g, $grasas_trans_g, $tipo)
	{
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->grasas_trans = $grasas_trans_g;
		$this->tipo			= $tipo;
	}

	public function getSodio(){
		$sodio = 0;
		if ($this->tipo=='solido') {
			if ($this->sodio>=0.4) {
				$sodio = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->sodio>=0.1) {
				$sodio = 1;
			}
		}
		return $sodio;
	}

	public function getAzucares(){
		$azucar = 0;
		if ($this->tipo=='solido') {
			if ($this->azucares>=10) {
				$azucar = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->azucares>=5) {
				$azucar = 1;
			}
		}
		return $azucar;
	}

	public function getGrasasSat(){
		$grasas = 0;
		if ($this->tipo=='solido') {
			if ($this->grasas_sat>=4) {
				$grasas = 1;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->grasas_sat>=3) {
				$grasas = 1;
			}
		}
		return $grasas;
	}

	public function getGrasasTrans($tipo){
		$grasas = 0;
		if ($tipo=='grasas') {
			if ($this->grasas_trans>=2) {
				$grasas = 1;
			}
		}
		else if($tipo=='otros'){
			if ($this->grasas_trans>=5) {
				$grasas = 1;
			}
		}
		return $grasas;
	}
}

/**
 * Clase para el etiquetado de productos en Reino Unido
 * Escalas: 2 - Alto (Rojo), 1 - Medio (Amarillo), 0 - Bajo (Verde)
 */
class Etiquetado_UK
{
	private $sodio, $azucares, $grasas_sat, $grasas_tot;
	
	function __construct($sodio_g, $azucares_g, $grasas_sat_g, $grasas_tot_g, $tipo)
	{
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->grasas_tot 	= $grasas_tot_g;
		$this->tipo			= $tipo;
	}

	public function getSodio(){
		$sodio = 0;
		if ($this->tipo=='solido') {
			if ($this->sodio>1.5) {
				$sodio = 2;
			}
			else if($this->sodio<=1.5 && $this->sodio>0.3){
				$sodio = 1;
			}
			else if ($this->sodio<=0.3) {
				$sodio = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->sodio>0.75) {
				$sodio = 2;
			}
			else if($this->sodio<=0.75 && $this->sodio>0.3){
				$sodio = 1;
			}
			else if ($this->sodio<=0.3) {
				$sodio = 0;
			}
		}
		return $sodio;
	}

	public function getAzucares(){
		$azucar = 0;
		if ($this->tipo=='solido') {
			if ($this->azucares>22.5) {
				$azucar = 2;
			}
			else if($this->azucares<=22.5 && $this->azucares>5){
				$azucar = 1;
			}
			else if ($this->azucares<=5) {
				$azucar = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->azucares>11.25) {
				$azucar = 2;
			}
			else if($this->azucares<=11.25 && $this->azucares>2.5){
				$azucar = 1;
			}
			else if ($this->azucares<=2.5) {
				$azucar = 0;
			}
		}
		return $azucar;
	}

	public function getGrasasSat(){
		$grasas = 0;
		if ($this->tipo=='solido') {
			if ($this->grasas_sat>5) {
				$grasas = 2;
			}
			else if($this->grasas_sat<=5 && $this->grasas_sat>1.5){
				$grasas = 1;
			}
			else if ($this->grasas_sat<=1.5) {
				$grasas = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->grasas_sat>2.5) {
				$grasas = 2;
			}
			else if($this->grasas_sat<=2.5 && $this->grasas_sat>0.75){
				$grasas = 1;
			}
			else if ($this->grasas_sat<=0.75) {
				$grasas = 0;
			}
		}
		return $grasas;
	}

	public function getGrasaTotal(){
		$grasas = 0;
		if ($this->tipo=='solido') {
			if ($this->grasas_tot>17.5) {
				$grasas = 2;
			}
			else if($this->grasas_tot<=17.5 && $this->grasas_tot>3){
				$grasas = 1;
			}
			else if ($this->grasas_tot<=3) {
				$grasas = 0;
			}
		}
		else if($this->tipo=='liquido'){
			if ($this->grasas_tot>8.75) {
				$grasas = 2;
			}
			else if($this->grasas_tot<=8.75 && $this->grasas_tot>1.5){
				$grasas = 1;
			}
			else if ($this->grasas_tot<=1.5) {
				$grasas = 0;
			}
		}
		return $grasas;
	}
}

/**
 * Clase para el etiquetado de productos en Francia
 * Escalas: desde la letra A a la E, donde A es la escala más alta y E la más baja.
 */
class NutriScore
{
	private $energia, $azucares, $grasas_sat, $lipidos, $sodio, $puntos, $a, $b, $c, $d, $e, $f, $g, $verduras, $fibra, $proteinas, $categoria;
	
	function __construct($energia_kcal, $azucares_g, $grasas_sat_g, $lipidos_g, $sodio_g, $verduras_g, $fibra_g, $proteinas_g, $categoria, $tipo)
	{
		$this->energia 		= $energia_kcal;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->lipidos 		= $lipidos_g;
		$this->sodio 		= $sodio_g;
		$this->verduras 	= $verduras_g;
		$this->fibra 		= $fibra_g;
		$this->proteinas 	= $proteinas_g;
		$this->categoria 	= $categoria;
		$this->tipo			= $tipo;
		$this->puntos 		= 0;
		$this->a 			= 0;
		$this->b 			= 0;
		$this->c 			= 0;
		$this->d 			= 0;
		$this->e 			= 0;
		$this->f 			= 0;
		$this->g 			= 0;
	}

	public function puntos_a(){
		$puntos = 0;
		$energia = $this->energia * 0.238846;
		if ($this->tipo=='solido') {
			switch(true){
				case ($energia<=335): $puntos = 0;
					break;
				case ($energia>335): $puntos = 1;
					break;
				case ($energia>670): $puntos = 2;
					break;
				case ($energia>1005): $puntos = 3;
					break;
				case ($energia>1340): $puntos = 4;
					break;
				case ($energia>1675): $puntos = 5;
					break;
				case ($energia>2010): $puntos = 6;
					break;
				case ($energia>2345): $puntos = 7;
					break;
				case ($energia>2680): $puntos = 8;
					break;
				case ($energia>3015): $puntos = 9;
					break;
				case ($energia>3350): $puntos = 10;
					break;
			}
		}
		else if($this->tipo=='liquido'){
			switch(true){
				case ($energia<=0): $puntos = 0;
					break;
				case ($energia<=30): $puntos = 1;
					break;
				case ($energia<=60): $puntos = 2;
					break;
				case ($energia<=90): $puntos = 3;
					break;
				case ($energia<=120): $puntos = 4;
					break;
				case ($energia<=150): $puntos = 5;
					break;
				case ($energia<=180): $puntos = 6;
					break;
				case ($energia<=210): $puntos = 7;
					break;
				case ($energia<=240): $puntos = 8;
					break;
				case ($energia<=270): $puntos = 9;
					break;
				case ($energia>270): $puntos = 10;
					break;
			}
		}
		$this->a = $puntos;
	}

	public function puntos_b(){
		$puntos = 0;
		$azucares = $this->azucares;
		if ($this->tipo=='solido') {
			switch(true){
				case ($azucares<=4.5): $puntos = 0;
					break;
				case ($azucares>4.5): $puntos = 1;
					break;
				case ($azucares>9): $puntos = 2;
					break;
				case ($azucares>13.5): $puntos = 3;
					break;
				case ($azucares>18): $puntos = 4;
					break;
				case ($azucares>22.5): $puntos = 5;
					break;
				case ($azucares>27): $puntos = 6;
					break;
				case ($azucares>31): $puntos = 7;
					break;
				case ($azucares>36): $puntos = 8;
					break;
				case ($azucares>40): $puntos = 9;
					break;
				case ($azucares>45): $puntos = 10;
					break;
			}
		}
		else if ($this->tipo=='liquido') {
			switch(true){
				case ($azucares<=0): $puntos = 0;
					break;
				case ($azucares<=1.5): $puntos = 1;
					break;
				case ($azucares<=3): $puntos = 2;
					break;
				case ($azucares<=4.5): $puntos = 3;
					break;
				case ($azucares<=6): $puntos = 4;
					break;
				case ($azucares<=7.5): $puntos = 5;
					break;
				case ($azucares<=9): $puntos = 6;
					break;
				case ($azucares<=10.5): $puntos = 7;
					break;
				case ($azucares<=12): $puntos = 8;
					break;
				case ($azucares<=13.5): $puntos = 9;
					break;
				case ($azucares>13.5): $puntos = 10;
					break;
			}
		}
		$this->b = $puntos;
	}

	public function puntos_c(){
		$puntos = 0;
		if ($this->tipo=='solido') {
			$grasas = $this->grasas_sat;
			switch(true){
				case ($grasas<=1): $puntos = 0;
					break;
				case ($grasas>1): $puntos = 1;
					break;
				case ($grasas>2): $puntos = 2;
					break;
				case ($grasas>3): $puntos = 3;
					break;
				case ($grasas>4): $puntos = 4;
					break;
				case ($grasas>5): $puntos = 5;
					break;
				case ($grasas>6): $puntos = 6;
					break;
				case ($grasas>7): $puntos = 7;
					break;
				case ($grasas>8): $puntos = 8;
					break;
				case ($grasas>9): $puntos = 9;
					break;
				case ($grasas>10): $puntos = 10;
					break;
			}
		}
		
		if(in_array($this->categoria, array(37, 38, 42, 43, 34, 36, 39, 41, 35, 40, 50, 53))) {
			$grasas = ($this->lipidos>0) ? ($this->grasas_sat / $this->lipidos)*100 : 0;
			switch(true){
				case ($grasas<10): $puntos = 0;
					break;
				case ($grasas<16): $puntos = 1;
					break;
				case ($grasas<22): $puntos = 2;
					break;
				case ($grasas<28): $puntos = 3;
					break;
				case ($grasas<34): $puntos = 4;
					break;
				case ($grasas<40): $puntos = 5;
					break;
				case ($grasas<46): $puntos = 6;
					break;
				case ($grasas<52): $puntos = 7;
					break;
				case ($grasas<58): $puntos = 8;
					break;
				case ($grasas<64): $puntos = 9;
					break;
				case ($grasas>=64): $puntos = 10;
					break;
			}
		}
		$this->c = $puntos;
	}

	public function puntos_d(){
		$puntos = 0;
		$sodio = $this->sodio;
		switch(true){
			case ($sodio<=0.09): $puntos = 0;
				break;
			case ($sodio>0.09): $puntos = 1;
				break;
			case ($sodio>0.18): $puntos = 2;
				break;
			case ($sodio>0.27): $puntos = 3;
				break;
			case ($sodio>0.36): $puntos = 4;
				break;
			case ($sodio>0.45): $puntos = 5;
				break;
			case ($sodio>0.54): $puntos = 6;
				break;
			case ($sodio>0.63): $puntos = 7;
				break;
			case ($sodio>0.72): $puntos = 8;
				break;
			case ($sodio>0.81): $puntos = 9;
				break;
			case ($sodio>0.90): $puntos = 10;
				break;
		}
		$this->d = $puntos;
	}

	public function puntos_e(){
		$puntos = 0;
		if ($verduras!=false) {
			$valor = $this->grasas_sat;
			if ($this->tipo=='solido') {
				switch(true){
					case ($grasas<=1): $puntos = 0;
						break;
					case ($grasas>1): $puntos = 1;
						break;
					case ($grasas>2): $puntos = 2;
						break;
					case ($grasas>3): $puntos = 3;
						break;
					case ($grasas>4): $puntos = 4;
						break;
					case ($grasas>5): $puntos = 5;
						break;
					case ($grasas>6): $puntos = 6;
						break;
					case ($grasas>7): $puntos = 7;
						break;
					case ($grasas>8): $puntos = 8;
						break;
					case ($grasas>9): $puntos = 9;
						break;
					case ($grasas>10): $puntos = 10;
						break;
				}
			}
			else {
				$grasas = ($this->lipidos>0) ? ($this->grasas_sat / $this->lipidos)*100 : 0;
				switch(true){
					case ($grasas<10): $puntos = 0;
						break;
					case ($grasas<16): $puntos = 1;
						break;
					case ($grasas<22): $puntos = 2;
						break;
					case ($grasas<28): $puntos = 3;
						break;
					case ($grasas<34): $puntos = 4;
						break;
					case ($grasas<40): $puntos = 5;
						break;
					case ($grasas<46): $puntos = 6;
						break;
					case ($grasas<52): $puntos = 7;
						break;
					case ($grasas<58): $puntos = 8;
						break;
					case ($grasas<64): $puntos = 9;
						break;
					case ($grasas>=64): $puntos = 10;
						break;
				}
			}
		}
		$this->e = $puntos;
	}

}
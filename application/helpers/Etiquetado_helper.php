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
	private $energia, $azucares, $grasas_sat, $lipidos, $sodio, $puntos, $a, $b, $c, $d, $e, $f, $g, $verduras, $fibra, $proteinas, $categoria, $porcion, $clase;
	
	function __construct($energia_kcal, $azucares_g, $grasas_sat_g, $lipidos_g, $sodio_g, $verduras_g, $fibra_g, $proteinas_g, $categoria, $cantidad_porcion, $tipo)
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
		$this->porcion 		= $cantidad_porcion;
		$this->tipo			= $tipo;
		$this->puntos 		= 0;
		$this->a 			= 0;
		$this->b 			= 0;
		$this->c 			= 0;
		$this->d 			= 0;
		$this->e 			= 0;
		$this->f 			= 0;
		$this->g 			= 0;
		$this->clase 		= '';
		$this->puntuacion();
	}

	private function puntos_a(){
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

	private function puntos_b(){
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

	private function puntos_c(){
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

	private function puntos_d(){
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

	private function puntos_e(){
		$puntos = 0;
		if ($this->verduras>0) {
			$valor = ($this->verduras*2/$this->porcion)*100;
			if ($this->tipo=='solido') {
				switch(true){
					case ($valor<=40): $puntos = 0;
						break;
					case ($valor>40): $puntos = 1;
						break;
					case ($valor>60): $puntos = 2;
						break;
					case ($valor>80): $puntos = 5;
						break;
				}
			}
			if ($this->tipo=='liquido') {
				switch(true){
					case ($valor<=40): $puntos = 0;
						break;
					case ($valor>40): $puntos = 2;
						break;
					case ($valor>60): $puntos = 4;
						break;
					case ($valor>80): $puntos = 10;
						break;
				}
			}
		}
		$this->e = $puntos;
	}

	private function puntos_f(){
		$puntos = 0;
		$valor = $this->fibra;
		switch(true){
			case ($valor<=0.7): $puntos = 0;
				break;
			case ($valor>0.7): $puntos = 1;
				break;
			case ($valor>1.4): $puntos = 2;
				break;
			case ($valor>2.1): $puntos = 3;
				break;
			case ($valor>2.8): $puntos = 4;
				break;
			case ($valor>3.5): $puntos = 5;
				break;
		}
		$this->f = $puntos;
	}

	private function puntos_g(){
		$puntos = 0;
		$valor = $this->proteinas;
		switch(true){
			case ($valor<=1.6): $puntos = 0;
				break;
			case ($valor>1.6): $puntos = 1;
				break;
			case ($valor>3.2): $puntos = 2;
				break;
			case ($valor>4.8): $puntos = 3;
				break;
			case ($valor>6.4): $puntos = 4;
				break;
			case ($valor>8.0): $puntos = 5;
				break;
		}
		$this->g = $puntos;
	}

	private function puntuacion(){
		/*Puntos A*/
		$this->puntos_a();
		$this->puntos_b();
		$this->puntos_c();
		$this->puntos_d();
		/*Puntos C*/
		$this->puntos_e();
		$this->puntos_f();
		$this->puntos_g();
		/*Puntuación*/
		if ($this->a && in_array($this->categoria, array(38, 43, 49))) {
			if ($this->e >= 5) {
				$this->puntos = ($this->a + $this->b + $this->c + $this->d) - ($this->e + $this->f + $this->g);
			}
			else{
				$this->puntos = ($this->a + $this->b + $this->c + $this->d) - $this->e - $this->f;
			}
		}
		else{
			$this->puntos = ($this->a + $this->b + $this->c + $this->d) - ($this->e + $this->f + $this->g);
		}
		/*Asignación de clase*/
		if ($this->tipo=='solido') {
			$valor = $this->puntos;
			switch (true) {
				case $valor>18:
					$this->clase = 'E';
					break;
				case $valor>10:
					$this->clase = 'D';
					break;
				case $valor>2:
					$this->clase = 'C';
					break;
				case $valor>-1:
					$this->clase = 'B';
					break;
				case $valor<-1:
					$this->clase = 'A';
					break;
			}
		}
	}

	public function getClase(){
		return $this->clase;
	}

}


/**
 * Clase para el etiquetado de alimentos en México
 * Escalas: 0 - No tiene etiqueta, 1 - Tiene etiqueta
 */
class Etiquetado_mexico
{
	private $energia, $azucares, $grasas_sat, $grasas_trans, $sodio, $tipo;
	
	function __construct($energia_kcal, $azucares_g, $grasas_sat_g, $grasas_trans_g, $sodio_g, $tipo)
	{
		$this->energia 		= $energia_kcal;
		$this->azucares		= $azucares_g;
		$this->grasas_sat	= $grasas_sat_g;
		$this->grasas_trans	= $grasas_trans_g;
		$this->sodio		= $sodio_g;
		$this->tipo 		= $tipo;
	}

	public function getExcesoCalorias(){
		if ($this->tipo=='solido') {
			return ($this->energia>=275) ? 1 : 0;
		}
		else if($this->tipo=='liquido'){
			return ($this->energia>=70) ? 1 : 0;
		}
	}

	public function getExcesoAzucares(){
		return (($this->azucares*4)>= ($this->energia*0.1)) ? 1 : 0;
	}

	public function getExcesoGrasasTrans(){
		return (($this->grasas_trans*9) >= ($this->energia*0.1)) ? 1 : 0;
	}

	public function getExcesoGrasasSat(){
		return (($this->grasas_sat*9) >= ($this->energia*0.1)) ? 1 : 0;
	}

	public function getExcesoSodio(){
		return ( (($this->sodio/$this->energia) >= 1) || ($this->sodio >= 0.3)) ? 1 : 0;
	}
}

/**
 * Clase para el etiquetado de alimentos en Colombia
 * Escalas: 0 - No tiene etiqueta, 1 - Tiene etiqueta
 */
class Etiquetado_colombia
{
	private $sodio, $azucares, $grasas_sat, $tipo;
	
	function __construct($sodio_g, $azucares_g, $grasas_sat_g, $tipo)
	{
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->tipo 		= $tipo;
	}

	public function getSodio(){
		if ($this->tipo == 'solido') {
			return ($this->sodio > 0.4) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->sodio > 0.15) ? 1:0;
		}
	}

	public function getAzucares(){
		if ($this->tipo == 'solido') {
			return ($this->azucares > 10) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->azucares > 5) ? 1:0;
		}
	}

	public function getGrasasSat(){
		if ($this->tipo == 'solido') {
			return ($this->grasas_sat > 4) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->grasas_sat > 3.5) ? 1:0;
		}
	}
}

/**
 * Clase para el etiquetado de alimentos en Israel
 * Escalas: 0 - No tiene etiqueta, 1 - Tiene etiqueta
 */
class Etiquetado_israel
{
	private $sodio, $azucares, $grasas_sat, $tipo;
	
	function __construct($sodio_g, $azucares_g, $grasas_sat_g, $tipo)
	{
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->tipo 		= $tipo;
	}

	public function getSodio(){
		if ($this->tipo == 'solido') {
			return ($this->sodio > 0.4) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->sodio > 0.3) ? 1:0;
		}
	}

	public function getAzucares(){
		if ($this->tipo == 'solido') {
			return ($this->azucares > 10) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->azucares > 5) ? 1:0;
		}
	}

	public function getGrasasSat(){
		if ($this->tipo == 'solido') {
			return ($this->grasas_sat > 4) ? 1:0;
		}
		else if($this->tipo == 'liquido'){
			return ($this->grasas_sat > 3) ? 1:0;
		}
	}
}

/**
 * Etiquetado de alimentos para México (anterior)
 */
class Etiquetado_mexico_old
{
	private $energia, $grasas_tot, $grasas_sat, $azucares, $sodio;
	private $ref_energia, $ref_grasas_tot, $ref_grasas_sat, $ref_azucares, $ref_sodio;
	
	function __construct($energia_kcal, $grasas_tot_g, $grasas_sat_g, $azucares_g, $sodio_g)
	{
		/*Valores de referencia*/
		$this->ref_energia 	=	2000;
		$this->ref_grasas_tot =	70;
		$this->ref_grasas_sat =	20;
		$this->ref_azucares = 90;
		$this->ref_sodio = 0.1;

		/*Valores para comparacion*/
		$this->energia 		=	$energia_kcal;
		$this->grasas_tot 	=	$grasas_tot_g;
		$this->grasas_sat 	=	$grasas_sat_g;
		$this->azucares 	=	$azucares_g;
		$this->sodio 		=	$sodio_g;
	}

	public function getEnergia(){
		return ($this->energia / $this->ref_energia)*100;
	}

	public function getGrasaTot(){
		return ($this->grasas_tot *100) / $this->ref_grasas_tot;
	}

	public function getGrasasSat(){
		return ($this->grasas_sat * 100) / $this->ref_grasas_sat;
	}

	public function getAzucares(){
		return ($this->azucares * 100) / $this->ref_azucares;
	}
}

/**
 * 
 */
class Etiquetado_Australia_Nueva_Zelanda
{
	private $energia, $grasas_sat, $sodio, $azucares, $calcio, $verduras, $proteinas, $fibra, $categoria, $tipo;
	
	function __construct($energia_kcal, $grasas_sat_g, $sodio_g, $azucares_g, $calcio_g, $verduras_g, $proteinas_g, $fibra_g, $categoria, $tipo)
	{
		$this->energia 		= $energia_kcal;
		$this->grasas_sat 	= $grasas_sat_g;
		$this->sodio 		= $sodio_g;
		$this->azucares 	= $azucares_g;
		$this->calcio 		= $calcio_g;
		$this->verduras		= $verduras_g;
		$this->proteinas	= $proteinas_g;
		$this->fibra 		= $fibra_g;

		$this->categoria 	= $categoria;
		$this->tipo 		= $tipo;
		$this->setCategoria();
	}

	private function setCategoria(){
		if (in_array($this->categoria, array(48, 49, 50, 51, 52, 53, 62)) ||  $this->calcio >= 0.125) {
			if ($this->tipo=='liquido' && $this->calcio>=0.125) {
				$this->categoria = '1D';
			}
			else if(in_array($this->categoria, array(48, 49))){
				$this->categoria = '3D';
			}
			else{
				$this->categoria = '2D';
			}
		}
		else if($this->tipo=='liquido'){
			$this->categoria = '1';
		}
		else if(in_array($this->categoria, array(34, 36, 37, 38, 39, 41, 42, 43, 52, 53, 62))){
			$this->categoria = '3';	
		}
		else{
			$this->categoria = '2';		
		}
	}

	public function getCategoria(){
		/*Contadores generales*/
		$baseline_energia =
		$baseline_grasas_sat =
		$baseline_sodio =
		$baseline_azucares =
		$p = $v = $f = -1;
		/*Baselines globales*/
		$baseline_pts_energia = 
		$baseline_pts_grasas_sat =
		$baseline_pts_sodio =
		$baseline_pts_azucares = array();
		

		switch ($this->categoria) {
			case '1':
			case '1D':
			case '2':
			case '2D':

				$baseline_pts_energia = array(3685, 3350, 3015, 2680, 2345, 2010, 1675, 1340, 1005, 670, 335);
				
				$baseline_pts_grasas_sat = array(90, 80.6, 72.3, 64.7, 58, 52, 46.6, 41.7, 37.4, 33.5, 30, 26.9, 24.1, 21.6, 19.3, 17.3, 15.5, 13.9, 12.5, 11.2, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1);
				
				$baseline_pts_azucares = array(99, 94, 90, 85, 81, 76, 72, 67, 63, 58, 54, 49, 45, 40, 36, 31, 27, 22.5, 18, 13.5, 9, 5);
				
				$baseline_pts_sodio = array(8.106, 7.262, 6.506, 5.829, 5.223, 4.679, 4.192, 3.756, 3.365, 3.015, 2.701, 2.42, 2.168, 1.942, 1.74, 1.559, 1.397, 1.251, 1.121, 1.005, 0.9, 0.81, 0.72, 0.63, 0.54, 0.45, 0.36, 0.27, 0.18, 0.09); 

				break;
			
			case '3':
			case '3D':
				
				$baseline_pts_energia = array(3685, 3350, 3015, 2680, 2345, 2010, 1675, 1340, 1005, 670, 335);

				$baseline_pts_grasas_sat = array(30, 29, 28, 27, 26, 25, 24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1);

				$baseline_azucares = array(45, 40, 36, 31, 27, 22.5, 18, 13.5, 9, 5);

				$baseline_pts_sodio = array(2.7, 2.61, 2.52, 2.43, 2.34, 2.25, 2.16, 2.07, 1.98, 1.89, 1.8, 1.71, 1.62, 1.53, 1.44, 1.35, 1.26, 1.17, 1.08, 0.99, 0.9, 0.81, 0.72, 0.63, 0.54, 0.45, 0.36, 0.27, 0.18, 0.09);

				break;
		}

		/*Clasifica la energía*/
		/*Conversión kcal a kJ*/
		$energia = $this->energia * 4.184;
		foreach ($baseline_pts_energia as $i=>$pt) {
			if ($this->energia>$pt) {
				$baseline_energia = count($baseline_pts_energia)-$i;
			}
		}
		$baseline_energia = ($baseline_energia == -1) ? 0 : $baseline_energia;

		/*Clasifica las grasas saturadas*/
		foreach ($baseline_pts_grasas_sat as $i=>$pt) {
			if ($this->grasas_sat>$pt) {
				$baseline_grasas_sat = count($baseline_grasas_sat)-$i;
			}
		}
		$baseline_grasas_sat = ($baseline_grasas_sat == -1) ? 0 : $baseline_grasas_sat;

		/*Clasifica el sodio*/
		foreach ($baseline_pts_sodio as $i=>$pt) {
			if ($this->sodio>$pt) {
				$baseline_sodio = count($baseline_pts_sodio)-$i;
			}
		}
		$baseline_sodio = ($baseline_sodio == -1) ? 0 : $baseline_sodio;

		/*Clasifica los azucares*/
		foreach ($baseline_pts_azucares as $i=>$pt) {
			if ($this->azucares>$pt) {
				$baseline_azucares = count($baseline_pts_azucares)-$i;
			}
		}
		$baseline_azucares = ($baseline_azucares == -1) ? 0 : $baseline_azucares;

		/*Clasifica las frutas y verduras*/
		$baseline_pts_verduras = array(100, 90, 80, 67, 63, 52, 43, 25);
		foreach ($baseline_pts_verduras as $i=>$pt) {
			if ($this->verduras>$pt) {
				$v = count($baseline_pts_verduras)-$i;
			}
		}
		$v = ($v == -1) ? 0 : $v;

		/*Clasifica las proteinas*/
		$baseline_pts_proteinas = array(50, 41.6, 34.7, 28.9, 24, 20, 16.7, 13.9, 11.6, 9.6, 8, 6.4, 4.8, 3.2, 1.6);
		foreach ($baseline_pts_proteinas as $i=>$pt) {
			if ($this->proteinas>$pt) {
				$p = count($baseline_pts_proteinas)-$i;
			}
		}
		$p = ($p == -1) ? 0 : $p;

		/*Clasifica las proteinas*/
		$baseline_pts_fibra = array(20, 17.3, 15, 13, 11.2, 9.7, 8.4, 7.3, 6.3, 5.4, 4.7, 3.7, 2.8, 1.9, 0.9);
		foreach ($baseline_pts_fibra as $i=>$pt) {
			if ($this->fibra>$pt) {
				$f = count($baseline_pts_fibra)-$i;
			}
		}
		$f = ($f == -1) ? 0 : $f;

		/*Calculo del puntaje total*/

		$condicion_1 = ($puntaje_total>=13) && ($v>=5);
		if(!$condicion_1){
			$p = 0;
		}

		$condicion_2 = ($this->categoria!='2') && ($this->categoria!='3');
		if (!$condicion_2) {
			$f = 0;
		}

		$puntaje_total = $baseline_energia + $baseline_grasas_sat + $baseline_sodio + $baseline_azucares - $v - $p - $f;

		$estrellas = 0;

		switch ($this->categoria) {
			case '1':
				switch (true) {
					case $puntaje_total<=-6:
						$estrellas = 5;
						break;
					case $puntaje_total=-5:
						$estrellas = 4.5;
						break;
					case $puntaje_total=-4:
						$estrellas = 4;
						break;
					case $puntaje_total=-3:
						$estrellas = 3.5;
						break;
					case $puntaje_total=-2:
						$estrellas = 3;
						break;
					case $puntaje_total=-1:
						$estrellas = 2.5;
						break;
					case $puntaje_total=0:
						$estrellas = 2;
						break;
					case $puntaje_total=1:
						$estrellas = 1.5;
						break;
					case $puntaje_total=2:
						$estrellas = 1;
						break;
					case $puntaje_total>=3:
						$estrellas = 0.5;
						break;
				}
				break;
			case '1D':
			case '2D':
				switch (true) {
					case $puntaje_total<=-2:
						$estrellas = 5;
						break;
					case $puntaje_total=-1:
						$estrellas = 4.5;
						break;
					case $puntaje_total=0:
						$estrellas = 4;
						break;
					case $puntaje_total=1:
						$estrellas = 3.5;
						break;
					case $puntaje_total=2:
						$estrellas = 3;
						break;
					case $puntaje_total=3:
						$estrellas = 2.5;
						break;
					case $puntaje_total=4:
						$estrellas = 2;
						break;
					case $puntaje_total=5:
						$estrellas = 1.5;
						break;
					case $puntaje_total=6:
						$estrellas = 1;
						break;
					case $puntaje_total>=7:
						$estrellas = 0.5;
						break;
				}
				break;
			case '2':
				switch (true) {
					case $puntaje_total<=-11:
						$estrellas = 5;
						break;
					case $puntaje_total<=-7:
						$estrellas = 4.5;
						break;
					case $puntaje_total<=-2:
						$estrellas = 4;
						break;
					case $puntaje_total<=2:
						$estrellas = 3.5;
						break;
					case $puntaje_total<=6:
						$estrellas = 3;
						break;
					case $puntaje_total<=11:
						$estrellas = 2.5;
						break;
					case $puntaje_total<=15:
						$estrellas = 2;
						break;
					case $puntaje_total<=20:
						$estrellas = 1.5;
						break;
					case $puntaje_total<=24:
						$estrellas = 1;
						break;
					case $puntaje_total>=25:
						$estrellas = 0.5;
						break;
				}
				break;
			case '3':
				switch (true) {
					case $puntaje_total<=13:
						$estrellas = 5;
						break;
					case $puntaje_total<=16:
						$estrellas = 4.5;
						break;
					case $puntaje_total<=20:
						$estrellas = 4;
						break;
					case $puntaje_total<=23:
						$estrellas = 3.5;
						break;
					case $puntaje_total<=27:
						$estrellas = 3;
						break;
					case $puntaje_total<=30:
						$estrellas = 2.5;
						break;
					case $puntaje_total<=34:
						$estrellas = 2;
						break;
					case $puntaje_total<=37:
						$estrellas = 1.5;
						break;
					case $puntaje_total<=42:
						$estrellas = 1;
						break;
					case $puntaje_total>42:
						$estrellas = 0.5;
						break;
				}
				break;
			case '3D':
				switch (true) {
					case $puntaje_total<=22:
						$estrellas = 5;
						break;
					case $puntaje_total<=24:
						$estrellas = 4.5;
						break;
					case $puntaje_total<=26:
						$estrellas = 4;
						break;
					case $puntaje_total<=28:
						$estrellas = 3.5;
						break;
					case $puntaje_total<=30:
						$estrellas = 3;
						break;
					case $puntaje_total<=32:
						$estrellas = 2.5;
						break;
					case $puntaje_total<=34:
						$estrellas = 2;
						break;
					case $puntaje_total<=36:
						$estrellas = 1.5;
						break;
					case $puntaje_total<=39:
						$estrellas = 1;
						break;
					case $puntaje_total>39:
						$estrellas = 0.5;
						break;
				}
				break;
		}

		return $estrellas;

	}
}

/**
 * Etiquetado de alimentos para Italia
 * Escalas: Porcentajes por nutrientes
 */
class Etiquetado_italia
{
	private $energia, $grasas_tot, $grasas_sat, $azucares, $sodio;
	private $ref_energia, $ref_grasas_tot, $ref_grasas_sat, $ref_azucares, $ref_sodio;
	
	function __construct($energia_kcal, $grasas_tot_g, $grasas_sat_g, $azucares_g, $sodio_g)
	{
		/*Valores de referencia*/
		$this->ref_energia 	=	2000;
		$this->ref_grasas_tot =	70;
		$this->ref_grasas_sat =	20;
		$this->ref_azucares = 90;
		$this->ref_sodio = 2.4;

		/*Valores para comparacion*/
		$this->energia 		=	$energia_kcal;
		$this->grasas_tot 	=	$grasas_tot_g;
		$this->grasas_sat 	=	$grasas_sat_g;
		$this->azucares 	=	$azucares_g;
		$this->sodio 		=	$sodio_g;
	}

	public function getEnergia(){
		return ($this->energia / $this->ref_energia)*100;
	}

	public function getGrasaTot(){
		return ($this->grasas_tot *100) / $this->ref_grasas_tot;
	}

	public function getGrasasSat(){
		return ($this->grasas_sat * 100) / $this->ref_grasas_sat;
	}

	public function getAzucares(){
		return ($this->azucares * 100) / $this->ref_azucares;
	}

	public function getSodio(){
		return ($this->azucares * 100) / $this->ref_azucares;
	}
}

/**
 * Etiquetado de alimentos para Uruguay
 * Escalas: 1 - Etiqueta, 0 - Sin etiqueta
 */
class Etiquetado_uruguay
{
	private $grasas_tot, $grasas_sat, $sodio, $azucares, $tipo;
	
	function __construct($energia_kcal, $grasas_tot_g, $grasas_sat_g, $sodio_g, $azucares_g, $tipo)
	{
		$this->energia 		=	$energia_kcal;
		$this->grasas_tot 	=	$grasas_tot_g;
		$this->grasas_sat 	=	$grasas_sat_g;
		$this->sodio  		=	$sodio_g;
		$this->azucares 	=	$azucares_g;
	}

	public function getGrasasSat(){
		return ((9 * $this->grasas_sat) >= ($this->energia*0.12)) ? 1 : 0;
	}

	public function getGrasaTot(){
		return ((9 * $this->grasas_tot) >= ($this->energia*0.35)) ? 1 : 0;
	}

	public function getSodio(){
		/*en miligramos*/
		return ( ((($this->sodio*1000)/$this->energia)>8) || ( (($this->sodio*1000)/$this->energia)>= 500 ) ) ? 1 : 0;
	}

	public function getAzucares(){
		return ( ((4*$this->azucares)>=($this->energia*0.2)) || ((4*$this->azucares)>=3) ) ? 1 : 0;
	}
}
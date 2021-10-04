<?php

function search_value($permisos, $critero){
	$existe = false;
	foreach ($permisos as $cve => $val) {
		if ($val->etiquetado==$critero)
			$existe = true;
	}
	return $existe;
}

function search_index($indices, $critero){
	$existe = false;
	foreach ($indices as $cve => $val) {
		if ($val->indice==$critero)
			$existe = true;
	}
	return $existe;
}
<?php

function encripta($cadena){
	return base64_encode(base64_encode(base64_encode($cadena)));
}

function desencripta($cadena){
	return base64_decode(base64_decode(base64_decode($cadena)));
}
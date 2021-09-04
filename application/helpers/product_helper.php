<?php

function add($info)
{

	//Quitan caracteres sobrantes
	foreach ($info as $key => $value) {
		$info[$key] = str_replace(",","",$value);
	}

	$info2["sugar"] = round(floatval($info["sugar"]) / $info["porcion"] * 100,2);
	$info2["carbs"] = round(floatval($info["carbs"]) / $info["porcion"] * 100,2);
	$info2["totalFat"] = round(floatval($info["totalFat"]) / $info["porcion"] * 100,2);
	$info2["satFat"] = round(floatval($info["satFat"]) / $info["porcion"] * 100,2);
	$info2["sodium"] = round(floatval($info["sodium"]) / $info["porcion"] * 100,2);
	$info2["fv"] = round(floatval($info["fv"]) / $info["porcion"] * 100,2);
	$info2["fiber"] = round(floatval($info["fiber"]) / $info["porcion"] * 100,2);
	$info2["protein"] = round(floatval($info["protein"]) / $info["porcion"] * 100,2);
	$info2["energy"] = round(floatval($info["energy"]) / $info["porcion"] * 100,2);
	

	//Inicia json a enviar
	$postdata["referenceFood"] = [
			"sugar" 	=> floatval($info2["sugar"]),
	        "carbs" 	=> floatval($info2["carbs"]),
	        "totalFat" 	=> floatval($info2["totalFat"]),
	        "satFat" 	=> floatval($info2["satFat"]),
	        "sodium" 	=> floatval($info2["sodium"]),
	        "f&v" 		=> floatval($info2["fv"]),
	        "fiber" 	=> floatval($info2["fiber"]),
	        "protein" 	=> floatval($info2["protein"]),
	        "energy" 	=> floatval($info2["energy"])
		];

	//Si maneja maximos valores los agrega al json
	if($info["max_sugar"] != "")
		$postdata["maxValues"]["sugar"] = floatval($info["max_sugar"]);

	if($info["max_satFat"] != "")
		$postdata["maxValues"]["satFat"] = floatval($info["max_satFat"]);

	if($info["max_sodium"] != "")
		$postdata["maxValues"]["sodium"] = floatval($info["max_sodium"]);

	if($info["max_fv"] != "")
		$postdata["maxValues"]["f&v"] = floatval($info["max_fv"]);

	if($info["max_fiber"] != "")
		$postdata["maxValues"]["fiber"] = floatval($info["max_fiber"]);

	if($info["max_protein"] != "")
		$postdata["maxValues"]["protein"] = floatval($info["max_protein"]);

	//Si maneja minimos valores los agrega al json
	if($info["min_sugar"] != "")
		$postdata["minValues"]["sugar"] = floatval($info["min_sugar"]);

	if($info["min_satFat"] != "")
		$postdata["minValues"]["satFat"] = floatval($info["min_satFat"]);

	if($info["min_sodium"] != "")
		$postdata["minValues"]["sodium"] = floatval($info["min_sodium"]);

	if($info["min_fv"] != "")
		$postdata["minValues"]["f&v"] = floatval($info["min_fv"]);

	if($info["min_fiber"] != "")
		$postdata["minValues"]["fiber"] = floatval($info["min_fiber"]);

	if($info["min_protein"] != "")
		$postdata["minValues"]["protein"] = floatval($info["min_protein"]);

	$postdata["lockValues"] = [
			"sugar"		=> ($info["lock_sugar"] == 0) ? false : true,
	        "satFat" 	=> ($info["lock_satFat"] == 0) ? false : true,
	        "sodium" 	=> ($info["lock_sodium"] == 0) ? false : true,
	        "f&v" 		=> ($info["lock_fv"] == 0) ? false : true,
	        "fiber" 	=> ($info["lock_fiber"] == 0) ? false : true,
	        "protein" 	=> ($info["lock_protein"] == 0) ? false : true
		];		

	$postdata["params"] = [
			"weightNutriscore" 	=> floatval($info["weightNutriscore"]),
	        "population" 		=> floatval($info["population"]),
	        "treplace" 			=> floatval($info["replace"]),
	        "generations" 		=> floatval($info["generations"]),
	        "seed" 				=> floatval($info["seed"])
		];

	$postdata["foodProperties"] = [
			"cheese"	=> ($info["cheese"] == 0) ? false : true,
	        "drink" 	=> ($info["drink"] == 0) ? false : true,
	        "method" 	=> $info["method"]
		];

	if($info["forceLetter"] != "")
		$postdata["forceLetter"] = $info["forceLetter"];

	///Fin json a enviar

	//Api StartNutriScoreOptimization
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost:5000/StartNutriscoreOptimization",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($postdata),
		CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
		)		
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	$response = json_decode($response);

	//Si el API termina correctamente
	if($response->success){

		//Inicia inserts a la base de datos
		//Producto
		$arrayProduct = array(
			"product"	=>	$info["product"],
			"sugar"		=>	$info["sugar"],
	        "carbs"		=>	$info["carbs"],
	        "totalFat"	=>	$info["totalFat"],
	        "satFat"	=>	$info["satFat"],
	        "sodium"	=>	$info["sodium"],
	        "fv"		=>	$info["fv"],
	        "fiber"		=>	$info["fiber"],
	        "protein"	=>	$info["protein"],
	        "energy"	=>	$info["energy"],
	        "porcion"	=>	$info["porcion"]
	    );

		$tabla = "product";
		$selector = new SelectorUniversal($arrayProduct, $tabla, "");
		$product = $selector->getterConsultaInsertar();
		
		//Maximos en caso de requerirlos
		if(isset($postdata["maxValues"])){

			if($info["max_sugar"] != "")
				$arrayMax["max_sugar"] = $info["max_sugar"];

			if($info["max_satFat"] != "")
				$arrayMax["max_satFat"] = $info["max_satFat"];

			if($info["max_sodium"] != "")
				$arrayMax["max_sodium"] = $info["max_sodium"];

			if($info["max_fv"] != "")
				$arrayMax["max_fv"] = $info["max_fv"];

			if($info["max_fiber"] != "")
				$arrayMax["max_fiber"] = $info["max_fiber"];

			if($info["max_protein"] != "")
				$arrayMax["max_protein"] = $info["max_protein"];

			$tabla = "maxValues";
			$selector = new SelectorUniversal($arrayMax, $tabla, "");
			$maxValues = $selector->getterConsultaInsertar();			
		}

		//Minimos en caso de requerirlos.
		if(isset($postdata["minValues"])){

			if($info["min_sugar"] != "")
				$arrayMin["min_sugar"] = $info["min_sugar"];

			if($info["min_satFat"] != "")
				$arrayMin["min_satFat"] = $info["min_satFat"];

			if($info["min_sodium"] != "")
				$arrayMin["min_sodium"] = $info["min_sodium"];

			if($info["min_fv"] != "")
				$arrayMin["min_fv"] = $info["min_fv"];

			if($info["min_fiber"] != "")
				$arrayMin["min_fiber"] = $info["min_fiber"];

			if($info["min_protein"] != "")
				$arrayMin["min_protein"] = $info["min_protein"];

			$tabla = "minValues";
			$selector = new SelectorUniversal($arrayMin, $tabla, "");
			$minValues = $selector->getterConsultaInsertar();			
		}

		$arrayLock = array(
			"lock_sugar"	=>	$info["lock_sugar"],
	        "lock_satFat"	=>	$info["lock_satFat"],
	        "lock_sodium"	=>	$info["lock_sodium"],
	        "lock_fv"		=>	$info["lock_fv"],
	        "lock_fiber"	=>	$info["lock_fiber"],
	        "lock_protein"	=>	$info["lock_protein"],
			"forceLetter"	=>	$info["forceLetter"]
	    );

		$tabla = "lookvalues";	
		$selector = new SelectorUniversal($arrayLock, $tabla, "");
		$lockvalues = $selector->getterConsultaInsertar();

		$arrayParams = array(
			"weightNutriscore"	=>	$info["weightNutriscore"],
	        "population"		=>	$info["population"],
	        "treplace"			=>	$info["replace"],
	        "generations"		=>	$info["generations"],
	        "seed"				=>	$info["seed"]
	    );

		$tabla = "params";	
		$selector = new SelectorUniversal($arrayParams, $tabla, "");
		$params = $selector->getterConsultaInsertar();

		$arrayProps = array(
			"cheese"		=>	$info["cheese"],
	        "drink"	=>	$info["drink"],
	        "method"	=>	$info["method"]
	    );

		$tabla = "foodproperties";
		$selector = new SelectorUniversal($arrayProps, $tabla, "");
		$foodproperties = $selector->getterConsultaInsertar();
		
		//Se asigna el token al producto y se guarda en la base de datos
		$arrayToken = array(
			"id_product"		=>	$product["insert_id"],
			"id_foodproperties" =>	$foodproperties["insert_id"],
			"id_maxValues"		=>	(isset($maxValues)) ? $maxValues["insert_id"] : 0,
			"id_minValues"		=>	(isset($minValues)) ? $minValues["insert_id"] : 0,
			"id_lockvalues"		=>	$lockvalues["insert_id"],
			"id_params"			=>	$params["insert_id"],
			"token"				=>	$response->token,
			"comment"			=>	"Token inicial",
			"sending_json"		=>	json_encode($postdata)
	    );

		$tabla = "tokens";	
		$selector = new SelectorUniversal($arrayToken, $tabla, "");
		$selector->getterConsultaInsertar();

		//Fin inserts a la base de datos

		header("Location: ../views/product.html?value=".$product["insert_id"]);

	}
}

function get_products($info){

	$array = array(
			"id"		=>	"id",
			"product"	=>	"product"
	    );

	$tabla = "product";
	$productSelector = new SelectorUniversal($array, $tabla, "");
	$product = $productSelector->getterConsultaSimple();

	return json_encode($product);
	exit;

}

function get_Tokens($info){
	$array = array(
			"id"		=>	"id",
			"token"		=>	"token",
			"comment"	=>	"comment"
	    );

	$tabla = "tokens";
	$productSelector = new SelectorUniversal($array, $tabla, "WHERE active = 1 AND id_product = ". $info['id']);
	$token = $productSelector->getterConsultaSimple();

	$array = array(
			"product"		=>	"product",
	    );

	$tabla = "product";
	$productSelector = new SelectorUniversal($array, $tabla, "WHERE id = ". $info['id']);
	$product = $productSelector->getterConsultaSimple()[0];

	return json_encode(["token" => $token,"product" => $product]);
}

function by_token($info){

	$arrayResponse = [];

	$array = array(
		"id_product" 		=> "id_product",
		"id_foodproperties" => "id_foodproperties",
		"id_maxValues" 		=> "id_maxValues",
		"id_minValues" 		=> "id_minValues",
		"id_lockvalues" 	=> "id_lockvalues",
		"id_params" 		=> "id_params",
		"token" 			=> "token",
		"sending_json"		=>	"sending_json" );

	$tabla = "tokens";
	$selector = new SelectorUniversal($array, $tabla, "WHERE id = ". $info['id']);
	$token = $selector->getterConsultaSimple()[0];

	$arrayResponse["token"] = $token;

	$arrayProduct = array(
		"product"	=>	"product",
		"sugar"		=>	"sugar",
        "carbs"		=>	"carbs",
        "totalFat"	=>	"totalFat",
        "satFat"	=>	"satFat",
        "sodium"	=>	"sodium",
        "fv"		=>	"fv",
        "fiber"		=>	"fiber",
        "protein"	=>	"protein",
        "energy"	=>	"energy",
        "porcion"	=> 	"porcion"
    );

	$tabla = "product";
	$selector = new SelectorUniversal($arrayProduct, $tabla, "WHERE id = ".$token["id_product"]);
	$arrayResponse["product"] = $selector->getterConsultaSimple()[0];

	$arrayProps = array(
			"cheese"		=>	"cheese",
	        "drink"			=>	"drink",
	        "method"		=>	"method"
    );

	$tabla = "foodproperties";
	$selector = new SelectorUniversal($arrayProps, $tabla, "WHERE id = ".$token["id_foodproperties"]);
	$arrayResponse["foodproperties"] = $selector->getterConsultaSimple()[0];

	$maxValues = [];

	//Maximos en caso de requerirlos
	if($token["id_maxValues"] != 0){
		$arrayMax = array(
			"max_sugar"		=>	"max_sugar",
	        "max_satFat"	=>	"max_satFat",
	        "max_sodium"	=>	"max_sodium",
	        "max_fv"		=>	"max_fv",
	        "max_fiber"		=>	"max_fiber",
	        "max_protein"	=>	"max_protein"
	    );

		$tabla = "maxValues";
		$selector = new SelectorUniversal($arrayMax, $tabla, "WHERE id = ".$token["id_maxValues"]);
		$arrayResponse["maxValues"] = $selector->getterConsultaSimple()[0];			
	}

	$minValues = "";

	//Minimos en caso de requerirlos
	if($token["id_minValues"] != 0){
		$arrayMin = array(
			"min_sugar"		=>	"min_sugar",
	        "min_satFat"	=>	"min_satFat",
	        "min_sodium"	=>	"min_sodium",
	        "min_fv"		=>	"min_fv",
	        "min_fiber"		=>	"min_fiber",
	        "min_protein"	=>	"min_protein"
	    );

		$tabla = "minValues";
		$selector = new SelectorUniversal($arrayMin, $tabla, "WHERE id = ".$token["id_minValues"]);
		$arrayResponse["minValues"] = $selector->getterConsultaSimple()[0];
	}

	$arrayLock = array(
		"lock_sugar"	=>	"lock_sugar",
        "lock_satFat"	=>	"lock_satFat",
        "lock_sodium"	=>	"lock_sodium",
        "lock_fv"		=>	"lock_fv",
        "lock_fiber"	=>	"lock_fiber",
        "lock_protein"	=>	"lock_protein",
		"forceLetter"	=>	"forceLetter"
    );

	$tabla = "lookvalues";	
	$selector = new SelectorUniversal($arrayLock, $tabla, "WHERE id = ".$token["id_lockvalues"]);
	$arrayResponse["lockvalues"] = $selector->getterConsultaSimple()[0];

	$arrayParams = array(
		"weightNutriscore"	=>	"weightNutriscore",
        "population"		=>	"population",
        "treplace"			=>	"treplace",
        "generations"		=>	"generations",
        "seed"				=>	"seed"
    );

	$tabla = "params";	
	$selector = new SelectorUniversal($arrayParams, $tabla, "WHERE id = ".$token["id_params"]);
	$arrayResponse["params"] = $selector->getterConsultaSimple()[0];

	if($info["bytoken"] == 1){
		$arrayResponse["info"] = load_tokenInfo($token["token"]);
	}

	return json_encode($arrayResponse);
	exit;

}

function by_id($info){
	$arrayResponse = [];

	$array = array(
		"id_product" 		=> "id_product",
		"id_foodproperties" => "id_foodproperties",
		"id_maxValues" 		=> "id_maxValues",
		"id_minValues" 		=> "id_minValues",
		"id_lockvalues" 	=> "id_lockvalues",
		"id_params" 		=> "id_params",
		"token" 			=> "token",
		"comment"			=> "comment",
		"sending_json"		=>	"sending_json" );

	$tabla = "tokens";
	$selector = new SelectorUniversal($array, $tabla, "WHERE id_product = ". $info['id']." ORDER BY id DESC LIMIT 1");
	$token = $selector->getterConsultaSimple()[0];

	$arrayResponse["token"] = $token;

	$arrayProduct = array(
		"product"	=>	"product",
		"sugar"		=>	"sugar",
        "carbs"		=>	"carbs",
        "totalFat"	=>	"totalFat",
        "satFat"	=>	"satFat",
        "sodium"	=>	"sodium",
        "fv"		=>	"fv",
        "fiber"		=>	"fiber",
        "protein"	=>	"protein",
        "energy"	=>	"energy",
        "porcion"	=> 	"porcion"
    );

	$tabla = "product";
	$selector = new SelectorUniversal($arrayProduct, $tabla, "WHERE id = ".$token["id_product"]);
	$arrayResponse["product"] = $selector->getterConsultaSimple()[0];

	$arrayProps = array(
			"cheese"		=>	"cheese",
	        "drink"			=>	"drink",
	        "method"		=>	"method"
    );

	$tabla = "foodproperties";
	$selector = new SelectorUniversal($arrayProps, $tabla, "WHERE id = ".$token["id_foodproperties"]);
	$arrayResponse["foodproperties"] = $selector->getterConsultaSimple()[0];

	$maxValues = [];

	//Maximos en caso de requerirlos
	if($token["id_maxValues"] != 0){
		$arrayMax = array(
			"max_sugar"		=>	"max_sugar",
	        "max_satFat"	=>	"max_satFat",
	        "max_sodium"	=>	"max_sodium",
	        "max_fv"		=>	"max_fv",
	        "max_fiber"		=>	"max_fiber",
	        "max_protein"	=>	"max_protein"
	    );

		$tabla = "maxValues";
		$selector = new SelectorUniversal($arrayMax, $tabla, "WHERE id = ".$token["id_maxValues"]);
		$arrayResponse["maxValues"] = $selector->getterConsultaSimple()[0];			
	}

	$minValues = "";

	//Minimos en caso de requerirlos
	if($token["id_minValues"] != 0){
		$arrayMin = array(
			"min_sugar"		=>	"min_sugar",
	        "min_satFat"	=>	"min_satFat",
	        "min_sodium"	=>	"min_sodium",
	        "min_fv"		=>	"min_fv",
	        "min_fiber"		=>	"min_fiber",
	        "min_protein"	=>	"min_protein"
	    );

		$tabla = "minValues";
		$selector = new SelectorUniversal($arrayMin, $tabla, "WHERE id = ".$token["id_minValues"]);
		$arrayResponse["minValues"] = $selector->getterConsultaSimple()[0];
	}

	$arrayLock = array(
		"lock_sugar"	=>	"lock_sugar",
        "lock_satFat"	=>	"lock_satFat",
        "lock_sodium"	=>	"lock_sodium",
        "lock_fv"		=>	"lock_fv",
        "lock_fiber"	=>	"lock_fiber",
        "lock_protein"	=>	"lock_protein"
    );

	$tabla = "lookvalues";	
	$selector = new SelectorUniversal($arrayLock, $tabla, "WHERE id = ".$token["id_lockvalues"]);
	$arrayResponse["lockvalues"] = $selector->getterConsultaSimple()[0];

	$arrayParams = array(
		"weightNutriscore"	=>	"weightNutriscore",
        "population"		=>	"population",
        "treplace"			=>	"treplace",
        "generations"		=>	"generations",
        "seed"				=>	"seed"
    );

	$tabla = "params";	
	$selector = new SelectorUniversal($arrayParams, $tabla, "WHERE id = ".$token["id_params"]);
	$arrayResponse["params"] = $selector->getterConsultaSimple()[0];

	return json_encode($arrayResponse);
	exit;
}

function load_tokenInfo($token)
{
	$data = '{
			    "token": "'.$token.'"
			 }';

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost:5000/GetNutriscoreOptimization",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
		)
		
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	return json_decode($response);
}

function delete_token($info){
	if($info["id"] == 0){
		return json_encode(deleteMonthyTokens());
	}else{
		return json_encode(deleteByIdToken($info["id"]));
	}
}

function deleteByIdToken($id)
{

	$array = array("token" => "token",);

	$tabla = "tokens";
	$selector = new SelectorUniversal($array, $tabla, "WHERE id = ". $id);
	$token = $selector->getterConsultaSimple()[0]["token"];

	$data = '{
			    "token": "'.$token.'"
			 }';

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost:5000/DeleteToken",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
		)
		
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	$response = json_decode($response);

	//Si el API termina correctamente
	if($response->success){
		$arrayParams = array(
			"active"	=>	"0",
		);

		$tabla = "tokens";	
		$selector = new SelectorUniversal($arrayParams, $tabla, "WHERE id = ".$id);
		return json_encode($selector->getterConsultaUpdate());
		
	}
}

function deleteByToken($token)
{

	$data = '{
			    "token": "'.$token.'"
			 }';

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost:5000/DeleteToken",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/json",
		)
		
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	$response = json_decode($response);

	return $response;
}

function deleteMonthyTokens()
{
	$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost:5000/DeleteMonth",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        )
        
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $response = json_decode($response);

    if($response->success){
		foreach($response->tokens as $token){
			$arrayParams = array(
				"active"	=>	"0",
			);
	
			$tabla = "tokens";	
			$selector = new SelectorUniversal($arrayParams, $tabla, "WHERE token = ".$token);
			$selector->getterConsultaUpdate();
		}

		return json_encode("Ok");
	}
	return json_encode("error");
}
<?php

include '../url.php';




if($_GET['inicializar']){

	$objeto->CLUUFDATA_bd		="pedido";
	$objeto->cluufdata_iniciar();
	$objeto->CLUUFDATA_token    = $_GET['token'];
	$objeto->cluufdata_insert('general1','pdro');

}


if($_GET['addProducto']){

	$objeto->CLUUFDATA_bd		="pedido";
	$objeto->cluufdata_iniciar();
	$objeto->CLUUFDATA_token    = $_GET['token'];
	$objeto->cluufdata_insert('product',$_GET);
}

if($_GET['update']){

	$objeto->CLUUFDATA_bd		="pedido";
	$objeto->cluufdata_iniciar();
	$objeto->CLUUFDATA_token    = $_GET['token'];
    $objeto->cluufdata_all();

}


//$data = $objeto->cluufdata_search('client','name','pedro','DELETE');


/*

$datos_clientes = file_get_contents($file);

$json_clientes = json_decode($datos_clientes, true);

array_push($json_clientes['productos'],$_POST);

$json_string = json_encode($json_clientes);

file_put_contents($file, $json_string);


*/
?>
<?php 


/*
		$archivo = "guitarra.json";

	           $str_datos = file_get_contents($archivo);
               $datos = json_decode($str_datos, true);
               fwrite($fh, json_encode($datos, JSON_UNESCAPED_UNICODE));
               fclose($fh);
	
		$col =  $datos['config']['col'];          


		$json = "{
           \"campo\": \"guiamp\",\"label\": \"guiamp\",\"size\":\"12\",\"type\":\"\",\"key\":\"\" ,\"default\":\"\" ,\"fijo\":\"false\" ,\"data\":\"\",\"password\":\"false\",\"correlativo\":\"false\", \"input_type\":\"text\",\"input_class\":\"\"}";

  		$datos1 = json_decode($json, true);

		array_push($datos['config']['col'],$datos1);
	
		$datofinal = json_encode($datos, true);


		file_put_contents($archivo,$datofinal);

		//file_put_contents($str_datos,"....................");


*/


	$_POST['nombre1']="pedro";
	$_POST['nombre2']="alejandro";
	$_POST['nombre3']="rojas";
	$_POST['nombre4']="Garcia";


// Este ciclo muestra todas las claves del array asociativo
// donde el valor equivale a "manzana"



 echo key($_POST['nombre1']);



#print_r($_POST);
#$datofinal = json_encode($_POST, true);
#print_r($datofinal);









?>

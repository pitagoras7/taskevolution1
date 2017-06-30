<?php


require_once("UserRestHandler.php");
$method = $_SERVER['REQUEST_METHOD'];
$view = "";
if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
switch($page_key){


	case "create":
	$userRestHandler = new UserRestHandler();
	$userRestHandler->add();
	break;

}
?>

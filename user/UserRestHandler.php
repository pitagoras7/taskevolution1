<?php
require_once("SimpleRest.php");
require_once("user.php");

class UserRestHandler extends SimpleRest {


	function add() {
		$user = new User();
		$rawData = $user->addUser();
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('success' => 0);
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$result = $rawData;

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}
	}

}
?>

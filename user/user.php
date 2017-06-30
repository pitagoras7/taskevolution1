<?php
require_once("dbcontroller.php");
/*
A domain Class to demonstrate RESTful web services
*/
Class User {

	public function addUser(){


		if( ($this->comprobar_email( $_GET['email'] ) )==1 ){
			$dbcontroller = new DBController();

			$query1	 = " SELECT * FROM user WHERE  usulog in ('".$_GET['email']."'); ";

			$result1 = $dbcontroller->executeSelectQuery($query1);


			if(!isset($result1) ){


				if( $_GET['psw01']==$_GET['psw02'] ){

					$password = $_GET['psw01'];
					$login = $_GET['email'];

					$query = "INSERT INTO user VALUES (null,'".$login."','UserCed','UserCar','M','".$login."','".$login."','".md5($password)."',CURDATE(),'t','00','0','','','')";


					$result = $dbcontroller->executeQuery($query);
					if($result != 0){
						$result = array('success'=>1);
					}


				}else{
					$result['error']=" Passwords do not match ";
				}



			}else{
				$result['error']=" Duplicate email";
			}




			
		}else{
			$result['error']=" Invalid email format";
		}

		echo json_encode($result);

	}


	function comprobar_email($email){
		$mail_correcto = 0;
   //compruebo unas cosas primeras
		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
			if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
         //miro si tiene caracter .
				if (substr_count($email,".")>= 1){
            //obtengo la terminacion del dominio
					$term_dom = substr(strrchr ($email, '.'),1);
            //compruebo que la terminación del dominio sea correcta
					if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
               //compruebo que lo de antes del dominio sea correcto
						$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
						if ($caracter_ult != "@" && $caracter_ult != "."){
							$mail_correcto = 1;
						}
					}
				}
			}
		}
		if ($mail_correcto)
			return 1;
		else
			return 0;
	}


}







?>

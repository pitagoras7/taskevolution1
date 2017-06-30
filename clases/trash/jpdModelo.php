<?php 
 
 require_once 'padreModelo.php';

class jpdModelo extends padreModelo {


   

public function ultimaConsulta($x=1)
{

  $SQL = "select * from consulta where conest in ('t') order by conid desc limit ".$x."  ";
  $RESULTCONSULTA= $this->ejecutar_query($SQL);

  

  return $RESULTCONSULTA;

}








} 


$JPD = new jpdModelo();


 ?>
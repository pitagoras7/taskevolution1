<?php  session_start(); 
require_once '../../url.php';


if ($_POST['accion'] == "filter_cards_")
{


 $TIPOPAGO = new tipopagoModelo();
 $TIPOPAGO->set_tpgtpcid($TIPOPAGO->decrypt($_POST['v1']));
 

 if( $TIPOPAGO->get_tpgtpcid()==1){
  $condicional = " tpgest in ('t') ";
}else{
  $condicional = " tpgest in ('t') and tpgtpcid in (".$TIPOPAGO->get_tpgtpcid().")";
}

$_SESSION['temp']['TIPOPAGO_id'] = $TIPOPAGO->get_tpgtpcid();
echo $datos['cardsimple'] = $TIPOPAGO->cardsimple_($condicional);
exit;

}

?>
<?php 

require_once 'padreModelo.php';

class ordersModelo extends padreModelo {

  private $value_default = "orders.json";
  public $vista = "orders";
  public $tabla = "orders";
  public $id_dependiente = "";


  public function _config_($json="")
  {

    if(strlen($json)>1){
      $this->value_default=$json;
    }


    $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$this->tabla."/data/".$this->value_default);
    $datos = json_decode($str_datos, true);
    fwrite($fh, json_encode($datos, JSON_UNESCAPED_UNICODE));
    fclose($fh);
    return $datos;
  }





  public function cerrar($id){

    $this->set_ordid($id,1);
    $this->set_ordedo($this->ordedo_cerrada);
    $this->save('ordid');
  }



  public function verificar_orden($idmesa){

    $res = $this->select_all(" ordest in ('t') and ordmesid in (".$idmesa.") and ordedo >= '".$this->ordedo_solicitud."'  and ordedo<='".$this->ordedo_entregada."' ;");

    if($res[0]['ordid']>0){
      return $res[0]['ordid'];
    }else{
      return 0;
    }


  }


  public function menu_con_calculator(){

    $res = "<a  style=\"width: 100px; height:70px;  text-align: center;  color: white;\" href=\"#\" class=\"btn btn-success botonyes\" onclick=\"botonplus(1); accionbotonplus(1)\">
    <i class=\"menu-icon fa fa-plus bigger-230\"></i>    <br>      
    <span class=\"menu-text\">CON</span></a>";

    return $res;

  }



  public function menu_sin_calculator(){

    $res = "<a href=\"#\" style=\"width: 100px; height:70px; text-align: center;  color: white; display:none\" class=\" btn btn-danger botonno\" onclick=\"botonplus(0); accionbotonplus(0)\" >
    <i class=\"menu-icon fa fa-minus bigger-230\"></i>    <br>       
    <span class=\"menu-text\">SIN</span> </a>";

    return $res;

  }


  public function oddpvp_total($ORDERS_id)
  {


    $sql="select * from orderDetail where oddest in ('t') and oddblo  in ('".$this->oddblo_enproceso."') and oddordid in (".$ORDERS_id.")";
    $data = $this->ejecutar_query($sql);
    $monto['total']=0;

    foreach ($data as $key) {
      $monto['total'] = $monto['total'] + $key['oddpvp'];
    }

    return $monto['total'];

  }


  public function monto_sinpago($ORDERS_id)
  {


    $sql="select * from orderDetail where oddest in ('t') and oddblo  in ('".$this->oddblo_enespera."','".$this->oddblo_enproceso."','".$this->oddblo_sinpago."') and oddordid in (".$ORDERS_id.")";
    $data = $this->ejecutar_query($sql);
    $monto['total']=0;

    foreach ($data as $key) {
      $monto['total'] = $monto['total'] + $key['oddpvp'];
    }

    return $monto['total'];

  }


  public function monto_pagado($ORDERS_id)
  {


    $sql="select * from orderDetail where oddest in ('t') and oddblo  in ('".$this->oddblo_pagado."') and oddordid in (".$ORDERS_id.")";
    $data = $this->ejecutar_query($sql);
    $monto['total']=0;

    foreach ($data as $key) {
      $monto['total'] = $monto['total'] + $key['oddpvp'];
    }

    return $monto['total'];

  }


  public function boton_pedido($ORDERS_id)
  {


    $sql="select * from orderDetail where oddest in ('t') and oddblo  in ('".$this->oddblo_enespera."') and oddordid in (".$ORDERS_id.")";
    $data = $this->ejecutar_query($sql);



    if(count($data)>0){

      return "<a href='#'
      onclick=\"ajax('ode','OA==','view_orderDetail') \" 
      class=\"btn btn-danger btn-block boton_cargar_pedido \" style='font-weight:bold'>
      <i class='fa fa-cart-plus ' ></i>&nbsp;&nbsp;
      Cargar ".count($data)." Pedido 
      </a>";

    }else{

      return " ";

    }
  }



  public function boton_close($ORDERS_id)
  {

    return "<a href='?opcion=closeOrders'
    class=\"btn btn-danger btn-block\" style='font-weight:bold'>
    <i class='fa fa-close' style='font-size:28px'></i>&nbsp;&nbsp;
    CERRAR CUENTA
    </a>";


  }


  public function  cards_total($ORDERS_id){

    $RESULT_ORDERS  = $this->select_all(" ordid in (".$ORDERS_id.") ");

    $RESULT_ORDERS  = $this->DATAPRINT__ALL($RESULT_ORDERS);

    if($this->monto_sinpago($ORDERS_id)<=0){
      $boton         =  $this->boton_close($ORDERS_id);
    }else{
      $boton          = $this->boton_pedido($ORDERS_id);
    }



    return "

    <div class='col-xs-12 '  >


    <table style=\"width:100%; margin:10px\" id=\"totales\" class=\"table_totales cards_total\">
    <tr >
    <td style='width:200px'> <i class='fa fa-hashtag'></i>  ".$ORDERS_id."</td> 
    <td   class='titulo_total' style='width:100px' > Subtotal </td>
    <td  class='titulo_total' > ".$RESULT_ORDERS[0]['ordid_ordpvp']." </td>
    </tr>
    <tr>
    <td > <i class='fa fa-tag'></i>  ".strtoupper($RESULT_ORDERS[0]['ordodcid_fk'])."</td> 
    <td  class='titulo_total' > Pagado </td>
    <td  class='titulo_total' >".$this->moneda($this->monto_pagado($ORDERS_id))."</td>
    </tr>
    <tr>
    <td ><i class='fa fa-clock-o'></i> </td> 
    <td class='titulo_total'> Por Pagar </td>
    <td class='total' >  ".$this->moneda($this->monto_sinpago($ORDERS_id))." </td>
    </tr>

    <tr>
    <td ><i class='fa fa-user'></i> ".strtoupper($RESULT_ORDERS[0]['ordcli_clifnm'])."</td> 
    <td >  </td>
    <td >  </td>
    </tr>


    </table>

    <div class='col-xs-12' >
    ".$boton."
    </div>


    </div>

    ";
  }


  public function get_select_all()
  {
    $res['campo'] = "ordid";
    $res['id'] = $this->get_ordid();
    return $res;
  }

  public function set_id($x, $w = 0)
  {

    if ($x == 0)
    {
      $this->set_ordid($x);
    }
    else
    {
      $this->set_ordid($x, $w);
    }
  }




  public function modal_($data, $modo = 'edit')
  {


    if($this->modal_json==""){
      $this->modal_json = "form_";          
    }


    $data_json = $this->_config_();
    $form_new = $data_json[$this->modal_json];
    $this->modal_reset();
    $this->modal_only_form = true;
    $this->modal_id = $form_new['id'];
    $this->modal_class = $form_new['class'];
    $this->modal_body_height = $form_new['height'];
    $this->title_modal = $form_new['title'];
    $this->modal_data = $data;
    $this->modal_form_class = $form_new['form_class'];
    $this->modal_form_enctype = false;
    $this->modal_form_id = $form_new['form_id'];


    if ($modo == 'new')
    {
      $this->modal_data_new = true;
    }



    for ($i = 0; $i < count($form_new['col']); $i++)
    {
      $this->modal_body_row_input_json($form_new['col'][$i]);
    }


    for ($i = 0; $i < count($form_new['button_footer']); $i++)
    {
      $this->modal_footer_buttons_json($form_new['button_footer'][$i]);
    }


    return $this->modal_form_content();
  }


  public function validation($sspsupid,$sspsrvid){


    $data = $this->_config_();
    $est = $data['type_combo_multiple'][0]['fk_table_est'];
    $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3']; 
    $campo_independiente = $data['type_combo_multiple'][0]['fk_table_id2']; 


    $sql = "
    select ".$data['type_combo_multiple'][0]['fk_id2']."  as id  from ".$data['config']['table']."  where  ".$est."='t' and ".$campo_dependiente." in (".$sspsrvid.") and ".$campo_independiente."  in ( ".$sspsupid.")";
    $data = $this->ejecutar_query($sql);

    if($data[0]['id']>0){
      echo $data[0]['id'];
      return false;
    }else{
      echo $data[0]['id'];
      return true;
    }
  }


  public function reset($sspsrvid){

    $data = $this->_config_();

    $est = $data['type_combo_multiple'][0]['fk_table_est'];
    $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3']; 

    $sql = "update  ".$data['config']['table']." set  ".$est."='f' Where ".$campo_dependiente." in (".$sspsrvid.")";

    $data = $this->ejecutar_query($sql);
  }

  /* DATATABLE */

  public function datatable_($name="")
  {
    $data = $this->_config_();

    if($name==""){
      $this->datatable_struct = $data['datatable'];
    }else{
      $this->datatable_struct = $data[$name];
    }


    $est = $data['type_combo_multiple'][0]['fk_table_est'];
    $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3'];    

    $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);

            //$this->datatable_data = $this->select_all("  ". $est."='t' and ".$campo_dependiente." in (".$this->id_dependiente.")"  );
    return $this->DATATABLE_content();
  }





  public function datatable_data($data1)
  {
    $data = $this->_config_();
    $this->datatable_struct = $data['datatable'];
    $this->datatable_data = $data1;
    return $this->DATATABLE_content();
  }

  /* FUNCIONES BASICAS */


  public function _dataprint_($data)
  {

   // $this->idddddd = 1;
   // $data = $this->DATAPRINT__($data, $this->_config_());

    //return $data;
  }

  public function select_all($condicion = '0')
  {


    $this->dataprint_data_json = $this->_config_();
    $this->select_select_all = $this->get_select_all();
    $this->sql_combomultiple_id = $this->id_dependiente;    
    $this->select_vista = $this->vista;
    return $this->SELECT__($condicion);
  }




  public function _fix_type($nombre, $valor)
  {

    $data_json = $this->_config_();
    $valor = $this->FIXTYPE__($nombre, $valor, $data_json);
    return $valor;
  }

  public function save()
  {
    $this->save_campo = $this->campo;
    $this->save_value = $this->value;
    $this->save_campo_where = $this->campo_where;
    $this->save_value_where = $this->value_where;
    $this->save_tabla = $this->tabla;
    return $this->SAVE__();
  }

  public function input_file($file, $dir)
  {


    if (strlen($file['name']) > 3)
    {

      $fichero_subido = $dir . basename($file['name']);

      $resultado = $file['name'];

      if (move_uploaded_file($file['tmp_name'], $fichero_subido))
      {
                #   echo "El fichero es válido y se subió con éxito.";
      }
      else
      {
        echo "¡Posible ataque de subida de ficheros!";
      }
    }

    return $resultado;
  }

  public function setter__($x, $w = 0)
  {

    $json = $this->_config_();
    $cols = $json['config'];

    $key = array_keys($x);

    $i = 0;
    foreach ($key as $val)
    {

      $post[$i]['campo'] = $val;
      $i++;
    }

    $y = 0;
    foreach ($x as $val1)
    {
      $post[$y]['value'] = $val1;
      $y++;
    }


    for ($i = 0; $i < count($post); $i++)
    {

      foreach ($cols['col'] as $col)
      {


        if (($col['campo'] == $post[$i]['campo']) && ($col['key'] !== 'PRI' ))
        {

          $nombre = $post[$i]['campo'];
          $x = $post[$i]['value'];

          $x = $this->_fix_type($nombre, $x);

          if ($w > 0)
          {
            $this->campo_where[] = $nombre;
            $this->value_where[] = $x;
          }
          else
          {
            $this->campo[] = $nombre;
            $this->value[] = $x;
          }
        }
      }
    }
  }



  public function formatos_especiales($data)
  {



        /*
        for ($i = 0; $i < count($data); $i++)
        {


          $total01 = $data[$i]['subtotal'] + $data[$i]['iva'];

          $descuento = $total01 * ($data[$i]['descuento'] / 100);

          $total02 = $total01 - $descuento;

          $data[$i]['total'] = $this->_is_formato_moneda_($total02);
          $data[$i]['estatus_aprobacion'] = $this->get_estatus_de_aprobacion($data[$i]['presupuesto_id']);
      }
         */
      return $data;
    }


    public $ordid="";
    public $ordcliid="";
    public $ordmesid="";
    public $ordusuid="";
    public $ordodcid="";
    public $orddes="";
    public $ordest="";
    public $ordreg="";
    public $ordemi="";
    public $ordpre="";
    public $ordenv="";
    public $ordanu="";
    public $ordobs="";
    public $ordedo="";
    public $ordresid="";


    public function set_ordresid($x, $w = 0) { 
     $nombre = 'ordresid';  
     $x = $this->_fix_type($nombre, $x);
     $this->ordresid = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
    } 
  } 

  public function get_ordresid() { 
   return $this->ordresid; 
 } 



 public function set_ordedo($x, $w = 0) { 
   $nombre = 'ordedo';  
   $x = $this->_fix_type($nombre, $x);
   $this->ordedo = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
  } 
} 

public function get_ordedo() { 
 return $this->ordedo; 
} 


public function set_ordid($x, $w = 0) { 
 $nombre = 'ordid';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordid() { 
 return $this->ordid; 
} 





public function set_ordcliid($x, $w = 0) { 
 $nombre = 'ordcliid';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordcliid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordcliid() { 
 return $this->ordcliid; 
} 





public function set_ordmesid($x, $w = 0) { 
 $nombre = 'ordmesid';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordmesid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordmesid() { 
 return $this->ordmesid; 
} 





public function set_ordusuid($x, $w = 0) { 
 $nombre = 'ordusuid';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordusuid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordusuid() { 
 return $this->ordusuid; 
} 





public function set_ordodcid($x, $w = 0) { 
 $nombre = 'ordodcid';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordodcid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordodcid() { 
 return $this->ordodcid; 
} 





public function set_orddes($x, $w = 0) { 
 $nombre = 'orddes';  
 $x = $this->_fix_type($nombre, $x);
 $this->orddes = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_orddes() { 
 return $this->orddes; 
} 





public function set_ordest($x, $w = 0) { 
 $nombre = 'ordest';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordest = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordest() { 
 return $this->ordest; 
} 





public function set_ordreg($x, $w = 0) { 
 $nombre = 'ordreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordreg() { 
 return $this->ordreg; 
} 





public function set_ordemi($x, $w = 0) { 
 $nombre = 'ordemi';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordemi = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordemi() { 
 return $this->ordemi; 
} 





public function set_ordpre($x, $w = 0) { 
 $nombre = 'ordpre';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordpre = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordpre() { 
 return $this->ordpre; 
} 





public function set_ordenv($x, $w = 0) { 
 $nombre = 'ordenv';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordenv = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordenv() { 
 return $this->ordenv; 
} 





public function set_ordanu($x, $w = 0) { 
 $nombre = 'ordanu';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordanu = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordanu() { 
 return $this->ordanu; 
} 





public function set_ordobs($x, $w = 0) { 
 $nombre = 'ordobs';  
 $x = $this->_fix_type($nombre, $x);
 $this->ordobs = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_ordobs() { 
 return $this->ordobs; 
} 



} 

?>
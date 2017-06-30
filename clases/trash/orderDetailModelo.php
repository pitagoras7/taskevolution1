<?php 

require_once 'padreModelo.php';

class orderDetailModelo extends padreModelo {

  private $value_default = "orderDetail.json";
  public $vista = "orderDetail";
  public $tabla = "orderDetail";
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




  public function estatu_cards(){

    $sql = " SELECT * FROM orderDetailEstatu e , orderDetail d, orders o , service s , mesa m where
    m.mesid = o.ordmesid  and e.odeoddid = d.oddid and d.oddordid = o.ordid and d.oddsrvid = s.srvid and e.odetipid in (56) and e.odeest in ('t') ";

    $result = $this->ejecutar_query($sql);


    $res = $this->DATAPRINT__ALL($result);



    foreach ($res as $data ) {

      $res.=" <div class=\"widget-box widget-color-green ui-sortable-handle\" style=\"opacity: 1; z-index: 0;\">
      <div class=\"widget-header\">
      <h5 class=\"widget-title\"> ".$data['odd_ico']."   Mesa ".$data['mesden']." |  ".$data['srvden']." </h5>

      <div class=\"widget-toolbar\">
      <a href=\"#\" data-action=\"collapse\">
      <i class=\"1 ace-icon fa bigger-125 fa-chevron-up\"></i>
      </a>
      </div>

      <div class=\"widget-toolbar no-border\">
      

      <button class=\"btn btn-xs bigger btn-warning dropdown-toggle\" data-toggle=\"dropdown\">
      <i class='fa fa-cogs'></i>
      <i class=\"ace-icon fa fa-chevron-down icon-on-right\"></i>
      </button>

      <ul class=\"dropdown-menu dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close\">
      <li>
      <a href=\"#\">Action</a>
      </li>
      </ul>
      </div>
      </div>

      <div class=\"widget-body\" style=\"display: block;\">

      <div class=\"widget-main\">

      
      ".$data['odd_srpden']." 
      

      </div>


      <div class=\"widget-toolbox padding-8 clearfix\">

      ".$data['odereg']."

      <a href=\"?opcion=abrirOrderDetailEstatu&code=".$data['oddid']."&type=1\" class=\"btn btn-xs btn-success pull-right\">
      <span class=\"bigger-110\"> En Preparación </span>

      <i class=\"ace-icon fa fa-arrow-right icon-on-right\"></i>
      </a>



      </div>
      </div>
      </div><hr>";

    }



    return $res;

  }



  public function estatu_cards2(){

    $sql = " SELECT * FROM orderDetailEstatu e , orderDetail d, orders o , service s , mesa m where
    m.mesid = o.ordmesid  and e.odeoddid = d.oddid and d.oddordid = o.ordid and d.oddsrvid = s.srvid and e.odetipid in (57)  and e.odeest in ('t') ";

    $result = $this->ejecutar_query($sql);


    $res = $this->DATAPRINT__ALL($result);



    foreach ($res as $data ) {

      $res.=" <div class=\"widget-box widget-color-red ui-sortable-handle \" style=\"opacity: 1; z-index: 0;\">
      <div class=\"widget-header\">
      <h5 class=\"widget-title\"> ".$data['odd_ico']."   Mesa ".$data['mesden']." |  ".$data['srvden']." </h5>

      <div class=\"widget-toolbar\">
      <a href=\"#\" data-action=\"collapse\">
      <i class=\"1 ace-icon fa bigger-125 fa-chevron-up\"></i>
      </a>
      </div>

      <div class=\"widget-toolbar no-border\">
      

      <button class=\"btn btn-xs bigger btn-warning dropdown-toggle\" data-toggle=\"dropdown\">
      <i class='fa fa-cogs'></i>
      <i class=\"ace-icon fa fa-chevron-down icon-on-right\"></i>
      </button>

      <ul class=\"dropdown-menu dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close\">
      <li>
      <a href=\"#\">Action</a>
      </li>
      </ul>
      </div>
      </div>

      <div class=\"widget-body\" style=\"display: block;\">

      <div class=\"widget-main\">

      
      ".$data['odd_srpden']." 
      

      </div>


      <div class=\"widget-toolbox padding-8 clearfix\">

      ".$data['odereg']."

      <button class=\"btn btn-xs btn-success pull-right\">
      <span class=\"bigger-110\"> En Preparación </span>

      <i class=\"ace-icon fa fa-arrow-right icon-on-right\"></i>
      </button>



      </div>
      </div>
      </div><hr>";

    }

    return $res;
  }




















  public function get_select_all()
  {
    $res['campo'] = "oddid";
    $res['id'] = $this->get_oddid();
    return $res;
  }

  public function set_id($x, $w = 0)
  {

    if ($x == 0)
    {
      $this->set_oddid($x);
    }
    else
    {
      $this->set_oddid($x, $w);
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

  public function datatable_()
  {
    $data = $this->_config_();
    $this->datatable_struct = $data['datatable'];


    $est = $data['type_combo_multiple'][0]['fk_table_est'];
    $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3'];    

        #$this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
    $this->datatable_data = $this->select_all(" oddest in ('t') and  oddordid  in (".$this->id_dependiente.")"  );

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


  public function select_all_sql($condicion)
  {

    $this->dataprint_data_json = $this->_config_();
    $this->select_select_all = $this->get_select_all();
    $this->sql_combomultiple_id = $this->id_dependiente;    
    $this->select_vista = $this->vista;
    return $this->SELECT__($condicion,'sql');
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
    $this->SAVE__();
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




    public function datatable_cards($ORDERS_id){ 

      return  $this->datatable_cards_solicitud($ORDERS_id)."<br>".$this->datatable_cards_estatu($ORDERS_id);

    }




    public function datatable_cards_solicitud($ORDERS_id){
      $this->datatable_reset();
      $this->DATATABLE_CONDICIONAL="select * from orderDetail  left join orderDetailEstatu on oddid = odeoddid
      where odeid is null and oddordid in  (".$ORDERS_id.") and oddest in ('t') order by oddid desc";
      $this->DATATABLE_CONDICIONAL_SQL = true;
      $JSON = $this->json_element($this->tabla,'armarpedido');
      $res =$this->DATATABLE__($JSON);

      return  $res;
    }


    public function datatable_cards_estatu($ORDERS_id){
      $this->datatable_reset();
      $this->DATATABLE_CONDICIONAL="select * from orderDetail,orderDetailEstatu where odeoddid = oddid and oddest in ('t') and  oddordid  in (".$ORDERS_id.") and odeest in ('t') order by oddid desc";
      $this->DATATABLE_CONDICIONAL_SQL = true;
      $JSON = $this->json_element($this->tabla,'estatupedido');
      $res =$this->DATATABLE__($JSON);
      return  $res;
    }





    public function datatable_cards_pago($ORDERS_id){ 
      return  $this->datatable_cards_pagopedido($ORDERS_id);
    }


    public function datatable_cards_pagopedido($ORDERS_id){
      $this->datatable_reset();
      $this->DATATABLE_CONDICIONAL="select * from orderDetail where oddest in ('t') and  oddordid  in (".$ORDERS_id.") and oddblo in ('".$this->oddblo_enproceso."') order by oddid desc";
      $this->DATATABLE_CONDICIONAL_SQL = true;
      $JSON = $this->json_element($this->tabla,'pagopedido');
      $res =$this->DATATABLE__($JSON);
      return  $res;
    }



    public $oddid="";
    public $oddordid="";
    public $oddsrvid="";
    public $oddcan="";
    public $oddest="";
    public $oddreg="";
    public $oddobs="";
    public $oddpvp="";
    public $odddes="";
    public $oddblo="";
    public $oddcajid="";
    public $oddresid="";


    public function set_oddresid($x, $w = 0) { 
     $nombre = 'oddresid';  
     $x = $this->_fix_type($nombre, $x);
     $this->oddresid = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
    } 
  } 

  public function get_oddresid() { 
   return $this->oddresid; 
 } 



 public function set_oddblo($x, $w = 0) { 
   $nombre = 'oddblo';  
   $x = $this->_fix_type($nombre, $x);
   $this->oddblo = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
  } 
} 

public function get_oddblo() { 
 return $this->oddblo; 
} 


public function set_oddpvp($x, $w = 0) { 
 $nombre = 'oddpvp';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddpvp = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddpvp() { 
 return $this->oddpvp; 
} 





public function set_odddes($x, $w = 0) { 
 $nombre = 'odddes';  
 $x = $this->_fix_type($nombre, $x);
 $this->odddes = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_odddes() { 
 return $this->odddes; 
} 


public function set_oddid($x, $w = 0) { 
 $nombre = 'oddid';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddid() { 
 return $this->oddid; 
} 


public function set_oddcajid($x, $w = 0) { 
 $nombre = 'oddcajid';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddcajid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddcajid() { 
 return $this->oddcajid; 
} 


public  function set_oddordid($x, $w = 0) { 
 $nombre = 'oddordid';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddordid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddordid() { 
 return $this->oddordid; 
} 





public function set_oddsrvid($x, $w = 0) { 
 $nombre = 'oddsrvid';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddsrvid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddsrvid() { 
 return $this->oddsrvid; 
} 





public function set_oddcan($x, $w = 0) { 
 $nombre = 'oddcan';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddcan = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddcan() { 
 return $this->oddcan; 
} 





public function set_oddest($x, $w = 0) { 
 $nombre = 'oddest';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddest = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddest() { 
 return $this->oddest; 
} 





public function set_oddreg($x, $w = 0) { 
 $nombre = 'oddreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddreg() { 
 return $this->oddreg; 
} 





public function set_oddobs($x, $w = 0) { 
 $nombre = 'oddobs';  
 $x = $this->_fix_type($nombre, $x);
 $this->oddobs = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_oddobs() { 
 return $this->oddobs; 
} 



} 

?>
<?php 

require_once 'padreModelo.php';

class pagoModelo extends padreModelo {

  private $value_default = "pago.json";
  public $vista = "pago";
  public $tabla = "pago";
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




  public function get_select_all()
  {
    $res['campo'] = "pagid";
    $res['id'] = $this->get_pagid();
    return $res;
  }

  public function set_id($x, $w = 0)
  {

    if ($x == 0)
    {
      $this->set_pagid($x);
    }
    else
    {
      $this->set_pagid($x, $w);
    }
  }



  public function buscar_pago_parcial($ORDERS_id)
  {


    $sql1 = "select * from  orderDetail where  oddordid in ('".$ORDERS_id."') and oddblo in ('".$this->oddblo_sinpago."');";
    $ORDERDETAIL_RESULT = $this->ejecutar_query($sql1);

    $ORDERDETAIL_RESULT = $this->DATAPRINT__ALL($ORDERDETAIL_RESULT);

    $res.= "<form name='pagoparcial' method='post' action='index.php' ><div class=\"col-xs-12\">
    <table id=\"simple-table\" class=\"table table-striped table-bordered table-hover\">
    <thead>
    <tr>
    <th class=\"center\">
   
    </th>
    <th style='width:20px'>Cant</th>
    <th>Service</th>
    <th>Price</th>

    <th></th>
    </tr>
    </thead>

    <tbody>
   ";


    for($i=0;$i<count($ORDERDETAIL_RESULT);$i++)
    {


          $res.="             
          <tr class=\"\">
          <td class=\"center\">
          <label class=\"pos-rel\">
          <input name='oddid[]' value='".$ORDERDETAIL_RESULT[$i]['oddid']."'  type=\"checkbox\" class=\"ace\">
          <span class=\"lbl\"></span>
          </label>
          </td>

          <td>
          ".$ORDERDETAIL_RESULT[$i]['oddcan']."
          </td>

          <td>
          ".$ORDERDETAIL_RESULT[$i]['odd_srpden']."
          </td>

          <td>".$ORDERDETAIL_RESULT[$i]['oddpvp']."</td>



          <td>
          <div class=\"hidden-sm hidden-xs btn-group\">
               <button class=\"btn btn-xs btn-success\">
              <i class=\"ace-icon fa fa-check bigger-120\"></i>
              </button>

          </div>

          <div class=\"hidden-md hidden-lg\">
          <div class=\"inline pos-rel\">
         
          <button class=\"btn btn-minier btn-primary dropdown-toggle\" data-toggle=\"dropdown\" data-position=\"auto\">
          <i class=\"ace-icon fa fa-cog icon-only bigger-110\"></i>
          </button>

          <ul class=\"dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close\">
          
          <li>
          <a href=\"#\" class=\"tooltip-info\" data-rel=\"tooltip\" title=\"\" data-original-title=\"View\">
          <span class=\"blue\">
          <i class=\"ace-icon fa fa-search-plus bigger-120\"></i>
          </span>
          </a>
          </li>

          </ul>
          </div>
          </div>
          </td>
          </tr>";

    }





    $res.="      
    </tbody>
    </table>
    </div>
    <div class=\"col-xs-12\">

                     <button name=\"pagoparcial\" class=\"btn btn-info\" value=\"true\" type=\"submit\">
                        <i class=\"ace-icon fa fa-check bigger-110\"></i>
                        Submit
                      </button>
    </div>

    </form>";





    return $res;

  }


  public function datatable_pago_parcial($ORDERS_id)
  {


    $sql1 = "select * from  orderDetail where  oddordid in ('".$ORDERS_id."') and oddblo in ('2');";
    $ORDERDETAIL_RESULT = $this->ejecutar_query($sql1);

    $ORDERDETAIL_RESULT = $this->DATAPRINT__ALL($ORDERDETAIL_RESULT);

    $res.= "<form name='pagoparcial' method='post' action='index.php' ><div class=\"col-xs-12\">
    <table id=\"simple-table\" class=\"table table-striped table-bordered table-hover\">
    <thead>
    <tr>
    <th>Service</th>
    <th>Price</th>

    <th></th>
    </tr>
    </thead>

    <tbody>
   ";


    for($i=0;$i<count($ORDERDETAIL_RESULT);$i++)
    {


          $res.="             
          <tr class=\"\">
  
          <td>
          ".$ORDERDETAIL_RESULT[$i]['oddcan']."
          </td>

          <td>
          ".$ORDERDETAIL_RESULT[$i]['odd_srpden']."
          </td>

          <td>".$ORDERDETAIL_RESULT[$i]['oddpvp']."</td>



          <td>
          <div class=\"hidden-sm hidden-xs btn-group\">
               <button class=\"btn btn-xs btn-success\">
              <i class=\"ace-icon fa fa-check bigger-120\"></i>
              </button>

          </div>

          <div class=\"hidden-md hidden-lg\">
          <div class=\"inline pos-rel\">
         
          <button class=\"btn btn-minier btn-primary dropdown-toggle\" data-toggle=\"dropdown\" data-position=\"auto\">
          <i class=\"ace-icon fa fa-cog icon-only bigger-110\"></i>
          </button>

          <ul class=\"dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close\">
          
          <li>
          <a href=\"#\" class=\"tooltip-info\" data-rel=\"tooltip\" title=\"\" data-original-title=\"View\">
          <span class=\"blue\">
          <i class=\"ace-icon fa fa-search-plus bigger-120\"></i>
          </span>
          </a>
          </li>

          </ul>
          </div>
          </div>
          </td>
          </tr>";

    }





    $res.="      
    </tbody>
    </table>
    </div>
    <div class=\"col-xs-12\">

                     <button name=\"pagoparcial\" class=\"btn btn-info\" value=\"true\" type=\"submit\">
                        <i class=\"ace-icon fa fa-check bigger-110\"></i>
                        Submit
                      </button>
    </div>

    </form>";





    return $res;

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


        public $pagid="";
        public $pagtpgid="";
        public $pagcajid="";
        public $pagusuid="";
        public $pagest="";
        public $pagreg="";
        public $pagobs="";
        public $pagtok="";
        public $pagjsn="";
        public $pagmon="";
        public $pagcom="";


        public function set_pagid($x, $w = 0) { 
         $nombre = 'pagid';  
         $x = $this->_fix_type($nombre, $x);
         $this->pagid = $x; 
         if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
        } else { 
          $this->campo[] = $nombre; 
          $this->value[] = $x; 
        } 
      } 
      
      public function get_pagid() { 
       return $this->pagid; 
     } 





     public function set_pagtpgid($x, $w = 0) { 
       $nombre = 'pagtpgid';  
       $x = $this->_fix_type($nombre, $x);
       $this->pagtpgid = $x; 
       if ($w > 0) {
        $this->campo_where[] = $nombre; 
        $this->value_where[] = $x; 
      } else { 
        $this->campo[] = $nombre; 
        $this->value[] = $x; 
      } 
    } 
    
    public function get_pagtpgid() { 
     return $this->pagtpgid; 
   } 





   public function set_pagcajid($x, $w = 0) { 
     $nombre = 'pagcajid';  
     $x = $this->_fix_type($nombre, $x);
     $this->pagcajid = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
    } 
  } 
  
  public function get_pagcajid() { 
   return $this->pagcajid; 
 } 





 public function set_pagusuid($x, $w = 0) { 
   $nombre = 'pagusuid';  
   $x = $this->_fix_type($nombre, $x);
   $this->pagusuid = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
  } 
} 

public function get_pagusuid() { 
 return $this->pagusuid; 
} 





public function set_pagest($x, $w = 0) { 
 $nombre = 'pagest';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagest = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagest() { 
 return $this->pagest; 
} 





public function set_pagreg($x, $w = 0) { 
 $nombre = 'pagreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagreg() { 
 return $this->pagreg; 
} 





public function set_pagobs($x, $w = 0) { 
 $nombre = 'pagobs';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagobs = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagobs() { 
 return $this->pagobs; 
} 





public function set_pagtok($x, $w = 0) { 
 $nombre = 'pagtok';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagtok = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagtok() { 
 return $this->pagtok; 
} 





public function set_pagjsn($x, $w = 0) { 
 $nombre = 'pagjsn';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagjsn = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagjsn() { 
 return $this->pagjsn; 
} 





public function set_pagmon($x, $w = 0) { 
 $nombre = 'pagmon';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagmon = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagmon() { 
 return $this->pagmon; 
} 





public function set_pagcom($x, $w = 0) { 
 $nombre = 'pagcom';  
 $x = $this->_fix_type($nombre, $x);
 $this->pagcom = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_pagcom() { 
 return $this->pagcom; 
} 






public function datatable_cards($CAJA_id){ 

  return  $this->datatable_cards_solicitud($CAJA_id);

}




public function datatable_cards_solicitud($CAJA_id){
  $this->datatable_reset();
  $this->DATATABLE_CONDICIONAL="select * from pago where pagcajid in (".$CAJA_id.") and pagest in ('t');";
  $this->DATATABLE_CONDICIONAL_SQL = true;
  $JSON = $this->json_element($this->tabla,'nuevopago');
  $res =$this->DATATABLE__($JSON);

  return  $res;
}


public function select_all_sql($condicion)
{

  $this->dataprint_data_json = $this->_config_();
  $this->select_select_all = $this->get_select_all();
  $this->sql_combomultiple_id = $this->id_dependiente;    
  $this->select_vista = $this->vista;
  return $this->SELECT__($condicion,'sql');
}



} 

?>
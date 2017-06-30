<?php 

require_once 'padreModelo.php';

class cajaModelo extends padreModelo {

  private $value_default = "caja.json";
  public $vista = "caja";
  public $tabla = "caja";
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
    $res['campo'] = "cajid";
    $res['id'] = $this->get_cajid();
    return $res;
  }

  public function set_id($x, $w = 0)
  {

    if ($x == 0)
    {
      $this->set_cajid($x);
    }
    else
    {
      $this->set_cajid($x, $w);
    }
  }


  public function calculos_caja($CAJA_id)
  {


    $sql="select * from caja where cajest in ('t') and cajid in (".$CAJA_id.")";
    $data = $this->ejecutar_query($sql);

    $data = $this->DATAPRINT__($data);

    $pagado         = $data[0]['cajid_cajpag'];
    $total_a_pagar  = $data[0]['cajtot'];
    $cambio=0;

    $total_a_pagar  = $total_a_pagar - ( ($data[0]['cajdes']/100)*$total_a_pagar );   


    if( ($total_a_pagar-$pagado) <= 0) {

      $por_pagar  = 0;
      $cambio     = ($pagado-$total_a_pagar);

    }if(  ($total_a_pagar-$pagado) == 0) {
      $por_pagar = 0;
    }else if(  ($total_a_pagar-$pagado) > 0) {
      $por_pagar = ($total_a_pagar-$pagado);
    }


    $monto['total_a_pagar']   = $total_a_pagar;
    $monto['por_pagar']       = $por_pagar;
    $monto['pagado']          = $pagado;
    $monto['cambio']          = $cambio;
    return $monto;
  }



  public function boton_pedido($CAJA_id)
  {


    $sql="select * from caja where cajest in ('t') and cajid in (".$CAJA_id.")";
    $data = $this->ejecutar_query($sql);

    $data = $this->DATAPRINT__($data);


    if( ($data[0]['cajtot']-$data[0]['cajid_cajpag']) <= 0) {

    #echo "<br>POR PAGAR  0 ";
    #echo "<br>CAMBIO ".($data[0]['cajid_cajpag']-$data[0]['cajtot']);

    }if(  ($data[0]['cajtot']-$data[0]['cajid_cajpag']) == 0) {

    #echo "<br>PAGAR  0 ";

    }else if(  ($data[0]['cajtot']-$data[0]['cajid_cajpag']) > 0) {

    #echo "<br>POR PAGAR  ".($data[0]['cajtot']-$data[0]['cajid_cajpag']);

    }

    return "<a href='#'
    onclick=\"ajax('oddblo3','OA==','view_orderDetail') \" 
    class=\"btn btn-danger btn-block\" style='font-weight:bold'> CONFIRM 
    </a>";
  }


  public function  cards_total($CAJA_id){

    $RESULT_CAJA = $this->select_all(" cajid in (".$CAJA_id.") ");
    $boton = $this->boton_pedido($CAJA_id);
    $monto = $this->calculos_caja($CAJA_id);
 /*   return "

    <div class='col-xs-12 header'  >
    <div class='col-xs-6' style='text-align:right'>


    <H2> Total a Pagar <br> USD $ ".$monto['total_a_pagar']." </h2>
    <H2> Pagado <br> USD $ ".$monto['pagado']." </h2>

    </div>

    <div class='col-xs-6' style='text-align:right'>


    <H2>  Por pagar  <br> USD $".$monto['por_pagar']."  </H2>
    <H2>  Cambio  <br> USD $".$monto['cambio']."  </H2>

    
    </div>
    <div class='col-xs-12' style='text-align:right'>
     

      <div class='col-xs-6' style='text-align:right'> 
          <a href='#' class=\"btn btn-success btn-block\" >
        <b>  FACTURAR </b>
          </a>
      </div>

       <div class='col-xs-6' style='text-align:right'>
           ".$boton."
       </div>

    </div>

    </div>

    ";
*/

     return "<div class='col-xs-12 '  >


                <table style=\"width:100%; margin:10px\" id=\"totales\" class=\"table_totales cards_total\">
                <tr >
                    <td style='width:200px'> </td> 
                    <td   class='titulo_total' style='width:100px' > Subtotal </td>
                    <td  class='titulo_total' > ".$monto['total_a_pagar']." </td>
                </tr>
                <tr>
                    <td > </td> 
                    <td  class='titulo_total' > Pagado </td>
                    <td  class='titulo_total' >".$monto['pagado']."</td>
                </tr>
                  <tr>
                    <td ></td> 
                    <td class='titulo_total'> Por Pagar </td>
                    <td class='total' >  ".$monto['por_pagar']." </td>
                </tr>
                <tr>
                    <td > </td> 
                    <td class='titulo_total'> Cambio </td>
                    <td class='total' >  ".$monto['cambio']."  </td>
                </tr>   
        


              </table>

               <div class='col-xs-12' >
               ".$boton."
              </div>


      </div>

    ";


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


        public $cajid="";
        public $cajcliid="";
        public $cajordid="";
        public $cajusuid="";
        public $cajest="";
        public $cajreg="";
        public $cajobs="";
        public $cajpro="";
        public $cajmon="";
        public $cajtot="";
        public $cajtax="";
        public $cajdes="";
        public $cajncl="";
        public $cajdcl="";
        public $cajicl="";
        public $cajtyp="";


        public function set_cajid($x, $w = 0) { 
         $nombre = 'cajid';  
         $x = $this->_fix_type($nombre, $x);
         $this->cajid = $x; 
         if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
        } else { 
          $this->campo[] = $nombre; 
          $this->value[] = $x; 
        } 
      } 

      public function get_cajid() { 
       return $this->cajid; 
     } 





     public function set_cajcliid($x, $w = 0) { 
       $nombre = 'cajcliid';  
       $x = $this->_fix_type($nombre, $x);
       $this->cajcliid = $x; 
       if ($w > 0) {
        $this->campo_where[] = $nombre; 
        $this->value_where[] = $x; 
      } else { 
        $this->campo[] = $nombre; 
        $this->value[] = $x; 
      } 
    } 

    public function get_cajcliid() { 
     return $this->cajcliid; 
   } 





   public function set_cajordid($x, $w = 0) { 
     $nombre = 'cajordid';  
     $x = $this->_fix_type($nombre, $x);
     $this->cajordid = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
    } 
  } 

  public function get_cajordid() { 
   return $this->cajordid; 
 } 





 public function set_cajusuid($x, $w = 0) { 
   $nombre = 'cajusuid';  
   $x = $this->_fix_type($nombre, $x);
   $this->cajusuid = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
  } 
} 

public function get_cajusuid() { 
 return $this->cajusuid; 
} 





public function set_cajest($x, $w = 0) { 
 $nombre = 'cajest';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajest = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajest() { 
 return $this->cajest; 
} 





public function set_cajreg($x, $w = 0) { 
 $nombre = 'cajreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajreg() { 
 return $this->cajreg; 
} 





public function set_cajobs($x, $w = 0) { 
 $nombre = 'cajobs';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajobs = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajobs() { 
 return $this->cajobs; 
} 





public function set_cajpro($x, $w = 0) { 
 $nombre = 'cajpro';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajpro = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajpro() { 
 return $this->cajpro; 
} 





public function set_cajmon($x, $w = 0) { 
 $nombre = 'cajmon';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajmon = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajmon() { 
 return $this->cajmon; 
} 





public function set_cajtot($x, $w = 0) { 
 $nombre = 'cajtot';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajtot = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajtot() { 
 return $this->cajtot; 
} 





public function set_cajtax($x, $w = 0) { 
 $nombre = 'cajtax';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajtax = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajtax() { 
 return $this->cajtax; 
} 





public function set_cajdes($x, $w = 0) { 
 $nombre = 'cajdes';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajdes = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajdes() { 
 return $this->cajdes; 
} 





public function set_cajncl($x, $w = 0) { 
 $nombre = 'cajncl';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajncl = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajncl() { 
 return $this->cajncl; 
} 





public function set_cajdcl($x, $w = 0) { 
 $nombre = 'cajdcl';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajdcl = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajdcl() { 
 return $this->cajdcl; 
} 





public function set_cajicl($x, $w = 0) { 
 $nombre = 'cajicl';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajicl = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajicl() { 
 return $this->cajicl; 
} 





public function set_cajtyp($x, $w = 0) { 
 $nombre = 'cajtyp';  
 $x = $this->_fix_type($nombre, $x);
 $this->cajtyp = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_cajtyp() { 
 return $this->cajtyp; 
} 



} 

?>
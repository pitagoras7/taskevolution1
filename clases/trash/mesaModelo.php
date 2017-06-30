<?php 

require_once 'padreModelo.php';

class mesaModelo extends padreModelo {

  private $value_default = "mesa.json";
  public $vista = "mesa";
  public $tabla = "mesa";
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




  public function cardsimple_()
  {
    $data = $this->_config_();
    $this->cardsimple_struct = $data['cardsimple'];

    $this->cardsimple_data = $this->select_all($this->cardsimple_struct['select_conditional']);


    $this->cardsimple_data = $this->tratamiento($this->cardsimple_data);

    #print_r($this->cardsimple_data);


       // $this->cardsimple_data = $this->estatus_mesa();

            //$this->datatable_data = $this->select_all("  ". $est."='t' and ".$campo_dependiente." in (".$this->id_dependiente.")"  );
    return $this->CARDSIMPLE_content();
  }



  public function tratamiento($data){

    $json = $this->_config_();
    $json = $json['cardsimple']['estatu'];


    for($i=0;$i<count( $data ) ; $i++){

     $id =  $data[$i][$json['id']]; 
     $sql="SELECT * FROM ".$json['from']." , mesaCategory c  WHERE  ".$json['where']."  and  ".$json['parametro']." in (".$id.")  and mesmscid = mscid; ";
     $result = $this->ejecutar_query($sql);




     if($result[0][$json['id']]){
       $data[$i]['modo']='istrue';      
       $data[$i]['class_color']=$json['istrue']['class_color'];
       $data[$i]['onclick']=$json['istrue']['onclick'];
       $data[$i]['onclick_parametro']=$json['istrue']['onclick_parametro'];  
       $data[$i]['href']=$json['istrue']['href'];
       $data[$i]['data-toggle']=$json['istrue']['data-toggle'];
       $data[$i]['role']=$json['istrue']['role'];   
       $data[$i]['campo_label_superior']="<i class='fa fa-users'></i> <b>".$result[0]['acmper']."</b>";   
       $data[$i]['ico'] = $result[0]['mscico'];
     
     }else{
       $data[$i]['modo']='isfalse';      
       $data[$i]['class_color']=$json['isfalse']['class_color'];
       $data[$i]['onclick']=$json['isfalse']['onclick'];
       $data[$i]['onclick_parametro']=$json['isfalse']['onclick_parametro'];
       $data[$i]['href']=$json['isfalse']['href'];
       $data[$i]['data-toggle']=$json['isfalse']['data-toggle'];
       $data[$i]['role']=$json['isfalse']['role'];
       $data[$i]['ico'] = $result[0]['mscico'];

     }

   }

   return $data;

 }



 public function get_select_all()
 {
  $res['campo'] = "mesid";
  $res['id'] = $this->get_mesid();
  return $res;
}

public function set_id($x, $w = 0)
{

  if ($x == 0)
  {
    $this->set_mesid($x);
  }
  else
  {
    $this->set_mesid($x, $w);
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


    public $mesid="";
    public $mesmscid="";
    public $messalid="";
    public $mesden="";
    public $mesreg="";
    public $mesest="";
    public $mestam="";
    public $mespsx="";
    public $mespsy="";
    public $mescoo="";


    public function set_mesid($x, $w = 0) { 
     $nombre = 'mesid';  
     $x = $this->_fix_type($nombre, $x);
     $this->mesid = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
    } 
  } 

  public function get_mesid() { 
   return $this->mesid; 
 } 





 public function set_mesmscid($x, $w = 0) { 
   $nombre = 'mesmscid';  
   $x = $this->_fix_type($nombre, $x);
   $this->mesmscid = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
  } 
} 

public function get_mesmscid() { 
 return $this->mesmscid; 
} 





public function set_messalid($x, $w = 0) { 
 $nombre = 'messalid';  
 $x = $this->_fix_type($nombre, $x);
 $this->messalid = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_messalid() { 
 return $this->messalid; 
} 





public function set_mesden($x, $w = 0) { 
 $nombre = 'mesden';  
 $x = $this->_fix_type($nombre, $x);
 $this->mesden = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mesden() { 
 return $this->mesden; 
} 





public function set_mesreg($x, $w = 0) { 
 $nombre = 'mesreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->mesreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mesreg() { 
 return $this->mesreg; 
} 





public function set_mesest($x, $w = 0) { 
 $nombre = 'mesest';  
 $x = $this->_fix_type($nombre, $x);
 $this->mesest = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mesest() { 
 return $this->mesest; 
} 





public function set_mestam($x, $w = 0) { 
 $nombre = 'mestam';  
 $x = $this->_fix_type($nombre, $x);
 $this->mestam = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mestam() { 
 return $this->mestam; 
} 





public function set_mespsx($x, $w = 0) { 
 $nombre = 'mespsx';  
 $x = $this->_fix_type($nombre, $x);
 $this->mespsx = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mespsx() { 
 return $this->mespsx; 
} 





public function set_mespsy($x, $w = 0) { 
 $nombre = 'mespsy';  
 $x = $this->_fix_type($nombre, $x);
 $this->mespsy = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mespsy() { 
 return $this->mespsy; 
} 





public function set_mescoo($x, $w = 0) { 
 $nombre = 'mescoo';  
 $x = $this->_fix_type($nombre, $x);
 $this->mescoo = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
  $this->campo[] = $nombre; 
  $this->value[] = $x; 
} 
} 

public function get_mescoo() { 
 return $this->mescoo; 
} 



} 

?>
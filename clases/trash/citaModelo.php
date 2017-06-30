<?php 

require_once 'padreModelo.php';

class citaModelo extends padreModelo {

 private $value_default = "cita.json";
 public $vista = "cita";
 public $tabla = "cita";
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
   $res['campo'] = "citid";
   $res['id'] = $this->get_citid();
   return $res;
 }

 public function set_id($x, $w = 0)
 {

   if ($x == 0)
   {
     $this->set_citid($x);
   }
   else
   {
     $this->set_citid($x, $w);
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


             public $citid="";
             public $citusuid="";
             public $citpacid="";
             public $citres="";
             public $citdes="";
             public $citedo="";
             public $citavi="";
             public $cittfa="";
             public $cittfb="";
             public $citfec="";
             public $citreg="";
             public $cithor="";
             public $citcor="";
             public $citrsp="";
             public $citobs="";
             public $citden="";

             public $cittur="";


             public function set_cittur($x, $w = 0) { 
               $nombre = 'cittur';  
               $x = $this->_fix_type($nombre, $x);
               $this->cittur = $x; 
               if ($w > 0) {
                $this->campo_where[] = $nombre; 
                $this->value_where[] = $x; 
              } else { 
               $this->campo[] = $nombre; 
               $this->value[] = $x; 
             } 
           } 
           
           public function get_cittur() { 
             return $this->cittur; 
           } 



           public function set_citid($x, $w = 0) { 
             $nombre = 'citid';  
             $x = $this->_fix_type($nombre, $x);
             $this->citid = $x; 
             if ($w > 0) {
              $this->campo_where[] = $nombre; 
              $this->value_where[] = $x; 
            } else { 
             $this->campo[] = $nombre; 
             $this->value[] = $x; 
           } 
         } 

         public function get_citid() { 
           return $this->citid; 
         } 





         public function set_citusuid($x, $w = 0) { 
           $nombre = 'citusuid';  
           $x = $this->_fix_type($nombre, $x);
           $this->citusuid = $x; 
           if ($w > 0) {
            $this->campo_where[] = $nombre; 
            $this->value_where[] = $x; 
          } else { 
           $this->campo[] = $nombre; 
           $this->value[] = $x; 
         } 
       } 

       public function get_citusuid() { 
         return $this->citusuid; 
       } 





       public function set_citpacid($x, $w = 0) { 
         $nombre = 'citpacid';  
         $x = $this->_fix_type($nombre, $x);
         $this->citpacid = $x; 
         if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
        } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
       } 
     } 

     public function get_citpacid() { 
       return $this->citpacid; 
     } 





     public function set_citres($x, $w = 0) { 
       $nombre = 'citres';  
       $x = $this->_fix_type($nombre, $x);
       $this->citres = $x; 
       if ($w > 0) {
        $this->campo_where[] = $nombre; 
        $this->value_where[] = $x; 
      } else { 
       $this->campo[] = $nombre; 
       $this->value[] = $x; 
     } 
   } 

   public function get_citres() { 
     return $this->citres; 
   } 





   public function set_citdes($x, $w = 0) { 
     $nombre = 'citdes';  
     $x = $this->_fix_type($nombre, $x);
     $this->citdes = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
     $this->campo[] = $nombre; 
     $this->value[] = $x; 
   } 
 } 

 public function get_citdes() { 
   return $this->citdes; 
 } 





 public function set_citedo($x, $w = 0) { 
   $nombre = 'citedo';  
   $x = $this->_fix_type($nombre, $x);
   $this->citedo = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
   $this->campo[] = $nombre; 
   $this->value[] = $x; 
 } 
} 

public function get_citedo() { 
 return $this->citedo; 
} 





public function set_citavi($x, $w = 0) { 
 $nombre = 'citavi';  
 $x = $this->_fix_type($nombre, $x);
 $this->citavi = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citavi() { 
 return $this->citavi; 
} 





public function set_cittfa($x, $w = 0) { 
 $nombre = 'cittfa';  
 $x = $this->_fix_type($nombre, $x);
 $this->cittfa = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_cittfa() { 
 return $this->cittfa; 
} 





public function set_cittfb($x, $w = 0) { 
 $nombre = 'cittfb';  
 $x = $this->_fix_type($nombre, $x);
 $this->cittfb = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_cittfb() { 
 return $this->cittfb; 
} 





public function set_citfec($x, $w = 0) { 
 $nombre = 'citfec';  
 $x = $this->_fix_type($nombre, $x);
 $this->citfec = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citfec() { 
 return $this->citfec; 
} 





public function set_citreg($x, $w = 0) { 
 $nombre = 'citreg';  
 $x = $this->_fix_type($nombre, $x);
 $this->citreg = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citreg() { 
 return $this->citreg; 
} 





public function set_cithor($x, $w = 0) { 
 $nombre = 'cithor';  
 $x = $this->_fix_type($nombre, $x);
 $this->cithor = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_cithor() { 
 return $this->cithor; 
} 





public function set_citcor($x, $w = 0) { 
 $nombre = 'citcor';  
 $x = $this->_fix_type($nombre, $x);
 $this->citcor = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citcor() { 
 return $this->citcor; 
} 





public function set_citrsp($x, $w = 0) { 
 $nombre = 'citrsp';  
 $x = $this->_fix_type($nombre, $x);
 $this->citrsp = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citrsp() { 
 return $this->citrsp; 
} 





public function set_citobs($x, $w = 0) { 
 $nombre = 'citobs';  
 $x = $this->_fix_type($nombre, $x);
 $this->citobs = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citobs() { 
 return $this->citobs; 
} 





public function set_citden($x, $w = 0) { 
 $nombre = 'citden';  
 $x = $this->_fix_type($nombre, $x);
 $this->citden = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_citden() { 
  return $this->citden; 
} 



public function select_all_sql($condicion)
{

  $this->dataprint_data_json = $this->_config_();
  $this->select_select_all = $this->get_select_all();
  $this->sql_combomultiple_id = $this->id_dependiente;    
  $this->select_vista = $this->vista;
  return $this->SELECT__($condicion,'sql');
}




public function filtro_datatable($PARAMETRO=""){

  $this->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t') order by citfec desc ";


  if($PARAMETRO=='poratender'){
    $this->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t')  and citedo='Por Atender' ";
  }

  if($PARAMETRO=='porconfirmar'){
    $this->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t')  and citedo='Por confirmar' ";
  }

  if($PARAMETRO=='atendida'){
    $this->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t')  and citedo='Atendida' ";
  } 

  if($PARAMETRO=='anulada'){
    $this->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t')  and citedo='Anulada' ";
  } 

}









} 

?>
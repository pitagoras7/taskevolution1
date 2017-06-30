<?php 
 
 require_once 'padreModelo.php';

class doctorModelo extends padreModelo {

             private $value_default = "doctor.json";
             public $vista = "doctor";
             public $tabla = "doctor";
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
               $res['campo'] = "dcrid";
               $res['id'] = $this->get_dcrid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_dcrid($x);
               }
               else
               {
                 $this->set_dcrid($x, $w);
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


             public $dcrid="";
public $dcrcod="";
public $dcrmps="";
public $dcrfnm="";
public $dcrlnm="";
public $dcresp="";
public $dcrecv="";
public $dcrgen="";
public $dcrnac="";
public $dcrcor="";
public $dcrser="";
public $dcrtip="";
public $dcrdir="";
public $dcrcoo="";
public $dcrtel="";
public $dcrava="";
public $dcrest="";
public $dcrobs="";
public $dcrlog="";
public $dcrpas="";
public $dcract="";
public $dcrtyp="";
public $dcrreg="";
public $dcrusuid="";
public $dcrtok="";
public $dcrico="";
public $dcrfrm="";


 public function set_dcrid($x, $w = 0) { 
       $nombre = 'dcrid';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrid() { 
 return $this->dcrid; 
 } 





 public function set_dcrcod($x, $w = 0) { 
       $nombre = 'dcrcod';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrcod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrcod() { 
 return $this->dcrcod; 
 } 





 public function set_dcrmps($x, $w = 0) { 
       $nombre = 'dcrmps';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrmps = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrmps() { 
 return $this->dcrmps; 
 } 





 public function set_dcrfnm($x, $w = 0) { 
       $nombre = 'dcrfnm';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrfnm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrfnm() { 
 return $this->dcrfnm; 
 } 





 public function set_dcrlnm($x, $w = 0) { 
       $nombre = 'dcrlnm';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrlnm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrlnm() { 
 return $this->dcrlnm; 
 } 





 public function set_dcresp($x, $w = 0) { 
       $nombre = 'dcresp';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcresp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcresp() { 
 return $this->dcresp; 
 } 





 public function set_dcrecv($x, $w = 0) { 
       $nombre = 'dcrecv';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrecv = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrecv() { 
 return $this->dcrecv; 
 } 





 public function set_dcrgen($x, $w = 0) { 
       $nombre = 'dcrgen';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrgen = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrgen() { 
 return $this->dcrgen; 
 } 





 public function set_dcrnac($x, $w = 0) { 
       $nombre = 'dcrnac';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrnac = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrnac() { 
 return $this->dcrnac; 
 } 





 public function set_dcrcor($x, $w = 0) { 
       $nombre = 'dcrcor';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrcor = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrcor() { 
 return $this->dcrcor; 
 } 





 public function set_dcrser($x, $w = 0) { 
       $nombre = 'dcrser';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrser = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrser() { 
 return $this->dcrser; 
 } 





 public function set_dcrtip($x, $w = 0) { 
       $nombre = 'dcrtip';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrtip = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrtip() { 
 return $this->dcrtip; 
 } 





 public function set_dcrdir($x, $w = 0) { 
       $nombre = 'dcrdir';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrdir = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrdir() { 
 return $this->dcrdir; 
 } 





 public function set_dcrcoo($x, $w = 0) { 
       $nombre = 'dcrcoo';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrcoo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrcoo() { 
 return $this->dcrcoo; 
 } 





 public function set_dcrtel($x, $w = 0) { 
       $nombre = 'dcrtel';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrtel = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrtel() { 
 return $this->dcrtel; 
 } 





 public function set_dcrava($x, $w = 0) { 
       $nombre = 'dcrava';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrava = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrava() { 
 return $this->dcrava; 
 } 





 public function set_dcrest($x, $w = 0) { 
       $nombre = 'dcrest';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrest() { 
 return $this->dcrest; 
 } 





 public function set_dcrobs($x, $w = 0) { 
       $nombre = 'dcrobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrobs() { 
 return $this->dcrobs; 
 } 





 public function set_dcrlog($x, $w = 0) { 
       $nombre = 'dcrlog';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrlog = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrlog() { 
 return $this->dcrlog; 
 } 





 public function set_dcrpas($x, $w = 0) { 
       $nombre = 'dcrpas';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrpas = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrpas() { 
 return $this->dcrpas; 
 } 





 public function set_dcract($x, $w = 0) { 
       $nombre = 'dcract';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcract = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcract() { 
 return $this->dcract; 
 } 





 public function set_dcrtyp($x, $w = 0) { 
       $nombre = 'dcrtyp';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrtyp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrtyp() { 
 return $this->dcrtyp; 
 } 





 public function set_dcrreg($x, $w = 0) { 
       $nombre = 'dcrreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrreg() { 
 return $this->dcrreg; 
 } 





 public function set_dcrusuid($x, $w = 0) { 
       $nombre = 'dcrusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrusuid() { 
 return $this->dcrusuid; 
 } 





 public function set_dcrtok($x, $w = 0) { 
       $nombre = 'dcrtok';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrtok = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrtok() { 
 return $this->dcrtok; 
 } 





 public function set_dcrico($x, $w = 0) { 
       $nombre = 'dcrico';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrico = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrico() { 
 return $this->dcrico; 
 } 





 public function set_dcrfrm($x, $w = 0) { 
       $nombre = 'dcrfrm';  
      $x = $this->_fix_type($nombre, $x);
      $this->dcrfrm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_dcrfrm() { 
 return $this->dcrfrm; 
 } 



} 
 
 ?>
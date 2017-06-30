<?php 
 
 require_once 'padreModelo.php';

class pacienteModelo extends padreModelo {

             private $value_default = "paciente.json";
             public $vista = "paciente";
             public $tabla = "paciente";
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
               $res['campo'] = "pacid";
               $res['id'] = $this->get_pacid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_pacid($x);
               }
               else
               {
                 $this->set_pacid($x, $w);
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


             public $pacid="";
public $pacusuid="";
public $paccod="";
public $pactok="";
public $pacfnm="";
public $paclnm="";
public $pacnac="";
public $pacgen="";
public $pacdir="";
public $pacecv="";
public $pacocu="";
public $pacafm="";
public $pacafp="";
public $pacafh="";
public $pacafo="";
public $pacapp="";
public $pacanp="";
public $pacago="";
public $pacapr="";
public $pacale="";
public $pacgps="";
public $paccor="";
public $pactlf="";
public $pactl1="";
public $pactl2="";
public $pactl3="";
public $pactip="";
public $pacava="";
public $pacest="";
public $pacefa="";
public $pacefb="";
public $pacefc="";
public $pacefd="";
public $pacefe="";
public $paceff="";
public $pacefg="";
public $pacefh="";
public $pacefi="";
public $pacefj="";
public $pacefk="";
public $pacobs="";


 public function set_pacid($x, $w = 0) { 
       $nombre = 'pacid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacid() { 
 return $this->pacid; 
 } 





 public function set_pacusuid($x, $w = 0) { 
       $nombre = 'pacusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacusuid() { 
 return $this->pacusuid; 
 } 





 public function set_paccod($x, $w = 0) { 
       $nombre = 'paccod';  
      $x = $this->_fix_type($nombre, $x);
      $this->paccod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_paccod() { 
 return $this->paccod; 
 } 





 public function set_pactok($x, $w = 0) { 
       $nombre = 'pactok';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactok = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactok() { 
 return $this->pactok; 
 } 





 public function set_pacfnm($x, $w = 0) { 
       $nombre = 'pacfnm';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacfnm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacfnm() { 
 return $this->pacfnm; 
 } 





 public function set_paclnm($x, $w = 0) { 
       $nombre = 'paclnm';  
      $x = $this->_fix_type($nombre, $x);
      $this->paclnm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_paclnm() { 
 return $this->paclnm; 
 } 





 public function set_pacnac($x, $w = 0) { 
       $nombre = 'pacnac';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacnac = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacnac() { 
 return $this->pacnac; 
 } 





 public function set_pacgen($x, $w = 0) { 
       $nombre = 'pacgen';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacgen = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacgen() { 
 return $this->pacgen; 
 } 





 public function set_pacdir($x, $w = 0) { 
       $nombre = 'pacdir';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacdir = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacdir() { 
 return $this->pacdir; 
 } 





 public function set_pacecv($x, $w = 0) { 
       $nombre = 'pacecv';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacecv = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacecv() { 
 return $this->pacecv; 
 } 





 public function set_pacocu($x, $w = 0) { 
       $nombre = 'pacocu';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacocu = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacocu() { 
 return $this->pacocu; 
 } 





 public function set_pacafm($x, $w = 0) { 
       $nombre = 'pacafm';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacafm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacafm() { 
 return $this->pacafm; 
 } 





 public function set_pacafp($x, $w = 0) { 
       $nombre = 'pacafp';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacafp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacafp() { 
 return $this->pacafp; 
 } 





 public function set_pacafh($x, $w = 0) { 
       $nombre = 'pacafh';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacafh = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacafh() { 
 return $this->pacafh; 
 } 





 public function set_pacafo($x, $w = 0) { 
       $nombre = 'pacafo';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacafo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacafo() { 
 return $this->pacafo; 
 } 





 public function set_pacapp($x, $w = 0) { 
       $nombre = 'pacapp';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacapp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacapp() { 
 return $this->pacapp; 
 } 





 public function set_pacanp($x, $w = 0) { 
       $nombre = 'pacanp';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacanp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacanp() { 
 return $this->pacanp; 
 } 





 public function set_pacago($x, $w = 0) { 
       $nombre = 'pacago';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacago = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacago() { 
 return $this->pacago; 
 } 





 public function set_pacapr($x, $w = 0) { 
       $nombre = 'pacapr';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacapr = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacapr() { 
 return $this->pacapr; 
 } 





 public function set_pacale($x, $w = 0) { 
       $nombre = 'pacale';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacale = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacale() { 
 return $this->pacale; 
 } 





 public function set_pacgps($x, $w = 0) { 
       $nombre = 'pacgps';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacgps = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacgps() { 
 return $this->pacgps; 
 } 





 public function set_paccor($x, $w = 0) { 
       $nombre = 'paccor';  
      $x = $this->_fix_type($nombre, $x);
      $this->paccor = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_paccor() { 
 return $this->paccor; 
 } 





 public function set_pactlf($x, $w = 0) { 
       $nombre = 'pactlf';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactlf = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactlf() { 
 return $this->pactlf; 
 } 





 public function set_pactl1($x, $w = 0) { 
       $nombre = 'pactl1';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactl1 = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactl1() { 
 return $this->pactl1; 
 } 





 public function set_pactl2($x, $w = 0) { 
       $nombre = 'pactl2';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactl2 = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactl2() { 
 return $this->pactl2; 
 } 





 public function set_pactl3($x, $w = 0) { 
       $nombre = 'pactl3';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactl3 = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactl3() { 
 return $this->pactl3; 
 } 





 public function set_pactip($x, $w = 0) { 
       $nombre = 'pactip';  
      $x = $this->_fix_type($nombre, $x);
      $this->pactip = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pactip() { 
 return $this->pactip; 
 } 





 public function set_pacava($x, $w = 0) { 
       $nombre = 'pacava';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacava = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacava() { 
 return $this->pacava; 
 } 





 public function set_pacest($x, $w = 0) { 
       $nombre = 'pacest';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacest() { 
 return $this->pacest; 
 } 





 public function set_pacefa($x, $w = 0) { 
       $nombre = 'pacefa';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefa = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefa() { 
 return $this->pacefa; 
 } 





 public function set_pacefb($x, $w = 0) { 
       $nombre = 'pacefb';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefb = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefb() { 
 return $this->pacefb; 
 } 





 public function set_pacefc($x, $w = 0) { 
       $nombre = 'pacefc';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefc = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefc() { 
 return $this->pacefc; 
 } 





 public function set_pacefd($x, $w = 0) { 
       $nombre = 'pacefd';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefd = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefd() { 
 return $this->pacefd; 
 } 





 public function set_pacefe($x, $w = 0) { 
       $nombre = 'pacefe';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefe = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefe() { 
 return $this->pacefe; 
 } 





 public function set_paceff($x, $w = 0) { 
       $nombre = 'paceff';  
      $x = $this->_fix_type($nombre, $x);
      $this->paceff = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_paceff() { 
 return $this->paceff; 
 } 





 public function set_pacefg($x, $w = 0) { 
       $nombre = 'pacefg';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefg() { 
 return $this->pacefg; 
 } 





 public function set_pacefh($x, $w = 0) { 
       $nombre = 'pacefh';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefh = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefh() { 
 return $this->pacefh; 
 } 





 public function set_pacefi($x, $w = 0) { 
       $nombre = 'pacefi';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefi() { 
 return $this->pacefi; 
 } 





 public function set_pacefj($x, $w = 0) { 
       $nombre = 'pacefj';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefj = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefj() { 
 return $this->pacefj; 
 } 





 public function set_pacefk($x, $w = 0) { 
       $nombre = 'pacefk';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacefk = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacefk() { 
 return $this->pacefk; 
 } 





 public function set_pacobs($x, $w = 0) { 
       $nombre = 'pacobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->pacobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pacobs() { 
 return $this->pacobs; 
 } 



} 
 
 ?>
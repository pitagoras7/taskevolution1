<?php 
 
 require_once 'padreModelo.php';

class orderReservationModelo extends padreModelo {

            private $value_default = "orderReservation.json";
            public $vista = "orderReservation";
            public $tabla = "orderReservation";
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
            $res['campo'] = "orrid";
            $res['id'] = $this->get_orrid();
            return $res;
        }

        public function set_id($x, $w = 0)
        {

            if ($x == 0)
            {
                $this->set_orrid($x);
            }
            else
            {
                $this->set_orrid($x, $w);
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


      public $orrid="";
public $orrcliid="";
public $orrusuid="";
public $orrordid="";
public $orrmesid="";
public $orrdes="";
public $orrest="";
public $orrreg="";
public $orrini="";
public $orrfin="";
public $orrhin="";
public $orrhfi="";
public $orrcon="";
public $orrtel="";
public $orrdir="";
public $orrtip="";
public $orrblo="";
public $orrobs="";


 public function set_orrid($x, $w = 0) { 
       $nombre = 'orrid';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrid() { 
 return $this->orrid; 
 } 





 public function set_orrcliid($x, $w = 0) { 
       $nombre = 'orrcliid';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrcliid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrcliid() { 
 return $this->orrcliid; 
 } 





 public function set_orrusuid($x, $w = 0) { 
       $nombre = 'orrusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrusuid() { 
 return $this->orrusuid; 
 } 





 public function set_orrordid($x, $w = 0) { 
       $nombre = 'orrordid';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrordid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrordid() { 
 return $this->orrordid; 
 } 





 public function set_orrmesid($x, $w = 0) { 
       $nombre = 'orrmesid';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrmesid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrmesid() { 
 return $this->orrmesid; 
 } 





 public function set_orrdes($x, $w = 0) { 
       $nombre = 'orrdes';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrdes = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrdes() { 
 return $this->orrdes; 
 } 





 public function set_orrest($x, $w = 0) { 
       $nombre = 'orrest';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrest() { 
 return $this->orrest; 
 } 





 public function set_orrreg($x, $w = 0) { 
       $nombre = 'orrreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrreg() { 
 return $this->orrreg; 
 } 





 public function set_orrini($x, $w = 0) { 
       $nombre = 'orrini';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrini = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrini() { 
 return $this->orrini; 
 } 





 public function set_orrfin($x, $w = 0) { 
       $nombre = 'orrfin';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrfin = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrfin() { 
 return $this->orrfin; 
 } 





 public function set_orrhin($x, $w = 0) { 
       $nombre = 'orrhin';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrhin = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrhin() { 
 return $this->orrhin; 
 } 





 public function set_orrhfi($x, $w = 0) { 
       $nombre = 'orrhfi';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrhfi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrhfi() { 
 return $this->orrhfi; 
 } 





 public function set_orrcon($x, $w = 0) { 
       $nombre = 'orrcon';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrcon = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrcon() { 
 return $this->orrcon; 
 } 





 public function set_orrtel($x, $w = 0) { 
       $nombre = 'orrtel';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrtel = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrtel() { 
 return $this->orrtel; 
 } 





 public function set_orrdir($x, $w = 0) { 
       $nombre = 'orrdir';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrdir = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrdir() { 
 return $this->orrdir; 
 } 





 public function set_orrtip($x, $w = 0) { 
       $nombre = 'orrtip';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrtip = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrtip() { 
 return $this->orrtip; 
 } 





 public function set_orrblo($x, $w = 0) { 
       $nombre = 'orrblo';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrblo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrblo() { 
 return $this->orrblo; 
 } 





 public function set_orrobs($x, $w = 0) { 
       $nombre = 'orrobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->orrobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_orrobs() { 
 return $this->orrobs; 
 } 



} 
 
 ?>
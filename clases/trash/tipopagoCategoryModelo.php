<?php 
 
 require_once 'padreModelo.php';

class tipopagoCategoryModelo extends padreModelo {

            private $value_default = "tipopagoCategory.json";
            public $vista = "tipopagoCategory";
            public $tabla = "tipopagoCategory";
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
            $res['campo'] = "tpcid";
            $res['id'] = $this->get_tpcid();
            return $res;
        }

        public function set_id($x, $w = 0)
        {

            if ($x == 0)
            {
                $this->set_tpcid($x);
            }
            else
            {
                $this->set_tpcid($x, $w);
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


      public $tpcid="";
public $tpcden="";
public $tpcest="";
public $tpcreg="";
public $tpcuse="";
public $tpcobs="";
public $tpccol="";
public $tpcico="";
public $tpcava="";


 public function set_tpcid($x, $w = 0) { 
       $nombre = 'tpcid';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcid() { 
 return $this->tpcid; 
 } 





 public function set_tpcden($x, $w = 0) { 
       $nombre = 'tpcden';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcden = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcden() { 
 return $this->tpcden; 
 } 





 public function set_tpcest($x, $w = 0) { 
       $nombre = 'tpcest';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcest() { 
 return $this->tpcest; 
 } 





 public function set_tpcreg($x, $w = 0) { 
       $nombre = 'tpcreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcreg() { 
 return $this->tpcreg; 
 } 





 public function set_tpcuse($x, $w = 0) { 
       $nombre = 'tpcuse';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcuse = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcuse() { 
 return $this->tpcuse; 
 } 





 public function set_tpcobs($x, $w = 0) { 
       $nombre = 'tpcobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcobs() { 
 return $this->tpcobs; 
 } 





 public function set_tpccol($x, $w = 0) { 
       $nombre = 'tpccol';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpccol = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpccol() { 
 return $this->tpccol; 
 } 





 public function set_tpcico($x, $w = 0) { 
       $nombre = 'tpcico';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcico = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcico() { 
 return $this->tpcico; 
 } 





 public function set_tpcava($x, $w = 0) { 
       $nombre = 'tpcava';  
      $x = $this->_fix_type($nombre, $x);
      $this->tpcava = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_tpcava() { 
 return $this->tpcava; 
 } 





public function menu_goback_cards(){
    $res = "<a  style=\"font-size:20px; \" href=\"?opcion=abrirOrders\" class=\"btn btn-primary menu_category_card\" >
     <i class=\"menu-icon fa fa-reply bigger-230\"></i></a>";
    return $res;
}


  public function menu_filter_cards($x=0){

      $result = $this->select_all(" tpcest in ('t') limit ".$x.",5");


            for($i=0;$i<count($result);$i++){

                $this->menu_ico       = $result[$i]['tpcico'];
                $this->menu_den       = $result[$i]['tpcden'];
                $this->menu_col       = $result[$i]['tpccol'];
                $this->menu_class     = " btn  menu_category_card ";
                $this->menu_parametro_onclick = $result[$i]['tpcid_code'];
                $this->menu_parametro_url = "module/".$this->tabla."/tpc_card_ajax.php";
                $this->menu_parametro_view = "view";
                $this->menu_onclick   = "filter_cards_";
                $res.=$this->MENU_3();

            }

      return $res;
  }



public function menu_facturar(){
    $res = "
    <a href=\"#\" style=\"\" class=\"  btn  btn-success  menu_category_card\" onclick=\"\" >
    <i class=\" fa fa-print \"></i> <br> Facturar </a>";
    return $res;
}


public function menu_presupuesto(){
    $res = "
    <a href=\"#\" style=\"\" class=\"  btn  btn-warning  menu_category_card\" onclick=\"\" >
    <i class=\" fa fa-cubes \"></i><br> Presup </a>";
    return $res;
}



} 
 
 ?>
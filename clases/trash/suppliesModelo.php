<?php

require_once 'padreModelo.php';

class suppliesModelo extends padreModelo {

    private $value_default = "supplies.json";
    public $vista = "supplies";
    public $tabla = "supplies";

    public function get_select_all()
    {
        $res['campo'] = "supid";
        $res['id'] = $this->get_supid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_supid($x);
        }
        else
        {
            $this->set_supid($x, $w);
        }
    }

    public $supid = "";
    public $supsucid = "";
    public $supcod = "";
    public $supuni = "";
    public $supmedid = "";
    public $supava = "";
    public $supico = "";
    public $supmax = "";
    public $supmin = "";
    public $supexi = "";
    public $supreg = "";
    public $supuse = "";
    public $supest = "";
    public $supobs = "";
    public $supden = "";

    public function set_supid($x, $w = 0)
    {
        $nombre = 'supid';
        $x = $this->_fix_type($nombre, $x);
        $this->supid = $x;
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

    public function get_supid()
    {
        return $this->supid;
    }

    public function set_supsucid($x, $w = 0)
    {
        $nombre = 'supsucid';
        $x = $this->_fix_type($nombre, $x);
        $this->supsucid = $x;
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

    public function get_supsucid()
    {
        return $this->supsucid;
    }

    public function set_supden($x, $w = 0)
    {
        $nombre = 'supden';
        $x = $this->_fix_type($nombre, $x);
        $this->supden = $x;
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

    public function get_supden()
    {
        return $this->supden;
    }

    public function set_supcod($x, $w = 0)
    {
        $nombre = 'supcod';
        $x = $this->_fix_type($nombre, $x);
        $this->supcod = $x;
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

    public function get_supcod()
    {
        return $this->supcod;
    }

    public function set_supuni($x, $w = 0)
    {
        $nombre = 'supuni';
        $x = $this->_fix_type($nombre, $x);
        $this->supuni = $x;
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

    public function get_supuni()
    {
        return $this->supuni;
    }

    public function set_supmedid($x, $w = 0)
    {
        $nombre = 'supmedid';
        $x = $this->_fix_type($nombre, $x);
        $this->supmedid = $x;
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

    public function get_supmedid()
    {
        return $this->supmedid;
    }

    public function set_supava($x, $w = 0)
    {
        $nombre = 'supava';
        $x = $this->_fix_type($nombre, $x);
        $this->supava = $x;
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

    public function get_supava()
    {
        return $this->supava;
    }

    public function set_supico($x, $w = 0)
    {
        $nombre = 'supico';
        $x = $this->_fix_type($nombre, $x);
        $this->supico = $x;
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

    public function get_supico()
    {
        return $this->supico;
    }

    public function set_supmax($x, $w = 0)
    {
        $nombre = 'supmax';
        $x = $this->_fix_type($nombre, $x);
        $this->supmax = $x;
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

    public function get_supmax()
    {
        return $this->supmax;
    }

    public function set_supmin($x, $w = 0)
    {
        $nombre = 'supmin';
        $x = $this->_fix_type($nombre, $x);
        $this->supmin = $x;
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

    public function get_supmin()
    {
        return $this->supmin;
    }

    public function set_supexi($x, $w = 0)
    {
        $nombre = 'supexi';
        $x = $this->_fix_type($nombre, $x);
        $this->supexi = $x;
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

    public function get_supexi()
    {
        return $this->supexi;
    }

    public function set_supreg($x, $w = 0)
    {
        $nombre = 'supreg';
        $x = $this->_fix_type($nombre, $x);
        $this->supreg = $x;
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

    public function get_supreg()
    {
        return $this->supreg;
    }

    public function set_supuse($x, $w = 0)
    {
        $nombre = 'supuse';
        $x = $this->_fix_type($nombre, $x);
        $this->supuse = $x;
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

    public function get_supuse()
    {
        return $this->supuse;
    }

    public function set_supest($x, $w = 0)
    {
        $nombre = 'supest';
        $x = $this->_fix_type($nombre, $x);
        $this->supest = $x;
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

    public function get_supest()
    {
        return $this->supest;
    }

    public function set_supobs($x, $w = 0)
    {
        $nombre = 'supobs';
        $x = $this->_fix_type($nombre, $x);
        $this->supobs = $x;
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

    public function get_supobs()
    {
        return $this->supobs;
    }

    /* MODAL */

    public function modal_($data, $modo = 'edit')
    {


        $data_json = $this->_config_();
        $form_new = $data_json['form_'];
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

    /* DATATABLE */

    public function datatable_()
    {
        $data = $this->_config_();
        $this->datatable_struct = $data['datatable'];
        $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
        return $this->DATATABLE_content();
    }

    /* FUNCIONES BASICAS */

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

    public function _dataprint_($data)
    {

        $data = $this->DATAPRINT__($data, $this->_config_());

        return $data;
    }

    public function select_all($condicion = '0')
    {

        $this->dataprint_data_json = $this->_config_();
        $this->select_select_all = $this->get_select_all();
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
                #   echo "El fichero es válido y se subió con éxito.\n";
            }
            else
            {
                echo "¡Posible ataque de subida de ficheros!\n";
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


    public function cardsimple_($cardsimple_condicional="")
  {
    $data = $this->_config_();
    $this->cardsimple_struct = $data['cardsimple'];


    if($cardsimple_condicional==""){
    $this->cardsimple_data = $this->select_all($this->cardsimple_struct['select_conditional']);        
    }else{
    $this->cardsimple_data = $this->select_all($cardsimple_condicional);
    }



    $this->cardsimple_data = $this->tratamiento($this->cardsimple_data);

    #print_r($this->cardsimple_data);


       // $this->cardsimple_data = $this->estatus_mesa();

            //$this->datatable_data = $this->select_all("  ". $est."='t' and ".$campo_dependiente." in (".$this->id_dependiente.")"  );
    return $this->CARDSIMPLE_content(2);
  }  

  public function tratamiento($data){

    $json = $this->_config_();
    $json = $json['cardsimple']['estatu'];


    for($i=0;$i<count( $data ) ; $i++){

     $id =  $data[$i][$json['id']]; 
     $sql="SELECT * FROM ".$json['from']." WHERE  ".$json['where']."  and  ".$json['parametro']." in (".$id.")  ; ";
     $result = $this->ejecutar_query($sql);


     if($result[0][$json['id']]){
       $data[$i]['modo']='istrue';      
       $data[$i]['class_color']=$result[0]['succol'];
       $data[$i]['onclick']=$json['istrue']['onclick'];
       $data[$i]['onclick_parametro']=$json['istrue']['onclick_parametro'];  
       $data[$i]['href']=$json['istrue']['href'];
       $data[$i]['data-toggle']=$json['istrue']['data-toggle'];
       $data[$i]['role']=$json['istrue']['role'];   
       $data[$i]['campo_label_superior']= $result[0]['sucden'];   
       $data[$i]['ava']= "distXP/img/supplies/".$result[0]['supico'];   

     }else{
       $data[$i]['modo']='isfalse';      
       $data[$i]['class_color']=$json['isfalse']['class_color'];
       $data[$i]['onclick']=$json['isfalse']['onclick'];
       $data[$i]['onclick_parametro']=$json['isfalse']['onclick_parametro'];
       $data[$i]['href']=$json['isfalse']['href'];
       $data[$i]['data-toggle']=$json['isfalse']['data-toggle'];
       $data[$i]['role']=$json['isfalse']['role'];


     }

   }

   return $data;

 }

}

?>
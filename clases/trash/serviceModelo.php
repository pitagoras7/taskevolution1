<?php

require_once 'padreModelo.php';

class serviceModelo extends padreModelo {

    private $value_default = "service.json";
    public $vista = "service";
    public $tabla = "service";

    public function get_select_all()
    {
        $res['campo'] = "srvid";
        $res['id'] = $this->get_srvid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_srvid($x);
        }
        else
        {
            $this->set_srvid($x, $w);
        }
    }

    public $srvid = "";
    public $srvcanid = "";
    public $srvsrcid = "";
    public $srvden = "";
    public $srvcod = "";
    public $srvava = "";
    public $srvico = "";
    public $srvobs = "";
    public $srvpvp = "";
    public $srvexe = "";
    public $srvest = "";
    public $srvreg = "";
    public $srvuse = "";

    public function set_srvid($x, $w = 0)
    {
        $nombre = 'srvid';
        $x = $this->_fix_type($nombre, $x);
        $this->srvid = $x;
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

    public function get_srvid()
    {
        return $this->srvid;
    }

    public function set_srvcanid($x, $w = 0)
    {
        $nombre = 'srvcanid';
        $x = $this->_fix_type($nombre, $x);
        $this->srvcanid = $x;
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

    public function get_srvcanid()
    {
        return $this->srvcanid;
    }

    public function set_srvsrcid($x, $w = 0)
    {
        $nombre = 'srvsrcid';
        $x = $this->_fix_type($nombre, $x);
        $this->srvsrcid = $x;
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

    public function get_srvsrcid()
    {
        return $this->srvsrcid;
    }

    public function set_srvden($x, $w = 0)
    {
        $nombre = 'srvden';
        $x = $this->_fix_type($nombre, $x);
        $this->srvden = $x;
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

    public function get_srvden()
    {
        return $this->srvden;
    }

    public function set_srvcod($x, $w = 0)
    {
        $nombre = 'srvcod';
        $x = $this->_fix_type($nombre, $x);
        $this->srvcod = $x;
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

    public function get_srvcod()
    {
        return $this->srvcod;
    }

    public function set_srvava($x, $w = 0)
    {
        $nombre = 'srvava';
        $x = $this->_fix_type($nombre, $x);
        $this->srvava = $x;
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

    public function get_srvava()
    {
        return $this->srvava;
    }

    public function set_srvico($x, $w = 0)
    {
        $nombre = 'srvico';
        $x = $this->_fix_type($nombre, $x);
        $this->srvico = $x;
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

    public function get_srvico()
    {
        return $this->srvico;
    }

    public function set_srvobs($x, $w = 0)
    {
        $nombre = 'srvobs';
        $x = $this->_fix_type($nombre, $x);
        $this->srvobs = $x;
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

    public function get_srvobs()
    {
        return $this->srvobs;
    }

    public function set_srvpvp($x, $w = 0)
    {
        $nombre = 'srvpvp';
        $x = $this->_fix_type($nombre, $x);
        $this->srvpvp = $x;
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

    public function get_srvpvp()
    {
        return $this->srvpvp;
    }

    public function set_srvexe($x, $w = 0)
    {
        $nombre = 'srvexe';
        $x = $this->_fix_type($nombre, $x);
        $this->srvexe = $x;
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

    public function get_srvexe()
    {
        return $this->srvexe;
    }

    public function set_srvest($x, $w = 0)
    {
        $nombre = 'srvest';
        $x = $this->_fix_type($nombre, $x);
        $this->srvest = $x;
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

    public function get_srvest()
    {
        return $this->srvest;
    }

    public function set_srvreg($x, $w = 0)
    {
        $nombre = 'srvreg';
        $x = $this->_fix_type($nombre, $x);
        $this->srvreg = $x;
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

    public function get_srvreg()
    {
        return $this->srvreg;
    }

    public function set_srvuse($x, $w = 0)
    {
        $nombre = 'srvuse';
        $x = $this->_fix_type($nombre, $x);
        $this->srvuse = $x;
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

    public function get_srvuse()
    {
        return $this->srvuse;
    }

    /* MODAL */

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

    public function view_($data)
    {

        $this->view_data = $data;
        $this->view_display = false;

        $this->VIEW_body_row('srvden', 'Nombre ', 8);
        $this->VIEW_body_row('srvava', 'Avatar ', 4);


        return $this->VIEW_content();
    }

    /* DATATABLE */

    
    
    
    public function datatable_()
    {
        $data = $this->_config_();
        $this->datatable_struct = $data['datatable'];
        $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
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
        return $this->SAVE__();
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

    //print_r($this->cardsimple_data);
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



                             if($result[0]['srvmod']==1){
                                    $json['istrue']['onclick'] = "direct_modal_odd_click";
                                    $href="#";
                                    $data_modal="";    
                             }

                            

                            if($result[0]['srvmod']==2){
                                   $json['istrue']['onclick'] = "new_modal_odd_click";
                                   $href = $json['istrue']['href'];
                                   $data_modal = $json['istrue']['data-toggle'];
                             }



                            if($result[0]['srvmod']==4){
                                   $json['istrue']['onclick'] = "new_modal_odd_click";
                                   $href = $json['istrue']['href'];
                                   $data_modal = $json['istrue']['data-toggle'];
                             }




                             if($result[0][$json['id']]){
                               $data[$i]['modo']='istrue';      
                               $data[$i]['class_color']=$result[0]['srccol'];
                               $data[$i]['onclick']=$json['istrue']['onclick'];
                               $data[$i]['onclick_parametro']=$json['istrue']['onclick_parametro'];  
                               $data[$i]['href']=$href;
                               $data[$i]['data-toggle']=$data_modal;
                               $data[$i]['role']=$json['istrue']['role'];   
                               $data[$i]['campo_label_superior']=" USD $ ".$result[0]['srvpvp']; 
                               $data[$i]['ico']="ace-icon ".$result[0]['srcico']." bigger-230"; 
                               $data[$i]['ava']="distXP/img/services/".$result[0]['srvava']; 

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

}

?>
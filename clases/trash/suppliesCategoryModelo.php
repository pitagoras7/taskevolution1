<?php

require_once 'padreModelo.php';

class suppliesCategoryModelo extends padreModelo {

    private $value_default = "suppliesCategory.json";
    public $vista = "suppliesCategory";
    public $tabla = "suppliesCategory";

    public function get_select_all()
    {
        $res['campo'] = "sucid";
        $res['id'] = $this->get_sucid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_sucid($x);
        }
        else
        {
            $this->set_sucid($x, $w);
        }
    }


    public function menu_more_cards($x){


        $x= $x+3;
        

        $result = $this->select_all(" sucest in ('t') limit ".$x.",4");
        if( count($result)<1 ){
        $x=0;
        } 


        $res = "
        <a  onclick=\" ajax('spc_limit',".$x.",'panel_opciones') \" href=\"#\" class=\"btn menu_category_card\" >
        <i class=\"fa fa-chevron-right\" aria-hidden=\"true\" style=\"margin-top:15px;font-size: 20px; margin-left: -5px;\"></i>
        <br>
        </a>";

        return $res;

    }




    public function menu_minus_cards($x){


        $x= 3-$x;
        $result = $this->select_all(" sucest in ('t') limit ".$x.",4");
        if( count($result)<1 ){
        $x=0;
        } 

        $res = "
        <a  onclick=\" ajax('spc_limit_minus',".$x.",'panel_opciones') \" href=\"#\" class=\"btn menu_category_card\" >
        <i class=\"fa fa-chevron-left\" aria-hidden=\"true\" style=\"margin-top:15px;font-size: 20px; margin-left: -5px;\"></i>
        <br>
        </a>";

        return $res;

    }





    public function menu_goback_cards(){

        $res = "
        <a  style=\"height:69px\" 
        href=\"?opcion=abrirOrders\" 
        class=\"btn  btn-primary menu_category_card\" >
      <i class=\"menu-icon fa fa-reply bigger-230\"></i>          
        </a>";

        return $res;

    }

    public function menu_con_cards(){

        $res = "<a  style=\"\" href=\"#\" class=\"btn  btn-success botonyes menu_category_card\" onclick=\"botonplus(1)\">
        <i class=\"menu-icon fa fa-plus bigger-230\" ></i> <!--<br>       
        <span class=\"menu-text\">CON</span>--></a>";

        return  $res;

    }



    public function menu_sin_cards(){

        $res = "<a href=\"#\" style=\"display:none\" class=\" btn  btn-danger botonno menu_category_card\" onclick=\"botonplus(0)\" >
        <i class=\"menu-icon fa fa-minus bigger-230\"></i>          
        <!-- <span class=\"menu-text\">SIN</span>--> </a>";

        return  $res;

    }





public function menu_filter_cards($x)
{

            $result = $this->select_all(" sucest in ('t') limit ".$x.",4");

            if( count($result)<1 ){
                $result = $this->select_all(" sucest in ('t') limit 0,4");
            } 

            for($i=0;$i<count($result);$i++){
                $this->menu_reset(); 
                $this->menu_ico                 = $result[$i]['sucico'];
                $this->menu_den                 = $result[$i]['sucden'];
                $this->menu_col                 = $result[$i]['succol'];
                $this->menu_class               = "btn menu_category_card ";
                $this->menu_style               = " width:120px ";

                $this->menu_parametro_onclick   = $result[$i]['sucid_code'];
                $this->menu_parametro_url       = "module/".$this->tabla."/cards/sup/sup_cards_ajax.php";
                $this->menu_parametro_view      = "view";
                $this->menu_onclick             = "filter_cards_";
                $res.=$this->MENU_3();
            }

    return $res;
}




    public $sucid = "";
    public $sucden = "";
    public $sucest = "";
    public $sucreg = "";
    public $sucuse = "";
    public $sucobs = "";

    public function set_sucid($x, $w = 0)
    {
        $nombre = 'sucid';
        $x = $this->_fix_type($nombre, $x);
        $this->sucid = $x;
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

    public function get_sucid()
    {
        return $this->sucid;
    }

    public function set_sucden($x, $w = 0)
    {
        $nombre = 'sucden';
        $x = $this->_fix_type($nombre, $x);
        $this->sucden = $x;
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

    public function get_sucden()
    {
        return $this->sucden;
    }

    public function set_sucest($x, $w = 0)
    {
        $nombre = 'sucest';
        $x = $this->_fix_type($nombre, $x);
        $this->sucest = $x;
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

    public function get_sucest()
    {
        return $this->sucest;
    }

    public function set_sucreg($x, $w = 0)
    {
        $nombre = 'sucreg';
        $x = $this->_fix_type($nombre, $x);
        $this->sucreg = $x;
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

    public function get_sucreg()
    {
        return $this->sucreg;
    }

    public function set_sucuse($x, $w = 0)
    {
        $nombre = 'sucuse';
        $x = $this->_fix_type($nombre, $x);
        $this->sucuse = $x;
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

    public function get_sucuse()
    {
        return $this->sucuse;
    }

    public function set_sucobs($x, $w = 0)
    {
        $nombre = 'sucobs';
        $x = $this->_fix_type($nombre, $x);
        $this->sucobs = $x;
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

    public function get_sucobs()
    {
        return $this->sucobs;
    }

    /* MODAL */

    public function modal_($data, $modo = 'edit')
    {


        $data_json = $this->_config_();
        $form_new = $data_json['form_new'];
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

  }

  ?>
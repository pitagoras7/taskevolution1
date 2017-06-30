<?php

require_once 'padreModelo.php';

class viewModelo extends padreModelo {


  public function dashboardConsultaVisor($DATA=""){

    return " <div class=\"col-md-12\" style=\" height:80px\">


    <div class=\"col-md-3 botonDashboard\" style=\"\" onclick=\"openModalDatatablecitaDashboard('poratender')\">
    <table  style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-child\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:16px; font-weight:bold\">
    <span style=\"font-size:22px; \">".$DATA['poratender']."</span> En espera
    </div>
    </tr>
    </table>
    </div>


    <div onclick=\"openModalDatatablecitaDashboard('porconfirmar')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-clock-o\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \">".$DATA['porconfirmar']."  </span> Sin confirmar
    </div>
    </tr>
    </table>
    </div>


    <div onclick=\"openModalDatatablecitaDashboard('atendida')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-check\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \"> ".$DATA['atendida']."  </span> Atendidos
    </div>
    </tr>
    </table>
    </div>



    <div  onclick=\"openModalDatatablecitaDashboard('anulada')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-close\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \"> ".$DATA['anulada']."  </span> Canceladas
    </div>
    </tr>
    </table>
    </div>


    </div>


    <div id=\"visor\" class=\"col-md-12\" style=\"background:#eee; border-radius:5px; height:500px\">

    ".$DATA['datatable']."


    </div>";

  }



  public function dashboardPacienteVisor($DATA=""){

    return " <div class=\"col-md-12\" style=\" height:80px\">


    <div class=\"col-md-3 botonDashboard\" style=\"\" onclick=\"openModalDatatableconsultaDatatableIndividual(0)\">
    <table  style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-child\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:16px; font-weight:bold\">
    <span style=\"font-size:22px; \">".$DATA['consulta']."</span> Consultas
    </div>
    </tr>
    </table>
    </div>


    <div onclick=\"openModalDatatablereporteMedicoDatatableIndividual('informe')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-clock-o\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \">".$DATA['informe']."  </span> Informes
    </div>
    </tr>
    </table>
    </div>


    <div onclick=\"openModalDatatablereporteMedicoDatatableIndividual('referencia')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-check\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \"> ".$DATA['referencia']."  </span> Referencias
    </div>
    </tr>
    </table>
    </div>



    <div  onclick=\"openModalDatatablecitaDashboard('anulada')\" class=\"col-md-3 botonDashboard\" style=\"\">
    <table style=\"width:100%; height:50px; font-size:14px; background:#F5F5F5; color:#333; margin-top:10px; padding-bottom:10px; border-radius:5px; \">
    <tr>
    <td ><i style=\"font-size:33px; padding-left:10px; margin-top:5px; margin-right:10px;\" class=\"fa fa-close\"></i></td>
    <td > 
    <div style=\"margin-top:5px;  font-size:15px; font-weight:bold\">
    <span style=\"font-size:18px; \"> ".$DATA['anulada']."  </span>  ###
    </div>
    </tr>
    </table>
    </div>


    </div>


    <div id=\"visor\" class=\"col-md-12\" style=\"background:#eee; border-radius:5px; height:500px\">

    ".$DATA['datatable']."


    </div>";

  }





  public function grafica_citas($div){


    return "<script> 

    function activar_citas(){

        // Build the chart
      $('#".$div."').highcharts({
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: 'Browser market shares January, 2015 to May, 2015'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false
            },
            showInLegend: true
          }
        },
        series: [{
          name: 'Brands',
          colorByPoint: true,
          data: [{
            name: 'En espera',
            y: 3,
            sliced: true,
            selected: true
          }, {
            name: 'Sin Confirmar',
            y: 8
          }, {
            name: 'Confirmadas',
            y: 13
          },  {
            name: 'Anuladas',
            y: 5
          }]
        }]
      });

}


</script> 
";


} 


public function grafica_evolucionMedica($div){

  return "

  <script> 

  function activar_evolucionMedica(){

    $('#".$div."').highcharts({
      title: {
        text: 'Monthly Average Temperature',
        x: -20 //center
      },
      subtitle: {
        text: 'Source: WorldClimate.com',
        x: -20
      },
      xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      yAxis: {
        title: {
          text: 'Temperature (°C)'
        },
        plotLines: [{
          value: 0,
          width: 1,
          color: '#808080'
        }]
      },
      tooltip: {
        valueSuffix: '°C'
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
      },
      series: [{
        name: 'Tokyo',
        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
      }, {
        name: 'New York',
        data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
      }, {
        name: 'Berlin',
        data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
      }, {
        name: 'London',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
      }]
    });




}


</script> 

";


}



public function products($URL_JSON,$NAME){

  $str_datos = file_get_contents($URL_JSON);
  $JSON = json_decode($str_datos, true);
  fwrite($fh, json_encode($JSON, JSON_UNESCAPED_UNICODE));
  fclose($fh);

  $JSON = $JSON[$NAME];

  $res.= "
  <div class=\"carousel carousel-slider center ".$NAME." \" data-indicators=\"true\" style=\"display:none; height:400px !important;\">";


  for($i=0;$i<count($JSON);$i++){

        if($i==0){
        $res.="<div class=\"carousel-item grey darken-1 white-text\" href=\"#one!\">";
        }

        if($i==24){
        $res.="<div class=\"carousel-item teal lightgrey darken-1 white-text\" href=\"#two!\">";
        }

        if($i==48){
        $res.="<div class=\"carousel-itemgrey darken-1 white-text\" href=\"#three!\">";
        }



  $res.= "<a  inicial=\"".substr($JSON[$i]['name'],1)."\" onclick=\"add_product('".$JSON[$i]['code']."','".$JSON[$i]['name']."','".$JSON[$i]['price']."','".$JSON[$i]['exento']."')\"  class=\"waves-effect waves-light btn col m3 ".$JSON[$i]['class']."  ".$JSON[$i]['category']." \" >".$JSON[$i]['name']."</a>";
  

        if($i==(count($JSON)-1)){
        $res.="</div>";
        }else if($i==23){
        $res.="</div>";
        }else if($i==47){
        $res.="</div>";
        }else if($i==60){
        $res.="</div>";
        }


  }

  $res.= "</div>";


  return $res;



}


public function supplies($URL_JSON,$NAME){

  $str_datos = file_get_contents($URL_JSON);
  $JSON = json_decode($str_datos, true);
  fwrite($fh, json_encode($JSON, JSON_UNESCAPED_UNICODE));
  fclose($fh);

  $JSON = $JSON[$NAME];

  $res.= "
  <div class=\"carousel carousel-slider center ".$NAME." \" data-indicators=\"true\" style=\"display:none; height:400px !important;\">";


  for($i=0;$i<count($JSON);$i++){

        if($i==0){
        $res.="<div class=\"carousel-item grey darken-1 white-text\" href=\"#one!\">";
        }

        if($i==24){
        $res.="<div class=\"carousel-item grey darken-1 white-text\" href=\"#two!\">";
        }

        if($i==48){
        $res.="<div class=\"carousel-item grey darken-1 white-text\" href=\"#three!\">";
        }



  $res.= "<a  inicial=\"".substr($JSON[$i]['name'],0,1)."\" onclick=\"add_supplies('".$JSON[$i]['code']."','".$JSON[$i]['name']."','".$JSON[$i]['price']."')\"  class=\"waves-effect waves-light btn col m3 ".$JSON[$i]['class']."  ".$JSON[$i]['category']." \" >".$JSON[$i]['name']."</a>";
  

        if($i==(count($JSON)-1)){
        $res.="</div>";
        }else if($i==23){
        $res.="</div>";
        }else if($i==47){
        $res.="</div>";
        }else if($i==60){
        $res.="</div>";
        }


  }

  $res.= "</div>";


  return $res;



}


public function test(){
  echo "HOLA MUNDO";
}


}

$VIEW = new viewModelo();

?>
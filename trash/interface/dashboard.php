<?php
session_start();
require_once '../url.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>



  <div class="row" >

    <div class="col s12 m3" style="background:#f5f5f5; display:none" id="panel1">

      <a class="waves-effect waves-light btn col m12"  id="panel_visor_total" style="">
        <div style='font-size:26px; width:50%; float:left; text-align:left'  id="div_total" >$ 0 </div>
        <div style='font-size:20px; width:40%; float:left; text-align:right' id="div_cambio">$ 0 <sup>DEV</sup></div>
     </a>

     <a class="waves-effect waves-light btn col m4" style="height:30px; padding-top:2px; font-size:16px" id="div_tax" >
     $ 0
     </a>

     <a class="waves-effect waves-light btn col m4" style="height:30px; padding-top:2px; font-size:16px" id="div_subtotal">
     $ 0
     </a>

     <a class="waves-effect waves-light btn col m3" style="height:30px; padding-top:2px; font-size:16px" id="div_subtotal1" >
     $ 0
     </a>

     <a  href="#" data-activates="slide-out" class="waves-effect waves-light btn  button-collapse col m7" style="height:30px; padding-top:2px; font-size:16px" id="div_cliente_name">
      N/E
     </a>

     <a class="waves-effect waves-light btn col m4" style="height:30px; padding-top:2px; font-size:16px" id="div_typeOrder" >
     DELIVERY
     </a>


     <div class="  col m12 LCD " style="height:auto; color:#000" >


     </div>



   </div>

















   <div class="col s12 m2  grey lighten-1"  id="panel2">


     <a class="waves-effect waves-light btn col m12  principal  principal1" id="modify" > N/A BEWS  </a>
     <a class="waves-effect waves-light btn col m12 principal   principal2" id="principal_soup" > SOUP </a>
     <a class="waves-effect waves-light btn col m12 principal  principal3" id="principal_panini" > PANINI </a>
     <a class="waves-effect waves-light btn col m12 principal  principal4" id="principal_menu"> MENU </a>
     <a class="waves-effect waves-light btn col m12 principal  principal5" id="principal_authcc"> AUTH CC  </a>
     <a class="waves-effect waves-light btn col m12 principal   principal6" id="principal_cash"> CASH </a>


     <a class="waves-effect waves-light btn col m12 menu menu1" > Back </a>
     <a class="waves-effect waves-light btn col m12 menu menu2" > N/A BEWS  </a>
     <a class="waves-effect waves-light btn col m12 menu menu3"  > PASTA </a>
     <a class="waves-effect waves-light btn col m12 menu menu4" > MAIN COURSE </a>
     <a class="waves-effect waves-light btn col m12 menu menu5" >  DESSERT </a>
     <a class="waves-effect waves-light btn col m12 menu menu6" >  KIDS MENU  </a>
     <a class="waves-effect waves-light btn col m12 menu menu7" > ESPECIAL </a>
     <a class="waves-effect waves-light btn col m12 menu menu8" > PANINI </a>
     <a class="waves-effect waves-light btn col m12 menu menu9" > SOUP ENSALATE </a>

     <a class="waves-effect waves-light btn col m12 bews bews1" > Back  </a>
     <a class="waves-effect waves-light btn col m12 bews bews2"  > FOOD </a>
     <a class="waves-effect waves-light btn col m12 bews bews3" > BEER </a>
     <a class="waves-effect waves-light btn col m12 bews bews4" >  RED WINE </a>
     <a class="waves-effect waves-light btn col m12 bews bews5" >  WHITE WINE </a>
     <a class="waves-effect waves-light btn col m12 bews bews6" > GLASS WINE* </a>
     <a class="waves-effect waves-light btn col m12 bews bews7" > DES* WINE? </a>



     <a class="waves-effect waves-light btn col m12 modify modify1" > BACK  </a>
     <a class="waves-effect waves-light btn col m12 modify modify2"  >A - F</a>
     <a class="waves-effect waves-light btn col m12 modify modify3" >G - H</a>
     <a class="waves-effect waves-light btn col m12 modify modify4" >N - R</a>
     <a class="waves-effect waves-light btn col m12 modify modify5" >S -Z</a>
     <a class="waves-effect waves-light btn col m4 modify modify9 numerico" >1</a>
     <a class="waves-effect waves-light btn col m4 modify modify10 numerico" >2</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >3</a>
     <a class="waves-effect waves-light btn col m4 modify modify9 numerico" >4</a>
     <a class="waves-effect waves-light btn col m4 modify modify10 numerico" >5</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >6</a>
     <a class="waves-effect waves-light btn col m4 modify modify9 numerico" >7</a>
     <a class="waves-effect waves-light btn col m4 modify modify10 numerico" >8</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >9</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >0</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >00</a>
     <a class="waves-effect waves-light btn col m4 modify modify11 numerico" >DEL</a>

   </div>















   <div class="col s12 m7  green lighten-3"  id="panel3" >



    <div class="row">

      <div class="col s12 m12 grey lighten-1"  id="panel31">



        <a class="waves-effect waves-light btn col m3 principal principal1  " > SEND & PICK UP</a>
        <a class="waves-effect waves-light btn col m2 principal principal2  " > SEND </a>
        <a class="waves-effect waves-light btn col m2 principal principal3  " > PRINT </a>

        <a onclick="add_condition('WITH')" class="waves-effect waves-light btn col m2 modify modify1  " > WITH </a>
        <a onclick="add_condition('NO')"  class="waves-effect waves-light btn col m2 modify modify2  " > NO </a>
        <a  onclick="add_condition('ON SIDE')"   class="waves-effect waves-light btn col m2 modify modify3  " > ON SIDE </a>
        <a  onclick="add_condition('SUB')"   class="waves-effect waves-light btn col m2 modify modify4  " > SUB </a>
        <a  onclick="add_condition('SEE SERVER')"   class="waves-effect waves-light btn col m2 modify modify5  " > SEE SERVER </a>
        <a onclick="add_condition('???')"   class="waves-effect waves-light btn col m2 modify modify6  " > ???? </a>

        <a class="waves-effect waves-light btn col m2 bews bews1  " > HOT </a>
        <a class="waves-effect waves-light btn col m2 bews bews2  " > COLD </a>
        <a class="waves-effect waves-light btn col m3 bews bews3  " >  SEND & PICK UP </a>
        <a class="waves-effect waves-light btn col m2 bews bews4  " >  SEND </a>
        <a class="waves-effect waves-light btn col m2 bews bews5  " > PRINT </a>



      </div>









<div class="col s12 m12 carousel  " style="background:gray" id="panel32" >

<?php echo $VIEW->products('panini.json','panini'); ?>
<?php echo $VIEW->products('bews.json','bews'); ?>
<?php echo $VIEW->products('soap.json','soap'); ?>
<?php echo $VIEW->products('pasta.json','pasta'); ?>
<?php echo $VIEW->products('kidscombo.json','kidscombo'); ?>
<?php echo $VIEW->products('dessert.json','dessert'); ?>
<?php echo $VIEW->products('maincourse.json','maincourse'); ?>
<?php echo $VIEW->supplies('supplies.json','supplies'); ?>


</div>
























  <div class="col s12 m12  grey lighten-1"  id="panel33">


   <a class="waves-effect waves-light btn col m3 principal principal1  " >ENTER P/U  TIME </a>
   <a class="waves-effect waves-light btn col m3 principal principal2  " >EXTRAS</a>
   <a class="waves-effect waves-light btn col m3 principal principal3 " >MODIFY</a>
   <a class="waves-effect waves-light btn col m3 principal principal4 " >OPEN FOOD</a>
   <a class="waves-effect waves-light btn col m3 principal principal5 " >DISPLAY ITEMS</a>
   <a class="waves-effect waves-light btn col m3 principal principal6 " >DINNER IN A BOX</a>
   <a class="waves-effect waves-light btn col m3 principal principal7 " >PAY</a>
   <a class="waves-effect waves-light btn col m3 principal principal8 " >CANCEL</a>


   <a class="waves-effect waves-light btn col m3 modify modify1 " >ENTER YES</a>
   <a class="waves-effect waves-light btn col m3 modify modify2 " >ENTER NO</a>
   <a href="#" onclick="void_product()" class="waves-effect waves-light btn col m3 modify modify3 "  >VOID</a>
   <a class="waves-effect waves-light btn col m3 modify modify4 " >CANCEL</a>

 </div>

</div>



</div>

<!--
<div class="col s12 m1" style="background:purple" id="panel4">
 <a class="waves-effect waves-light btn col m12 " > opcion 1</a>
 <a class="waves-effect waves-light btn col m12 nav_button " > opcion 1</a>
 <a class="waves-effect waves-light btn col m12  nav_button" > opcion 1</a>
 <a class="waves-effect waves-light btn col m12 " > opcion 1</a>
</div>
-->

</div>


<div id="slide-out" class="side-nav grey lighten-1" style="width:600px;">

 <div class="col m12" style="margin:10px;" >
 <input name="client_name" style="color:#333;font-size:32px;height:60px; width:400px;">
</div>


 <div  data-name-cliente="Albert Peck"   data-id-cliente="1"  data-code-cliente="424 898.73.34"     class=" list_cliente   col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p1.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Albert Peck </span>
</div>

 <div   data-name-cliente="Alice Broke"   data-id-cliente="2"  data-code-cliente="424 898.73.34"   class=" list_cliente  col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p2.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Alice Broke </span>
</div>
 <div  data-name-cliente=" Grace Lin "   data-id-cliente="3"  data-code-cliente="424 898.73.34"    class=" list_cliente  col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p3.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Grace Lin </span>
</div>
 <div   data-name-cliente="Carl Goty "   data-id-cliente="4"  data-code-cliente="424 898.73.34"   class=" list_cliente  col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p4.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Carl Goty </span>
</div>
 <div  data-name-cliente="Jason Ocket"   data-id-cliente="5"  data-code-cliente="424 898.73.34"    class=" list_cliente  col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p5.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Jason Ocket </span>
</div>
 <div  data-name-cliente="Jhon Doe"   data-id-cliente="6"  data-code-cliente="424 898.73.34"    class=" list_cliente  col m12 waves-effect waves-light btn  teal lighten-5" style="margin:10px; text-align:left; padding:20px;  height:100px; width:90% "  >
  <img class="circle" src="DATA/p6.jpg" style="width:50px">
  <span class="name" style="color:#333;font-size:32px; position:relative; top:-10px"> Jhon Doe </span>
</div>



</div>






<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="materialize/js/materialize.js"></script>
<script src="materialize/js/input.js"></script>

</body>
</html>

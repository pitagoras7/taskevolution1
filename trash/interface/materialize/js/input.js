
window.idproduct	= "";
window.condition    = "";
window.tax_oficial	= 10;
var pedido 				= new Array();
var detallePedido		= new Array();
pedido.detalle 			= new Array();


localStorage.lastname = "Smith";

$(document).ready(function(){
	$('.carousel.carousel-slider').carousel({full_width: true});
	inicializar();
	console.log(pedido);

  $('.button-collapse').sideNav({
      menuWidth: 600, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
  );

theme();
	/* PANINI */


	$( ".numerico" ).click(function() {

		var  num = this.text;

		$.each(window.pedido.detalle,function(i,detalle){

			if(detalle.codigo == idproduct){

			if(num=='DEL'){
				detalle.cantidad=1;
			}else if(detalle.cantidad==1){
			detalle.cantidad = num;
			}else{
			detalle.cantidad = detalle.cantidad+num;
			}


		}
	});


		LCD();

	});




				$( ".list_cliente" ).click(function() {


				window.pedido.cliente_name 	= 	$( this ).attr( "data-name-cliente" );
				window.pedido.cliente_id 	= 	$( this ).attr( "data-id-cliente" );
				window.pedido.cliente_code 	= 	$( this ).attr( "data-code-cliente" );
			    $('.button-collapse').sideNav('hide');

				console.log(window.pedido);
				LCD();
				});





				$( ".modify.modify2" ).click(function() {
			    $( " .carousel.supplies a" ).css( "display", "none" );
			    $( " .carousel.supplies a[inicial='A']" ).css( "display", "inline-block" );
			    $( " .carousel.supplies a[inicial='B']" ).css( "display", "inline-block" );
			    $( " .carousel.supplies a[inicial='C']" ).css( "display", "inline-block" );
			    $( " .carousel.supplies a[inicial='D']" ).css( "display", "inline-block" );
			    $( " .carousel.supplies a[inicial='E']" ).css( "display", "inline-block" );
			    $( " .carousel.supplies a[inicial='F']" ).css( "display", "inline-block" );
				});







});





function costofinal(x,y,z){

/* z es tipo exento  o  no exento , x es el costo base , y es el impuesto */
if(z=="true"){
return x;
}else{
return ( parseFloat(x)*( parseFloat(y/100) )+parseFloat(x) );
}

}


function add_product(a,b,c,d){

	//tokenTransaccion = Math.floor( Math.random() * 9000000000 ) + 10000000;
	var producto 		= new Array();
	producto.codigo 	= a;
	producto.nombre 	= b;
	producto.estatu  	= true;
	producto.cantidad 	= 1;
	producto.exento 	= d;
	producto.supplies 	= new Array();
	producto.costo  	= costofinal(c,10,d);
	producto.total  	= costofinal(c,10,d);

	window.pedido.detalle.push(producto);
	//console.log(producto);
	//console.log(window.pedido);
	LCD();

}


function calculos_pedido(){

	var total = 0;
	var total_i = 0;
	var total_e = 0;


	$.each(window.pedido.detalle,function(i,detalle){


		if(detalle.estatu==true){

			if(detalle.exento=="true"){

			total_e = ( parseFloat(detalle.costo ) + parseFloat( total_e ) )*detalle.cantidad;

			detalle.total = parseFloat( parseFloat(detalle.costo ) * detalle.cantidad ).toFixed(2);;

			}

			if(detalle.exento=="false"){

			total_i =  ( parseFloat(detalle.costo) + parseFloat(total_i) )*detalle.cantidad;

			detalle.total = parseFloat( parseFloat(detalle.costo ) * detalle.cantidad ).toFixed(2);;


			}

		}

	});


	window.pedido.total_exento  = parseFloat(total_e).toFixed(2);

	window.pedido.total_tax 	= parseFloat(total_i).toFixed(2);

	window.pedido.tax      		= parseFloat( parseFloat(total_i) * parseFloat(window.tax_oficial/100) ).toFixed(2);

	window.pedido.subtotal 		=  ( parseFloat( parseFloat(window.pedido.total_exento)+ parseFloat(window.pedido.total_tax) ).toFixed(2) ) - window.pedido.tax;

	window.pedido.total      	=  parseFloat(parseFloat(total_e) +  parseFloat(total_i)).toFixed(2);

	console.log(window.pedido);
}




function LCD(){

    calculos_pedido();

	$(".LCD a").remove();

	$.each(window.pedido.detalle,function(i,detalle){


		if(detalle.estatu==true){

			$(".LCD").append("<a id=\"product"+detalle.codigo+"\"  href='#' onclick=\"code_product('"+detalle.codigo+"')\" class=\"col s12 m12 product \" ><div style='text-align:left'   class=\"col s12 m1 cantidad\">"+detalle.cantidad+" </div><div style='text-align:left; line-height:22px; '  class=\"col s12 m8\"> "+detalle.nombre+"</div><div style='text-align:right' class=\"col s12 m3\"> "+detalle.total+"</div></a>");
		}

		var codigo_producto = detalle.codigo;

		$.each(detalle.supplies,function(i,sup){

			if(sup.estatu==true){

				$("#product"+codigo_producto).append("<a  id=\"supplies"+sup.codigo+"\"  href='#' onclick=\"delete_supplies("+sup.codigo+","+codigo_producto+")\" class=\"col s12 m12\" style=\"text-align:left;font-size:14px; color:red\" ><span>"+sup.condicion+"</span>&nbsp;<span>"+sup.nombre+"</span></a>");

			}
		});



	});


$('#div_total').text('$ '+window.pedido.total);
$('#div_subtotal').text('$ '+window.pedido.subtotal);
$('#div_tax').text('$ '+window.pedido.tax);
$('#div_cliente_name').text(window.pedido.cliente_name);


}




function inicializar(){
	pedido.token = "17727533";
	pedido.user = "1";
	pedido.userName = "Carlos Castillo";
	pedido.typeOrder = "Here";
	pedido.typeOrderCode = "1";
	pedido.emision = "12/12/2016";
	pedido.mesa = null;
}


function void_product(){

	$("#product"+idproduct).remove();

	$.each(window.pedido.detalle,function(i,detalle){
		if(detalle.codigo == idproduct){
			detalle.estatu = false;
		}
	});

}


function add_supplies(x,y,z){

	if(condition==""){
		condition="WITH";
	}

	//$("#product"+idproduct).append("<a  id=\"supplies"+x+"\"  href='#' onclick=\"delete_supplies("+x+","+idproduct+")\" class=\"col s12 m12\" style=\"color:red\" ><div class=\"col s12 m4\">"+condition+"</div><div style='text-align:left'  class=\"col s12 m8\"> "+y+"</div></a>");

	$.each(window.pedido.detalle,function(i,detalle){
		if(detalle.codigo == idproduct){
			var sup = new Array();
			sup.codigo = x;
			sup.nombre = y;
			sup.categoria = z;
			sup.estatu = true;
			sup.condicion = condition;
			detalle.supplies.push(sup);
		}
	});
	LCD();

	console.log(window.pedido);
}






function delete_supplies(x,y){

	$("#supplies"+x).remove();

	$.each(window.pedido.detalle,function(i,detalle){

		if(detalle.codigo == y){

			$.each(detalle.supplies,function(i,sup){
				if(sup.codigo == x){
					sup.estatu = false;
				}
			});

		}

	});

	console.log(window.pedido);

}




function update(){

	$.get('test.php', { update : true, token: token }, function(resp) {


		//var dato = JSON.parse(resp);

		console.log(resp);


		/*$.each(dato.products,function(i,n){
                    //$('#img_test').attr('src','data:image/png;base64,'+n.news_det_image);
                    console.log(dato.products[i].token);
                });
	*/

});

}




$( "#panel2 .principal.principal4" ).click(function() {
	$("#panel2 a").css("display","none");
	$("#panel2 .menu").css("display","inline-block");

});


$( "#panel2 .menu.menu1" ).click(function() {
	$("#panel2 a").css("display","none");
	$("#panel2 .principal").css("display","inline-block");
});



/* BEWS */
$( "#panel2 .principal.principal1, #panel2 .menu.menu2" ).click(function() {
	$("#panel2 a").css("display","none");
	$("#panel2 .bews").css("display","inline-block");
	$("#panel31 a").css("display","none");
	$("#panel31 .bews").css("display","inline-block");

	$("#panel32 .carousel.panini").css("display","none");
	$("#panel32 .carousel.bews").css("display","inline-block");
	$("#panel32 .carousel.bews_products").css("display","inline-block");
	$("#panel32 .carousel.bews").css("height","400px");

});




/* PANINI */
$( "#panel2 .principal.principal3, #panel2 .menu.menu6" ).click(function() {

	$("#panel32 .carousel").css("display","none");


	$("#panel32 .panini").css("display","inline-block");
	$("#panel32 .carousel.panini").css("display","inline-block");
	$("#panel32 .carousel.panini").css("height","400px");
	$("#panel32 .panini .panini_product").css("display","inline-block");
});





/* SOAP */
$( "#panel2 .principal.principal2" ).click(function() {

	$("#panel32 .carousel").css("display","none");


	$("#panel32 .soap").css("display","inline-block");
	$("#panel32 .carousel.soap").css("display","inline-block");
	$("#panel32 .carousel.soap").css("height","400px");
	$("#panel32 .soap .soap_product").css("display","inline-block");
});

/* PASTA */
$( "#panel2 .menu.menu3" ).click(function() {

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .pasta").css("display","inline-block");
	$("#panel32 .carousel.pasta").css("display","inline-block");
	$("#panel32 .carousel.pasta").css("height","400px");
	$("#panel32 .pasta .pasta_product").css("display","inline-block");
});


/* kids combo */
$( "#panel2 .menu.menu6" ).click(function() {

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .kidscombo").css("display","inline-block");
	$("#panel32 .carousel.kidscombo").css("display","inline-block");
	$("#panel32 .carousel.kidscombo").css("height","400px");
	$("#panel32 .kidscombo .kidscombo_product").css("display","inline-block");
});


/* MAIN COURSE */
$( "#panel2 .menu.menu4" ).click(function() {

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .maincourse").css("display","inline-block");
	$("#panel32 .carousel.maincourse").css("display","inline-block");
	$("#panel32 .carousel.maincourse").css("height","400px");
	$("#panel32 .maincourse .maincourse_product").css("display","inline-block");
});





/* dessert */
$( "#panel2 .menu.menu5" ).click(function() {

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .dessert").css("display","inline-block");
	$("#panel32 .carousel.dessert").css("display","inline-block");
	$("#panel32 .carousel.dessert").css("height","400px");
	$("#panel32 .dessert .dessert_product").css("display","inline-block");
});


$( "#panel2 .bews.bews1" ).click(function() {
	$("#panel2 a").css("display","none");
	$("#panel2 .principal").css("display","inline-block");
	$("#panel31 a").css("display","none");
	$("#panel31 .principal").css("display","inline-block");

	$("#panel32 .carousel").css("display","none");



});




/* MODIFY  */
$( "#panel33 .principal.principal3" ).click(function() {
	$("#panel2 a").css("display","none");
	$("#panel2 .modify").css("display","inline-block");
	$("#panel31 a").css("display","none");
	$("#panel31 .modify").css("display","inline-block");
	$("#panel33 a").css("display","none");
	$("#panel33 .modify").css("display","inline-block");

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .supplies").css("display","inline-block");
	$("#panel32 .carousel.supplies").css("display","inline-block");
	$("#panel32 .carousel.supplies").css("height","400px");
	$("#panel32 .supplies .supplies_product").css("display","inline-block");

});







$( "#panel2 .modify.modify1" ).click(function() {
	$("#panel32 .carousel").css("display","none");

	$("#panel2 a").css("display","none");
	$("#panel2 .principal").css("display","inline-block");
	$("#panel31 a").css("display","none");
	$("#panel31 .principal").css("display","inline-block");
	$("#panel33 a").css("display","none");
	$("#panel33 .principal").css("display","inline-block");

});




function code_product(x){

	idproduct = x;

	$("#panel2 a").css("display","none");
	$("#panel2 .modify").css("display","inline-block");
	$("#panel31 a").css("display","none");
	$("#panel31 .modify").css("display","inline-block");
	$("#panel33 a").css("display","none");
	$("#panel33 .modify").css("display","inline-block");

	$("#panel32 .carousel").css("display","none");

	$("#panel32 .supplies").css("display","inline-block");
	$("#panel32 .carousel.supplies").css("display","inline-block");
	$("#panel32 .carousel.supplies").css("height","400px");
	$("#panel32 .supplies .supplies_product").css("display","inline-block");

	$(".LCD .product").css("background","white");
	$("#product"+idproduct).css("background","yellow");


}

function add_condition(x){
	condition = x;
}



function theme(){


$('#panel2 .btn.principal').addClass('deep-orange darken-4');
$('#panel2 .btn.menu').addClass('orange accent-4');
$('#panel2 .btn.bews').addClass('cyan darken-3');

$('#panel33 .btn.principal').addClass('orange accent-4');
$('#panel31 .btn.principal').addClass('cyan darken-3');

$('#panel2 .btn.modify').addClass('orange accent-4');
$('#panel31 .btn.modify').addClass('cyan darken-3');
$('#panel33 .btn.modify').addClass('deep-orange darken-4');

$('#panel31 .btn.bews').addClass('deep-orange darken-4');

$('#panel2 .btn.modify.numerico').addClass('cyan darken-3');
$('#panel2 .btn.modify.numerico').removeClass('orange accent-4');


$('#panel_visor_total').addClass('grey darken-4');
$('#div_tax').addClass('grey darken-4');
$('#div_subtotal').addClass('grey darken-4');
$('#div_subtotal1').addClass('grey darken-4');
$('#div_cliente_name').addClass('cyan darken-3');
$('#div_typeOrder').addClass('cyan darken-3');

$('#panel32 .carousel a').addClass('light-green lighten-3');
$('#panel32 .carousel a').addClass('black-text');


}

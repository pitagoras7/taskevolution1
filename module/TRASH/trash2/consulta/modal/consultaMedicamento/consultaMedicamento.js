            function openConsultaMedicamento(x) {
            	goto_lsdajax_consultaMedicamento('openConsultaMedicamento', [x], 'content-modal-consultaMedicamento','module/consulta/modal/consultaMedicamento/consultaMedicamento_AJAX.php');   
            }



            var consultaMedicamento = {
            	"url": null,
            	"salida": null,
            	"motivo": null,
            	"parametro": [],
            	"url_neta": null,
            	"ejecutar": function () {

            		div = this.salida;
            		var ajax = objetoAjax();



            		ajax.open("POST",this.url_neta, true);
            		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            		ajax.send("accion=" + this.motivo + "&parametro=" + this.parametro);


            		ajax.onreadystatechange = function () {

            			if (ajax.readyState < 4) {
            				document.getElementById(div).innerHTML = "";
            			}

            			if (ajax.readyState == 4) {


            				if (div !== null) {

            					document.getElementById(div).innerHTML = ajax.responseText;
            				}

            				datatable_consultaMedicamento();

            			}
            		}
            	}


            };




            function goto_lsdajax_consultaMedicamento(motivo, parametro, salida,url) {
            	var x = consultaMedicamento;
            	x.parametro = parametro;
            	x.motivo = motivo;
            	x.salida = salida;
            	x.url_neta = url;
            	x.ejecutar();
            }




            function datatable_consultaMedicamento() {

            	var myTable = $('#table').DataTable({
            		bAutoWidth: false,
            		"aaSorting": [],
            		"iDisplayLength": 200
            	});


                        /* SOLO PASAR UNO 

                          $('#table tbody').on( 'click', 'td', function () {
                              $('#conidx').val(myTable.cell( this ).data());
                          } );


            */


                          /* PASAR VARIOS 


                          $('#table tbody').on( 'click', 'td', function () {
                              $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
                          } );

            */

            /* importante revisar el id del campo donde se pasara la data en este caso es #conidx */


                   $('#table tbody').on( 'click', 'td', function () {

                      $('#conreq').val($('#conreq').val()+' | '+myTable.cell( this ).data());

                      } );







            $('#table tbody').on( 'click', 'tr', function () {
            	var dato =   myTable.row( this ).data() ;
            });




        }



        function verConsultaMedicamento(x){
        	medicamento = '#'+x+'campo0';
        	posologia 	= '#'+x+'campo2';
        	var xxx 	= '- '+$(medicamento).val()+' \n    '+$(posologia).val()+'';
        	$('#jqte-conpos').val($('#jqte-conpos').val()+' \n\n '+xxx);

			var yyy 	= $(medicamento).val();
        	$('#jqte-conind').val($('#jqte-conind').val()+' \n\n '+yyy);

        }


        function addConsultaMedicamento(x,y,zzz){
        	fecha 			= '#'+x+'campo6';
        	plan  			= '#'+x+'campo11';
        	diagnostico 	= '#'+x+'campo13';
        	var xxx = '__________________________________________________\nFECHA :'+$(fecha).val()+' \nPLAN :'+$(plan).val()+' \nDIX : '+$(diagnostico).val();
        	$('#element-form-rmcadj').val($('#element-form-rmcadj').val()+' \n '+xxx);
        }

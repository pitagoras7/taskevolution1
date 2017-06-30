


                  function openModalDatatabledjuntoInforme(x) {
                  	 $( "#element-rmcadj" ).append( "<a  onclick=\"clearAdjuntoInforme()\" ><i style='font-size:20px; color:#333; position: absolute;top: 3%;left: 5%;' class='fa fa-trash'></i></a>" );
                     goto_lsdajax_AdjuntoInforme('edit_consultaAdjuntoInforme', [x], 'content-modal-consultaAdjuntoInforme','module/consulta/modal/consultaAdjuntoInforme/consultaAdjuntoInforme_AJAX.php');
                      
                    }



                  var AdjuntoInforme = {
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

                              datatable_AdjuntoInforme();

                              }
                          }
                      }


                  };



                  function goto_lsdajax_AdjuntoInforme(motivo, parametro, salida,url) {
                      var x = AdjuntoInforme;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }



                   function datatable_AdjuntoInforme() {


                           var myTable = $('#table').DataTable({
                               bAutoWidth: false,
                               "aaSorting": [],
                               "iDisplayLength": 50
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
                          //$('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());       
                           });

		                    $('#table tbody').on( 'click', 'tr', function () {
		                    //      var dato =   myTable.row( this ).data() ;
		                      //       console.log( dato[1] );
		                    });




                         }

                    

                         function ver(x,y,z){
                         nombre = '#'+x+'campo2';
                         valor  = '#'+x+'campo3';
                         var xxx = $(nombre).val()+' '+$(valor).val();
                         $('#conidx').val($('#conidx').val()+' \n '+xxx);
                         }




                         function addConsulta(x,y,zzz){
                         fecha 			= '#'+x+'campo6';
                         motivo  			= '#'+x+'campo31';
                         diagnostico 	= '#'+x+'campo13';
                         var xxx = '__________________________________________________\nFECHA :'+$(fecha).val()+' \nMotivo Consulta :'+$(motivo).val()+' \nDIX : '+$(diagnostico).val();
                         $('#element-form-rmcadj').val($('#element-form-rmcadj').val()+' \n '+xxx);
                         }



						function clearAdjuntoInforme(){
						 $('#element-form-rmcadj').val("");
						}
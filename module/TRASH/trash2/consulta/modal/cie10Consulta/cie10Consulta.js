

                  /*



                  "<a onclick="openModalDatatablecie10Consulta(0)" 
                  data-toggle="modal"  href="#modal-cie10Consulta">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatablecie10Consulta(x) {
                     goto_lsdajax_cie10Consulta('openModalDatatablecie10Consulta', [x], 'content-modal-cie10Consulta','module/consulta/modal/cie10Consulta/cie10Consulta_AJAX.php');   
                    }



                  var cie10Consulta = {
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

                              datatable_cie10Consulta();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_cie10Consulta(motivo, parametro, salida,url) {
                      var x = cie10Consulta;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_cie10Consulta() {

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
                                
                          //$('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
                                   
                                } );


                




                      $('#table tbody').on( 'click', 'tr', function () {
                          var dato =   myTable.row( this ).data() ;
                              console.log( dato[1] );
                      });




                         }

                    

                         function ver(x){
                         nombre = '#'+x+'campo2';
                         valor  = '#'+x+'campo3';
                         var xxx = $(nombre).val()+' '+$(valor).val();
                         $('#conidx').val($('#conidx').val()+' \n '+xxx);
                         }

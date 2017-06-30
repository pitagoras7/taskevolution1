

                  /*



                  "<a onclick="openModalDatatableconsultaDashboardconsulta(0)" 
                  data-toggle="modal"  href="#modal-consultaDashboardconsulta">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatableconsultaDashboardconsulta(x) {
                     goto_lsdajax_consultaDashboardconsulta('openModalDatatableconsultaDashboardconsulta', [x], 'visor','module/consulta/modal/consultaDashboardconsulta/consultaDashboardconsulta_AJAX.php');
                      
                    }



                  var consultaDashboardconsulta = {
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

                              datatable_consultaDashboardconsulta();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_consultaDashboardconsulta(motivo, parametro, salida,url) {
                      var x = consultaDashboardconsulta;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_consultaDashboardconsulta() {

                           var myTable = $('#table').DataTable({
                              bAutoWidth: true,
                               "aaSorting": [],
                               "iDisplayLength": 7,
                                "lengthMenu": [7]
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

                          $( ".dataTables_length" ).append( "<div class='titulo_datatable'><i class='fa fa-stethoscope'></i> Listado de  Consultas </div>" );


                                $('#table tbody').on( 'click', 'td', function () {
                                 //   $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
                                } );

                         }




                    function verconsultaDashboardconsulta(x){
             
                    }


                    function addconsultaDashboardconsulta(x,y,zzz){
          
                    }










                    
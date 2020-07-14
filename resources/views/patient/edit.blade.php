@extends('layouts.app')

@section('css_scripts')
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ asset('gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="{{ asset('gentelella/vendors/normalize-css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('gentelella/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="{{ asset('gentelella/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('gentelella/vendors/cropper/dist/cropper.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    Dossier du patient : Kazi Aouel Sid Ahmed
@endsection


@section('content')

  <div>
      <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Patients</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stripped table <small>Stripped table subtitle</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hover rows <small>Try hovering over the rows</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Boardered table <small>Bordered table subtitle</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
            </div>

    </div>
  </div>

  {{-- ---------------------------------Modals -------------------------------- --}}

  <!-- Schéma Dentaire -->
  <div id="schema_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" {{-- style="width:1200px" --}}>

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Schéma dentaire</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <img src="{{ asset('img/schema.jpg') }}" alt="Schéma dentaire" width="500px" height="500px">
          </div>
          <div class="col-md-3">
            <h3>Plan de traitement</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Actes</th>
                  <th>Prix</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select name="" id="" class="form-control">
                      <option value="">Acte 1</option>
                    </select>
                  </td>
                  <td>500 DA</td>
                  <td><input type="checkbox" ></td>
                </tr>
                <tr>
                  <td>
                    <select name="" id="" class="form-control">
                      <option value="">Acte 1</option>
                    </select>
                  </td>
                  <td>500 DA</td>
                  <td><input type="checkbox" ></td>
                </tr>
                <tr>
                  <td>
                    <select name="" id="" class="form-control">
                      <option value="">Acte 1</option>
                    </select>
                  </td>
                  <td>500 DA</td>
                  <td><input type="checkbox" ></td>
                </tr>
                <tr>
                  <td>
                    <select name="" id="" class="form-control">
                      <option value="">Acte 1</option>
                    </select>
                  </td>
                  <td>500 DA</td>
                  <td><input type="checkbox" ></td>
                </tr>
                <tr>
                  <td>
                    <select name="" id="" class="form-control">
                      <option value="">Acte 1</option>
                    </select>
                  </td>
                  <td>500 DA</td>
                  <td><input type="checkbox" ></td>
                </tr>                                                               
              </tbody>
              <tfoot>
                <tr>
                  <td>TOTAL</td>
                  <td>3000 DA</td>
                </tr>
              </tfoot>
            </table>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Devis</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#facture"><i class="fa fa-dollar"></i> Encaiser</button>
      </div>
    </div>

  </div>
  </div>       
  <!-- END Schéma Dentaire -->
   
  <!-- Facture -->
  <div id="facture_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" >

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Facture/Devis</h4>
        </div>
        <div class="modal-body">
          <div class="row">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#facture">Imprimer</button>
        </div>
      </div>

    </div>
  </div>
  <!-- END Facture --> 

  <!-- Prescription --> 
  <div id="prescription_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" >

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nouvelle Prescription</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-md-6">
              <div class="input-group">
                <label for="Médicament">Médicament</label>
                <input type="text" name="" id="" class="form-control">
              </div>

              <button class="btn btn-primary">Ajouter</button>
            </div>
            <div class="col-xs-12 col-md-6">
              <table class="table">
                <thead>
                  <tr>
                    <th>Liste des Médicaments</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Médicament 1</td>
                    <td><i class="fa fa-close"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success" >Valider</button>
        </div>
      </div>

    </div>
  </div>
  <!-- END Prescription -->

  {{-- ---------------------------------END Modals -------------------------------- --}}

@endsection

@section('js_scripts')
    <!-- bootstrap-wysiwyg -->
    <script src="{{ asset('gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ asset('gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <!-- Switchery -->
    <script src="{{ asset('gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('gentelella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Parsley -->
    <script src="{{ asset('gentelella/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <!-- Autosize -->
    <script src="{{ asset('gentelella/vendors/autosize/dist/autosize.min.js') }}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{ asset('gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <!-- starrr -->
    <script src="{{ asset('gentelella/vendors/starrr/dist/starrr.js') }}"></script>

    <script>
      $(document).ready( function () {
          if ($("#payments").length) {
          $("#payments").DataTable({
            dom: "Bfrtip",
            buttons: [
            {
              extend: "copy",
              className: "btn-sm"
            },
            {
              extend: "csv",
              className: "btn-sm"
            },
            {
              extend: "excel",
              className: "btn-sm"
            },
            {
              extend: "pdfHtml5",
              className: "btn-sm"
            },
            {
              extend: "print",
              className: "btn-sm"
            },
            ],
            responsive: true
          });
          }        
          // if ($("#plans").length) {
          // $("#plans").DataTable({
          //   dom: "Bfrtip",
          //   buttons: [
          //   {
          //     extend: "copy",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "csv",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "excel",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "pdfHtml5",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "print",
          //     className: "btn-sm"
          //   },
          //   ],
          //   responsive: true
          // });
          // }          
          // if ($("#traitements").length) {
          // $("#traitements").DataTable({
          //   dom: "Bfrtip",
          //   buttons: [
          //   {
          //     extend: "copy",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "csv",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "excel",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "pdfHtml5",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "print",
          //     className: "btn-sm"
          //   },
          //   ],
          //   responsive: true
          // });
          // }          
          // if ($("#prescriptions").length) {
          // $("#prescriptions").DataTable({
          //   dom: "Bfrtip",
          //   buttons: [
          //   {
          //     extend: "copy",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "csv",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "excel",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "pdfHtml5",
          //     className: "btn-sm"
          //   },
          //   {
          //     extend: "print",
          //     className: "btn-sm"
          //   },
          //   ],
          //   responsive: true
          // });
          // }          
        $('#payments').DataTable();
        $('#plans').DataTable();
        $('#patients').DataTable();
        $('#prescriptions').DataTable();
        $('#traitements').DataTable();
        
      } );
    </script>
@endsection


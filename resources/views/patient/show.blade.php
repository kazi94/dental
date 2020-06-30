<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<<<<<<< HEAD
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,300&family=Rubik:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
=======
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        <meta name="msapplication-tap-highlight" content="no">
        {{-- <link href="{{ asset('plugins/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
        {{-- <link href="{{ asset('plugins/DataTables-1.10.20/css/dataTables.min.css') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('architect/main.css') }}" >
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('plugins/lightgallery.js-master/src/css/lightgallery.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<<<<<<< HEAD


    </head>
    <body>
=======
    </head>
    <body >
      
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
          <div class="app-header header-shadow">
              <div class="app-header__logo">
                  <div class="logo-src"></div>
                  <div class="header__pane ml-auto">
                      <div>
                          <button type="button" class="hamburger close-sidebar-btn hamburger--elastic is-active" data-class="closed-sidebar">
                              <span class="hamburger-box">
                                  <span class="hamburger-inner"></span>
                              </span>
                          </button>
                      </div>
                  </div>
              </div>
              <div class="app-header__mobile-menu">
                  <div>
                      <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                          <span class="hamburger-box">
                              <span class="hamburger-inner"></span>
                          </span>
                      </button>
                  </div>
              </div>
              <div class="app-header__menu">
                  <span>
                      <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                          <span class="btn-icon-wrapper">
                              <i class="fa fa-ellipsis-v fa-w-6"></i>
                          </span>
                      </button>
                  </span>
              </div>    
              <div class="app-header__content">
                  <div class="app-header-left">
                      <div class="search-wrapper">
                          <div class="input-holder">
                              <input type="text" class="search-input" placeholder="Type to search">
                              <button class="search-icon"><span></span></button>
                          </div>
                          <button class="close"></button>
                      </div>
                      <ul class="header-menu nav">
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" v-on:click="newModal()" {{-- data-toggle="modal" data-target=".patient_add_modal" --}} data-toggle="tooltip" data-placement="bottom" title="Ajouter un nouveau patient">
                                  <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"> </i>
                                  Patient
                              </a>
                          </li>
<<<<<<< HEAD
                          <li class="btn-group nav-item" v-show="showPrescriptions">
                              <a href="javascript:void(0);" class="nav-link" {{-- data-toggle="tooltip" data-placement="bottom" --}} title="Ajouter une nouvelle ordonnance">
                                  <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
                                  Ordonnance
                              </a>
                          </li>
                          <li class="btn-group nav-item" v-show="showRadios">
                              <a href="javascript:void(0);" class="nav-link" {{-- data-toggle="tooltip" data-placement="bottom" --}} title="Ajouter une nouvelle ordonnance">
                                  <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
                                  Radiographie
                              </a>
                          </li>
                          <li class="btn-group nav-item" v-show="showRdv">
                              <a href="javascript:void(0);" class="nav-link" {{-- data-toggle="tooltip" data-placement="bottom" --}} title="Ajouter une nouvelle ordonnance">
                                  <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
                                   Rendez-vous
                              </a>
                          </li>                                                    
                      </ul>        
                    </div>
=======
                          <li class="btn-group nav-item">
                              <a href="javascript:void(0);" class="nav-link" {{-- data-toggle="tooltip" data-placement="bottom" --}} title="Ajouter un nouveau schéma dentaire">
                                  <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
                                  Schéma dentaire
                              </a>
                          </li>
                          <li class="dropdown nav-item">
                              <a href="javascript:void(0);" class="nav-link">
                                  <i class="nav-link-icon fa fa-cog"></i>
                                  Paramètres
                              </a>
                          </li>
                      </ul>        </div>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                  <div class="app-header-right">
                      <div class="header-btn-lg pr-0">
                          <div class="widget-content p-0">
                              <div class="widget-content-wrapper">
                                  <div class="widget-content-left">
                                      <div class="btn-group">
                                          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
<<<<<<< HEAD
                                              <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}+{{ Auth::user()->prenom }}" alt="..." width="42" class="rounded-circle">
                                              <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                          </a>
                                          <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                              {{-- <button type="button" tabindex="0" class="dropdown-item">User Account</button> --}}
                                              <button type="button" tabindex="0" class="dropdown-item">Paramètres</button>
                                              <div tabindex="-1" class="dropdown-divider"></div>
                                              <button type="button" tabindex="0" class="dropdown-item">Déconnexion</button>
=======
                                              <img {{-- src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}+{{ Auth::user()->prenom }}"  --}}alt="..." width="42" class="rounded-circle">
                                              <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                          </a>
                                          
                                          <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                              <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                              <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                              <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                              <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                              <div tabindex="-1" class="dropdown-divider"></div>
                                              <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                                          </div>
                                      </div>
                                  </div>
                                  <div class="widget-content-left  ml-3 header-user-info">
                                      <div class="widget-heading">
<<<<<<< HEAD
                                          Dr. {{ strtoupper(Auth::user()->name) }} {{ strtoupper(Auth::user()->prenom)  }}

                                      </div>
                                      <div class="widget-subheading">
                                          {{ Auth::user()->profession }}
                                      </div>
                                  </div>
                                  <div class="widget-content-right header-user-info ml-3">
                                      <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                          <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>        
                    </div>
              </div>
          </div>  
          <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">APPLICATIONS</li>
                            <li>
                                <a href="{{ route('user.index') }}" {{-- class="mm-active" --}}>
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mon cabinet
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mes patients
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('act.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mes honoraires
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('act.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mon agenda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('act.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Réglages
                                </a>
                            </li>                                                                                                                        
                            <li class="app-sidebar__heading">MEDIAS</li>
                            <li>
                                <a href="{{ route('patient.create') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mes videos
                                </a>
                            </li>    
                            <li>
                                <a href="{{ route('patient.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Mes photos
                                </a>
                            </li>    
                        </ul>                                                                                                  
                    </div>
                </div>
            </div>    
            <div class="app-main__outer">
              <div class="app-main__inner">

                  {{-- <div class="app-page-title">
                      <div class="page-title-wrapper">
                          <div class="page-title-heading">
                              <div class="page-title-icon">
                                  <i class="pe-7s-folder icon-gradient bg-happy-itmeo">
                                  </i>
                              </div>
                              <div>MES PATIENTS
                                  <div class="page-title-subheading">Liste des patients et ses informations médicales
                                  </div>
                              </div>
                          </div> 
                        </div>
                  </div>   --}}          
                  <div class="row">
                      <div class="col-md-3">
                        <liste-patient-component 
                        :patients="patients"
                        v-on:patient-folder="generateSelectedPatient"
                        ></liste-patient-component>
                        <tabs-component 
                          :showradios="showRadios"
                          :showprescriptions="showPrescriptions"
                          :patient="patient">
                        </tabs-component>
                      </div>

                      <div class="col-md-9">
                        
                        {{-- <informations-component 
                         :patient="patient"
                         :showinfos="showInfos"
                         v-on:updated-patient="regeneratePatient"
                         :pathologies="{{ $pathologies->toJson() }}"
                         :antecedents="{{ $antecedents->toJson() }}"
                        ></informations-component> --}}
                        <schema-dental-component :patient="patient" :showschema="showSchema"></schema-dental-component>
                      </div>
                  </div>
=======
                                          Alina Mclourd
                                      </div>
                                      <div class="widget-subheading">
                                          VP People Manager
                                      </div>
                                  </div>
                                  <div class="widget-content-right header-user-info ml-3">
                                      <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                          <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>        
                    </div>
              </div>
          </div>  
          <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Configuration</li>
                            <li>
                                <a href="{{ route('user.index') }}" {{-- class="mm-active" --}}>
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Utilisateurs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Profils
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('acte.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Actes
                                </a>
                            </li>                                                                
                            <li class="app-sidebar__heading">Patients</li>
                            <li>
                                <a href="{{ route('patient.create') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Ajouter Patient
                                </a>
                            </li>    
                            <li>
                                <a href="{{ route('patient.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Liste des patients
                                </a>
                            </li>    
                            <li>
                                <a href="{{ route('acte.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Payements
                                </a>
                            </li>  
                            <li>
                                <a href="{{ route('appointement.index') }}" class="">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Calendrier
                                </a>
                            </li>  
                        </ul>                                                                                                  
                    </div>
                </div>
            </div>    
            <div class="app-main__outer">
              <div class="app-main__inner">
                  <div class="app-page-title">
                      <div class="page-title-wrapper">
                          <div class="page-title-heading">
                              <div class="page-title-icon">
                                  <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                                  </i>
                              </div>
                              <div>Regular Tables
                                  <div class="page-title-subheading">Tables are the backbone of almost all web applications.
                                  </div>
                              </div>
                          </div>
                          <div class="page-title-actions">
                              <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                  <i class="fa fa-star"></i>
                              </button>
                              <div class="d-inline-block dropdown">
                                  <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                      <span class="btn-icon-wrapper pr-2 opacity-7">
                                          <i class="fa fa-business-time fa-w-20"></i>
                                      </span>
                                      Buttons
                                  </button>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                      <ul class="nav flex-column">
                                          <li class="nav-item">
                                              <a href="javascript:void(0);" class="nav-link">
                                                  <i class="nav-link-icon lnr-inbox"></i>
                                                  <span>
                                                      Inbox
                                                  </span>
                                                  <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a href="javascript:void(0);" class="nav-link">
                                                  <i class="nav-link-icon lnr-book"></i>
                                                  <span>
                                                      Book
                                                  </span>
                                                  <div class="ml-auto badge badge-pill badge-danger">5</div>
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a href="javascript:void(0);" class="nav-link">
                                                  <i class="nav-link-icon lnr-picture"></i>
                                                  <span>
                                                      Picture
                                                  </span>
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a disabled href="javascript:void(0);" class="nav-link disabled">
                                                  <i class="nav-link-icon lnr-file-empty"></i>
                                                  <span>
                                                      File Disabled
                                                  </span>
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>    
                        </div>
                  </div>            
                  <div class="row">

                      <liste-patient-component 
                      :patients="patients"
                      v-on:patient-folder="generateSelectedPatient"
                      ></liste-patient-component>

                      <div class="col-md-6">
                        <informations-component 
                         :patient="patient"
                         :showinfos="showInfos"
                         v-on:updated-patient="regeneratePatient"
                         :pathologies="{{ $pathologies->toJson() }}"
                         :antecedents="{{ $antecedents->toJson() }}"
                        ></informations-component>

                        <div class="main-card mb-3 card">
                              <div class="card-body"><h5 class="card-title">Traitement en cours</h5>
                                  <div class="table-responsive">
                                      <table class="mb-0 table">
                                          <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Table heading</th>
                                              <th>Table heading</th>
                                              <th>Table heading</th>
                                              <th>Table heading</th>
                                              <th>Table heading</th>
                                              <th>Table heading</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr>
                                              <th scope="row">1</th>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                          </tr>
                                          <tr>
                                              <th scope="row">2</th>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                          </tr>
                                          <tr>
                                              <th scope="row">3</th>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                              <td>Table cell</td>
                                          </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <radiographies-component
                          :showradios="showRadios"
                          :patient="patient">
                        </radiographies-component>

                        <prescriptions-component
                          :showprescriptions="showPrescriptions">
                            
                        </prescriptions-component>
                      </div>
                  </div>
              </div>
              <div class="app-wrapper-footer">
                  <div class="app-footer">
                      <div class="app-footer__inner">
                          <div class="app-footer-left">
                              <ul class="nav">
                                  <li class="nav-item">
                          Dental Office Management - developed by <a href="https://www.hic-sante.com">HIC Santé</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div> 
            </div>                 
          </div>
          <!-- --------------------------MODALS-------------------------- -->
          <div class="modal fade patient_add_modal"  tabindex="-1" id="patient_add_modal"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Nouveau Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  {{-- <div> --}}
                    {{-- <form-wizard >
                        <tab-content title="Informations Patient" icon="ti-user"> --}}
                          <patient-component 
                          v-bind:pathologies="{{ $pathologies->toJson() }}"
                          v-bind:antecedents="{{ $antecedents->toJson() }}"
                          v-on:generated-patient="generatePatient"  
                          >
                          </patient-component>

                        {{-- </tab-content>
                        <tab-content title="Schéma Dentaire" icon="ti-settings">
                          My second tab content
                        </tab-content>
                        <tab-content title="Last step" icon="ti-check">
                          Yuhuuu! This seems pretty damn simple
                        </tab-content>
                    </form-wizard> --}}
                   {{-- </div> --}}
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
                    <button type="button" class="btn btn-primary">SUIVANT</button>
                  </div> -->
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
              </div>
              <div class="app-wrapper-footer">
                  <div class="app-footer">
                      <div class="app-footer__inner">
                          <div class="app-footer-left">
                              <ul class="nav">
                                  <li class="nav-item">
                          dCare & Health - developed by <a href="https://www.hic-sante.com">HIC Santé</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div> 
            </div>                 
          </div>
<<<<<<< HEAD
          <!-- --------------------------MODALS-------------------------- -->
          <div class="modal fade patient_add_modal"  tabindex="-1" id="patient_add_modal"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Nouveau Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <patient-component 
                    v-bind:pathologies="{{ $pathologies->toJson() }}"
                    v-bind:antecedents="{{ $antecedents->toJson() }}"
                    v-on:generated-patient="generatePatient"  
                    >
                    </patient-component>

              </div>
            </div>
          </div>

        </div>



        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('architect/assets/scripts/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        {{-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.20/js/jquery.datatables.min.js') }}"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.20/js/datatables.bootstrap4.min.js') }}"></script> --}}
        <!-- lightgallery plugins -->
        <script src="{{ asset('plugins/lightgallery.js-master/dist/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('plugins/lightgallery.js-master/demo/js/lg-fullscreen.min.js') }}"></script>
        <script src="{{ asset('plugins/lightgallery.js-master/demo/js/lg-thumbnail.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
=======
        </div>



        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('architect/assets/scripts/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
        {{-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script> --}}
        <script type="text/javascript" src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.20/js/jquery.datatables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.20/js/datatables.bootstrap4.min.js') }}"></script>
        <!-- lightgallery plugins -->
        <script src="{{ asset('plugins/lightgallery.js-master/dist/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('plugins/lightgallery.js-master/demo/js/lg-fullscreen.min.js') }}"></script>
        <script src="{{ asset('plugins/lightgallery.js-master/demo/js/lg-thumbnail.min.js') }}"></script>
        <script>
          $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            // $('.patients_table').DataTable({
            //   // paging: false,
            //   searching: false,
            //   "language" : {
            //       "decimal":        "",
            //       // "emptyTable":     "Aucune données est disponnible",
            //       "info":           "",
            //       "infoEmpty":      "de 0 a 0 des 0 lignes",
            //       "infoFiltered":   "(filtered from _MAX_ total lignes)",
            //       "infoPostFix":    "",
            //       "thousands":      ",",
            //       "lengthMenu":     "_MENU_",
            //       "loadingRecords": "Chargement...",
            //       "processing":     "Processing...",
            //       "search":         "Rechercher:",
            //       // "zeroRecords":    "Aucun Patient trouvé ",
            //       "paginate": {
            //           "first":      "Début",
            //           "last":       "Dernier",
            //           "next":       "=>",
            //           "previous":   "<="
            //       },
            //       "aria": {
            //           "sortAscending":  ": activate to sort column ascending",
            //           "sortDescending": ": activate to sort column descending"
            //       }
            //   },
            // });

            // $('.patients_table_details').DataTable({
            //   "language" : {
            //       "decimal":        "",
            //       "emptyTable":     "Aucune données est disponnible",
            //       "info":           "",
            //       "infoEmpty":      "de 0 a 0 des 0 lignes",
            //       "infoFiltered":   "(filtered from _MAX_ total lignes)",
            //       "infoPostFix":    "",
            //       "thousands":      ",",
            //       "lengthMenu":     "Afficher _MENU_ Patient",
            //       "loadingRecords": "Chargement...",
            //       "processing":     "Processing...",
            //       "search":         "Rechercher:",
            //       "zeroRecords":    "Aucun Patient trouvé ",
            //       "paginate": {
            //           "first":      "Début",
            //           "last":       "Dernier",
            //           "next":       "Suivant",
            //           "previous":   "Précédent"
            //       },
            //       "aria": {
            //           "sortAscending":  ": activate to sort column ascending",
            //           "sortDescending": ": activate to sort column descending"
            //       }
            //   },
            // });              
          })
        </script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3

    </body>
</html>
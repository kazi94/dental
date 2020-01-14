@extends('layouts.app')

@section('content')
    <!-- page content -->
    <h1>{{ __('Tableau de Bord') }}</h1>
    <div class="clearfix"></div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
                <div class="col-lg-12">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-primary">
                        <i class="fa fa-user fa-5x"></i><br/>
                        MON CABINET <br>
                    </a>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-success">
                        <i class="fa fa-user fa-5x"></i><br/>
                        MES PATIENTS <br>
                    </a>
                  </div>                  
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-info">
                        <i class="fa fa-user fa-5x"></i><br/>
                        HONORAIRES <br>
                    </a>
                  </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-warning">
                        <i class="fa fa-user-md fa-5x"></i><br/>
                        ORDONNANCES <br>
                    </a>
                  </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-danger">
                        <i class="fa fa-calendar fa-5x"></i><br/>
                        AGENDA <br>
                    </a>
                  </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-primary">
                        <i class="fa fa-video-camera fa-5x"></i><br/>
                        VIDEO <br>DEMO
                    </a>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-warning">
                        <i class="fa fa-cog fa-5x"></i><br/>
                        REGLAGES <br>
                    </a>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="#" class="btn btn-sq-lg btn-info">
                        <i class="fa fa-user fa-5x"></i><br/>
                        SORTIE <br>
                    </a>
                  </div>                                    

                </div>
        </div>                                 

      {{-- <div class="row">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-user"></i>
            </div>
            <div class="count">179</div>

            <h3>Total Patients</h3>
            <p><span class="count_bottom"><i class="red">-4% </i> par rapport à la semaine précédente</span></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i>
            </div>
            <div class="count">5</div>

            <h3>Rendez-vous Aujourdhui</h3>
            <p><span class="count_bottom"><i class="green">+4% </i> par rapport à la semaine précédente</span></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-sort-amount-asc"></i>
            </div>
            <div class="count">179</div>

            <h3>Total Prescriptions</h3>
            <p><span class="count_bottom"><i class="green">+4% </i> par rapport à la semaine précédente</span></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-dollar"></i>
            </div>
            <div class="count"> 20 500.00 DA</div>

            <h3>Gain Total du cabinet</h3>
            <p><span class="count_bottom"><i class="red">-4% </i> par rapport à la semaine précédente</span></p>
          </div>
        </div>
      </div> --}}                   
      <!-- top tiles -->
      {{-- <div class="row tile_count">
        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user fa-2x"></i> Total Patients</span>
          <div class="count">150</div>
          <span class="count_bottom"><i class="green">4% </i> par rapport à la semaine précédente</span>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-clock-o fa-2x"></i> Rendez-vous d'aujourdhui</span>
          <div class="count">5 </div><span>Rendez-vous</span>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user fa-2x"></i> Total Prescriptions</span>
          <div class="count">10</div>
          <span class="count_bottom"><i class="red">-4% </i> par rapport à la semaine précédente</span>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-dollar fa-2x"></i> Gain Total du cabinet</span>
          <div class="count">20500.00 DA</div>
          <span class="count_bottom"><i class="red">-4% </i> par rapport à la semaine précédente</span>
        </div>        
      </div> --}}
      <!-- /top tiles -->

      {{-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Derniers Patients</h3>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                  </ul>
                </div>
              </div>          
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Rendez-vous d'aujourdhui</h3>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                  </ul>
                </div>
              </div>          
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Dernières Prescriptions</h3>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                  </ul>
                </div>
              </div>          
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="x_panel">
                <div class="x_title">
                  <h3>Versements</h3>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ asset('img/user.png') }}" alt="img">
                        </span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">8:30</span>
                        </span>
                        <span class="message">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </span>
                      </a>
                    </li>                    
                  </ul>
                </div>
              </div>          
        </div>                  
      </div> --}}

@endsection

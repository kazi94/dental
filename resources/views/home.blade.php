@extends('layouts.app')

@section('content')
  <div class="app-main__inner">        
      <div class="row justify-content-center">
        <a href="{{ route('name') }}">
            <div class="col-md-2 col-xl-2" style="cursor: pointer">
                <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                      <i class="metismenu-icon pe-7s-graph icon-gradient bg-mean-fruit fa-3x"> </i>
                      <strong>MON CABINET</strong>
                </div>
            </div>
        </a>
        <a href="{{ route('patient.index') }}">
            <div class="col-md-2 col-xl-2" style="cursor: pointer">
                <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                      <i class="metismenu-icon pe-7s-folder icon-gradient bg-mean-fruit fa-3x"> </i>
                      <strong>MES PATIENTS </strong>
                </div>
            </div>
        </a> 
        <a href="{{ route('name') }}">
            <div class="col-md-2 col-xl-2" style="cursor: pointer">
                <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                      <i class="metismenu-icon pe-7s-car icon-gradient bg-mean-fruit fa-3x"> </i>
                      <strong>HONORAIRES</strong>
                </div>
            </div>
        </a>
      </div>
      <div class="row justify-content-center">
          <a href="{{ route('name') }}">
              <div class="col-md-2 col-xl-2" style="cursor: pointer">
                  <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                        <i class="metismenu-icon pe-7s-car icon-gradient bg-mean-fruit fa-3x"> </i>
                        <strong>ORDONNANCES</strong>
                  </div>
              </div>
          </a> 
          <a href="{{ route('name') }}">
              <div class="col-md-2 col-xl-2" style="cursor: pointer">
                  <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                        <i class="metismenu-icon pe-7s-agenda icon-gradient bg-mean-fruit fa-3x"> </i>
                       <strong> AGENDA</strong>
                  </div>
              </div>
          </a>  
          <a href="{{ route('name') }}">
              <div class="col-md-2 col-xl-2" style="cursor: pointer">
                  <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                        <i class="metismenu-icon pe-7s-film icon-gradient bg-mean-fruit fa-3x"> </i>
                        <strong>VIDEO DEMO</strong>
                  </div>
              </div>
          </a>  
          <a href="{{ route('name') }}">
              <div class="col-md-2 col-xl-2" style="cursor: pointer">
                  <div class="bg-midnight-bloom card d-inline-flex d-sm-inline-block mb-3 text-lg-center widget-content" style="color: white; ">
                        <i class="metismenu-icon pe-7s-config icon-gradient bg-mean-fruit fa-3x"> </i>
                        <strong>REGLAGES</strong>
                  </div>
              </div>
          </a>                                                                  
      </div>
  </div>
@endsection

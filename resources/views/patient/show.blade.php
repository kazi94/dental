@extends('layouts.app')
@section('content')
<div class="app-main__inner" id="patients">
  <div class="row">
    <div class="col-sm-11 col-md-10">
       <h3>MES PATIENTS
  </h3> 
    </div>

    <div class="col-sm-2 pl-md-5">
      <button class="btn btn-primary rounded-0">Ajouter</button>
    </div>
  </div>
  
  
  <div class="row">
    
    <div class="col-sm-12">
      <div class="card card-body">
        <patients></patients>

      </div>
    </div>
    
  </div>
</div>
@endsection

@section('js_scripts')
    <script src="/js/liste-patients.js"></script>
@endsection

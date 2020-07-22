@extends('layouts.app')
@section('content')
<div class="app-main__inner" id="patients">
  
  <h3>APPLICATIONS
  </h3>
  
  <div class="row">
    
    <div class="col-sm-12">
      <b-table striped hover :items="patients" :fields="fields"></b-table>
    </div>
    
  </div>
</div>
@endsection

@section('js_scripts')
    <script src="/js/liste-patients.js"></script>
@endsection

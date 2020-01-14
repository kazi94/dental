@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('/scheduler/codebase/dhtmlxscheduler_material.css?v=5.2.1" type="text/css" charset="utf-8') }}">

<style>
    html, body{
    margin:0px;
    padding:0px;
    height:100%;
    overflow:hidden;
  }
  .add_button_set{
    background-color:#ffffff;
}
.dhx_menu_icon.icon_validate{
  background-image: url('location_icon.png');  
}
.dhx_menu_icon.icon_invalidate{
  background-image: url('location_icon.png');  
}
.dhx_qi_big_icon.icon_invalidate {
    color: #ff584c;
}

</style>  

  
@section('content')
  <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
    <div class="dhx_cal_navline">
      <div class="dhx_cal_prev_button">&nbsp;</div>
      <div class="dhx_cal_next_button">&nbsp;</div>
      <div class="dhx_cal_today_button"></div>
      <div class="dhx_cal_date"></div>
      <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
      <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
      <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
    </div>
    <div class="dhx_cal_header">
    </div>
    <div class="dhx_cal_data">
    </div>
  </div>


@endsection
@section('js_scripts')
<script src="{{ asset ('scheduler/codebase/dhtmlxscheduler.js?') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset ('scheduler/codebase/ext/dhtmlxscheduler_agenda_view.js?') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset ('scheduler/codebase/ext/dhtmlxscheduler_quick_info.js?') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset ('scheduler/codebase/ext/dhtmlxscheduler_readonly.js?') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset ('scheduler/codebase/sources/locale/locale_fr.js') }}" charset="utf-8"></script>
<script type="text/javascript" charset="uft-8">
  function init() {
    scheduler.config.touch = "force";
    scheduler.config.multi_day = true;
    
    scheduler.init('scheduler_here',new Date(2018,0,1),"week");
    scheduler.load("/json/scheduler/events.json");
    
  }
</script>
@endsection

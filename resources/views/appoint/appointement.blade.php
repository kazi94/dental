@extends('layouts.app')

@section('styles')
<script src="/plugins/scheduler/codebase/dhtmlxscheduler.js?v=5.2.1" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="{{ asset('/plugins/scheduler/codebase/dhtmlxscheduler_material.css?v=5.2.1') }}">
<link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
<style>
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
.bg_event {
  background-color : #ff584c !important;
}
    /*event in day or week view*/
	.dhx_cal_event.past_event div{
		background-color:purple !important; 
		color:white !important;
	}
    /*multi-day event in month view*/
	.dhx_cal_event_line.past_event{
		background-color:purple !important; 
		color:white !important;
	}
    /*event with fixed time, in month view*/
	.dhx_cal_event_clear.past_event{
		color:purple !important;
	}	
.sch-d-head {
	position: Relative;
	left: 0;
	top: 0;
	height: 30px;
	width: 100%;
	font-size: 0;
	text-align: center;
}
.sch-d-head-inside {
	font-size: 16px;
	line-height: 0;
	display: inline-block;
	vertical-align: middle;
}
.container-center:before, .elem-center, .icon-text__icon:before {
	display: inline-block;
	vertical-align: middle;
}

.filters_wrapper {
  font: 500 14px Roboto;
}
.filters_wrapper span {
  font-weight: bold;
  padding-right: 5px;
  color: rgba(0,0,0,0.7);
}
.filters_wrapper label {
  padding-right: 3px;
}
</style>  
@endsection

@section('content')
  <!-- CONTENT -->
  <div class="app-main__outer" >
    <div class="app-main__inner">
      @if (session()->has('message'))
          <p class="alert alert-success" id="message" style="display: none;">{{ session('message') }}</p>
      @endif

    <!-- <div class="sch-d-head">
        <div class="sch-d-head-inside">
          <div class="elem-center" style="height: 19px">
            <select name="user" id="user">
                <option option value="none" > Selectionner un chirurgien dentiste</option>-->
                <!-- @foreach( $users as $user) -->
                  <!-- <option value="{{ $user->id }}" > {{ $user->name }} {{ $user->prenom }} </option> -->
                <!-- @endforeach -->
            <!-- </select>
          </div>
        </div>
      </div>  --> 
<!-- <div class="sch_control">
	<div class="filters_wrapper" id="filters_wrapper">
		<span>Display:</span>

		<label class="checked_label" id="scale1">
			<input type="checkbox" class="sch_radio" name="appointment" value="1" checked/>
			<i class="material-icons icon_color"></i>Appointments
		</label>

		<label class="checked_label" id="scale1">
			<input type="checkbox" class="sch_radio" name="task" value="1" checked/>
			<i class="material-icons icon_color"></i>Tasks
		</label>

		<label class="checked_label" id="scale1">
			<input type="checkbox" class="sch_radio" name="training" value="1" checked/>
			<i class="material-icons icon_color"></i>Trainings
		</label>
	</div>
</div>             -->
      <div id="scheduler_here" class="dhx_cal_container table-responsive" style='width:100%; height:100%;'>
        <div class="dhx_cal_navline">
          <div class="dhx_cal_prev_button">&nbsp;</div>
          <div class="dhx_cal_next_button">&nbsp;</div>
          <div class="dhx_cal_today_button"></div>
          <div class="dhx_cal_date"></div>
		      <div class="dhx_cal_tab" name="unit_tab" style="right:360px;"></div>
		      <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>          
          <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
          <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
          <div class="dhx_cal_tab" name="agenda_tab" style="right:280px;"></div>
          <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
        </div>
        <div class="dhx_cal_header">
        </div>
        <div class="dhx_cal_data">
        </div>
      </div>

    </div>
  </div>

  <!-- <div class="modal fade in" id="modal_patient">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title" >Nouveau Patient</h4>
        </div>
        <form class="form-group">
          <div class="modal-body table-responsive" style="display: block;">

              {{  csrf_field() }}
              <div class="col-sm-12">
                <div class="form-group">

                  <label for="matricule" class="label-control"> Nom* 

                    <input type="text"  class="form-control" name="nom"   placeholder="Nom" required>

                  </label>

                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  
                  <label for="nom" class="label-control"> Prénom* 

                    <input type="text"  class="form-control" name="prenom"   placeholder="Prénom"  />

                  </label>

                </div>          
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                
                  <label for="prénom" class="label-control"> Date de Naissance 

                    <input type="date"  class="form-control" name="date_naissance"  />

                  </label>

                </div>
              </div>
          </div>

          <div class="modal-footer">
              <input type="reset" class="btn btn-default pull-left" data-dismiss="modal" value="Fermer">
              <input type="button" class="btn btn-primary pull-right" onClick="addPatient(event)" value="Confirmer">
          </div>
        </form>
      </div>
    </div>
  </div> -->

@endsection
@section('js_scripts')
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_agenda_view.js?v=5.2.1" type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_quick_info.js?v=5.2.1" type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_readonly.js?v=5.2.1" type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/sources/locale/locale_fr.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('/plugins/select2/dist/js/select2.min.js') }}"type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_limit.js" type="text/javascript" charset="utf-8"></script>
<script src='/plugins/scheduler/codebase/ext/dhtmlxscheduler_timeline.js' type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_units.js" type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_multiselect.js" type="text/javascript" charset="utf-8"></script>
<script src="/plugins/scheduler/codebase/ext/dhtmlxscheduler_tooltip.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
  //
    // function addPatient(event){
    //   event.preventDefault();
    //   let myModal = $('#modal_patient');
    //   $.ajax({
    //     url: '/appointement/storePatient',
    //     type: 'POST',
    //     data: $('form').serialize(),
    //   })
    //   .done(function(data , status , code) {
    //     let nom = $('form').find("input[name='nom']").val();
    //     let prenom = $('form').find("input[name='prenom']").val();
    //     $('#patients').append("<option value="+data.p_id+">"+nom+" "+prenom+"</option>");
    //     myModal.modal({ hide: true });
    //   })
    //   .fail(function(error , status , message ) {
    //     console.log(error);

    //   })
    //   .always(function() {
    //     console.log("complete");
    //   });
    // }
  //

	function init($user_id = null) {

    // ************************Config Scheduler******************************** //
      scheduler.config.touch             = "force"; //when touch to the cas , modals appear
      scheduler.config.multi_day         = true;
      scheduler.config.prevent_cache     = true;
      scheduler.config.first_hour        = 8; //first hour display in calendar
      scheduler.config.start_on_monday   = false; //Set First day to Sunday (Dimanche)
      scheduler.config.limit_time_select = true;
      scheduler.config.date_format       = "%Y-%m-%d %H:%i:%s"; //parse returned date to spesefic format 
      scheduler.locale.labels.agenda_tab = "Agenda";//Nom tab Agenda
      scheduler.config.event_duration    = 15; //specify the event duration in minutes for the auto_end_time parameter
      scheduler.config.auto_end_date     = true;
      scheduler.config.details_on_dblclick = true;
      scheduler.config.dblclick_create = true;
      scheduler.locale.labels.section_type = "Type";
      scheduler.xy.margin_top = 30;    
			scheduler.config.multisection = true;
			scheduler.locale.labels.timeline_tab = "Cabinet";
			scheduler.locale.labels.unit_tab = "Unit";
			scheduler.locale.labels.section_custom = "Assigner à ";      
    // ************************! End Config Scheduler************************** //

    // ************************Config users view******************************** //

      var users = scheduler.serverList("users");


			scheduler.createTimelineView({
				name: "timeline",
				x_unit: "hour",
				x_date: "%H:%i",
				x_step: 8,
				x_size: 24,
				y_unit: users,
				y_property: "assign_to",
				render: "bar",
				second_scale:{
					x_unit: "day", // unit which should be used for second scale
					x_date: "%F %d" // date format which should be used for second scale, "July 01"
				}
			});

			scheduler.createUnitsView({
				name: "unit",
				property: "assign_to",
				list: users
			});


			scheduler.addMarkedTimespan({
				start_date: new Date(2017, 6, 6, 10),
				end_date: new Date(2017, 6, 7, 12),
				type:"dhx_time_block",
				sections: {
					timeline: [1, 3], // list of sections
					unit: [1, 3]
				}
			});
			scheduler.addMarkedTimespan({
				start_date: new Date(2017, 6, 3, 13),
				end_date: new Date(2017, 6, 4, 13),
				type:"dhx_time_block",
				sections: {
					timeline: 2, // only 1 section
					unit: 2
				}
      });
    // ************************! End Config users view************************** //

    // ************************Filter events by Famille******************************** //
			// // default values for filters
			// var filters = {
			// 	appointment: true,
			// 	task: true,
			// 	training: true
			// };

			// var filter_inputs = document.getElementById("filters_wrapper").getElementsByTagName("input");
			// for (var i=0; i<filter_inputs.length; i++) {
			// 	var filter_input = filter_inputs[i];

			// 	// set initial input value based on filters settings
			// 	filter_input.checked = filters[filter_input.name];

			// 	// attach event handler to update filters object and refresh view (so filters will be applied)
			// 	filter_input.onchange = function() {
			// 		filters[this.name] = !!this.checked;
			// 		scheduler.updateView();
			// 		updIcon(this);
			// 	}
			// }

			// // here we are using single function for all filters but we can have different logic for each view
			// scheduler.filter_month = scheduler.filter_day = scheduler.filter_week = function(id, event) {
			// 	// display event only if its type is set to true in filters obj
			// 	// or it was not defined yet - for newly created event
			// 	if (filters[event.type] || event.type==scheduler.undefined) {
			// 		return true;
			// 	}

			// 	// default, do not display event
			// 	return false;
			// };

			// var types = [
			// 	{ key: "appointment", label: "Appointment" },
			// 	{ key: "task", label: "Task" },
			// 	{ key: "training", label: "Training" }
			// ];
      // function updIcon(el){
      //   el.parentElement.classList.toggle("checked_label");

      //   var iconEl = el.parentElement.querySelector("i"),
      //     checked = "check_box",
      //     unchecked = "check_box_outline_blank",
      //     className = "icon_color";

      //   iconEl.textContent = iconEl.textContent==checked?unchecked:checked;
      //   iconEl.classList.toggle(className);
      // }            
    // ************************! End Filter events by Famille************************** //

    // ************************ Handle with Json Data********************************* //
      // load the current user appointements from db
      scheduler.load("/patient/rendez-vous/"+$user_id, "json");    
    
      var dp = new dataProcessor("/patient/rendez-vous"); //Rest Mode : PUT,POST,DELETE
      dp.init(scheduler);
      dp.setTransactionMode({
        mode:"REST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // specify Toekn to avoid 419 error
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' // to send Form Data instead of head request
        }
      });    
    // ************************! End Handle with Json Data**************************** //

    // ************************ Config Light Box********************************* //
      scheduler.form_blocks["my_editor1"]={
          render:function(sns){
            let options = "";
            let patients =scheduler.serverList("type");
              $.each(patients,function(index , val){
                options+="<option value="+val.key+">"+val.label+"</option>";
              });
              // let html = "<div class='dhx_cal_ltext' style='height:60px;'>" +
              //     "<select class='select2' name='patient_id' id='patients' style='width:277px; margin :5px;'>"+options+"</select>" +
              //     "<button class='btn btn-dropbox' id='addPatient' style='margin-left:5px;' data-toggle='modal' data-target='#modal_patient' >+</button>" +
              //     "</div>";
              let html = "<div class='dhx_cal_ltext' style='height:60px;'>" +
                  "<select class='select2' name='patient_id' id='patients' style='width:277px; margin :5px;'>"+options+"</select>" +
                  "</div>";                
              return html   ; 
          },
          set_value:function(node,value,ev){
              node.querySelector("[name='patient_id']").value = value||"";
          },
          get_value:function(node,ev){
              return node.querySelector("[name='patient_id']").value;
          }
      }; 
      scheduler.form_blocks["my_editor2"]={
          render:function(sns){
            let options = "";
            let categories =scheduler.serverList("categories");
              $.each(categories,function(index , val){
                options+="<option value='" +JSON.stringify(val) +"'>"+val.label+"</option>";
              });
              let html = "<div class='dhx_cal_ltext' style='height:60px;'>" +
                  "<select name='category' id='categories' style='width:277px; margin :5px;'>"+options+"</select>" +
                  "</div>";
              return html   ; 
          },
          set_value:function(node,value,ev){
              node.querySelector("[name='category']").value = value ||"";
          },
          get_value:function(node,ev){
              return node.querySelector("[name='category']").value;
          }
      };
      scheduler.form_blocks["my_editor3"]={
          render:function(sns){
              let html = "<div class='dhx_cal_ltext' style='height:60px;'>" +
                  "<select name='fauteuil'  style='width:277px; margin :5px;'>"+
                  "<option value='1'> Fauteuil 1</option>" +
                  "<option value='2'> Fauteuil 2</option>" +
                  "</select>" +
                  "</div>";
              return html   ; 
          },
          set_value:function(node,value,ev){
              node.querySelector("[name='fauteuil']").value = value||"";
          },
          get_value:function(node,ev){
              return node.querySelector("[name='fauteuil']").value;
          }
      };

      scheduler.attachEvent("onLightBox" ,function(){
        $('.select2').select2(); // pour afficher select2
      });    
                    
      // specify The content Of Event Modal
      scheduler.config.lightbox.sections=[  
        {name:"Patient",     height:23,  type:"my_editor1",   map_to:"patient_id",options:scheduler.serverList("type")},
        {name:"Famille",     height:23,  type:"my_editor2",   map_to:"category",options:scheduler.serverList("type")},
        {name:"Fauteuil",     height:23,  type:"my_editor3",   map_to:"fauteuil"},
        { name:"custom", height:22, map_to:"assign_to", type:"multiselect", options: users, vertical:"false" },
        {name:"Description", height:100, type:"textarea",     map_to:"text"},
        {name:"Periode",     height:72,  type:"time",         map_to:"auto"}
      ]; 
    // ************************! End Config Light Box**************************** //

    // ************************ Config && Style Events Box********************************* //
      // Config Event box content
      // scheduler.templates.event_text=function(start,end,event){
      //   return "Patient:<b> </b><br>"+"Famille:"+event.category.name+"<br>Fauteuil N°:"+event.fauteuil;
      // };

      //*----------------------------------------
      //* Tooltips
      //*----------------------------------------  
      //default definition
      scheduler.templates.event_header = function(start,end,ev){
          return scheduler.templates.event_date(start)+" - "+
          scheduler.templates.event_date(end) ;
      };  
      
      var format = scheduler.date.date_to_str("%Y-%m-%d %H:%i"); 
        scheduler.templates.tooltip_text = function(start,end,event) {
            if (event.created_by.name)
              return "<b>Créer par :</b> "+event.created_by.name+" "+event.created_by.prenom+"</b><br/><b>Assigner à :</b> "+ event.assign_to.name+" "+event.assign_to.prenom;
      };

      //*----------------------------------------
      //* Touch Support (Popup on click on event)
      //*----------------------------------------  
      // the content of the pop-up edit form
      scheduler.templates.quick_info_content = function(start, end, ev){ 
          return ev.text ;
      };
      // the date of the pop-up edit form
      scheduler.templates.quick_info_date = function(start, end, ev){
          if (scheduler.isOneDayEvent(ev)){
              return scheduler.templates.day_date(start, end, ev) + " " +
                  scheduler.templates.event_header(start, end, ev);
          }else{
              return scheduler.templates.week_date(start, end, ev);
          }
      }; 
      // the title of the pop-up edit form 
      // scheduler.templates.quick_info_title = function(start, end, ev){ 
      //     return ev.category.name; 
      // };      

    // ************************! End Config && Style Events Box**************************** //
    
    scheduler.init('scheduler_here',new Date(),"week");
		
	}
</script>

<!-- <script type="text/javascript" charset="utf-8">
  {{-- Store patient to DB --}}
  function addPatient(event){
    event.preventDefault();
    let myModal = $('#modal_patient');
    $.ajax({
      url: '/appointement/storePatient',
      type: 'POST',
      data: $('form').serialize(),
    })
    .done(function(data , status , code) {
      let nom = $('form').find("input[name='nom']").val();
      let prenom = $('form').find("input[name='prenom']").val();
      $('#patients').append("<option value="+data.p_id+">"+nom+" "+prenom+"</option>");
      toastr.success("Patient ajouté avec succés");
      myModal.modal({ hide: true });
    })
    .fail(function(error , status , message ) {
      toastr.warning("Code d'erreur :"+error.status+" , "+error.responseJSON.message);
    })
    .always(function() {
      console.log("complete");
    });
  }

  // {{-- Return tout les type de rendez-vous --}}
  function getTypeRdv(){
    let types = [];
     //get json records from general.json and display bilan and unités in there respective select for admin
    $.getJSON("/js/json/general.json",function(obj){

      $.each(obj,function(key,value){
        // console.log(value.unite.length)
        if (value.type_rdv!= "" ) 
          types.push({
            "label" : value.type_rdv,
            "key"   : value.type_rdv
          }); 
      });
    });
    return types;
  }

  function init() {

    // scheduler.config.readonly_form = true; // readonly just lightbox
    // scheduler.config.readonly= true; //readonly all calendar



    //Définir le text dans le corps du popup(quand on clique une fois sur l'event)
    scheduler.templates.quick_info_content = function(start, end, ev){ 
        return "Patient : "+scheduler.getLabel("patient_id" , ev.patient_id);
    };
    // ****************************
    //Config Edit Bars 
    //*****************************
    // Redefine icons_select as in:
    // scheduler.config.icons_select = [
    //    "icon_validate",
    //    "icon_cancel",
    //    "icon_details",
    //     "icon_delete"
    // ];
    // // Set the label for the new button:
    // scheduler.locale.labels.icon_validate = "Valider";
    // scheduler.locale.labels.icon_invalidate = "Non honoré";
    // //Specify the handler for processing clicks on the button:
    // scheduler._click.buttons.validate = function(id){
    //    alert('coucou');
    // };
    // scheduler._click.buttons.invalidate = function(id){
    //    alert('coucou');
    // };    


    // Handle View Permission
    //scheduler.attachEvent("onBeforeDrag",block_readonly); // block drag event
    //scheduler.attachEvent("onClick",block_readonly); //block edit event
    // function block_readonly(id){ // block edit  event external users
    //   if(id != undefined) {
    //       var event = scheduler.getEvent(id); // can't edit détails
    //       return !event.readonly; 
    //   }
    // }
    scheduler.attachEvent("onLightBox" ,function(){
      $('.select2').select2(); // pour afficher select2

    });
   

  }
</script> -->
@endsection
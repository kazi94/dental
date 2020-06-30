<template>  
  <div>
    <div class="mb-3 card">
      <div class="card-header">
          <ul class="nav nav-justified">
              <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-0" class="active nav-link">Radiographies</a></li>
              <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-1" class="nav-link">Ordonnances</a></li>
              
          </ul>
      </div>
      <div class="card-body">
          <div class="tab-content">
              <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                <radiographies-component 
                  :showradios="showradios"
                  :patient="patient"> 
                </radiographies-component>
              </div>
              <div class="tab-pane" id="tab-eg7-1" role="tabpanel">
                <prescriptions-component
                  :showprescriptions="showprescriptions"
                  :patient="patient">
                </prescriptions-component>
              </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import PrescriptionsComponent from './PrescriptionsComponent'
import RadiographiesComponent from './RadiographiesComponent'
  export default {
    components : {
      RadiographiesComponent,
      PrescriptionsComponent,
    },
    props : [
      'patient',
      'showradios',
      'showprescriptions',
    ],
    data () {
      return {
      }
    },
    methods : {

    },
    mounted(){

    }
  }
</script>
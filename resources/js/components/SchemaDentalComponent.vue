<template>  
  <div>
    <div class="main-card mb-3 card">
      <div class="card-header">
        <ul class="nav">
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-0" class="active nav-link">Plan</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-1" class="nav-link">Initiale</a></li>
        </ul>
          <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Schéma Dentaire
      </div>      
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane show" id="tab-eg1-1" role="tabpanel">
              <initial-schema-component :patient="patient" v-show="showschema"></initial-schema-component>
            </div>
            <div class="tab-pane active show" id="tab-eg1-0" role="tabpanel">
              <plan-schema-component :patient="patient" v-show="showschema"></plan-schema-component>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>



<script>
import InitialSchemaComponent from './InitialSchemaComponent'
import PlanSchemaComponent from './PlanSchemaComponent'
  export default {
    components : {
      InitialSchemaComponent,
      PlanSchemaComponent,
    },
    props : [
      'patient',
      'showschema',

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

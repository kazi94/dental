<template>  
  <div>
    <div class="main-card mb-3 card">
      <div class="card-header">
        <ul class="nav">
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-0" class="active nav-link">Plan</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-1" class="nav-link">Initiale</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-2" class="nav-link">Devis</a></li>
            <li class="nav-item"><a data-toggle="tab" href="#tab-eg1-3" class="nav-link">Règlements</a></li>
        </ul>
          <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Schéma Dentaire
      </div>      
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane show" id="tab-eg1-1" role="tabpanel">
              <initial-schema-component :patient="patient" v-if="showschema"></initial-schema-component>
            </div>
            <div class="tab-pane active show" id="tab-eg1-0" role="tabpanel">
              <plan-schema-component :patient="patient" v-if="showschema"></plan-schema-component>
            </div>
            <div class="tab-pane active show" id="tab-eg1-2" role="tabpanel">
              <!-- <quotation :patient="patient" v-if="patient.schemas.quotations"></quotation> -->
            </div>
            <div class="tab-pane active show" id="tab-eg1-3" role="tabpanel">
              <!-- <payment :patient="patient" v-if="showschema"></payment> -->
            </div>                        
          </div>
      </div>
    </div>
  </div>
</template>



<script>
import InitialSchemaComponent from './InitialSchemaComponent'
import PlanSchemaComponent from './PlanSchemaComponent'
import Quotation from './Quotation'
import Payment from './Payment'
  export default {
    components : {
      InitialSchemaComponent,
      PlanSchemaComponent,
      Quotation,
      Payment,
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

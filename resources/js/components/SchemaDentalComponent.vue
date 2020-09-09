<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-header">
                <ul class="nav col-sm-10">
                    <li class="nav-item">
                        <a
                            data-toggle="tab"
                            href="#tab-eg1-1"
                            class="active nav-link"
                            >Initiale</a
                        >
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-eg1-0" class="nav-link"
                            >Plan</a
                        >
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-eg1-2" class="nav-link"
                            >Devis</a
                        >
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-eg1-3" class="nav-link"
                            >Règlements</a
                        >
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab-eg1-4" class="nav-link"
                            >Ordonnances</a
                        >
                    </li>
                </ul>
                <div class="d-none d-sm-block">Schéma Dentaire</div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div
                        class="tab-pane active show"
                        id="tab-eg1-1"
                        role="tabpanel"
                    >
                        <initial-schema-component
                            :patient="patient"
                            v-if="showschema"
                        ></initial-schema-component>
                    </div>
                    <div class="tab-pane show" id="tab-eg1-0" role="tabpanel">
                        <plan-schema-component
                            :patient="patient"
                            v-if="showschema"
                        ></plan-schema-component>
                    </div>
                    <div class="tab-pane show" id="tab-eg1-2" role="tabpanel">
                        <!-- <quotation :patient="patient" v-if="patient.schemas.quotations"></quotation> -->
                    </div>
                    <div class="tab-pane show" id="tab-eg1-3" role="tabpanel">
                        <!-- <payment :patient="patient" v-if="showschema"></payment> -->
                    </div>
                    <div class="tab-pane show" id="tab-eg1-4" role="tabpanel">
                        <prescription-tab :patient="patient" ref="prescription_tab"></prescription-tab>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import InitialSchemaComponent from "./InitialSchemaComponent";
import PlanSchemaComponent from "./PlanSchemaComponent";
import Quotation from "./Quotation";
import Payment from "./Payment";
import PrescriptionTab from "./PrescriptionTab";
export default {
    components: {
        InitialSchemaComponent,
        PlanSchemaComponent,
        Quotation,
        Payment,
        PrescriptionTab
    },
    props: ["patient", "showschema"],
    data() {
        return {};
    },
    methods: {
      getPrescription(prescription){
        this.$refs.prescription_tab.getPrescription(prescription);
      }
    },
    mounted() {}
};
</script>

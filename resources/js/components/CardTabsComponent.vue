<template>
    <div>
        <div class="main-card mb-3 card">
            <div class="card-header">
                <ul class="nav col-sm-10">
                    <li class="nav-item">
                        <a
                            data-toggle="tab"
                            href="#tab-eg1-1"
                            :class="[
                                isInitialActive
                                    ? 'nav-link active'
                                    : 'nav-link '
                            ]"
                            >Initiale</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            data-toggle="tab"
                            href="#tab-eg1-0"
                            class="nav-link "
                            >{{ type }}</a
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
                    <li class="nav-item">
                        <a
                            data-toggle="tab"
                            href="#tab-eg1-5"
                            :class="[
                                isRadioActive ? 'nav-link active' : 'nav-link'
                            ]"
                            >Radiographies</a
                        >
                    </li>
                </ul>
                <div class="d-none d-sm-block">Schéma Dentaire</div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div
                        :class="[
                            isInitialActive
                                ? 'tab-pane active show'
                                : 'tab-pane show'
                        ]"
                        id="tab-eg1-1"
                        role="tabpanel"
                    >
                        <initial-schema-component
                            :patient="patient"
                            v-if="showschema"
                        ></initial-schema-component>
                    </div>
                    <div class="tab-pane  show" id="tab-eg1-0" role="tabpanel">
                        <plan-schema-component
                            :patient="patient"
                            v-if="showschema"
                            @payment-done="updatePayment"
                        ></plan-schema-component>
                    </div>
                    <div class="tab-pane show" id="tab-eg1-2" role="tabpanel">
                        <!-- <quotation :patient="patient" v-if="patient.schemas.quotations"></quotation> -->
                    </div>
                    <div class="tab-pane show" id="tab-eg1-3" role="tabpanel">
                        <payment :patient="patient" ref="payment"></payment>
                    </div>
                    <div class="tab-pane show" id="tab-eg1-4" role="tabpanel">
                        <prescription-tab
                            :patient="patient"
                            ref="prescription_tab"
                        ></prescription-tab>
                    </div>
                    <div
                        :class="[
                            isRadioActive
                                ? 'tab-pane show active'
                                : 'tab-pane show'
                        ]"
                        id="tab-eg1-5"
                        role="tabpanel"
                    >
                        <radiographie-tab
                            ref="radiographie_tab"
                            :patient="patient"
                        ></radiographie-tab>
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
import RadiographieTab from "./RadiographieTab";
export default {
    components: {
        InitialSchemaComponent,
        PlanSchemaComponent,
        Quotation,
        Payment,
        PrescriptionTab,
        RadiographieTab
    },
    props: ["patient", "showschema"],
    data() {
        return {
            isRadioActive: false,
            isInitialActive: true,
            isPrescriptionActive: false
        };
    },
    methods: {
        getPrescription(prescription) {
            this.$refs.prescription_tab.getPrescription(prescription);
        },
        updatePayment(payment) {}

        // getImage(url) {
        //     this.isRadioActive = true; // show Radio tab
        //     this.isInitialActive = false; // hide initial tab
        //     this.$refs.radiographie_tab.addToGallery(url);
        // }
    },
    computed: {
        type() {
            return this.patient.last_schema ? "Plan" : "Devis";
        }
    },
    mounted() {}
};
</script>

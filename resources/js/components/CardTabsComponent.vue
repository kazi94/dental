<template>
    <div>
        <b-card no-body class="mb-2">
            <b-tabs
                card
                ref="tab"
                justified
                @activate-tab="getActiveTabID"
                active-nav-item-class="font-weight-bold text-uppercase"
            >
                <!-- Render Tabs, supply a unique `key` to each tab -->
                <b-tab
                    title="Initial"
                    title-link-class="h6"
                    v-if="user.role_id == 1 || user.role_id == 2"
                >
                    <initial-schema-component
                        :patient="patient"
                    ></initial-schema-component>
                </b-tab>
                <b-tab
                    :title="type"
                    title-link-class="h6"
                    v-if="user.role_id == 1 || user.role_id == 2"
                >
                    <plan-schema-component
                        :patient="patient"
                        @payment-done="updatePayment"
                        ref="plan_tab"
                    ></plan-schema-component>
                </b-tab>
                <b-tab title="Règlements" title-link-class="h6">
                    <payment :patient="patient" ref="payment"></payment>
                </b-tab>
                <b-tab
                    title="Prescriptions"
                    title-link-class="h6"
                    v-if="user.role_id == 1 || user.role_id == 2"
                >
                    <prescription-tab
                        :patient="patient"
                        ref="prescription_tab"
                    ></prescription-tab>
                </b-tab>
                <b-tab
                    title="Radiographies"
                    title-link-class="h6"
                    v-if="user.role_id == 1 || user.role_id == 2"
                >
                    <radiographie-tab
                        ref="radiographie_tab"
                        :patient="patient"
                    ></radiographie-tab>
                </b-tab>
            </b-tabs>
        </b-card>
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
    props: ["patient", "showschema", "user"],
    data() {
        return {
            isRadioActive: false,
            isInitialActive: true,
            isPrescriptionActive: false,
            showSchema: false
        };
    },
    methods: {
        getActiveTabID(tabIndex) {
            //! get the current tab index
            if (tabIndex == 1) {
                this.showSchema = true;
                //this.$refs.plan_tab.loadSchema();
            }
        },
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

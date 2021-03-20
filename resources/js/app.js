/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Vue from "vue"
// import Vuex from 'vuex'
import {
    Form,
    HasError,
    AlertError
} from "vform"
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
import Toasted from 'vue-toasted';
import Multiselect from "vue-multiselect";
import {
    BootstrapVue,
    IconsPlugin
} from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "./style.css";
import "./custom.css";
import VdtnetTable from "vue-datatables-net";

window.Vue = require("vue");
window.Form = Form;

// Vue.use(Vuex)
Vue.use(Toaster, {
    timeout: 5000
});
const options = {
    position: "bottom-center",
    duration: 1000
};
Vue.use(Toasted, options)
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("multiselect", Multiselect);
//Custom Componnents Registration
Vue.component(
    "patient-component",
    require("./components/PatientComponent.vue").default
);
// Vue.component(
//     "liste-patient-component",
//     require("./components/ListePatientComponent.vue").default
// );
Vue.component(
    "informations-component",
    require("./components/InformationsComponent.vue").default
);
// Vue.component(
//     "tabs-component",
//     require("./components/TabsComponent.vue").default
// );
Vue.component(
    "card-tabs-component",
    require("./components/CardTabsComponent.vue").default
);
Vue.component(
    "rendez-vous-btn",
    require("./components/RendezVousBtn.vue").default
);
Vue.component(
    "radiographie-button",
    require("./components/RadiographieButton.vue").default
);
Vue.component("prescription", require("./components/Prescription.vue").default);
Vue.component("appointements", require("./components/Appointements.vue").default);

// const store = new Vuex.Store({
//     state: {
//         count: 0
//     },
//     mutations: {
//         increment(state) {
//             state.count++
//         }
//     }
// })

const app = new Vue({
    el: "#app",
    // store: store,
    data: {
        pathologies: {},
        antecedents: {},
        patient: {},
        showInfos: true,
        showRadios: true,
        showPrescriptions: true,
        showRdv: true,
        showSchema: true,
        patients: []
    },
    methods: {
        getPrescription(prescription) {
            // pass new prescription to the child component shemaDental/prescriptionTab
            console.log("app file : " + prescription);
            this.$refs.tabs.getPrescription(prescription);
        },
        newModal() {
            $("#patient_add_modal").modal("show");
        },
        getImage(url) {
            this.$refs.tabs.getImage(url);
        },

        generatePatient($event) {
            //Afficher les informations perso/medic
            //Afficher le bouton modifier
            this.patient = $event; // event = patient
            //Afficher le patient dans la liste
            this.patients.push($event);
            //Afficher les boutons ajouter : radio, prescription,schema
            this.showInfos = true;
            this.showRadios = true;
            this.showPrescriptions = true;
            this.showRdv = true;
            this.showSchema = true;
        },

        generateSelectedPatient($patient) {
            this.patient = $patient;
            this.showSchema = false;

            setTimeout(() => {
                lightGallery(document.getElementById("lightgallery"), {
                    thumbnail: true
                });
                this.showInfos = true;
                this.showRadios = true;
                this.showPrescriptions = true;
                this.showRdv = true;
                this.showSchema = true;
            }, "1000");
            //Afficher les boutons ajouter : radio, prescription,schema
        },

        regeneratePatient(patient) {
            // function to change the infos about patient in all components
            this.patient = patient;
            $.each(this.patients, function (k, e) {
                if (e.id === patient.id) e = patient;
            });
        }
    },
    mounted() {
        // on mounted page, display all patients
        // axios.get("/patientss").then(response => {
        //     this.patients = response.data;
        // });
    }
});

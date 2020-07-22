/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

//VueFormWizard Registration
// import VueFormWizard from 'vue-form-wizard'
// import 'vue-form-wizard/dist/vue-form-wizard.min.css'
// Vue.use(VueFormWizard)

//vForm Registration
import Vue from "vue";

import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

//V-toasrze Registration
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
/// for notifications
Vue.use(Toaster, { timeout: 5000 });

// vue-select Registration
// import vSelect from 'vue-select'
// Vue.component('v-select', vSelect)
// import 'vue-select/dist/vue-select.css';

//Vue-MultipleSelect Regsitration
import Multiselect from "vue-multiselect";
Vue.component("multiselect", Multiselect);
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "./style.css";
import "./custom.css";
const patients = new Vue({
    el: "#patients",
    data: {
        fields: [
            "nom",
            "prenom",
            "date_naissance",
            "age",
            { key: "num_tel", label: "Téléphone" }
        ],
        patients: []
    },
    methods: {
        newModal() {
            $("#patient_add_modal").modal("show");
        }
    },
    mounted() {
        // on mounted page, display all patients
        axios.get("/patients").then(response => {
            this.patients = response.data;
        });
    }
});

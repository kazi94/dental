/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
bar(); 

//VueFormWizard Registration
// import VueFormWizard from 'vue-form-wizard'
// import 'vue-form-wizard/dist/vue-form-wizard.min.css'
// Vue.use(VueFormWizard)

//vForm Registration
<<<<<<< HEAD
import Vue from 'vue'

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
=======
import Vue from 'vue';
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3

//V-toasrze Registration
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
/// for notifications
Vue.use(Toaster, {timeout: 5000})

// vue-select Registration
// import vSelect from 'vue-select'
// Vue.component('v-select', vSelect)
// import 'vue-select/dist/vue-select.css';

//Vue-MultipleSelect Regsitration
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
<<<<<<< HEAD
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
=======

>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3

//VdtnetTable Registration
import VdtnetTable from 'vue-datatables-net'

// import 'datatables.net-bs4'
<<<<<<< HEAD
=======

>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
// below you should only import what you need
// Example: import buttons and plugins
// import 'datatables.net-buttons/js/dataTables.buttons.js'
// import 'datatables.net-buttons/js/buttons.html5.js'
// import 'datatables.net-buttons/js/buttons.print.js'

// import the rest for your specific theme
// import 'datatables.net-buttons-bs4'
// import 'datatables.net-select-bs4'

// import 'datatables.net-select-bs4/css/select.bootstrap4.min.css'
// import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'

//Custom Componnents Registration
Vue.component('patient-component', require('./components/PatientComponent.vue').default);
Vue.component('liste-patient-component', require('./components/ListePatientComponent.vue').default)
Vue.component('informations-component', require('./components/InformationsComponent.vue').default)
<<<<<<< HEAD
// Vue.component('radiographies-component', require('./components/RadiographiesComponent.vue').default)
// Vue.component('prescriptions-component', require('./components/PrescriptionsComponent.vue').default)
Vue.component('tabs-component', require('./components/TabsComponent.vue').default)
Vue.component('schema-dental-component', require('./components/SchemaDentalComponent.vue').default)
=======
Vue.component('radiographies-component', require('./components/RadiographiesComponent.vue').default)
Vue.component('prescriptions-component', require('./components/PrescriptionsComponent.vue').default)
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue(
{
    el: '#app',
<<<<<<< HEAD
   
=======
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
    data : {
    	pathologies : {},
    	antecedents : {},
        patient : {},
        showInfos: false,
        showRadios: false,
        showPrescriptions: false,
<<<<<<< HEAD
        showRdv: false,
        showSchema : false,
=======
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        patients : [],
    },
    methods : {
    	newModal()
        {
<<<<<<< HEAD
            
            $("#patient_add_modal").modal('show');     

        },

=======
                $("#patient_add_modal").modal('show');               
        },
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        generatePatient($event) 
        {
            //Afficher les informations perso/medic                 
            //Afficher le bouton modifier
            this.patient = $event; // event = patient
            //Afficher le patient dans la liste
            this.patients.push($event);
            //Afficher les boutons ajouter : radio, prescription,schema
            this.showInfos = true;
            this.showRadios = true;
            this.showPrescriptions = true;
<<<<<<< HEAD
            this.showRdv = true;
            this.showSchema = true;

        },

=======
        },    
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
        generateSelectedPatient($patient)
        {
            this.patient = $patient;
            //Afficher les boutons ajouter : radio, prescription,schema
<<<<<<< HEAD

            lightGallery(document.getElementById('lightgallery'), {
                thumbnail:true
            });
            this.showInfos = true;
            this.showRadios = true;             
            this.showPrescriptions = true;            
            this.showRdv = true;  
            this.showSchema = true;          
        },

        regeneratePatient(patient) 
        { // function to change the infos about patient in all components
            this.patient = patient;
            $.each(this.patients, function(k, e) {
                if (e.id === patient.id)
                    e = patient;
=======
            this.showInfos = true;
            this.showRadios = true;
            lightGallery(document.getElementById('lightgallery'), {
                thumbnail:true
            });
            this.showPrescriptions = true;
        },
        regeneratePatient($patient){ // function to change the infos about patient in all components
            this.patient = $patient;
            $.each(this.patients, function(k, e) {
                if (e.id === this.patient.id)
                    e = this.patient;
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
            });
        }
    },
    mounted(){ // on mounted page, display all patients
        axios.get('/patients').then( (response) => {
            this.patients = response.data;
<<<<<<< HEAD
        });
=======
        } );
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
    }

});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

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
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "./style.css";
import "./custom.css";
// admin
Vue.component(
    "general-component",
    require("./components/settings/GeneralComponent.vue").default
);
Vue.component(
    "user-component",
    require("./components/settings/UserComponent.vue").default
);
Vue.component(
    "ordonnance-component",
    require("./components/settings/OrdonnanceComponent.vue").default
);
Vue.component(
    "act-component",
    require("./components/settings/ActComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#admin_app",

    data: {},
    methods: {},
    mounted() {
        // on mounted page, display all patients
    }
});

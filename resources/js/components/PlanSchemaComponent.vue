<template>
    <div>
        <div class="row border-bottom border-alternate pb-1">
            <div class="col-md-6">
                <!-- Tabs Section -->
                <div v-if="isQuotation">
                    <b-card no-body class="mb-2">
                        <b-tabs card ref="tab" @activate-tab="getActiveTabID">
                            <!-- Render Tabs, supply a unique `key` to each tab -->
                            <b-tab
                                v-for="i in tabs"
                                :key="'dyn-tab-' + i"
                                :title="'Devis ' + (i + 1)"
                            >
                                <!-- Table quotation -->
                                <div>
                                    <b-table
                                        :ref="'quotation_' + i"
                                        selectable
                                        select-mode="multi"
                                        @row-selected="onRowSelected"
                                        :items="quotations['quotation_' + i]"
                                        :fields="fields"
                                        bordered
                                        responsive="sm"
                                        small
                                        head-variant="light"
                                        :sort-by.sync="sortBy"
                                        :sort-desc.sync="sortDesc"
                                    >
                                        <template v-slot:cell(prix)="data">
                                            <input
                                                type="text"
                                                v-if="edit"
                                                v-model="data.item.prix"
                                                @keyup.enter="
                                                    handlePriceOnKeyUpEnterEvent(
                                                        data
                                                    )
                                                "
                                            />
                                            <p v-else @click="edit = true">
                                                <b class="text-info">
                                                    {{ data.item.prix }}
                                                </b>
                                            </p>
                                        </template>

                                        <template
                                            v-slot:cell(selected)="{
                                                rowSelected
                                            }"
                                        >
                                            <template v-if="rowSelected">
                                                <span aria-hidden="true"
                                                    >&check;</span
                                                >
                                                <span class="sr-only"
                                                    >Selected</span
                                                >
                                            </template>
                                            <template v-else>
                                                <span aria-hidden="true"
                                                    >&nbsp;</span
                                                >
                                                <span class="sr-only"
                                                    >Not selected</span
                                                >
                                            </template>
                                        </template>
                                    </b-table>
                                </div>
                                <!-- <b-button size="sm" variant="danger" class="float-right" @click="closeTab(i)">
                    Supprimer devis
                  </b-button>-->
                            </b-tab>

                            <!-- New Tab Button (Using tabs-end slot) -->
                            <template v-slot:tabs-end>
                                <b-nav-item
                                    role="presentation"
                                    @click.prevent="newTab"
                                    href="#"
                                >
                                    <b>+</b>
                                </b-nav-item>
                            </template>
                        </b-tabs>
                    </b-card>
                </div>
                <!-- End Tabs Section -->

                <!-- State of Quotation -->
                <!-- <div
                        class="btn-group btn-breadcrumb mb-2 d-sm-flex"
                        v-if="
                            this.quotation.length > 0 ||
                                this.acceptedQuotation.length > 0
                        "
                    >
                        <span
                            v-for="(quotState, index) in quotStates"
                            :key="index"
                            class="btn rounded-0"
                            :class="[
                                quotState.state ? 'btn-success' : 'btn-info'
                            ]"
                            >{{ quotState.name }}</span
                        >
                    </div> -->
                <!-- End State of Quotation -->

                <!-- "Actes fait" Section -->
                <b-button
                    size="sm"
                    variant="success"
                    squared
                    :hidden="btnDone"
                    class="pull-right mb-1"
                    v-b-modal.modal-acts-done
                >
                    <b-icon
                        icon="check-circle-fill"
                        aria-hidden="true"
                    ></b-icon>
                    Actes fait
                </b-button>
                <!-- Acts done Model -->
                <b-modal
                    id="modal-acts-done"
                    title="Liste des Actes fait"
                    size="lg"
                    ok-title="Fermer"
                    :ok-only="onlyOk"
                    header-bg-variant="success"
                    header-text-variant="white"
                >
                    <b-table
                        bordered
                        responsive="sm"
                        small
                        head-variant="light"
                        :items="actsDoneItems"
                        :fields="actsDoneFields"
                    >
                        <template v-slot:cell(index)="data">
                            <!-- data = acceptedQuotation -->
                            {{ data.index + 1 }}
                        </template>
                        <template v-slot:cell(act)="data">{{
                            data.value.nom
                        }}</template>
                    </b-table>
                </b-modal>
                <!-- END Acts done Model -->

                <!-- "End Actes fait" Section -->

                <!-- PLan table -->
                <div>
                    <b-table
                        v-if="acceptedQuotation.length > 0"
                        bordered
                        responsive="sm"
                        small
                        head-variant="light"
                        :items="acceptedQuotation"
                        :fields="acceptedQuotationFields"
                    >
                        <template v-slot:cell(index)="data">
                            <!-- data = acceptedQuotation -->
                            {{ data.index + 1 }}
                        </template>
                        <template v-slot:cell(act)="data">{{
                            data.value.nom
                        }}</template>
                        <template v-slot:cell(price)="data">
                            <b-form-group
                                id="priceid-1"
                                description="Tapez sur Entrée pour modifier le prix."
                                v-if="edit == data.item.id"
                            >
                                <b-form-input
                                    type="text"
                                    v-model="data.item.price"
                                    @keyup.enter="
                                        handlePriceOnKeyUpEnterEvent(
                                            $event,
                                            data
                                        )
                                    "
                                    trim
                                ></b-form-input>
                            </b-form-group>
                            <p v-else @click="edit = data.item.id">
                                <b class="text-info">
                                    {{ data.item.price }} DA
                                </b>
                            </p>
                        </template>
                        <template v-slot:cell(state)="data">
                            <!-- data = acceptedQuotation -->
                            <b-badge
                                pill
                                v-if="data.item.state == 'En cours'"
                                variant="secondary"
                                @click="handleState(data.item)"
                                style="cursor:pointer"
                                >{{ data.item.state }}</b-badge
                            >
                            <b-badge
                                pill
                                v-else
                                variant="success"
                                @click="handleState(data.item)"
                                style="cursor:pointer"
                                >{{ data.item.state }}</b-badge
                            >
                        </template>
                    </b-table>
                </div>
                <!-- End Table Plan -->

                <!-- Display Informations about quotation  -->
                <b-row class="m-0">
                    <b-col sm="6" v-if="isQuotation">
                        <p>
                            <b-button
                                size="sm"
                                squared
                                @click="this.selectAllRows"
                                >Tout selectionner</b-button
                            >
                            <b-button
                                size="sm"
                                squared
                                @click="this.clearSelected"
                                >Vider la selection</b-button
                            >
                        </p>
                    </b-col>
                    <b-col sm="12">
                        <p class="text-center font-weight-bold alert-success">
                            Remise :
                            <span>{{ remise }} DA</span>
                        </p>
                        <p
                            class="text-center font-weight-bold alert-dark"
                            v-show="isQuotation"
                        >
                            Total :
                            <span>{{ total }} DA</span>
                        </p>
                        <p
                            class="text-center font-weight-bold alert-dark"
                            v-show="!isQuotation"
                        >
                            Total :
                            <span>{{ display_total }} DA</span>
                        </p>
                        <p
                            class="text-center font-weight-bold alert-info border-bottom border-alternate"
                        >
                            Total accepté :
                            <span>{{ total_accept }} DA</span>
                        </p>
                        <b-button
                            size="sm"
                            squared
                            :disabled="paidBtnDisabled"
                            v-show="isQuotation"
                            class="float-right"
                            variant="success"
                            @click="acceptQuotation"
                            >Accepter</b-button
                        >
                        <b-button
                            size="sm"
                            squared
                            variant="primary"
                            v-b-modal.cach-modal
                            >Versement</b-button
                        >
                        <!-- <b-button
                            size="sm"
                            squared
                            v-show="!isQuotation"
                            class="float-right"
                            variant="light"
                            >Imprimer</b-button
                        > -->
                    </b-col>
                </b-row>
                <!-- End Display Informations about quotation -->
            </div>
            <div class="col-md-6">
                <schema-component
                    :selectedTooth="selectedTooth"
                    :isToothVisible="isToothVisible"
                    ref="schema"
                    :p_class="!isQuotation ? 'mb-2' : ''"
                ></schema-component>
                <category ref="categories"></category>
                <b-button
                    size="sm"
                    variant="success"
                    class="btn-block"
                    squared
                    @click="isQuotation ? save() : addActsToPlan()"
                    >Ajouter</b-button
                >
            </div>
        </div>
        <div>
            <b-modal
                id="cach-modal"
                ref="modal"
                title="Versement"
                header-bg-variant="success"
                header-text-variant="light"
                no-fade
                button-size="sm"
                modal-ok="Valider"
                ok-title="Encaisser"
                @show="resetModal"
                @hidden="resetModal"
                @ok="verify"
            >
                <form ref="form">
                    <b-form-group
                        :state="nameState"
                        label="Total encaissé"
                        description="Une somme inférieur au total est acceptable."
                        label-for="name-input"
                        invalid-feedback="Name is required"
                    >
                        <b-form-input
                            id="name-input"
                            v-model="total_paid"
                            :state="nameState"
                            required
                        ></b-form-input>
                    </b-form-group>
                </form>
            </b-modal>
        </div>
    </div>
</template>

<script>
import SchemaComponent from "./SchemaComponent.vue";
import Category from "./plan-schema/Category.vue";
import QuotationTable from "./plan-schema/QuotationTable.vue";

// outside of the component:
function initialState() {
    return {
        onlyOk: true,
        actsDoneFields: [
            { key: "index", sortable: true, label: "#" },
            { key: "num_dent", sortable: true, label: "Dent" },
            { key: "act", sortable: true, label: "Acte" },
            { key: "date_done", sortable: true, label: "Date de réalisation" }
        ],
        actsDoneItems: [],
        tabs: [0],
        tabCounter: 1,
        quotStates: [
            { name: "Devis", state: true },
            { name: "Plan", state: false },
            { name: "En cours", state: false },
            { name: "Fait", state: false }
        ],
        acceptedQuotationFields: [
            { key: "index", sortable: true },
            { key: "num_dent", sortable: true },
            { key: "act", sortable: true, label: "Acte" },
            { key: "price", sortable: true, label: "Prix" },
            { key: "state", sortable: true, label: "Status" }
        ],
        selectedTooth: new Array(),
        schema_id: "",
        quotations: {},
        quotation: [],
        acceptedQuotation: new Array(),
        isQuotation: true,
        id: "",
        remise: 0,
        total: 0,
        total_accept: 0,
        total_paid: 0,
        display_total: 0,
        nameState: null,
        paidBtnDisabled: true,
        isActVisible: true,
        isToothVisible: true,
        fields: [
            { key: "selected", sortable: false },
            { key: "num_dent", sortable: true },
            { key: "acte", sortable: true },
            { key: "prix", sortable: true }
        ],
        selected: [],
        sortBy: "num_dent",
        sortDesc: false,
        edit: false,
        tabIndex: 0,
        copyQuotation: null,
        btnDone: true
    };
}

// COMPONENT
export default {
    components: {
        SchemaComponent,
        Category,
        QuotationTable
    },

    props: ["patient"],
    data() {
        return initialState();
    },

    methods: {
        closeTab(x) {
            for (let i = 0; i < this.tabs.length; i++) {
                if (this.tabs[i] === x) {
                    this.tabs.splice(i, 1);
                }
            }
        },
        newTab() {
            this.tabs.push(this.tabCounter++);
        },
        onRowSelected(items) {
            this.selected = items;
        },
        selectAllRows() {
            this.$refs[`quotation_${this.tabIndex}`][0].selectAllRows();
        },
        getActiveTabID(tabIndex) {
            //! get the current tab index
            this.tabIndex = tabIndex;
        },
        /*
         * Btn AJouter
         * Add acts to the current Plan (Devis en cours de traitement)
         * And Send new acts to the server
         */
        addActsToPlan() {
            // get Additional Acts
            let additionalQuotation = this.getAdditionalActs();
            let data = [
                { key: "lignes", value: JSON.stringify(additionalQuotation) },
                {
                    key: "quot_id",
                    value: this.patient.last_schema.last_quotation.id
                },
                { key: "total", value: this.display_total }
            ];
            let form = this.createForm(data);

            this.calculateTotal(additionalQuotation);
            this.display_total =
                parseInt(this.display_total) + parseInt(this.total);

            // Send new acts to the server
            axios
                .post("/patients/devis/add-acts", form)
                .then(response => {
                    //* Reset selected tooth and selected acts
                    //this.resetSchema();

                    //* create new shapes
                    this.$refs.schema.createShapes(response.data);
                    response.data.forEach(row => {
                        this.acceptedQuotation.push(row);
                    });
                })
                .catch(exception => {
                    console.log(exception);
                });
        },
        /**
         * get the additional acts and put them in array
         *
         * @param null
         * @returns {Array} acts
         * @returns {Number} acts[].act_id
         * @returns {Number} acts[].num_dent
         * @returns {String} acts[].acte name of the act
         * @returns {Number} acts[].prix price of the act
         */
        getAdditionalActs() {
            let data = [];
            $.each(this.selectedTooth, (index, el) => {
                // For each selected acts , Create new Quotation Row
                $.each(this.$refs.categories.selectedActs, (i, e) => {
                    data.push({
                        act_id: e.id,
                        num_dent: el,
                        acte: e.nom,
                        prix: e.price
                    });
                });
            });

            return data;
        },
        save() {
            let currentQuotation = "quotation_" + this.tabIndex;
            //! Ajouter btn
            //* Add selected tooth and acts to quotation table
            //* For each selected teeth, bind with acts and create Quotation object
            $.each(this.selectedTooth, (index, el) => {
                // For each selected acts , Create new Quotation Row
                $.each(this.$refs.categories.selectedActs, (i, e) => {
                    this.quotation.push({
                        act_id: e.id,
                        num_dent: el,
                        acte: e.nom,
                        prix: e.price
                    });
                    // get coords of all selected Acts
                    this.getCoordsByAct(e.id, el, currentQuotation);
                });
            });

            //? Create new quotation_index key : value for each tabs
            if (this.quotations[currentQuotation] != undefined)
                // add new acts to the current quotation
                this.quotations[currentQuotation] = this.quotations[
                    currentQuotation
                ].concat(this.quotation);
            else this.quotations[currentQuotation] = this.quotation;

            // make a copy
            this.copyQuotation = this.quotations[currentQuotation];

            //* Calculer le total
            this.calculateTotal(this.quotations[currentQuotation]);

            //* Reset quotation
            this.resetQuotation();

            //* Reset selected tooth and selected acts
            this.resetSchema();
        },
        getCoordsByAct(act_id, teeth, currentQuotation) {
            axios
                .get(
                    "/patients/acts/get-coords/act_id=" +
                        act_id +
                        "&&teeth=" +
                        teeth
                )
                .then(response => {
                    this.$refs.schema.createShapes(
                        response.data,
                        currentQuotation
                    );
                });
        },
        resetSchema() {
            // * Uncheck selected acts
            this.$refs.categories.selectedActs = [];

            //* Uncheck Selected tooth
            this.selectedTooth = [];
            this.$refs.schema.num_tooth.map(e => (e.state = false));
        },
        resetQuotation() {
            this.quotation = [];
        },
        clearSelected() {
            this.$refs[`quotation_${this.tabIndex}`][0].clearSelected();
        },
        checkFormValidity() {
            const valid = this.$refs.form.checkValidity();
            this.nameState = valid;
            return valid;
        },
        resetModal() {
            this.total_paid = this.total_accept;
            this.nameState = null;
        },
        validateCach() {
            // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
                return;
            }
            // Create Form
            let form = this.createForm("onDay");
            // Send data to the server
            axios
                .post("/patients/devis", form)
                .then(response => {
                    // reset to default data
                    Object.assign(this.$data, initialState());

                    this.$bvModal.hide("cach-modal");
                    this.$toaster.success("Versement fait !");
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
            // Hide the modal manually
            this.$nextTick(() => {
                this.$bvModal.hide("modal-prevent-closing");
            });
        },
        // Confirm Payement(s) of the created quotation
        validatePayements() {
            /**
             * get the ID of Plan
             */
            let devis_id = this.acceptedQuotation[0].devis_id;
            let data = [
                {
                    key: "devis_id",
                    value: devis_id
                },
                {
                    key: "total_paid",
                    value: this.total_paid
                }
            ];
            let form = this.createForm(data);
            axios
                .post("/patients/devis/create-payement-by-devis", form)
                .then(response => {
                    this.$toaster.success("Versement fait !");
                    this.$bvModal.hide("cach-modal");
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, "0");
                    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy + "-" + mm + "-" + dd;
                    let payment = {
                        total_paid: this.total_paid,
                        paid_at: today
                    };
                    this.$emit("payment-done", payment);
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });

            // Hide the modal manually
            this.$nextTick(() => {
                this.$bvModal.hide("modal-prevent-closing");
            });
        },
        /**
         * Generate Form Data
         *
         * @param {Array} [items] array of key/value object
         * @return {FormData} FormData
         */
        createForm(items) {
            let form = new FormData();

            items.forEach(function(item) {
                form.set(item["key"], item["value"]);
            });

            return form;
        },
        /*
         * Button Accepter
         */
        acceptQuotation() {
            let data = [
                {
                    key: "quotation",
                    value: JSON.stringify(this.quotation)
                },
                {
                    key: "total",
                    value: this.total
                },
                {
                    key: "discount",
                    value: this.remise
                },
                {
                    key: "selectedLignes",
                    value: JSON.stringify(this.selected)
                },
                {
                    key: "total_accept",
                    value: this.total_accept
                },
                {
                    key: "rhythmTraitement",
                    value: ""
                },
                {
                    key: "patient_id",
                    value: this.patient.id
                },
                {
                    key: "total_paid",
                    value: this.total_paid
                }
            ];
            // Create form data
            let form = this.createForm(data);
            // Send data to the server
            axios
                .post("/patients/devis", form)
                .then(response => {
                    this.handleQuotation(response);
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },
        handleQuotation(response) {
            // Change Devis -> Plan
            this.quotStates[0].state = false;
            this.quotStates[1].state = true;
            this.display_total = this.total;
            // Display table with tooth, acts , and price
            // Quotation table become the selected acts TO DO
            //this.acceptedQuotation = this.selected;
            this.quotation = [];
            // Return created quotation rows to display in accepted quotation
            this.acceptedQuotation = response.data;

            // empty selected rows
            this.selected = [];
            this.clearSelected();

            // Hide accept btn  && Add print btn
            this.isQuotation = false;
            this.quotations = {};
            //reset total accept
            this.total_accept = 0;

            //* create shapes
            this.$refs.schema.createShapes(response.data);
        },

        handleState(row) {
            // update the state of the act
            if (row.state == "En cours") {
                row.state = "Fait";
                this.total_accept += row.price; // Calculé la somme total faite
                this.total_paid = this.total_accept;
            } else if (row.state == "Fait" && !row.lock) {
                row.state = "En cours";
                this.total_accept -= row.price; // Calculé la somme total faite
                this.total_paid = this.total_accept;
            }
            axios
                .get(
                    "/patients/devis/update-ligne/" + row.state + "&&" + row.id
                )
                .catch(exception => {
                    this.$toaster.error(exception);
                });
            // * Handle payement button
            this.paidBtnDisabled = this.total_paid != 0 ? false : true;
        },
        /*
         * Encaisser btn
         */
        verify(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault();
            if (!this.isQuotation)
                // isPlan
                this.validatePayements();
            else this.validateCach();
        },
        /**
         * Remove all shapes from plan schema
         * @return void
         */
        removeShapes() {
            // find shape elements by teeth attribute
            var shapes = document.getElementById("plan_schema_canvas")
                .childNodes;
            for (let index = 0; index < shapes.length; index++) {
                shapes[index].remove();
            }
        },
        initialState() {
            this.isQuotation = true;
            this.acceptedQuotation = [];
            this.remise = 0;
            this.display_total = 0;
            this.quotStates[0].state = true;
            this.quotStates[2].state = false;
            this.isToothVisible = true;
        },
        calculateTotal(quotation) {
            let total = 0;
            //* get the quotation of current active tab
            quotation.forEach(myfunction);

            function myfunction(value) {
                total += parseInt(value.prix);
            }

            this.total = total;
        },
        handlePriceOnKeyUpEnterEvent($event, data) {
            const line_id = data.item.id;
            const newPrice = parseInt($event.target.value);

            data.item.prix = newPrice;
            this.edit = false;

            let formData = new FormData();

            formData.set("price", newPrice);

            axios.post("/api/patients/plan/lines/" + line_id, formData);
        },
        loadSchema() {
            this.$refs.schema.loadSchema();
        },
        mountSchema() {}
    },

    watch: {
        tabIndex: {
            handler: function(newV) {
                let currentQuotation = "quotation_" + newV;
                //* Calculate Total related to the current tab
                if (this.quotations[currentQuotation] != undefined)
                    this.calculateTotal(this.quotations[currentQuotation]);

                // show schema of the current tab
                var shapes = document.getElementById("plan_schema_canvas")
                    .childNodes;
                for (let index = 0; index < shapes.length; index++) {
                    if (
                        shapes[index].getAttribute("devis") != currentQuotation
                    ) {
                        // hide them
                        shapes[index].style.display = "none";
                    } else {
                        // display them
                        shapes[index].style.display = "block";
                    }
                }
            },
            deep: true
        },
        selected: {
            handler: function(newVal, old) {
                this.total_accept = 0;
                // Enable 'Accepter' && 'Versement' buttons
                this.paidBtnDisabled = this.selected.length != 0 ? false : true;
                // Calculate total_accept
                $.each(
                    newVal,
                    (i, e) => (this.total_accept += parseInt(e.prix))
                );
            },
            deep: true
        }
    },

    computed: {
        discount: function() {
            return this.total - this.total_accept;
        }
    },

    mounted() {
        // this.$store.commit("increment");

        // console.log(this.$store.state.count); // -> 1
        console.log("Plan schema Component");
        // If Quotation Exist && in Progress
        // Display the Dental Schema, with the tooth updated
        //....
        //  Display the current quotation of the patient in the table with the current state of each acts
        //  Display the versement btn
        //  Display the print btn
        if (
            this.patient.last_schema != null &&
            this.patient.last_schema.last_quotation != null &&
            this.patient.last_schema.last_quotation.lines_in_progress != null
        ) {
            this.isQuotation = false;
            // Display lines Quotation in Plan Table
            this.acceptedQuotation = this.patient.last_schema.last_quotation.lines_in_progress;
            //Display discount
            this.remise = this.patient.last_schema.last_quotation.discount;
            // Display Total amount
            this.display_total = this.patient.last_schema.last_quotation.total;
            // Change state from 'Plan' to 'En cours'
            this.quotStates[0].state = false;
            this.quotStates[2].state = true;
            // Hide Tooth numbers
            this.isToothVisible = true;
            this.isActVisible = true;

            // Display the Dental Schema, with the tooth updated
            let lines = this.patient.last_schema.last_quotation
                .lines_in_progress;
            if (
                this.patient.last_schema.last_quotation.lines_done != null &&
                this.patient.last_schema.last_quotation.lines_done.length != 0
            ) {
                this.btnDone = false;
                this.actsDoneItems = this.patient.last_schema.last_quotation.lines_done;
            }
            // create shapes
            this.$refs.schema.coords = lines;
        } else Object.assign(this.$data, initialState());
    }
};
</script>

<style>
/** The Magic **/
.btn-breadcrumb .btn:not(:last-child):after {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
    border-left: 10px solid white;
    position: absolute;
    top: 50%;
    margin-top: -17px;
    left: 100%;
    z-index: 3;
}
.btn-breadcrumb .btn:not(:last-child):before {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
    border-left: 10px solid rgb(173, 173, 173);
    position: absolute;
    top: 50%;
    margin-top: -17px;
    margin-left: 1px;
    left: 100%;
    z-index: 3;
}

/** The Spacing **/
.btn-breadcrumb .btn {
    padding: 6px 12px 6px 24px;
}
.btn-breadcrumb .btn:first-child {
    padding: 6px 6px 6px 10px;
}
.btn-breadcrumb .btn:last-child {
    padding: 6px 18px 6px 24px;
}

/** Default button **/
.btn-breadcrumb .btn.btn-default:not(:last-child):after {
    border-left: 10px solid #fff;
}
.btn-breadcrumb .btn.btn-default:not(:last-child):before {
    border-left: 10px solid #ccc;
}
.btn-breadcrumb .btn.btn-default:hover:not(:last-child):after {
    border-left: 10px solid #ebebeb;
}
.btn-breadcrumb .btn.btn-default:hover:not(:last-child):before {
    border-left: 10px solid #adadad;
}

/** Primary button **/
.btn-breadcrumb .btn.btn-primary:not(:last-child):after {
    border-left: 10px solid #428bca;
}
.btn-breadcrumb .btn.btn-primary:not(:last-child):before {
    border-left: 10px solid #357ebd;
}
.btn-breadcrumb .btn.btn-primary:hover:not(:last-child):after {
    border-left: 10px solid #3276b1;
}
.btn-breadcrumb .btn.btn-primary:hover:not(:last-child):before {
    border-left: 10px solid #285e8e;
}

/** Success button **/
.btn-breadcrumb .btn.btn-success:not(:last-child):after {
    border-left: 10px solid #5cb85c;
}
.btn-breadcrumb .btn.btn-success:not(:last-child):before {
    border-left: 10px solid #4cae4c;
}
.btn-breadcrumb .btn.btn-success:hover:not(:last-child):after {
    border-left: 10px solid #47a447;
}
.btn-breadcrumb .btn.btn-success:hover:not(:last-child):before {
    border-left: 10px solid #398439;
}

/** Danger button **/
.btn-breadcrumb .btn.btn-danger:not(:last-child):after {
    border-left: 10px solid #d9534f;
}
.btn-breadcrumb .btn.btn-danger:not(:last-child):before {
    border-left: 10px solid #d43f3a;
}
.btn-breadcrumb .btn.btn-danger:hover:not(:last-child):after {
    border-left: 10px solid #d2322d;
}
.btn-breadcrumb .btn.btn-danger:hover:not(:last-child):before {
    border-left: 10px solid #ac2925;
}

/** Warning button **/
.btn-breadcrumb .btn.btn-warning:not(:last-child):after {
    border-left: 10px solid #f0ad4e;
}
.btn-breadcrumb .btn.btn-warning:not(:last-child):before {
    border-left: 10px solid #eea236;
}
.btn-breadcrumb .btn.btn-warning:hover:not(:last-child):after {
    border-left: 10px solid #ed9c28;
}
.btn-breadcrumb .btn.btn-warning:hover:not(:last-child):before {
    border-left: 10px solid #d58512;
}

/** Info button **/
.btn-breadcrumb .btn.btn-info:not(:last-child):after {
    border-left: 10px solid #5bc0de;
}
.btn-breadcrumb .btn.btn-info:not(:last-child):before {
    border-left: 10px solid #46b8da;
}
.btn-breadcrumb .btn.btn-info:hover:not(:last-child):after {
    border-left: 10px solid #39b3d7;
}
.btn-breadcrumb .btn.btn-info:hover:not(:last-child):before {
    border-left: 10px solid #269abc;
}
</style>

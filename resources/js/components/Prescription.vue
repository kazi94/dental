<template>
    <div v-if="user.role_id == 1 || user.role_id == 2">
        <a
            href="javascript:void(0);"
            v-b-modal.modal-prescription
            class="nav-link"
            title="Ajouter une nouvelle ordonnance"
        >
            <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
            Ordonnance
        </a>

        <b-modal
            id="modal-prescription"
            title="Nouvelle ordonnance"
            no-fade
            button-size="sm"
            ok-title="Imprimer"
            cancel-title="Annuler"
        >
            <div>
                <b-form>
                    <b-form-group
                        id="input-group-ordonnance"
                        label="Sélectionner l'ordonnance type"
                        label-for="input-ordonnance"
                        class="font-weight-bold"
                    >
                        <b-form-select
                            v-model="selected"
                            :options="ordonnances_type"
                            class="col-sm-10"
                        ></b-form-select>
                    </b-form-group>
                    <b-form-group label="Médicaments">
                        <b-form-checkbox-group
                            v-model="selectedMeds"
                            :options="medics"
                            name="flavour-2a"
                            stacked
                        ></b-form-checkbox-group>
                    </b-form-group>

                    <b-button
                        variant="primary"
                        squared
                        size="sm"
                        href="javascript:void(0);"
                        v-b-modal.modal-add-new-medic
                    >
                        Ajouter un médicament
                    </b-button>
                    <b-modal
                        id="modal-add-new-medic"
                        title="Ajouter médicament"
                        no-fade
                        button-size="sm"
                        ok-title="Ajouter"
                        cancel-title="Annuler"
                        @ok="addNewMedic"
                        @hidden="resetModal"
                    >
                        <b-form-input
                            v-model="newMedic"
                            placeholder="Renseigner le médicament"
                        ></b-form-input>
                    </b-modal>
                </b-form>
            </div>
            <template v-slot:modal-footer="{}">
                <!-- Emulate built in modal footer ok and cancel button actions -->
                <b-button
                    size="sm"
                    squared
                    variant="secondary"
                    @click="onReset()"
                    >Annuler</b-button
                >
                <b-button
                    size="sm"
                    squared
                    variant="success"
                    @click="onSubmit()"
                >
                    Validez
                    <b-icon
                        icon="check-circle-fill"
                        variant="white"
                        class="mr-1"
                    ></b-icon>
                </b-button>
            </template>
        </b-modal>

        <!-- Print Model -->
        <b-container fluid id="printMe" style="display : none">
            <b-row align-h="center">
                <b-img
                    width="150"
                    height="150"
                    :src="user.cabinet.logo"
                    rounded="circle"
                    alt="Logo cabinet dentaire"
                ></b-img>
            </b-row>
            <b-row class=" mb-2 mt-1 ml-2">
                <b-col>
                    <p>
                        <strong>Patient :</strong> {{ patient.nom }}
                        {{ patient.prenom }}
                    </p>
                    <p><strong>Age :</strong> {{ patient.age }} ans</p>
                    <p><strong>Téléphone :</strong> {{ patient.num_tel }}</p>
                </b-col>
                <b-col class="border-left">
                    <p>
                        <strong>Chirurgien :</strong> Dr.{{ user.name }}
                        {{ user.prenom }}
                    </p>
                </b-col>
                <b-col class="border-left">
                    <p><strong>Le :</strong> {{ today }}</p>
                </b-col>
            </b-row>

            <div>
                <h3 class="ml-2">Liste des médicaments</h3>
                <div class="d-block">
                    <ul v-for="med in selectedMeds">
                        <li>{{ med }}</li>
                    </ul>
                </div>
            </div>
        </b-container>
        <!-- END Print Model -->
    </div>
</template>

<script>
// import { jsPDF } from "jspdf";

export default {
    props: {
        patient: {
            type: Object
        },
        user: {
            type: Object
        }
    },
    components: {},
    data() {
        return {
            selected: null,
            selectedMeds: null,
            medics: [],
            ordonnances_type: [],
            newMedic: null,
            createdPrescription: "",
            today: ""
        };
    },
    methods: {
        /*
         * Get the list of ordonnances type
         */
        fetchOrdonnancesType() {
            axios
                .get("/admin/ordonnance-type/get-ordonnances-type")
                .then(response => {
                    this.ordonnances_type = response.data;
                })
                .catch(exception => {
                    console.log(exception);
                });
        },
        onReset() {
            this.$bvModal.hide("modal-prescription");
            this.selectedMeds = [];
            this.medics = [];
        },
        onSubmit() {
            if (this.selectedMeds.length != 0) {
                // save prescription to db
                this.savePrescription();
            } else alert("Veuillez sélectionner un médicament");
        },
        printPrescription() {
            this.$htmlToPaper("printMe");
        },
        savePrescription() {
            let form = new FormData();
            let vm = this;
            form.set("medicaments", this.selectedMeds);
            form.set("patient_id", this.patient.id);
            // save the prescription into the db
            axios
                .post("/patients/prescription", form)
                .then(response => {
                    this.createdPrescription = response.data.prescription;
                    if (confirm("voulez vous imprimer la prescription ?")) {
                        this.printPrescription();
                    }
                    // close the modal
                    this.onReset();
                    vm.$emit("get-prescription", response.data.prescription);
                    Vue.toasted.success("Ordonnance ajoutée !");
                })
                .catch(exception => {
                    Vue.toasted.error(exception);
                });
        },
        /**
         * Add the new drug to the list of drugs
         */
        addNewMedic() {
            return this.newMedic ? this.medics.push(this.newMedic) : false;
        },
        /**
         * on Hide the modal add new medic
         */
        resetModal() {
            this.newMedic = "";
        }
    },
    watch: {
        /*
         * Show the list of medocs when ordonnance type is selected
         */
        selected: {
            handler: function(newV) {
                let vm = this;
                console.log(newV);
                let selectedOrdonnance = newV; // Ex : 4 or 5 , 6 , {id}
                vm.ordonnances_type.forEach(function(value, index) {
                    if (value.value === newV) {
                        value.medicaments.forEach(med => {
                            vm.medics.push(med); // show the list of medocs
                        });
                    }
                });
                vm.selectedMeds = vm.medics; // check all medics
            }
        }
    },
    mounted() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, "0");
        var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
        var yyyy = today.getFullYear();

        this.today = mm + "/" + dd + "/" + yyyy;
        this.fetchOrdonnancesType();
    }
};
</script>

<template>
    <div>
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
                <b-button size="sm" squared variant="info" @click="onSubmit()">
                    <b-icon
                        icon="cloud-download"
                        variant="white"
                        class="mr-1"
                    ></b-icon
                    >Imprimer
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
import { jsPDF } from "jspdf";

export default {
    props: ["patient"],
    components: {},
    data() {
        return {
            selected: null,
            selectedMeds: null,
            medics: [],
            ordonnances_type: [],
            newMedic: null
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
                // close the modal
                this.onReset();
            } else alert("Veuillez sélectionner un médicament");
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
                    // create pdf file
                    const doc = new jsPDF();
                    let y = 10;
                    this.selectedMeds.forEach((val, index) => {
                        doc.text(index + 1 + "- " + val, 10, y); // 2nd args : x position; 3rd args : y position
                        y += 10;
                    });
                    console.log(
                        "Prescription.vue : " +
                            JSON.stringify(response.data.prescription)
                    );
                    vm.$emit("get-prescription", response.data.prescription);
                    // download pdf file
                    doc.save("ordonnance.pdf");
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
                let selectedOrdonnance = newV; // Ex : 4 or 5 , 6 , {id}
                vm.ordonnances_type.forEach(function(value, index) {
                    if (value.value === newV) vm.medics.push(value.medicaments); // show the list of medocs
                });
                vm.selectedMeds = vm.medics; // check all medics
            }
        }
    },
    mounted() {
        console.log("Prescriptions Component mounted");
        this.fetchOrdonnancesType();
    }
};
</script>

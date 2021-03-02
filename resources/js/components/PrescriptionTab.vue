<template>
    <div class="tab-pane " id="tab-eg1-4" role="tabpanel">
        <div class="row">
            <div class="col-sm-12">
                <b-table
                    striped
                    hover
                    :items="prescriptions"
                    :fields="fields"
                    responsive="sm"
                    :per-page="perPage"
                    :current-page="currentPage"
                    :busy.sync="isBusy"
                >
                    <template v-slot:cell(index)="data">{{
                        data.index + 1
                    }}</template>
                    <template v-slot:cell(Medicaments)="data">
                        <b-button
                            size="sm"
                            squared
                            variant="info"
                            class="mb-1"
                            @click="show(data.item.medicaments)"
                        >
                            Médicaments
                        </b-button>
                    </template>
                    <template v-slot:cell(Imprimer)="data">
                        <b-button
                            size="sm"
                            squared
                            class="mb-1"
                            @click="print(data.item)"
                        >
                            <b-icon
                                icon="printer-fill"
                                aria-hidden="true"
                            ></b-icon>
                            Imprimer
                        </b-button>
                    </template>
                    <template v-slot:cell(Supprimer)="data">
                        <b-button
                            size="sm"
                            squared
                            class="mb-1 btn-danger"
                            @click="remove(data.item.id, data.index)"
                        >
                            <b-icon
                                icon="trash-fill"
                                aria-hidden="true"
                            ></b-icon>
                            Supprimer
                        </b-button>
                    </template>
                </b-table>
                <b-pagination
                    pills
                    align="center"
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                ></b-pagination>
                <b-modal
                    ref="modal-medics"
                    ok-only
                    title="Liste des médicaments"
                >
                    <ol>
                        <li
                            class="my-4"
                            v-for="(medic, index) in medics"
                            :key="index"
                        >
                            {{ medic }}
                        </li>
                    </ol>
                </b-modal>
            </div>
        </div>
    </div>
</template>

<script>
import { jsPDF } from "jspdf";
export default {
    components: {},
    props: ["patient"],
    data() {
        return {
            perPage: 10,
            currentPage: 1,
            isBusy: false,
            fields: [
                { key: "index", class: "text-center" },
                {
                    key: "date_prescription",
                    sortable: true,
                    class: "text-center"
                },
                "Medicaments",
                "Imprimer",
                "Supprimer"
            ],
            prescriptions: [],
            medics: []
        };
    },
    methods: {
        /*
         * Show all prescriptions
         */
        fetchPrescriptions() {
            if (this.patient.prescriptions)
                this.prescriptions = this.patient.prescriptions;
        },
        getPrescription(prescription) {
            this.prescriptions.push(prescription);
        },
        /*
         * Show list of Drugs
         */
        show(medicaments) {
            this.medics = this.splitMedics(medicaments);

            this.$refs["modal-medics"].show();
        },
        print(prescription) {
            const doc = new jsPDF();
            const arr = this.splitMedics(prescription.medicaments);
            let y = 10;

            arr.forEach((val, index) => {
                doc.text(index + 1 + "- " + val, 10, y); // 2nd args : x position; 3rd args : y position
                y += 10;
            });
            doc.save("ordonnance.pdf");
        },
        remove(id, index) {
            const response = this.removePrescription(id);
            response
                .then(result => {
                    // remove row
                    this.prescriptions.splice(index, 1);
                    Vue.toasted.success("Ordonnance supprimée.");
                })
                .catch(err => {
                    Vue.toasted.error(err);
                });
        },
        removePrescription(id) {
            return axios.delete(`/patients/prescription/${id}`);
        },
        splitMedics(meds) {
            return meds.split(",");
        }
    },
    computed: {
        rows() {
            return this.prescriptions.length;
        }
    },
    watch: {},
    mounted() {
        this.fetchPrescriptions();
    }
};
</script>

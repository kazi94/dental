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
                    <template v-slot:cell(Imprimer)="">
                    </template>
                    <template v-slot:cell(Supprimer)="">
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
                "index",
                { key: "date_prescription", sortable: true },
                { key: "prenom", sortable: true },
                { key: "age", label: "Age", sortable: true },
                { key: "num_tel", label: "Téléphone" },
                "Imprimer",
                "Supprimer"
            ],
            prescriptions: []
        };
    },
    methods: {
        getPrescription(prescription){
            this.prescriptions.push(prescription);
        }
    },
    computed: {
        rows() {
            return this.prescriptions.length;
        }
    },
    watch: {},
    mounted() {}
};
</script>

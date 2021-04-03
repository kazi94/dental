<template>
    <div>
        <b-row>
            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Filtrer"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="filterInput"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="taper pour rechercher"
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''"
                                >Annuler</b-button
                            >
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Filtres"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    description="déselectionner tout les filtres pour afficher tout les patients"
                    class="mb-0"
                >
                    <b-form-checkbox-group v-model="filterOn" class="mt-1">
                        <b-form-checkbox value="nom">Nom</b-form-checkbox>
                        <b-form-checkbox value="prenom">Age</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
        </b-row>
        <b-table
            striped
            hover
            :items="patients"
            :fields="fields"
            foot-clone
            responsive="sm"
            :per-page="perPage"
            :current-page="currentPage"
            :busy.sync="isBusy"
            :filter="filter"
            :filterIncludedFields="filterOn"
            @filtered="onFiltered"
        >
            <template v-slot:cell(index)="data">{{ data.index + 1 }}</template>
            <template v-slot:cell(actions)="data">
                <b-dropdown
                    right
                    text="Actions"
                    variant="outline-dark rounded-0"
                >
                    <b-dropdown-item :href="`/patients/${data.item.id}/edit`"
                        >Voir le patient</b-dropdown-item
                    >
                    <b-dropdown-item
                        @click="removePatient(data.index, data.item.id)"
                        >Supprimer</b-dropdown-item
                    >
                </b-dropdown>
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
</template>

<script>
export default {
    data() {
        return {
            fields: [
                "index",
                { key: "nom", sortable: true },
                { key: "prenom", sortable: true },
                { key: "age", label: "Age", sortable: true },
                { key: "num_tel", label: "Téléphone" },
                "actions"
            ],
            patients: [],
            boxOne: "",
            perPage: 10,
            currentPage: 1,
            isBusy: false,
            filter: null,
            filterOn: []
        };
    },
    methods: {
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        showSelectedPatient: function(patient, modal = false) {
            if ((modal = "true")) $("#liste_patients_modal").modal("hide");
            this.activeClass = patient.id;
            console.log(patient);
            axios.get("/patients/" + patient.id).then(response => {
                this.response = response.data;

                this.$emit("patient-folder", this.response);
            });
        },
        //remove removePatient
        removePatient(index, id) {
            this.boxOne = "";
            this.$bvModal
                .msgBoxConfirm("Voulez vous supprimer le patient?", {
                    title: "Confirmer la suppresion",
                    size: "sm",
                    buttonSize: "sm",
                    okVariant: "success",
                    okTitle: "Oui",
                    cancelTitle: "Non",
                    footerClass: "p-2",
                    hideHeaderClose: false,
                    centered: true
                })
                .then(value => {
                    if (this.boxOne == true)
                        axios
                            .delete("/patients/" + id)
                            .then(response => {
                                this.patients.splice(index, 1);
                                this.$toaster.success(response.data.success);
                            })
                            .catch(exception => {
                                this.$toaster.error(exception);
                            });
                })
                .catch(err => {
                    console.log(err);
                });
        },
        fetchPatients() {
            this.isBusy = true;
            // on mounted page, display all patients
            axios.get("/api/patients").then(response => {
                this.patients = response.data;
                this.isBusy = false;
            });
        }
    },
    computed: {
        rows() {
            return this.patients.length;
        }
    },
    mounted() {
        this.fetchPatients();
    }
};
</script>

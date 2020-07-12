<template>
    <div>
        <div class="row mb-1">
            <div class="col-sm-9 h5">Ordonnances type</div>
            <div class="col-sm-3">
                <button
                    class="btn btn-primary mt-1 mb-1 rounded-0 pull-right"
                    @click="showModal"
                >
                    Ajouter
                </button>
            </div>
        </div>

        <!-- <table class="mb-0 table">
      <thead>
        <tr>
          <td>#</td>
          <th>Ordonnance</th>
          <th>Médicaments</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(val,index) in ordonnances">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ val.nom }}</td>
          <td>{{ val.imploded }}</td>
          <td>
            <button
              class="btn btn-danger btn-icon btn-icon-only mr-2 rounded-0"
              @click="removeOrdonnance(val.id,index)"
              title="Supprimer"
            >
              <i class="pe-7s-trash btn-icon-wrapper"></i>
            </button>
            <button
              class="btn btn-primary btn-icon btn-icon-only mr-2 rounded-0"
              @click="update(val)"
              title="Modifier"
            >
              <i class="pe-7s-edit btn-icon-wrapper"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>-->
        <div
            class="modal fade"
            tabindex="-1"
            id="ordonnance_modal"
            role="dialog"
            aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editMode">
                            Nouvelle Ordonnance type
                        </h5>
                        <h5 class="modal-title" v-else>
                            Modifier Ordonnance type
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-7">
                                <!-- Formulaire  -->
                                <b-form>
                                    <b-form-group
                                        label="Nom:"
                                        label-for="input-1"
                                        class="font-weight-bold"
                                    >
                                        <b-form-input
                                            class="rounded-0"
                                            id="input-1"
                                            v-model="ordonnance.nom"
                                            type="text"
                                            placeholder="Donnez un nom à l'odonnance type"
                                        ></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                        label="Médicament:"
                                        :description="medicament.medicament"
                                        label-for="input-2"
                                        class="font-weight-bold"
                                    >
                                        <autocomplete
                                            ref="autocomplete"
                                            placeholder="Renseigner un médicament"
                                            :source="search"
                                            input-class="form-control rounded-0"
                                            results-property="data"
                                            :results-display="formattedDisplay"
                                            resultsValue="id"
                                            @selected="addDistributionGroup"
                                        ></autocomplete>
                                    </b-form-group>
                                    <b-form-group
                                        label="Nombre de prises:"
                                        label-for="input-3"
                                        class="font-weight-bold"
                                    >
                                        <b-form-input
                                            class="rounded-0"
                                            id="input-3"
                                            v-model="medicament.nb_prise"
                                            type="number"
                                            placeholder="Ex : 2"
                                        ></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                        label="Pendant:"
                                        label-for="input-4"
                                        class="font-weight-bold"
                                    >
                                        <b-form-input
                                            class="rounded-0"
                                            id="input-4"
                                            v-model="medicament.frequence"
                                            type="number"
                                            placeholder="Ex : 10"
                                        ></b-form-input>
                                    </b-form-group>

                                    <div>
                                        <b-form-textarea
                                            class="rounded-0"
                                            v-model="medicament.preview"
                                            placeholder="Ici l'affichage de l'odonnance...."
                                            rows="3"
                                            max-rows="6"
                                        ></b-form-textarea>
                                    </div>
                                    <div class="float-right mt-2">
                                        <input
                                            type="button"
                                            value="Ajouter"
                                            class="btn btn-primary rounded-0"
                                            @click="addToList"
                                            v-if="!editMode"
                                        />
                                    </div>
                                </b-form>
                            </div>

                            <div class="col-xs-12 col-sm-5">
                                <!-- Liste des médicaments -->
                                <b-list-group>
                                    <b-list-group-item
                                        v-for="(val,
                                        index) in ordonnance.medicaments"
                                        :key="index"
                                        v-if="ordonnance.medicaments.length > 0"
                                        class="rounded-0"
                                    >
                                        {{ val.preview }}
                                        <input
                                            class="btn btn-sm btn-success rounded-0  update"
                                            type="button"
                                            value="Modifier"
                                            @click="updateItem(index)"
                                        />
                                        <input
                                            class="btn btn-sm btn-danger rounded-0  delete"
                                            type="button"
                                            value="Supprimer"
                                            @click="removeItem(index)"
                                        />
                                    </b-list-group-item>

                                    <div
                                        class="alert alert-info d-flex justify-content-center"
                                        v-else
                                    >
                                        Aucun médicament ajouté
                                    </div>
                                </b-list-group>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="reset"
                            class="btn btn-secondary rounded-0"
                            data-dismiss="modal"
                        >
                            Fermer
                        </button>
                        <input
                            type="submit"
                            value="Valider"
                            class="btn btn-success rounded-0"
                            v-if="!editMode"
                        />
                        <input
                            type="submit"
                            value="Modifier"
                            class="btn btn-success rounded-0"
                            v-else
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Autocomplete from "vuejs-auto-complete";
export default {
    components: {
        Autocomplete
    },
    props: [],
    data() {
        return {
            editMode: false,
            ordonnances: [],
            medicament: {
                medicament: null,
                medicament_id: null,
                forme: null,
                nb_prise: null,
                frequence: null,
                preview: null
            },
            id: "",
            ordonnance: {
                nom: "Ordonnance sans nom",
                medicaments: []
            }
        };
    },
    watch: {
        medicament: {
            handler(newVal) {
                if (Object.keys(this.medicament).length === 0) return 0;
                return (this.medicament.preview = ` ${this.medicament.medicament} qsp (pendant ${this.medicament.frequence} jours). ${this.medicament.nb_prise} ${this.medicament.forme}/jour `);
            },
            deep: true
        }
    },
    methods: {
        search(input) {
            return "/medicament/" + input;
        },

        addDistributionGroup(medicament) {
            this.medicament.medicament = medicament.display.toLowerCase(); // Doliprane 500mg....
            this.medicament.medicament_id =
                medicament.selectedObject.sp_code_sq_pk; // 152
            this.medicament.forme = medicament.selectedObject.unite_nom.toLowerCase();

            // access the autocomplete component methods from the parent
            //this.$refs.autocomplete.clear();
        },

        formattedDisplay(result) {
            return result.sp_nom;
        },
        // remove medicament from table
        removeItem(event, index) {
            this.ordonnance.medicaments.splice(index, 1);
        },
        updateItem(event, index) {
            this.medicament = this.ordonnance.medicaments[index];
        },
        showModal() {
            //   this.form.reset();
            $("#ordonnance_modal")
                .appendTo("body")
                .modal("show");
        },
        addToList() {
            this.ordonnance.medicaments.push({
                medicament: this.medicament.medicament,
                medicament_id: this.medicament.medicament_id,
                forme: this.medicament.forme,
                nb_prise: this.medicament.nb_prise,
                frequence: this.medicament.frequence,
                preview: this.medicament.preview
            });

            // Reset Forms
            this.onReset();
        },
        onReset() {
            this.medicament.medicament = "";
            this.medicament.medicament_id = "";
            this.medicament.frequence = "";
            this.medicament.nb_prise = "";
            this.medicament.preview = "";
        },
        onSubmit() {
            // Sent Ordonnance to the Server
            const data = this.ordonnance;

            axios
                .post("/admin/ordonnance-type", data) // Send Ordonnance to server
                .then(response => {
                    //add Ordonnance to list
                    this.ordonnances.push(response.data);

                    //Reset Forms
                    this.medicaments = [];
                    $("#ordonnance_modal").modal("hide");

                    this.$toaster.success("Ordonnance ajoutée !");
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },
        removeOrdonnance(id, index) {
            axios
                .delete("/admin/ordonnance-type/" + id)
                .then(response => {
                    this.ordonnances.splice(index, 1);
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },

        update(ordonnance) {
            this.nom = ordonnance.nom;
            this.id = ordonnance.id;
            this.medicaments = ordonnance.medicaments;
            this.editMode = true;
            //   this.form.reset();
            $("#ordonnance_modal")
                .appendTo("body")
                .modal("show");
        },

        updateOrdonnaceType() {
            if ((this.medicaments = []))
                alert("Vous devez renseigner au moin un médicament");
            else {
                let ordo = this.ordonnances;
                this.form.fill({
                    medicaments: this.medicaments,
                    nom: this.nom
                });
                axios
                    .put("/admin/ordonnance-type/" + this.id, this.form)
                    .then(response => {
                        $.each(ordo, (index, val) => {
                            if (val.id == response.data.id)
                                ordo[index] = response.data;
                        });
                        $("#ordonnance_modal").modal("hide");
                        this.form.reset();
                        this.medicaments = [];
                        this.editMode = false;
                    })
                    .catch(exception => {
                        this.$toaster.error(exception);
                    });
            }
        }
    },
    computed: {},
    mounted() {
        console.log("ordonnances Component mounted");

        axios
            .get("/admin/ordonnance-type")
            .then(response => {
                this.ordonnances = response.data;
            })
            .catch(exception => {
                this.$toaster.error(exception);
            });
    }
};
</script>

<style scoped>
.list-group-item input {
    position: absolute;
    display: none;
}

.list-group-item input.update {
    top: 25%;
    left: 55%;
}
.list-group-item input.delete {
    top: 25%;
    left: 35%;
}
.list-group-item:hover {
    background-color: rgba(0, 0, 0, 0.1803921568627451);
}
.list-group-item:hover input {
    display: block;
}
</style>

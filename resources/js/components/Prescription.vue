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
            <b-form-select v-model="selected" :options="ordonnances_type" class="col-sm-10"></b-form-select>
          </b-form-group>
          <b-form-group label="Médicaments">
            <b-form-checkbox-group
              v-model="selectedMeds"
              :options="medics"
              name="flavour-2a"
              stacked
            ></b-form-checkbox-group>
          </b-form-group>
        </b-form>
      </div>
      <template v-slot:modal-footer="{ ok, cancel }">
        <!-- Emulate built in modal footer ok and cancel button actions -->
        <b-button size="sm" squared variant="secondary" @click="onReset()">Annuler</b-button>
        <b-button size="sm" squared variant="primary" @click="onSubmit()">
          <b-icon icon="cloud-download" variant="white" class="mr-1"></b-icon>Imprimer
        </b-button>
      </template>
    </b-modal>
    <!-- <div class="card-header">
            <h5 class="card-title">Prescriptions</h5>
    </div>-->

    <!-- <div class="card-body"> -->
    <!-- <div v-if="showprescriptions">
                <div class="table-responsive" >
                    <table class="mb-0 table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value,index) in patient.prescriptions">
                                <td>{{ index+1 }}</td>
                                <td>{{ value.date_prescription }}</td>
                                <td>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger rounded-0" data-toggle="tooltip" data-placement="bottom" title="Supprimer la prescription" @click="removePrescription(index, value.id)"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                    <a :href="'/patient/prescription/'+value.id+'/print'" target="_blank"><button class="mr-2 btn-icon btn-icon-only btn btn-outline-secondary rounded-0" data-toggle="tooltip" data-placement="bottom" title="Imprimer la prescription"><i class="pe-7s-print btn-icon-wrapper"> </i></button></a>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-success rounded-0" @click="editPrescription(value.id)" title="Modifier la prescription"><i class="pe-7s-edit btn-icon-wrapper"> </i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary float-right mt-1 rounded-0" @click="showModal" v-show="showprescriptions">AJOUTER</button> 
            </div>

            <div v-else>
                <div class="alert alert-info">
                <i class="b badge-pill fa fa-info"></i>Aucune Prescription enregistrée.
                </div>
    </div>-->
    <!-- </div> -->

    <!-- <div
      class="modal fade"
      tabindex="-1"
      id="modal_prescription"
      role="dialog"
      aria-labelledby="myExtraLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <strong>Nouvelle Prescription</strong>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-3">
                  <div class="position-relative form-group">
                    <label for="medicament" class>Médicament</label>
                    <div class="input-group">
                      <autocomplete
                        ref="autocomplete"
                        placeholder="Renseigner un médicament"
                        :source="search"
                        input-class="form-control"
                        results-property="data"
                        :results-display="formattedDisplay"
                        @selected="addDistributionGroup"
                      ></autocomplete>
                      <div class="input-group-append">
                                            <button class="btn btn-success" @click="addToList">Ajouter</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-bordered table-sm mb-0 mt-1">
                    <thead>
                      <th>#</th>
                      <th>Médicament</th>
                      <th>Supprimer</th>
                    </thead>
                    <tbody>
                      <tr v-for="(val, index) in medicaments">
                        <td>{{ index+1 }}</td>
                        <td>{{ val.SP_NOM }}</td>
                        <td>
                          <button class="btn btn-sm btn-danger" @click="remove($event,index)">X</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">ANNULER</button>
              <button
                type="button"
                class="btn btn-secondary rounded-0"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Valider et imprimer la prescription"
                @click="printPrescription"
              >IMPRIMER</button>
              <button
                type="button"
                class="btn btn-success rounded-0"
                data-toggle="tooltip"
                data-placement="bottom"
                title="Valider la prescription"
                @click="printPrescription(false)"
              >VALIDER</button>
            </div>
          </form>
        </div>
      </div>
    </div>-->
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
    };
  },
  methods: {
    /*
     * Get the list of ordonnances type
     */
    fetchOrdonnancesType() {
      axios
        .get("/admin/ordonnance-type/get-ordonnances-type")
        .then((response) => {
          this.ordonnances_type = response.data;
        })
        .catch((exception) => {
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
        // create pdf file
        const doc = new jsPDF();
        let y = 10;
        this.selectedMeds.forEach((val, index) => {
          doc.text(index + 1 + "- " + val, 10, y); // 2nd args : x position; 3rd args : y position
          y += 10;
        });
        // download pdf file
        doc.save("ordonnance.pdf");
        // save prescription to db
        this.savePrescription();
        // close the modal
        this.onReset();
      } else alert("Veuillez sélectionner un médicament");
    },
    savePrescription() {
      let form = new FormData();
      form.set("medicaments", this.selectedMeds);
      form.set("patient_id", this.patient.id);
      // save the prescription into the db
      axios
        .post("/patient/prescription", form)
        .then((response) => {
          this.$toaster.success("Ordonnance ajoutée !");
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
  },
  watch: {
    /*
     * Show the list of medocs when ordonnance type is selected
     */
    selected: {
      handler: function (newV) {
        let vm = this;
        let selectedOrdonnance = newV; // Ex : 4 or 5 , 6 , {id}
        vm.ordonnances_type.forEach(function (value, index) {
          if (value.value === newV) vm.medics = value.medicaments; // show the list of medocs
        });
        vm.selectedMeds = vm.medics; // check all medics
      },
    },
  },
  mounted() {
    console.log("Prescriptions Component mounted");
    this.fetchOrdonnancesType();
  },
};
</script>

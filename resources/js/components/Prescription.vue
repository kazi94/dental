<template>
  <div>
    <a href="javascript:void(0);" class="nav-link" title="Ajouter une nouvelle ordonnance">
      <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
      Ordonnance
    </a>
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
import Autocomplete from "vuejs-auto-complete";
export default {
  props: ["patient", "showprescriptions"],
  components: {
    Autocomplete,
  },
  data() {
    return {
      medicaments: [],
      form: new Form({
        patient: "",
        medicaments: [],
      }),
      prescriptions: [],
      editMode: false,
      id: "",
    };
  },
  methods: {
    showModal() {
      // clear medicaments list
      this.medicaments = [];

      $("#modal_prescription").appendTo("body").modal("show");
    },

    // addToList(){
    //     this.medicaments.push(this.medicament);
    // },

    search(input) {
      return "/medicament/" + input;
    },

    addDistributionGroup(medicament) {
      this.medicaments.push(medicament.selectedObject);
      // access the autocomplete component methods from the parent
      this.$refs.autocomplete.clear();
    },

    formattedDisplay(result) {
      return result.SP_NOM;
    },

    // remove medicament from table
    remove(event, index) {
      this.medicaments.splice(index, 1);
      event.preventDefault();
    },

    // validate form and print prescription
    printPrescription(print = true, id = null) {
      this.form.fill({
        medicaments: this.medicaments,
        patient: this.patient.id,
      });

      // udpdate Prescription
      if (this.editMode)
        axios
          .put("/patient/prescription/" + this.id, this.form)
          .then((response) => {
            $("#modal_prescription").modal("hide");

            this.$toaster.success(response.data.success);

            this.form.reset();

            // clear medicaments list
            this.medicaments = [];
            //print Prescription
            if (print)
              openInNewTab(
                "/patient/prescription/" +
                  response.data.prescription.id +
                  "/print"
              );
          })
          .catch((exception) => {
            this.$toaster.error(exception);
          });
      else
        axios
          .post("/patient/prescription", this.form)
          .then((response) => {
            $("#modal_prescription").modal("hide");

            this.$toaster.success(response.data.success);

            this.form.reset();

            this.patient.prescriptions.push(response.data.prescription);

            //print Prescription
            if (print)
              openInNewTab(
                "/patient/prescription/" +
                  response.data.prescription.id +
                  "/print"
              );
          })
          .catch((exception) => {
            this.$toaster.error(exception);
          });
    },

    //remove Prescription
    removePrescription(index, id) {
      axios
        .delete("/patient/prescription/" + id)
        .then((response) => {
          this.patient.prescriptions.splice(index, 1);
          this.$toaster.success(response.data.success);
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },

    editPrescription(id) {
      let vm = this;
      this.medicaments = [];
      this.editMode = true;
      this.id = id;

      axios
        .get("/patient/prescription/" + id)
        .then((response) => {
          console.log(response.data.lignes);
          $.each(response.data.lignes, function (key, value) {
            // vm.medicaments.push(value);
            vm.medicaments.push({
              SP_CODE_SQ_PK: value.medicament_id,
              SP_NOM: value.medicament,
            });
          });

          $("#modal_prescription").appendTo("body").modal("show");
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
  },
  computed: {},
  mounted() {
    console.log("Prescriptions Component mounted");
  },
};

function openInNewTab(url) {
  var win = window.open(url, "_blank");
  win.focus();
}
</script>

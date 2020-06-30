<template>
  <div>
    <div class="row border-bottom border-alternate mb-2">
      <schema-component
        :selectedTooth="selectedTooth"
        :isToothVisible="isToothVisible"
        ref="schema"
        :p_class="!isAcceptable ? 'mb-2' : ''"
      ></schema-component>

      <div class="col-md-4" v-show="isActVisible">
        <category ref="categories"></category>

        <b-button size="sm" variant="success" class="btn-block" squared @click="save">Ajouter</b-button>
      </div>
    </div>

    <div>
      <div class="row">
        <div class="col-sm-12">
          <div
            class="btn-group btn-breadcrumb mb-2 d-sm-flex"
            v-if="this.quotation.length > 0 || !isAcceptable"
          >
            <span
              v-for="(quotState, index) in quotStates"
              :key="index"
              class="btn rounded-0"
              :class="[
                                quotState.state ? 'btn-success' : 'btn-info'
                            ]"
            >{{ quotState.name }}</span>
          </div>

          <div v-if="this.quotation.length > 0">
            <b-table
              ref="selectableTable"
              selectable
              select-mode="multi"
              @row-selected="onRowSelected"
              :items="quotation"
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
                                        data.item.prix = parseInt(
                                            $event.target.value
                                        );
                                        edit = false;
                                    "
                />
                <p v-else @click="edit = true">
                  <b class="text-info">
                    {{
                    data.item.prix
                    }}
                  </b>
                </p>
              </template>

              <template v-slot:cell(selected)="{ rowSelected }">
                <template v-if="rowSelected">
                  <span aria-hidden="true">&check;</span>
                  <span class="sr-only">Selected</span>
                </template>
                <template v-else>
                  <span aria-hidden="true">&nbsp;</span>
                  <span class="sr-only">Not selected</span>
                </template>
              </template>
            </b-table>
          </div>

          <div v-if="!isAcceptable">
            <b-table
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
              <template v-slot:cell(act)="data">
                {{
                data.value.nom
                }}
              </template>
              <template v-slot:cell(state)="data">
                <!-- data = acceptedQuotation -->
                <b-badge
                  pill
                  v-if="data.item.state == 'En cours'"
                  variant="secondary"
                  @click="handleState(data.item)"
                  style="cursor:pointer"
                >{{ data.item.state }}</b-badge>
                <b-badge
                  pill
                  v-else
                  variant="success"
                  @click="handleState(data.item)"
                  style="cursor:pointer"
                >{{ data.item.state }}</b-badge>
              </template>
            </b-table>
          </div>
        </div>
      </div>

      <b-row>
        <b-col sm="9" v-if="this.quotation.length > 0">
          <p>
            <b-button
              size="sm"
              squared
              @click="this.$refs.quotationTable.selectAllRows"
            >Tout selectionner</b-button>
            <b-button
              size="sm"
              squared
              @click="this.$refs.quotationTable.clearSelected"
            >Vider la selection</b-button>
          </p>
        </b-col>
        <b-col
          sm="3"
          :class="{ 'offset-9': !isAcceptable }"
          v-if="this.quotation.length > 0 || !isAcceptable"
        >
          <p class="text-center font-weight-bold alert-success">
            Remise :
            <span>{{ remise }} DA</span>
          </p>
          <p class="text-center font-weight-bold alert-dark" v-show="isAcceptable">
            Total :
            <span>{{ total }} DA</span>
          </p>
          <p class="text-center font-weight-bold alert-dark" v-show="!isAcceptable">
            Total :
            <span>{{ display_total }} DA</span>
          </p>
          <p class="text-center font-weight-bold alert-info border-bottom border-alternate">
            Total accepté :
            <span>{{ total_accept }} DA</span>
          </p>
          <b-button
            size="sm"
            squared
            :disabled="paidBtnDisabled"
            v-show="isAcceptable"
            class="float-right"
            variant="success"
            @click="acceptQuotation"
          >Accepter</b-button>
          <b-button
            size="sm"
            squared
            :disabled="paidBtnDisabled"
            class="float-right"
            variant="primary"
            v-b-modal.cach-modal
          >Versement</b-button>
          <b-button
            size="sm"
            squared
            v-show="!isAcceptable"
            class="float-right"
            variant="light"
          >Imprimer</b-button>
        </b-col>
      </b-row>

      <b-modal
        id="cach-modal"
        ref="modal"
        title="Encaisser"
        no-fade
        @show="resetModal"
        @hidden="resetModal"
        @ok="!isAcceptable ? validatePayement : validateCach"
      >
        <form ref="form">
          <b-form-group
            :state="nameState"
            label="Total encaissé"
            description="Une somme inférieur au total est valide."
            label-for="name-input"
            invalid-feedback="Name is required"
          >
            <b-form-input id="name-input" v-model="total_paid" :state="nameState" required></b-form-input>
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
export default {
  components: {
    SchemaComponent,
    Category,
    QuotationTable
  },

  props: ["patient"],
  data() {
    return {
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

      quotation: [],
      acceptedQuotation: [],
      oldQuotation: [],
      isAcceptable: true,
      id: "",

      remise: 0,
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
      edit: false
    };
  },
  methods: {
    onRowSelected(items) {
      this.selected = items;
    },
    selectAllRows() {
      this.$refs.selectableTable.selectAllRows();
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected();
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
    validateCach(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      // Create Form
      let form = this.createForm("onDay");
      // Send data to the server
      axios
        .post("/patient/devis", form)
        .then(response => {
          // empty table
          this.quotation = [];
          // empty selected rows
          this.$refs.quotationTable.selected = [];
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
    createForm(rhythmTraitement = null) {
      let form = new FormData();
      form.set(
        "selectedLignes",
        JSON.stringify(this.$refs.quotationTable.selected)
      );
      form.set("quotation", JSON.stringify(this.quotation));
      form.set("discount", this.remise);
      form.set("total", this.total);
      form.set("total_accept", this.total_accept);
      form.set("total_paid", this.total_paid);
      form.set("rhythmTraitement", rhythmTraitement);
      form.set("patient_id", this.patient.id);
      return form;
    },

    save() {
      // Add selected tooth and acts to quotation table
      // For each selected teeth, bind with acts and create Quotation object
      $.each(this.selectedTooth, (index, el) => {
        // For each selected acts , Create new Quotation Row
        $.each(this.$refs.categories.selectedActs, (i, e) => {
          this.quotation.push({
            act_id: e.id,
            num_dent: el,
            acte: e.nom,
            prix: e.price
          });
        });

        //this.createShapes(el , coords , context);
      });

      // Uncheck the Selected Acts
      this.$refs.categories.selectedActs = [];

      // Deselect Selected tooth
      this.selectedTooth = [];
      this.$refs.schema.num_tooth.map(e => (e.state = false));

      // sauvegarder la version orginal du devis
      this.oldQuotation = this.quotation;
    },
    createShapes(dent, coords, context) {},
    acceptQuotation() {
      // Store Quotation into database
      // Create form data
      let form = this.createForm();
      // Send data to the server
      axios
        .post("/patient/devis", form)
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
      this.acceptedQuotation = this.selected;
      this.quotation = [];
      // Return created quotation rows to display in accepted quotation
      this.acceptedQuotation = response.data;

      // empty selected rows
      this.selected = [];
      this.clearSelected();

      // Hide accept btn  && Add print btn
      this.isAcceptable = false;
      // Hide Acts
      this.isActVisible = false;
      // Hide tooth btn
      this.isToothVisible = false;

      //reset total accept
      this.total_accept = 0;
      // TODO : Display discount
    },
    handleState(row) {
      row.state = row.state == "En cours" ? "Fait" : "En cours";

      // Calculé la somme total faite
      if (row.state == "Fait") this.total_accept += row.price;
      else this.total_accept -= row.price;

      this.total_paid = this.total_accept;

      // * Enable payement button
      this.paidBtnDisabled = this.total_paid != 0 ? false : true;
    },
    validatePayement() {
      let total_paid = this.total_paid;
      let lignes_devis = this.acceptedQuotation;
      let form = new Form();
      form.set("acceptedQuotation", lignes_devis);
      form.set("total_paid", total_paid);
      axios
        .post("/patient/devis/update_devis", form)
        .then(response => {
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
    }
  },

  watch: {
    selected: {
      handler: function(newVal) {
        this.total_accept = 0;

        this.paidBtnDisabled = this.selected.length != 0 ? false : true;

        $.each(newVal, (i, e) => (this.total_accept += parseInt(e.prix)));
      },
      deep: true
    }
  },
  computed: {
    // Calcul de la valeur total du devis
    // Lorsque les ligne du devis changent , la valeur est recalculé en fct du nouveau devis
    total: function() {
      let total = 0;
      this.quotation.forEach(myfunction);

      function myfunction(value) {
        total += parseInt(value.prix);
      }

      return total;
    }
  },
  mounted() {
    // If Quotation in Progress
    //  Display the Dental Schema, with the tooth updated
    //  Display the current quotation of the patient in the table with the current state of each acts
    //  Display the versement btn
    //  Display the print btn
    // Else
    //  Display acts by category
    //  Display dental schema
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

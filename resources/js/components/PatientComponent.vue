<template>
  <form
    class="needs-validation"
    novalidate
    @submit.prevent="editMode ? updatePatient()  : createPatient()"
    enctype="multipart/form-data"
  >
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <div class="main-card mb-3 card">
            <div class="card-body">
              <h5 class="card-title">Informations Personnels</h5>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">Nom</label>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nom') }"
                    id="validationCustom01"
                    placeholder="Nom"
                    required="true"
                    name="nom"
                    v-model="form.nom"
                  />
                  <has-error :form="form" field="nom"></has-error>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">Prénom</label>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('prenom') }"
                    id="validationCustom02"
                    placeholder="Prénom"
                    required="true"
                    name="prenom"
                    v-model="form.prenom"
                  />
                  <has-error :form="form" field="prenom"></has-error>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustomUsername">Date de Naissance</label>
                  <div class="input-group">
                    <input
                      type="date"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('date_naissance') }"
                      i
                      d="validationCustomUsername"
                      placeholder="Date de Naissance"
                      required
                      name="date_naissance"
                      v-model="form.date_naissance"
                    />
                    <has-error :form="form" field="date_naissance"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom03">Profession</label>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('profession') }"
                    id="validationCustom03"
                    placeholder="Profession"
                    required
                    name="profession"
                    v-model="form.profession"
                  />
                  <div class="invalid-feedback">Please provide a valid city.</div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom04">Adresse Physique</label>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('adresse') }"
                    id="validationCustom04"
                    placeholder="Adresse Physique"
                    required
                    name="adresse"
                    v-model="form.adresse"
                  />
                  <div class="invalid-feedback">Please provide a valid state.</div>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="validationCustom04">Sexe</label>
                  <div class="position-relative form-group">
                    <fieldset>
                      <div>
                        <div class="custom-radio custom-control">
                          <input
                            type="radio"
                            id="sexe"
                            name="sexe"
                            class="custom-control-input"
                            v-model="form.sexe"
                            value="M"
                          />
                          <label class="custom-control-label" for="sexe">HOMME</label>
                        </div>
                        <div class="custom-radio custom-control">
                          <input
                            type="radio"
                            id="sexe2"
                            name="sexe"
                            class="custom-control-input"
                            v-model="form.sexe"
                            value="F"
                            checked="checked"
                          />
                          <label class="custom-control-label" for="sexe2">FEMME</label>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="main-card mb-3 card">
            <div class="card-body">
              <h5 class="card-title">Informations médicales</h5>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="validationCustom04">Fumeur</label>
                  <div class="position-relative form-group">
                    <fieldset>
                      <div>
                        <div class="custom-radio custom-control">
                          <input
                            type="radio"
                            id="exampleCustomRadio"
                            name="fumeur"
                            class="custom-control-input"
                            value="Oui"
                            v-model="form.fumeur"
                          />
                          <label class="custom-control-label" for="exampleCustomRadio">OUI</label>
                        </div>
                        <div class="custom-radio custom-control">
                          <input
                            type="radio"
                            id="exampleCustomRadio2"
                            name="fumeur"
                            class="custom-control-input"
                            value="Non"
                            v-model="form.fumeur"
                            checked="checked"
                          />
                          <label class="custom-control-label" for="exampleCustomRadio2">NON</label>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="validationCustom02">Chirurgien référent</label>
                  <input
                    type="text"
                    v-model="form.medecin_externe"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('medecin_externe') }"
                    placeholder="Chirurgien référent"
                    required
                  />
                  <div class="valid-feedback">Très bien !</div>
                </div>

                <div class="col-md-12 mb-3">
                  <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class>Pathologies</label>
                    <multiselect
                      v-model="form.pathologies"
                      :options="pathologies"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="true"
                      placeholder="Choisir la ou les pathologies"
                      label="pathologie"
                      track-by="id"
                      :preselect-first="false"
                    >
                      <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span
                          class="multiselect__single"
                          v-if="values.length &amp;&amp; !isOpen"
                        >{{ values.length }} options selected</span>
                      </template>
                    </multiselect>
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <div class="position-relative form-group">
                    <label for="exampleCustomSelect" class>Antécédents Stomatologiques</label>
                    <multiselect
                      v-model="form.antecedents"
                      :options="antecedents"
                      :multiple="true"
                      :close-on-select="false"
                      :clear-on-select="false"
                      :preserve-search="true"
                      placeholder="Choisir la ou les Antécédents Stomatologiques"
                      label="nom"
                      track-by="id"
                      :preselect-first="false"
                    >
                      <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span
                          class="multiselect__single"
                          v-if="values.length &amp;&amp; !isOpen"
                        >{{ values.length }} options selected</span>
                      </template>
                    </multiselect>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
      <input type="submit" value="AJOUTER" class="btn btn-primary" />
    </div>
  </form>
</template>

<script>
export default {
  props: {
    pathologies: {
      type: Array
    },
    antecedents: {
      type: Array
    }
  },
  data() {
    return {
      editMode: false,
      // Create a new form instance
      form: new Form({
        nom: "",
        prenom: "",
        date_naissance: "",
        profession: "",
        adresse: "",
        sexe: "",
        fumeur: "",
        medecin_externe: "",
        pathologies: [],
        antecedents: []
      })
    };
  },
  methods: {
    getValue(selectedOption, id) {
      this.form.pathologies.push(selectedOption.id);
    },
    createPatient() {
      var patient = this.form;
      console.log(patient);

      axios
        .post("/patient/", this.form)
        .then(response => {
          $("#patient_add_modal").modal("hide");
          this.$toaster.success(response.data.success);
          //Pass form data to parent

          this.$emit("generated-patient", response.data.patient);

          this.form.reset();
        })
        .catch(exception => {
          this.$toaster.error(exception);
        });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<template>
  <div>
    <a
      href="#"
      class="nav-link"
      v-b-modal.modal-rdv
      v-b-tooltip.hover.bottom="'Programmer un rendez-vous'"
    >
      <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
      Rendez-vous
    </a>
    <b-modal
      id="modal-rdv"
      ref="modal-rdv"
      title="Programmer un rendez-vous"
      no-fade
      button-size="sm"
      ok-title="Programmer"
      cancel-title="Annuler"
      @show="onReset"
      @hidden="onReset"
      @ok="onSubmit"
    >
      <template v-slot:modal-footer="{ ok, cancel }">
        <!-- Emulate built in modal footer ok and cancel button actions -->
        <b-button size="sm" squared variant="secondary" @click="onReset()">Annuler</b-button>
        <b-button size="sm" squared variant="primary" @click="onSubmit()">
          <b-icon icon="calendar3" variant="white" class="mr-1"></b-icon>Programmer
        </b-button>
      </template>
      <div>
        <b-form>
          <b-form-group
            id="input-group-rdv"
            label="Rendez-vous le:"
            label-for="input-rdv"
            class="font-weight-bold"
          >
            <b-form-input id="input-rdv" v-model="form.date_rdv" type="date" required></b-form-input>
          </b-form-group>
          <div class="d-flex form-group">
            <div class="col-xs-12 col-sm-6 col-md-6 p-0">
              <label for="de-sm" class="font-weight-bold">De :</label>
              <b-form-timepicker
                v-model="form.start_date"
                locale="fr"
                label-close-button="Fermer"
                label-no-time-selected="Selectionner l'heure du rendez-vous"
                :required="required"
                :hide-header="hide_header"
              ></b-form-timepicker>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
              <label for="a-sm" class="font-weight-bold">À :</label>
              <b-form-timepicker
                v-model="form.end_date"
                locale="fr"
                label-close-button="Fermer"
                label-no-time-selected="Selectionner l'heure du rendez-vous"
                :required="required"
                :hide-header="hide_header"
              ></b-form-timepicker>
            </div>
          </div>

          <b-form-group
            id="input-group-act"
            label="Prochain Acte à faire:"
            label-for="input-act"
            class="font-weight-bold"
          >
            <b-form-input id="input-act" v-model="form.text"></b-form-input>
          </b-form-group>
        </b-form>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    patient: {
      type: Object,
    },
  },
  data() {
    return {
      form: {
        text: "",
        start_date: "08:00:00",
        end_date: "08:30:00",
        patient_id: this.patient.id,
      },
      required: true,
      hide_header: true,
    };
  },
  methods: {
    onSubmit() {
      // Send data to the server
      const vm = this;
      axios
        .post("/patient/rendez-vous", this.form)
        .then((response) => {
          vm.$refs["modal-rdv"].hide();
          vm.$bvToast.toast(
            `rendez-vous programmer pour : ${vm.form.date_rdv} à ${vm.form.start_date}.`,
            {
              variant: "success",
              toaster: "b-toaster-bottom-center",
              solid: true,
            }
          );
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
    onReset() {
      // Reset our form values
      this.form.date_rdv = "";
      this.form.description = "";
    },
  },
};
</script>

<style lang="scss" scoped>
</style>

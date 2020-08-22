<template>
  <div>
    <div class="row">
      <div class="col-sm-8">
        <b-button
          v-for="(btn, idx) in num_tooth"
          :key="idx"
          :pressed.sync="btn.state"
          v-if="idx <= 15"
          variant="outline-success"
          class="mr-1 ml-1 mb-1"
          squared
          size="sm"
          :id="`${btn.num}`"
          @click="tooth(btn.num)"
        >
          {{ btn.num }}
          <b-popover :target="`${btn.num}`" triggers="hover" placement="auto">
            <template v-slot:title>Formules</template>
            <b-form-group>
              <b-form-checkbox-group
                v-model="selectedFormulas"
                :options="formulas"
                name="flavour-2a"
                stacked
              ></b-form-checkbox-group>
            </b-form-group>
          </b-popover>
        </b-button>

        <div style="position : relative">
          <canvas
            width="775"
            height="319"
            id="initial_schema_canvas"
            style="position: absolute; 
            left: 0px; top: 0px; 
            padding: 0px; 
            border: 0px;"
          ></canvas>
          <img src="/img/schema.png" id="schema-map" width="100%" usemap="#image-map" />
        </div>
        <!-- <map name="image-map">
          <area
            coords="358, 15, 378, 62, 383, 105, 388, 134, 387, 152, 355, 154, 342, 143, 348, 113, 352, 66, 354, 35"
            style="cursor : pointer; "
            href="#"
            shape="poly"
          />
        </map>-->
        <b-button
          v-for="(btm_btn, btm_idx) in num_tooth"
          :key="btm_idx"
          v-if="btm_idx > 15"
          :pressed.sync="btm_btn.state"
          variant="outline-success"
          class="mr-1 ml-1 mb-1 mt-1"
          squared
          size="sm"
          @click="tooth(btm_btn.num)"
          :id="`${btm_btn.num}`"
        >
          {{ btm_btn.num }}
          <b-popover :target="`${btm_btn.num}`" triggers="hover" placement="auto">
            <template v-slot:title>Formules</template>
            <b-form-group>
              <b-form-checkbox-group
                v-model="selectedFormulas"
                :options="formulas"
                name="flavour-2a"
                stacked
              ></b-form-checkbox-group>
            </b-form-group>
          </b-popover>
        </b-button>

        <!-- <div class="rounded-0">
          <b-button
            v-for="(btn, idx) in buttons"
            :key="idx"
            :pressed.sync="btn.state"
            squared
            size="sm"
          >{{ btn.nom }}</b-button>
           <b-button squared size="sm" :disabled="disabled" @click="reset()">Reset</b-button> 
           <b-button squared size="sm" @click="resetAll()">Reset all</b-button> 
          <b-button squared size="sm" variant="success" @click="save">Ajouter</b-button>
        </div>-->
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: ["patient"],
  data() {
    return {
      formulas: [
        { text: "Absente", value: "abs" },
        { text: "Obturer", value: "obt" },
        { text: "Racines résiduelles", value: "rac-resid" },
        { text: "Fracture radiculaire", value: "frac-rad" },
        { text: "Fracture coronaire", value: "frac-cor" },
        { text: "Carie-G", value: "carie-g" },
        { text: "Carie-D", value: "carie-d" },
      ],
      selectedFormulas: [],
      buttons: [
        { caption: "abs", nom: "Absente", state: false },
        { caption: "obt", nom: "Obturer", state: false },
        {
          caption: "rac-resid",
          nom: "Racines résiduelles",
          state: false,
        },
        {
          caption: "frac-rad",
          nom: "Fracture radiculaire",
          state: false,
        },
        {
          caption: "frac-cor",
          nom: "Fracture coronaire",
          state: false,
        },
        { caption: "carie-p", nom: "P", state: false },
        { caption: "carie-m", nom: "M", state: false },
        { caption: "carie-d", nom: "D", state: false },
      ],
      num_tooth: [
        { num: 18, state: false },
        { num: 17, state: false },
        { num: 16, state: false },
        { num: 15, state: false },
        { num: 14, state: false },
        { num: 13, state: false },
        { num: 12, state: false },
        { num: 11, state: false },
        { num: 21, state: false },
        { num: 22, state: false },
        { num: 23, state: false },
        { num: 24, state: false },
        { num: 25, state: false },
        { num: 26, state: false },
        { num: 27, state: false },
        { num: 28, state: false },
        { num: 48, state: false },
        { num: 47, state: false },
        { num: 46, state: false },
        { num: 45, state: false },
        { num: 44, state: false },
        { num: 43, state: false },
        { num: 42, state: false },
        { num: 41, state: false },
        { num: 31, state: false },
        { num: 32, state: false },
        { num: 33, state: false },
        { num: 34, state: false },
        { num: 35, state: false },
        { num: 36, state: false },
        { num: 37, state: false },
        { num: 38, state: false },
      ],
      selectedTooth: new Array(),
      schema_id: "",
      formData: [],
      form: new Form(),
      disabled: true,
      selectedTeeth: "",
      checkedTooth: [],
    };
  },
  methods: {
    removeTooth(toothToDelete) {
      // remove selected tooth from DB
      axios
        .delete("/patient/schema-dentaire/remove_tooth/" + toothToDelete)
        .then((response) => {
          // remove formulas from dental schema
          //
          // Deselect selected tooth
          this.resetTooth();
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
    reset() {
      this.removeTooth(this.selectedTooth);
    },
    resetAll() {
      let allTooth = this.num_tooth.map((t) => t.num);
      this.removeTooth(allTooth);
    },
    tooth: function (num) {
      let index = this.num_tooth.map((t) => t.num).indexOf(num);
      let state = this.num_tooth[index].state;
      if (state) this.selectedTooth.push(num);
      else this.selectedTooth.splice(this.selectedTooth.indexOf(num), 1);
    },
    sendToServer(formulas, tooth) {
      this.form = this.createFormData(formulas, tooth);

      axios
        .post("/patient/schema-dentaire", this.form)
        .then((response) => {
          // Set Schema ID
          this.schema_id = response.data;

          // Deselect all tooth
          this.resetTooth();

          // Deselect formulas buttons
          this.buttons.map((b) => (b.state = false));

          // Reset formData
          this.formData = [];
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
    save() {
      // get the num of selected teeth
      // get the selected formulas
      let selectedTooth = this.selectedTooth; // [5,41,3,6,9...]
      selectedFormulas = this.buttons.map((b) => (b.state ? b.caption : "")); // [frac,abs,carie...]

      if (this.selectedTooth.length > 0 && selectedFormulas.length > 0) {
        // if selected
        //TODO save into db
        //TODO get coords and color of the num tooth and formulas from the server
        // this.sendToServer(selectedFormulas, selectedTooth);
        //TODO format coords with the current media display :320px , 375,425,768,1024,1440,2560px
        //TODO draw shapes foreach selected tooth and formulas
        // add selected teeth and formulas to table
        // reset formulas and selected tooth
      } else
        this.$toaster.info(
          "Veuillez sélectionner au moin une dent et une formule !"
        );
    },
    resetTooth() {
      this.selectedTooth = [];
      this.num_tooth.map((t) => (t.state = false));
    },
    // Active the areas with their specefic formules
    manageFormule(formule) {
      //this.createFormData(formule);
      // if unchecked => render shapes of the selected tooth
      this.selectedTooth.forEach((t) => this.renderShapes(formule, t));

      // else remove shape of the selected tooth
    },
    createFormData: function (formulas, tooth) {
      // let formules = [];
      // formulas.forEach((e) => {
      //   tooth.forEach((e1) => {
      //     formules.push({
      //       nums_dent: e1,
      //       formule: e,
      //     });
      // });
    },
    renderShapes(formule, selectedTeeth) {
      var coord =
        "358,15,378,62,383,105,388,134,387,152,355,154,342,143,348,113,352,66,354,35";
      var coords = coord.split(",");
      var c = document.querySelector("#initial_schema_canvas");
      // $('#canvas').css('z-index' , '1');
      var context = c.getContext("2d"); /*.clearRect(0, 0, width, height);*/

      context.fillStyle = "red";
      context.beginPath();
      context.moveTo(coords[0], coords[1]);
      let len = coords.length;
      for (let i = 2; i < coords.length; i += 2) {
        context.lineTo(coords[i], coords[i + 1]);
      }
      context.lineTo(coords[0], coords[1]);
      context.closePath(); // On relie
      context.fill();
    },
  },
  watch: {
    selectedTooth: {
      handler: function (newVal) {
        let length = newVal.length;
        if (length > 0) {
          this.disabled = false;
        } else {
          this.disabled = true;
        }
      },
    },
    selectedFormulas: {
      handler: function (newVal) {
        if (this.checkedTooth.length > 0) {
          let index = this.checkedTooth.findIndex(
            (p) => p.teeth == this.selectedTeeth
          ); // o or -1
          if (index == -1 && this.selectedFormulas.length != 0) {
            // false
            this.checkedTooth.push({
              teeth: this.selectedTeeth,
              formulas: newVal,
            });
          } else {
            this.checkedTooth[index].formulas = newVal;
          }
        } else if (this.selectedFormulas.length != 0)
          this.checkedTooth.push({
            teeth: this.selectedTeeth,
            formulas: newVal,
          });

        console.log(newVal);
      },
    },
  },
  mounted() {
    this.$root.$on("bv::popover::show", (bvEventObj) => {
      this.selectedFormulas = [];
      this.selectedTeeth = bvEventObj.target.id;
      var formulas = this.checkedTooth.map((e) =>
        e.teeth == this.selectedTeeth ? e.formulas : []
      );
      if (formulas != "") this.selectedFormulas = formulas;
    });
    // Remplir le schema initiale via les data of ddb
    // loop under initial Traitement of Patient
    // set area activated with the given teeth number
    // $('#schema_map').mapster('set' , true , key, options);
  },
};
</script>

<style>
#btn-container {
  background-color: #e0e0e0;
  display: inline-block;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  width: 708px;
  margin-left: -3px;
}
.btn {
}
.list-number {
  list-style: none;
  margin-left: -39px;
  margin-top: 0;
  margin-bottom: 0;
}
.number {
  padding: 5px 0px;
  width: 40px;
  text-align: center;
  font-size: 0.75em;
  font-weight: 900;
  cursor: pointer;
  margin: 2.5px 2px;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.number:hover {
  border-radius: 3px;
  background-color: #ccc;
}

.selected {
  color: red;
}
</style>

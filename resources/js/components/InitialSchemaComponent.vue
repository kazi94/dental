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
          class="ml-2 mb-1 rounded-circle"
          style="margin-right : 0.5rem"
          size="sm"
          :id="`${btn.num}`"
          @click="tooth(btn.num)"
        >
          {{ btn.num }}
          <b-popover :target="`${btn.num}`" triggers="focus" placement="bottom">
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
          <!-- <canvas
            width="775"
            height="319"
            id="initial_schema_canvas"
            style="position: absolute; 
            left: 0px; top: 0px; 
            padding: 0px; 
            border: 0px;"
          ></canvas>-->
          <svg
            id="initial_schema_canvas"
            style="position: absolute; 
            left: 0px; top: 0px; 
            padding: 0px; 
            border: 0px;"
            xmlns="http://www.w3.org/2000/svg"
            version="1.1"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="775"
            height="314"
          /></svg>
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
          class="ml-1 mt-1 rounded-circle"
          style="margin-right : 0.7rem"
          size="sm"
          @click="tooth(btm_btn.num)"
          :id="`${btm_btn.num}`"
        >
          {{ btm_btn.num }}
          <b-popover :target="`${btm_btn.num}`" triggers="focus" placement="right">
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
import { SVG } from "@svgdotjs/svg.js";
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
    sendToServer(formulas, teeth) {
      let form = this.createFormData(formulas, teeth);

      axios
        .post("/patient/schema-dentaire", form)
        .then((response) => {
          // Set Schema ID
          this.schema_id = response.data.schema_id;

          // Create shapes
          this.createShapes(response.data.coords);
        })
        .catch((exception) => {
          this.$toaster.error(exception);
        });
    },
    resetTooth() {
      this.selectedTooth = [];
      this.num_tooth.map((t) => (t.state = false));
    },
    createFormData: function (formulas, teeth) {
      let formData = new FormData();
      formData.append("teeth", teeth);
      formData.append("formulas", formulas); //array
      formData.append("patient_id", this.patient.id);
      formData.append("schema_id", this.schema_id);
      formData.append("type", "initial");
      return formData;
    },
    createShapes(coords = []) {
      var draw = SVG('#initial_schema_canvas')
      draw.rect(100,100).animate().fill('#f03').move(100,100
      var c = document.querySelector("#initial_schema_canvas");
      var context = c.getContext("2d");
      context.clearRect(0, 0, 775, 319);
      coords.forEach((coord) => {
        let cords = coord.coord.split(",");
        context.fillStyle = coord.color;
        cords = this.convertCoord(cords); // array
        context.beginPath();
        context.moveTo(coords[0], coords[1]);
        let len = cords.length;
        for (let i = 2; i < cords.length; i += 2) {
          context.lineTo(cords[i], cords[i + 1]);
        }
        context.lineTo(cords[0], cords[1]);
        context.closePath(); // On relie
        context.fill();
      });
    },
    convertCoord(coord) {
      // '358,15,378,62,383,105,388,134,387,152,355,154,342,143,348,113,352,66,354,35'
      let mediaWidth = window.innerWidth;
      let ratioX = 1;
      let ratioY = 1;

      if (mediaWidth == 1024) {
        ratioX = 1.348122867;
        ratioY = 1.34812467;
      }
      if (mediaWidth == 768) {
        ratioX = 1.685671367;
        ratioY = 1.685743577;
      }
      if (mediaWidth == 320) {
        ratioX = 2.724137931;
        ratioY = 2.724306967;
      }
      // change value of coords coordinate with the size of the actual media : laptop,tablete,mobile
      let val = coord.map((c, i) =>
        i % 2 == 0 ? parseInt(c / ratioX) : parseInt(c / ratioY)
      );

      return val;
    },
    onShowPopover() {
      this.$root.$on("bv::popover::show", (bvEventObj) => {
        this.selectedFormulas = [];
        this.selectedTeeth = bvEventObj.target.id;

        // return the formulas of the hovered teeth
        for (let i = 0; i < this.checkedTooth.length; i++)
          if (this.checkedTooth[i].teeth == this.selectedTeeth) {
            this.selectedFormulas = this.checkedTooth[i].formulas;
            break;
          }
      });
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
          if (index == -1 && newVal.length != 0) {
            // false
            this.checkedTooth.push({
              teeth: this.selectedTeeth,
              formulas: newVal,
            });
            // here
            this.sendToServer(newVal, this.selectedTeeth);
          } else if (index != -1) {
            // the array of num teeth exist
            this.checkedTooth[index].formulas = newVal; // add the new selected formula
            // here
            // newVal = ['frac']; ['frac','carie']; ['frac', 'carie' , 'abs']
            // this.sendToServer(['frac'] , 22);
            // this.sendToServer(['frac','carie'] , 22);
            // this.sendToServer(['frac', 'carie' , 'abs']  , 22);
            this.sendToServer(newVal, this.selectedTeeth);
          }
        } else
          this.checkedTooth.push({
            teeth: this.selectedTeeth,
            formulas: newVal,
          });
      },
    },
  },
  mounted() {
    this.onShowPopover();
)
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

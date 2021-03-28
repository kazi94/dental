<template>
    <div>
        <div class="row">
            <div class="col-md-8">
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
                >
                    {{ btn.num }}
                    <!-- <b-popover
                        :target="`${btn.num}`"
                        triggers="focus"
                        placement="bottom"
                    >
                        <template v-slot:title>Etat initial</template>
                        <b-form-group>
                            <b-form-checkbox-group
                                v-model="selectedFormulas"
                                :options="formulas"
                                name="flavour-2a"
                                stacked
                            ></b-form-checkbox-group>
                        </b-form-group>
                    </b-popover> -->
                </b-button>

                <div style="position : relative">
                    <img
                        src="/img/schema.png"
                        id="schema-map"
                        ref="img"
                        width="100%"
                        usemap="#image-map"
                        
                    />
                    <svg
                        id="initial_schema_canvas"
                        style="position: absolute; 
                            left: 0px; top: 0px; 
                            padding: 0px; 
                            border: 0px;"
                        xmlns="http://www.w3.org/2000/svg"
                        version="1.1"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        ref="svj"
                    />
                </div>

                <b-button
                    v-for="(btm_btn, btm_idx) in num_tooth"
                    :key="btm_idx"
                    v-if="btm_idx > 15"
                    :pressed.sync="btm_btn.state"
                    variant="outline-success"
                    class="ml-1 mt-1 rounded-circle"
                    style="margin-right : 0.7rem"
                    size="sm"
                    :id="`${btm_btn.num}`"
                >
                    {{ btm_btn.num }}
                    <!-- <b-popover
                        :target="`${btm_btn.num}`"
                        triggers="focus"
                        placement="right"
                    >
                        <template v-slot:title>Formules</template>
                        <b-form-group>
                            <b-form-checkbox-group
                                v-model="selectedFormulas"
                                :options="formulas"
                                name="flavour-2a"
                                stacked
                            ></b-form-checkbox-group>
                        </b-form-group>
                    </b-popover> -->
                </b-button>
            </div>
            <div class="col-md-4">
                <h4>Etat initial</h4>
                <b-button
                    v-for="(btn, idx) in buttons"
                    :key="idx"
                    :pressed.sync="btn.state"
                    @click="sendToServer(btn.caption, btn.state)"
                    squared
                    size="lg"
                    class="mr-3 mb-3"
                    variant="outline-info"
                    >{{ btn.nom }}</b-button
                >
            </div>
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
            // formulas: [
            //     { text: "Absente (a)", value: "abs", title: "(a)" },
            //     { text: "Obturer (o)", value: "obt" },
            //     { text: "Dent mortifiée", value: "d-mortif" },
            //     { text: "Racines résiduelles", value: "rac-resid" },
            //     { text: "Fracture couronne (c)", value: "frac-cour" },
            //     { text: "Fracture racine (r)", value: "frac-rac" },
            //     { text: "Kyste", value: "kyste" },
            //     { text: "Abcès endo", value: "abc" },
            //     { text: "Courônne", value: "couronne" },
            //     { text: "Carie prof.", value: "carie-p" },
            //     { text: "Carie sup.", value: "carie-pp" },
            //     { text: "Carie-D", value: "carie-d" },
            //     { text: "Carie-M", value: "carie-m" }
            // ],
            selectedFormulas: [],
            buttons: [
                { caption: "abs", nom: "Absente (a)", state: false },
                { caption: "obt", nom: "Obturer (o)", state: false },
                { caption: "d-mortif", nom: "Dent mortifiée", state: false },
                { caption: "kyste", nom: "Kyste", state: false },
                { caption: "couronne", nom: "Courônne", state: false },
                { caption: "carie-p", nom: "Carie prof.", state: false },
                { caption: "carie-pp", nom: "Carie sup.", state: false },
                { caption: "carie-d", nom: "Carie-D", state: false },
                { caption: "carie-m", nom: "Carie-M", state: false },
                {
                    caption: "rac-resid",
                    nom: "Racines résiduelles",
                    state: false
                },
                {
                    caption: "frac-rac",
                    nom: "Fracture racine (r)",
                    state: false
                },
                {
                    caption: "frac-cour",
                    nom: "Fracture couronne (c)",
                    state: false
                }
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
                { num: 38, state: false }
            ],
            selectedTooth: new Array(),
            schema_id: "",
            formData: [],
            form: new Form(),
            disabled: true,
            selectedTeeth: "",
            checkedTooth: [],
            img: ""
        };
    },
    methods: {
        /**
         * Send list of selected tooth with the clikced formulas to the server
         * @param {String} formula - Caption of The clicked formula
         */
        sendToServer(formula, state) {
            // detach formula from seletected tooth if button is unchecked
            if (state == false) {
                this.detachFormula(formula);
            } else {
                // attach formula with the selected tooth
                this.attachFormula(formula);
            }
        },
        /**
         * attach formula to the selected tooth
         */
        attachFormula(formula) {
            let form = this.createFormData(formula, this.selectedTooth);
            // remove all the drawing shapes of the selected teeth before redraw new shapes
            this.removeShapes();

            axios
                .post("/patients/schema-dentaire", form)
                .then(response => {
                    var coords = response.data.coords;
                    // Set Schema ID
                    //this.schema_id = response.data.schema_id;

                    // Create shapes
                    this.selectedTooth.forEach(teeth => {
                        this.createShapes(coords, teeth);
                    });
                })
                .catch(exception => {
                    if (exception.response)
                        this.$toaster.error(exception.response.data);
                    else this.$toaster.error(exception);
                });
        },
        /**
         * Detach formula from the selected tooth
         */
        detachFormula(formula) {
            // Create a Form with formula and selected tooth
            let form = this.createFormData(formula, this.selectedTooth);
            // Send to Server
            axios
                .delete("/patients/schema-dentaire/" + this.schema_id, {
                    data: {
                        formula : formula,
                        tooth : JSON.stringify(this.selectedTooth)
                    }
                })
                .then(response => {
                    // Remove the shapes of formula and selected tooth
                    var shapes = document.getElementById("initial_schema_canvas").childNodes;
                    this.selectedTooth.forEach(teeth => {
                    for (let index = 0; index < shapes.length; index++) {
                        const points = shapes[index].getAttribute("teeth");
                        const title = shapes[index].getAttribute("title");
                        
                            if (points == teeth && title == formula){
                                // remove polygon node
                                shapes[index].remove();
                                if (title == "abs")
                                    index--;
                            }
                    }
                    });
                })
                .catch(exception => {});
        },
        /*
         * Retourner les coords pour une dent et son ensemble de formules
         */
        getCoords(formulas, teeth) {
            axios
                .get(
                    "/patients/schema-dentaire/get-coords/" +
                        teeth +
                        "&&formules=" +
                        formulas
                )
                .then(response => {
                    // Create shapes
                    this.createShapes(response.data, teeth);
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },
        /**
         * Remove Shapes of the selected teeth
         */
        removeShapes() {
            // find shape elements by teeth attribute
            var shapes = document.getElementById("initial_schema_canvas")
                .childNodes;
            for (let index = 0; index < shapes.length; index++) {
                const points = shapes[index].getAttribute("teeth");
                if (points == this.selectedTeeth)
                    // remove polygon node
                    shapes[index].remove();
            }
        },

        createFormData: function(formula, tooth) {
            let formData = new FormData();
            formData.append("tooth", JSON.stringify(tooth));
            formData.append("formula", formula); //array
            formData.append("patient_id", this.patient.id);
            formData.append("schema_id", this.schema_id);
            formData.append("type", "initial");
            return formData;
        },

        createShapes(coords = [], teeth) {
            let draw = SVG("#initial_schema_canvas");
            let polygonID;
            coords.forEach(c => {
                let convertTo = this.convertCoord(c.coord);
                if (c.formulas == "frac-cour" || c.formulas == "frac-rac")
                    polygonID = draw
                        .polyline(convertTo.toString())
                        .fill("none")
                        .stroke({
                            color: "black",
                            width: 1,
                            linecap: "round",
                            linejoin: "round"
                        });
                else if (c.formulas == "kyste" || c.formulas == "abc") {
                    polygonID = draw
                        .circle(convertTo[2] * 2)
                        .fill(c.color)
                        .move(convertTo[0] - 10, convertTo[1] - 10);
                } else if (c.formulas == "abs" || c.formulas == "rac-resid") {
                    polygonID = draw
                        .rect(
                            convertTo[2] - convertTo[0],
                            convertTo[3] - convertTo[1]
                        )
                        .fill(c.color)
                        .move(convertTo[0], convertTo[1]);
                } else {
                    polygonID = draw
                        .polygon(convertTo.toString())
                        .fill(c.color)
                        .stroke({ width: 1 });
                }

                document.getElementById(polygonID).setAttribute("teeth", teeth);
                document
                    .getElementById(polygonID)
                    .setAttribute("title", c.formulas);
            });
        },
        /**
         * @param String coord
         * @return Array
         */
        convertCoord(coord) {
            const orginalWidth = 790;
            const originalHeight = 319;
            // '358,15,378,62,383,105,388,134,387,152,355,154,342,143,348,113,352,66,354,35'
            let imgWidth = document.querySelector("#schema-map").width;
            let imgHeight = document.querySelector("#schema-map").height;
            document
                .querySelector("#initial_schema_canvas")
                .setAttribute("width", imgWidth);
            document
                .querySelector("#initial_schema_canvas")
                .setAttribute("height", imgHeight);
            // let mediaWidth = window.innerWidth;
            let ratioX = orginalWidth / imgWidth;
            let ratioY = originalHeight / imgHeight;
            // if (mediaWidth == 1440) {
            //     ratioX = 1.08243;
            //     ratioY = 1.078767515923566;
            // }
            // if (mediaWidth == 1440) {
            //     ratioX = 1.08243;
            //     ratioY = 1.078767515923566;
            // }
            // if (mediaWidth == 1024) {
            //     ratioX = 1.348122867;
            //     ratioY = 1.34812467;
            // }
            // if (mediaWidth == 768) {
            //     ratioX = 1.685671367;
            //     ratioY = 1.685743577;
            // }
            // if (mediaWidth == 320) {
            //     ratioX = 2.724137931;
            //     ratioY = 2.724306967;
            // }
            // change value of coords coordinate with the size of the actual media : laptop,tablete,mobile
            let val = coord
                .split(",")
                .map((c, i) =>
                    i % 2 == 0 ? parseInt(c / ratioX) : parseInt(c / ratioY)
                );

            return val;
        },
        /*
         * Remplir le graphe du schema dentaire des données du patient
         */
        mountSchema() {
            // document.querySelector("#schema-map").width = document.querySelector("#schema-map").parentElement('row').offsetWidth;
            // document.querySelector("#schema-map").height = document.querySelector("#schema-map").parentElement('row').offsetHeight;
            
// set formules in schema
            if (
                this.patient.initial_schema != undefined &&
                this.patient.initial_schema.traitements != undefined
            ) {
                // ajouter les traitements au tableau checkedTooth qui sert de source pour les checkbox
                let draw = SVG("#initial_schema_canvas");
                let polygonID;
                this.patient.initial_schema.traitements.forEach(c => {
                    let convertTo = this.convertCoord(c.coord);
                    if (c.formulas == "frac-cour" || c.formulas == "frac-rac")
                        polygonID = draw
                            .polyline(convertTo.toString())
                            .fill("none")
                            .stroke({
                                color: "black",
                                width: 1,
                                linecap: "round",
                                linejoin: "round"
                            });
                    else if (c.formulas == "kyste" || c.formulas == "abc") {
                        polygonID = draw
                            .circle(convertTo[2] * 2)
                            .fill(c.color)
                            .move(convertTo[0] - 10, convertTo[1] - 10);
                    } else if (
                        c.formulas == "abs" ||
                        c.formulas == "rac-resid"
                    ) {
                        polygonID = draw
                            .rect(
                                convertTo[2] - convertTo[0],
                                convertTo[3] - convertTo[1]
                            )
                            .fill(c.color)
                            .move(convertTo[0], convertTo[1]);
                    } else {
                        polygonID = draw
                            .polygon(convertTo.toString())
                            .fill(c.color)
                            .stroke({ width: 1 });
                    }

                    document
                        .getElementById(polygonID)
                        .setAttribute("teeth", c.teeth);
                    document
                        .getElementById(polygonID)
                        .setAttribute("title", c.formulas);
                });
                this.schema_id = this.patient.initial_schema.id;
            }
        },

        /**
         * Listen to keyboard shortcut for:
         * Dent obturer , absente, couronne, and racine
         * @param
         */
        onKeyDown(e) {
            switch (e.keyCode) {
                case 65: // 'a' key
                    // Handle for the keyboard shortcut of 'Absente' teeth
                    this.handleSelectedFormulas(["abs"]);

                    break;
                case 79: // 'o' key
                    // Handle for the keyboard shortcut of 'Obturer' teeth
                    this.handleSelectedFormulas(["obt"]);
                    break;
                case 67: // 'c' key
                    // Handle for the keyboard shortcut of 'Couronne' teeth
                    this.handleSelectedFormulas("frac-cour");
                    break;
                case 82: // 'r' key
                    // Handle for the keyboard shortcut of 'Racine' teeth
                    this.handleSelectedFormulas("frac-rac");
                    break;
            }
            //TODO Handle keyboards tape when it pressed 2nd time
        }
    },
    watch: {
        /**
         * Listen to click on teeth number
         * @param {Object[]} newVal - The new list of tooth
         */
        num_tooth: {
            handler: function(newTooth) {
                newTooth.forEach(newTeeth => {
                    const idx = this.selectedTooth.findIndex(
                        e => e == newTeeth.num
                    );
                    if (idx == -1 && newTeeth.state) {
                        // teeth is checked
                        this.selectedTooth.push(newTeeth.num); // add to the list
                    } else if (idx != -1 && !newTeeth.state) {
                        // teeth is unchecked
                        // remove from the list
                        this.selectedTooth.splice(idx); // remove the unchecked teeth from the selected tooth
                    }
                });
            },
            deep: true
        },
        selectedTooth: {
            handler: function(newSelectedTooth) {
                //TODO Check/Uncheck the formula(s) button(s) depending on the selected teeth
                /**
                 * @description When the teeth is check we get the formulas from server
                 * get all the selected tooth and send to the server
                 * if no teeth is check then uncheck all formulas
                 */
                if (newSelectedTooth.length != 0) {
                    axios
                        .get(
                            `/patients/schema-dentaire/${this.schema_id}/teeth/${newSelectedTooth}/get-formulas`
                        )
                        .then(response => {
                            if (response.data.length != 0) {
                                const formulas = response.data;
                                this.buttons.map(formula => {
                                    formulas.map(formule => {
                                        if (
                                            formula.caption == formule.formulas
                                        ) {
                                            formula.state = true;
                                        }
                                    });
                                });
                            }
                        });
                } else {
                    this.buttons.map(formula => {
                        formula.state = false;
                    });
                }
            },
            deep: true
        }
    },
    created()
    {

    },
    updated: function () {
        this.$nextTick(function () {
                    //SVG DIMENSIONS
            document.querySelector("#initial_schema_canvas").setAttribute('width' , document.querySelector("#schema-map").width);
            document.querySelector("#initial_schema_canvas").setAttribute('height' , document.querySelector("#schema-map").height);
            
  });
},
    mounted() {
        //this.onShowPopover();

        // mount initial schema
        this.mountSchema();

        // register keydown event to vue object
        this.onKeyDown = this.onKeyDown.bind(this);
        document.addEventListener("keydown", this.onKeyDown);

    }
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

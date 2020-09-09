<template>
    <div class="col-md-8">
        <b-button
            :pressed.sync="sectionsBtn[0].state"
            variant="outline-primary"
            class="mb-1 rounded-circle"
            size="sm"
            @click="toothSection('11,12,13,14,15,16,17,18', 0)"
            v-show="isToothVisible"
        >
            {{ sectionsBtn[0].caption }}
        </b-button>
        <b-button
            v-for="(btn, idx) in num_tooth"
            :key="idx"
            :pressed.sync="btn.state"
            v-if="idx <= 15"
            variant="outline-success"
            class="mb-1 rounded-circle tooth-plan"
            size="sm"
            @click="tooth(btn.num)"
            v-show="isToothVisible"
        >
            {{ btn.num }}
        </b-button>
        <b-button
            :pressed.sync="sectionsBtn[1].state"
            variant="outline-primary"
            class="mb-1 rounded-circle"
            size="sm"
            @click="toothSection('21,22,23,24,25,26,27,28', 1)"
            v-show="isToothVisible"
        >
            {{ sectionsBtn[1].caption }}
        </b-button>
        <div style="position : relative" :class="p_class">
            <svg
                id="plan_schema_canvas"
                style="position: absolute; 
            left: 0px; top: 0px; 
            padding: 0px; 
            border: 0px;"
                xmlns="http://www.w3.org/2000/svg"
                version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="775"
                height="314"
            />
            <img
                src="/img/schema.png"
                id="schema-map"
                usemap="#image-map"
                width="100%"
            />

            <map name="image-map">
                <area
                    coords="552,26,573,64,584,115,595,199,597,236,568,238,529,231,530,207,537,110,544,28,550,20"
                    shape="poly"
                />
            </map>
        </div>
        <b-button
            :pressed.sync="sectionsBtn[2].state"
            variant="outline-primary"
            class="mb-1 rounded-circle"
            size="sm"
            @click="toothSection('41,42,43,44,45,46,47,48', 2)"
            v-show="isToothVisible"
        >
            {{ sectionsBtn[2].caption }}
        </b-button>
        <b-button
            v-for="(btm_btn, btm_idx) in num_tooth"
            :key="btm_idx"
            v-if="btm_idx > 15"
            :pressed.sync="btm_btn.state"
            variant="outline-success"
            class="mb-1 rounded-circle tooth-plan"
            size="sm"
            @click="tooth(btm_btn.num)"
            v-show="isToothVisible"
        >
            {{ btm_btn.num }}
        </b-button>
        <b-button
            :pressed.sync="sectionsBtn[3].state"
            variant="outline-primary"
            class="mb-1 rounded-circle"
            size="sm"
            @click="toothSection('31,32,33,34,35,36,37,38', 3)"
            v-show="isToothVisible"
        >
            {{ sectionsBtn[3].caption }}
        </b-button>
        <slot name="formules"></slot>
    </div>
</template>

<script>
export default {
    components: {},
    props: ["selectedTooth", "isToothVisible", "p_class"],
    data() {
        return {
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
            sectionsBtn: [
                { caption: "S1", state: false },
                { caption: "S2", state: false },
                { caption: "S3", state: false },
                { caption: "S4", state: false }
            ]
            // selectedTooth  : new Array(),
        };
    },
    methods: {
        removeTooth(toothToDelete) {
            // remove selected tooth from DB
            axios
                .delete(
                    "/patient/schema-dentaire/remove_tooth/" + toothToDelete
                )
                .then(response => {
                    // remove formulas from dental schema
                    //
                    // Deselect selected tooth
                    this.resetTooth();
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },
        reset() {
            this.removeTooth(this.selectedTooth);
        },
        resetAll() {
            this.num_tooth.map(t => t.num);
            this.removeTooth(allTooth);
        },
        resetTooth() {
            this.selectedTooth = [];
            this.num_tooth.map(t => (t.state = false));
        },
        toothSection: function(num, idx) {
            let array = num.split(",");
            let index = "";
            let state = this.sectionsBtn[idx].state;
            if (state)
                $.each(array, (i, teeth) => {
                    index = this.num_tooth
                        .map(t => t.num)
                        .indexOf(parseInt(teeth)); // get index of teeth
                    this.num_tooth[index].state = true; // set State to True
                    this.selectedTooth.push(teeth); // add teeth to selected tooth
                });
            else
                $.each(array, (i, teeth) => {
                    index = this.num_tooth
                        .map(t => t.num)
                        .indexOf(parseInt(teeth));
                    this.num_tooth[index].state = false;
                    this.selectedTooth.splice(
                        this.selectedTooth.indexOf(teeth),
                        1
                    );
                });

            this.$emit("selectedTooth", this.selectedTooth);
        },
        tooth: function(num) {
            let index = this.num_tooth.map(t => t.num).indexOf(num); // get index of teeth
            let state = this.num_tooth[index].state; // get State of teeth btn

            if (state) this.selectedTooth.push(num);
            else this.selectedTooth.splice(this.selectedTooth.indexOf(num), 1);

            this.$emit("selectedTooth", this.selectedTooth);
        },
        createShapes(dent, coords, context) {}
    },
    mounted() {}
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
.tooth-plan {
    margin-right: 1.1em;
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
</style>

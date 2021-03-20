<script>
export default {
    removeTooth(toothToDelete) {
        // remove selected tooth from DB
        axios
            .delete("/patients/schema-dentaire/remove_tooth/" + toothToDelete)
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
        let allTooth = this.num_tooth.map(t => t.num);
        this.removeTooth(allTooth);
    },
    resetTooth() {
        this.selectedTooth = [];
        this.num_tooth.map(t => (t.state = false));
    },

    onShowPopover() {
        this.$root.$on("bv::popover::show", bvEventObj => {
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
    handleSelectedFormulas(formulas) {
        this.selectedTooth.forEach(teeth => {
            this.populateCheckedTooth(formulas, teeth);
            this.sendToServer(formulas, teeth);
        });
    },
    populateCheckedTooth(formulas, teeth) {
        if (this.checkedTooth.length > 0) {
            let index = this.checkedTooth.findIndex(p => p.teeth == teeth); // o or -1
            if (index == -1 && formulas.length != 0) {
                // si la dent est introuvable on l'ajoute au tableau
                this.checkedTooth.push({
                    teeth: teeth,
                    formulas: formulas // new array
                });
            } else if (index != -1) {
                // si la dent selectionné est trouvé dans le tableau
                // the array of num teeth exist
                this.checkedTooth[index].formulas = formulas; // add the new selected formula
            }
        } else {
            this.checkedTooth.push({
                teeth: teeth,
                formulas: formulas
            });
        }
    },
    /**
     * @param Array newVal Array of selected formulas
     */
    selectedFormulas: {
        handler: function(newVal) {
            console.log("New Val selected formulas : ", newVal);
            this.populateCheckedTooth(newVal, this.selectedTeeth);
            // et on envoi au server pour enregistrer et retourner ses coordonnées
            // formulas = ['frac']; ['frac','carie']; ['frac', 'carie' , 'abs']
            // this.sendToServer(['frac'] , 22);
            // this.sendToServer(['frac','carie'] , 22);
            // this.sendToServer(['frac', 'carie' , 'abs']  , 22);
            this.sendToServer(newVal, this.selectedTeeth);
        }
    },
    tooth: function(num) {
        // get the index of the selected teeth
        let index = this.num_tooth.map(t => t.num).indexOf(num);
        // get the state of the selected teeth
        let newState = this.num_tooth[index].state;
        // add or remove the selected teeth to selected tooth array
        console.log("New state :", newState);
        if (newState) {
            this.selectedTooth.push(num);
            if (this.selectedFormulas.length == 0) {
                this.num_tooth[index].state = false;
            }
        } else {
            this.selectedTooth.splice(this.selectedTooth.indexOf(num), 1);
            // this.num_tooth[index].state = false;
        }
    }
};
</script>

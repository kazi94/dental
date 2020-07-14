import Vue from "vue";
/**
 * Local Components
 */
Vue.component("rendez-vous-btn", {
    data: function() {
        return {
            form: {
                date: "",
                acte: ""
            }
        };
    },

    template: `
    <div>
        <a href="#" class="nav-link"  v-b-modal.modal-rdv v-b-tooltip.hover.bottom="'Programmer un rendez-vous'">
            <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
            Rendez-vous
        </a>
        <b-modal id="modal-rdv" title="Programmer un rendez-vous">
            <div>
                <b-form @submit="onSubmit" @reset="onReset">
                    <b-form-group
                        id="input-group-rdv"
                        label="Rendez-vous le:"
                        label-for="input-rdv"
                    >
                        <b-form-input
                        id="input-rdv"
                        v-model="form.date"
                        type="date"
                        required
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-act" label="Prochain Acte à faire:" label-for="input-act">
                        <b-form-input
                        id="input-act"
                        v-model="form.act"
                        required
                        ></b-form-input>
                    </b-form-group>
                </b-form>

            </div>
        </b-modal>
    </div> 

    `,
    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            alert(JSON.stringify(this.form));
        },
        onReset(evt) {
            evt.preventDefault();
            // Reset our form values
            this.form.data = "";
            this.form.name = "";
            this.form.food = null;
            this.form.checked = [];
            // Trick to reset/clear native browser form validation state
            this.show = false;
            this.$nextTick(() => {
                this.show = true;
            });
        }
    }
});

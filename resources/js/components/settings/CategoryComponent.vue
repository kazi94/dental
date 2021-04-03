<template>
    <div>
        <div class="row mb-1">
            <div class="col-sm-9 h5">Categories</div>
            <div class="col-sm-3">
                <button
                    class="btn btn-primary mt-1 mb-1 rounded-0 pull-right"
                    @click="showModal"
                >
                    Ajouter
                </button>
            </div>
        </div>

        <table class="mb-0 table">
            <thead>
                <tr>
                    <td>#</td>
                    <th>Nom</th>
                    <th>Code couleur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(val, index) in categories">
                    <th>{{ index + 1 }}</th>
                    <td>{{ val.name }}</td>
                    <td
                        v-bind:style="{ color: val.color }"
                        style="font-weight : 700"
                    >
                        {{ val.color }}
                    </td>
                    <td>
                        <button
                            class="btn btn-danger btn-icon btn-icon-only mr-2 rounded-0"
                            @click="removeAct(val.id, index)"
                            title="Supprimer"
                        >
                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                        </button>
                        <button
                            class="btn btn-primary btn-icon btn-icon-only mr-2 rounded-0"
                            @click="update(val)"
                            title="Modifier"
                        >
                            <i class="pe-7s-edit btn-icon-wrapper"> </i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div
            class="modal fade"
            tabindex="-1"
            id="category_modal"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editMode">
                            Nouvelle categorie
                        </h5>
                        <h5 class="modal-title" v-else>Modifier categorie</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        class="needs-validation"
                        novalidate=""
                        @submit.prevent="
                            editMode ? updateCategory() : createCategory()
                        "
                        enctype="multipart/form-data"
                        autocomplete="off"
                    >
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom01">Nom*</label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Nom de la catégorie"
                                        required=""
                                    />
                                </div>
                                <div class="col-md-4 mb-3">
                                    <colour-picker
                                        v-model="form.color"
                                        :value="form.color"
                                        :color="form.color"
                                        label="Code couleur*"
                                        picker="compact"
                                        required
                                        ref="colorPicker"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary rounded-0"
                                data-dismiss="modal"
                            >
                                FERMER
                            </button>
                            <input
                                type="submit"
                                value="Ajouter"
                                class="btn btn-primary rounded-0"
                                v-if="!editMode"
                            />
                            <input
                                type="submit"
                                value="Modifier"
                                class="btn btn-primary rounded-0"
                                v-else
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ColourPicker from "vue-colour-picker";
export default {
    name: "CategoryComponent",
    components: {
        "colour-picker": ColourPicker
    },
    props: [],
    data() {
        return {
            colour: "red",
            editMode: false,
            categories: [],
            id: "",
            form: new Form({
                name: "",
                color: ""
            })
        };
    },
    methods: {
        showModal() {
            this.form.reset();
            $("#category_modal")
                .appendTo("body")
                .modal("show");
        },
        createCategory() {
            axios
                .post("/admin/category", this.form) // Send Ordonnance to server
                .then(response => {
                    //add act to list
                    this.categories.push(response.data);
                    $("#category_modal").modal("hide");
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },
        removeAct(id, index) {
            axios
                .delete("/admin/category/" + id)
                .then(response => {
                    this.categories.splice(index, 1);
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        },

        update(act) {
            this.form.reset();
            this.editMode = true;
            this.form.fill(act);
            this.id = act.id;
            $("#category_modal")
                .appendTo("body")
                .modal("show");
        },

        updateCategory() {
            let categories = this.categories;
            axios
                .put("/admin/category/" + this.id, this.form)
                .then(response => {
                    $.each(categories, (index, val) => {
                        if (val.id == response.data.id)
                            categories[index] = response.data;
                    });
                    $("#category_modal").modal("hide");
                    this.editMode = false;
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        }
    },
    watch: {
        form: {
            handler: function(val) {
                this.$refs.colorPicker.setColor(val.color);
            },
            deep: true
        }
    },
    mounted() {
        axios
            .get("/admin/category")
            .then(response => {
                this.categories = response.data;
            })
            .catch(exception => {
                this.$toaster.error(exception);
            });
    }
};
</script>

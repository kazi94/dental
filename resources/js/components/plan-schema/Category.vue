<template>
    <!-- <div role="tablist">
          <b-card no-body class="mb-1" :key="index" v-for="(categ , index) in categories">
            <b-card-header header-tag="header" class="p-1" role="tab">
              <b-button block v-b-toggle="'collapse-' +index" variant="info">{{ categ.name }}</b-button>
            </b-card-header>
            <b-collapse :id="'collapse-' +index" accordion="my-accordion" role="tabpanel">
              <b-card-body>
                <b-form-group>
                  <b-form-checkbox
                    v-for="option in categ.acts"
                    v-model="selectedActs"
                    :key="option.id"
                    :value="option"
                  >{{ option.nom }}</b-form-checkbox>
                </b-form-group>
              </b-card-body>
            </b-collapse>
          </b-card>
        </div> -->

    <div>
        <div class="position-relative form-group">
            <multiselect
                v-model="selectedActs"
                :options="categories"
                :multiple="true"
                group-values="acts"
                group-label="name"
                :group-select="true"
                placeholder="Sélectionner un ou plusieurs Actes"
                selectLabel="Tapez Entrée pour sélectionner l'acte"
                selectGroupLabel="Tapez Entrée pour sélectionner le groupe"
                selectedLabel="Ajouté"
                deselectLabel="Tapez Entrée pour déselectionner"
                openDirection="top"
                track-by="id"
                label="nom"
                ><span slot="noResult"
                    >Oops! Aucun act trouvé !</span
                ></multiselect
            >
        </div>
    </div>
</template>

<script>
export default {
    props: [],

    data() {
        return {
            categories: new Array(),
            selectedActs: new Array()
        };
    },
    methods: {
        getActs() {
            axios
                .get("/admin/act/get_acts")
                .then(response => {
                    this.categories = response.data;
                })
                .catch(exception => {
                    this.$toaster.error(exception);
                });
        }
    },
    mounted() {
        this.getActs();
    }
};
</script>

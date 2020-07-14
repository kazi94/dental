<template>
  <div class="row">
    <h2>Liste des devis</h2>
    <b-table striped hover :items="patient.schemas.quotations" :fields="fields">
      <template v-slot:cell(state)="data">
          <b-badge pill variant="success">{{ data.item.state }}</b-badge>
      </template>
      <template v-slot:cell(schema)="data">
          <b-badge pill variant="success">{{ data.item.state }}</b-badge>
      </template>      
      <template v-slot:table-caption>Ici le nombre de devis</template>
    </b-table>
  </div>
</template>

<script>
export default {
  components: {},

  props: ["patient"],

  data() {
    return {
      fields: [
        {
          key: "id",
          label: "N°",
          sortable: true
        },
        {
          key: "date_devis",
          sortable: true,
          label: "Date devis"
        },
        {
          key: "total",
          label: "Total",
          sortable: false
        },
        {
          key: "discount",
          label: "Remise",
          sortable: true
        },
        {
          key: "state",
          label: "Etat",
          sortable: true
        },
        {
            key :"schema",
            label : "Schéma dentaire",
            sortable : false,
        }
      ]
    };
  },

  methods: {},

  watch: {},

  computed: {},

  mounted() {
    console.log("Devis Component mounted !");
  }
};
</script>

<style>
</style>

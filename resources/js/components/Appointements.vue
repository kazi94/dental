<template>
    <div>
        <b-button
            variant="primary"
            class="p-1"
            v-b-toggle.sidebar-footer
            title="Liste des rendez-vous"
        >
            <i class="fa text-white fa-calendar pr-1 pl-1"
                ><b-badge variant="primary" v-if="appointements.length > 0">{{
                    appointements.length
                }}</b-badge></i
            >
        </b-button>

        <b-sidebar
            id="sidebar-footer"
            aria-label="Liste des rendez-vous"
            no-header
            right
            shadow
            backdrop
        >
            <template #footer="{ hide }">
                <div
                    class="d-flex bg-dark text-light align-items-center px-3 py-2"
                >
                    <button class="btn mr-auto btn-light">
                        <a href="/rendez-vous">Ouvrir mon agenda</a>
                    </button>
                    <b-button size="sm" @click="hide">Fermer</b-button>
                </div>
            </template>
            <div class="px-3 py-2">
                <b-card
                    v-for="(appointement, key) in appointements"
                    :key="key"
                    :title="appointement.assigned_to.doctor"
                    class="mb-2"
                    :header="appointement.date_appointement"
                    header-text-variant="white"
                    header-tag="header"
                    header-bg-variant="success"
                >
                    <b-card-text>
                        {{ appointement.category.name }} <br />
                        <strong class="text-info text-bold"
                            >FAUTEUIL : {{ appointement.fauteuil }}</strong
                        >
                        <br />
                        {{ appointement.text }}
                    </b-card-text>
                </b-card>
            </div>
        </b-sidebar>
    </div>
</template>

<script>
export default {
    components: {},
    props: {
        patient: {
            type: Object
        }
    },
    data() {
        return {
            appointements: []
        };
    },
    methods: {},
    computed: {},
    mounted() {
        // Add appointemnts list of patient
        if (this.patient.appointements != null) {
            this.appointements = this.patient.appointements;
        }
    }
};
</script>

<style lang="scss" scoped></style>

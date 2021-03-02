<template>
    <div>
        <b-row>
            <b-col cols="10"><h2>Règlements</h2></b-col>
            <b-col cols="2">
                <b-button
                    size="sm"
                    squared
                    variant="primary"
                    v-b-modal.cach-modal
                    >Nouveau</b-button
                ></b-col
            >
        </b-row>

        <b-table
            :items="payments"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            bordered
            responsive="sm"
            small
            head-variant="light"
        >
            <template v-slot:cell(index)="data">
                <!-- data = acceptedQuotation -->
                {{ data.index + 1 }}
            </template>

            <template v-slot:cell(total_paid)="data">
                <!-- data = acceptedQuotation -->
                {{ data.item.total_paid }} DA
            </template>
        </b-table>
        <b-pagination
            pills
            align="center"
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="my-table"
        ></b-pagination>
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
            fields: [
                {
                    key: "index",
                    label: "#",
                    sortable: false
                },
                {
                    key: "total_paid",
                    label: "Montant",
                    sortable: true
                },
                {
                    key: "paid_at",
                    label: "Date de règlement",
                    sortable: true
                }
            ],
            perPage: 10,
            currentPage: 1,
            payments: new Array()
        };
    },
    methods: {
        /**
         * Add new Payment to table
         * @param Object newPayment
         */
        updateTable(newPayment) {
            this.payments.push(newPayment);
        }
    },
    computed: {
        rows() {
            return this.payments.length;
        }
    },
    mounted() {
        console.log("Règlements Component mounted !");
        // if (this.patient.last_schema.last_quotation.payments ?? ) {
        this.payments = this.patient.last_schema.last_quotation.payments;
        // }
    }
};
</script>

<style lang="scss" scoped></style>

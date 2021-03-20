<template>
    <div>
        <input
            id="radioFile"
            type="file"
            ref="radioFile"
            accept=".png, .jpg, .jpeg"
            hidden
            v-on:change="uploadRadio"
        />
        <a
            href="javascript:void(0);"
            class="nav-link"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Ajouter une image radiographique"
            onclick="document.getElementById('radioFile').click()"
        >
            <i class="nav-link-icon fa fa-plus icon-gradient bg-primary"></i>
            Radiographie
        </a>
    </div>
</template>

<script>
export default {
    props: ["patient"],
    data() {
        return {};
    },
    methods: {
        uploadRadio() {
            const file = this.$refs.radioFile.files[0];
            const formData = new FormData();
            formData.append("file", file);
            formData.append("patient_id", this.patient.id);
            axios
                .post("/patients/radiographies", formData)
                .then(res => {
                    Vue.toasted.success("Image Ajoutée.");
                    this.$emit("get-image", res.data);
                })
                .catch(err => {
                    Vue.toasted.error(err);
                });
        }
    },
    computed: {},
    mounted() {}
};
</script>

<template>
    <div class="tab-pane " id="tab-eg1-5" role="tabpanel">
        <b-container fluid class="p-4 bg-light">
            <b-row>
                <b-col
                    v-for="(img, index) in imgs"
                    :key="index"
                    class="col-xs-12 col-sm-3"
                >
                    <b-col cols="12">
                        <a :href="img.img_url" target="_blank"
                            ><b-img
                                thumbnail
                                fluid
                                :src="img.img_url"
                                alt="Image 1"
                            ></b-img></a
                    ></b-col>
                    <b-col cols="12" class="text-center">
                        <button
                            class="btn btn-danger rounded-0"
                            @click="removeImage(index, img.id)"
                        >
                            Supprimer
                        </button>
                    </b-col>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
    components: {},
    props: ["patient"],
    data() {
        return {
            imgs: []
        };
    },
    methods: {
        addToGallery(url) {
            this.imgs.push(url);
        },
        removeImage(index, id) {
            axios
                .delete("/patients/radiographies" + id)
                .then(res => {
                    Vue.toasted.success("Image Supprimée.");
                    this.imgs.splice(index, 1);
                })
                .catch(err => {
                    console.error(err);
                });
        }
    },
    computed: {},
    watch: {},
    mounted() {
        if (this.patient.radios) this.imgs = this.patient.radios;
    }
};
</script>

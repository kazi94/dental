<template>
    <div class="main-card mb-3 card">
        <div class="card-header">
            <h5 class="card-title">Radiographies</h5>
        </div>
        <!-- <div class="card-body" v-if="showradios"> -->
        <div class="card-body"  v-if="showradios">
            <gallery-component :patient="patient"></gallery-component>
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"  style="width: 50%;"/>
            <button v-on:click="submitFile()" class="btn btn-primary pull-right">Ajouter</button>
        </div>
    </div>
</template>

<script>
    import GalleryComponent from './GalleryComponent'
	export default {
        components : {
            GalleryComponent,
        },
		props : [
			'patient',
			'showradios'
		],
		data() {
			return {
                file :'',

            };
		},
		methods : {
            /*
                Submits the file to the server
            */
            submitFile()
            {
                /*
                    Initialize the form data
                */
                let formData = new FormData();

                /*
                    Add the form data we need to submit
                */
                formData.append('file', this.file);
                formData.append('id', this.patient.id);

                 /*
                  Make the request to the POST /single-file URL
                 */
                axios.post( '/patient/radiographie',
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                  }
                )
                .then(function(response){
                    this.files = '';
                    console.log(response);
                    //this.$toaster.success("Radiographie ajouter avec succés!");
                })
                .catch(function(){
                  //this.$toaster.error("Une erreur est survenue l'ors du chargement du fichier !");
                });
            },
            /*
                get the uploaded file
             */
            handleFileUpload()
            {
                this.file = this.$refs.file.files[0];
            }
        },
		mounted() {
			console.log("Radiographies Component mounted")
		},
	}
</script>
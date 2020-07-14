<template>
      <div>
            <div class="row mb-1">
                  <div class="col-sm-9 h5">Ordonnances type</div>
                  <div class="col-sm-3"><button class="btn btn-primary mt-1 mb-1 rounded-0 pull-right" @click="showModal">Ajouter</button></div>
            </div>
            
            <table class="mb-0 table">
                  <thead>
                        <tr>
                              <td>#</td>
                              <th>Ordonnance</th>
                              <th>Médicaments</th>
                              <th>Actions</th>
                        </tr>
                  </thead>
                  <tbody>
                        <tr v-for="(val,index) in ordonnances">
                              <th scope="row">{{ index + 1 }}</th>
                              <td> {{  val.nom }}</td>
                              <td> {{  val.imploded }}</td>
                              <td>
                                    <button class="btn btn-danger btn-icon btn-icon-only mr-2 rounded-0" @click="removeOrdonnance(val.id,index)" title="Supprimer">
                                          <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                    </button>
                                    <button class="btn btn-primary btn-icon btn-icon-only mr-2 rounded-0" @click="update(val)" title="Modifier">
                                          <i class="pe-7s-edit btn-icon-wrapper"> </i>
                                    </button>

                              </td>
                        </tr>
                  </tbody>
            </table>
<div class="modal fade"  tabindex="-1" id="ordonnance_modal"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-if="!editMode">Nouvelle Ordonnance type</h5>
                <h5 class="modal-title" v-else>Modifier Ordonnance type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form class="needs-validation" novalidate="" @submit.prevent="editMode ? updateOrdonnaceType()  : createOrdonnaceType()" enctype="multipart/form-data" autocomplete="off">
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Nom</label>
                                <input v-model="nom" type="text" class="form-control" placeholder="Nom"  required="">           
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Médicament</label>
                                <div class="input-group">
                                        <autocomplete
                                          ref="autocomplete"
                                          placeholder="Renseigner un médicament"
                                          :source="search"
                                          input-class="form-control"
                                          results-property="data"
                                          :results-display="formattedDisplay"
                                          @selected="addDistributionGroup">
                                        </autocomplete>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-sm mb-0 mt-1">
                                    <thead>
                                        <th>#</th>
                                        <th>Médicament</th>
                                        <th>Supprimer</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(val, index) in medicaments">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ val.SP_NOM }}</td>
                                            <td><button class="btn btn-sm btn-danger rounded-0" @click="removeRow($event,index)">X</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">FERMER</button>
                        <input type="submit" value="Ajouter" class="btn btn-primary rounded-0" v-if="!editMode">
                        <input type="submit" value="Modifier" class="btn btn-primary rounded-0" v-else>
                    </div>
                </form>
        </div>
    </div>
</div>
      </div>
</template>

<script>
    import Autocomplete from 'vuejs-auto-complete'
	export default 
    {
        components: {
            Autocomplete,
        },
		props : [

		],
		data() {
			return {
                editMode : false,
                medicaments : [],
                ordonnances : [],
                id : '',
                nom :'',
                // Create a new form instance
                form: new Form({
                    nom :'',
                    medicaments : [],
                })
            };
		},
		methods : {
            search (input) {
                return '/medicament/' + input
            },

            addDistributionGroup (medicament) {
                this.medicaments.push(medicament.selectedObject)
                // access the autocomplete component methods from the parent
                this.$refs.autocomplete.clear()
            },

            formattedDisplay (result) {
                return result.SP_NOM ;
            },
            // remove medicament from table
            removeRow(event, index){
                this.medicaments.splice(index,1);
                event.preventDefault();
            },
            showModal() {
                
                this.form.reset();
                $("#ordonnance_modal").appendTo('body').modal("show");
                
            },
            createOrdonnaceType()
            {
                if (this.medicaments = []) // 
                    alert('Vous devez renseigner au moin un médicament');
                else 
                {
                    this.form.fill({
                        medicaments : this.medicaments,
                        nom : this.nom
                    });

                    axios.post( '/admin/ordonnance-type', this.form) // Send Ordonnance to server
                    .then((response) =>
                    {
                        //add Ordonnance to list
                        this.ordonnances.push(response.data); 

                        //Reset Forms
                        this.medicaments = [];   
                        $("#ordonnance_modal").modal("hide");

                        this.$toaster.success("Ordonnance ajoutée !");
                    })
                    .catch((exception) =>
                    {
                        this.$toaster.error(exception);
                    })
                }
            },
            removeOrdonnance(id , index)
            {

                axios.delete('/admin/ordonnance-type/'+id)
                    .then((response) =>{
                        this.ordonnances.splice(index,1);
                    })
                    .catch((exception) => {
                        this.$toaster.error(exception)
                    });
            },

            update (ordonnance) 
            {
                this.nom = ordonnance.nom;
                this.id = ordonnance.id;
                this.medicaments = ordonnance.medicaments ;
                this.editMode = true;
                this.form.reset();
                $("#ordonnance_modal").appendTo('body').modal("show"); 
            },

            updateOrdonnaceType (){
                if (this.medicaments = []) 
                    alert('Vous devez renseigner au moin un médicament');

                else 
                {
                    let ordo = this.ordonnances;
                    this.form.fill({
                        medicaments : this.medicaments,
                        nom : this.nom
                    });
                    axios.put('/admin/ordonnance-type/'+this.id , this.form)
                        .then( (response) =>{
                            $.each(ordo , (index, val) => {
                                if (val.id  == response.data.id)
                                    ordo[index] = response.data;
                            });
                            $("#ordonnance_modal").modal("hide");
                            this.form.reset();
                            this.medicaments = [];
                            this.editMode = false;
                        })
                        .catch ( (exception) =>{
                            this.$toaster.error(exception)
                        })   
                }
                
            }
		},
        computed: {

        },
		mounted() {
			console.log("ordonnances Component mounted")

            axios.get( '/admin/ordonnance-type')
                .then((response) =>
                {
                    this.ordonnances = response.data;
                })
                .catch((exception) =>
                {
                  this.$toaster.error(exception);
                });
		},
	}


</script>

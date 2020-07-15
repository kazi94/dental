<template>
      <div>
            <div class="row mb-1">
                  <div class="col-sm-9 h5">Acte</div>
                  <div class="col-sm-3"><button class="btn btn-primary mt-1 mb-1 rounded-0 pull-right" @click="showModal">Ajouter</button></div>
            </div>
            
            <table class="mb-0 table">
                  <thead>
                        <tr>
                              <td>#</td>
                              <th>Code</th>
                              <th>Acte</th>
                              <th>Famille</th>
                              <th>Prix</th>
                              <th>Actions</th>
                        </tr>
                  </thead>
                  <tbody>
                        <tr v-for="(val,index) in acts">
                              <th scope="row">{{ index + 1 }}</th>
                              <td> {{  val.code_cnas }}</td>
                              <td> {{  val.nom }}</td>
                              <td> {{  val.category }}</td>
                              <td> {{  val.price }} DA</td>
                              <td>
                                    <button class="btn btn-danger btn-icon btn-icon-only mr-2 rounded-0" @click="removeAct(val.id,index)" title="Supprimer">
                                          <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                    </button>
                                    <button class="btn btn-primary btn-icon btn-icon-only mr-2 rounded-0" @click="update(val)" title="Modifier">
                                          <i class="pe-7s-edit btn-icon-wrapper"> </i>
                                    </button>

                              </td>
                        </tr>
                  </tbody>
            </table>
<div class="modal fade"  tabindex="-1" id="act_modal"  aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-if="!editMode">Nouvelle Acte</h5>
                <h5 class="modal-title" v-else>Modifier Acte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form class="needs-validation" novalidate="" @submit.prevent="editMode ? updateAct()  : createAct()" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Code</label>
                                <input v-model="form.code_cnas" type="text" class="form-control" placeholder="Codification Cnas"  required="">           
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Acte</label>
                                <input v-model="form.nom" type="text" class="form-control" placeholder="Nom"  required="">           
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Famille</label>
<!--                                     <div class="input-group">
                                        <autocomplete
                                          ref="autocomplete"
                                          placeholder="Renseigner la famille"
                                          :source="search"
                                          input-class="form-control"
                                          results-property="data"
                                          :results-display="formattedDisplay"
                                          @selected="addDistributionGroup"
                                          v-model="form.category">
                                        </autocomplete>
                                    </div>  -->
                                <input v-model="form.category" type="text" class="form-control" placeholder="Famille"  required="">           
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Prix</label>
                                <input v-model="form.price" type="text" class="form-control" placeholder="Prix"  required="">           
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
                acts : [],
                id : '',
                form: new Form({
                    code_cnas : '',
                    nom :'',
                    category : '',
                    price :'',
                })
            };
		},
		methods : {
            // search (input) {
            //     return '/admin/category/get_categories' + input
            // },

            // addDistributionGroup (cat) {
                // this.form.category = cat.selectedObject;
            // },

            // formattedDisplay (result) {
            //     return result.name ;
            // },            
            showModal() {
                this.form.reset();
                $("#act_modal").appendTo('body').modal("show");
                
            },
            createAct()
            {
                axios.post( '/admin/act', this.form) // Send Ordonnance to server
                    .then((response) =>
                    {
                        //add act to list
                        this.acts.push(response.data); 
                        $("#act_modal").modal("hide");

                    })
                    .catch((exception) =>
                    {
                        this.$toaster.error(exception);
                    })
            },
            removeAct(id , index)
            {

                axios.delete('/admin/act/'+id)
                    .then((response) =>{
                        this.acts.splice(index,1);
                    })
                    .catch((exception) => {
                        this.$toaster.error(exception)
                    });
            },

            update (act) 
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(act);
                this.id =act.id;
                $("#act_modal").appendTo('body').modal("show"); 
            },

            updateAct ()
            {
                let acts = this.acts
                axios.put('/admin/act/'+this.id , this.form)
                    .then( (response) =>{
                        $.each(acts , (index, val) => {
                            if (val.id  == response.data.id)
                                acts[index] = response.data;
                        });
                        $("#act_modal").modal("hide");
                        this.editMode = false;
                    })
                    .catch ( (exception) =>{
                        this.$toaster.error(exception)
                    })   
                
            }
		},
		mounted() {
            axios.get( '/admin/act')
                .then((response) =>
                {
                    this.acts = response.data;
                })
                .catch((exception) =>
                {
                  this.$toaster.error(exception);
                });
		},
	}


</script>

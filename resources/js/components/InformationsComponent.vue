<template>
    <div class="main-card mb-2 card">
		<div class="card-header">
		    <h5 class="card-title">Informations Personnels et Médicales</h5>
		    <div class="btn-actions-pane-right actions-icon-btn" v-if="showinfos">
		        <button @click="updatePatient(patient)" data-toggle="tooltip" data-placement="bottom" title="Modifier les informations patient" class="btn-icon btn-icon-only btn btn-link"><i class="pe-7s-note btn-icon-wrapper"></i></button>
		    </div>
		</div>
	    <div class="card-body">

	    	<div class="row" v-if="showinfos">
				<div class="col-sm-3">
					<div class="widget-content-wrapper">
	                   <div class="mr-3 ml-2 widget-content">
	                        <img width="50" class="rounded-circle" src="/img/user.png" alt="">
	                    </div>
	                    <div class="widget-content">
	                        <div class="widget-heading"><strong>{{ patient.nom }} {{ patient.prenom }}</strong></div>
	                        <div class="widget-subheading">{{ patient.profession }}</div>
	                    </div>
	                </div>
				</div>

				<div class="col-sm-3 mt-2">
					<p><strong>Age :</strong> <span v-if=" patient.age != '' ">{{ patient.age + ' ans' }}</span></p>
					<p><strong>Sexe :</strong>{{ patient.sexe }} </p>
					<p><strong>Adresse :</strong> {{ patient.adresse }}</p>
				</div>
				<div class="col-sm-6 mt-2">
					<p><strong>Pathologies :</strong> <span v-for="path in patient.pathologies">{{ path.pathologie }},</span></p>
					<p><strong>Antécédents Stomatologiques :</strong> <span v-for="ant in patient.antecedents">{{ ant.nom }},</span> </p>
					<p><strong>Fumeur :</strong> {{ patient.fumeur }}</p>
				</div>
	    	</div>

	        <div v-else>
	            <div class="alert alert-info"><i class="b badge-pill fa fa-info"></i>Aucun Patient enregistré.</div>
	        </div>
	    </div>
        <div class="modal fade patient_update_modal"  tabindex="-1" id="patient_update_modal"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Modifier Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
				  <form class="needs-validation" novalidate="" @submit.prevent="updatedPatient" enctype="multipart/form-data">
				      <div class="modal-body">
				        <div class="row">
				          <div class="col-md-6">
				            <div class="main-card mb-3 card">
				              <div class="card-body">
				                  <h5 class="card-title">Informations Personnels</h5>
				                      <div class="form-row">
				                          <div class="col-md-4 mb-3">
				                              <label for="validationCustom01">Nom</label>
				                              <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('nom') }" id="validationCustom011" placeholder="Nom"  required="true" name="nom" v-model="form.nom">
				                              <has-error :form="form" field="nom"></has-error>
				                          </div>
				                          <div class="col-md-4 mb-3">
				                              <label for="validationCustom02">Prénom</label>
				                              <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('prenom') }" id="validationCustom022" placeholder="Prénom" required="true" name="prenom" v-model="form.prenom">
				                              <has-error :form="form" field="prenom"></has-error>
				                          </div>
				                          <div class="col-md-4 mb-3">
				                              <label for="validationCustomUsername">Date de Naissance</label>
				                              <div class="input-group">
				                                  <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('date_naissance') }"i d="validationCustomUsername" placeholder="Date de Naissance"  required="" name="date_naissance" v-model="form.date_naissance">
				                                  <has-error :form="form" field="date_naissance"></has-error>
				                              </div>
				                          </div>
				                      </div>
				                      <div class="form-row">
				                          <div class="col-md-6 mb-3">
				                              <label for="validationCustom03">Profession</label>
				                              <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('profession') }"id="validationCustom033" placeholder="Profession" required="" name="profession" v-model="form.profession">
				                              <div class="invalid-feedback">
				                                  Please provide a valid city.
				                              </div>
				                          </div>
				                          <div class="col-md-6 mb-3">
				                              <label for="validationCustom04">Adresse Physique</label>
				                              <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('adresse') }"id="validationCustom044" placeholder="Adresse Physique" required="" name="adresse" v-model="form.adresse">
				                              <div class="invalid-feedback">
				                                  Please provide a valid state.
				                              </div>
				                          </div>
				                          <div class="col-md-12 mb-3">
				                              <label for="validationCustom04">Sexe</label>
				                              <div class="position-relative form-group">
				                                <fieldset>
				                                    <div>
				                                        <div class="custom-radio custom-control"><input type="radio" id="sexe1" name="sexe" class="custom-control-input" v-model="form.sexe" value="M"><label class="custom-control-label" for="sexe" >
				                                            HOMME</label></div>
				                                        <div class="custom-radio custom-control"><input type="radio" id="sexe22" name="sexe" class="custom-control-input" v-model="form.sexe" value="F"><label class="custom-control-label" for="sexe2" >
				                                            FEMME</label></div>
				                                    </div>
				                                </fieldset>
				                              </div>                                            
				                          </div>                                        
				                      </div>
				              </div>
				            </div>
				          </div>
				          <div class="col-md-6">
				            <div class="main-card mb-3 card">
				                <div class="card-body">
				                    <h5 class="card-title">Informations médicales</h5>
				                    <div class="form-row">
				                        <div class="col-md-12 mb-3">
				                            <label for="validationCustom04">Fumeur</label>
				                            <div class="position-relative form-group">
				                                <fieldset>
				                                  <div>
				                                      <div class="custom-radio custom-control"><input type="radio" id="exampleCustomRadio1" name="fumeur" class="custom-control-input" value="Oui" v-model="form.fumeur"><label class="custom-control-label" for="exampleCustomRadio">
				                                          OUI</label></div>
				                                      <div class="custom-radio custom-control"><input type="radio" id="exampleCustomRadio22" name="fumeur" class="custom-control-input" value="Non" v-model="form.fumeur"><label class="custom-control-label" for="exampleCustomRadio2">
				                                          NON</label></div>
				                                  </div>
				                                </fieldset>

				                            </div>                                            
				                        </div> 
				                        <div class="col-md-12 mb-3">
				                            <label for="validationCustom02">Chirurgien référent</label>
				                            <input type="text" v-model="form.medecin_externe" class="form-control" :class="{ 'is-invalid': form.errors.has('medecin_externe') }"  placeholder="Chirurgien référent" required=""  >
				                            <div class="valid-feedback">
				                                Très bien !
				                            </div>
				                        </div>

				                        <div class="col-md-12 mb-3">
				                          <div class="position-relative form-group">
				                            <label for="exampleCustomSelect" class="">Pathologies</label>
				                            <multiselect 
				                              v-model="form.pathologies" 
				                              :options="pathologies" 
				                              :multiple="true" 
				                              :close-on-select="false" 
				                              :clear-on-select="false" 
				                              :preserve-search="true" 
				                              placeholder="Choisir la ou les pathologies" 
				                              label="pathologie"
				                              track-by="id" 
				                              :preselect-first="false">
				                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
				                            </multiselect>                          
				                          </div>
				                        </div>
				                        <div class="col-md-12 mb-3">
				                          <div class="position-relative form-group">
				                            <label for="exampleCustomSelect" class="">Antécédents Stomatologiques</label>
				                            <multiselect 
				                              v-model="form.antecedents" 
				                              :options="antecedents" 
				                              :multiple="true" 
				                              :close-on-select="false" 
				                              :clear-on-select="false" 
				                              :preserve-search="true" 
				                              placeholder="Choisir la ou les Antécédents Stomatologiques" 
				                              label="nom" 
				                              track-by="id" 
				                              :preselect-first="false">
				                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
				                            </multiselect>   
				                          </div>
				                        </div>                              
				                    </div>
				                </div>
				            </div>
				          </div>
				        </div>
				      </div>

				        <div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
				            <input type="submit" value="MODIFIER" class="btn btn-success">
				        </div>  
				  </form>
              </div>
            </div>
        </div>
	</div>
</template>

<script>
	export default {
        props : {
            pathologies: {
                type: Array 
            },
            antecedents: {
                type: Array 
            },
			patient: Object,
			showinfos: Boolean,         
        },		
		data() {
            return {
                editMode : false,
                // Create a new form instance
                form: new Form({
                    id :'',
                    nom: '',
                    prenom: '',
                    date_naissance: '',
                    profession: '',
                    adresse : '',
                    sexe: '',
                    fumeur: '',
                    medecin_externe: '',
                    pathologies: [],
                    antecedents: [],
                })          
            }
		},
		methods : {
			updatePatient(patient) {
				this.form.fill(patient);
				$("#patient_update_modal").appendTo('body').modal("show"); 
			},
			updatedPatient() {
				this.form.put('/patient/'+this.form.id)
					.then((response) => {
						$('#patient_update_modal').modal('hide');
						this.$toaster.success("Patient modifier avec succées!")
						this.$emit('updated-patient' , response.data.patient)
						this.form.reset();
					})
					.catch((errors ) =>{
						this.$toaster.error(errors.response.data.message )
					});				
			}
		},
		mounted() {
			console.log("Informations Component mounted")
			$('[data-toggle="tooltip"]').tooltip()
		},
	}
</script>
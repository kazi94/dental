<template>  
<<<<<<< HEAD
  <div>
      <div class="main-card card mb-3">
        <div class="card-header">
            <h5 class="card-title">Liste des patients</h5>
        </div >       
          <div class="card-body">
=======
  <div class="col-md-3">
      <div class="main-card card">
          <div class="card-body"><h5 class="card-title">Liste des patients</h5>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
              <div class="table-responsive">
                  <table class="mb-0 table patients_table table table-striped table-bordered">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Patient</th>
                          <th>Sexe</th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr 
                        :class="{ active_row : activeClass == patient.id }"
                        style="cursor: pointer;"
                        v-on:click="showSelectedPatient(patient)"  
                        v-for="(patient,index) in patients">
                          <td>{{ index+1 }}</td>
                          <td>{{ patient.nom }} {{ patient.prenom }}</td>
                          <td>{{ patient.sexe }}</td>
                        </tr>
                      </tbody>
                  </table>
              </div>
<<<<<<< HEAD
              <button class="float-right btn btn-primary mt-1 rounded-0" @click="openModal" data-toggle="tooltip" data-placement="bottom" title="Cliquer pour voir la liste de vos patients en détails">Plus de détails</button>
=======
              <button class="float-right btn btn-primary mt-1" @click="openModal" data-toggle="tooltip" data-placement="bottom" title="Cliquer pour voir la liste de vos patients en détails">Plus de détails</button>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
          </div>
      </div>

      <div class="modal fade liste_patients_modal" tabindex="-1" id="liste_patients_modal"  role="dialog" aria-labelledby="listePatients" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Liste des patients</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="mb-0 table patients_table_details table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Age</th>
                            <th>Adresse</th>
                            <th>Profession</th>
                            <th>Fumeur</th>
                            <th>Chirurgien référent</th>
<<<<<<< HEAD
                            <th></th>
=======
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                        </tr>
                        </thead>
                        <tbody>
                          <tr
                          :class="{ active_row : activeClass == patient.id }"
<<<<<<< HEAD
                          v-for="(patient,index) in patients">
=======
                          style="cursor: pointer;"
                          v-for="(patient,index) in patients"
                          v-on:click="showSelectedPatient(patient, 'true')" >
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                            <td>{{ index+1 }}</td>
                            <td>{{ patient.nom }}</td>
                            <td>{{ patient.prenom }}</td>
                            <td>{{ patient.sexe }}</td>
                            <td>{{ patient.date_naissance }} ans</td>
                            <td>{{ patient.adresse }}</td>
                            <td>{{ patient.profession }}</td>
                            <td>{{ patient.fumeur ? 'Oui' : 'Non' }}</td>
                            <td>{{ patient.medecin_externe }}</td>
<<<<<<< HEAD
                            <td>
                              <div class="mb-2 mr-2 btn-group">
                                  <button class="btn btn-outline-dark rounded-0" @click="showSelectedPatient(patient, 'true')"title="Détails">Voir le patient</button>
                                  <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-outline-dark rounded-0"><span class="sr-only">Toggle Dropdown</span></button>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                      <button type="button" tabindex="0" class="dropdown-item rounded-0" title="Supprimer le Patient" @click="removePatient(index, patient.id)">Supprimer</button>
                                  </div>
                              </div>                              
                            </td>
=======
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                          </tr>
                        </tbody>
                    </table>
                  </div>            
                </div>
              </div>
            </div> 
            <div class="modal-footer">
<<<<<<< HEAD
              <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">FERMER</button>
=======
              <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
            </div>         
          </div>
        </div>
      </div>
<<<<<<< HEAD
=======

>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
  </div>
</template>

<script>
  export default {
    props : [
    'patients',
    ],
    data () {
      return {
        id : '',
        activeClass : '',
        response : {},
      }
    },
    methods : {
      openModal () {
        $("#liste_patients_modal").appendTo('body').modal("show");
      },
      showSelectedPatient : function(patient , modal=false) {
        if (modal = 'true') $("#liste_patients_modal").modal('hide');
        this.activeClass = patient.id;
        console.log(patient)
         axios.get("/patient/"+patient.id).then((response) =>{
          this.response = response.data;
          
          this.$emit('patient-folder' , this.response);
         })
<<<<<<< HEAD
      },
      //remove removePatient 
      removePatient (index, id)
      {
          axios.delete('/patient/'+id)
            .then((response) =>{
                this.patients.splice(index,1);
                this.$toaster.success(response.data.success)
            })
            .catch((exception) => {
                this.$toaster.error(exception)
            });
      },

=======
      }
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
    },
    mounted(){
      // $(".patients_table").DataTable();
    }
  }
</script>
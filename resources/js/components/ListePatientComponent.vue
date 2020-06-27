<template>  
  <div class="col-md-3">
      <div class="main-card card">
          <div class="card-body"><h5 class="card-title">Liste des patients</h5>
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
              <button class="float-right btn btn-primary mt-1" @click="openModal" data-toggle="tooltip" data-placement="bottom" title="Cliquer pour voir la liste de vos patients en détails">Plus de détails</button>
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
                        </tr>
                        </thead>
                        <tbody>
                          <tr
                          :class="{ active_row : activeClass == patient.id }"
                          style="cursor: pointer;"
                          v-for="(patient,index) in patients"
                          v-on:click="showSelectedPatient(patient, 'true')" >
                            <td>{{ index+1 }}</td>
                            <td>{{ patient.nom }}</td>
                            <td>{{ patient.prenom }}</td>
                            <td>{{ patient.sexe }}</td>
                            <td>{{ patient.date_naissance }} ans</td>
                            <td>{{ patient.adresse }}</td>
                            <td>{{ patient.profession }}</td>
                            <td>{{ patient.fumeur ? 'Oui' : 'Non' }}</td>
                            <td>{{ patient.medecin_externe }}</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>            
                </div>
              </div>
            </div> 
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
            </div>         
          </div>
        </div>
      </div>

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
      }
    },
    mounted(){
      // $(".patients_table").DataTable();
    }
  }
</script>
<template>
      <div>
            <div class="row mb-1">
                  <div class="col-sm-9 h5">Utilisateurs</div>
                  <div class="col-sm-3"><button class="btn btn-primary mt-1 mb-1 rounded-0 pull-right" @click="showModal">Ajouter</button></div>
            </div>
            
            <table class="mb-0 table">
                  <thead>
                        <tr>
                              <td>#</td>
                              <th>Utilisateur</th>
                              <th>Email</th>
                              <th>Profession</th>
                              <th>Role</th>
                              <th>Actions</th>
                        </tr>
                  </thead>
                  <tbody>
                        <tr v-for="(val,index) in users">
                              <th scope="row">{{ index + 1 }}</th>
                              <td>Dr. {{  val.name }} {{ val.prenom }}</td>
                              <td>{{ val.email }}</td>
                              <td>{{ val.profession }}</td>
                              <td>{{ val.role.nom }}</td>
                              <td>
                                    <button class="btn btn-danger btn-icon btn-icon-only mr-2 rounded-0" @click="remove(val.id,index)" title="Supprimer">
                                          <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                    </button>
                                    <button class="btn btn-primary btn-icon btn-icon-only mr-2 rounded-0" @click="update(val)" title="Modifier">
                                          <i class="pe-7s-edit btn-icon-wrapper"> </i>
                                    </button>

                              </td>
                        </tr>
                  </tbody>
            </table>
<div class="modal fade"  tabindex="-1" id="user_modal"  role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-if="!editMode">Nouvelle Utilisateur</h5>
                <h5 class="modal-title" v-else>Modifier Utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form class="needs-validation" novalidate="" @submit.prevent="editMode ? updateUser()  : createUser()" enctype="multipart/form-data" autocomplete="off">
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Nom*</label>
                                <input v-model="form.name" type="text" class="form-control" placeholder="Nom"  required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Prénom*</label>
                                <input v-model="form.prenom" type="text" class="form-control"  placeholder="Prénom" required="" autocomplete="off">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Email*</label>
                                <input v-model="form.email" type="email" class="form-control"  placeholder="Exemple : mohamed@email.com" required="" autocomplete="off">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">Profession*</label>
                                <input v-model="form.profession" type="text" class="form-control" placeholder="profession" required="">
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3" v-show="!editMode">
                                <label for="validationCustom04">Mots de passe*</label>
                                <input v-model="form.password" type="password" class="form-control" placeholder="Mots de passe" required="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="position-relative form-group">
                                    <label for="exampleSelect" class="">Role*</label>
                                    <select name="role"  class="form-control" v-model="form.role" required>
                                        <option v-for="val in roles" :key="val.id" :value="val.id">{{ val.nom }}</option>
                                    </select>
                                </div>
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

	export default 
    {
		props : [

		],
		data() {
			return {
                editMode : false,
                roles : [],
                users : [],
                id : '',
                // Create a new form instance
                form: new Form({
                    name: '',
                    prenom: '',
                    profession: '',
                    email: '',
                    password: '',
                    role: '',
                })
            };
		},
		methods : {
            showModal() {
                axios.get('/admin/role')
                    .then( (response) => {
                        this.roles= response.data;
                    });
                this.form.reset();
                $("#user_modal").appendTo('body').modal("show");
            },
            createUser()
            {
                axios.post( '/admin/user', this.form)
                .then((response) =>
                {
                    this.users.push(response.data);
                    this.form.reset();
                    $("#user_modal").modal("hide");
                    this.$toaster.success("Utilisateur ajoutée !");
                })
                .catch((exception) =>
                {
                    this.$toaster.error(exception);
                })
            },
            remove(id , index)
            {

                axios.delete('/admin/user/'+id)
                    .then((response) =>{
                        this.users.splice(index,1);
                    })
                    .catch((exception) => {
                        this.$toaster.error(exception)
                    });
            },

            update (user) 
            {
                this.form.fill(user);
                this.form.role = user.role.id;
                this.id = user.id;
                this.editMode = true;
                axios.get('/admin/role')
                    .then( (response) => {
                        this.roles= response.data;
                    })
                $("#user_modal").appendTo('body').modal("show"); 
            },

            updateUser (){
                axios.put('/admin/user/'+this.id , this.form)
                    .then( (response) =>{
                        $.each(this.users , (index, val) => {
                            if (val.id  == this.id)
                                val = this.form;
                        })
                        this.form.reset();
                        $("#user_modal").modal("hide");
                        this.editMode = false;
                    })
                    .catch ( (exception) =>{
                        this.$toaster.error(exception)
                    })
            }
		},
        computed: {

        },
		mounted() {
			console.log("Users Component mounted")

            axios.get( '/admin/user')
                .then((response) =>
                {
                    this.users = response.data;
                })
                .catch((exception) =>
                {
                  this.$toaster.error(exception);
                });
		},
	}


</script>

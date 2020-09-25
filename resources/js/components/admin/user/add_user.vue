<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/user">User</router-link></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Role</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="createUser">

                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="userData.name" class="form-control" id="name" placeholder="Enter User Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="text" v-model="userData.email" class="form-control" id="email" placeholder="Enter User Email">
                        <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" v-model="userData.password" class="form-control" id="password" placeholder="Enter User Password">
                        <div class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation :</label>
                        <input type="password" v-model="userData.password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter User Password Confirmation">
                        <div class="invalid-feedback" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="role">Role :</label>
                        <select name="role" id="role" v-model="userData.role" class="form-control">
                            <option value="">Select Role</option>
                            <option v-for="(role,index) in roles" :value="role.id">{{ role.name }}</option>
                        </select>

                        <div class="invalid-feedback" v-if="errors.role">{{ errors.role[0] }}</div>
                    </div>

                    <router-link to="/user" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>

    import * as userServices from '../../../services/user_services';

    export default{
        name: 'add_user',
        data(){
            return{
                userData:{
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: ''
                },

                roles: [],

                errors: {},
            }
        },

        mounted(){
          this.loadRole();
        },

        methods: {
            loadRole: async function(){
                try {
                    const response = await userServices.getRole();
                    this.roles = response.data.roles;
                }catch (error){
                    console.log(error);
                }
            },

            createUser: async function(){
                try {

                    this.errors = '';

                    let formData = new FormData();
                    formData.append('name', this.userData.name);
                    formData.append('email', this.userData.email);
                    formData.append('password', this.userData.password);
                    formData.append('password_confirmation', this.userData.password_confirmation);
                    formData.append('role', this.userData.role);

                    const response = await userServices.createUser(formData);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.userData.name = '';
                    this.userData.email = '';
                    this.userData.password = '';
                    this.userData.password_confirmation = '';
                    this.userData.role = '';

                }catch (error){
                    switch (error.response.status){
                        case 422:
                            this.errors = error.response.data.errors;
                            break;

                        default:
                            this.$swal.fire({
                                icon: 'error',
                                text: 'Oops',
                                title: error.response.data.message,
                            });
                        break;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
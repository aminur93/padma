<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/role">Role</router-link></li>
                            <li class="breadcrumb-item active">Add Role</li>
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
                <form v-on:submit.prevent="createRole">

                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="roleData.name" class="form-control" id="name" placeholder="Enter Role Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <strong>Permission:</strong>
                    <br/>

                    <div class="row">
                        <div class="col-md-6" v-for="(per,index) in permissions">
                            <label>
                                <input type="checkbox" v-model="roleData.permission" :value="per.id">{{ per.name }}
                            </label>
                        </div>
                    </div>

                    <router-link to="/role" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as roleServices from '../../../services/role_services';

    export default{
        name: 'add_role',
        data(){
            return{
                roleData:{
                    name: '',
                    permission: []
                },
                errors: {},
                permissions: [],
                data: {},
            }
        },

        mounted(){
            this.loadPermission();
        },
        
        methods: {
            createRole: async function () {
                try{

                    let formData = new FormData();
                    formData.append('name', this.roleData.name);
                    formData.append('permission', this.roleData.permission);

                    const response = await roleServices.createRole(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.roleData.name = '';
                    this.roleData.permission = '';

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
            },

            loadPermission: async function(){
                try {
                    const response = await roleServices.getPermission();
                    this.permissions = response.data.permission;
                }catch(error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
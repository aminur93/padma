<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home/role">Role</router-link></li>
                            <li class="breadcrumb-item active">Edit Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Role</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="updateRole">

                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="editRoleDataName.name" class="form-control" id="name" placeholder="Enter Role Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <strong>Permission:</strong>
                    <br/>

                    <div class="row">
                        <div class="col-md-6" v-for="(per,index) in permissions" :key="index">
                            <label>
                                <input type="checkbox" v-model="editPermissionDataName" :value="per.id">{{ per.name }}
                            </label>
                        </div>
                    </div>

                    <router-link to="/home/role" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as roleServices from '../../../services/role_services';
    export default{
        name: 'edit_role',
        data(){
            return{
                editRoleDataName:{},

                editPermissionDataName: [],

                permissions: [],
                errors: {},
            }
        },

        mounted(){
            this.loadPermission();
            this.loadAllData();
        },



        methods: {
            loadPermission: async function(){
                try {
                    const response = await roleServices.getPermission();
                    this.permissions = response.data.permission;
                }catch(error){
                    console.log(error);
                }
            },

            loadAllData: async function(){
                try {
                    let id = this.$route.params.id;

                    const response = await roleServices.getAllData(id);
                    console.log(response);
                    this.editRoleDataName = response.data.roles;

                    this.editPermissionDataName = response.data.rolePermission;

                }catch (error){
                    console.log(error);
                }
            },


            updateRole: async function(){
                try{
                    let id = this.$route.params.id;

                    let formData = new FormData();
                    formData.append('name', this.editRoleDataName.name);
                    formData.append('permission', this.editPermissionDataName);

                    const response = await roleServices.updateRole(id, formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllData();

                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
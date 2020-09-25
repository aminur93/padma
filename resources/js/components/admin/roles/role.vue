<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Role Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_role" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Role
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(role,index) in roles" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ role.rname }}</td>
                                <td>{{ role.pname }}</td>
                                <td>
                                    <router-link :to="`/edit_role/${role.id}`" class="btn btn-info"><i class="fa fa-edit"></i></router-link>
                                    <button class="btn btn-danger" v-on:click="deleteRole(role)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Role Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as roleServices from '../../../services/role_services';

    export default{
        name: 'role',
        data(){
            return{
                roles: [],
            }
        },

        mounted(){
            this.loadRoles();
        },

        methods: {
            loadRoles: async function(){
                try {
                    const response = await roleServices.getRole();
                    console.log(response);
                    this.roles = response.data.roles;
                }catch (error){
                    console.log(error);
                }
            },

            deleteRole: async function(role){
                try{
                    const response = await roleServices.deleteRoles(role.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadRoles();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
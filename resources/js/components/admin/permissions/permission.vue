<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Permission</li>
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
                    <h3 class="card-title">Permission Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_permission" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Permission
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(permission,index) in permissions" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ permission.name }}</td>
                                <td>
                                    <router-link :to="`/edit_permission/${permission.id}`" class="btn btn-info"><i class="fa fa-edit"></i></router-link>
                                    <button class="btn btn-danger" v-on:click="deletePermission(permission)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Permission Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as permissionServices from '../../../services/permission_services';

    export default{
        name: 'permission',
        data(){
            return{
                permissions: [],
            }
        },

        mounted(){
          this.loadPermission();
        },

        methods: {
            loadPermission: async function(){
                try{
                    const response = await permissionServices.loadPermission();
                    this.permissions = response.data.permission;

                }catch (error){
                    console.log(error);
                }

            },

            deletePermission: async function(permission)
            {
                try{
                    const response = await permissionServices.deletePermission(permission.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadPermission();
                }catch (error){

                }
            }
        }
    }
</script>

<style>

</style>
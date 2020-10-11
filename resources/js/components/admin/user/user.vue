<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">User</li>
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
                    <h3 class="card-title">User Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_user" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New User
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(user,index) in users" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ user.uname }}</td>
                                <td>{{ user.rname }}</td>
                                <td>
                                    <router-link :to="`/edit_user/${user.id}`" class="btn btn-info"><i class="fa fa-edit"></i></router-link>
                                    <button class="btn btn-danger" v-on:click="deleteUser(user)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    User Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as userServices from '../../../services/user_services';

    export default{
        name: 'user',
        data(){
            return{
                users: []
            }
        },

        mounted(){
            this.loadUsers();
        },

        methods: {
            loadUsers: async function(){
                try{
                    const response = await userServices.getUser();
                    console.log(response);
                    this.users = response.data.users;

                }catch (error){
                    console.log(error);
                }
            },

            deleteUser: async function(user){
                try {
                    const response = await userServices.deleteUsers(user.id);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadUsers();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
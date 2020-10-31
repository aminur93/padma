<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/permission">Permission</router-link></li>
                            <li class="breadcrumb-item active">Edit Permission</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Permission</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="updatePermission">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="editPermissionData.name" class="form-control" id="name" placeholder="Enter Permission Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <router-link to="/home/permission" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as permissionServices from '../../../services/permission_services';
    export default{
        name: 'editpermission',
        data(){
            return{
                editPermissionData:{},
                errors: {},
                id: '',
            }
        },

        mounted(){
            this.loadEditPermission();
        },

        methods: {
            loadEditPermission: async function(){
                try{
                    let id = this.$route.params.id;
                    //console.log(id);
                    const response = await permissionServices.editPermission(id);
                    this.editPermissionData = response.data.permission;

                }catch (error){
                    console.log(error);
                }

            },

            updatePermission: async function(){
                try{
                    let id = this.$route.params.id;

                    let formData = new FormData();
                    formData.append('name', this.editPermissionData.name);
//                    formData.append('_method','put');

                    const response = await permissionServices.update(id, formData);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadEditPermission();
                }catch (error){
                    this.$swal.fire({
                        icon: 'error',
                        text: 'Oops',
                        title: error.response.data.message,
                    });
                }
            }
        }
    }
</script>

<style>

</style>
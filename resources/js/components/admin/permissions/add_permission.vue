<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/permission">Permission</router-link></li>
                            <li class="breadcrumb-item active">Add Permission</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Permission</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="createPermission">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="permissionData.name" class="form-control" id="name" placeholder="Enter Permission Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <router-link to="/home/permission" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as permissionServices from '../../../services/permission_services';

    export default{
        name: 'add',
        data(){
            return{
                permissionData: {
                    name: ''
                },
                errors: {},
            }
        },

        methods: {

            createPermission: async function()
            {
                try {
                    let formData = new FormData();
                    formData.append('name', this.permissionData.name);

                    const response = await permissionServices.addPermission(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.permissionData.name = '';
                }catch (error){
                    switch (error.response.status)
                    {
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

<style>

</style>
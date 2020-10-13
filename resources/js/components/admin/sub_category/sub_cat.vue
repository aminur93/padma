<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Sub Category</li>
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
                    <h3 class="card-title">Sub Category Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_sub_cat" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Sub Category
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(subCat, index) in subCategories" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ subCat.name }}</td>
                                <td>{{ subCat.sub_cat_name}}</td>
                                <td>
                                    <router-link :to="`/edit_sub_vat/${subCat.id}`" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></router-link>
                                    <button v-on:click="deleteSubCate(subCat)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Sub Category Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as SubCatServices from '../../../services/subCatServices';

    export default{
        name: 'sub_categories',
        data(){
            return{
                subCategories: [],
            }
        },

        mounted(){
            this.loadSubCategories();
        },

        methods: {
            loadSubCategories: async function(){
                try {
                    const response = await SubCatServices.getData();
                    this.subCategories = response.data.sub_cat;
                }catch (error){
                    console.log(error);
                }
            },

            deleteSubCate: async function(subCat){
                try {
                    const response = await SubCatServices.deleteSubCat(subCat.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadSubCategories();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
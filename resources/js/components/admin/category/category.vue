<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Category</li>
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
                    <h3 class="card-title">Category Management</h3>

                    <div class="card-tools">
                        <router-link to="/add" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Category
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(category,index) in categories" :key="index">
                                <th>{{ index + 1}}</th>
                                <th>{{ category.name }}</th>
                                <th>
                                    <router-link :to="`/edit_category/${category.id}`" class="btn btn-info"><i class="fa fa-edit"></i></router-link>
                                    <button v-on:click="deleteCategory(category)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Category Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    import * as categoryServices from '../../../services/category_services';
    import DataTable from '../../datatable/DataTable.vue';
    import Pagination from '../../datatable/pagination.vue';

    export default{
        name: 'category',
        components: { datatable: DataTable, pagination: Pagination },
        data(){

            return {
                categories: [],
            }
        },

        mounted()
        {
            this.loadCategory();
        },

        methods: {

            loadCategory: async function(){
                try{
                    const response = await categoryServices.loadcategory();
                    this.categories = response.data.category;

                }catch (error){
                    console.log(error);
                }
            },

            deleteCategory: async function(category)
            {
                try {
                    const response = await categoryServices.deleteCategories(category.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadCategory();
                }catch (error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
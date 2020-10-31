<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home/sub_categories">Sub Category</router-link></li>
                            <li class="breadcrumb-item active">Add Sub Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Sub Category</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="createSubCategory">

                    <div class="form-group">
                        <label for="cat_id">Category Name: </label>
                        <select name="category_id" id="cat_id" v-model="subCategoryData.category_id" class="form-control">
                            <option value="">Select Categories</option>
                            <option v-for="(category,index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_cat_name">Sub Categories: </label>
                        <input type="text" v-model="subCategoryData.sub_cat_name" class="form-control" id="sub_cat_name" placeholder="Enter Sub Categories Name">
                        <div class="invalid-feedback" v-if="errors.sub_cat_name">{{ errors.sub_cat_name[0] }}</div>
                    </div>

                    <router-link to="/home/sub_categories" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as SubCatServices from '../../../services/subCatServices';

    export default{
        name: 'add_sub_cat',
        data(){
            return{
                subCategoryData: {
                    category_id: '',
                    sub_cat_name: '',
                },
                errors: {},
                categories: [],
            }
        },

        mounted(){
          this.loadCategories();
        },

        methods: {
            loadCategories: async function(){
                try {
                    const response = await SubCatServices.getAllCat();
                    this.categories = response.data.category;
                }catch (error){
                    console.log(error);
                }
            },

            createSubCategory: async function(){
                try {
                    let formData = new FormData();
                    formData.append('category_id', this.subCategoryData.category_id);
                    formData.append('sub_cat_name', this.subCategoryData.sub_cat_name);

                    const response = await SubCatServices.createSubCat(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.subCategoryData.category_id = '';
                    this.subCategoryData.sub_cat_name = '';

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

<style scoped>

</style>
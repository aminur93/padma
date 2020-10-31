<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/category">Category</router-link></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="updateCategory">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" v-model="editCategoryData.name" class="form-control" id="name" placeholder="Enter Category Name">
                        <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                    </div>

                    <router-link to="/home/category" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>

    import * as categoryServices from '../../../services/category_services';

    export default {
        name: 'edit_category',
        data(){
            return{
                editCategoryData: {},
                errors: {},
            }
        },

        mounted(){
            this.loadCategories();
        },

        methods: {

            loadCategories: async function(){
                try{
                    let id = this.$route.params.id;
                    const response = await categoryServices.getEditCategory(id);
                    this.editCategoryData = response.data.category;
                }catch (error){
                    console.log(error);
                }
            },

            updateCategory: async function(){
                try {
                    let id = this.$route.params.id;
                    let formData = new FormData();
                    formData.append('name', this.editCategoryData.name);

                    const response = await categoryServices.updateCategory(id, formData);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.loadCategories();
                }catch (error){
                    switch (error.response.status)
                    {
                        case 500:
                            this.$swal.fire({
                                icon: 'error',
                                text: 'Oops',
                                title: error.response.data.message,
                            });
                            break;

                        default:
                            this.$swal.fire({
                                icon: 'error',
                                text: 'Oops',
                                title: 'Something Went Wrong',
                            });
                            break;
                    }
                }
            }
        }
    }
</script>
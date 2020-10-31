<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Blog Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/blog_post">Blog Post</router-link></li>
                            <li class="breadcrumb-item active">Add Blog Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Blog Post</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="createBlogPost">

                    <div class="form-group">
                        <label for="category_id">Category :</label>
                        <select class="form-control" name="category_id" id="category_id" v-model="blogPostData.category_id"  v-on:change='getSubCategory()'>
                            <option value="">Select Category</option>
                            <option v-for="(category,index) in categories" :value="category.id">{{ category.name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_cat_id">Sub Category :</label>
                        <select class="form-control" name="sub_cat_id" id="sub_cat_id" v-model="blogPostData.sub_cat_id">
                            <option value="">Select Sub Category</option>
                            <option v-for="(subCat, index) in subCategories" :value="subCat.id">{{ subCat.sub_cat_name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tag_id">Tag : </label>
                        <select class="form-control" name="tag_id" id="tag_id" v-model="blogPostData.tag_id">
                            <option value="">Select Tag</option>
                            <option v-for="(tag,index) in tags" :value="tag.id">{{ tag.tag_name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Title :</label>
                        <input type="text" v-model="blogPostData.title" class="form-control" id="name" placeholder="Enter Title">
                        <div class="invalid-feedback" v-if="errors.title">{{ errors.title[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description : </label>
                        <textarea class="textarea form-control" id="description" v-model="blogPostData.description" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        <div class="invalid-feedback" v-if="errors.description">{{ errors.description[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" class="form-control" id="image" v-on:change="attachImage" ref="newBlogImage">
                        <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
                        <br>
                        <div v-if="blogPostData.image.name">
                            <img src="" ref="newBlogImageDisplay" class="w-150px">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" v-model="blogPostData.status"> Status
                            </label>

                            <label class="ml-4">
                                <input type="checkbox" v-model="blogPostData.publish"> Publish
                            </label>

                            <label class="ml-4">
                                <input type="checkbox" v-model="blogPostData.feature"> Feature
                            </label>
                        </div>
                    </div>

                    <router-link to="/home/blog_post" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    import * as blogServices from '../../../services/blog_services';

    export default{
        name: 'add_post',
        data(){
            return{
                blogPostData: {
                    category_id: '',
                    sub_cat_id: '',
                    tag_id: '',
                    title: '',
                    description: '',
                    image: '',
                    status: '',
                    publish: '',
                    feature: '',
                },

                categories: [],
                subCategories: [],
                tags: [],

                errors: {},
            }
        },

        created(){
            this.loadAllCategory();
        },

        mounted(){
            this.loadAllTag();
        },

        methods: {
            loadAllCategory: async function(){
                try{
                    const response = await blogServices.getCategory();
                    this.categories = response.data.category;
                }catch (error){
                    console.log(error);
                }
            },

            getSubCategory: async function(){
                let category_id = this.blogPostData.category_id;
                try {
                    const response = await blogServices.getSubcategory(category_id);
                    this.subCategories = response.data.subcategory;

                    this.blogPostData.sub_cat_id = '';
                }catch (error){
                    console.log(error);
                }
            },

            loadAllTag: async function(){
                try {
                    const response = await blogServices.getTag();
                    this.tags = response.data.tag;
                }catch (error){
                    console.log(error);
                }
            },

            attachImage: function(){
                //to use some file todo
                this.blogPostData.image = this.$refs.newBlogImage.files[0];
                let reader = new FileReader();
                reader.addEventListener('load', function () {
                    this.$refs.newBlogImageDisplay.src = reader.result;
                }.bind(this),false);

                reader.readAsDataURL(this.blogPostData.image);
            },

            createBlogPost: async function(){
                try{
                    let formData = new FormData();
                    formData.append('category_id', this.blogPostData.category_id);
                    formData.append('sub_cat_id', this.blogPostData.sub_cat_id);
                    formData.append('tag_id', this.blogPostData.tag_id);
                    formData.append('title', this.blogPostData.title);
                    formData.append('description', this.blogPostData.description);
                    formData.append('image', this.blogPostData.image);
                    formData.append('status', this.blogPostData.status);
                    formData.append('publish', this.blogPostData.publish);
                    formData.append('feature', this.blogPostData.feature);

                    const response = await blogServices.storeBlog(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.blogPostData = {
                            category_id: '',
                            sub_cat_id: '',
                            tag_id: '',
                            title: '',
                            description: '',
                            image: '',
                            status: '',
                            publish: '',
                            feature: '',
                    }

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
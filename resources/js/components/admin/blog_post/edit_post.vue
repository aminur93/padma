<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Blog Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/blog_post">Blog Post</router-link></li>
                            <li class="breadcrumb-item active">Edit Blog Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Blog Post</h3>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="updateBlogPost">

                    <div class="form-group">
                        <label for="category_id">Category :</label>
                        <select class="form-control" name="category_id" id="category_id" v-model="editBlogPostData.category_id"  v-on:change='getSubCategory()'>
                            <option value="">Select Category</option>
                            <option v-for="(category,index) in categories" :value="category.id">{{ category.name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_cat_id">Sub Category :</label>
                        <select class="form-control" name="sub_cat_id" id="sub_cat_id" v-model="editBlogPostData.sub_cat_id">
                            <option value="">Select Sub Category</option>
                            <option v-for="(sub_Cat, index) in subCat" :value="sub_Cat.id" v-if="editBlogPostData.category_id == sub_Cat.category_id ? true : false">{{ sub_Cat.sub_cat_name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tag_id">Tag : </label>
                        <select class="form-control" name="tag_id" id="tag_id" v-model="editBlogPostData.tag_id">
                            <option value="">Select Tag</option>
                            <option v-for="(tag,index) in tags" :value="tag.id">{{ tag.tag_name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Title :</label>
                        <input type="text" name="title" v-model="editBlogPostData.title" class="form-control" id="name" placeholder="Enter Title">
                        <div class="invalid-feedback" v-if="errors.title">{{ errors.title[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description : </label>
                        <textarea class="textarea form-control" name="description" id="description" v-model="editBlogPostData.description" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        <div class="invalid-feedback" v-if="errors.description">{{ errors.description[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" class="form-control" name="image" id="image" v-on:change="editAttachImage" ref="editBlogImage">
                        <input type="hidden" name="current_image" :value="editBlogPostData.image">
                        <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
                        <br>
                        <div>
                            <img :src="editImage(editBlogPostData.image)" ref="editBlogImageDisplay" class="w-150px">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="blog_status" id="blog_status" v-model="editBlogPostData.blog_status" :value="this.editBlogPostData.blog_status == false ? 0 : 1"> Status
                            </label>

                            <label class="ml-4">
                                <input type="checkbox" name="publish" id="publish" v-model="editBlogPostData.publish" :value="this.editBlogPostData.publish == false ? 0 : 1"> Publish
                            </label>

                            <label class="ml-4">
                                <input type="checkbox" name="feature" id="feature" v-model="editBlogPostData.feature" :value="this.editBlogPostData.feature == false ? 0 : 1"> Feature
                            </label>
                        </div>
                    </div>

                    <router-link to="/home/blog_post" class="btn btn-info">Back</router-link>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script>

    import * as blogServices from '../../../services/blog_services';

    export default{
        name: 'edit_post',
        data(){
            return{
                editBlogPostData: {},
                errors: {},
                categories: [],
                subCategories: [],
                subCat: [],
                tags: [],
            }
        },

        created(){
            this.loadAllCategory();

        },

        mounted(){
            this.loadAllTag();
            this.loadAllSubcat();
            this.loadEditBlogPost();
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

            loadAllSubcat: async function(){
                try {
                    const response = await blogServices.Subcat();
                    this.subCat = response.data.subCat;
                }catch (error){
                    console.log(error);
                }
            },

            getSubCategory: async function(){
                let category_id = this.editBlogPostData.category_id;
                try {
                    const response = await blogServices.getSubcategory(category_id);
                    this.subCategories = response.data.subcategory;

                    this.editBlogPostData.sub_cat_id = '';
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

            loadEditBlogPost: async function(){
                let id = this.$route.params.id;

                try {
                    const response = await blogServices.getEditBlogPost(id);
                    this.editBlogPostData = response.data.edit_blog;
                }catch (error){
                    console.log(error);
                }
            },

            editAttachImage: async function(){
                this.editBlogPostData.image = this.$refs.editBlogImage.files[0];
                let reader = new FileReader();
                reader.addEventListener('load', function () {
                    this.$refs.editBlogImageDisplay.src = reader.result;
                }.bind(this),false);

                reader.readAsDataURL(this.editBlogPostData.image);
            },

            editImage(img){
                return "/assets/admin/uploads/original_image/"+img;
            },

            updateBlogPost: async function(){
                let id = this.$route.params.id;

                try {
                    let formData = new FormData();

                    formData.append('category_id', this.editBlogPostData.category_id);
                    formData.append('sub_cat_id', this.editBlogPostData.sub_cat_id);
                    formData.append('tag_id', this.editBlogPostData.tag_id);
                    formData.append('title', this.editBlogPostData.title);
                    formData.append('description', this.editBlogPostData.description);
                    formData.append('image', this.editBlogPostData.image);
                    formData.append('current_image', this.editBlogPostData.image);
                    formData.append('blog_status', this.editBlogPostData.blog_status);
                    formData.append('publish', this.editBlogPostData.publish);
                    formData.append('feature', this.editBlogPostData.feature);

                    const response = await blogServices.updateBlog(id, formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadEditBlogPost();

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
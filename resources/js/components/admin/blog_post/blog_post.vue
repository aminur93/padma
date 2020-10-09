<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Blog Post</li>
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
                    <h3 class="card-title">Blog Post Management</h3>

                    <div class="card-tools">
                        <router-link to="/add_post" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Blog Post
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Tag</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Publish</th>
                            <th>Feature</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(blog,index) in blogPosts" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <img :src="showImage(blog.image)" alt="" style="width: 50px;">
                                </td>
                                <td>{{ blog.cname }}</td>
                                <td>{{ blog.sub_cat_name }}</td>
                                <td>{{ blog.tag_name }}</td>
                                <td>{{ blog.uname }}</td>
                                <td>
                                    <template v-if="blog.blog_status == 1">
                                        <span class="badge badge-success">Approved</span>
                                    </template>
                                    <template v-else>
                                        <span class="badge badge-danger">Not Approved</span>
                                    </template>
                                </td>
                                <td>
                                    <template v-if="blog.publish == 1">
                                        <span class="badge badge-success">Published</span>
                                    </template>
                                    <template v-else>
                                        <span class="badge badge-danger">Not Published</span>
                                    </template>
                                </td>
                                <td>
                                    <template v-if="blog.feature == 1">
                                        <span class="badge badge-success">Feature</span>
                                    </template>
                                    <template v-else>
                                        <span class="badge badge-danger">Not Feature</span>
                                    </template>
                                </td>
                                <td>
                                    <router-link :to="`/edit_post/${blog.id}`" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></router-link>

                                    <button v-if="blog.blog_status == 0" v-on:click="approve(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-check"></i></button>
                                    <button v-if="blog.blog_status == 1" v-on:click="Unapprove(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i></button>
                                    <button v-if="blog.publish == 0" v-on:click="publish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-newspaper"></i></button>
                                    <button v-if="blog.publish == 1" v-on:click="Unpublish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-times"></i></button>
                                    <button v-if="blog.feature == 0" v-on:click="feature(blog)" class="btn btn-light btn-sm"><i class="fa fa-star"></i></button>
                                    <button v-if="blog.feature == 1" v-on:click="Unfeature(blog)" class="btn btn-light btn-sm"><i class="fa fa-times"></i></button>
                                    <button v-on:click="deleteBlog(blog)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Blog Post Management
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</template>

<script>

    import * as blogServices from '../../../services/blog_services';

    export default{
        name: 'blog_post',
        data(){
            return{
                blogPosts: [],
            }
        },

        mounted(){
            this.loadAllBlogPost();
        },

        methods: {
            loadAllBlogPost: async function(){
                try {
                    const response = await blogServices.getBlogPost();
                    this.blogPosts = response.data.blog_post;
                }catch (error){
                    console.log(error);
                }
            },

            showImage(img){
                return "/assets/admin/uploads/original_image/"+img;
            },

            deleteBlog: async function(blog){
                try{
                    const response = await blogServices.deleteBlogPost(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch (error){
                    console.log(error);
                }
            },

            approve: async function(blog){
                try {
                    const response = await blogServices.approve(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch(error){
                    console.log(error);
                }
            },

            Unapprove: async function(blog){
                try{
                    const response = await blogServices.unApprove(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch(error){
                   console.log(error);
                }
            },

            publish: async function(blog){
                try {
                    const response = await blogServices.publish(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch (error){
                    console.log(error);
                }
            },

            Unpublish: async function(blog){
                try{
                    const response = await blogServices.unPublish(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch (error){
                    console.log(error);
                }
            },

            feature: async function(blog){
                try {
                    const response = await blogServices.feature(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch(error){
                    console.log(error);
                }
            },

            Unfeature: async function(blog){
                try {
                    const response = await blogServices.unFeature(blog.id);
                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.loadAllBlogPost();
                }catch(error){
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ categoryCount }}</h3>

                        <p>Total Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <router-link to="/category" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ tagCount }}</h3>

                        <p>Total Tag</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-tags"></i>
                    </div>
                    <router-link to="/tag" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ userCount }}</h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <router-link to="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ blogCount }}</h3>

                        <p>Total Blogs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <router-link to="/blog_post" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Latest category</div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(category,index) in categories" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ category.name }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Latest Tags</div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Tag Name</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(tag,index) in tags" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ tag.tag_name }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Latest Blog</div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Total View</th>
                                    <th>Status</th>
                                    <th>Publish</th>
                                    <th>Feature</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(blog,index) in blogs" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ blog.title }}</td>
                                    <td>
                                        <span v-if="blog.view_count == null">0</span>
                                        <span v-else="blog.view_count != null">{{ blog.view_count}}</span>
                                    </td>
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
                                        <button v-if="blog.blog_status == 0" v-on:click="approve(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-check"></i></button>
                                        <button v-if="blog.blog_status == 1" v-on:click="Unapprove(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i></button>
                                        <button v-if="blog.publish == 0" v-on:click="publish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-newspaper"></i></button>
                                        <button v-if="blog.publish == 1" v-on:click="Unpublish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-times"></i></button>
                                        <button v-if="blog.feature == 0" v-on:click="feature(blog)" class="btn btn-light btn-sm"><i class="fa fa-star"></i></button>
                                        <button v-if="blog.feature == 1" v-on:click="Unfeature(blog)" class="btn btn-light btn-sm"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import * as categoryServices from '../../services/category_services';
    import * as TagServices from '../../services/tag_services';
    import * as userServices from '../../services/user_services';
    import * as blogServices from '../../services/blog_services';

    export default{
        name: 'home',
        data(){
            return{
                categoryCount:{},
                categories: [],
                tagCount:{},
                tags: [],
                userCount: {},
                blogCount: {},
                blogs: [],
            }
        },

        mounted(){
            this.getCountCategory();
            this.getCountTag();
            this.getCountUser();
            this.getCountBlog();
            this.getDash();
            this.getDashTag();
            this.getBlogDash();
        },

        methods:{
            getCountCategory: async function(){
                try {
                    const response = await categoryServices.getCount();
                    this.categoryCount = response.data.category_count;
                }catch (error){
                    console.log(error);
                }
            },

            getDash: async function(){
                try{
                    const response = await categoryServices.catDash();
                    this.categories = response.data.category_dash;
                }catch (error){
                    console.log(error);
                }
            },

            getCountTag: async function(){
                try{
                    const response = await TagServices.getTagCount();
                    this.tagCount = response.data.tag_count;
                }catch (error){
                    console.log(error);
                }
            },

            getDashTag: async function(){
                try {
                    const response = await TagServices.getTagDash();
                    this.tags = response.data.tag_dash;
                }catch (error){
                    console.log(error);
                }
            },

            getCountUser: async function(){
                try {
                    const response = await userServices.getUserCount();
                    this.userCount = response.data.user_count;
                }catch (error){
                    console.log(error);
                }
            },

            getCountBlog: async function(){
                try{
                    const response = await blogServices.getBlogCount();
                    this.blogCount = response.data.blog_count;
                }catch (error){
                    console.log(error);
                }
            },

            getBlogDash: async function(){
                try{
                    const response = await blogServices.getDashBlog();
                    this.blogs = response.data.blog_dash;
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

                    this.getBlogDash();
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

                    this.getBlogDash();
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

                    this.getBlogDash();
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

                    this.getBlogDash();
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

                    this.getBlogDash();
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

                    this.getBlogDash();
                }catch(error){
                    console.log(error);
                }
            }
        },
    }
</script>

<style>

</style>
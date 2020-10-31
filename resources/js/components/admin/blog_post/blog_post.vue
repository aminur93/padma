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
                        <router-link to="/home/add_post" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </router-link>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3">

                        <div class="float-left">
                            <label>
                                Show
                                <select name="example_length" aria-controls="example" v-model="tableData.length" @change="loadAllBlogPost()">
                                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                                </select>
                                entries
                            </label>
                        </div>

                        <div class="float-right">
                            <label for="">Search:
                                <input class="input" type="text" v-model="tableData.search" placeholder="Search Table" @input="loadAllBlogPost()">
                            </label>
                        </div>

                    </div>

                    <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                        <tbody>
                        <tr v-for="(blog,index) in blogPosts" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>
                                <img :src="showImage(blog.image)" alt="" style="width: 50px;">
                            </td>
                            <td>{{ blog.title }}</td>
                            <td>{{ blog.category }}</td>
                            <td>{{ blog.sub_category }}</td>
                            <td>{{ blog.tag }}</td>
                            <td>{{ blog.author }}</td>
                            <td>
                                <template v-if="blog.status == 1">
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
                                <router-link :to="`/home/edit_post/${blog.id}`" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></router-link>

                                <button v-if="blog.status == 0" v-on:click="approve(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-check"></i></button>
                                <button v-if="blog.status == 1" v-on:click="Unapprove(blog)" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i></button>
                                <button v-if="blog.publish == 0" v-on:click="publish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-newspaper"></i></button>
                                <button v-if="blog.publish == 1" v-on:click="Unpublish(blog)" class="btn btn-warning btn-sm"><i class="fa fa-times"></i></button>
                                <button v-if="blog.feature == 0" v-on:click="feature(blog)" class="btn btn-light btn-sm"><i class="fa fa-star"></i></button>
                                <button v-if="blog.feature == 1" v-on:click="Unfeature(blog)" class="btn btn-light btn-sm"><i class="fa fa-times"></i></button>
                                <button v-on:click="deleteBlog(blog)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </datatable>

                    <pagination :pagination="pagination" :offset="5" @paginate="loadAllBlogPost()" v-if="this.pagination.last_page > 1"></pagination>
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
    import DataTable from '../../datatable/DataTable.vue';
    import Pagination from '../../datatable/pagination.vue';

    export default{
        components: { datatable: DataTable, pagination: Pagination },
        name: 'blog_post',
        data(){
            let sortOrders = {};

            let columns = [
                {label: '#Sl', name: 'id' },
                {label: 'Image', name: 'image'},
                {label: 'Title', name: 'title'},
                {label: 'Category', name: 'category'},
                {label: 'Sub Category', name: 'sub_category'},
                {label: 'Tag', name: 'tag'},
                {label: 'Author', name: 'author'},
                {label: 'Status', name: 'status'},
                {label: 'Publish', name: 'publish'},
                {label: 'Feature', name: 'feature'},
                {label: 'Action', name: 'action'},
            ];

            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return{
                blogPosts: [],
                columns: columns,
                sortKey: 'id',
                sortOrders: sortOrders,
                perPage: ['10', '20', '30','25','50','100'],

                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
                },
                pagination: {
                    last_page: '',
                    current_page: 1,
                    total: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    from: '',
                    to: ''
                },
            }
        },

        mounted(){
            this.loadAllBlogPost();
        },

        methods: {
            loadAllBlogPost: async function(){
                this.tableData.draw++;
                try {
                    let params = new URLSearchParams();
                    params.append('page', this.pagination.current_page);
                    params.append('draw', this.tableData.draw);
                    params.append('length', this.tableData.length);
                    params.append('search', this.tableData.search);
                    params.append('column', this.tableData.column);
                    params.append('dir', this.tableData.dir);

                    const response = await blogServices.getBlogPost(params);
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.blogPosts = data.data.data;
                        this.configPagination(data.data);
                    }
                    //this.blogPosts = response.data.blog_post;
                }catch (error){
                    console.log(error);
                }
            },

            configPagination(data) {
                this.pagination.last_page = data.last_page;
                this.pagination.current_page = data.current_page;
                this.pagination.total = data.total;
                this.pagination.last_page_url = data.last_page_url;
                this.pagination.next_page_url = data.next_page_url;
                this.pagination.prev_page_url = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.loadAllBlogPost();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
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
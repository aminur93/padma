<template>
    <div>
        <!--Main Section-->
        <div class="card">
            <h5 class="card-header">Blogs</h5>
            <div class="card-body">
                <div v-for="(blog,index) in blogs" style="background-color: wheat;margin-top:10px;margin-bottom: 20px;">

                    <h3><router-link :to="`/single_blog/${blog.id}`">{{ blog.title }}</router-link></h3>
                    <p>{{ blog.description | shortlength(500,'...')}}</p>
                    <span>Author: {{ blog.uname }}</span> | <span>Category: {{ blog.cname }}</span> | <span>Tag: {{ blog.tag_name}}</span>

                </div>
            </div>
        </div>

        <pagination :pagination="pagination" :offset="5" @paginate="blogList()" v-if="this.pagination.last_page > 1"></pagination>
        <!--Main Section-->
    </div>
</template>

<script>
    import Pagination from './PaginationComponent.vue';

    import * as blogServices from '../../services/blog_services';

    export default{
        components:{
            pagination: Pagination,
        },
        name: 'user-home',
        data(){
            return{
                blogs: [],

                pagination: {
                    last_page: '',
                    current_page: 1,
                    total: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: '',
                    from: '',
                    to: ''
                }
            }
        },

        mounted(){

            this.blogList();
        },

        methods:{
            blogList: async function(){
                try {
                    const response = await blogServices.getLatestBlog(this.pagination.current_page);
                    let data = response.data;
                    this.blogs = response.data.blog_list.data;

                    this.configPagination(data.blog_list);
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

        },
    }
</script>

<style scoped>

</style>
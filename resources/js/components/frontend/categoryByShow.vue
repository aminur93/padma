<template>
    <div>

        <div class="card">
            <h5 class="card-header">Blogs</h5>
            <div class="card-body" v-if="categoryBlog.length > 0">
                <div v-for="(blog,index) in categoryBlog" style="background-color: wheat;margin-top:10px;margin-bottom: 20px;">

                    <h3><router-link :to="`/single_blog/${blog.id}`">{{ blog.title }}</router-link></h3>
                    <p>{{ blog.description | shortlength(500,'...')}}</p>
                    <span>Author: {{ blog.uname }}</span> | <span>Category: {{ blog.cname }}</span> | <span>Tag: {{ blog.tag_name}}</span>

                </div>
            </div>

            <div v-else="">No Data Found</div>
        </div>

        <pagination :pagination="pagination" :offset="5" @paginate="loadCategoryWiseBlog()" v-if="this.pagination.last_page > 1"></pagination>

    </div>
</template>

<script>
    import * as categoryServices from '../../services/category_services';
    import Pagination from './PaginationComponent.vue';
    export default{
        components:{
            pagination: Pagination,
        },
        name: 'category-blog',
        data(){
            return{
                categoryBlog: [],

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

        watch: {
            $route() {
                this.loadCategoryWiseBlog(this.$route.params.id);
            }
        },

        mounted(){
            this.loadCategoryWiseBlog();
        },

        methods: {
            loadCategoryWiseBlog: async function(){
                try {
                    let category_id = this.$route.params.id;

                    let params = new URLSearchParams();
                    params.append('categoryId', category_id);
                    params.append('page', this.pagination.current_page);

                    const response = await categoryServices.getCategoryIdByBlog(params);
                    let data = response.data;
                    this.categoryBlog = response.data.get_categoryId_by_blog.data;

                    this.configPagination(data.get_categoryId_by_blog);
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
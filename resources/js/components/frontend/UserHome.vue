<template>
    <div>
        <!--Navbar blue-->
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #263238;">
            <router-link style="color:white;" class="navbar-brand" to="/">Blog Vuejs</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link style="color:white;" class="nav-link waves-effect waves-light" to="/">Home
                            <span class="sr-only">(current)</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link style="color:white;" class="nav-link waves-effect waves-light" to="">About</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link style="color:white;" class="nav-link waves-effect waves-light" to="">Contact Us</router-link>
                    </li>
                </ul>
            </div>

            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search Now</button>
        </nav>
        <!--/.Navbar blue-->

        <!--Search Section-->
        <div class="container-fluid search">
            <div class="row">
                <div class="col-md-12">
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" v-model="search" class="form-control" placeholder="Search this blog">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <ul v-if="allSearchList.length > 0 && search">
                                    <li v-for="result in allSearchList.slice(0,10)">
                                        <div v-text="result.title"></div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Search Section-->
        <br>

        <!--Main Section-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <h5 class="card-header">Blogs</h5>
                                <div class="card-body">
                                    <div v-for="(blog,index) in blogs" style="background-color: wheat;margin-top:10px;margin-bottom: 20px;">

                                        <h3><router-link to="">{{ blog.title }}</router-link></h3>
                                        <p>{{ blog.description | shortlength(500,'...')}}</p>
                                        <span>Author: {{ blog.uname }}</span> | <span>Category: {{ blog.cname }}</span> | <span>Tag: {{ blog.tag_name}}</span>

                                    </div>
                                </div>
                            </div>

                            <pagination :pagination="pagination" :offset="5" @paginate="blogList()" v-if="this.pagination.last_page > 1"></pagination>
                        </div>

                        <div class="col-md-4">

                            <div class="card">
                                <h5 class="card-header">Category List</h5>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <ul class="cat_list">
                                                <li v-for="(category,index) in categories"><router-link to="" class="link">{{ category.name }} <span class="badge badge-primary badge-pill">12</span></router-link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Tag List</h5>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <ul class="cat_list">
                                                <li v-for="(tag,index) in tags"><router-link to="" class="link">{{ tag.tag_name }} <span class="badge badge-primary badge-pill">12</span></router-link></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Popular Post</h5>
                                <div class="card-body">
                                    <div v-for="(pop,index) in popular" style="background-color: wheat;margin:5px;">

                                        <h6><router-link to="">{{ pop.title }}</router-link></h6>
                                        <p>{{ pop.description | shortlength(50,'...') }}</p>
                                        <span>{{ pop.uname }}</span> | <span>{{ pop.cname }}</span> | <span>{{ pop.tag_name}}</span>

                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Recent Post</h5>
                                <div class="card-body">
                                    <div v-for="(rec,index) in recent" style="background-color: wheat;margin:5px;">

                                        <h6><router-link to="">{{ rec.title }}</router-link></h6>
                                        <p>{{ rec.description | shortlength(50,'...') }}</p>
                                        <span>{{ rec.uname }}</span> | <span>{{ rec.cname }}</span> | <span>{{ rec.tag_name}}</span>

                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Stay Connect</h5>
                                <div class="card-body">
                                    <a href=""><i class="fab fa-facebook-square" style="font-size: 40px;"></i></a>
                                    <a href=""><i class="fab fa-youtube-square" style="font-size: 40px;margin-left: 20px;"></i></a>
                                    <a href=""><i class="fab fa-twitter-square" style="font-size: 40px;margin-left: 20px;"></i></a>
                                    <a href=""><i class="fab fa-linkedin" style="font-size: 40px;margin-left: 20px;"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--Main Section-->
        <br>

        <!--Footer Section-->
        <footer class="footer">
            <div class="container bottom_border">
                <div class="row">
                    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Find us</h5>
                        <!--headin5_amrc-->
                        <p class="mb10">This blog use in vuejs tutorials. so here anyone can find any solutions about vuejs. vuejs is right now best javascript framework.</p>
                        <p><i class="fa fa-location-arrow"></i> 113/c sec 9 Road 35 </p>
                        <p><i class="fa fa-phone"></i>  +880-1772119941  </p>
                        <p><i class="fa fa fa-envelope"></i> aminur@example.com  </p>


                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Category</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li v-for="(category,index) in categories"><a href="">{{category.name}}</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Sub Category</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li v-for="(sub,index) in sub_cat"><a href="">{{ sub.sub_cat_name }}</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Follow us</h5>
                        <!--headin5_amrc ends here-->

                        <ul class="footer_ul2_amrc">
                            <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Here Please Like our twitter page ans stay connect<a href="#">https://www.twitter.com/</a></p></li>
                            <li><a href="#"><i class="fab fa-facebook fleft padding-right"></i> </a><p>Stay Connect with us on facebook and like our page<a href="#">https://www.facebook.com/</a></p></li>
                            <li><a href="#"><i class="fab fa-youtube fleft padding-right"></i> </a><p>You can find our all videos in our youtube channel<a href="#">https://www.youtube.com/</a></p></li>
                        </ul>
                        <!--footer_ul2_amrc ends here-->
                    </div>
                </div>
            </div>


            <div class="container">
                <ul class="foote_bottom_ul_amrc">
                    <li><router-link to="/">Home</router-link></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
                <!--foote_bottom_ul_amrc ends here-->
                <p class="text-center">Copyright @2020 | Designed With by <a href="#">AminurDevio.com</a></p>

                <ul class="social_footer_ul">
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
                <!--social_footer_ul ends here-->
            </div>

        </footer>
        <!--Footer Section-->
    </div>
</template>

<script>
    import Pagination from './PaginationComponent.vue';

    import * as categoryServices from '../../services/category_services';
    import * as TagServices from '../../services/tag_services';
    import * as blogServices from '../../services/blog_services';
    import * as SubCatServices from '../../services/subCatServices';

    export default{
        components:{
            pagination: Pagination
        },
        name: 'user-home',
        data(){
            return{
                search: '',
                allSearchList: [],
                categories: [],
                tags: [],
                sub_cat: [],
                popular: [],
                recent: [],
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
                },
            }
        },

        watch: {
            search:function (newQ, old) {
                this.searchList();
            },
        },

        mounted(){
            this.loadCategory();
            this.loadtags();
            this.loadSubCat();
            this.popularPost();
            this.RecentPost();
            this.blogList();
        },

        methods:{
            loadCategory: async function(){
                try{
                    const response = await categoryServices.getCat();
                    this.categories = response.data.category;

                }catch (error){
                    console.log(error);
                }
            },

            loadtags: async function(){
                try {
                    const response = await TagServices.getTag();
                    this.tags = response.data.tag;
                }catch (error){
                    console.log(error);
                }
            },

            loadSubCat: async function(){
                try {
                    const response = await SubCatServices.getSubCat();
                    this.sub_cat = response.data.sub_cat;
                }catch (error){
                    console.log(error);
                }
            },

            popularPost: async function(){
                try {
                    const response = await blogServices.getPopularPost();
                    this.popular = response.data.popular_post;
                }catch (error){
                    console.log(error);
                }
            },

            RecentPost: async function(){
                try {
                    const response = await blogServices.getRecentPost();
                    this.recent = response.data.recent_post;
                }catch (error){
                    console.log(error);
                }
            },

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

            searchList: async function(){
                try {
                    let params = new URLSearchParams();
                    params.append('search', this.search);

                    const response = await blogServices.getSearch(params);
                    console.log(response);
                    this.allSearchList = response.data.result;
                }catch (error){
                    console.log(error);
                }
            }
        },
    }
</script>

<style scoped>
.search{
    margin-top: 60px;
}

.cat_list{
    margin:0px ;
    list-style-type:none ;
    font-size:14px;
    padding:0px 0px 10px 0px ;
}

.cat_list li{padding:0px 0px 5px 0px;}

.cat_list li .link{color:#b35757;}

.cat_list li .link:hover{
    color:#000;
    text-decoration:none;
}

/*footer*/
.col_white_amrc { color:#FFF;}
footer { width:100%; background-color:#263238; min-height:250px; padding:10px 0px 25px 0px ;}
.pt2 { padding-top:40px ; margin-bottom:20px ;}
footer p { font-size:13px; color:#CCC; padding-bottom:0px; margin-bottom:8px;}
.mb10 { padding-bottom:15px ;}
.footer_ul_amrc { margin:0px ; list-style-type:none ; font-size:14px; padding:0px 0px 10px 0px ; }
.footer_ul_amrc li {padding:0px 0px 5px 0px;}
.footer_ul_amrc li a{ color:#CCC;}
.footer_ul_amrc li a:hover{ color:#fff; text-decoration:none;}
.fleft { float:left;}
.padding-right { padding-right:10px; }

.footer_ul2_amrc {margin:0px; list-style-type:none; padding:0px;}
.footer_ul2_amrc li p { display:table; }
.footer_ul2_amrc li a:hover { text-decoration:none;}
.footer_ul2_amrc li i { margin-top:5px;}

.bottom_border { border-bottom:1px solid #323f45; padding-bottom:20px;}
.foote_bottom_ul_amrc {
    list-style-type:none;
    padding:0px;
    display:table;
    margin-top: 10px;
    margin-right: auto;
    margin-bottom: 10px;
    margin-left: auto;
}
.foote_bottom_ul_amrc li { display:inline;}
.foote_bottom_ul_amrc li a { color:#999; margin:0 12px;}

.social_footer_ul { display:table; margin:15px auto 0 auto; list-style-type:none;  }
.social_footer_ul li { padding-left:20px; padding-top:10px; float:left; }
.social_footer_ul li a { color:#CCC; border:1px solid #CCC; padding:8px;border-radius:50%;}
.social_footer_ul li i {  width:20px; height:20px; text-align:center;}
</style>
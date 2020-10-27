<template>
    <div>
        <div class="card">
            <h5 class="card-header">Blogs</h5>
            <div class="card-body">
                <div style="background-color: wheat;margin-top:10px;margin-bottom: 20px;">

                    <h3>{{ blogs.title }}</h3>
                    <p>{{ blogs.description }}</p>
                    <span>Author: {{ blogs.uname }}</span> | <span>Category: {{ blogs.cname }}</span> | <span>Tag: {{ blogs.tag_name}}</span>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Comments</div>
            <div class="card-body">


                <div class="media">
                    <div class="media-left">
                        <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading title">Fahmi Arif</h4>
                        <p class="komen">
                            kalo bisa ya ndak usah gan biar cepet<br>
                            <a href="#">reply</a>
                        </p>
                    </div>
                </div>

                <div class="geser">
                    <div class="media">
                        <div class="media-left">
                            <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading title">Fahmi Arif</h4>
                            <p class="komen">
                                kalo bisa ya ndak usah gan biar cepet<br>
                                <a href="#">reply</a>
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <form v-on:submit.prevent="createComments">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <input type="text" v-model="comments.name" class="form-control" placeholder="Name">
                            </div>

                            <input type="hidden" v-model="comments.blogId">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="comments.email" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea v-model="comments.description" name="" id="" cols="30" rows="10" class="form-control" placeholder="Comments Please"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import * as blogServices from '../../services/blog_services';

    export default{
        name: 'single-blog',
        data(){
            return{
                blogs: {},
                comments: {
                    blogId: '',
                    name: '',
                    email: '',
                    description: ''
                },
            }
        },

        mounted(){
            this.singleBlogPost();
        },

        methods: {
            singleBlogPost: async function(){
                try {
                    let id = this.$route.params.id;
                    const  response = await blogServices.getSingleBlogPost(id);
                    this.blogs = response.data.single_blog_post;
                }catch (error){
                    console.log(error);
                }
            },

            createComments: async function(){
                try {
                    this.comments.blogId = this.$route.params.id;

                    let formData = new FormData();
                    formData.append('blogId', this.comments.blogId);
                    formData.append('name', this.comments.name);
                    formData.append('email', this.comments.email);
                    formData.append('description', this.comments.description);

                    const response = await blogServices.createComments(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    this.comments.blogId = '';
                    this.comments.name = '';
                    this.comments.email = '';
                    this.comments.description = '';

                }catch (error){
                    console.log(error);
                }
            }
        },
    }
</script>

<style scoped>
    .title {
        font-size: 14px;
        font-weight:bold;
    }
    .komen {
        font-size:14px;
    }
    .geser {
        margin-left:55px;
        margin-top:5px;
    }

</style>
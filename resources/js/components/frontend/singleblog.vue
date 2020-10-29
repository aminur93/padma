<template>
    <div>
        <div class="card">
            <h5 class="card-header">Blogs</h5>
            <div class="card-body">
                <div style="background-color: wheat;margin-top:10px;margin-bottom: 20px;">

                    <h3>{{ blogs.title }}</h3>
                    <p v-html="blogs.description"></p>
                    <span>Author: {{ blogs.uname }}</span> | <span>Category: {{ blogs.cname }}</span> | <span>Tag: {{ blogs.tag_name}}</span>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Comments</div>
            <div class="card-body">

                <div v-if="commentData.length > 0" v-for="(comment,index) in commentData" :key="comment.id">
                    <div class="media">
                        <div class="media-left">
                            <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading title">{{ comment.name }}</h4>
                            <p class="komen">
                                {{ comment.description }}
                                <br>
                                <a data-toggle="collapse" :href="'#collapseExample-'+ comment.id" role="button" aria-expanded="false" aria-controls="collapseExample">reply</a>
                            </p>

                            <div class="collapse" :id="'collapseExample-'+ comment.id">
                                <div class="card card-body">
                                    <form v-on:submit.prevent="createReply($event)" :id="'comments-'+comment.id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" v-model="replyData.reply_name" class="form-control" placeholder="Name">
                                                </div>

                                                <input type="hidden" v-model="replyData.blogId">
                                                <input type="hidden" v-model="replyData.comment_id">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" v-model="replyData.reply_email" class="form-control" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea v-model="replyData.reply_description" cols="10" rows="4" class="form-control" placeholder="Comments Please"></textarea>
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
                    </div>

                    <div class="geser" v-for="(reply,index) in replys" :key="reply.id">
                        <div class="media" v-if="comment.id == reply.comment_id">
                            <div class="media-left">
                                <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading title">{{ reply.reply_name}}</h4>
                                <p class="komen">
                                    {{ reply.reply_description }}<br>
                                    <!--<a href="#">reply</a>-->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="commentData.length == 0">No Comment Found</div>

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
                commentData: [],
                replyData: {
                    blogId: '',
                    comment_id: '',
                    reply_name: '',
                    reply_email: '',
                    reply_description: '',
                },
                replys: [],

                ishide: false,
            }
        },

        mounted(){
            this.singleBlogPost();
            this.loadComments();
            this.loadReply();
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

                    this.loadComments();

                    this.comments.blogId = '';
                    this.comments.name = '';
                    this.comments.email = '';
                    this.comments.description = '';

                }catch (error){
                    console.log(error);
                }
            },

            loadComments: async function(){
                try {
                    let id = this.$route.params.id;

                    let params = new URLSearchParams();
                    params.append('blogs_id', id);

                    const response = await blogServices.getAllComment(params);
                    this.commentData = response.data.get_comments;
                }catch (error){
                    console.log(error);
                }
            },

            createReply: async function(event){
                try {
                    this.replyData.blogId = this.$route.params.id;

                    let element = event.currentTarget;

                    let id = element.getAttribute('id');
                    let boat = id.split('-');
                    let speed = boat[1];

                    let formData = new FormData();
                    formData.append('blogId', this.replyData.blogId);
                    formData.append('comment_id', speed);
                    formData.append('reply_name', this.replyData.reply_name);
                    formData.append('reply_email', this.replyData.reply_email);
                    formData.append('reply_description', this.replyData.reply_description);

                    const response = await blogServices.createReply(formData);

                    this.$swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    event.target.reset();
                    this.loadReply();

                    this.replyData.blogId = '';
                    this.replyData.comment_id = '';
                    this.replyData.reply_name = '';
                    this.replyData.reply_email = '';
                    this.replyData.reply_description = '';
                }catch (error){
                    console.log(error);
                }
            },

            loadReply: async function(){
                try {
                    let id = this.$route.params.id;

                    let params = new URLSearchParams();
                    params.append('blogs_id', id);

                    const response = await blogServices.getAllReply(params);
                    console.log(response);
                    this.replys = response.data.get_reply;
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
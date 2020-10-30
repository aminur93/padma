<template>
    <div>

        <div class="card">
            <h5 class="card-header">Category List</h5>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <ul class="cat_list">
                            <li v-for="(category,index) in categories"><router-link :to="`/category_blog/${category.id}`" class="link">{{ category.name }} <span class="badge badge-primary badge-pill">12</span></router-link></li>
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
                            <li v-for="(tag,index) in tags"><router-link :to="`/tag_blog/${tag.id}`" class="link">{{ tag.tag_name }} <span class="badge badge-primary badge-pill">12</span></router-link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Popular Post</h5>
            <div class="card-body">
                <div v-for="(pop,index) in popular" :key="pop.id" style="background-color: wheat;margin:5px;">

                    <h6><router-link :to="`/single_blog/${pop.id}`" replace>{{ pop.title }}</router-link></h6>
                    <p>{{ pop.description | shortlength(50,'...') }}</p>
                    <span>{{ pop.uname }}</span> | <span>{{ pop.cname }}</span> | <span>{{ pop.tag_name}}</span>

                </div>

            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Recent Post</h5>
            <div class="card-body">
                <div v-for="(rec,index) in recent" style="background-color: wheat;margin:5px;">

                    <h6><router-link :to="`/single_blog/${rec.id}`" replace>{{ rec.title }}</router-link></h6>
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
</template>

<script>
    export default{
        props: ['categories','tags','popular','recent']
    }
</script>

<style scoped>
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
</style>
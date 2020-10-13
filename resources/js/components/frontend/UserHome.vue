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
                                    <input type="text" class="form-control" placeholder="Search this blog">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
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
                                <h5 class="card-header">Featured</h5>
                                <div class="card-body">
                                </div>
                            </div>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>

                        <div class="col-md-4">

                            <div class="card">
                                <h5 class="card-header">Category List</h5>
                                <div class="card-body">

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Tag List</h5>
                                <div class="card-body">

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Popular Post</h5>
                                <div class="card-body">

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Recent Post</h5>
                                <div class="card-body">

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Stay Connect</h5>
                                <div class="card-body">

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
                        <p class="mb10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        <p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35 </p>
                        <p><i class="fa fa-phone"></i>  +91-9999878398  </p>
                        <p><i class="fa fa fa-envelope"></i> info@example.com  </p>


                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Category</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li><a href="http://webenlance.com">Image Rectoucing</a></li>
                            <li><a href="http://webenlance.com">Clipping Path</a></li>
                            <li><a href="http://webenlance.com">Hollow Man Montage</a></li>
                            <li><a href="http://webenlance.com">Ebay & Amazon</a></li>
                            <li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
                            <li><a href="http://webenlance.com">Image Cropping</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Sub Category</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                            <li><a href="http://webenlance.com">Remove Background</a></li>
                            <li><a href="http://webenlance.com">Shadows & Mirror Reflection</a></li>
                            <li><a href="http://webenlance.com">Logo Design</a></li>
                            <li><a href="http://webenlance.com">Vectorization</a></li>
                            <li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
                            <li><a href="http://webenlance.com">Image Cropping</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">Follow us</h5>
                        <!--headin5_amrc ends here-->

                        <ul class="footer_ul2_amrc">
                            <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
                            <li><a href="#"><i class="fab fa-facebook fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
                            <li><a href="#"><i class="fab fa-youtube fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
                        </ul>
                        <!--footer_ul2_amrc ends here-->
                    </div>
                </div>
            </div>


            <div class="container">
                <ul class="foote_bottom_ul_amrc">
                    <li><a href="http://webenlance.com">Home</a></li>
                    <li><a href="http://webenlance.com">About</a></li>
                    <li><a href="http://webenlance.com">Contact</a></li>
                </ul>
                <!--foote_bottom_ul_amrc ends here-->
                <p class="text-center">Copyright @2020 | Designed With by <a href="#">AminurDevio.com</a></p>

                <ul class="social_footer_ul">
                    <li><a href="http://webenlance.com"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="http://webenlance.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="http://webenlance.com"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="http://webenlance.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
                <!--social_footer_ul ends here-->
            </div>

        </footer>
        <!--Footer Section-->
    </div>
</template>

<script>
    export default{
        name: 'user-home'
    }
</script>

<style scoped>
.search{
    margin-top: 60px;
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
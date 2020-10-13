<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\category;
use App\SubCategories;
use App\Tag;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

class BlogPostController extends Controller
{
    public function getBlog()
    {
        $blog = DB::table('blog_posts')
                    ->select(
                        'blog_posts.id as id',
                        'categories.name as cname',
                        'subcategories.sub_cat_name as sub_cat_name',
                        'tags.tag_name as tag_name',
                        'users.name as uname',
                        'blog_posts.title as title',
                        'blog_posts.description as description',
                        'blog_posts.image as image',
                        'blog_posts.blog_status as blog_status',
                        'blog_posts.publish as publish',
                        'blog_posts.feature as feature'
                    )
                    ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('subcategories','blog_posts.sub_cat_id','=','subcategories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->get();

        return response()->json(['blog_post' => $blog],200);
    }

    public function getBlogCount(){
        $blogs = BlogPost::get()->count();
        return response()->json([
            'blog_count' => $blogs,
            'status_code' => 200
        ],200);
    }

    public function getBlogDash(){
        $blog = BlogPost::latest()->get()->take(5);

        return response()->json([
            'blog_dash' => $blog,
            'status_code' => 200
        ],200);
    }

    public function getCategory(){
        $category = category::all();
        return response()->json(['category' => $category],200);
    }

    public function getAllSubCategory(){
        $sub_cat = SubCategories::all();
        return response()->json(['subCat' => $sub_cat],200);
    }

    public function getSubCategory($category_id)
    {
        $subCategory = DB::table('subcategories')
                        ->select(
                            'subcategories.id as id',
                            'subcategories.sub_cat_name as sub_cat_name'
                        )
                        ->Join('categories','subcategories.category_id','=','categories.id')
                        ->where('subcategories.category_id', $category_id)
                        ->get();

        return response()->json(['subcategory' => $subCategory], 200);
    }

    public function getTag()
    {
        $tag = Tag::get();
        return response()->json(['tag' => $tag],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if ($request->isMethod('post'))
        {
            //dd($request->all());

            if($request->hasFile('image')){

                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extenson = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extenson;

                    $original_image_path = public_path().'/assets/admin/uploads/original_image/'.$filename;
                    $large_image_path = public_path().'/assets/admin/uploads/large/'.$filename;
                    $medium_image_path = public_path().'/assets/admin/uploads/medium/'.$filename;
                    $small_image_path = public_path().'/assets/admin/uploads/small/'.$filename;

                    //Resize Image
                    Image::make($image_tmp)->save($original_image_path);
                    Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                    Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                    Image::make($image_tmp)->resize(500,529)->save($small_image_path);


                }
            }

            $blogPost = new BlogPost();

            $blogPost->category_id = $request->category_id;
            $blogPost->sub_cat_id = $request->sub_cat_id;
            $blogPost->tag_id = $request->tag_id;
            $blogPost->author_id = Auth::user()->id;
            $blogPost->title = $request->title;
            $blogPost->description = $request->description;
            $blogPost->image = $filename;

            if ($request->blog_status == true)
            {
                $blogPost->blog_status = 1;
            }else{
                $blogPost->blog_status = 0;
            }

            if ($request->publish == true)
            {
                $blogPost->publish = 1;
            }else{
                $blogPost->publish = 0;
            }

            if ($request->feature == true)
            {
                $blogPost->feature = 1;
            }else{
                $blogPost->feature = 0;
            }

            if ($blogPost->save()){
                return response()->json([
                    'message' => 'Blog Post Stored Successfully',
                    'status_code' => 200
                ],200);
            }else{
                return response()->json([
                    'message' => 'something went wrong',
                    'status_code' => 500
                ],500);
            }

        }
    }

    public function edit($id)
    {
        $edit_blog = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.category_id as category_id',
                'blog_posts.sub_cat_id as sub_cat_id',
                'blog_posts.tag_id as tag_id',
                'blog_posts.description as description',
                'blog_posts.image as image',
                'blog_posts.blog_status as blog_status',
                'blog_posts.publish as publish',
                'blog_posts.feature as feature'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('subcategories','blog_posts.sub_cat_id','=','subcategories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->where('blog_posts.id',$id)
            ->first();

        return response()->json(['edit_blog'=>$edit_blog],200);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            //dd($request->blog_status);

            if($request->hasFile('image')){

                $image_tmp = $request->file('image');

                if($image_tmp->isValid()){
                    $extenson = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extenson;

                    $original_image_path = public_path().'/assets/admin/uploads/original_image/'.$filename;
                    $large_image_path = public_path().'/assets/admin/uploads/large/'.$filename;
                    $medium_image_path = public_path().'/assets/admin/uploads/medium/'.$filename;
                    $small_image_path = public_path().'/assets/admin/uploads/small/'.$filename;

                    //Resize Image
                    Image::make($image_tmp)->save($original_image_path);
                    Image::make($image_tmp)->resize(1920,680)->save($large_image_path);
                    Image::make($image_tmp)->resize(1000,529)->save($medium_image_path);
                    Image::make($image_tmp)->resize(500,529)->save($small_image_path);


                }
            }else{
                $filename = $request->current_image;
            }

            $blogPost = BlogPost::findOrFail($id);

            $blogPost->category_id = $request->category_id;
            $blogPost->sub_cat_id = $request->sub_cat_id;
            $blogPost->tag_id = $request->tag_id;
            $blogPost->author_id = Auth::user()->id;
            $blogPost->title = $request->title;
            $blogPost->description = $request->description;
            $blogPost->image = $filename;



            if ($request->blog_status){
                $blogPost->blog_status = $request->blog_status == "false" ? 0 : 1;
            }

            if ($request->publish){
                $blogPost->publish = $request->publish == "false" ? 0 : 1;
            }

            if ($request->feature){
                $blogPost->feature = $request->feature == "false" ? 0 : 1;
            }




            if ($blogPost->save()){
                return response()->json([
                    'message' => 'Blog Post Updated Successfully',
                    'status_code' => 200
                ],200);
            }else{
                return response()->json([
                    'message' => 'something went wrong',
                    'status_code' => 500
                ],500);
            }
        }
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        $original_path = public_path().'/assets/admin/uploads/original_image/'.$blog->image;
        $large_path = public_path().'/assets/admin/uploads/large/'.$blog->image;
        $medium_path = public_path().'/assets/admin/uploads/medium/'.$blog->image;
        $small_path = public_path().'/assets/admin/uploads/small/'.$blog->image;

        unlink($original_path);
        unlink($large_path);
        unlink($medium_path);
        unlink($small_path);

        $blog->delete();

        return response()->json([
            'message' => 'Blog Post Deleted Successfully',
            'status_code' => 200
        ],200);
    }

    public function approve($id)
    {
        BlogPost::where('id',$id)->update(['blog_status' => 1]);

        return response()->json([
            'message' => 'Blog Post Approve Successfully',
            'status_code' => 200
        ],200);
    }

    public function unapprove($id)
    {
        BlogPost::where('id',$id)->update(['blog_status' => 0]);

        return response()->json([
            'message' => 'Blog Post UnApprove Successfully',
            'status_code' => 200
        ],200);
    }

    public function publish($id)
    {
        BlogPost::where('id',$id)->update(['publish' => 1]);

        return response()->json([
            'message' => 'Blog Post Publish Successfully',
            'status_code' => 200
        ],200);
    }

    public function unpublish($id)
    {
        BlogPost::where('id',$id)->update(['publish' => 0]);

        return response()->json([
            'message' => 'Blog Post UnPublish Successfully',
            'status_code' => 200
        ],200);
    }

    public function feature($id){
        BlogPost::where('id',$id)->update(['feature' => 1]);

        return response()->json([
            'message' => 'Blog Post Feature Successfully',
            'status_code' => 200
        ],200);
    }

    public function unfeature($id)
    {
        BlogPost::where('id',$id)->update(['feature' => 0]);

        return response()->json([
            'message' => 'Blog Post UnFeature Successfully',
            'status_code' => 200
        ],200);
    }
}

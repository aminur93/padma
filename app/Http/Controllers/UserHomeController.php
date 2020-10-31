<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\SubCategories;
use App\Tag;
use Illuminate\Http\Request;
use DB;

class UserHomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function getTag()
    {
        $tag = Tag::get();

        return response()->json([
            'tag' => $tag,
            'status_code' => 200
        ],200);
    }

    public function getSubCategory()
    {
        $subCat = SubCategories::get();

        return response()->json([
            'sub_cat' => $subCat,
            'status_code' => 200
        ],200);
    }

    public function popular()
    {
        $popular_post = DB::table('blog_posts')
                        ->select(
                            'blog_posts.id as id',
                            'blog_posts.title as title',
                            'blog_posts.description as description',
                            'categories.name as cname',
                            'tags.tag_name as tag_name',
                            'users.name as uname'
                        )
                        ->Join('categories','blog_posts.category_id','=','categories.id')
                        ->Join('tags','blog_posts.tag_id','=','tags.id')
                        ->Join('users','blog_posts.author_id','=','users.id')
                        ->where('view_count','>=','25')
                        ->get()
                        ->take(3);
        return response()->json([
            'popular_post' => $popular_post,
            'status_code' => 200
        ],200);
    }

    public function recent()
    {
        $recent = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.description as description',
                'categories.name as cname',
                'tags.tag_name as tag_name',
                'users.name as uname'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->orderBy('id','desc')
            ->get()
            ->take(3);

        return response()->json([
            'recent_post' => $recent,
            'status_code' => 200
        ],200);
    }

    public function allBloglist()
    {
        $blogList = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.description as description',
                'categories.name as cname',
                'tags.tag_name as tag_name',
                'users.name as uname'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->orderBy('id','desc')
            ->paginate(5);

        return response()->json([
            'blog_list' => $blogList,
            'status_code' => 200
        ],200);
    }

    public function searchList(Request $request)
    {
        $searchValue = $request->input('search');
        //dd($searchValue);

        $query = BlogPost::select('title')->orderBy('title','desc');

        if ($searchValue){
            $query->where(function ($query) use ($searchValue){
                $query->where('title','like','%'. $searchValue .'%');
            });
        }

        $result = $query->get();

        return response()->json(['result' => $result, 'status_code' => 200],200);
    }

    public function searchBlog(Request $request)
    {
        $searchBlog = $request->input('search');

        $query = DB::table('blog_posts')
                ->select(
                    'blog_posts.id as id',
                    'blog_posts.title as title',
                    'blog_posts.description as description',
                    'categories.name as cname',
                    'tags.tag_name as tag_name',
                    'users.name as uname'
                )
                ->Join('categories','blog_posts.category_id','=','categories.id')
                ->Join('tags','blog_posts.tag_id','=','tags.id')
                ->Join('users','blog_posts.author_id','=','users.id')
                ->orderBy('id','desc');
                //->paginate(5);

        if ($searchBlog){
            $query->where(function ($query) use ($searchBlog){
                $query->where('title','like','%'. $searchBlog .'%');
            });
        }

        $result = $query->paginate(5);

        return response()->json(['result' => $result, 'status_code' => 200],200);

    }

    public function singleBlog($id)
    {
        $single_blog = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.description as description',
                'categories.name as cname',
                'tags.tag_name as tag_name',
                'users.name as uname'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->where('blog_posts.id',$id)
            ->first();

        return response()->json(['single_blog_post'=>$single_blog],200);
    }

    public function getCatBlog(Request $request)
    {
        $category_id = $request->input('categoryId');

        $catByBlog = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.description as description',
                'categories.name as cname',
                'tags.tag_name as tag_name',
                'users.name as uname'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->where('blog_posts.category_id',$category_id)
            ->paginate(5);

        return response()->json([
            'get_categoryId_by_blog' => $catByBlog,
            'status_code' => 200
        ],200);
    }

    public function getTagBlog(Request $request)
    {
        $tag_id = $request->input('tag_id');

        $tagByBlog = DB::table('blog_posts')
            ->select(
                'blog_posts.id as id',
                'blog_posts.title as title',
                'blog_posts.description as description',
                'categories.name as cname',
                'tags.tag_name as tag_name',
                'users.name as uname'
            )
            ->Join('categories','blog_posts.category_id','=','categories.id')
            ->Join('tags','blog_posts.tag_id','=','tags.id')
            ->Join('users','blog_posts.author_id','=','users.id')
            ->where('blog_posts.tag_id',$tag_id)
            ->paginate(5);

        return response()->json([
            'get_tagId_by_blog' => $tagByBlog,
            'status_code' => 200
        ],200);
    }
}

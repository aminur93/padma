<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Reply;
use Illuminate\Http\Request;
use DB;

class CommentsController extends Controller
{
    public function storeComments(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                // Step 1 : Create Sub Category
                $comment = new Comments();
                $comment->blog_id = $request->blogId;
                $comment->name = $request->name;
                $comment->email = $request->email;
                $comment->description = $request->description;

                $comment->save();

                DB::commit();

                return response()->json([
                    'message' => 'Comments Added Successfully'
                ],200);

            }catch(\Illuminate\Database\QueryException $e){
                DB::rollback();
                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ],500);
            }
        }
    }

    public function getData(Request $request)
    {
        $id = $request->input('blogs_id');

        $comments = Comments::where('blog_id',$id)->get();

        return response()->json([
            'get_comments' => $comments,
            'status_code' => 200
        ],200);
    }

    public function storeReply(Request $request)
    {
        if($request->isMethod('post')) {
            DB::beginTransaction();

            try {
                // Step 1 : Create Sub Category
                $reply = new Reply();
                $reply->blog_id = $request->blogId;
                $reply->comment_id = $request->comment_id;
                $reply->reply_name = $request->reply_name;
                $reply->reply_email = $request->reply_email;
                $reply->reply_description = $request->reply_description;

                //return $reply;

                $reply->save();

                DB::commit();

                return response()->json([
                    'message' => 'Reply Added Successfully'
                ], 200);

            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ], 500);
            }
        }
    }
}

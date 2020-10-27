<?php

namespace App\Http\Controllers;

use App\Comments;
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
}

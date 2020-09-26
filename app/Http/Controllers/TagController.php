<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getData()
    {
        $tag = Tag::all();

        return response()->json(['tag' => $tag],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|unique:tags'
        ]);

        if ($request->isMethod('post'))
        {
            $tag = new Tag();

            $tag->tag_name = $request->tag_name;

            if ($tag->save())
            {
                return response()->json([
                    'message' => 'Tag Stored Successfully',
                    'status_code' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Tag is not Stored',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return response()->json(['tags' => $tag],200);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $tag = Tag::findOrFail($id);

            $tag->tag_name = $request->tag_name;

            if ($tag->save())
            {
                return response()->json([
                    'message' => 'Tag Updated Successfully',
                    'status_code' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Tag is not Updated',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(['message' => 'Tag Deleted Successfully'],200);
    }
}

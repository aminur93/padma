<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getData(Request $request)
    {

        $columns = ['id', 'tag_name'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Tag::select('id', 'tag_name')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('tag_name', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);

        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getTotalTag(){
        $tags = Tag::get()->count();
        return response()->json([
            'tag_count' => $tags,
            'status_code' => 200
        ],200);
    }

    public function getTagDash(){
        $tag = Tag::latest()->get()->take(5);

        return response()->json([
            'tag_dash' => $tag,
            'status_code' => 200
        ],200);
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

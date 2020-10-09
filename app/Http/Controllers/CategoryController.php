<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        //$categories = category::orderBy('id','DESC')->paginate(10);

        $columns = ['id', 'name'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = category::select('id', 'name')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);

        return ['data' => $projects, 'draw' => $request->input('draw')];

        //return response()->json(['category' => $categories],200);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3'
        ]);

        if ($request->isMethod('post'))
        {
            $category = new category();

            $category->name = $request->name;

            if ($category->save())
            {
                return response()->json([
                    'message' => 'Category Stored Successfully',
                    'status_code' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Category is not Stored',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function edit($id)
    {
        $category = category::findOrFail($id);

        return response()->json(['category' => $category],200);
    }

    public function update(Request $request,$id)
    {

        if ($request->isMethod('post'))
        {
            $category = category::findOrFail($id);

            $category->name = $request->name;

            if ($category->save())
            {
                return response()->json([
                    'message' => 'Category Updated Successfully',
                    'status_code' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Category is not Updated',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $category = category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category Deleted Successfully'],200);
    }
}

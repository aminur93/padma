<?php

namespace App\Http\Controllers;

use App\category;
use App\SubCategories;
use Illuminate\Http\Request;
use DB;

class SubcategoryController extends Controller
{
    public function getData(Request $request){

        $columns = ['id', 'category_name', 'sub_category_name'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $sub_cat = DB::table('subcategories')
                    ->select(
                        'subcategories.id as id',
                        'subcategories.sub_cat_name as sub_cat_name',
                        'categories.name as name'
                    )
                    ->Join('categories','subcategories.category_id','=','categories.id')
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $sub_cat->where(function($sub_cat) use ($searchValue) {
                $sub_cat->where('sub_cat_name', 'like', '%' . $searchValue . '%');
                $sub_cat->orwhere('name', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $sub_cat->paginate($length);

        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getCatData()
    {
        $category = category::all();
        return response()->json(['category' => $category],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_cat_name' => 'required|string'
        ]);

        if ($request->isMethod('post'))
        {

            DB::beginTransaction();

            try{
                // Step 1 : Create Sub Category
                $sub_cat = new SubCategories();

                $sub_cat->category_id = $request->category_id;
                $sub_cat->sub_cat_name = $request->sub_cat_name;

                $sub_cat->save();

                DB::commit();

                return response()->json([
                    'message' => 'Sub Category Added Successfully'
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

    public function edit($id)
    {
        $sub_cat = DB::table('subcategories')
            ->select(
                'subcategories.id as id',
                'subcategories.sub_cat_name as sub_cat_name',
                'subcategories.category_id as category_id'
            )
            ->Join('categories','subcategories.category_id','=','categories.id')
            ->where('subcategories.id',$id)
            ->first();

        return response()->json(['sub_cat'=>$sub_cat],200);
    }

    public function update(Request $request,$id)
    {
        if ($request->isMethod('post'))
        {

            DB::beginTransaction();

            try{
                // Step 1 : Create Sub Category
                $sub_cat = SubCategories::findOrFail($id);

                $sub_cat->category_id = $request->category_id;
                $sub_cat->sub_cat_name = $request->sub_cat_name;

                $sub_cat->save();

                DB::commit();

                return response()->json([
                    'message' => 'Sub Category Updated Successfully'
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

    public function destroy($id)
    {
        $sub_cat = SubCategories::findOrFail($id);
        $sub_cat->delete();

        return response()->json(['message' => 'Sub Category Deleted Successfully'],200);
    }
}

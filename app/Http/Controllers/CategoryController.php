<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
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
}

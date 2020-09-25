<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function getPermission()
    {
        $permissions = Permission::all();

        return response()->json([
            'permission' => $permissions
        ],200);

    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $permission = new Permission();

            $permission->name = $request->name;
            $permission->guard_name = 'web';

            if ($permission->save())
            {
                return response()->json([
                    'message' => 'Permission Store Successfully',
                    'status_code' =>200
                ],200);
            }else{
                return response()->json([
                    'message' => 'Permission Store Occured Problem ! Please try Again',
                    'status_code' =>500
                ],500);
            }
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json(['permission' => $permission], 200);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $permission = Permission::findOrFail($id);

            $permission->name = $request->name;
            $permission->guard_name = 'web';

            if ($permission->save())
            {
                return response()->json([
                    'message' => 'Permission Updated Successfully',
                    'status_code' =>200
                ],200);
            }else{
                return response()->json([
                    'message' => 'Permission Updated Occured Problem ! Please try Again',
                    'status_code' =>500
                ],500);
            }
        }
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json([
            'message' => 'Permission Deleted Successfully'
        ],200);


    }
}

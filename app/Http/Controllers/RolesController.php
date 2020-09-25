<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class RolesController extends Controller
{
    public function getData(){

        $role = DB::table('roles')
                ->select(
                    'roles.id',
                    'roles.name as rname',
                    DB::raw('group_concat(permissions.name) as pname')
                )
            ->join('role_has_permissions','roles.id','=','role_has_permissions.role_id')
            ->join('permissions','role_has_permissions.permission_id','=','permissions.id')
            ->groupBy('role_has_permissions.role_id')
            ->get();

        return response()->json(['roles' => $role],200);

    }

    public function getPermission(){
        $permission = Permission::all();
        return response()->json(['permission' => $permission],200);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                // Step 1 : Create Role
                $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

                //$role_id = DB::getPdo()->lastInsertId();

                    $permissions = explode(',',$request->permission);

//                foreach ($request->permission as $key => $p)
//                {
//                    DB::table('role_has_permissions')
//                        ->insert([
//                            'permission_id' => $p,
//                            'role_id' => $role_id
//                        ]);
//                }


                //return $permissions;

                //$permission =

                $role->syncPermissions($permissions);

                DB::commit();

                return response()->json([
                    'message' => 'Role Added Successfully'
                ],200);

            }catch(\Illuminate\Database\QueryException $e){
                DB::rollback();

                $error = $e->getMessage();

                return response()->json([
                    'message' => $error
                ],500);
            }
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id)->toArray();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $rp_array = [];
        foreach ($rolePermissions as $rp)
        {
            $rp_array[] = $rp;
        }

        return response()->json([
            'roles' => $role,
            'rolePermission' => $rp_array,
            'status_code' => 200
        ],200);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();

            $permissions = explode(',',$request->permission);

            $role->syncPermissions($permissions);

            return response()->json([
                'message' => 'Role Updated Successfully',
                'status_code' => 200
            ],200);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        DB::table('role_has_permissions')->where('role_id',$id)->delete();
        $role->delete();

        return response()->json([
            'message' => 'Role Deleted Successfully',
            'status_code' =>200
        ],200);
    }
}

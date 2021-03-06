<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getUser(Request $request){

        $columns = ['id', 'name', 'role'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('users')
            ->select(
                'users.id',
                'users.name as name',
                'roles.name as role'
            )
            ->Join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->Join('roles','model_has_roles.role_id','=','roles.id')
            ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('users.name', 'like', '%' . $searchValue . '%');
                $query->orwhere('roles.name', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);

        return ['data' => $projects, 'draw' => $request->input('draw')];

    }

    public function getUserCount(){
        $user = User::get()->count();
        return response()->json([
            'user_count' => $user,
            'status_code' => 200
        ],200);
    }

    public function getRole(){
        $role = Role::get()->toArray();

        return response()->json(['roles' => $role],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required'
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                // Step 1 : Create Role
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);


                $user = User::create($input);

                $user->assignRole($request->role);

                DB::commit();

                return response()->json([
                    'message' => 'User Added Successfully'
                ],200);

            }catch(\Illuminate\Database\QueryException $e){
                DB::rollback();
                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ],200);
            }
        }
    }

    public function edit($id)
    {
        $data = DB::table('users')
            ->select(
                'users.id as id',
                'users.name as name',
                'users.email as email',
                'model_has_roles.role_id as role_id'
            )
            ->leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')
            ->leftJoin('roles','model_has_roles.role_id','=','roles.id')
            ->where('users.id',$id)
            ->first();

        return response()->json(['users' => $data],200);
    }

    public function update(Request $request,$id)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                // Step 1 : Update Users
                $input = $request->all();
                if(!empty($input['password'])){
                    $input['password'] = Hash::make($input['password']);
                }else{
                    $input = array_except($input,array('password'));
                }


                $user = User::find($id);
                $user->update($input);
                DB::table('model_has_roles')->where('model_id',$id)->delete();


                $user->assignRole($request->role);


                DB::commit();

                return response()->json([
                    'message' => 'User Updated Successfully'
                ],200);

            }catch(\Illuminate\Database\QueryException $e){
                DB::rollback();
                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ],200);
            }
        }
    }

    public function destroy($id)
    {
        $user = User::findorFail($id);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->delete();

        return response()->json([
            'message' => 'User Deleted Successfully'
        ],200);
    }
}

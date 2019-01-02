<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\User;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list');
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);

 
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id','DESC')->paginate(5);
        return view('permissions.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $users = User::get();
        return view('permissions.create',compact('roles','users'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       

        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);


        $permission = Permission::create(['name' => $request->input('name')]);


        if(!empty($request['role'])) { 
            $permission->syncRoles($request['role']);
        }


        if (!empty($request['user'])) { //If one or more role
            foreach ($request['user'] as $user) {
                $u = User::where('id', '=', $user)->firstOrFail();
                $u->givePermissionTo($permission);
            }
        }


        return redirect()->route('permissions.index')
                        ->with('success','Permission created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
     

        return view('permissions.show',compact('permission'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $roles = Role::get();
        $users = User::get();
        $permissionsRole = DB::table("role_has_permissions")->where("role_has_permissions.permission_id",$id)
            ->pluck('role_has_permissions.role_id','role_has_permissions.role_id')
            ->all();

        $permissionsUser = DB::table("model_has_permissions")->where("model_has_permissions.permission_id",$id)
            ->pluck('model_has_permissions.model_id','model_has_permissions.model_id')
            ->all();    



        return view('permissions.edit',compact('roles','permission','permissionsRole','users','permissionsUser'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


         

        $permission=Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
        $permission->syncRoles();

        if(!empty($request['role'])) { 
            $permission->syncRoles($request['role']);
        }

       

        DB::table("model_has_permissions")->where("permission_id",$id)->delete();



        if (!empty($request['user'])) { //If one or more role
            foreach ($request['user'] as $user) {
                $u = User::where('id', '=', $user)->firstOrFail();
                $u->givePermissionTo($permission);
            }
        }     



        return redirect()->route('permissions.index')
                        ->with('success','Permission updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $permission = Permission::find($id);
        $permission->delete();
        $permission->syncRoles();

        DB::table("model_has_permissions")->where("permission_id",$id)->delete();

        return redirect()->route('permissions.index')
                        ->with('success','Permission deleted successfully');
    }
}
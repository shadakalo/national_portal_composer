<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;

use App\Entities\Site;


use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
//use Illuminate\Support\Facades\Password;

class UserController extends Controller
{


    use SendsPasswordResetEmails;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //$role=auth()->user()->getRoleNames();

        $role=Role::find(1);
        // dd($role);
        // exit();

        //$user=auth()->user();
        //$user=User::find(1);
       // $site=Site::find(14);
        //$user->syncPermissions(['product-list', 'product-edit']);
       // $user->givePermissionTo('product-create');
        //$user->revokePermissionTo('product-edit');
        //$permissions = $user->permissions;
        //$permissions = $user->getDirectPermissions();
        //$permissions = $user->getPermissionsViaRoles();
       // $permissions = $user->getAllPermissions();


        //dd($permissions);
       //exit();
        //$permission=Permission::all();
        
        //$role->syncPermissions($permission);



   /*       $product = new Product;
        $product->name = 'God of War';
        $product->price = 40;

        $product->save();*/



        /*many to many*/

       /* $site = Site::find(14);
        $user = User::find([1, 2, 4]);
        $site->users()->sync($user);*/


      /*  $user = User::find(1);
        $site = Site::find([22, 23]);
        $user->sites()->sync($site);

         dd($site);
         exit();*/

         //$site->users()->sync([1, 2]);
        // $site->users()->attach(1);

         

        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();

        $input = array_except($input,array('password'));  
        //$input['password'] = Hash::make($input['password']);

        if(filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
           $user = User::create($input);
           $this->sendResetLinkEmail($request);
        }else{
            //$user = $this->create($request->all());  
            $user = User::create($request->all());  
        }


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
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
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
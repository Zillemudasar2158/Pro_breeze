<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\user;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class usercontroller extends Controller //implements HasMiddleware
{
    // public static function Middleware():array
    // {
    //     return
    //     [
    //         new Middleware('permission:view users',only:['index']),
    //         new Middleware('permission:edit users',only:['edit']),
    //         new Middleware('permission:create users',only:['create']),
    //         new Middleware('permission:delete users',only:['destroy']),
    //     ];
    // }
	public function index()
	{
		$user=User::paginate(7);
    	return view('users.list',['user'=>$user]);
	}	
    public function edit($id)
    {
    	$user=User::findorFail($id);
    	$role=Role::all();
    	$hasRoles=$user->roles->pluck('id');
    	return	view('users.edit',[
    		'user' => $user,
    		'role' => $role,
    		'hasRoles' => $hasRoles
    	]);
    }
    public function update($id,Request $request)
    {
    	$user=User::findorFail($id);
    	$validator=validator::make($request->all(),[
    		'name'=>'required|min:3',
    		'email'=>'required|unique:users,email,'.$id.',id|email'
    	]);
    	if ($validator->fails()) 
    	{
    		return redirect()->route('users.edit',$id)->withInput()->withErrors($validator);
    	}
    	else
    	{
    		$user->name=$request->name;
    		$user->email=$request->email;
    		$user->save();

    		$user->syncRoles($request->role);

    		return redirect()->route('users.index')->with('success','User updated successfully');
    	}
    }
}

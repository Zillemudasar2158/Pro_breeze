<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class rolecontroller extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return
        [
            new Middleware('permission:view roles',only:['index']),
            new Middleware('permission:edit roles',only:['edit']),
            new Middleware('permission:create roles',only:['create']),
            new Middleware('permission:delete roles',only:['destroy']),
        ];
    }
    public function index()
    {
    	$role=Role::paginate(7);
    	return view('role.list',['role'=>$role]);
    }
    public function create()
    {
    	$role= Permission::all();
    	return view('role.create',['role'=>$role]);
    }
    public function store(Request $request)
    {
    	$validator=validator::make($request->all(),[
    		'name'=>'required|unique:roles|min:3'
    	]);

    	if ($validator->passes()) 
    	{
    		$role=Role::create(['name'=>$request->name]);

    		if(!empty($request->permission)){
    			foreach ($request->permission as $assignrole) {
    				$role->givePermissionTo($assignrole);
    			}
    		}

    		return redirect()->route('role.index')->with('success','Role addedd successfully');
    	}
    	else
    	{
    		return redirect()->route('role.create')->withInput()->withErrors($validator);
    	}
    }
    public function edit($id)
    {
    	$role=Role::findorFail($id);
    	$haspermission=$role->permissions->pluck('name');
    	$permission=Permission::orderBy('name','ASC')->get();

    	return	view('role.edit',['role' => $role,'permission' => $permission,'haspermission' => $haspermission]);
    }
    public function update($id,Request $request)
    {    	
    	$role=Role::findorFail($id);
    	$validator=validator::make($request->all(),[
    		'name'=>'required|unique:roles,name,'.$id.',id|min:3'
    	]);
    	if ($validator->passes()) 
    	{
    		$role->name=$request->name;
    		$role->save();

    		if(!empty($request->permission)){
    			$role->syncpermissions($request->permission);
    		}
    		else{
    			$role->syncpermissions([]);
    		}

    		return redirect()->route('role.index')->with('success','role updated successfully');
    	}
    	else
    	{
    		return redirect()->route('role.edit',$id)->withInput()->withErrors($validator);
    	}
    }
    public function destroy(Request $request,$id)
    {
    	Role::destroy(array('id',$id));
        session()->flash('success','Role delete successfully');
        return redirect('roles');
    }
}

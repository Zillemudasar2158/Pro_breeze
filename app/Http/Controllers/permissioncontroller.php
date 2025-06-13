<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class permissioncontroller extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return
        [
            new Middleware('permission:view permissions',only:['index']),
            new Middleware('permission:edit permissions',only:['edit']),
            new Middleware('permission:create permissions',only:['create']),
            new Middleware('permission:delete permissions',only:['destroy']),
        ];
    }
    public function index()
    {
    	$permissions=Permission::paginate(10);
	    return	view('permission.list',['permission' => $permissions]);
    }
    public function create()
    {
	    return	view('permission.create');
    }
    public function store(request $request)
    {
    	$validator=validator::make($request->all(),[
    		'name'=>'required|unique:permissions|min:3'
    	]);

    	if ($validator->passes()) 
    	{
    		Permission::create(['name'=>$request->name]);
    		return redirect()->route('permission.list')->with('success','Permission addedd successfully');
    	}
    	else
    	{
    		return redirect()->route('permission.create')->withInput()->withErrors($validator);
    	}
    }	
    public function edit($id)
    {
    	$permissions=Permission::findorFail($id);
    	return	view('permission.edit',['permission' => $permissions]);
    }
    public function update($id,Request $request)
    {
    	$permissions=Permission::findorFail($id);
    	$validator=validator::make($request->all(),[
    		'name'=>'required|unique:permissions,name,'.$id.',id|min:3'
    	]);
    	if ($validator->passes()) 
    	{
    		$permissions->name=$request->name;
    		$permissions->save();
    		return redirect()->route('permission.list')->with('success','Permission updated successfully');
    	}
    	else
    	{
    		return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);
    	}
    }
    public function destroy(Request $request,$id)
    {
    	Permission::destroy(array('id',$id));
        session()->flash('success','Permission delete successfully');
        return redirect('permissions');
    }
}

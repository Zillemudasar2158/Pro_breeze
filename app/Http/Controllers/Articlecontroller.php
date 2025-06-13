<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class Articlecontroller extends Controller implements HasMiddleware
{
    public static function Middleware():array
    {
        return
        [
            new Middleware('permission:view articles',only:['index']),
            new Middleware('permission:edit articles',only:['edit']),
            new Middleware('permission:create articles',only:['create']),
            new Middleware('permission:delete articles',only:['destroy']),
        ];
    }
    public function index()
    {
        $article=Article::paginate(10);
        return view('articles.list',['article'=>$article]);
    }
    public function create()
    {
        return view('articles.create');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required|min:5'
        ]);

        if ($validator->passes()) {
            
            $article= new Article();
            $article->title=$request->title;
            $article->text=$request->text;
            $article->author=$request->author;
            $article->save();
            
            return redirect()->route('articles.index')->with('success','Article addedd successfully');
        }
        else
        {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }

    }
    public function edit($id)
    {
        $article=Article::findorFail($id);
        return  view('articles.edit',['article' => $article]);
        
    }
    public function update(Request $request, $id)
    {
        $article=Article::findorFail($id);
        $validator=validator::make($request->all(),[
            'title'=>'required|unique:articles,title,'.$id.',id|min:3'
        ]);
        if ($validator->passes()) 
        {
            $article->title=$request->title;
            $article->text=$request->text;
            $article->author=$request->author;
            $article->save();
            return redirect()->route('articles.index')->with('success','Article updated successfully');
        }
        else
        {
            return redirect()->route('articles.edit',$id)->withInput()->withErrors($validator);
        }
    }
    public function destroy(Request $request,$id)
    {
        Article::destroy(array('id',$id));
        session()->flash('success','Article delete successfully');
        return redirect('articles');
    }
}

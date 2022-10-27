<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categoriesresource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category as ModelsCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoriesResource(category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $request->validate(['title'=>'required']);
        $category=new Category();
        $category->title=$request->get('title');
        $category->save();
       return  response(['added successfully','category'=>$category]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     

        
        return new  CategoryResource(Category::find($id));
    }


    public function caetgoryWithPosts($id)
    {     

        $category=Category::with(['posts'])->where('id',$id)->get();
             return $category;
       // return new  CategoryResource($category);
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
        $category=category::find($id);
        $category->title=$request->get('title');
        $category->save();
        return 'updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=category::find($id);
        $category->delete();
        return'deleted';
    }

    public function insert(Request $request)
    {
        $c=new category();
         $c->title=$request->title;
         return $c->save();
    }


}

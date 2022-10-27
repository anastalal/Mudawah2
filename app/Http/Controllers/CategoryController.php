<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryPostsResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories= Category::whereNotNull('id');
        $data =  CategoryResource::collection($categories->get());
        return $data;
    }

    public function store(Request $request)
    {
       return  Category::create([
         "title"=>$request->title

        ]);

    }

    public function getPostsByCategory(Request $request){
        $categories=Category::orderBy('created_at', 'DESC');//('category_id',$request->category_id);

        $data =  CategoryPostsResource::collection($categories->where('id',$request->category_id)->get());
         
        return $data;
    }

}

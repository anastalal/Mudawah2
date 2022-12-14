<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryPostsResource;
use App\Models\category;
use App\Models\post_category;
use Illuminate\Http\Request;

class postCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(postCategoryController $post_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function edit(postCategoryController $post_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, postCategoryController $post_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(postCategoryController $post_category)
    {
        //
    }


    public function posts($id)
    {
        $category=category::find($id);
        $posts=$category->posts;
        return new  CategoryPostsResource($posts);

    }
}

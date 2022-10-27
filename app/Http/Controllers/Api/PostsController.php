<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\Commentsresource;
use App\Http\Resources\postCommentsResources;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Http\Resources\CategoryPostsResource;
use App\Http\Resources\UserCommentsResource;
use App\Models\Category;
use App\Models\Post ;
use App\Models\post_category ;
use Illuminate\Http\Request;
//use Intervention\Image\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PostsResource(Post::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //handle validate problem>>>
        /*$request->validate([
            'title'=>'required',
            'content'=>'required',
            'date_written'=>'required',
            'user_id'=>'required',
            'category_id '=>'category_id'
 
         ]);*/
         if ($request->featured_image) {
            $image= $request->featured_image;
            $fileName   = time() . '.' . $image->getClientOriginalName();
            $img =  Image::make($image->getRealPath());
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/users/licences' . '/' . $fileName, $img, 'public');
            $featured_image = 'users/licences/'  . $fileName;
        }
        $post=new Post();
        $post->title=$request->title;
        $post->content=$request->content;
       $post->date_written=now();
       $post->user_id=$request->user_id;
       $post->category_id=$request->category_id;
       $post->featured_image=$featured_image;
        $post->save();
        return response(['success','post'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
       $post=Post::find($id);
       return new PostResource($post);
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
        $post=Post::find($id);
        if($request->has('title')){
            $post->title=$request->title;
        }
        if($request->has('content')){
            $post->content=$request->content;
        }
       
        if($request->has('category_id')){
            $post->category_id=$request->category_id;
        }
       
       
       
        $post->save();
        return response(['post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post)
           $post->delete(); 
        else
            return response()->json('error');
        return response()->json('deleted'); 
    }

    public function postsByCategory($id){
        $category=category::find($id);
        
        return new CategoryPostsResource($category->posts);
   
    }
    public function comments($id)
    {
            $post=Post::find($id);
            $comments=$post->comment;
            return $comments;
    }

    public function postWithComments($id)
    {
           $post=Post::with(['Comment','user'])->where('id',$id)->get();
            return $post;
    }

    public function postWithAuthorWithComments($id)
    {
        //handle no response returned>>>
           $post=Post::with(['comment','user','comment'])->where('id',$id)->get();
            return  $post;
    }
    
    


}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryPostsResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('seen', 'DESC');

        if (isset($_GET['category_id']) && $_GET['category_id']) {
            $posts->where('category_id', $request->category_id);
        }

        if (isset($_GET['id']) && $_GET['id']) {
            $posts->where('id', $request->id);
        }

        $data =  PostResource::collection($posts->get());

        return $data;
    }
   
    public function getRecentPosts(Request $request){
        $posts = Post::orderBy('created_at', 'DESC');

        if (isset($_GET['category_id']) && $_GET['category_id']) {
            $posts->where('category_id', $request->category_id);
        }

        if (isset($_GET['id']) && $_GET['id']) {
            $posts->where('id', $request->id);
        }

        $data =  PostResource::collection($posts->get());

        return $data;
    }

    public function getDoctorPosts(Request $request){
       // $posts=Post::where('user_id',709);
        $posts = Post::orderBy('created_at', 'DESC');
         
        if (isset($_GET['category_id']) && $_GET['category_id']) {
            $posts->where('category_id', $request->category_id);
        }

        if (isset($_GET['id']) && $_GET['id']) {
            $posts->where('id', $request->id);
        }
        if($posts->where('user_id',$request->doctor_id)->count() == 0){
          return response(['res'=>'no data']);
        }

        $data =  PostResource::collection($posts->where('user_id',$request->doctor_id)->get());
         
        return $data;
    }

    public function getPostsByCategory(Request $request){
       // $posts=Post::where('user_id',709);
        $posts = Post::orderBy('created_at', 'DESC');
         
        if (isset($_GET['category_id']) && $_GET['category_id']) {
            $posts->where('category_id', $request->category_id);
        }

        if (isset($_GET['id']) && $_GET['id']) {
            $posts->where('id', $request->id);
        }
        if($posts->where('category_id',$request->category_id)->count() == 0){
          return response(['res'=>'no data']);
        }
       // $category=Category::find($request->category_id);

        $data =  CategoryPostsResource::collection($posts->where('category_id',$request->category_id)->get());
         
        return $data;
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=new  Post();

        $fileName = '';
        if (isset($request->image) && $request->image != null) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $request->image
            );
            Storage::put('public/posts/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/posts/' . $name, $file);
            $fileName = 'posts/' . $name;
           // return $fileName;
           //  $post->featured_image->$fileName;
             $post->featured_image=$fileName;

        }

        $post->title= $request->title;
        $post->content= $request->content;
        $post->user_id= $request->user()->id;
        $post->featured_image= $request->featured_image;
        $post->date_written= Date::now();
       // $post->categories()->attach(402);
        $post->save();
        
        return Post::all();
        /*return Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
            'featured_image' => $fileName,
            'date_written' => date('Y-m-d')
        ]);*/
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

         $post=Post::find($request->post_id);
        $post->update(['seen' => $post->seen + 1]);


        return new PostResource(Post::find($post->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $post = Post::find($id);

        if (isset($request->title) && $request->title) {
            $post->title = $request->title;
        }

        if (isset($request->content) && $request->content) {
            $post->content = $request->content;
        }

        if (isset($request->category_id) && $request->category_id) {
            $post->category_id = $request->category_id;
        }

        $post->save();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);


        if (!is_null($post)) {

            $delete = Post::find($post)[0]->delete();
            if ($delete == 1) {
                return [
                    'Post no ' . $post->id . ' done removed successfully',
                ];
            }
        } else {
            return [
                'There is no post with this id',
            ];
        }
    }
}

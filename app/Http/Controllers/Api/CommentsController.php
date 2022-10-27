<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Commentresource;
use App\Http\Resources\Commentsresource;
use App\Models\comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=comment::paginate();
        return new Commentsresource($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data=$request->validate([
                            'content'=>'required',
                            'user_id'=>'required',
                            'post_id'=>'required',

        ]);
        //$data->date_written=date('Y-m-d');
        $comment=Comment::create([
            'content'=>$request->content,
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id,
            'date_written'=>date('Y-m-d')
            ]
        );
        return response(['res'=>'added successfully','comment'=>$comment]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CommentResource(comment::find($id));
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
        $comment=Comment::find($id);
        
        if($request->has('content')){
          $comment->content=$request->content;
        }
        $comment->save();
        return response(['updated successfully','comment'=>$comment]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->delete;
        return response(['deleted successfully','comment deleted'=>$comment]);
    }


   
}

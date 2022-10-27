<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCommentsResource;
use App\Http\Resources\UserPostResource;
use App\Http\Resources\UserPostsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Models\comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return new UsersResource($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $email =   $request->email;
        $password = bcrypt($request->password);
        $parent_id =   $request->parent_id;
        $phone_no = $request->phone_no;
        // $device_token =   $request->device_token;
        if ($request->avatar) {
            $image = $request->avatar;
            $fileName   = time() . '.' . $image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/users/licences' . '/' . $fileName, $img, 'public');
            $avatar = 'users/licences/'  . $fileName;
        }
        $user = User::create(
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'imgages' => $avatar,
                'parent_id' => $parent_id
            ]
        );
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
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
        $user = User::find($id);

        if ($request->has('name')) {
            $name = $request->name;
            $user->name = $name;
            $user->save();
        }
        if ($request->has('email')) {
            $email = $request->email;
            $user->email = $email;
            $user->save();
        }
        if ($request->has('password')) {
            $password = bcrypt($request->password);
            $user->password = $password;
            $user->save();
        }
        if ($request->has('avatar')) {
            $image = $request->avatar;
            $fileName   = time() . '.' . $image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/users/licences' . '/' . $fileName, $img, 'public');
            $avatar = 'users/licences/'  . $fileName;
            $user->imgages = $avatar;
            $user->save();
        }
        if ($request->has('parent_id')) {
            $parent_id =   $request->parent_id;
            $user->parent_id = $parent_id;
            $user->save();
        }


        return response(['user updated', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response(['user deleted ', 'user:' => $user]);
    }

    /**
     * @param $id
     * @return UserPostsResources
     */
    public function posts($id)
    {
        $user = User::find($id);
        $posts = $user->post;
        return new UserPostsResource($posts);
    }

    public function comments($id)
    {
        $user = User::find($id);
        $comments = $user->comment;
        return UserResource::collection($comments);
    }

    public function usersByRole($id)
    {
        $users = User::where('role_id', $id)->get();
        return $users;
    }
}

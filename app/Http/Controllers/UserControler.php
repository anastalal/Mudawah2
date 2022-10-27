<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorResource;
use App\Http\Resources\UserResource;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotNull('id');

        if (isset($_GET['id']) && $_GET['id'] != null) {
            $users->where('id', $_GET['id']);
        }

        if (isset($_GET['role_id']) && $_GET['role_id'] != null) {
            $users->where('role_id', $_GET['role_id']);
        }
        $data = DoctorResource::collection($users->get());


        return $data;
    }
   
    public function getUsers(Request $request){
        $users = User::orderBy('created_at', 'DESC');
        

        if (isset($_GET['user_id']) && $_GET['user_id']) {
            $users->where('user_id', $request->category_id);
        }

        if (isset($_GET['id']) && $_GET['id']) {
            $users->where('id', $request->id);
        }
           
        $data =  DoctorResource::collection($users->get());

        return $data;
   
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
        $Uname = $request->name;
        $email =   $request->email;
        $password = bcrypt($request->password);
        $parent_id =   $request->parent_id;
        $role_id=$request->role_id;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:users,email',
        ]);
        if ($validator->fails()) {
            return response(['res' => $validator->errors()->all()], 422);
        }
        $impFileName = '';
   

        foreach (explode(',', $request->images)  as  $value) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $value
            );
            Storage::put('public/users/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/users/' . $name, $file);
            $fileName = 'users/' . $name;
            $arrFileName[] = $fileName;
        }
        if (isset($arrFileName)) {
            $impFileName = implode(',', $arrFileName);
        }

 

        $avatar = null;
        if (isset($request->avatar) && $request->avatar != null) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $request->avatar
            );
            Storage::put('public/users/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/users/' . $name, $file);
            $avatar = 'users/' . $name;
        }
        

        $user = User::create(
            [
                'name' => $Uname,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar,
                'parent_id' => $parent_id,
               // 'images' => $impFileName
                'imgages' => $impFileName,
                'role_id'=>$role_id
            ]
        );
       $data=   [
            'id' => $user->id,
            'role_id' => $user->role_id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'avatar' => $user->avatar,
            'imgages' => $user->imgages,
            'likes' => $user->likes,
            'description' => $user->description,
            'followers' => $user->followers,
            'parent_id' => $user->parent_id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'seen' => $user->seen,
            'phone_number' => $user->phone
            
        ];
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $data, 'token' => $accessToken]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $data=   [
                    'id' => $user->id,
                    'role_id' => $user->role_id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'avatar' => $user->avatar,
                    'imgages' => $user->imgages,
                    'likes' => $user->likes,
                    'description' => $user->description,
                    'followers' => $user->followers,
                    'parent_id' => $user->parent_id,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'seen' => $user->seen,
                    'phone_number' => $user->phone
                    
                ];
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [

                    'token' => $token,
                    'user' => $data
                ];
                if (isset($request->device_token)) {
                    $user->device_token = $request->device_token;
                }
                $user->save();
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data =  UserResource::collection($user->get());

        return $data;
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
    public function update(Request $request)
    {
        $user = $request->user();

        if (isset($request->avatar) && $request->avatar != null) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $request->avatar
            );
            Storage::put('public/users/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/users/' . $name, $file);
            $user->avatar = 'users/' . $name;
        }

        if (isset($request->name) && $request->name != null) {
            $user->name = $request->name;
        }

        if (isset($request->email) && $request->email != null) {
            $user->email = $request->email;
        }
   

        $save =  $user->save();
        $data=   [
            'id' => $user->id,
            'role_id' => $user->role_id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'avatar' => $user->avatar,
            'imgages' => $user->imgages,
            'likes' => $user->likes,
            'description' => $user->description,
            'followers' => $user->followers,
            'parent_id' => $user->parent_id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'seen' => $user->seen,
            'phone_number' => $user->phone
            
        ];
        if ($save) {
            return
                $data;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

    public function changePassword(Request $request) {
        if (!(Hash::check($request->get('current-password'), $request->user()->password))) {
            // The passwords matches
            return response(["res"=>"Your current password does not matches with the password."] );
        }
        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return response(["res"=>"errorNew Password cannot be same as your current password."]);
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
            

        ]);
        //'new-password_confirmation' => 'required|between:8,255|confirmed',
        //Change Password
        $user = $request->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return response(["res"=>"Password successfully changed!"]);
 
   }
}

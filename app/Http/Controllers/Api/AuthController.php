<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AuthController extends Controller
{


    public function show()
    {
        //
    }
   /* public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [

                    'token' => $token,
                    'user' => $user
                ];
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
*/

    public function register(Request $request)
    {
        $name = $request->name;
        $email =   $request->email;
        $password = bcrypt($request->password);
        $parent_id =   $request->parent_id;
        $phone_no=$request->phone_no;
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
                'imgages' =>$avatar,
                'parent_id'=>$parent_id
            ]
        );
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);

        
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [

                    'token' => $token,
                    'user' => $user
                ];
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
    /*
    public function register(Request $request)
    {
        $fields=$request->validate([
           'name'=>'required|string',
           'email'=>'rquired|string|email|unique:users,email',
           'password'=>'rquired|confirmed'
        ]);

        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
        ]);
         //create token
         $token = $user->createToken('myapptoken')->plainTextToken;

         $response = [
             'status'=>true,
             'message'=>'registered successfully!',
             'data' =>[
                 'user'=>$user,
                 'token'=>$token
             ]
         ];
         return response($response,201)->json($user);
    }

   /*
    public function login1(Request $request)
    {
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password' =>'required|confirmed'
        ]);
        //check email
        $user = User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['status'=>false,'message'=>'invalid email or password'],401);
        }

        //create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status'=>true,
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$user,
                'token'=>$token
            ]
        ];
        return response($response,201);
    }
*/
 /*   public function logout(Request $request){
        auth()->user()->tokens()->delete();
        $response = [
            'status'=>true,
            'message'=>'Logout successfully',
        ];
        return response($response,201);
    }



*/}

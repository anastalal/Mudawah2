<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
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
        if($request->has('facibility_id')){
            $phone=   Phone::create([
                'phone_number' => $request->phone_number,
                'description' => $request->description,
                'facibility_id' => $request->facibility_id,
            ]);
            $data=[
                'id'=>$phone->id,
                'phone_number'=>$phone->phone_number,
                'description'=>$phone->description,
                'facibility_id'=>$phone->facibility_id,
            ];
            return $data;
        }
        else{
            $user1=User::find(2);
            $user=$request->user();
          $phone=   Phone::create([
                'phone_number' => $request->phone_number,
                'description' => $request->description,
                'user_id' => $user->id,
                
            ]);
            
            return [
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
        }
      
      //  $data =  UserResource($user1->get());

        //return response([$data,200]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user=$request->user();
        $phone=Phone::find($request->old_phone_number);
        $phone->phone_number=$request->phone_number;
        $phone->save();
        return response(['phone'=>$phone],'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        //
    }
}

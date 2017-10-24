<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;

class UsersController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('users.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {   

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->hasFile('photo')){

            if($user->photo != 'default-user-image.png'){
                Storage::disk('public')->delete($user->photo);
            }

            $filename = 'user_avatar/'.time().'.'.$request->file('photo')->getClientOriginalExtension();

            $img = Image::make($request->file('photo')->getRealPath())->resize(600, 600)->stream();

            Storage::disk('public')->put($filename, $img, 'public');

            $user->photo = $filename;
        }

        $user->save();

        return redirect()->route('users.show', $id)->with('message', 'Profile edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect('/')->with('message', 'User deleted successfully');
    }
}

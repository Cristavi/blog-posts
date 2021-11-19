<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class User_controller extends Controller
{

    public function index(User $user){

        return view('profile.myProfile', [
            "user" => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);


        $this->validate($request, [
            'fname' => 'required|max:255|min:3',
            'lname' => 'required|max:255|min:3',
            'profile_picture' => 'image|mimes:jpeg,png,jpg'
        ]);

        $image_name = time().'.'.$request->profile_picture->extension();

        $request->profile_picture->move(public_path('images'), $image_name);

        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->profile_picture = $image_name;

        $user->save();

        \toastr()->info('The profile has been updated');

        return back();
    }
}

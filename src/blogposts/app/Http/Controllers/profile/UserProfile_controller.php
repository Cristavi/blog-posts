<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfile_controller extends Controller
{
    public function index(User $user){

        $blogs = $user->posts()->with(['user', 'has', 'have'])->paginate(perPage: 20);


        return view('profile.index',[
            'blogs' => $blogs,
            'user' => $user
        ]);
    }
}

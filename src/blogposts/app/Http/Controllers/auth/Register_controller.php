<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Register_controller extends Controller
{
    public function index(){
        return view('authentication.register');
    }

    public function store(Request $request){
        $this->validate($request, [
            'fname' => 'required|max:255|min:3',
            'lname' => 'required|max:255|min:3',
            'username' => 'required|max:255|min:6|unique:users,lname',
            'email' => 'required|max:255|unique:users,fname',
            'password' => 'required|confirmed|min:8',
            'profile_picture' => 'image|mimes:jpeg,png,jpg'
        ]);


        try{

            $image_name = time().'.'.$request->profile_picture->extension();

            $request->profile_picture->move(public_path('images'), $image_name);

            User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'username' => $request->username,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
                'profile_picture' => $image_name

            ]);
        }
        catch(QueryException $qe){
            $errcode = $qe->errorInfo[1];
            if($errcode == '1062'){
                \toastr()->error('Something went wrong');
                return back();
            }
        }



        \toastr()->info('Registered successfully');

        return redirect()->route('blogs');
    }
}

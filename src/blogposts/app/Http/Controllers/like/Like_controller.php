<?php

namespace App\Http\Controllers\like;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Like_controller extends Controller
{
    public function store(Request $request, Blogs $blogs){



        if($blogs->likedBy($request->user())){
            \toastr()->error("You have already liked this blog");

            return back();


        }

        $blogs->has()->create([
            'user_id' => $request->user()->id
        ]);


        return back();
    }


    public function destroy(Blogs $blogs, Request $request): RedirectResponse{
        $request->user()->likes()->where('blogs_id', $blogs->id)->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Comments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Blog_controller extends Controller
{
    public function index(Blogs $blog){

        $blogs = Blogs::latest()->with(['user'])->paginate(20);


        return view('blogs.index', [
            'blogs' => $blogs,


        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



        $this->validate($request, [
            'body' => 'required',
            'content_image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $image_name = time().'.'.$request->content_image->extension();

        $request->content_image->move(public_path('images'), $image_name);


        $request->user()->posts()->create([
            'body' => $request->body,
            'content_image' => $image_name
        ]);

        \toastr()->success('Blog posted successfully successfully');

        return back();
    }

    public function single(Blogs $blogs){

        return view('blogs.single', [
            'blog' => $blogs
        ]);
    }

    public function destroy(Request $request, Blogs $blogs): RedirectResponse
    {
        $blogs->delete();

        \toastr()->error('Post has been deleted');

        return back();
    }

    public function update(Request $request, $id){
        $blogs = Blogs::find($id);

        $this->validate($request, [
            'body' => 'required',
            'content_image' => 'image|mimes:jpeg,png,jpg'
        ]);


        $image_name = time().'.'.$request->content_image->extension();

        $request->content_image->move(public_path('images'), $image_name);

        $blogs->body = $request->input('body');
        $blogs->content_image = $image_name;

        $blogs->save();

        \toastr()->info('Blog updated successfully');

        return redirect()->route('blogs');

    }


}

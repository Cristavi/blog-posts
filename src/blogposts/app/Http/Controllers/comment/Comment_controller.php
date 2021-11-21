<?php

namespace App\Http\Controllers\comment;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Comments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Comment_controller extends Controller
{
    public function store(Request $request, Blogs $blogs){

        $this->validate($request, [
           'comment_body' => 'required'
        ]);

        $blogs->have()->create([
            'user_id' => $request->user()->id,
            'comment_body' => $request->comment_body
        ]);

        \toastr()->info('Comment added');

        return back();
    }

    public function destroy(Request $request, Comments $comments): RedirectResponse
    {


        $comments->delete();

        \toastr()->error('Comment has been deleted');

        return back();
    }

    public function single($_id){

        return view('comments.single', [
            'comment' => Comments::where('_id', '=', $_id)->first()
        ]);
    }

    public function update(Request $request, $id){



        $comments = Comments::find($id);


        $this->validate($request, [
            'comment_body' => 'required'
        ]);

        $comments->comment_body = $request->input('comment_body');

        $comments->save();

        \toastr()->info('The comment has been updated');

        return redirect()->route('blogs');

    }
}

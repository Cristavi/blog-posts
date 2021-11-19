@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <form method="post" action="{{ route('comment', $comment->id) }}" >
            @csrf
            @method("PUT")
            <div class="w-full bg-white p-6 rounded-lg mt-2" id="blogsStyle">
                <label>Edit comment</label>
                <textarea  class="w-full bg-gray-100 p-2 mt-2 mb-3" name="comment_body" placeholder="Enter your blog caption" >{{ $comment->comment_body }}</textarea>
                @error('comment_body')
                <div class="text-red-500 mb-3">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="py-2 px-4 bg-green-300 text-white rounded hover:bg-green-900 mr-2">Update</button>

            </div>
        </form>
    </div>

@endsection

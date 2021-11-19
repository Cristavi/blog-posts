@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <form method="post" action="{{ route('updatePost', $blog->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
        <div class="w-full bg-white p-6 rounded-lg mt-2" id="blogsStyle">
            <label>Edit caption</label>
            <textarea  class="w-full bg-gray-100 p-2 mt-2 mb-3" name="body" placeholder="Enter your blog caption" >{{ $blog->body }}</textarea>
            @error('body')
            <div class="text-red-500 mb-3">
                {{ $message }}
            </div>
            @enderror
            <label>Post image</label>
            <input type="file" name="content_image" src="{{ asset('/images').'/'.$blog->content_image }}" class="w-full bg-gray-100 p-2 mt-2 mb-3" />

            @error('content_image')
            <div class="text-red-500 ">
                {{ $message }}
            </div>
            @enderror
            <button type="submit" class="py-2 px-4 bg-green-300 text-white rounded hover:bg-green-900 mr-2">Update</button>

        </div>
        </form>
    </div>

@endsection

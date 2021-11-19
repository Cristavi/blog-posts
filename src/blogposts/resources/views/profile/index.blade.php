@extends('layout.app')

@section('content')
    <div class="flex justify-center mt-9">
        <div class="float-left  w-7/12">
            <div class="float-left w-1/3 h-4/5">
                <img src="{{ asset('/images'.'/'.$user->profile_picture) }}" class="border-l relative rounded-full float-left w-full h-full inline-flex"  alt="profile_pic">
            </div>

            <p class="font-bold text-3xl mt-20 pl-10">{{ $user->fname }} {{ $user->lname }}</p>
            <p class="font-italic text-lg  pl-10">Posted {{ $blogs->count() }} {{ Str::plural('blog', $blogs->count()) }}</p>
            <p class="font-italic text-lg  pl-10">Received {{ $user->receivedLikes->count() }} likes</p>
        </div>



    </div>

    <div class="flex justify-center mt-9">

        @if($blogs->count())
            @foreach($blogs as $blog)
                <div class="flex justify-center">
                    <div class="w-8/12 bg-white p-6 rounded-lg mt-2 border-gray-400 border-2" id="blogsStyle">
                        <div class="px-10 ">
                            <div class="float-left  w-full ">
                                <img src="{{ asset('/images'.'/'.$blog->user->profile_picture) }}"
                                     class="border-l rounded-full float-left  h-20 inline-flex"  alt="profile_pic"/>
                                <div class="float-left">
                                    <a href="{{ route('user.profile', $blog->user->username) }}"><p class=" py-4 px-4 font-weight-bold float-left font-sans text-2xl">{{ $blog->user->fname }} {{ $blog->user->lname }}</p></a>

                                    <br/>
                                    <p class=" px-4  font-weight-bold  font-sans text-xs">Posted {{ $blog->created_at->diffForHumans() }}</p>
                                </div>

                                @can('edit', $blog)
                                    <div class="float-right pr-5">
                                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                            <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                                <span>More options</span>
                                                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </button>
                                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('single', $blog->id) }}">Update post</a>
                                                    <form method="post" action="{{ route('deleteBlog', $blog->id) }}">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">Delete post</button>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan




                            </div>



                        </div>
                        <div class="justify-center float-left mt-8 w-full px-10 ">
                            <img src="{{ asset('/images').'/'.$blog->content_image }}" class="justify-content-between" alt="blog_img" data-content_image="{{ asset('/images').'/'.$blog->content_image }}" />
                        </div>

                        <div class="justify-center float-left w-full mt-5 w-full px-10 mb-5" data-body="{{ $blog->body }}" data-id="{{ $blog->id }}" >
                            {{$blog->body}}
                        </div>

                        <div class="block mt-2 align-content-end px-10 py-0">
                            {{ $blog->has->count() }} {{ Str::plural('like', $blog->has->count()) }}&nbsp; &nbsp;

                            @auth
                                @if(!$blog->likedBy(auth()->user()))

                                    <form action="{{ route('like', $blog->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-black-50 font-weight-bolder mt-2">
                                            Like
                                        </button>
                                    </form>

                                @else
                                    <form action="{{ route('unlike', $blog->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-black-50 font-weight-bolder mt-2">
                                            Unlike
                                        </button>
                                    </form>
                                @endif
                            @endauth

                        </div>

                        <div class="mt-5 w-full px-10 py-0">

                            @auth()
                                <form action="{{ route('comment', $blog->id) }}" method="post">
                                    @csrf
                                    <label class="">
                                        Comment
                                        <textarea type="text" name="comment_body" placeholder="Add your comments" class="w-full p-2 h-16 border-black border-2 rounded-lg"></textarea>
                                    </label>
                                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                        Comment
                                    </button>
                                </form>
                            @endauth


                            @if($blog->have->count())


                                <div class="mt-8">
                                    <p class="font-weight-bolder mt-8">Comments</p>
                                    <div class="float-left  w-full mt-5">
                                        @foreach($blog->have as $comment)
                                            <img src="{{ asset('/images'.'/'.$comment->user->profile_picture) }}"
                                                 class="border-l rounded-full float-left  h-20 inline-flex"  alt="profile_pic"/>
                                            <div class="float-left">
                                                <p class=" py-2 px-4 font-weight-bold float-left font-sans text-1.5xl">{{ $comment->user->fname }} {{ $comment->user->lname }}</p>
                                                <br/>
                                                <p class=" px-4 font-weight-bold float-left font-sans text-1xl">{{ $comment->comment_body }}</p>
                                                <br/>
                                                <p class="px-4 py-4  font-weight-bold  font-sans text-xs">Posted {{ $comment->created_at->diffForHumans() }}</p>
                                            </div>

                                            @can('control', $comment)
                                                <div class="float-right pr-5">
                                                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                                            <span>More options</span>
                                                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        </button>
                                                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('login') }}">Edit comment</a>
                                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('register') }}">Delete comment</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan




                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-8">No comments yet</div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
            @endif
    </div>
@endsection

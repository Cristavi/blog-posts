@extends('layout.app')

@section('content')
    <div class="flex justify-center">

        <div class="w-6/12 bg-white p-6 rounded-lg mt-2">
            <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="fname" id="fname" placeholder="Your first name" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                       @error('fname') border-red-500 @enderror " value="{{ old('fname') }}" />

                    @error('fname')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="lname" id="lname" placeholder="Your last name" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                       @error('lname') border-red-500 @enderror " value="{{ old('lname') }}" />

                    @error('lname')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" placeholder="Your username" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                        @error('username') border-red-500 @enderror" value="{{ old('username') }}" />

                    @error('username')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                           @error('email') border-red-500 @enderror" value="{{ old('email') }}" />

                    @error('email')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                        @error('password') border-red-500 @enderror" value="{{ old('password') }}" />

                    @error('password')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg" @error('password_confirmation') border-red-500 @enderror
                           value="{{ old('password_confirmation') }}"/>

                    @error('password_confirmation')
                    <div class="text-red-500 ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="flex mb-3 bg-grey-lighter">
                    <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-black">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class=" text-base leading-normal">Upload your image</span>
                        <input type='file' class="hidden" name="profile_picture" id="profile_picture" />
                    </label>
                </div>


                <div class="mt-3">
                    <button type="submit" class="bg-green-700 text-white px-4 py3 rounded font-medium w-full" >Register</button>
                </div>

            </form>
        </div>
    </div>
@endsection



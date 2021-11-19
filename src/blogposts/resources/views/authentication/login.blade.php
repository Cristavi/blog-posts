@extends('layout.app')

@section('content')
    <div class="flex justify-center">

        <div class="w-6/12 bg-white p-6 rounded-lg">
            <form method="post" action="#">

                @csrf
                <p class="text-center pb-3 mb-2">Login</p>

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
                          " value="{{ old('password') }}" />


                </div>
                <div class="mb-4">

                    <input type="checkbox" name="remember" id="remember" class="mr-2" />
                    <label for="remember">Remember me</label>
                </div>

                <div>
                    <button type="submit" class="bg-green-700 text-white px-4 py3 rounded font-medium w-full" >Login</button>
                </div>



                @if(session('status'))
                    <div class="bg-red-400 p-4 rounded-lg mt-6 text-white text-center">
                        {{ session('status') }}
                    </div>

                @endif

            </form>
        </div>
    </div>

@endsection

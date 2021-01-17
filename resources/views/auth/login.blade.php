@extends('layout.app')

@section('content')
    <div class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10 text-gray-800">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col" method="POST"
              action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="email">
                    Email Address
                </label>
                <input class="shadow border w-full py-2 px-3 @error('email') border-red-500 @enderror" id="email" name="email"
                       type="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow border w-full py-2 px-3 @error('password') border-red-500 @enderror"
                       id="password" type="password" name="password">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex items-center justify-between mt-2">
                <button class="bg-indigo-600 hover:bg-indigo-400 text-white font-bold py-2 px-4" type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </div>
@endsection

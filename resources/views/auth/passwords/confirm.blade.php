@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8">
                    Confirm Password
                </header>

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <p class="leading-normal text-gray-500">
                        Please confirm your password before continuing.
                    </p>

                    <div class="flex flex-wrap">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            Password:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap justify-center items-center space-y-6 pb-6 sm:pb-10 sm:space-y-0 sm:justify-between">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 text-base leading-normal no-underline text-gray-100 bg-indigo-500 hover:bg-indigo-700 sm:w-auto sm:px-4 sm:order-1">
                            Confirm Password
                        </button>

                        @if (Route::has('password.request'))
                        <a class="mt-4 text-xs text-indigo-500 hover:text-indigo-700 whitespace-no-wrap no-underline hover:underline sm:text-sm sm:order-0 sm:m-0"
                            href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</main>
@endsection

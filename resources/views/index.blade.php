@extends('layout.app')

@section('content')
    <section>
        <div class="max-w-3xl px-6 text-center mx-auto">
            <h2 class="text-3xl font-semibold text-gray-800">Hi there, <span
                    class="bg-indigo-600 text-white px-1">I'm Mark</span>.</h2>
            <img src="/img/headshot.jpg" alt="Mark Railton" class="w-48 mx-auto my-8 rounded-full">
            <p class="text-gray-600 mt-8 mb-8">
                I'm a software developer living in the beautiful County Wicklow, Ireland focusing on building web
                applications using PHP, Python and JavaScript.
            </p>
        </div>
    </section>

    <section class="bg-gray-800 pattern py-10">
        <div class="max-w-5xl px-6 mx-auto text-center">
            <h2 class="text-2xl font-semibold text-white">About Me</h2>
            <p class="text-white mt-4">
                At the end of 2013 I got bitten by the bug that is web development and ever since I've been hooked. I
                love improving my programming abilities and am generally willing to try anything twice (within reason).
            </p>

            <p class="text-white mt-4">
                Over the years I've worked with a few different programming languages, namely PHP, JavaScript,
                TypeScript and also some Python. I'm most comfortable building back end server based systems, but over
                the last couple of years I've also been experimenting more with front end development work and thanks to
                the React and Vue libraries I'm starting to feel a bit more comfortable on the front end of things as
                well.
            </p>

            <p class="text-white mt-4">
                If you've visited this site before, you'll likely know that I tend to use it as a bit of a playground.
                Currently, it's built using Laravel, a powerful PHP Framework. The front end styling is done using
                Tailwind CSS, an excellent utility based CSS framework that's making it a bit easier to get a good
                design going. I've also managed to sprinkle in some JavaScript thanks to the Vue library.
            </p>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="max-w-5xl px-6 mx-auto text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Latest Blog Articles</h2>

            <div class="flex flex-col items-center justify-center mt-6">
                @foreach($articles as $article)
                    <a class="mb-8 max-w-3xl w-full block bg-white shadow-md border-t-4 border-indigo-600"
                       href="{{ route('blog.article', ['article' => $article->slug]) }}">
                        <div class="flex items-center justify-between px-4 py-2">
                            <h3 class="text-lg font-medium text-gray-700">
                                {{ $article->title }}
                            </h3>
                            <span class="block text-gray-600 font-light text-sm">
                            {{ \Carbon\Carbon::parse($article->published_at)->format('jS M Y') }}
                        </span>
                        </div>
                    </a>
                @endforeach()
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="flex items-center text-gray-600 hover:underline hover:text-gray-500"
                   href="{{ route("blog.index") }}">
                    <span>View More</span>

                    <svg class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <newsletter-subscribe/>
@endsection()

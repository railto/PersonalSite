@extends('layout.app')

@section('content')
<section>
    <div class="flex flex-col items-center justify-center mt-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Blog Articles</h1>
        @foreach($articles as $article)
            <a class="mb-8 max-w-3xl w-full block bg-white shadow-md border-t-4 border-indigo-600" href="{{ route('blog.article', ['article' => $article->slug]) }}">
                <span class="flex items-center justify-between px-4 py-2">
                    <h3 class="text-lg font-medium text-gray-700">
                        {{ $article->title }}
                    </h3>
                    <span class="block text-gray-600 font-light text-sm">
                        {{ $article->published_at }}
                    </span>
                </span>
            </a>
        @endforeach
    </div>
    <div class="flex items-center justify-center mt-6">
        {{ $articles->links('pagination.blog') }}
    </div>
</section>
@endsection()

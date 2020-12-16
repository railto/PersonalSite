@extends('layouts.app')

@section('content')
    <div class="max-w-4xl px-6 mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 mt-12 mb-4">{{ $article->title }}</h1>
        <span
            class="block text-gray-600 font-light text-sm mb-8">Posted: {{ Carbon\Carbon::parse($article->published_at)->format('jS F Y') }}</span>
        <p>
            @parsedown($article->content)
        </p>
    </div>
@endsection()

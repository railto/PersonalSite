<x-app-layout>
    <section>
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-3xl font-semibold text-gray-800 mb-8">Blog Articles</h1>
            @foreach($articles as $article)
                <x-article-list-card :article="$article" />
            @endforeach
        </div>
        <div class="flex items-center justify-center mt-6">
            {{ $articles->links('pagination.articles') }}
        </div>
    </section>
</x-app-layout>

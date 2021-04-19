<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <id>{{ url('/feed') }}</id>
    <link href="{{ url('/rss') }}"></link>
    <title><![CDATA[{{ config('app.name') }}]]></title>
    <description></description>
    <language></language>
    <updated>{{ $articles->first()->updated_at->format('D, d M Y H:i:s +0000') }}</updated>
    @foreach ($articles as $article)
        <entry>
            <title><![CDATA[{{ $article->title }}]]></title>
            <link rel="alternate" href="{{ $article->path() }}" />
            <id>{{ $article->path() }}</id>
            <author>
                <name> <![CDATA[{{ $article->author->name }}]]></name>
            </author>
            <summary type="html">
                <![CDATA[{!! parsedown($article->content) !!}]]>
            </summary>
            <pubDate>{{ $article->published_at->format('D, d M Y H:i:s +0000') }}</pubDate>
            <updated>{{ $article->updated_at->format('D, d M Y H:i:s +0000') }}</updated>
        </entry>
    @endforeach
</feed>

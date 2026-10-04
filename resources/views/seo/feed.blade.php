<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>{{ config('app.name') }} — Blog</title>
        <link>{{ route('blog.index') }}</link>
        <description>Catatan, pengalaman, dan pembelajaran seputar jaringan, DevOps, dan web development.</description>
        <language>id</language>
        @foreach ($posts as $post)
        <item>
            <title>{{ $post->title }}</title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <guid>{{ route('blog.show', $post->slug) }}</guid>
            <description><![CDATA[{{ $post->excerpt_text }}]]></description>
            @if ($post->published_at)
            <pubDate>{{ $post->published_at->toRfc2822String() }}</pubDate>
            @endif
            @if ($post->category)
            <category>{{ $post->category }}</category>
            @endif
        </item>
        @endforeach
    </channel>
</rss>

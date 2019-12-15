@extends('layouts.rss')

@section('title', "Gistlogs for " . $author->name)
@section('url', Request::url())
@section('authorName', $author->name)

@section('entries')
    @foreach ($author->gists as $gistlog)
        <entry>
            <id>{{ $gistlog->localUrl() }}</id>
            <link type="text/html" rel="alternate" href="{{ $gistlog->localUrl() }}" />
            <title>{{ $gistlog->title }}</title>
            <published>{{ $gistlog->createdAt->format(DateTime::ATOM) }}</published>
            <updated>{{ $gistlog->updatedAt->format(DateTime::ATOM) }}</updated>
            <author>
                <name>{{ $gistlog->author }}</name>
            </author>
            <summary type="html"><![CDATA[{!! $gistlog->getPreview() !!}...]]></summary>
            <content type="html"><![CDATA[{!! $gistlog->renderHtml() !!}]]></content>
        </entry>
    @endforeach
@endsection

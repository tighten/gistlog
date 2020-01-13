<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>@yield('title')</title>
    <link href="@yield('url')" />
    <link type="application/atom+xml" rel="self" href="@yield('url')" />
    <updated>{{ date(DATE_ATOM) }}</updated>
    <id>@yield('url')</id>
    <author>
        <name>@yield('authorName')</name>
    </author>
    @yield('entries')
</feed>

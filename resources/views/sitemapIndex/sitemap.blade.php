<sitemap>
    @if (! empty($tag->url))
    <loc>{{ url($tag->url) }}</loc>
    @endif

    @if (! empty($tag->lastModificationDate))
    <lastmod>{{ $tag->lastModificationDate->format('Y-m-d') }}</lastmod>
    @endif
</sitemap>

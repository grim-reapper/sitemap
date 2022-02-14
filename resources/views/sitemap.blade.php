<?php echo '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<?php echo '<'.'?'.'xml-stylesheet type="text/xsl" href="nlm-sitemap.xsl"?>'. "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($tags as $tag)
        @include('fs::url')
    @endforeach
</urlset>

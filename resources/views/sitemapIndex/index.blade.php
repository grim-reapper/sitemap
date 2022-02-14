<?php echo '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<?php echo '<'.'?'.'xml-stylesheet type="text/xsl" href="nlm-sitemap.xsl"?>'. "\n" ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($tags as $tag)
    @include('fs::sitemapIndex/sitemap')
@endforeach
</sitemapindex>

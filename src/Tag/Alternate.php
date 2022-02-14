<?php

namespace FinalStrike\Sitemap\Tag;

class Alternate
{
    public $locale;

    public $url;

    public function __construct(string $url, $locale = '')
    {
        $this->setUrl($url);

        $this->setLocale($locale);
    }

    public function setUrl(string $url = ''): Alternate
    {
        $this->url = $url;

        return $this;
    }

    public function setLocale(string $locale = ''): Alternate
    {
        $this->locale = $locale;

        return $this;
    }

    public static function create(string $url, string $locale = ''): Alternate
    {
        return new static($url, $locale);
    }
}

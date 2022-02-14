<?php

namespace FinalStrike\Sitemap\Tag;

use Carbon\Carbon;
use DateTimeInterface;

class Sitemap
{
    public string $url;

    public Carbon $lastModificationDate;

    public function __construct(string $url)
    {
        $this->url = $url;

        $this->lastModificationDate = Carbon::now();
    }

    public static function create(string $url): Sitemap
    {
        return new static($url);
    }

    public function setUrl(string $url = ''): Sitemap
    {
        $this->url = $url;

        return $this;
    }

    public function setLastModificationDate(DateTimeInterface $lastModificationDate): Sitemap
    {
        $this->lastModificationDate = Carbon::instance($lastModificationDate);

        return $this;
    }

    public function path(): string
    {
        return parse_url($this->url, PHP_URL_PATH) ?? '';
    }
}

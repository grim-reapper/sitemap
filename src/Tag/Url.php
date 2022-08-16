<?php

namespace FinalStrike\Sitemap\Tag;

use Carbon\Carbon;
use DateTimeInterface;

class Url
{
    const CHANGE_FREQUENCY_ALWAYS = 'always';
    const CHANGE_FREQUENCY_HOURLY = 'hourly';
    const CHANGE_FREQUENCY_DAILY = 'daily';
    const CHANGE_FREQUENCY_WEEKLY = 'weekly';
    const CHANGE_FREQUENCY_MONTHLY = 'monthly';
    const CHANGE_FREQUENCY_YEARLY = 'yearly';
    const CHANGE_FREQUENCY_NEVER = 'never';

    public $url;

    public Carbon $lastModificationDate;

    public $changeFrequency;

    public $priority = 0.8;

    public $alternates = [];

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->lastModificationDate = Carbon::now();
        $this->changeFrequency = static::CHANGE_FREQUENCY_DAILY;
    }

    public static function create(string $url): Url
    {
        return new static($url);
    }

    public function setUrl(string $url = ''): Url
    {
        $this->url = $url;
        return $this;
    }

    public function setLastModificationDate(DateTimeInterface $lastModificationDate): Url
    {
        $this->lastModificationDate = Carbon::instance($lastModificationDate);
        return $this;
    }

    public function setChangeFrequency(string $changeFrequency): Url
    {
        $this->changeFrequency = $changeFrequency;

        return $this;
    }

    public function setPriority(float $priority): Url
    {
        $this->priority = max(0, min($priority, 1));

        return $this;
    }

    public function addAlternate(string $url, string $locale = ''): Url
    {
        $this->alternates[] = new Alternate($url, $locale);

        return $this;
    }

    public function path(): string
    {
        return parse_url($this->url, PHP_URL_PATH) ?? '';
    }
}

<?php

namespace FinalStrike\Sitemap;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SitemapIndex implements Responsable, Renderable
{
    protected $tags = [];

    public static function create(): SitemapIndex
    {
        return new static();
    }

    public function add($tag): SitemapIndex
    {
        if(is_string($tag)){
            $tag = \FinalStrike\Sitemap\Tag\Sitemap::create($tag);
        }
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return Response::make($this->render(), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }

    public function render(): string
    {
        $tags = $this->tags;

        return view('fs::sitemapIndex/index')
            ->with(compact('tags'))
            ->render();
    }
    public function writeToFile(string $path): SitemapIndex
    {
        file_put_contents($path, $this->render());

        return $this;
    }

    public function writeToDisk(string $disk, string $path): SitemapIndex
    {
        Storage::disk($disk)->put($path, $this->render());

        return $this;
    }
}

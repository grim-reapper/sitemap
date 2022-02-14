<?php

namespace FinalStrike\Sitemap;

use FinalStrike\Sitemap\Tag\Url;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Sitemap implements Responsable, Renderable
{
    protected $tags = [];

    public static function create(): Sitemap
    {
        return new static();
    }

    public function add($tag): Sitemap
    {
        if (is_iterable($tag)) {
            foreach ($tag as $item) {
                $this->add($item);
            }

            return $this;
        }

        if(is_string($tag)){
            $tag = Url::create($tag);
        }

        if(!in_array($tag, $this->tags)){
            $this->tags[] = $tag;
        }
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return Response::make($this->render(), 200, [
           'Content-Type' => 'text/xml'
        ]);
    }

    public function render(): string
    {
        $tags = collect($this->tags)->unique('url')->filter()->sortBy('url',SORT_NATURAL);
        return view('fs::sitemap')
            ->with(compact('tags'))
            ->render();
    }
    public function writeToFile(string $path): Sitemap
    {
        file_put_contents($path, $this->render());

        return $this;
    }
    public function writeToDisk(string $disk, string $path): Sitemap
    {
        Storage::disk($disk)->put($path, $this->render());

        return $this;
    }
}

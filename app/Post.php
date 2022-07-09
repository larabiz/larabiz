<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class Post
{
    public static $withoutTorchlight = false;

    public function __construct(
        public readonly string $filePath,
        public readonly string $id,
        public readonly string $authorName,
        public readonly string $imageUrl,
        public readonly string $title,
        public readonly string $slug,
        public readonly string $excerpt,
        public readonly string $content,
        public readonly int $certifiedForLaravelVersion,
    ) {
    }

    public static function all(?string $except = null) : Collection
    {
        return collect(glob(base_path('posts/*.md')))
            ->sortByDesc(fn ($i) => $i, SORT_NATURAL)
            ->map(function (string $path) use ($except) {
                if ($except && str_contains($path, $except)) {
                    return;
                }

                return self::getFromPath($path);
            })
            ->filter();
    }

    public static function get(string $id) : self
    {
        $callback = function () use ($id) {
            $files = glob(base_path("posts/*$id*.md"));

            throw_if(
                empty($files[0]),
                "Could not find file for $id"
            );

            return self::getFromPath($files[0]);
        };

        return cache()->rememberForever("post-$id", $callback);
    }

    public static function getFromPath(string $filePath) : self
    {
        $id = self::getIdFromPath($filePath);

        $callback = function () use ($filePath, $id) {
            $filePath = str($filePath);

            $filename = $filePath->basename('.md');

            $chunks = $filename->explode('-');

            $position = $chunks[0];

            unset($chunks[0], $chunks[1]);

            $slug = $chunks->implode('-');

            $unparsed = str(file_get_contents($filePath));

            preg_match('/<\!--.+Author:(.+)Image:(.+)Title:(.+)Excerpt:(.+)Certified for Laravel Version:(.+)-->(.+)/ims', $unparsed, $matches);

            $authorName = trim($matches[1]);

            $imageUrl = trim($matches[2]);

            $title = trim($matches[3]);

            $excerpt = trim($matches[4]);

            $certifiedForLaravelVersion = (int) trim($matches[5]);

            $content = trim($matches[6]);

            $args = compact(
                'filePath', 'id', 'authorName', 'imageUrl', 'title', 'slug', 'excerpt', 'content', 'certifiedForLaravelVersion',
            );

            return new self(...$args);
        };

        return cache()->rememberForever("post-$id", $callback);
    }

    public function author() : ?User
    {
        return cache()->rememberForever(
            "post-$this->id-author",
            fn () => User::whereName($this->authorName)->first()
        );
    }

    public function renderedContent() : HtmlString
    {
        return cache()->rememberForever(
            "post-$this->id-rendered-content", fn () => new HtmlString(Str::marxdown($this->content))
        );
    }

    public function createdAt() : Carbon
    {
        return Carbon::createFromTimestamp(stat($this->filePath)['ctime']);
    }

    public function updatedAt() : Carbon
    {
        return Carbon::createFromTimestamp(stat($this->filePath)['mtime']);
    }

    protected static function getIdFromPath(string $filePath)
    {
        $filename = str($filePath)->replace(base_path(), '')->basename('.md');

        return $filename->explode('-')[1];
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

class AppServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        Str::macro('marxdown', function (string $string) {
            $converter = new MarkdownConverter([
                'heading_permalink' => [
                    'html_class' => 'heading-permalink',
                    'id_prefix' => 'content',
                    'fragment_prefix' => 'content',
                    'insert' => 'before',
                    'min_heading_level' => 1,
                    'max_heading_level' => 6,
                    'title' => '',
                    'symbol' => '#',
                    'aria_hidden' => true,
                ],
            ]);

            return (string) $converter->convert($string);
        });
    }
}

class MarkdownConverter extends \League\CommonMark\MarkdownConverter
{
    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new HeadingPermalinkExtension);
        $environment->addExtension(new SmartPunctExtension);
        $environment->addExtension(new TableExtension);
        $environment->addExtension(new TorchlightExtension);

        parent::__construct($environment);
    }

    public function getEnvironment() : Environment
    {
        \assert($this->environment instanceof Environment);

        return $this->environment;
    }
}

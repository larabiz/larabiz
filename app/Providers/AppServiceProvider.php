<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;

class AppServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        Str::macro('lightdown', function (string $string) {
            $converter = new LightdownConverter();

            return (string) $converter->convert($string);
        });

        Str::macro('marxdown', function (string $string) {
            $converter = new MarxdownConverter([
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

class LightdownConverter extends \League\CommonMark\MarkdownConverter
{
    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new AutolinkExtension);
        $environment->addExtension(new DisallowedRawHtmlExtension);
        $environment->addExtension(new StrikethroughExtension);
        $environment->addExtension(new TorchlightExtension);

        parent::__construct($environment);
    }

    public function getEnvironment() : Environment
    {
        \assert($this->environment instanceof Environment);

        return $this->environment;
    }
}

class MarxdownConverter extends \League\CommonMark\MarkdownConverter
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

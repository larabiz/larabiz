<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(Browsershot::class, fn () => new Browsershot);
    }

    public function boot() : void
    {
        Str::macro('lightdown', fn (string $s) => (string) (new LightdownConverter)->convert($s));

        Str::macro('marxdown', function (string $string) {
            return (string) (new MarxdownConverter([
                'default_attributes' => [
                    Heading::class => [
                        'id' => fn (Heading $node) => Str::slug($node->firstChild()->getLiteral()),
                    ],
                ],
            ]))->convert($string);
        });

        Vite::useScriptTagAttributes(['defer']);
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
        $environment->addExtension(new DefaultAttributesExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
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

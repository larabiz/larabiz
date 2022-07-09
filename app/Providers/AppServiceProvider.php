<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        //
    }

    public function boot() : void
    {
        Str::macro('marxdown', function (string $string, array $options = []) {
            $converter = new MarkdownConverter($options);

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
        $environment->addExtension(new TorchlightExtension);

        parent::__construct($environment);
    }

    public function getEnvironment() : Environment
    {
        \assert($this->environment instanceof Environment);

        return $this->environment;
    }
}

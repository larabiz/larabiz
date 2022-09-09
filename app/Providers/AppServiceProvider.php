<?php

namespace App\Providers;

use App\Models\User;
use App\Fathom\Client;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use App\CommonMark\MarxdownConverter;
use App\CommonMark\LightdownConverter;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(Browsershot::class, fn () => new Browsershot);

        $this->app->bind(Client::class, function (Application $app) {
            return new Client(
                $app['config']->get('services.fathom.api_token'),
                $app['config']->get('services.fathom.site_id'),
            );
        });

        $this->app->bind(User::class, fn () => auth()->user());
    }

    public function boot() : void
    {
        Str::macro('lightdown', fn (string $s) => (string) (new LightdownConverter)->convert($s));

        Str::macro('marxdown', function (string $string) {
            $html = (string) (new MarxdownConverter([
                'default_attributes' => [
                    Image::class => ['loading' => 'lazy'],
                    Link::class => [
                        'rel' => function (Link $node) {
                            if (! str_contains($node->getUrl(), 'larabiz.fr') && ! Str::startsWith($node->getUrl(), '#')) {
                                return 'nofollow noopener noreferrer';
                            }
                        },
                        'target' => function (Link $node) {
                            if (! str_contains($node->getUrl(), 'larabiz.fr') && ! Str::startsWith($node->getUrl(), '#')) {
                                return '_blank';
                            }
                        },
                    ],
                ],
            ]))->convert($string);

            return preg_replace_callback('/<h(\d)>(.*)<\/h\d>/', function ($matches) {
                $cleanedUpStringForId = html_entity_decode(strip_tags($matches[2]));

                return '<h' . $matches[1] . ' id="' . Str::slug($cleanedUpStringForId) . '">' . $matches[2] . '</h' . $matches[1] . '>';
            }, $html);
        });
    }
}

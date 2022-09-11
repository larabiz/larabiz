<?php

namespace App\Providers;

use App\Models\User;
use App\Fathom\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Factory;
use Spatie\Browsershot\Browsershot;
use App\CommonMark\MarxdownConverter;
use App\CommonMark\LightdownConverter;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(Browsershot::class, fn () => new Browsershot);

        $this->app->bind(Client::class, function (Application $app) {
            return new Client(
                $app[Factory::class],
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
            $html = (string) MarxdownConverter::make()->convert($string);

            return preg_replace_callback('/<h(\d)>(.*)<\/h\d>/', function ($matches) {
                $cleanedUpStringForId = html_entity_decode(strip_tags($matches[2]));

                return '<h' . $matches[1] . ' id="' . Str::slug($cleanedUpStringForId) . '">' . $matches[2] . '</h' . $matches[1] . '>';
            }, $html);
        });
    }
}

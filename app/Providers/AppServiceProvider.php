<?php

namespace App\Providers;


use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloader;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloaderInterface;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParser;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParserInterface;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadService;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(NewsDownloaderInterface::class, function (){
            return new NewsDownloader();
        });

        $this->app->bind(NewsParserInterface::class, function (){
            return new NewsParser();
        });

        $this->app->bind(NewsDownloadServiceInterface::class, function (){
            return new NewsDownloadService(app(NewsDownloaderInterface::class), app(NewsParserInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

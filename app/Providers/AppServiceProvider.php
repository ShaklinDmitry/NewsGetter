<?php

namespace App\Providers;


use App\Modules\NewsGetter\Application\Services\NewsService;
use App\Modules\NewsGetter\Application\Services\NewsServiceInterface;
use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;
use App\Modules\NewsGetter\Infrastructure\Bus\Bus;
use App\Modules\NewsGetter\Infrastructure\Bus\BusInterface;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloader;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloaderInterface;
use App\Modules\NewsGetter\Infrastructure\NewsDuplicateEraser\NewsDuplicateEraser;
use App\Modules\NewsGetter\Infrastructure\NewsDuplicateEraser\NewsDuplicateEraserInterface;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParser;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParserInterface;
use App\Modules\NewsGetter\Infrastructure\Repositories\NewsRepository;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadService;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadServiceInterface;
use Illuminate\Support\ServiceProvider;
use function VeeWee\Xml\Xslt\Configurator\functions;

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


        $this->app->bind(NewsRepositoryInterface::class, function (){
            return new NewsRepository();
        });

        $this->app->bind(NewsServiceInterface::class, function(){
            return new NewsService(app(NewsRepositoryInterface::class));
        });

        $this->app->bind(BusInterface::class, function (){
            return new Bus();
        });

        $this->app->bind(NewsDuplicateEraserInterface::class, function (){
            return new NewsDuplicateEraser(app(NewsRepositoryInterface::class));
        });


        $this->app->bind(NewsDownloadServiceInterface::class, function (){
            return new NewsDownloadService(app(NewsDownloaderInterface::class), app(NewsParserInterface::class),
                                            app(NewsRepositoryInterface::class), app(NewsDuplicateEraserInterface::class));
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

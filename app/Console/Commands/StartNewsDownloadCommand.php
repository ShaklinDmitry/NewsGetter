<?php

namespace App\Console\Commands;

use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadServiceInterface;
use Illuminate\Console\Command;

class StartNewsDownloadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start-news-download-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsDownloadService = app(NewsDownloadServiceInterface::class);
        $newsDownloadService->download();
    }
}

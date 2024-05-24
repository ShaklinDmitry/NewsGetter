<?php

namespace App\Listeners;

use App\Modules\NewsGetter\Application\Services\NewsServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveNewsListener
{
    /**
     * @param NewsServiceInterface $newsService
     */
    public function __construct(private NewsServiceInterface $newsService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->newsService->saveNews($event->newsCollection);
    }
}

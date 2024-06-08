<?php

namespace App\Listeners;

use App\Modules\NewsGetter\Infrastructure\Bus\Bus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewsToBrokerListener
{
    /**
     * Create the event listener.
     */
    public function __construct(private Bus $bus)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->bus->sendMessage($event->newsCollection);
    }
}

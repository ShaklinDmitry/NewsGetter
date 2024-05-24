<?php

namespace App\Events;

use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsDownloadedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param NewsDTO[] $newsCollection
     */
    public function __construct(public array $newsCollection)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

<?php

namespace App\Modules\NewsGetter\Infrastructure\Bus;

use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;

interface BusInterface
{
    /**
     * @param array $messages
     * @return mixed
     */
    public function sendMessage(array $messages);
}

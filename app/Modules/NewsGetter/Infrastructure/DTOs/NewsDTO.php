<?php

namespace App\Modules\NewsGetter\Infrastructure\DTOs;

class NewsDTO
{

    /**
     * @param string $description
     * @param string $link
     * @param string $pubDate
     */
    public function __construct(public readonly string $description, public readonly string $link, public readonly string $pubDate)
    {
    }
}

<?php

namespace App\Modules\NewsGetter\Infrastructure\DTOs;

class NewsDTO
{

    /**
     * @param string $description
     * @param string $newsType
     * @param string $link
     * @param \DateTime $pubDate
     */
    public function __construct(public readonly string $description, public readonly string $newsType, public readonly string $link, public readonly \DateTime $pubDate)
    {
    }

    /**
     * @return array
     */
    public function asArray(){
        $array = get_object_vars($this);
        return $array;
    }
}

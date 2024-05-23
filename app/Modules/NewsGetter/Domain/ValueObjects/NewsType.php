<?php

namespace App\Modules\NewsGetter\Domain\ValueObjects;

class NewsType
{

    /**
     * @param string $name
     */
    public function __construct(public readonly string $name)
    {
    }

    /**
     * @param string $newsType
     * @return NewsType
     */
    public static function fromString(string $newsType): NewsType
    {
        return new self($newsType);
    }

}

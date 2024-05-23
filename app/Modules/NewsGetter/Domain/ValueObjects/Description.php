<?php

namespace App\Modules\NewsGetter\Domain\ValueObjects;

class Description
{

    /**
     * @param string $text
     */
    public function __construct(public readonly string $text)
    {
    }

    /**
     * @param string $text
     * @return Description
     */
    public static function fromString(string $text): Description
    {
        return new self($text);
    }

}

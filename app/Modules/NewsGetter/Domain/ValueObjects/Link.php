<?php

namespace App\Modules\NewsGetter\Domain\ValueObjects;

class Link
{

    /**
     * @param string $string
     */
    public function __construct(public readonly string $string)
    {
    }

    public static function fromString(string $string): Link
    {
        return new self($string);
    }

}

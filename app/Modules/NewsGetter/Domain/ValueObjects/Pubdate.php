<?php

namespace App\Modules\NewsGetter\Domain\ValueObjects;

class Pubdate
{

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(public readonly \DateTime $dateTime)
    {
    }

    /**
     * @param string $dateTime
     * @return Pubdate
     */
    public static function fromString(string $dateTime): Pubdate
    {
        $formattedPubDate = new \DateTime($dateTime);

        return new self($formattedPubDate);
    }


}

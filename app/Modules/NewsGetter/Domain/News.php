<?php

namespace App\Modules\NewsGetter\Domain;

use App\Modules\NewsGetter\Domain\ValueObjects\Description;
use App\Modules\NewsGetter\Domain\ValueObjects\Link;
use App\Modules\NewsGetter\Domain\ValueObjects\NewsType;
use App\Modules\NewsGetter\Domain\ValueObjects\Pubdate;

class News
{

    /**
     * @param Description $description
     * @param NewsType $newsType
     * @param Link $link
     * @param Pubdate $pubdate
     */
    public function __construct(public readonly Description $description, public readonly NewsType $newsType, public readonly Link $link, public readonly Pubdate $pubdate)
    {
    }

    /**
     * @param Description $description
     * @param NewsType $newsType
     * @param Link $link
     * @param Pubdate $pubdate
     * @return News
     */
    public static function create(Description $description, NewsType $newsType, Link $link, Pubdate $pubdate): News
    {
        return new self($description, $newsType, $link, $pubdate);
    }


}

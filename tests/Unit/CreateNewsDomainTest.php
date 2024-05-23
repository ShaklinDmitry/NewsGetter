<?php

namespace Tests\Unit;

use App\Modules\NewsGetter\Domain\News;
use App\Modules\NewsGetter\Domain\ValueObjects\Description;
use App\Modules\NewsGetter\Domain\ValueObjects\Link;
use App\Modules\NewsGetter\Domain\ValueObjects\NewsType;
use App\Modules\NewsGetter\Domain\ValueObjects\Pubdate;
use PHPUnit\Framework\TestCase;

class CreateNewsDomainTest extends TestCase
{

    public function test_create_news(): void
    {

        $descriptionText = 'description_test';
        $newsType = 'rbc_news';
        $link = 'link_test';
        $pubDate = 'Fri, 17 May 2024 10:37:00 +0300';

        $news = new News(Description::fromString($descriptionText), NewsType::fromString($newsType),
                            Link::fromString($link), Pubdate::fromString($pubDate));


        $this->assertSame($descriptionText, $news->description->text);
        $this->assertSame($newsType, $news->newsType->name);
        $this->assertSame($link, $news->link->string);
        $this->assertSame((new \DateTime($pubDate))->getTimestamp(), $news->pubdate->dateTime->getTimestamp());

    }
}

<?php

namespace App\Modules\NewsGetter\Application\Services;

use App\Modules\NewsGetter\Domain\News;
use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;
use App\Modules\NewsGetter\Domain\ValueObjects\Description;
use App\Modules\NewsGetter\Domain\ValueObjects\Link;
use App\Modules\NewsGetter\Domain\ValueObjects\NewsType;
use App\Modules\NewsGetter\Domain\ValueObjects\Pubdate;
use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;

class NewsService implements NewsServiceInterface
{
    /**
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    /**
     * @param NewsDTO[] $newsCollection
     * @return mixed|void
     */
    public function saveNews(array $newsCollection)
    {
        foreach ($newsCollection as $news){
            $news = News::create(Description::fromString($news->description), NewsType::fromString($news->newsType),
                                Link::fromString($news->link), Pubdate::fromString($news->pubDate));

            $this->newsRepository->saveNews($news);
        }


    }
}

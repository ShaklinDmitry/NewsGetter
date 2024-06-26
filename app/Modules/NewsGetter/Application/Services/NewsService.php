<?php

namespace App\Modules\NewsGetter\Application\Services;

use App\Events\NewsSavedEvent;
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
     * @return void
     */
    public function saveNews(array $newsCollection): void
    {

        $newsFormatted = [];

        foreach ($newsCollection as $news)
        {
            $news = News::create(Description::fromString($news->description), NewsType::fromString($news->newsType),
                Link::fromString($news->link), Pubdate::fromString($news->pubDate));

            $newsFormatted[]  = $news->asArray();

            $this->newsRepository->saveNews($news);
        }

        NewsSavedEvent::dispatch($newsFormatted);
    }
}

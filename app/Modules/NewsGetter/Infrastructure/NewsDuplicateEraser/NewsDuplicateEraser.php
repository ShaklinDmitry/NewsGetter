<?php

namespace App\Modules\NewsGetter\Infrastructure\NewsDuplicateEraser;

use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;
use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;

class NewsDuplicateEraser implements NewsDuplicateEraserInterface
{

    //за сколько часов проверять на удаление дупликатов полученных данных
    const CHECK_HOURS = 24;

    /**
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    /**
     * @param NewsDTO[] $news
     * @return NewsDTO[]
     */
    public function newsDuplicateErase(array $news): array
    {
        $newsWithoutDuplicates = [];

        foreach ($news as $newsItem)
        {
            if(!$this->newsRepository->checkNewsAlreadyExists($newsItem->link, $newsItem->pubDate, 24))
            {
                $newsWithoutDuplicates[] = $newsItem;
            }
        }

        return $newsWithoutDuplicates;
    }
}

<?php

namespace App\Modules\NewsGetter\Infrastructure\Repositories;

use App\Modules\NewsGetter\Domain\News;
use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;

class NewsRepository implements NewsRepositoryInterface
{
    /**
     * @param News $news
     * @return array
     */
    public function saveNews(News $news): array
    {
        $news = \App\Models\News::create([
            'description' => $news->description->text,
            'news_type' => $news->newsType->name,
            'link' => $news->link->string,
            'pub_date' => $news->pubdate->dateTime
        ]);

        return $news->toArray();
    }
}

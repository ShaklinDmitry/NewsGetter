<?php

namespace App\Modules\NewsGetter\Infrastructure\Repositories;

use App\Modules\NewsGetter\Domain\News;
use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;
use DateInterval;
use Illuminate\Support\Facades\DB;

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


    /**
     * @param string $link
     * @param \DateTime $pubDate
     * @param string $checkHours
     * @return bool
     * @throws \Exception
     */
    public function checkNewsAlreadyExists(string $link, \DateTime $pubDate, string $checkHours): bool
    {
        $checkDuplicateTimeInterval = \Carbon\Carbon::parse($pubDate)->subHours($checkHours);

        $isNewsExist = \App\Models\News::query()->where('link', $link)->whereBetween('pub_date', [$checkDuplicateTimeInterval, $pubDate])->exists();

        return $isNewsExist;

    }
}

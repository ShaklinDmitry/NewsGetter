<?php

namespace App\Modules\NewsGetter\Domain;

interface NewsRepositoryInterface
{
    /**
     * @param News $news
     * @return mixed
     */
    public function saveNews(News $news);


    /**
     * @param string $link
     * @param \DateTime $pubDate
     * @param string $checkHours
     * @return bool
     */
    public function checkNewsAlreadyExists(string $link, \DateTime $pubDate, string $checkHours): bool;
}

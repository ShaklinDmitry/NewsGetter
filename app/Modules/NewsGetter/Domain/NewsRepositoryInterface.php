<?php

namespace App\Modules\NewsGetter\Domain;

interface NewsRepositoryInterface
{
    /**
     * @param News $news
     * @return mixed
     */
    public function saveNews(News $news);
}

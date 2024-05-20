<?php

namespace App\Modules\NewsGetter\Application\Services;

interface NewsServiceInterface
{
    /**
     * @param array $newsCollection
     * @return mixed
     */
    public function saveNews(array $newsCollection);
}

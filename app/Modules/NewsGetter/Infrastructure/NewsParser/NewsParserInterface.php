<?php

namespace App\Modules\NewsGetter\Infrastructure\NewsParser;

interface NewsParserInterface
{
    /**
     * @param string $news
     * @param string $newsType
     * @return array
     */
    public function parse(string $news, string $newsType): array;
}

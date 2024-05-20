<?php

namespace App\Modules\NewsGetter\Infrastructure\NewsParser;

interface NewsParserInterface
{
    /**
     * @param string $news
     * @return array
     */
    public function parse(string $news): array;
}

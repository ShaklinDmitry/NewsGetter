<?php

namespace App\Modules\NewsGetter\Infrastructure\NewsParser;

use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;

class NewsParser implements NewsParserInterface
{

    /**
     * @param string $news
     * @return NewsDTO[]
     */
    public function parse(string $news, string $newsType): array
    {
        $xml = simplexml_load_string($news);

        $json = json_encode($xml);

        $xmlConvertedToArray = json_decode($json, TRUE);

        $newsCollection = [];

        for ($i = 0; $i < count($xmlConvertedToArray['channel']['item']); $i++)
        {
            $item = $xmlConvertedToArray['channel']['item'];
            $item[$i]['description'] = preg_replace('/\xc2\xa0/', ' ', $item[$i]['description']);

            $newsCollection[] = new NewsDTO($item[$i]['description'], $newsType, $item[$i]['link'], $item[$i]['pubDate']);
        }

        return $newsCollection;
    }
}

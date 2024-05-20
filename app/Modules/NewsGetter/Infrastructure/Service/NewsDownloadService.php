<?php

namespace App\Modules\NewsGetter\Infrastructure\Service;

use App\Modules\NewsGetter\Application\Services\NewsServiceInterface;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloaderInterface;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParserInterface;

class NewsDownloadService implements NewsDownloadServiceInterface
{

    const LINK = 'https://news.rambler.ru/rss/world/';

    /**
     * @param NewsDownloaderInterface $newsDownloader
     * @param NewsParserInterface $newsParser
     */
    public function __construct(private NewsDownloaderInterface $newsDownloader, private NewsParserInterface $newsParser,
                                private  NewsServiceInterface $newsService)
    {
    }


    /**
     * @return array
     */
    public function download(): array
    {
        $newsBody = $this->newsDownloader->download(self::LINK);

        $parsedNews = $this->newsParser->parse($newsBody);

        $this->newsService->saveNews($parsedNews);

    }
}

<?php

namespace App\Modules\NewsGetter\Infrastructure\Service;

use App\Events\NewsDownloadedEvent;
use App\Modules\NewsGetter\Domain\NewsRepositoryInterface;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloaderInterface;
use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;
use App\Modules\NewsGetter\Infrastructure\NewsDuplicateEraser\NewsDuplicateEraserInterface;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParserInterface;

class NewsDownloadService implements NewsDownloadServiceInterface
{

    const LINKS = [
        [
            'link' => 'https://news.rambler.ru/rss/world/',
            'newsType' => 'rbc_world'
        ]
    ];

    /**
     * @param NewsDownloaderInterface $newsDownloader
     * @param NewsParserInterface $newsParser
     * @param NewsRepositoryInterface $newsRepository
     * @param NewsDuplicateEraserInterface $newsDuplicateEraser
     */
    public function __construct(private NewsDownloaderInterface $newsDownloader, private NewsParserInterface $newsParser,
                                private NewsRepositoryInterface $newsRepository, private NewsDuplicateEraserInterface $newsDuplicateEraser)
    {
    }


    /**
     * @return void
     */
    public function download(): void
    {
        foreach (self::LINKS as $link)
        {
            $newsBody = $this->newsDownloader->download($link['link']);

            $parsedNews = $this->newsParser->parse($newsBody, $link['newsType']);

        //    $newsWithoutDuplicates = $this->newsDuplicateEraser->newsDuplicateErase($parsedNews);

            NewsDownloadedEvent::dispatch($parsedNews);
        }
    }

}

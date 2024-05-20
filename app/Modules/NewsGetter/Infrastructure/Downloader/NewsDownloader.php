<?php

namespace App\Modules\NewsGetter\Infrastructure\Downloader;

use Illuminate\Support\Facades\Http;

class NewsDownloader implements NewsDownloaderInterface
{

    /**
     * @param string $newsLink
     * @return string
     */
    public function download(string $newsLink): string
    {
        $body = Http::get($newsLink)->body();

        return $body;
    }

}

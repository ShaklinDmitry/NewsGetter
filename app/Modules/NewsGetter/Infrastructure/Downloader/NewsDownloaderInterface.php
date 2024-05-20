<?php

namespace App\Modules\NewsGetter\Infrastructure\Downloader;

interface NewsDownloaderInterface
{
    /**
     * @param string $newsLink
     * @return string
     */
    public function download(string $newsLink): string;
}

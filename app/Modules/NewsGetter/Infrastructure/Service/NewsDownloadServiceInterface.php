<?php

namespace App\Modules\NewsGetter\Infrastructure\Service;

interface NewsDownloadServiceInterface
{

    /**
     * @return void
     */
    public function download(): void;
}

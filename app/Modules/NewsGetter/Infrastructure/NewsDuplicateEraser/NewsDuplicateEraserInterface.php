<?php

namespace App\Modules\NewsGetter\Infrastructure\NewsDuplicateEraser;

use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;

interface NewsDuplicateEraserInterface
{
    /**
     * @param NewsDTO[] $news
     * @return NewsDTO[]
     */
    public function newsDuplicateErase(array $news): array;
}

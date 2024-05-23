<?php

namespace Tests\Feature;


use App\Events\NewsDownloadedEvent;
use App\Modules\NewsGetter\Application\Services\NewsServiceInterface;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloader;
use App\Modules\NewsGetter\Infrastructure\Downloader\NewsDownloaderInterface;
use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParser;
use App\Modules\NewsGetter\Infrastructure\NewsParser\NewsParserInterface;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadService;
use App\Modules\NewsGetter\Infrastructure\Service\NewsDownloadServiceInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NewsDownloaderTest extends TestCase
{

    private NewsDownloader $newsDownloader;

    private NewsParser $newsParser;

    private NewsDownloadService $newsDownloadService;

    private string $text;

    private string $newsType = 'rbc_world';

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->newsDownloader = app(NewsDownloaderInterface::class);

        $this->newsParser = app(NewsParserInterface::class);

        $this->text = file_get_contents(base_path('tests/Fixtures/rambler_world_news.xml'));

    }

    public function test_news_body_download(): void
    {
        $testLink = 'https://test.com/*';

        Http::fake([
            $testLink => Http::response($this->text, 200),
        ]);

        $news = $this->newsDownloader->download($testLink);

        $this->assertNotEmpty($news);
    }

    public function test_parse_news()
    {
        $parseCollection = $this->newsParser->parse($this->text, $this->newsType);

        //выборочно проверяю 8 новость
        $this->assertSame("Новых медицинских операций у премьер-министра Словакии Роберта Фицо не будет. Об этом заявила главный врач больницы имени Рузвельта в городе Банска-Бистрица Мириам Лапуникова.",
            $parseCollection[8]->description);

        $this->assertSame("https://news.rambler.ru/world/52771893-vrach-sdelal-zayavlenie-o-novyh-operatsiyah-premera-slovakii-posle-pokusheniya/",
            $parseCollection[8]->link);

        $this->assertSame($this->newsType, $parseCollection[8]->newsType);

        $this->assertSame("Fri, 17 May 2024 10:37:00 +0300",
            $parseCollection[8]->pubDate);
    }

    public function test_news_download_service(){

        $newsDownloaderMock = \Mockery::mock(NewsDownloaderInterface::class);
        $newsDownloaderMock->shouldReceive('download')->andReturn("<rss> </rss>");

        $newsParserMock = \Mockery::mock(NewsParserInterface::class);
        $newsParserMock->shouldReceive('parse')->andReturn([new NewsDTO('test', 'test','test', 'test')]);

        $this->newsDownloadService = $this->app->instance(NewsDownloadServiceInterface::class, new NewsDownloadService($newsDownloaderMock, $newsParserMock));

        Event::fake();

        $this->newsDownloadService->download();

        Event::assertDispatched(NewsDownloadedEvent::class);
    }
}

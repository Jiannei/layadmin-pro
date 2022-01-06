<?php

namespace App\Listeners;

use App\Contracts\PageRepository;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Str;

class RequestHandledListener
{
    public function __construct(private PageRepository $pageRepository)
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(RequestHandled $event)
    {
        if (!$event->request->user() || Str::startsWith($event->request->path(), $this->blacklist())) {
            return;
        }

        $prefix = config('layadmin.route.prefix');
        $path = ltrim(Str::remove($prefix, $event->request->path()), DIRECTORY_SEPARATOR);

        $page = $this->pageRepository->skipPresenter()->take(1)->findWhere(['uri' => $path])->first();
        if (!$page) {
            return;
        }

        $start = $event->request->server('REQUEST_TIME_FLOAT');
        $end = microtime(true);

        activity('visit')->performedOn($page)->withProperties([
            'ip' => $event->request->ip(),
            'duration' => format_duration($end - $start),
            'user_agent' => $event->request->userAgent(),
        ])->log('visit');
    }

    private function blacklist()
    {
        return [
            '__clockwork'
        ];
    }
}

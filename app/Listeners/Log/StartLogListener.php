<?php

namespace App\Listeners\Log;

use App\Events\Log\StartLogEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StartLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StartLogEvent $event): void
    {
        Log::info('Start loging for: ' . $event->model->getTable());
    }
}

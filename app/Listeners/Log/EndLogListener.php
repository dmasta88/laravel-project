<?php

namespace App\Listeners\Log;

use App\Events\Log\EndLogEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EndLogListener
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
    public function handle(EndLogEvent $event): void
    {
        Log::info('Finished logging for: ' . $event->model->getTable());
    }
}

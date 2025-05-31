<?php

namespace App\Models\Traits;

use Illuminate\Support\Arr;
use App\Events\Log\EndLogEvent;
use App\Events\Log\StartLogEvent;
use Illuminate\Support\Facades\Log;

trait HasLogFile
{
    public static function bootHasLogFile()
    {
        static::updated(function ($model) {
            $modelName = class_basename($model);
            $channel = Log::build([
                'driver' => 'single',
                'path' => storage_path("logs/{$modelName}/updated.log"),
                'replace_placeholders' => true,
            ]);
            Log::stack([$channel])->info('Updated {model} {new_data} ', ['new_data' => $model->getDirty(), 'model' => $modelName]);
        });
        static::deleting(function ($model) {
            $model->log_old_deleting = $model->getOriginal();
        });
        static::deleted(function ($model) {
            $modelName = class_basename($model);
            $channel = Log::build([
                'driver' => 'single',
                'path' => storage_path("logs/{$modelName}/deleted.log"),
            ]);
            Log::stack([$channel])->info("Deleted {$modelName}:", ['id' => $model->id]);
            //Log::create($data);
        });
        static::creating(function ($model) {
            //StartLogEvent::dispatch($model);
        });
        static::created(function ($model) {
            //Log::create($data);
            $modelName = class_basename($model);
            $channel = Log::build([
                'driver' => 'single',
                'path' => storage_path("logs/{$modelName}/created.log"),
            ]);
            Log::stack([$channel])->info("Created {$modelName}: ", [$modelName => $model]);
            //EndLogEvent::dispatch($model);
        });
    }
}

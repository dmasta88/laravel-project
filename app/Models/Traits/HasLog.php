<?php

namespace App\Models\Traits;

use App\Events\Log\EndLogEvent;
use App\Events\Log\StartLogEvent;
use App\Models\Log;
use Illuminate\Support\Arr;

trait HasLog
{
    public static function bootHasLog()
    {
        static::updated(function ($model) {
            $data = [
                'model' => class_basename($model),
                'event' => 'updated',
                'old_attributes' => $model->log_old_deleting,
                'new_attributes' => null
            ];
            Log::create($data);
        });
        static::deleting(function ($model) {
            $model->log_old_deleting = $model->getOriginal();
        });
        static::deleted(function ($model) {
            $data = [
                'model' => class_basename($model),
                'event' => 'deleted',
                'old_attributes' => $model->log_old_deleting,
                'new_attributes' => null
            ];
            Log::create($data);
        });
        static::creating(function ($model) {
            StartLogEvent::dispatch($model);
        });
        static::created(function ($model) {
            $data = [
                'model' => class_basename($model),
                'event' => 'created',
                'old_attributes' => null,
                'new_attributes' => $model->getDirty()
            ];
            Log::create($data);
            EndLogEvent::dispatch($model);
        });
        static::retrieved(function ($model) {
            $old = $model->getOriginal();
            $data = [
                'model' => class_basename($model),
                'event' => 'retrieved',
                'old_attributes' => $old,
                'new_attributes' => null
            ];
            Log::create($data);
        });
        static::restored(function ($model) {
            $new = $model->getDirty();
            $old = Arr::only($model->getOriginal(), array_keys($new));
            $data = [
                'model' => class_basename($model),
                'event' => 'restored',
                'old_attributes' => $old,
                'new_attributes' => $new
            ];
            Log::create($data);
        });
        static::forceDeleted(function ($model) {
            $data = [
                'model' => class_basename($model),
                'event' => 'forceDeleted',
                'old_attributes' => $model->log_old_deleting,
                'new_attributes' => null
            ];
            Log::create($data);
        });
    }
}

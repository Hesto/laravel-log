<?php

namespace Hesto\LaravelLogs\Traits;

use Hesto\LaravelLogs\Models\Log;

trait Loggable
{
    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Model $model) {
            try {
                foreach ($model->getDirty() as $key => $value) {
                    $model->logs()->create([
                        'has_logs_id' => \Auth::user()->id,
                        'has_logs_type' => get_class(\Auth::user()),
                        'attribute' => $key,
                        'old_value' => $model->getOriginal($key),
                        'new_value' => $value
                    ]);
                }

                return true;
            } catch (\Exception $e) {
                return true;
            }
        });
    }



    protected static function getRecordActivityEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created',
            'updating',
            'deleted',
        ];
    }
}
<?php

namespace Hesto\LaravelLogs\Traits;

use Hesto\LaravelLogs\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
                        'has_logs_id' => 1,
                        'has_logs_type' => get_class(Auth::user()),
                        'type' => 1,
                        'action' => 'action',
                        'attribute' => $key,
                        'old_value' => $model->getOriginal($key),
                        'new_value' => $value,
                    ]);
                }

                return true;
            } catch (\Exception $e) {
                return true;
            }
        });
    }
}
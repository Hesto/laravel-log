<?php

namespace Hesto\LaravelLogs\Traits;

use Hesto\LaravelLogs\Models\Log;
use Illuminate\Database\Eloquent\Model;

trait HasLogs
{
    public function ownsLogs()
    {
        return $this->morphMany(Log::class, 'has_logs');
    }
}
<?php

namespace Hesto\LaravelLogs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'has_logs_id', 'has_logs_type', 'loggable_id', 'loggable_type', 'type', 'attribute', 'old_value', 'new_value'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function loggable()
    {
        return $this->morphTo();
    }

    public function hasLogs()
    {
        return $this->morphTo();
    }
}
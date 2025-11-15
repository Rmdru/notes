<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurrance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reminder_id',
        'datetime',
        'is_reminded',
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'is_reminded' => 'boolean',
    ];

    public function reminder(): BelongsTo
    {
        return $this->belongsTo(Reminder::class);
    }
}

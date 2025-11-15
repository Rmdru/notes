<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reminder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'note_id',
        'frequency',
        'interval',
        'weekdays',
        'start',
        'time',
        'end',
    ];
    
    protected $casts = [
        'start' => 'date',
        'time' => 'time',
        'end' => 'date',
        'weekdays' => 'array',
    ];

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function recurrances(): HasMany
    {
        return $this->hasMany(Recurrance::class);
    }
}

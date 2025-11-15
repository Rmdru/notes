<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Reminder;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'reminder_id',
        'title',
        'description',
        'color',
        'is_pinned',
        'remind_at',
        'is_reminded',
        'completed',
        'archived_at',
    ];

    protected $casts = [
        'pinned' => 'boolean',
        'reminded' => 'boolean',
        'remind_at' => 'datetime',
        'completed' => 'datetime',
        'archived_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reminder(): BelongsTo
    {
        return $this->belongsTo(Reminder::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_note', 'note_id', 'tag_id');
    }

    public function recurrances(): HasManyThrough
    {
        return $this->hasManyThrough(Recurrance::class, Reminder::class, 'note_id', 'reminder_id');
    }
}

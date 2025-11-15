<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('notes')) {
            Schema::create('notes', function (Blueprint $table) {
                $table->uuid();
                $table->foreignId('user_id');
                $table->foreignUuid('reminder_id')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('color')->nullable();
                $table->boolean('is_pinned')->default(false);
                $table->datetime('remind_at')->nullable();
                $table->boolean('is_reminded')->default(false);
                $table->datetime('completed')->nullable();
                $table->datetime('archived_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('reminders')) {
            Schema::create('reminders', function (Blueprint $table) {
                $table->uuid();
                $table->foreignUuid('note_id');
                $table->string('frequency');
                $table->integer('interval')->default(1);
                $table->json('weekdays')->nullable();
                $table->date('start');
                $table->time('time')->nullable();
                $table->date('end')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('recurrances')) {
            Schema::create('recurrances', function (Blueprint $table) {
                $table->uuid();
                $table->foreignUuid('reminder_id');
                $table->datetime('datetime');
                $table->boolean('is_reminded')->default(false);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('tag_note')) {
            Schema::create('tag_note', function (Blueprint $table) {
                $table->uuid();
                $table->foreignUuid('note_id');
                $table->foreignUuid('tag_id');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->uuid();
                $table->string('name');
                $table->string('color')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reminder');
        Schema::dropIfExists('recurrances');
        Schema::dropIfExists('tag_note');
        Schema::dropIfExists('tags');
    }
};

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class StudyResult extends Model
{
    protected $fillable = [
        'user_id',
        'course_code',
        'earned_ec',
    ];

    protected $casts = [
        'earned_ec' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


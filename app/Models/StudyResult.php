<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $course_code
 * @property float $earned_ec
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Illuminate\Database\Eloquent\Builder<\App\Models\StudyResult>
 * @method static \Illuminate\Database\Eloquent\Builder<\App\Models\StudyResult> query()
 * @method static \App\Models\StudyResult updateOrCreate(array<string, mixed> $attributes,
 *     array<string, mixed> $values = [])
 */
class StudyResult extends Model
{
    protected $fillable = [
        'user_id',
        'course_code',
        'earned_ec',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

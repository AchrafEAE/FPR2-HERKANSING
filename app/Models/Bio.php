<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\BioFactory factory(...$parameters)
 * @property int $id
 * @property int $user_id
 * @property string $headline
 * @property string $summary
 * @property string|null $location
 * @property string|null $availability
 * @property string|null $website_url
 * @property string|null $linkedin_url
 * @property string|null $github_url
 * @property int|null $years_experience
 * @property string|null $avatar_path
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\User|null $user
 */
class Bio extends Model
{
    /** @phpstan-ignore-next-line */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'headline',
        'summary',
        'location',
        'availability',
        'website_url',
        'linkedin_url',
        'github_url',
        'years_experience',
        'avatar_path',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

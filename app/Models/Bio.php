<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Database\Factories\BioFactory factory(...$parameters)
 * @extends \Illuminate\Database\Eloquent\Model<\App\Models\Bio>
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
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\User|null $user
 */
/** @phpstan-ignore-next-line */
class Bio extends Model
{
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
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

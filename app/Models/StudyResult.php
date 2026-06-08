<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyResult extends Model
{
    protected $fillable = [
        'user_id',
        'course_code',
        'earned_ec',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    protected $fillable = [
        'name',
        'email',
        'answers',
        'personality_type_id',
    ];

    /**
     * Get the personality type for the quiz result.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<PersonalityType, QuizResult>
     */
    public function personalityType(): BelongsTo
    {
        return $this->belongsTo(PersonalityType::class);
    }
}

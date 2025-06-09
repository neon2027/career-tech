<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get all personality scores for this quiz result.
     */
    public function personalityScores(): HasMany
    {
        return $this->hasMany(QuizPersonalityScore::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizPersonalityScore extends Model
{
    protected $fillable = [
        'quiz_result_id',
        'personality_type_id',
        'total_score',
        'max_possible_score',
        'percentage',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
    ];

    /**
     * Get the quiz result that owns this score.
     */
    public function quizResult(): BelongsTo
    {
        return $this->belongsTo(QuizResult::class);
    }

    /**
     * Get the personality type for this score.
     */
    public function personalityType(): BelongsTo
    {
        return $this->belongsTo(PersonalityType::class);
    }
}

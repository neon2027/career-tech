<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalityQuestion extends Model
{
    protected $fillable = ['question', 'personality_type_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<this, PersonalityType>
     */
    public function personalityType(): BelongsTo
    {
        return $this->belongsTo(PersonalityType::class);
    }
}

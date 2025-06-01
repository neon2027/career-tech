<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonalityType extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<this, App\Models\PersonalityQuestion>
     * 
     */
    public function personalityQuestions(): HasMany
    {
        return $this->hasMany(PersonalityQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<this, App\Models\Career>
     */
    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }
}

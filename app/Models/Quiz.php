<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = ['act_id', 'title'];

    public function act()
    {
        return $this->belongsTo(Act::class);
    }

    public function pairs()
    {
        return $this->hasMany(QuizPair::class);
    }

    public function quizPairs()
    {
        return $this->hasMany(QuizPair::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserQuizProgress::class);
    }
}

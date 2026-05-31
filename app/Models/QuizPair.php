<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizPair extends Model
{
    protected $fillable = ['quiz_id', 'left_text', 'right_text'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

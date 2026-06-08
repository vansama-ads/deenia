<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'chapter_id',
        'name',
        'description',
        'order_number',
    ];

    /**
     * Get the chapter that owns the act.
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Get the lessons for the act.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the quiz for the act.
     */
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    /**
     * Get the quizzes for the act.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}

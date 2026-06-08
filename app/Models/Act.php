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

    /**
     * Get the previous act in the same chapter based on order_number.
     * Returns null if this is the first act.
     */
    public function previousAct(): ?self
    {
        return static::where('chapter_id', $this->chapter_id)
            ->where('order_number', '<', $this->order_number)
            ->orderByDesc('order_number')
            ->first();
    }
}

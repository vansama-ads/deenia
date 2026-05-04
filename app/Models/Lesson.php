<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'act_id',
        'title',
        'content',
    ];

    /**
     * Get the act that owns the lesson.
     */
    public function act()
    {
        return $this->belongsTo(Act::class);
    }
}

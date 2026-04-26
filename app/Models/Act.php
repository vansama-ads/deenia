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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'order_number',
    ];

    /**
     * Get the acts for the chapter.
     */
    public function acts()
    {
        return $this->hasMany(Act::class)->orderBy('order_number');
    }
}
